<?php

/**
 * KpiCvm class
 * This class is SQL commands for Dashboard(index) page
 *
 */

class KpiCvm extends CFormModel {

    public $dtInicio;
    public $dtTermino;
    public $ilha;
    public $pqsVote = array();
    public $typeIds = array();

    /**
     * @internal Fila no formato de array. Ex.: array(1,2,4)
     * @var array
     */
    public $idQueue;
    public $timeInSeconds;
    public $servicesIds = array();

    /**
     * @internal Qtd Tickets/Fila/Periodo
     * @var integer
     */
    public $kpiWidget10;

    /**
     * @internal Qtd Tickets/Fila/Tempo/Periodo
     * @var integer
     */
    public $kpiWidget11;

    /**
     * @internal Tempo médio de Atendimento(segundos)
     * @var integer
     */
    public $kpiWidget13;
    public $kpiWidget14;
    public $kpiWidget15;
    public $kpiWidget20;
    public $kpiWidget21;
    public $kpiWidget22;
    public $kpiWidget23;
    public $kpiWidget24;
    public $kpiWidget25;

    /**
     * @internal Qtd Tickets Geral no periodo
     * @var integer
     */
    public $allTicketsClosed;

    
    /**
     * Valida data de Início e Término
     * @param type $attribute
     * @param type $params
     */
    public function validarPeriodo($attribute,$params){
        if (!empty($this->dtInicio) && !empty($this->dtTermino)){
            $dt1 = new DateTime(FksFormatter::formatarDateToSQLDate($this->dtInicio));
            $dt2 = new DateTime(FksFormatter::formatarDateToSQLDate($this->dtTermino));
            if ($dt1 > $dt2){
                $this->addError($attribute, 'Data de Término deve ser maior que Data de Início!');
            }
        }
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        /* return array(
            array('dtInicio, dtTermino', 'required', 'on' => 'search'),
            array('dtInicio, dtTermino, tipo', 'required', 'on' => 'report'),
            array('dtTermino', 'validarPeriodo'),
            array('dtInicio, dtTermino, tipo', 'safe'),
        ); */
        return array(
            // username and password are required
            array('dtInicio, dtTermino', 'required', 'on' => 'search'),
            array('dtInicio, dtTermino, ilha', 'required', 'on' => 'report'),
            array('servicesIds', 'validarIlha'),
            array('dtTermino', 'validarPeriodo'),
            array('dtInicio, dtTermino', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            /* 'dtInicio' => 'Início',
            'dtTermino' => 'Término', */
            'dtInicio' => 'Data Início',
            'dtTermino' => 'Data Término',
            'ilha' => 'Ilha',
            'servicesIds' => 'Serviços',
        );
    }

    public function validarIlha($attribute) {
        if ($this->ilha == 4 && !is_array($this->servicesIds)) {
            $this->addError($attribute, 'Serviço(s) Obrigatório(s)!');
        }
    }

    /**
     * Retorna lista de Servicos cadastrados no OTRS
     * return array
     */
    public function listaOtrsServico() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select("s.id as service_id, s.name as service_name, gc.name as type_name, s.criticality")
            ->from("service s")
            ->join("general_catalog gc", "s.type_id = gc.id and general_catalog_class = 'ITSM::Service::Type'")
            ->where("s.valid_id = 1")
            ->order("s.name")
            ->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna a quantidade de tickets encerrados no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     * @adapted Jorgito Paiva
     */
    public function kpiAllTicketsClosed() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados')
            ->where('DATE(finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna a quantidade de tickets com Tempo na Fila
     * @return integer Quantidade de Tickets
     * @param null
     * @author Franklin Farias
     * @adapted Jorgito Paiva
     */
    public function kpiTempoNaFila() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (1) ' .
                ' AND (fncTime2ToInt(fncTempoNaFila(t.id,1))) <= :time ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':time' => 900,
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna a quantidade de tickets com Tempo na Fila
     * @return integer Quantidade de Tickets
     * @param null
     * @author Franklin Farias
     * @adapted Jorgito Paiva
     */
    public function kpiTempoTratamento() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('AVG(fncTime2ToInt(fncTempoSemPendente(fncTotalHorasUteis(t.create_time,t1t.time_first_move),fncTempoPendente(t.id)))) AS time_1_response')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (1) ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['time_1_response'];
    }

    /**
     * @internal Retorna a quantidade de tickets com Tempo na Fila
     * @return integer Quantidade de Tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function tempoTratamento() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('AVG(fncTime2ToInt(fncTempoSemPendente(fncTotalHorasUteis(t.create_time,t1t.time_first_move),fncTempoPendente(t.id)))) AS time_1_response')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['time_1_response'];
    }

    /**
     * @internal Retorna a quantidade de tickets encerrados na fila, no tempo e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget11() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') ' .
                ' AND fncTime2ToInt(fncTotalHorasUteis(t.create_time,t1t.time_first_move)) <= :time ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':time' => $this->timeInSeconds,
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna tickets resolvidos no primeiro contato(No move)
     * @return integer Quantidade
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget14() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd, COUNT(CASE WHEN mv.qtd_move-1 <= 1 THEN te.ticket_id END) qtd_move')
            ->from('vw_tickets_encerrados te')
            ->join('(select ticket_id, count(*) as qtd_move from ticket_history where history_type_id = 16 group by ticket_id) mv', 'te.ticket_id = mv.ticket_id')
            ->where('te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') ' .
                'and DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return array($ret[0]['qtd'],$ret[0]['qtd_move']);
    }

    /**
     * @internal Retorna satisfacao PQS
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget16() {
        $sql = "select q1.qtd as q1, q2.qtd as q2, q3.qtd as q3, q4.qtd as q4 " .
            "from " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 1 " .
            "and sv.vote_value = 'Yes') q1, " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 2 " .
            "and sv.vote_value IN ('4','5')) q2, " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 3 " .
            "and sv.vote_value IN ('9','10')) q3, " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 4 " .
            "and sv.vote_value IN ('14','15')) q4";
        $cmd = Yii::app()->dbCVM->createCommand();
        $cmd->text = $sql;
        $ret = $cmd->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna INsatisfacao PQS
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget17() {
        $sql = "select q1.qtd as q1, q2.qtd as q2, q3.qtd as q3, q4.qtd as q4 " .
            "from " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 1 " .
            "and sv.vote_value = 'No') q1, " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 2 " .
            "and sv.vote_value IN ('1','2')) q2, " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 3 " .
            "and sv.vote_value IN ('6','7')) q3, " .
            "(select sv.question_id, count(*) as qtd " .
            "from survey_vote sv " .
            "where question_id = 4 " .
            "and sv.vote_value IN ('11','12')) q4";
        $cmd = Yii::app()->dbCVM->createCommand();
        $cmd->text = $sql;
        $ret = $cmd->queryAll();
        return $ret;
    }

    /**
     * @internal Retorna Inconsistencias
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget20() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd')
            ->from('vw_tickets_encerrados te')
            ->join('vw_tickets_inconsistentes ti', 'te.ticket_id = ti.ticket_id')
            ->where('DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        $this->kpiWidget20 = $ret[0]['qtd'];
    }

    /**
     * @internal Retorna Assertividade
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget22() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd, COUNT(CASE WHEN ISNULL(tr.ticket_id)THEN te.ticket_id END) qtd_first')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->leftJoin('vw_tickets_reabertos tr','te.ticket_id = tr.ticket_id')
            ->where('(te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') OR t.service_id IN (' . FormModelTemplate::arrayToList($this->servicesIds) . '))' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return array($ret[0]['qtd'],$ret[0]['qtd_first']);
    }

    /**
     * @internal Retorna Tempo Suspensao
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget23() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('AVG(fncTime2ToInt(fncTempoPendenteSL(t.id))) as media')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->where('s.id not in (40,246,247,248,249,250,283,474)'.
                ' AND (te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') OR s.id IN (' . FormModelTemplate::arrayToList($this->servicesIds) . '))' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        $this->kpiWidget23 = $ret[0]['media'];
    }

    /**
     * @internal Retorna Tempo Escalação
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget24() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd, SUM(fncTime2ToInt(fncTempoNaFilaOLAExterna(t.id,2))+fncTime2ToInt(fncTempoNaFilaOLAExterna(t.id,3))+fncTime2ToInt(fncTempoNaFilaOLAExterna(t.id,4))) as time_esc')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('(select distinct ticket_id from ticket_history where queue_id = 20) ola', 't.id = ola.ticket_id')
            ->leftJoin('service s', 't.service_id = s.id')
            ->where('(te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') OR s.id IN (' . FormModelTemplate::arrayToList($this->servicesIds) . '))' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        $this->kpiWidget24 = $ret[0]['qtd'];
        $this->kpiWidget25 = $ret[0]['time_esc'];
    }

    /**
     * @internal Retorna Tempo Medio Direcionamento de Incidentes
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget25() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd, SUM(fncTime2ToInt(fncTempoSemPendente(fncTotalHorasUteis(t.create_time,t1t.time_first_move),fncTempoPendente(t.id)))) as time_direc')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('t.type_id = 2 AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return ($ret[0]['qtd'] > 0 ? ($ret[0]['time_direc'] / $ret[0]['qtd']) : 0);
    }

    /**
     * @internal Retorna Tempo Medio Direcionamento outras demandas
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget26() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd, SUM(fncTime2ToInt(fncTempoSemPendente(fncTotalHorasUteis(t.create_time,t1t.time_first_move),fncTempoPendente(t.id)))) as time_direc')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->leftJoin('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('t.type_id in (1,4) AND te.queue_finish NOT IN (22) AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return ($ret[0]['qtd'] > 0 ? ($ret[0]['time_direc'] / $ret[0]['qtd']) : 0);
    }

    /**
     * @internal Retorna Demandas de Problemas
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget27() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->where('t.type_id = 5 AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna Atualização Base Conhecimento
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget28() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd')
            ->from('faq_item fi')
            ->where('DATE(fi.changed) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna Tempo Medio Direcionamento de Incidentes
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget29() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(*) as qtd, SUM(fncTime2ToInt(fncTempoAtualizacao(t.id))) as time_direc')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->where('t.type_id = 2 AND te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') '.
                'AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return ($ret[0]['qtd'] > 0 ? ($ret[0]['time_direc'] / $ret[0]['qtd']) : 0);
    }

    /**
     * @internal Retorna a quantidade de tickets encerrados na fila e no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiWidget10() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados')
            ->where('queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') AND DATE(finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna a quantidade de tickets encerrados no período
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function allTicketsClosed() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados')
            ->where('DATE(finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna a quantidade de tickets com Tempo na Fila
     * @return integer Quantidade de Tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function tempoNaFila() {
        $timeQueues = '';
        foreach ($this->idQueue as $value) {
            $timeQueues .= (empty($timeQueues) ? "fncTime2ToInt(fncTempoNaFila(t.id,$value))" : "+fncTime2ToInt(fncTempoNaFila(t.id,$value))");
        }

        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('vw_tickets_1_tratamento t1t', 't.id = t1t.ticket_id')
            ->where('te.queue_finish IN (' . FormModelTemplate::arrayToList($this->idQueue) . ') ' .
                ' AND ('.$timeQueues.') <= :time ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':time' => $this->timeInSeconds,
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    /**
     * @internal Retorna a quantidade de tickets de Resolucao dos Servicos
     * @return integer Quantidade de Tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiResolucaoServicos() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('service s', 's.id = t.service_id')
            ->where('s.id IN (' . FormModelTemplate::arrayToList($this->servicesIds) . ') ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        $this->kpiWidget10 = $ret[0]['qtd'];
    }

    /**
     * @internal Retorna a quantidade de tickets com Tempo na Fila de Resolucao dos Servicos
     * @return integer Quantidade de Tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function kpiTempoNaFilaResolucaoServicos() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COALESCE(COUNT(*),0) AS qtd')
            ->from('vw_tickets_encerrados te')
            ->join('ticket t', 'te.ticket_id = t.id')
            ->join('service s', 's.id = t.service_id')
            ->where('s.id IN (' . FormModelTemplate::arrayToList($this->servicesIds) . ') ' .
                ' AND fncTime2ToInt(fncTempoNaFila(t.id,te.queue_finish)) <= :time ' .
                ' AND DATE(te.finish_time) BETWEEN :dtIni and :dtFim', array(
                ':time' => $this->timeInSeconds,
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
            ))
            ->queryAll();
        return $ret[0]['qtd'];
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
            $timeQueues .= ",fncTempoNaFila(t.id, $value) AS time_in_queue$value";
        }

        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
    public function rptPesquisaSatisfacaoNew() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select("*")
            ->from('vw_kpi_pqs_new')
            ->where("1=1 and question_id in (7,9,10)  and vote_value <> '' AND DATE(vote_time) BETWEEN :dtIni and :dtFim ", array(
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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
        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
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

        $ret = Yii::app()->dbCVM->createCommand()
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
                ':dtIni' => $this->datePTtoEN($this->dtInicio),
                ':dtFim' => $this->datePTtoEN($this->dtTermino)))
            ->queryAll();
        return $ret;
    }

    public function arrayToList($array) {
        $lst = "'" . implode("','", $array) . "'";
        return $lst;
    }

    public function datePTtoEN($date) {
        $dt = explode('/', $date);
        return $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    }
}