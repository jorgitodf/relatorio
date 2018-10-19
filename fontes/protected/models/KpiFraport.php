<?php

/**
 * KpiFraport class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiFraport extends CFormModel {
    
    public $dtInicio;
    public $dtTermino;

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
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dtInicio, dtTermino', 'required', 'on' => 'search'),
            array('dtTermino', 'validarPeriodo'),
            array('dtInicio, dtTermino', 'safe'),
        );
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dtInicio' => 'Início',
            'dtTermino' => 'Término',
        );
    }


    /**
     * Relatório Chamados com SLA's.
     * @return array
     */
    public function rptKPIReport(){
        Yii::app()->dbFRAPORT->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("k.tn AS tn,
                k.ticket_id AS ticket_id,
                k.title AS title,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.type_name AS type_name,
                k.priority_name AS priority_name,
                k.state_name AS state_name,
                k.queue_create_name AS queue_create_name,
                k.name_ownwer AS name_ownwer,
                DATE_FORMAT(k.date_first_owner, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
                k.first_queue_name AS first_queue_name,
                k.first_queue_id AS first_queue_id,
                k.service_name AS service_name,
                k.resolution AS resolution,
                DATE_FORMAT(k.date_resolution, '%d/%m/%Y %H:%i:%s') AS date_resolution,
                k.atendente_resolution AS atendente_resolution,
                k.queue_resolution AS queue_resolution,
                k.queue_resolution_id AS queue_resolution_id,                
                k.timePendingQueueCS AS timePendingQueueCS,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
                fncTempoPrimeiroAtendimento(k.ticket_id) AS tempo_primeiro_atendimento,
                k.TimeQueueResolution AS TimeQueueResolution,
                k.service_id AS service_id,
                k.sla_id AS sla_id,
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                DATE_FORMAT(k.data_encerramento, '%m/%Y') AS mes_ref,
                k.solicitante,
                IF(ISNULL(k.sla), 'SLA Desconhecido', k.sla) AS sla,
                k.time_rest_sla AS time_rest_sla")
            ->from("vw_kpi_report_cs AS k ")
            ->where("date(k.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND k.queue_resolution_id NOT IN (11) AND k.first_queue_id NOT IN (11) "
                . "ORDER BY k.tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets;
    }


    /**
     * Relatório Chamados com SLA's Centra de Serviços Fraport.
     * @return array
     */
    public function rptKPIReportCSF(){
        Yii::app()->dbFRAPORT->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("k.tn AS tn,
                k.ticket_id AS ticket_id,
                k.title AS title,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.type_name AS type_name,
                k.priority_name AS priority_name,
                k.state_name AS state_name,
                k.queue_create_name AS queue_create_name,
                k.name_ownwer AS name_ownwer,
                DATE_FORMAT(k.date_first_owner, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
                k.first_queue_name AS first_queue_name,
                k.first_queue_id AS first_queue_id,
                k.service_name AS service_name,
                k.resolution AS resolution,
                DATE_FORMAT(k.date_resolution, '%d/%m/%Y %H:%i:%s') AS date_resolution,
                k.atendente_resolution AS atendente_resolution,
                k.queue_resolution AS queue_resolution,
                k.queue_resolution_id AS queue_resolution_id,                
                k.timePendingQueueCS AS timePendingQueueCS,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
                fncTempoPrimeiroAtendimento(k.ticket_id) AS tempo_primeiro_atendimento,
                k.TimeQueueResolution AS TimeQueueResolution,
                TIME_FORMAT(k.timePendingQueueCSF, '%H:%i:%s') AS timePendingQueueCSF,
                k.service_id AS service_id,
                k.sla_id AS sla_id,
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                DATE_FORMAT(k.data_encerramento, '%m/%Y') AS mes_ref,
                k.solicitante,
                IF(ISNULL(k.sla), 'SLA Desconhecido', k.sla) AS sla,
                fncTime2ToIntNew(k.time_rest_sla) AS time_rest_sla_int,
                k.time_rest_sla AS time_rest_sla")
            ->from("vw_kpi_report_cs AS k ")
            ->where("date(k.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND k.queue_resolution_id = 11 AND k.first_queue_id = 11 "
                . "ORDER BY k.sla_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets;
    }


    /**
     * Retorna a Quantidade de Chamados Abertos via Customer.
     * @return array
     */
    public function qtdTotalChamadosAbertosCustomer() {
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(t.id) as qtd ")
            ->from("ticket AS t ")
            ->join("ticket_history AS th", "t.id = th.ticket_id ")
            ->where("t.create_time BETWEEN :dtIni and :dtFim AND history_type_id = 1 AND th.queue_id = 1 AND (th.state_id = 1 OR th.state_id = 4) "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos via Customer Tratados em Até 15 Minutos.
     * @return array
     */
    public function qtdChamadosAbertosCustomerTratadosAte15Min() {
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(t.id) as qtd ")
            ->from("ticket AS t ")
            ->join("ticket_history AS th", "t.id = th.ticket_id ")
            ->where("t.create_time BETWEEN :dtIni and :dtFim AND history_type_id = 1 AND (th.state_id = 1 OR th.state_id = 4) AND fncTempoPrimeiroAtendimentoCustomer(t.id) <= '00:15:00' "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos via Agente ou Processo.
     * @return array
     */
    public function qtdTotalChamadosAbertosAgenteProcesso() {
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(t.id) as qtd ")
            ->from("ticket AS t ")
            ->join("ticket_history AS th", "t.id = th.ticket_id ")
            ->where("t.create_time BETWEEN :dtIni and :dtFim AND history_type_id = 1 AND th.queue_id = 23 AND th.state_id = 4"
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos e Fechados na Central de Serviços - Suporte Tec Remoto sem passar por outra Fila.
     * @return array
     */
    public function qtdChamadosAbertosEFechadosCSSR() {
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(ticket) AS qtd ")
            ->from("vw_tickets_encerrados_cssr ")
            ->where("finish_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos na Central de Serviços - Suporte Tec Remoto com a Responsabilidade de Encerramento na Central de Serviços - Suporte Tec Remoto.
     * @return array
     */
    public function qtdChamadosAbertosN1() {
        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(id) AS qtd ")
            ->from("ticket ")
            ->where("service_id IN (8,27,74,123,185,191,193,205,209,210,212,214,215,216,219,221,223,224,230,232,233,234,235,242,243,244,246,249,251,253,254,259,263,264,265,272) AND create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 8 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_1() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 1 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '28800', // 8 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 1 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 12 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_2() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 12);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 2 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 12 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 2 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_3() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 16);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 3 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 12 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 3 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 18 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_4() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 18);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 4 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 12 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 4 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 24 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_5() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 24);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 5 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 24 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 5 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
 * Tempo total de atendimento
 * Meta > 90% dos chamados resolvidos
 * dentro do prazo de 42 horas durante o prazo de funcionamento da FRAPORT.
 * @return int total de solicitações
 */
    public function kpi02_6() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 42);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 6 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 42 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 6 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 48 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_7() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 48);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 7 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 48 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 7 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 90% dos chamados resolvidos
     * dentro do prazo de 56 horas durante o prazo de funcionamento da FRAPORT.
     * @return int total de solicitações
     */
    public function kpi02_8() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 56);
        $ticket = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 8 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                . "AND FNCTIME2TOINT(FNCTEMPONAFILA(vkcs.ticket_id, vkcs.queue_resolution_id)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => $time, // 56 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbFRAPORT->createCommand()
            ->select("COUNT(vkcs.ticket_id) as qtd_total ")
            ->from("vw_kpi_report_cs vkcs ")
            ->where("vkcs.sla_id = 8 AND vkcs.first_queue_id NOT IN (11) AND vkcs.queue_resolution_id NOT IN (11) "
                . "AND DATE(vkcs.data_encerramento) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $dados['qtd'] = $ticket[0]['qtd'];
        $dados['qtd_total'] = $tickets[0]['qtd_total'];
        return $dados;
    }

}