<?php

/**
 * KpiAnatel class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiAnatel extends CFormModel {
    
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
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptSP(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("k.tn AS tn, k.ticket_id AS ticket_id, k.title AS title,	k.type_name AS type_name,
                    k.priority_name AS priority_name, k.state_name AS state_name, k.service_name AS service_name,
                    k.create_time AS create_time, k.queue_create_name AS queue_create_name, fo.name_ownwer AS name_ownwer,
                    fo.create_time AS date_first_owner, fm.queue_name AS first_queue_name, k.sla AS sla, k.finish_time AS finish_time, 
                    k.queue_finish_name AS queue_finish_name, CONCAT(u.first_name,' ',u.last_name) AS primary_user_finish, k.user_finish AS user_finish, k.timePending AS timePending,
                    TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution, TIME_FORMAT(k.timeQueueSP, '%H:%i:%s') AS timeQueueSP, 
                    TIME_FORMAT(k.timePendingQueueSP, '%H:%i:%s') AS timePendingQueueSP, k.queue_finish AS queue_finish, 
                    k.service_id AS service_id, k.sla_id AS sla_id ")
                ->from("vw_kpi AS k ")
                ->leftjoin("vw_first_owner fo", "fo.ticket_id = k.ticket_id ")
                ->leftjoin("vw_first_move fm", "fm.ticket_id = k.ticket_id ")
                ->leftjoin("vw_all_tickets_finish_n2_by_user atfby", "atfby.ticket_id = k.ticket_id ")
                ->leftjoin("users u", "u.id = atfby.create_by ")
                ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                    . " AND k.queue_finish = 21 "
                    . " ORDER BY k.ticket_id ASC "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets;
    }


    /**
     * Chamados Relacionados à Fila de Sustentação.
     * @return array
     */
    public function rptSUST(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_move_sust()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, k.ticket_id AS ticket_id, k.title AS title, DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, k.priority_name AS priority_name, k.state_name AS state_name, 
            k.service_name AS service_name, IFNULL(afo.observacao, 'Sem observação') AS observation,
            k.queue_create_name AS queue_create_name, k.queue_finish AS queue_finish_id, k.queue_finish_name AS queue_finish_name,
            fo.name_ownwer AS name_ownwer, DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            fm.queue_name AS first_queue_name, DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_queue_name,
            k.sla AS sla, DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time, 
            k.user_finish_id AS user_finish, k.timePending AS timePending, TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
            k.timeQueueFinish AS timeQueueFinish, k.timePendingQueueFinish AS timePendingQueueFinish,
            k.queue_finish AS queue_finish, k.service_id AS service_id, k.sla_id AS sla_id,
            DATE_FORMAT(k.finish_time, '%Y%m') AS mes_ref, k.solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueFinish) AS time_rest_sla,
            truncate(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueFinish))/3600,2) AS time_rest_sla_convert,
            IF(asa.nome_sistema IS NULL, 'Sistema não informado na abertura do Chamado', asa.nome_sistema) AS nome_sistema")
            ->from("vw_kpi_sust_3 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("tickets_first_move_sust fm", "fm.ticket_id = k.ticket_id ")
            ->leftjoin("vw_all_systems_anatel asa", "asa.ticket_id = k.ticket_id ")
            ->leftjoin("vw_all_fields_observation afo", "afo.object_id = k.ticket_id ")
            ->where("not exists (select target_key as id_ticket_filho from link_relation where target_key = k.ticket_id)"
                . " AND date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }


    /**
     * Chamados Relacionados à Fila de Sustentação.
     * @return array
     */
    public function rptSUSTREOPEN(){
        //Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        //Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_move_sust()")->execute();
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_reabertos()")->execute();
        $ticketsReopen = Yii::app()->dbANATEL->createCommand()
            ->select("*")
            ->from("vw_kpi_sust_reopen_v3 k ")
            ->where("not exists (select target_key as id_ticket_filho from link_relation where target_key = k.ticket_id)"
                . " AND date(k.data_encerramento) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $ticketsReopen;
    }

    /**
     * Chamados Relacionados à Fila de Sustentação.
     * @return array
     */
    public function rptREDESROPEN(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_reabertos()")->execute();
        $ticketsReopen = Yii::app()->dbANATEL->createCommand()
            ->select("tn AS tn, ticket_id AS ticket_id, title AS title, DATE_FORMAT(create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                type_name AS type_name, priority_name AS priority_name, state_name AS state_name, service_name AS service_name,
                queue_create_name AS queue_create_name, queue_finish AS queue_finish_id, queue_finish_name AS queue_finish_name,
                name_ownwer AS name_ownwer, DATE_FORMAT(create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
                first_queue_name AS first_queue_name, DATE_FORMAT(create_time_first_queue, '%d/%m/%Y %H:%i:%s') AS create_time_first_queue,
                sla AS sla, DATE_FORMAT(finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time, 
                user_finish AS user_finish, timePending AS timePending, TIME_FORMAT(timeResolution, '%H:%i:%s') AS timeResolution,
                timeQueueREDES AS timeQueueREDES, timePendingQueueREDES AS timePendingQueueREDES,
                queue_finish AS queue_finish, service_id AS service_id, sla_id AS sla_id,
                DATE_FORMAT(finish_time, '%m/%Y') AS mes_ref, solicitante,
                FNCCALCTEMSLARESTANTE(sla_id, timeQueueREDES) AS time_rest_sla,
                truncate(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(sla_id, timeQueueREDES))/3600,2) AS time_rest_sla_convert")
            ->from("vw_kpi_redes_reopen ")
            ->where("date(finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $ticketsReopen;
    }

    /**
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptSustSemSolucionamento(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, k.ticket_id AS ticket_id, k.title AS title,	k.type_name AS type_name, k.priority_name AS priority_name,
            k.state_name AS state_name, k.service_name AS service_name, DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.queue_create_name AS queue_create_name, fo.name_ownwer AS name_ownwer, DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner, fm.queue_name AS first_queue_name,
            DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_queue_name, k.sla AS sla, DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.queue_finish_name AS queue_finish_name, CONCAT(u.first_name,' ',u.last_name) AS primary_user_finish, k.user_finish AS user_finish,k.timePending AS timePending,
            k.timeResolution AS timeResolution, k.timeQueueFinish AS timeQueueFinish, k.timePendingQueueFinish AS timePendingQueueFinish,
            k.queue_finish AS queue_finish, k.service_id AS service_id, k.sla_id AS sla_id, date_format(k.finish_time, '%m/%Y') AS mes_ref,
            k.solicitante, fncCalcTemSlaRestante(k.sla_id, k.timeQueueFinish) AS time_rest_sla")
            ->from("vw_kpi_sust_2 AS k ")
            ->leftjoin("vw_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("vw_first_move_sust fm", "fm.ticket_id = k.ticket_id ")
            ->leftjoin("vw_all_tickets_no_finish_sust_by_user atfby", "atfby.ticket_id = k.ticket_id ")
            ->leftjoin("users u", "u.id = atfby.create_by ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " AND queue_create = 23 "
                . " ORDER BY k.tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }


    /**
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptREDES(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
            k.ticket_id AS ticket_id, 
            k.title AS title,
            DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, 
            k.priority_name AS priority_name, 
            k.state_name AS state_name,
            k.service_name AS service_name, 
            k.service_id AS service_id, 
            k.queue_create_name AS queue_create_name,
            k.queue_finish AS queue_finish_id, 
            DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.user_finish AS user_finish, 
            DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
            fo.name_ownwer AS name_ownwer, 
            DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            fm.queue_name AS first_queue_name, 
            DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_queue_name,
            k.sla AS sla, 
            k.sla_id AS sla_id, 
            k.queue_finish_name AS queue_finish_name, 
            k.user_finish AS user_finish,
            k.timeQueueCS AS timeQueueCS, 
            TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
            TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
            TIME_FORMAT(k.timeQueueREDES, '%H:%i:%s') AS timeQueueREDES,
            TIME_FORMAT(k.timePendingQueueREDES, '%H:%i:%s') AS timePendingQueueREDES,
            DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
            k.solicitante AS solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueREDES) AS time_rest_sla,
            TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueREDES)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_redes_v2 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("vw_first_move_redes fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados da Fila de Impressoras.
     * @return array
     */
    public function rptIMPRESORAS(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
            k.ticket_id AS ticket_id, 
            k.title AS title,
            DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, 
            k.priority_name AS priority_name, 
            k.state_name AS state_name,
            k.service_name AS service_name, 
            k.service_id AS service_id, 
            k.queue_create_name AS queue_create_name,
            k.queue_finish AS queue_finish_id, 
            DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.user_finish AS user_finish, 
            DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
            fo.name_ownwer AS name_ownwer, 
            DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            fm.queue_name AS first_queue_name, 
            DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_queue_name,
            k.sla AS sla, 
            k.sla_id AS sla_id, 
            k.queue_finish_name AS queue_finish_name, 
            k.user_finish AS user_finish,
            k.timeQueueCS AS timeQueueCS, 
            TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
            TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
            TIME_FORMAT(k.timeQueueIMPRESSORAS, '%H:%i:%s') AS timeQueueIMPRESSORAS,
            TIME_FORMAT(k.timePendingQueueIMPRESSORAS, '%H:%i:%s') AS timePendingQueueIMPRESSORAS,
            DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
            k.solicitante AS solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueIMPRESSORAS) AS time_rest_sla,
            k.solicitante AS solicitante,
            TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueIMPRESSORAS)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_impressoras AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("vw_first_move_impressoras fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados da Fila de Infraestrutura.
     * @return array
     */
    public function rptINFRAESTRUTURA(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
            k.ticket_id AS ticket_id, 
            k.title AS title,
            DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, 
            k.priority_name AS priority_name, 
            k.state_name AS state_name,
            k.service_name AS service_name, 
            k.service_id AS service_id, 
            k.queue_create_name AS queue_create_name,
            k.queue_finish AS queue_finish_id, 
            DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.user_finish AS user_finish, 
            DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
            fo.name_ownwer AS name_ownwer, 
            DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            fm.queue_name AS first_queue_name, 
            DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_queue_name,
            k.sla AS sla, 
            k.sla_id AS sla_id, 
            k.queue_finish_name AS queue_finish_name, 
            k.user_finish AS user_finish,
            k.timeQueueCS AS timeQueueCS, 
            TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
            TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
            TIME_FORMAT(k.timeQueueINFRA, '%H:%i:%s') AS timeQueueINFRA,
            TIME_FORMAT(k.timePendingQueueINFRA, '%H:%i:%s') AS timePendingQueueINFRA,
            DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
            k.solicitante AS solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueINFRA) AS time_rest_sla,
            k.solicitante AS solicitante,
            TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueINFRA)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_infra_fisica AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("vw_first_move_infra fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados da Fila de Biblioteca.
     * @return array
     */
    public function rptBIBLIOTECA(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
            k.ticket_id AS ticket_id, 
            k.title AS title,
            DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, 
            k.priority_name AS priority_name, 
            k.state_name AS state_name,
            k.service_name AS service_name, 
            k.service_id AS service_id, 
            k.queue_create_name AS queue_create_name,
            k.queue_finish AS queue_finish_id, 
            DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.user_finish AS user_finish, 
            DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
            fo.name_ownwer AS name_ownwer, 
            DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            CASE WHEN fm.queue_name IS NULL THEN k.queue_create_name ELSE fm.queue_name END AS first_queue_name, 
            CASE WHEN fm.create_time IS NULL THEN DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') ELSE DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') END AS date_first_queue_name,
            k.sla AS sla, 
            k.sla_id AS sla_id, 
            k.queue_finish_name AS queue_finish_name, 
            k.user_finish AS user_finish,
            k.timeQueueCS AS timeQueueCS, 
            TIME_FORMAT(k.timePendingTotal, '%H:%i:%s') AS timePending,
            TIME_FORMAT(k.timeTotalResolution, '%H:%i:%s') AS timeResolution,
            TIME_FORMAT(k.timeQueueBIBLIOTECA, '%H:%i:%s') AS timeQueueBIBLIOTECA,
            TIME_FORMAT(k.timePendingQueueBIBLIOTECA, '%H:%i:%s') AS timePendingQueueBIBLIOTECA,
            DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
            k.solicitante AS solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueBIBLIOTECA) AS time_rest_sla,
            TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueBIBLIOTECA)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_biblioteca AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("vw_first_move_biblioteca fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Report Excel Fila Gestão de Biblioteca
     * @return array
     */
    public function rptREPORTBiblioteca(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,
                ticket_id,
                title,
                create_time,
                type_name,
                priority_name,
                state_name,
                service_name,
                service_id,
                queue_create_name,
                queue_create_id,
                name_first_ownwer,
                date_first_ownwer,
                queue_first_ownwer,
                queue_first_ownwer_id,
                CASE WHEN first_queue_name = 'Encerrado' THEN queue_first_ownwer ELSE first_queue_name END AS first_queue_name,
                date_first_queue_name,
                first_queue_name_id,
                fila_resolucao,
                atendente_resolucao,
                DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_resolucao_id,
                sla,
                sla_id,
                tempo_primeiro_atendimento,
                tempo_total_pendente,
                tempo_na_fila_cs,
                tempo_na_fila_resolucao,
                total_tempo_resolucao,
                sla_restante,
                DATE_FORMAT(data_encerramento, '%m/%Y') AS mes_ref, 
                solicitante,
                data_encerramento")
            ->from("vw_report_excel ")
            ->where("date(data_resolucao) BETWEEN :dtIni and :dtFim AND "
                . " service_id IN (252,254,255,256,257,258,262,266,272,276,280,292,322,327,331,333,342,343,344,345,1389,1390,1391,1392,1411) "
                . " AND queue_create_id IN (23,35,36,37,38,120,121,122,123) "
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Report Excel Fila Gestão de Redes
     * @return array
     */
    public function rptREPORTRedes(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,
                ticket_id,
                title,
                create_time,
                type_name,
                priority_name,
                state_name,
                service_name,
                service_id,
                queue_create_name,
                queue_create_id,
                name_first_ownwer,
                date_first_ownwer,
                queue_first_ownwer,
                queue_first_ownwer_id,
                CASE WHEN first_queue_name = 'Encerrado' THEN queue_first_ownwer ELSE first_queue_name END AS first_queue_name,
                date_first_queue_name,
                first_queue_name_id,
                fila_resolucao,
                atendente_resolucao,
                DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_resolucao_id,
                sla,
                sla_id,
                tempo_primeiro_atendimento,
                tempo_total_pendente,
                tempo_na_fila_cs,
                tempo_na_fila_resolucao,
                total_tempo_resolucao,
                sla_restante,
                DATE_FORMAT(data_encerramento, '%m/%Y') AS mes_ref, 
                solicitante,
                data_encerramento")
            ->from("vw_report_excel ")
            ->where("date(data_resolucao) BETWEEN :dtIni and :dtFim AND "
                . " service_id IN (158,159,167,168,169,170,172,173,174,175,176,181,182,183,184,1350,1351,1352,1353,1354,1355,1356,1357,1358,"
                . " 1359,1360,1361,1362,1363,1364,1365,1366,1367,1368,1369,1370,1371,1372,1373,1374,"
                . " 1375,1376,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387,1418,1419)"
                . " AND queue_create_id IN (23,111,112,113,114,115,1193) "
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Report Excel Fila Gestão de Telefonia
     * @return array
     */
    public function rptREPORTTelefonia()
    {
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,
                ticket_id,
                title,
                create_time,
                type_name,
                priority_name,
                state_name,
                service_name,
                service_id,
                queue_create_name,
                queue_create_id,
                name_first_ownwer,
                date_first_ownwer,
                queue_first_ownwer,
                queue_first_ownwer_id,
                CASE WHEN first_queue_name = 'Encerrado' THEN queue_first_ownwer ELSE first_queue_name END AS first_queue_name,
                date_first_queue_name,
                first_queue_name_id,
                fila_resolucao,
                atendente_resolucao,
                DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_resolucao_id,
                sla,
                sla_id,
                tempo_primeiro_atendimento,
                tempo_total_pendente,
                tempo_na_fila_cs,
                tempo_na_fila_resolucao,
                total_tempo_resolucao,
                sla_restante,
                DATE_FORMAT(data_encerramento, '%m/%Y') AS mes_ref, 
                solicitante,
                data_encerramento")
            ->from("vw_report_excel ")
            ->where("date(data_resolucao) BETWEEN :dtIni and :dtFim AND "
                . " service_id IN (195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,"
                . " 222,223,224,225,226,227,228,229,230,231,232,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,1398,1399,"
                . " 1400,1401,1402,1403,1404,1405,1406,1407,1408,1409,1410,1414,1415,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,"
                . " 1432,1433,1434,1435,1436,1437,1438)"
                . " AND queue_create_id IN (23,111,112,113,114,115,119)"
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;

    }

    /**
     * Report Excel Fila Gestão de Dados
     * @return array
     */
    public function rptREPORTGestaoDeDados(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,
                ticket_id,
                title,
                create_time,
                type_name,
                priority_name,
                state_name,
                service_name,
                service_id,
                queue_create_name,
                queue_create_id,
                name_first_ownwer,
                date_first_ownwer,
                queue_first_ownwer,
                queue_first_ownwer_id,
                CASE WHEN first_queue_name = 'Encerrado' THEN queue_first_ownwer ELSE first_queue_name END AS first_queue_name,
                date_first_queue_name,
                first_queue_name_id,
                fila_resolucao,
                atendente_resolucao,
                DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_resolucao_id,
                sla,
                sla_id,
                tempo_primeiro_atendimento,
                tempo_total_pendente,
                tempo_na_fila_cs,
                tempo_na_fila_resolucao,
                total_tempo_resolucao,
                sla_restante,
                DATE_FORMAT(data_encerramento, '%m/%Y') AS mes_ref, 
                solicitante,
                data_encerramento")
            ->from("vw_report_excel ")
            ->where("date(data_resolucao) BETWEEN :dtIni and :dtFim AND "
                . " service_id IN (1482,1485,1484,1483,1490,1492,1495,1497,1493,1500,1503,1486,1488,1480,1506,1478,1504,1502,1501,1499,1496,1498,1494,1505,1491,1481,1479,1487,1489,1444,1507,1442,1473,"
                . " 1474,1477,1472,1476,1475,1441,1465,1462,1446,1454,1471,1456,1466,1455,1453,1467,1448,1445,1450,1451,1459,1460,1449,1464,1452,1463,1461,1457,1458,1469,1468,1470,1447,"
                . "1508,1509,1510,1511,1512)"
                . " AND queue_create_id IN (23,142,143,144,145,146) "
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Report Excel Fila Fiscalização
     * @return array
     */
    public function rptREPORTFiscalizacao(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,
                ticket_id,
                title,
                create_time,
                type_name,
                priority_name,
                state_name,
                service_name,
                service_id,
                queue_create_name,
                queue_create_id,
                name_first_ownwer,
                date_first_ownwer,
                queue_first_ownwer,
                queue_first_ownwer_id,
                CASE WHEN first_queue_name = 'Encerrado' THEN queue_first_ownwer ELSE first_queue_name END AS first_queue_name,
                date_first_queue_name,
                first_queue_name_id,
                fila_resolucao,
                atendente_resolucao,
                DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_resolucao_id,
                sla,
                sla_id,
                tempo_primeiro_atendimento,
                tempo_pendente_cs,
                tempo_na_fila_cs,
                tempo_pendente_filas_fiscalizacao,
                tempo_atendimento,
                total_tempo_resolucao,
                sla_restante,
                DATE_FORMAT(data_encerramento, '%m/%Y') AS mes_ref, 
                solicitante,
                data_encerramento")
            ->from("vw_report_excel_fiscalizacao ")
            ->where("date(data_resolucao) BETWEEN :dtIni and :dtFim "
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Report Excel Fila Gestão de Impressoras
     * @return array
     */
    public function rptREPORTImpressoras(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,
                ticket_id,
                title,
                create_time,
                type_name,
                priority_name,
                state_name,
                service_name,
                service_id,
                queue_create_name,
                queue_create_id,
                name_first_ownwer,
                date_first_ownwer,
                queue_first_ownwer,
                queue_first_ownwer_id,
                CASE WHEN first_queue_name = 'Encerrado' THEN queue_first_ownwer ELSE first_queue_name END AS first_queue_name,
                date_first_queue_name,
                first_queue_name_id,
                fila_resolucao,
                atendente_resolucao,
                DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_resolucao_id,
                sla,
                sla_id,
                tempo_primeiro_atendimento,
                tempo_total_pendente,
                tempo_na_fila_cs,
                tempo_na_fila_resolucao,
                total_tempo_resolucao,
                sla_restante,
                DATE_FORMAT(data_encerramento, '%m/%Y') AS mes_ref, 
                solicitante,
                data_encerramento")
            ->from("vw_report_excel ")
            ->where("date(data_resolucao) BETWEEN :dtIni and :dtFim AND "
                . " service_id IN (1340,1341,1342,1343,1344)"
                . " AND queue_create_id IN (23,28) "
                . " ORDER BY ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados da Fila de Impressoras.
     * @return array
     */
    public function rptGESTAODADOS(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()

            ->select("k.tn AS tn, 
            k.ticket_id AS ticket_id, 
            k.title AS title,
            DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, 
            k.priority_name AS priority_name, 
            k.state_name AS state_name,
            k.service_name AS service_name, 
            k.service_id AS service_id, 
            k.queue_create_name AS queue_create_name,
            k.queue_finish AS queue_finish_id, 
            DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.user_finish AS user_finish, 
            DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
            fo.name_ownwer AS name_ownwer, 
            DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            k.sla AS sla, 
            k.sla_id AS sla_id, 
            k.queue_finish_name AS queue_finish_name, 
            k.user_finish AS user_finish,
            k.timeQueueCS AS timeQueueCS, 
            TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
            TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
            TIME_FORMAT(k.timeQueueGESTAODADOS, '%H:%i:%s') AS timeQueueGESTAODADOS,
            TIME_FORMAT(k.timePendingQueueGESTAODADOS, '%H:%i:%s') AS timePendingQueueGESTAODADOS,
            DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
            k.solicitante AS solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueGESTAODADOS) AS time_rest_sla,
            TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueGESTAODADOS)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_gestao_dados AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptTELEFONIA(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, k.ticket_id AS ticket_id, k.title AS title,
            DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
            k.type_name AS type_name, k.priority_name AS priority_name, k.state_name AS state_name,
            k.service_name AS service_name, k.service_id AS service_id, k.queue_create_name AS queue_create_name,
            k.queue_finish AS queue_finish_id, DATE_FORMAT(k.finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time,
            k.user_finish AS user_finish, DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
            fo.name_ownwer AS name_ownwer, DATE_FORMAT(fo.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_owner,
            fm.queue_name AS first_queue_name, DATE_FORMAT(fm.create_time, '%d/%m/%Y %H:%i:%s') AS date_first_queue_name,
            k.sla AS sla, k.sla_id AS sla_id, k.queue_finish_name AS queue_finish_name, k.user_finish AS user_finish,
            k.timeQueueCS AS timeQueueCS, TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
            TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,
            TIME_FORMAT(k.timeQueueREDES, '%H:%i:%s') AS timeQueueREDES,
            TIME_FORMAT(k.timePendingQueueREDES, '%H:%i:%s') AS timePendingQueueREDES,
            DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, k.solicitante AS solicitante,
            FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueREDES) AS time_rest_sla,
            TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueueREDES)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_redes_telef AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("vw_first_move_redes fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }


    /**
     * Chamados Produção de Banco de Dados.
     * @return array
     */
    public function rptPDBD(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_first_move_pd()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
                k.ticket_id AS ticket_id, 
                k.title AS title, 
                k.type_name AS type_name,          
                k.priority_name AS priority_name, 
                k.state_name AS state_name, 
                k.service_name AS service_name,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.queue_create_name AS queue_create_name, 
                fo.name_ownwer AS name_ownwer,
                fo.create_time AS date_first_owner, 
                fm.queue_name AS first_queue_name, 
                fm.create_time AS create_time_first_queue,
                k.sla AS sla, 
                k.finish_time AS finish_time, 
                k.queue_finish_name AS queue_finish_name, 
                k.user_finish AS user_finish, 
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,	
                TIME_FORMAT(k.timeQueuePD, '%H:%i:%s') AS timeQueuePD, 
                TIME_FORMAT(k.timePendingQueuePD, '%H:%i:%s') AS timePendingQueuePD,
                k.queue_finish AS queue_finish, 
                k.service_id AS service_id, 
                k.sla AS sla_id, 
                k.sla AS sla_name,
                DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
                k.solicitante AS solicitante,
                FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD) AS time_rest_sla,
                TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_pd_v2 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("tickets_first_move_pd fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . "AND k.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,"
                . "716,718,742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,"
                . "686,687,688,689,690,691,692) "
                . "ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }


    /**
     * Chamados Produção de Aplicações Web.
     * @return array
     */
    public function rptAWEB(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
                k.ticket_id AS ticket_id, 
                k.title AS title, 
                k.type_name AS type_name,          
                k.priority_name AS priority_name, 
                k.state_name AS state_name, 
                k.service_name AS service_name,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.queue_create_name AS queue_create_name, 
                fo.name_ownwer AS name_ownwer,
                fo.create_time AS date_first_owner, 
                fm.queue_name AS first_queue_name, 
                fm.create_time AS create_time_first_queue,
                k.sla AS sla, 
                k.finish_time AS finish_time, 
                k.queue_finish_name AS queue_finish_name, 
                k.user_finish AS user_finish, 
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,	
                TIME_FORMAT(k.timeQueuePD, '%H:%i:%s') AS timeQueuePD, 
                TIME_FORMAT(k.timePendingQueuePD, '%H:%i:%s') AS timePendingQueuePD,
                k.queue_finish AS queue_finish, 
                k.service_id AS service_id, 
                k.sla AS sla_id, 
                k.sla AS sla_name,
                DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
                k.solicitante AS solicitante,
                FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD) AS time_rest_sla,
                TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_pd_v2 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("tickets_first_move_pd fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . "AND k.service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados Produção de Aplicações Departamentais.
     * @return array
     */
    public function rptADP(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
                k.ticket_id AS ticket_id, 
                k.title AS title, 
                k.type_name AS type_name,          
                k.priority_name AS priority_name, 
                k.state_name AS state_name, 
                k.service_name AS service_name,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.queue_create_name AS queue_create_name, 
                fo.name_ownwer AS name_ownwer,
                fo.create_time AS date_first_owner, 
                fm.queue_name AS first_queue_name, 
                fm.create_time AS create_time_first_queue,
                k.sla AS sla, 
                k.finish_time AS finish_time, 
                k.queue_finish_name AS queue_finish_name, 
                k.user_finish AS user_finish, 
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,	
                TIME_FORMAT(k.timeQueuePD, '%H:%i:%s') AS timeQueuePD, 
                TIME_FORMAT(k.timePendingQueuePD, '%H:%i:%s') AS timePendingQueuePD,
                k.queue_finish AS queue_finish, 
                k.service_id AS service_id, 
                k.sla AS sla_id, 
                k.sla AS sla_name,
                DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
                k.solicitante AS solicitante,
                FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD) AS time_rest_sla,
                TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_pd_v2 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("tickets_first_move_pd fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . "AND k.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,"
                . "571,561,562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,"
                . "610,611,617,612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,"
                . "636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,"
                . "469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados Produção de Aplicações Departamentais.
     * @return array
     */
    public function rptSSOP(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
                k.ticket_id AS ticket_id, 
                k.title AS title, 
                k.type_name AS type_name,          
                k.priority_name AS priority_name, 
                k.state_name AS state_name, 
                k.service_name AS service_name,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.queue_create_name AS queue_create_name, 
                fo.name_ownwer AS name_ownwer,
                fo.create_time AS date_first_owner, 
                fm.queue_name AS first_queue_name, 
                fm.create_time AS create_time_first_queue,
                k.sla AS sla, 
                k.finish_time AS finish_time, 
                k.queue_finish_name AS queue_finish_name, 
                k.user_finish AS user_finish, 
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,	
                TIME_FORMAT(k.timeQueuePD, '%H:%i:%s') AS timeQueuePD, 
                TIME_FORMAT(k.timePendingQueuePD, '%H:%i:%s') AS timePendingQueuePD,
                k.queue_finish AS queue_finish, 
                k.service_id AS service_id, 
                k.sla AS sla_id, 
                k.sla AS sla_name,
                DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
                k.solicitante AS solicitante,
                FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD) AS time_rest_sla,
                TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_pd_v2 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("tickets_first_move_pd fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . "AND k.service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799,800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados Produção de Aplicações Departamentais.
     * @return array
     */
    public function rptVIRT(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
                k.ticket_id AS ticket_id, 
                k.title AS title, 
                k.type_name AS type_name,          
                k.priority_name AS priority_name, 
                k.state_name AS state_name, 
                k.service_name AS service_name,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.queue_create_name AS queue_create_name, 
                fo.name_ownwer AS name_ownwer,
                fo.create_time AS date_first_owner, 
                fm.queue_name AS first_queue_name, 
                fm.create_time AS create_time_first_queue,
                k.sla AS sla, 
                k.finish_time AS finish_time, 
                k.queue_finish_name AS queue_finish_name, 
                k.user_finish AS user_finish, 
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,	
                TIME_FORMAT(k.timeQueuePD, '%H:%i:%s') AS timeQueuePD, 
                TIME_FORMAT(k.timePendingQueuePD, '%H:%i:%s') AS timePendingQueuePD,
                k.queue_finish AS queue_finish, 
                k.service_id AS service_id, 
                k.sla AS sla_id, 
                k.sla AS sla_name,
                DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
                k.solicitante AS solicitante,
                FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD) AS time_rest_sla,
                TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_pd_v2 AS k ")
            ->leftjoin("tickets_first_owner fo", "fo.ticket_id = k.ticket_id ")
            ->leftjoin("tickets_first_move_pd fm", "fm.ticket_id = k.ticket_id ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . "AND k.service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Chamados Produção Reabertos.
     * @return array
     */
    public function rptREOPD(){
        Yii::app()->dbANATEL->createCommand("CALL sp_insert_tickets_reabertos()")->execute();
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("k.tn AS tn, 
                k.ticket_id AS ticket_id, 
                k.title AS title, 
                k.type_name AS type_name,          
                k.priority_name AS priority_name, 
                k.state_name AS state_name, 
                k.service_name AS service_name,
                DATE_FORMAT(k.create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                k.queue_create_name AS queue_create_name, 
                k.name_ownwer AS name_ownwer,
                k.create_time AS date_first_owner, 
                k.first_queue_name AS first_queue_name, 
                k.create_time AS create_time_first_queue,
                k.sla AS sla, 
                k.finish_time AS finish_time, 
                k.queue_finish_name AS queue_finish_name, 
                k.user_finish AS user_finish, 
                DATE_FORMAT(k.data_encerramento, '%d/%m/%Y %H:%i:%s') AS data_encerramento,
                TIME_FORMAT(k.timePending, '%H:%i:%s') AS timePending,
                TIME_FORMAT(k.timeResolution, '%H:%i:%s') AS timeResolution,	
                TIME_FORMAT(k.timeQueuePD, '%H:%i:%s') AS timeQueuePD, 
                TIME_FORMAT(k.timePendingQueuePD, '%H:%i:%s') AS timePendingQueuePD,
                k.queue_finish AS queue_finish, 
                k.service_id AS service_id, 
                k.sla_id AS sla_id, 
                k.sla AS sla_name,
                DATE_FORMAT(k.finish_time, '%m/%Y') AS mes_ref, 
                k.solicitante AS solicitante,
                FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD) AS time_rest_sla,
                TRUNCATE(FNCTIME2TOINTNEW(FNCCALCTEMSLARESTANTE(k.sla_id, k.timeQueuePD)) / 3600, 2) AS time_rest_sla_convert")
            ->from("vw_kpi_pd_reopen AS k ")
            ->where("date(k.finish_time) BETWEEN :dtIni and :dtFim "
                . "ORDER BY k.ticket_id ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }


    /**
     * Chamados abertos Via Customer com Atendimento em até 15 minutos.
     * @return array
     */
    public function rptCS(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time,
                queue_create_name, name_ownwer, date_first_owner, first_queue_name, sla, finish_time, queue_finish_name, user_finish,
                timePending, timeResolution, timeQueueCS, timePendingQueueCS, queue_finish, service_id, sla_id, tempo_atendimento")
            ->from("vw_kpi_cs_cust_15_min ")
            ->where("date(create_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets;
    }

    /**
     * Chamados abertos Via Agente ou Processo com Atendimento em até 15 minutos.
     * @return array
     */
    public function rptCSByAgent(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time,
                queue_create_name, name_ownwer, date_first_owner, first_queue_name, sla, finish_time, queue_finish_name, user_finish,
                timePending, timeResolution, timeQueueCS, timePendingQueueCS, queue_finish, service_id, sla_id, tempo_atendimento")
            ->from("vw_kpi_cs_agent_15_min ")
            ->where("date(create_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets;
    }

    /**
     * Chamados Abertos e Solucionados pela Central de Serviços sem passar por outra Fila.
     * @return array
     */
    public function rptTicketsResolvidosCS(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time,
                queue_create_name, name_ownwer, date_first_owner, first_queue_name, sla, finish_time, queue_finish_name, user_finish,
                timePending, timeResolution, timeQueueCS, timePendingQueueCS, queue_finish, service_id, sla_id")
            ->from("vw_all_tickets_encerrados_n1 ")
            ->where("date(finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets;
    }

    /**
     * Chamados Abertos e Solucionados pelo N2 Suporte Presencial.
     * @return array
     */
    public function rptTicketsResolvidosSP(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, 
                DATE_FORMAT(create_time, '%d/%m/%Y %H:%i:%s') AS create_time,
                queue_create_name, name_ownwer, DATE_FORMAT(date_first_owner, '%d/%m/%Y %H:%i:%s') AS date_first_owner, 
                first_queue_name, sla, DATE_FORMAT(finish_time, '%d/%m/%Y %H:%i:%s') AS finish_time, queue_finish_name, user_finish,
                timePending, TIME_FORMAT(timeResolution, '%H:%i:%s') AS timeResolution, TIME_FORMAT(timeQueueSP, '%H:%i:%s') AS timeQueueSP, 
                TIME_FORMAT(timePendingQueueSP, '%H:%i:%s') AS timePendingQueueSP, queue_finish, service_id, sla_id")
            ->from("vw_all_tickets_encerrados_n2 ")
            ->where("date(finish_time) BETWEEN :dtIni and :dtFim "
                . " ORDER BY tn ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets;
    }
    
    
    /**
     * Retorna a Quantidade de Chamados Abertos via Customer Tratados em Até 15 Minutos.
     * @return array
     */
    public function qtdChamadosAbertosCustomerTratadosAte15Min() {
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) as qtd ")
            ->from("ticket AS t ")
            ->join("ticket_history AS th", "t.id = th.ticket_id ")
            ->where("t.create_time BETWEEN :dtIni and :dtFim AND history_type_id = 1 AND th.state_id = 1 AND fncTempoPrimeiroAtendimentoCustomer(t.id) <= '00:15:00' "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos via Customer.
     * @return array
     */
    public function qtdTotalChamadosAbertosCustomer() {
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) as qtd ")
            ->from("ticket AS t ")
            ->join("ticket_history AS th", "t.id = th.ticket_id ")
            ->where("t.create_time BETWEEN :dtIni and :dtFim AND history_type_id = 1 AND th.queue_id = 23 AND th.state_id = 1"
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
        $tickets = Yii::app()->dbANATEL->createCommand()
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
     * Retorna a Quantidade de Chamados Abertos via via Agente ou Processo Tratados em Até 15 Minutos.
     * @return array
     */
    public function qtdChamadosAbertosAgenteProcessoTratadosAte15Min() {
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) as qtd ")
            ->from("ticket AS t ")
            ->join("ticket_history AS th", "t.id = th.ticket_id ")
            ->where("t.create_time BETWEEN :dtIni and :dtFim AND th.history_type_id = 1 AND th.state_id = 4 AND th.queue_id = 23 "
                . "AND fncTempoPrimeiroAtendimentoAgente(t.id) <= '00:15:00' "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos e Fechados no N1 sem passar por outra Fila.
     * @return array
     */
    public function qtdChamadosAbertosEFechadosN1() {
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket) AS qtd ")
            ->from("vw_tickets_encerrados_n1 ")
            ->where("finish_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Fechados no N2 sem passar por outra Fila.
     * @return array
     */
    public function qtdChamadosFechadosN2() {
        $dados = array('qtd_fechados'=>'', 'qtd_abertos'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(k.ticket_id) AS qtd_fechados ")
            ->from("vw_kpi AS k ")
            ->where("k.service_id IN (171,160,161,107,116,118,120,121,122,123,130,131,133,135,138,139,140,1349,143,142,144,145,211," .
                "212,213,219,222,235,237,238,239,242,244,245,246,165,163,162,166,164,128,136) ".
                "AND k.queue_create = 23 AND k.sla_id IN (1,2,5,6,9) AND k.queue_finish = 21 AND k.finish_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) AS qtd_abertos ")
            ->from("ticket_history th ")
            ->join("ticket t", "t.id = th.ticket_id ")
            ->where("t.service_id IN (171,160,161,107,116,118,120,121,122,123,130,131,133,135,138,139,140,1349,143,142,144,145,211,212,213,219,222,235,237,238,239,242,244,245,246,165,163,162,166,164,128,136) ".
                "AND th.history_type_id = 1 AND th.queue_id = 21 AND t.create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();
        $dados['qtd_fechados'] = $ticket[0]['qtd_fechados'];
        $dados['qtd_abertos'] = $tickets[0]['qtd_abertos'];
        return $dados;
    }

    /**
     * Retorna a Quantidade de Chamados Abertos no N1 com a Responsabilidade de Encerramento no N1.
     * @return array
     */
    public function qtdChamadosAbertosN1() {
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(id) AS qtd ")
            ->from("ticket ")
            ->where("service_id IN (147,148,149,150,151,154,152,155,153,156) AND create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();
        return $tickets[0]['qtd'];
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de responsabilidade do N2 resolvidos
     * dentro do prazo de 6 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi02_1() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd ")
            ->from("vw_kpi ")
            ->where("queue_create = 23 AND sla_id = 2 AND queue_finish = 21 AND service_id IN (171) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueueSP) - fncTime2ToInt(timePendingQueueSP)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '21600', // 6 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_total ")
            ->from("vw_kpi ")
            ->where("queue_create = 23 AND sla_id = 2 AND queue_finish = 21 AND service_id IN (171) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
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
     * Meta > 95% dos chamados de responsabilidade do N2 resolvidos
     * dentro do prazo de 8 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi02_2() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 1 "
                . "AND queue_finish = 21 AND service_id IN (160,161,107,116,118,120,121,122,123,130,131,133,135,138,139,140,1349, "
                . "143,142,144,145,211,212,213,219,222,235,237,238,239,242,244,245,246)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "and (fncTime2ToInt(timeQueueSP) - fncTime2ToInt(timePendingQueueSP)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '28800', // 8 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_total")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 1 "
                . "AND queue_finish = 21 AND service_id IN (160,161,107,116,118,120,121,122,123,130,131,133,135,138,139,140,1349, "
                . "143,142,144,145,211,212,213,219,222,235,237,238,239,242,244,245,246)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
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
     * Meta > 95% dos chamados de responsabilidade do N2 resolvidos
     * dentro do prazo de 9 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi02_3() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 5 "
                . "AND queue_finish = 21 AND service_id IN (163,162,166)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "and (fncTime2ToInt(timeQueueSP) - fncTime2ToInt(timePendingQueueSP)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '32400', // 9 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_total")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 5 "
                . "AND queue_finish = 21 AND service_id IN (163,162,166)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
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
     * Meta > 95% dos chamados de responsabilidade do N2 resolvidos
     * dentro do prazo de 10 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi02_4() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 6 "
                . "AND queue_finish = 21 AND service_id IN (164,165)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "and (fncTime2ToInt(timeQueueSP) - fncTime2ToInt(timePendingQueueSP)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '36000', // 10 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_total")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 6 "
                . "AND queue_finish = 21 AND service_id IN (164,165)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
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
     * Meta > 95% dos chamados de responsabilidade do N2 resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi02_5() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("queue_create = 23 AND sla_id = 6 "
                . "AND queue_finish = 21 AND service_id IN (128,136)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "and (fncTime2ToInt(timeQueueSP) - fncTime2ToInt(timePendingQueueSP)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 16 horas
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_total")
            ->from("vw_kpi")
            ->where("queue_create = 23  AND sla_id = 6 "
                . "AND queue_finish = 21 AND service_id IN (128,136)"
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
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
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 02 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_1() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 15 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 15 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '7200', // 02 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 04 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_2() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 13 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 13 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '14400', // 04 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 06 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_3() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 2 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 2 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '21600', // 06 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 08 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_4() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 1 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 1 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '28800', // 08 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 10 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_5() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 6 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 6 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '36000', // 10 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 12 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_6() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 8 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 8 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '43200', // 12 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 14 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_7() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 17 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 17 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '50400', // 14 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_8() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 9 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 9 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 14 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 18 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_9() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 10 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 10 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '64800', // 18 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 20 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_10() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 18 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 18 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '72000', // 20 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Banco de Dados Responsabilidade do N3 resolvidos
     * dentro do prazo de 24 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpi03_11() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND t.sla_id = 11 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 11 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND service_id IN (109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,"
                . "742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '86400', // 24 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 14 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_1() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 17 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 17 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '50400', // 14 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_2() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 9 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 9 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 16 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 18 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_3() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 10 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 10 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '64800', // 18 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 20 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_4() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 18 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 18 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '72000', // 20 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 26 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_5() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 19 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 19 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '93600', // 26 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 30 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_6() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 21 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 21 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '108000', // 30 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Aplicações Departamentais Responsabilidade do N3 resolvidos
     * dentro do prazo de 32 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiPAD_7() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,"
                . "562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617, "
                . "612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638, "
                . "639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663, "
                . "664,495,498,501,665,667,668,669,670,671) "
                . "AND t.sla_id = 22 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 22 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572, "
                . "490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464, "
                . "465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650, "
                . "651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '115200', // 32 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Servidores e Sistemas Operacionais Responsabilidade do N3 resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiSSOp_1() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND t.sla_id = 9 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 9 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 16 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Servidores e Sistemas Operacionais Responsabilidade do N3 resolvidos
     * dentro do prazo de 18 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiSSOp_2() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND t.sla_id = 10 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 10 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '64800', // 18 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Servidores e Sistemas Operacionais Responsabilidade do N3 resolvidos
     * dentro do prazo de 20 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiSSOp_3() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND t.sla_id = 18 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 18 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '72000', // 20 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Produção::Servidores e Sistemas Operacionais Responsabilidade do N3 resolvidos
     * dentro do prazo de 24 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiSSOp_4() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND t.sla_id = 11 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 11 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799, "
                . "800,801,802,803,804,805,806,807,808,809,810,811,812,813) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '86400', // 24 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Virtualização Responsabilidade do N3 resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiVirt_1() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND t.sla_id = 9 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 9 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 16 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Virtualização Responsabilidade do N3 resolvidos
     * dentro do prazo de 18 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiVirt_2() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND t.sla_id = 10 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 10 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '64800', // 18 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Virtualização Responsabilidade do N3 resolvidos
     * dentro do prazo de 20 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiVirt_3() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND t.sla_id = 18 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 18 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '72000', // 20 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Virtualização Responsabilidade do N3 resolvidos
     * dentro do prazo de 24 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiVirt_4() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->where("t.service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND t.sla_id = 11 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 11 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '86400', // 24 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Aplicações Web Responsabilidade do N3 resolvidos
     * dentro do prazo de 08 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiAplWeb_1() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) AS qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->join("vw_first_move fm" ,"fm.ticket_id = th.ticket_id ")
            ->where("t.service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND t.sla_id = 1 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 1 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '28800', // 16 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Aplicações Web Responsabilidade do N3 resolvidos
     * dentro do prazo de 12 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiAplWeb_2() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->join("vw_first_move fm" ,"fm.ticket_id = th.ticket_id ")
            ->where("t.service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND t.sla_id = 8 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 8 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '43200', // 18 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Aplicações Web Responsabilidade do N3 resolvidos
     * dentro do prazo de 16 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiAplWeb_3() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->join("vw_first_move fm" ,"fm.ticket_id = th.ticket_id ")
            ->where("t.service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND t.sla_id = 9 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 9 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 20 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }

    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de Serviços de TI::Aplicações Web Responsabilidade do N3 resolvidos
     * dentro do prazo de 20 horas durante o prazo de funcionamento da ANATEL.
     * @return int total de solicitações
     */
    public function kpiStiAplWeb_4() {
        $dados = array('qtd_abertos'=>'', 'qtd_fechados'=>'');
        $ticket = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(t.id) as qtd_abertos ")
            ->from("ticket t ")
            ->join("ticket_history th" ,"th.ticket_id = t.id ")
            ->join("vw_first_move fm" ,"fm.ticket_id = th.ticket_id ")
            ->where("t.service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND t.sla_id = 18 "
                . "AND th.history_type_id = 1 AND th.queue_id = 23 "
                . "AND DATE(th.create_time) BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino)
                ))
            ->queryAll();

        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) AS qtd_fechados ")
            ->from("vw_kpi_pd ")
            ->where("queue_create = 23 AND sla = 18 AND queue_finish IN (105,106,107,108,109,110) "
                . "AND DATE(finish_time) BETWEEN :dtIni and :dtFim "
                . "AND service_id IN (452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681) "
                . "AND (fncTime2ToInt(timeQueuePD) - fncTime2ToInt(timePendingQueuePD)) <= :time "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '72000', // 24 horas
                ))
            ->queryAll();

        $dados['qtd_abertos'] = $ticket[0]['qtd_abertos'];
        $dados['qtd_fechados'] = $tickets[0]['qtd_fechados'];
        return $dados;
    }









    /**
     * Retorna a Quantidade de Chamados Abertos dentro de um período.
     * @return array
     */
    public function rptQTDChamadosAbertos(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(id) AS qtd")
            ->from("ticket_history ")
            ->where("history_type_id = 1 AND create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Fechados dentro de um período.
     * @return array
     */
    public function rptQTDChamadosFechados(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(th.ticket_id) AS qtd ")
            ->from("ticket AS ti ")
            ->join("ticket_history AS th", "ti.id = th.ticket_id")
            ->where("th.state_id = 9 AND th.history_type_id = 27 AND th.create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    public function rptRTAGeral(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn,ticket_id,title,type_name,priority_name,state_name,service_name,create_time,queue_create_name,
                finish_time,queue_finish_name,user_finish,qtd_move,timeQueueSP,timePendingQueueSP,timePending,timeResolution")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim order by create_time ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    public function rptRTAKpi03(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_id, service_name, create_time, queue_create_name, finish_time, 
            queue_finish_name, user_finish, timePending, timeResolution, queue_finish, bypass_cs, timeQueueSP, timePendingQueueSP")
            ->from("vw_kpi")
            ->where("queue_create = 5 "
                . "and queue_finish IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38) "
                . "and date(finish_time) between :dtIni and :dtFim  "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    public function kpi06RTA(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_id, type_name, priority_name, state_name, service_name, create_time, 
                    queue_create_name, finish_time, queue_finish_name, user_finish, timePending, timeResolution, queue_finish, 
                    service_id, qtd_move, timeQueueSP, timePending, timePendingQueueSP, timeResolution, timeQueueSP")
            ->from("vw_kpi")
            ->where("queue_finish IN (6,31,32,33,34) "
                . "and service_id IN (" . $this->idKPI06 .") "  // Serviço de Problemas Softwares
                . "and date(finish_time) between :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    public function kpi07RTA(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time, queue_create_name, finish_time, 
            queue_finish_name, user_finish, timePending, timeResolution, timeResolution, queue_finish, service_id, qtd_move, timeQueueSP, timePending, 
            timePendingQueueSP, timeResolution, timeQueueSP")
            ->from("vw_kpi")
            ->where("queue_finish IN (6,30,31,32,33,34) "
                . "and service_id IN (" . $this->idKPI07 .") "  // Serviço de Instalação ou Atualizações Softwares
                . "and date(finish_time) between :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    public function kpi08RTA(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time, queue_create_name, finish_time, 
            queue_finish_name, user_finish, timePending, timeResolution, timeResolution, queue_finish, service_id, qtd_move, timeQueueSP, timePending, 
            timePendingQueueSP, timeResolution, timeQueueSP")
            ->from("vw_kpi")
            ->where("queue_finish in (6,30,31,32,33,34) "
                . "and service_id IN (". $this->idKPI08 .")"  // Serviço de Instalação ou Atualizações Softwares
                . "and date(finish_time) between :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }
    
    /**
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptRTAOla(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time, queue_create_name, finish_time, 
                        queue_finish_name, user_finish, timePending, timeResolution, time_move_ola, queue_finish, service_id, type_id, queue_id")
                ->from("vw_tickets_ola")
                ->where("date(finish_time) between :dtIni and :dtFim "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                        ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ))
                ->queryAll();

        return $tickets;
    }

    /**
     * Respostas da pesquisa de satisfação que consideram o 
     * atendimento “Ruim/Péssimo”
     * @return array qtd_satisfaction e qtd_nosatisfaction
     */
    public function rptRTAPqs(){
        $pqs = Yii::app()->dbANATEL->createCommand()
                ->select("tn, ticket_id, title, type_name, queue_finish_name, user_finish, send_to, 
                DATE_FORMAT(send_time, '%d/%m/%Y %H:%i:%s') AS send_time, DATE_FORMAT(vote_time, '%d/%m/%Y %H:%i:%s') AS vote_time,
                public_survey_key, question, answer, satisfaction, nosatisfaction")
                ->from("vw_kpi_pqs_n2 ")
                ->where("date(vote_time) between :dtIni and :dtFim GROUP BY ticket_id, position order by ticket_id asc " , array(
                        ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                        ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        return $pqs;
    }

    /**
     * Respostas da pesquisa de satisfação que consideram o
     * atendimento “Ruim/Péssimo”
     * @return array qtd_satisfaction e qtd_nosatisfaction
     */
    public function rptRTAPqsN1(){
        $pqs = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, queue_finish_name, user_finish, send_to, 
            DATE_FORMAT(send_time, '%d/%m/%Y %H:%i:%s') AS send_time, DATE_FORMAT(vote_time, '%d/%m/%Y %H:%i:%s') AS vote_time,
            public_survey_key, question, answer, satisfaction, nosatisfaction")
            ->from("vw_kpi_pqs_n1 ")
            ->where("date(vote_time) between :dtIni and :dtFim GROUP BY ticket_id, position order by ticket_id asc " , array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();
        return $pqs;
    }

    public function rptRTAPqsKPI09(){
        $pqs = Yii::app()->dbANATEL->createCommand()
            ->select("tn, ticket_id, title, type_name, queue_finish, user_finish, send_to, send_time, vote_time, public_survey_key, 
                      question, answer, satisfaction, nosatisfaction, queue_finish")
            ->from("vw_kpi_pqs")
            ->where("date(vote_time) between :dtIni and :dtFim "
                . "and queue_finish IN (6,30,31,32,33,34) "
                . "and question_id = 2 order by send_time", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();

        return $pqs;
    }

    /**
     * Total geral de tickets atendidos no período pelo Service Desk
     * @return int total de solicitações
     */
    public function kpiTotalCSTI(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("1=1 "
                        . "and queue_create = 5 "
                        . "and date(finish_time) between :dtIni and :dtFim ", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }

    public function kpiTotalCSTI01(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("1=1 "
                . "and queue_finish = 5 "
                . "and date(finish_time) between :dtIni and :dtFim ", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Total geral de tickets atendidos no período pelo Suporte Presencial
     * @return int total de solicitações
     */
    public function kpiTotalSPR(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim "
                        . "and queue_finish in (6,31,32,33,34)", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Total geral de tickets encaminhados à fila de Suporte de Fornecedores
     * @return int total de solicitações
     */
    public function kpiTotalSPR05(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_tickets_ola")
            ->where("date(finish_time) between :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Total geral de chamados fechados no Suporte Presencial classificados como Serviço de Problema de Software
     * @return int total de solicitações
     */
    public function kpiTotalSPR06(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim "
                . "and queue_finish in (6,31,32,33,34) "
                . "and service_id IN (171,174,177,180,182,188,191,194,197,200,203,206,209,212,215,218,221,224,312,315,432,440)"
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Total geral de chamados fechados no Suporte Presencial classificados como Serviço de Instalação de Novas Estações ou Atualizações
     * @return int total de solicitações
     */
    public function kpiTotalSPR07(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim "
                . "and queue_finish in (6,30,31,32,33,34) "
                . "and service_id IN (126,127,125)"
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Total geral de chamados fechados no Suporte Presencial classificados como Serviço de Instalação ou Atualizações de Softwares
     * @return int total de solicitações
     */
    public function kpiTotalSPR08(){
        $tickets = Yii::app()->dbANATEL->createCommand()
            ->select("COUNT(ticket_id) as qtd")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim "
                . "and queue_finish in (6,30,31,32,33,34) "
                . "and service_id IN (169,172,175,178,181,186,189,192,195,198,201,204,207,210,213,216,219,222,310,314,431,441)"
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    public function mediaNotaskpi02(){
    $media = Yii::app()->dbANATEL->createCommand()
        ->select("FORMAT(AVG(answer),2) AS 'media'")
        ->from("vw_kpi_pqs_n2")
        ->where("date(vote_time) between :dtIni and :dtFim ", array(
            ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
            ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
        ))
        ->queryAll();

    return $media[0]['media'];
    }

    public function mediaNotaskpi09(){
        $media = Yii::app()->dbANATEL->createCommand()
            ->select("FORMAT(AVG(answer),2) AS 'media'")
            ->from("vw_kpi_pqs")
            ->where("queue_finish IN (6,30,31,32,33,34) and question_id = 2 "
                . "and date(vote_time) between :dtIni and :dtFim ", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();

        return $media[0]['media'];
    }

    /**
     * Taxa de resolução na 1ª chamada.
     * Meta > 85% dos chamados de responsabilidade do Service Desk
     * @return int total de solicitações
     */
    public function kpi01(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(distinct k.ticket_id) as qtd")
                ->from("vw_kpi as k")
                ->join("ticket_history AS th", "k.ticket_id = th.ticket_id")
                ->where("th.history_type_id = 16 AND th.queue_id IN (6,31,32,33,34) "
                    . "and date(k.finish_time) between :dtIni and :dtFim and k.queue_finish = 5 "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                        ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ))
                ->order("th.queue_id DESC")
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Taxa de satisfação do usuário 1º Nível
     * Meta >= 7% (Escala: 0-10, sendo 10 o máximo)
     * @return int total de solicitações
     */
    public function kpi02(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(*) as qtd, SUM(satisfaction) as qtd_satisfaction, SUM(nosatisfaction) as qtd_nosatisfaction")
                ->from("vw_kpi_pqs")
                ->where("date(vote_time) between :dtIni and :dtFim "
                        . "and queue_finish = 5 "
                        . "and question_id = 2 ", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets[0];
    }
    
    /**
     * Tempo total de atendimento
     * Meta > 95% dos chamados de responsabilidade do Service Desk resolvidos 
     * dentro do prazo de 8 horas durante o prazo de funcionamento da ANCINE.
     * @return int total de solicitações
     */
    public function kpi03(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("queue_create = 5 "
                        . "and queue_finish IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38)"
                        . "and date(finish_time) between :dtIni and :dtFim "
                        . "and (fncTime2ToInt(timeQueueSP) - fncTime2ToInt(timePendingQueueSP)) <= :time "
                        , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '28800', // 8 horas
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Chamados críticos de Hardware e Software
     * Meta 85% dos chamados resolvidos em até 4 horas, o restante, 15% 
     * dentro do menor prazo possível.
     * @return int total de solicitações
     */
    public function kpi04(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim "
                        . "and fncTime2ToInt(timeResolution) <= :time "
                        . "and queue_finish in (6,31,32,33,34) "
                        . "and service_id = :srv", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '14400', // 4 horas
                    ':srv' => '-1', // Serviço de Problemas de Hardware
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Chamados de Problemas de Hardware
     * Meta 85% dos chamados resolvidos ou encaminhadospara assistência 
     * técnica do fabricante ou representante em até 1 dia útil.O restante, 
     * 15% dentro do menor prazo possível.
     * @return int total de solicitações
     */
    public function kpi05(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_tickets_ola")
                ->where("date(finish_time) between :dtIni and :dtFim "
                        . "and fncTime2ToInt(time_move_ola) <= :time "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                        ':time' => '39600', // 11 horas
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Chamados de Problemas de Software
     * Meta 85% dos chamados resolvidos em até 1 dia útil.O restante, 
     * 15% dentro do menor prazo possível.
     * @return int total de solicitações
     */
    public function kpi06(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("queue_finish IN (6,31,32,33,34) "
                    . "and service_id IN (" . $this->idKPI06 .") "  // Serviço de Problemas Softwares
                    . "and fncTime2ToInt(timeQueueSP) <= :time "
                    . "and date(finish_time) between :dtIni and :dtFim "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                        ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                        ':time' => '39600', // 11 horas
                    ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Chamados para instalação de novas estações ou atualizações (upgrades)
     * Meta 85% dos chamados resolvidos em até 3 dias úteis. O restante, 
     * 15% dentro do menor prazo possível.
     * @return int total de solicitações
     */
    public function kpi07(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("queue_finish IN (6,31,32,33,34)"
                    . "and service_id IN (". $this->idKPI07 .")"  // Serviço de Instalação ou Atualizações Softwares
                    . "and fncTime2ToInt(timeQueueSP) <= :time "
                    . "and date(finish_time) between :dtIni and :dtFim "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                        ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                        ':time' => '118800', // 3 dias úteis
                    ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Chamados para instalação ou atualizações de software
     * Meta 85% dos chamados resolvidos em até 3 dias úteis. O restante, 
     * 15% dentro do menor prazo possível.
     * @return int total de solicitações
     */
    public function kpi08(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("queue_finish in (6,31,32,33,34) "
                    . "and service_id IN (". $this->idKPI08 .")"  // Serviço de Instalação ou Atualizações Softwares
                    . "and fncTime2ToInt(timeQueueSP) <= :time "
                    . "and date(finish_time) between :dtIni and :dtFim "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '118800', // 3 dias úteis
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Taxa de satisfação do usuário 2º Nível
     * Meta >= 7% (Escala: 0-10, sendo 10 o máximo)
     * @return int total de solicitações
     */
    public function kpi09(){
        $tickets = Yii::app()->dbANATEL->createCommand()
                ->select("COUNT(*) as qtd, SUM(satisfaction) as qtd_satisfaction, SUM(nosatisfaction) as qtd_nosatisfaction")
                ->from("vw_kpi_pqs")
                ->where("date(vote_time) between :dtIni and :dtFim "
                        . "and queue_finish IN (6,30,31,32,33,34) "
                        . "and question_id = 2 ", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets[0];
    }
    
}