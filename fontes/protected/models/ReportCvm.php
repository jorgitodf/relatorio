<?php

/**
 * Report class
 * This class is SQL commands for Dashboard(index) page
 *
 */
class ReportCvm extends FormModelTemplate {

    /**
     * Propriedades da classe ReportForm
     */
    public $dtInicial;
    public $dtFinal;
    public $ilha;
    public $tipoRelatorio = 1;
    public $servicesIds = array();
    public $pqsVote = array();
    public $typeIds = array();

    /**
     * @internal Fila no formato de array. Ex.: array(1,2,4)
     * @var array
     */
    public $idQueue;
    public $timeInSeconds;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('dtInicial, dtFinal, ilha, tipoRelatorio', 'required'),
            array('servicesIds', 'validarIlha'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'dtInicial' => 'Data Início',
            'dtFinal' => 'Data Término',
            'ilha' => 'Ilha',
            'servicesIds' => 'Serviços',
            'tipoRelatorio' => 'Tipo Relatório',
        );
    }


    /**
     * Retorna lista de Servicos cadastrados no OTRS
     * return array
     */
    public function listaOtrsServico() {
        $ret = Yii::app()->db->createCommand()
            ->select("s.id as service_id, s.name as service_name,gc.name as type_name, s.criticality")
            ->from("service s")
            ->join("general_catalog gc", "s.type_id = gc.id and general_catalog_class = 'ITSM::Service::Type'")
            ->where("s.valid_id = 1")
            ->order("s.name")
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosPorTempo() {
        $timeQueues = '';
        foreach ($this->idQueue as $value) {
            $timeQueues .= ",fncTempoNaFila(t.id,$value) AS time_in_queue$value";
        }

        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTempoSemPendente(fncTotalHorasUteis(t.create_time,t1t.time_first_move),fncTempoPendente(t.id)) AS time_1_response" .
                $timeQueues)
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (' . $this->arrayToList($this->idQueue) . ')' .
                //' AND fncTime2ToInt(timediff(te.finish_time,te.create_time)) <= :time ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                //':time' => $this->timeInSeconds,
                //':queue' => $this->arrayToList($this->idQueue),
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosPorTempoServico() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTotalHorasUteis(t.create_time,t1t.time_first_move) AS time_1_response" .
                ",fncTempoNaFila(t.id,te.queue_finish) AS time_in_queue")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->join('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('s.id IN (' . $this->arrayToList($this->servicesIds) . ')' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                //':service' => $this->arrayToList($this->servicesIds),
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila sem encaminhamento para outra fila
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosSemEncaminhamento() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTotalHorasUteis(t.create_time,t1t.time_first_move) AS time_1_response," .
                "(mv.qtd_move - 1) as qtd_contact" .
                ",fncTempoNaFila(t.id,te.queue_finish) AS time_in_queue")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->join('(select ticket_id, count(*) as qtd_move from ticket_history where history_type_id = 16 group by ticket_id) mv', 't.id = mv.ticket_id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (' . $this->arrayToList($this->idQueue) . ')' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                //':service' => $this->arrayToList($this->servicesIds),
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosInconsistentes() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTotalHorasUteis(t.create_time,t1t.time_first_move) AS time_1_response," .
                "case when (ti.ticket_id > 0) then 'TRUE' else 'FALSE' end as inconsistent" .
                ",fncTempoNaFila(t.id,te.queue_finish) AS time_in_queue")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->leftJoin('vw_tickets_inconsistentes ti', 't.id = ti.ticket_id')
            ->where('DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                //':service' => $this->arrayToList($this->servicesIds),
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a Pesquisa de Satifiscação
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptPesquisaSatisfacao() {
        $ret = Yii::app()->db->createCommand()
            ->select("*")
            ->from('vw_kpi_pqs')
            ->join('vw_survey_questions')
            ->where('1=1' .
                ' AND DATE(vote_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila sem encaminhamento para outra fila
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosSemReabertura() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish" .
                ",if(isnull(tr.ticket_id),1,0) as first_contact")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->leftJoin('vw_tickets_reabertos tr','te.ticket_id = tr.ticket_id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->where('(te.queue_finish IN (' . $this->arrayToList($this->idQueue) . ') OR s.id IN (' . $this->arrayToList($this->servicesIds) . '))' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila sem encaminhamento para outra fila
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosSuporteSuspensao() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTempoPendenteSL(t.id) as time_pending".
                ",if(isnull(tr.ticket_id),1,0) as first_contact")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->leftJoin('vw_tickets_reabertos tr','te.ticket_id = tr.ticket_id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->where('s.id not in (40,246,247,248,249,250,283,474)'.
                ' AND (te.queue_finish IN (' . $this->arrayToList($this->idQueue) . ') OR s.id IN (' . $this->arrayToList($this->servicesIds) . '))' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosPorTempoOLA() {

        // Não considerar tempo após a saída da OLA Externa.
        // Repasse feito pela Thalita em 05/03/2015 Conf.Skype.

        $timeQueues = '';
        foreach ($this->idQueue as $value) {
            $timeQueues .= ",fncTempoNaFilaOLAExterna(t.id,$value) AS time_in_queue$value";
        }

        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTotalHorasUteis(t.create_time,t1t.time_first_move) AS time_1_response" .
                $timeQueues)
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->join('(select distinct ticket_id from ticket_history where queue_id = 20) ola', 't.id = ola.ticket_id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('(te.queue_finish IN (' . $this->arrayToList($this->idQueue) . ') OR s.id IN (' . $this->arrayToList($this->servicesIds) . '))' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsEncerradosPorTipo() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTempoSemPendente(fncTotalHorasUteis(t.create_time,t1t.time_first_move),fncTempoPendente(t.id)) AS time_1_response," .
                "fncTempoAtualizacao(t.id) AS time_update")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish NOT IN (22) AND tt.id IN ('.$this->arrayToList($this->typeIds).') AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptTicketsIncidentesFila() {
        $ret = Yii::app()->db->createCommand()
            ->select("te.ticket_id,tt.name AS type_name,t.tn,t.title,ts.name AS state_name," .
                "s.name AS service_name,t.create_time,q1.name AS queue_create,te.finish_time," .
                "q2.name AS queue_finish,concat(u.first_name,' ',u.last_name) AS user_finish," .
                "fncTempoAtualizacao(t.id) AS time_update")
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('ticket_state ts', 't.ticket_state_id = ts.id')
            ->join('ticket_type tt', 't.type_id = tt.id')
            ->join('queue q1', 'te.queue_create = q1.id')
            ->join('queue q2', 'te.queue_finish = q2.id')
            ->join('users u', 'te.user_finish = u.id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('tt.id = 2 AND te.queue_finish IN (' . $this->arrayToList($this->idQueue) . ') '.
                'AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a lista de FAQ no período
     * @return integer Quantidade de FAQ
     * @param null
     * @author Franklin Farias
     *
     */
    public function rptFaq() {
        $ret = Yii::app()->db->createCommand()
            ->select("fi.f_number AS faq_number, fi.f_subject AS faq_title," .
                "fi.created AS time_create, fi.changed AS time_change," .
                "fs.name as state_name," .
                "fc.name as category_name," .
                "concat(u1.first_name, ' ', u1.last_name) as user_created," .
                "concat(u2.first_name, ' ', u2.last_name) as user_changed")
            ->from('faq_item fi')
            ->join('faq_state fs', 'fi.state_id = fs.id')
            ->join('faq_category fc', 'fi.category_id = fc.id')
            ->join('users u1', 'fi.created_by = u1.id')
            ->join('users u2', 'fi.changed_by = u2.id')
            ->where('DATE(fi.changed) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => $this->datePTtoEN($this->dtInicial),
                ':dtFim' => $this->datePTtoEN($this->dtFinal)))
            ->queryAll();
        return $ret;
    }

}
