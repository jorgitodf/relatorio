<?php

/**
 * KpiFunarte class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiFunarteOld extends CFormModel {
    
    public $dtInicio;
    public $dtTermino;
    public $ilha;

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
            array('dtInicio, dtTermino, ilha', 'required', 'on' => 'report'),
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
            'ilha' => 'Ilha',
        );
    }


    /**
     * Relatório Chamados INS0203.
     * @return array
     */
    public function rptKPIINS0203(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id,ticket,tipo,titulo,servico,type_id,service_id,ticket_state_id,prioridade,
                status,sla,solicitante,DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao,
                fila_criacao,DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner,
                user_name_first_owner,queue_name_first_owner,ticket_priority_id,sla_id,
                DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name,user_name_first_queue,tempo_first_atendimento,
                tempo_first_atendimento_second,data_resolucao")
            ->from("vw_ins_0203 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY tipo ASC ")
            ->queryAll();

        return $tickets;
    }


    /**
     * Relatório Chamados INS05.
     * @return array
     */
    public function rptKPIINS05(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id, type_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento")
            ->from("vw_all_tickets_requisicoes_ins05 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();


        return $tickets;
    }


    /**
     * Relatório Chamados INS06.
     * @return array
     */
    public function rptKPIINS06(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento")
            ->from("vw_all_tickets_indicentes_ins06 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        $qtd_alta = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_alta")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1 OR sla_id = 6)")
            ->queryAll();

        $qtd_media = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_media")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 4")
            ->queryAll();

        $qtd_baixa = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_baixa")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 5")
            ->queryAll();

        return $array = [$tickets, $qtd_alta[0]['qtd_alta'], $qtd_media[0]['qtd_media'], $qtd_baixa[0]['qtd_baixa']];
    }


    /**
     * @internal Retorna a lista de FAQ no período
     * @return integer Quantidade de FAQ
     * @param null
     *
     */
    public function rptFaq() {
        $ret = Yii::app()->dbFUNARTE->createCommand()
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
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)))
            ->queryAll();
        return $ret;
    }


    /**
     * Relatório Chamados INS09.
     * @return array
     */
    public function rptKPIINS09(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento")
            ->from("vw_all_tickets_tratados_ins09 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        $qtd_alta = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(ticket_id) AS qtd_alta")
            ->from("vw_all_tickets_resolvidos ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1 OR sla_id = 6)")
            ->queryAll();

        $qtd_media = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(ticket_id) AS qtd_media")
            ->from("vw_all_tickets_resolvidos ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 2)")
            ->queryAll();

        $qtd_baixa = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(ticket_id) AS qtd_baixa")
            ->from("vw_all_tickets_resolvidos ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 3)")
            ->queryAll();

        return $array = [$tickets, $qtd_alta[0]['qtd_alta'], $qtd_media[0]['qtd_media'], $qtd_baixa[0]['qtd_baixa']];
    }

    /**
     * Relatório Chamados INS11.
     * @return array
     */
    public function rptKPIINS11(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_primeiro_atendimento, tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento")
            ->from("vw_all_tickets_treated_period_ins11 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        $qtd_alta = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_alta")
            ->from("ticket ")
            ->where("date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1 OR sla_id = 6) ")
            ->queryAll();

        $qtd_media = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_media")
            ->from("ticket ")
            ->where("date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 2)")
            ->queryAll();

        $qtd_baixa = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_baixa")
            ->from("ticket ")
            ->where("date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 3)")
            ->queryAll();

        return $array = [$tickets, $qtd_alta[0]['qtd_alta'], $qtd_media[0]['qtd_media'], $qtd_baixa[0]['qtd_baixa']];
    }


    /**
     * Relatório Chamados INS12.
     * @return array
     */
    public function rptKPIINS12(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id,ticket,tipo,titulo,servico,type_id,service_id,ticket_state_id,prioridade,
                status,sla,solicitante,DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao,
                fila_criacao,DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner,user_name_first_owner,
                queue_name_first_owner,ticket_priority_id,sla_id,DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name,user_name_first_queue")
            ->from("vw_ins_12 ")
            ->where("type_id = 4 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND date(data_criacao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY id ASC ")
            ->queryAll();

        $qtd_vip = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_vip")
            ->from("ticket ")
            ->where("type_id = 4 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1)")
            ->queryAll();

        $qtd_media = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_media")
            ->from("ticket ")
            ->where("type_id = 4 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 2)")
            ->queryAll();

        $qtd_baixa = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_baixa")
            ->from("ticket ")
            ->where("type_id = 4 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 3)")
            ->queryAll();

        $qtd_alta = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_alta")
            ->from("ticket ")
            ->where("type_id = 4 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 6)")
            ->queryAll();

        return $array = [$tickets, $qtd_vip[0]['qtd_vip'], $qtd_media[0]['qtd_media'], $qtd_baixa[0]['qtd_baixa'], $qtd_alta[0]['qtd_alta']];
    }


    /**
     * Relatório Chamados INS13.
     * @return array
     */
    public function rptKPIINS13(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id,ticket,tipo,titulo,servico,type_id,service_id,ticket_state_id,prioridade,
                status,sla,solicitante,DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao,
                fila_criacao,DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner,user_name_first_owner,
                queue_name_first_owner,ticket_priority_id,sla_id,DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name,user_name_first_queue")
            ->from("vw_ins_13 ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND date(data_criacao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY id ASC ")
            ->queryAll();

        $qtd_vip = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_vip")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1)")
            ->queryAll();

        $qtd_media = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_media")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 4)")
            ->queryAll();

        $qtd_baixa = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_baixa")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 5)")
            ->queryAll();

        $qtd_alta = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_alta")
            ->from("ticket ")
            ->where("type_id = 2 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 6)")
            ->queryAll();

        return $array = [$tickets, $qtd_vip[0]['qtd_vip'], $qtd_media[0]['qtd_media'], $qtd_baixa[0]['qtd_baixa'], $qtd_alta[0]['qtd_alta']];
    }

    /**
     * Relatório Chamados INS14.
     * @return array
     */
    public function rptKPIINS14(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento")
            ->from("vw_all_tickets_problemas_ins14 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();


        $qtd_alta = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_alta")
            ->from("ticket ")
            ->where("type_id = 5 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1 OR sla_id = 6)")
            ->queryAll();

        $qtd_media = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_media")
            ->from("ticket ")
            ->where("type_id = 5 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1 OR sla_id = 6)")
            ->queryAll();

        $qtd_baixa = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(id) AS qtd_baixa")
            ->from("ticket ")
            ->where("type_id = 5 AND date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND (sla_id = 1 OR sla_id = 6)")
            ->queryAll();

        return $array = [$tickets, $qtd_alta[0]['qtd_alta'], $qtd_media[0]['qtd_media'], $qtd_baixa[0]['qtd_baixa']];
    }


    /**
     * Relatório Chamados INS15.
     * @return array
     */
    public function rptKPIINS15(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id, type_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento, check_ticket")
            ->from("vw_ins_15 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();


        return $tickets;
    }


    /**
     * Relatório Chamados INS16.
     * @return array
     */
    public function rptKPIINS16(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, prioridade, status, sla_id, sla,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento, DATE_FORMAT(data_nota, '%d/%m/%Y %H:%i:%s') AS data_nota")
            ->from("vw_all_tickets_resolved_with_actions_ins16 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();
        return $tickets;
    }

    /**
     * Relatório Chamados INS17.
     * @return array
     */
    public function rptKPIINS17(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id,ticket,titulo,tipo,servico,prioridade,email_customer,customer,
                DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao,
                fila_criacao,DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner,
                user_name_first_owner,queue_name_first_owner,DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name,user_name_first_queue,DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao,user_name_resolucao,fila_atendimento,DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento,sla, status, sla_id")
            ->from("vw_ins_17 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' ")
            ->queryAll();
        return $tickets;
    }


    /**
     * Relatório Chamados INS18.
     * @return array
     */
    public function rptKPIINS18() {
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, prioridade, status, 
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento, ticket_next_day")
            ->from("vw_all_tickets_without_negotiation_same_day_ins18 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        $qtd_tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(ticket_id) AS qtd_ticket")
            ->from("vw_all_tickets_resolvidos ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' ")
            ->queryAll();

        return $array = [$tickets, $qtd_tickets[0]['qtd_ticket']];
    }


    /**
     * Relatório Chamados INS23.
     * @return array
     */
    public function rptKPIINS23(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id,ticket,tipo,titulo,servico,service_id,prioridade,status,solicitante,
                DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao,
                fila_criacao,DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner,
                user_name_first_owner,queue_name_first_owner,DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name,user_name_first_queue,DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao,user_name_resolucao,queue_id_resolucao,check_email,sla_id,sla,tempo_envio_email, tempo_envio_email_second")
            ->from("vw_ins_23 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        return $tickets;
    }

    /**
     * Respostas da pesquisa de satisfação que consideram o
     * atendimento “Ruim/Péssimo”
     * @return array qtd_satisfaction e qtd_nosatisfaction
     */
    public function rptRTAPqs(){
        $pqs = Yii::app()->dbFUNARTE->createCommand()
            ->select("tn, ticket_id, title, type_name, queue_finish_name, user_finish, send_to, 
                DATE_FORMAT(send_time, '%d/%m/%Y %H:%i:%s') AS send_time, DATE_FORMAT(vote_time, '%d/%m/%Y %H:%i:%s') AS vote_time,
                public_survey_key, question, answer, satisfaction, nosatisfaction, regular, sla_id")
            ->from("vw_kpi_pqs ")
            ->where("date(vote_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' ")
            ->queryAll();

        $qtd_ticketsV = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(sr.ticket_id) AS qtd_nao_respondidos_vip")
            ->from("survey_request sr ")
            ->join("ticket t", "t.id = sr.ticket_id")
            ->where("date(sr.send_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
            . "AND sla_id = 1 AND sr.vote_time IS NULL")
            ->queryAll();

        $qtd_ticketsP2 = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(sr.ticket_id) AS qtd_nao_respondidos_p2")
            ->from("survey_request sr ")
            ->join("ticket t", "t.id = sr.ticket_id")
            ->where("date(sr.send_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 2 AND sr.vote_time IS NULL")
            ->queryAll();

        $qtd_ticketsP3 = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(sr.ticket_id) AS qtd_nao_respondidos_p3")
            ->from("survey_request sr ")
            ->join("ticket t", "t.id = sr.ticket_id")
            ->where("date(sr.send_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 3 AND sr.vote_time IS NULL")
            ->queryAll();

        $qtd_ticketsP4 = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(sr.ticket_id) AS qtd_nao_respondidos_p4")
            ->from("survey_request sr ")
            ->join("ticket t", "t.id = sr.ticket_id")
            ->where("date(sr.send_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 4 AND sr.vote_time IS NULL")
            ->queryAll();

        $qtd_ticketsP5 = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(sr.ticket_id) AS qtd_nao_respondidos_p5")
            ->from("survey_request sr ")
            ->join("ticket t", "t.id = sr.ticket_id")
            ->where("date(sr.send_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 5 AND sr.vote_time IS NULL")
            ->queryAll();

        $qtd_ticketsP6 = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(sr.ticket_id) AS qtd_nao_respondidos_p6")
            ->from("survey_request sr ")
            ->join("ticket t", "t.id = sr.ticket_id")
            ->where("date(sr.send_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 6 AND sr.vote_time IS NULL")
            ->queryAll();

        return $array = [$pqs, $qtd_ticketsV[0]['qtd_nao_respondidos_vip'], $qtd_ticketsP2[0]['qtd_nao_respondidos_p2'], $qtd_ticketsP3[0]['qtd_nao_respondidos_p3'],
            $qtd_ticketsP4[0]['qtd_nao_respondidos_p4'], $qtd_ticketsP5[0]['qtd_nao_respondidos_p5'], $qtd_ticketsP6[0]['qtd_nao_respondidos_p6']];
    }


    /**
     * Relatório Chamados INS26.
     * @return array
     */
    public function rptKPIINS26(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, prioridade, status, 
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_primeiro_atendimento, tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento, time_first_tratamento, time_first_tratamento_second")
            ->from("vw_average_time_between_notifying_problem_of_all_tickets_ins26 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        $qtd_tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("COUNT(ticket_id) AS qtd_ticket")
            ->from("vw_all_tickets_resolvidos ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' ")
            ->queryAll();

        return $array = [$tickets, $qtd_tickets[0]['qtd_ticket']];
    }


    /**
     * Relatório Chamados INS27.
     * @return array
     */
    public function rptKPIINS27(){
        $tickets = Yii::app()->dbFUNARTE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao,
                fila_atendimento, DATE_FORMAT(data_atendimento, '%d/%m/%Y %H:%i:%s') AS data_atendimento,
                user_name_atendimento, tempo_fila_atendimento")
            ->from("vw_all_tickets_rdm_ins27 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY ticket ASC ")
            ->queryAll();

        return $tickets;
    }


    /**
     * Relatório Chamados com SLA's Centra de Serviços Funarte.
     * @return array
     */
    public function rptKPIReportCSF(){
        Yii::app()->dbFunarte->createCommand("CALL sp_insert_tickets_first_owner()")->execute();
        $tickets = Yii::app()->dbFunarte->createCommand()
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
        $tickets = Yii::app()->dbFunarte->createCommand()
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
        $tickets = Yii::app()->dbFunarte->createCommand()
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
        $tickets = Yii::app()->dbFunarte->createCommand()
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
        $tickets = Yii::app()->dbFunarte->createCommand()
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
        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 8 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_1() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 12 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_2() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 12);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 16 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_3() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 16);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 18 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_4() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 18);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 24 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_5() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 24);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
 * dentro do prazo de 42 horas durante o prazo de funcionamento da Funarte.
 * @return int total de solicitações
 */
    public function kpi02_6() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 42);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 48 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_7() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 48);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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
     * dentro do prazo de 56 horas durante o prazo de funcionamento da Funarte.
     * @return int total de solicitações
     */
    public function kpi02_8() {
        $dados = array('qtd'=>'', 'qtd_total'=>'');
        $time = (3600 * 56);
        $ticket = Yii::app()->dbFunarte->createCommand()
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

        $tickets = Yii::app()->dbFunarte->createCommand()
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