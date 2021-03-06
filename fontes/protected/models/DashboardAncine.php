<?php

/**
 * DashboardAncine class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class DashboardAncine extends CFormModel {
    
    public $dtInicio;
    public $dtTermino;
    public $tipo;
    public $userId;
    public $userFullName;

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
            array('dtInicio, dtTermino, tipo', 'required', 'on' => 'report'),
            array('dtTermino', 'validarPeriodo'),
            array('dtInicio, dtTermino, tipo, userId, userFullName', 'safe'),
        );
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dtInicio' => 'Início',
            'dtTermino' => 'Término',
            'userId' => 'Atendente',
            'userFullName' => 'Atendente',
        );
    }
    
    /**
     * Retorna as informações globais
     * Total de Chamados Abertos e Fechados(Encerrados)
     * Total de Chamados Abertos e Fechados(Encerrados) na fila Central de Serviços
     * Total de Chamados Abertos e Fechados(Encerrados) na fila Suporte 2º Nível + Subfilas
     * Total de Chamados Abertos e Fechados(Encerrados) na fila Suporte 3º Nível + Subfilas
     * @return array
     */
    public function dash01Stats(){
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicio) . "' and '" .
                FksFormatter::StrToDate($this->dtTermino) . "' ";

        $sql = "select * ".
                "from ( ".
                "select count(t.id) as dash01_qtd_aberto from ticket t where date(t.create_time) between $sDate )t1,( ".
                "select count(t.ticket_id) as dash01_qtd_fechado from vw_tickets_encerrados t where date(t.finish_time) between $sDate )t2,( ".
                "select count(th.ticket_id) as dash02_qtd_aberto from ticket_history th where date(th.create_time) between $sDate and th.history_type_id = 1 and th.queue_id in (5) ".
                ")t3,( ".
                "select count(t.ticket_id) as dash02_qtd_fechado from vw_tickets_encerrados t where date(t.finish_time) between $sDate and t.queue_finish in (5) ".
                ")t4,( ".
                "select count(th.ticket_id) as dash03_qtd_aberto from ticket_history th where date(th.create_time) between $sDate and th.history_type_id = 1 and th.queue_id in (27,30,31,33,32,34) ".
                ")t5,( ".
                "select count(t.ticket_id) as dash03_qtd_fechado from vw_tickets_encerrados t where date(t.finish_time) between $sDate and t.queue_finish in (27,30,31,33,32,34) ".
                ")t6,(" .
                "select count(th.ticket_id) as dash04_qtd_aberto from ticket_history th where date(th.create_time) between $sDate and th.history_type_id = 1 AND th.queue_id IN (16,37) ".
                ")t7,( ".
                "select count(t.ticket_id) as dash04_qtd_fechado from vw_tickets_encerrados t where date(t.finish_time) between $sDate and t.queue_finish in (7,8,9,10,11,12,13,14,16,37) ".
                ")t8 ";

        $resultSet = Yii::app()->dbANCINE->createCommand($sql)->queryAll();
        return $resultSet;
    }
    
    /**
     * Retorna quantitavivos por Atendente dos papéis: 
     * Central de Serviço e Suporte 2ºNível
     * Total de Chamados Criados, Abertos Pendentes, Resolvidos e Encerrados
     * @return array
     */
    public function dash02Stats(){
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicio) . "' and '" .
                FksFormatter::StrToDate($this->dtTermino) . "' ";
        $sUserId = empty($this->userId) ? '' : " AND u.id = " . $this->userId . " ";
        $sql = "select " .
                "u.id, " .
                "concat(u.first_name,' ',u.last_name) as user_name, " .
                "tb1.qtd as qtd_criado, " .
                "tb2.qtd as qtd_encerrado, " .
                "tb3.qtd as qtd_aberto, " .
                "tb4.qtd as qtd_andamento, " .
                "tb5.qtd as qtd_pendente, " .
                "tb6.qtd as qtd_resolvido " .
                "from users u " .
                "left join ( " .
                "select create_by as user_id, count(*) as qtd " .
                "from ticket " .
                "where DATE(create_time) BETWEEN $sDate " .
                "group by create_by) as tb1 ON u.id = tb1.user_id " .
                "left join ( " .
                "select user_finish, count(*) as qtd " .
                "from vw_tickets_encerrados " .
                "where DATE(finish_time) BETWEEN $sDate " .
                "group by user_finish) as tb2 ON u.id = tb2.user_finish " .
                "left join ( " .
                "select user_id, count(*) as qtd " .
                "from ticket " .
                "where ticket_state_id = 4 AND DATE(change_time) BETWEEN $sDate " .
                "group by user_id) as tb3 ON u.id = tb3.user_id " .
                "left join ( " .
                "select user_id, count(*) as qtd " .
                "from ticket " .
                "where ticket_state_id = 2 AND DATE(change_time) BETWEEN $sDate " .
                "group by user_id) as tb4 ON u.id = tb4.user_id " .
                "left join ( " .
                "select user_id, count(*) as qtd " .
                "from ticket " .
                "where ticket_state_id = 6 AND DATE(change_time) BETWEEN $sDate " .
                "group by user_id) as tb5 ON u.id = tb5.user_id " .
                "left join ( " .
                "select user_id, count(*) as qtd " .
                "from ticket " .
                "where ticket_state_id = 3 AND DATE(change_time) BETWEEN $sDate " .
                "group by user_id) as tb6 ON u.id = tb6.user_id " .
                "where u.id in (select user_id from vw_user_role where role_id in (1,3,4,15,16)) $sUserId " .
                "order by user_name ASC";

        $resultSet = Yii::app()->dbANCINE->createCommand($sql)->queryAll();

        return $resultSet;
    }
    
    /**
     * Retorna quantitavivos por Atendente dos papéis: 
     * Central de Serviço e Suporte 2ºNível
     * @return array
     */
    public function dashAllAgents(){
        $sql = "select user_id, concat(first_name, ' ', last_name) as full_name from vw_user_role order by first_name";
        $resultSet = Yii::app()->dbANCINE->createCommand($sql)->queryAll();

        return $resultSet;
    }
    
    /**
 * Retorna a quantidade de chamados encerrados por fila
 * @return array
 */
    public function dash03Stats(){
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicio) . "' and '" .
            FksFormatter::StrToDate($this->dtTermino) . "' ";
        $sql = "select ".
            "q.name as queue_name, ".
            "count(te.ticket_id) as qtd ".
            "from vw_tickets_encerrados te ".
            "join queue q on te.queue_finish = q.id ".
            "where date(te.finish_time) between $sDate ".
            "group by q.id, q.name ".
            "order by q.name ";

        $resultSet = Yii::app()->dbANCINE->createCommand($sql)->queryAll();

        return $resultSet;
    }

    /**
     * Retorna a quantidade de chamados encaminhados por fila do 2º Nível
     * @return array
     */
    public function dash04ForwardedByQueue(){
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicio) . "' and '" .
            FksFormatter::StrToDate($this->dtTermino) . "' ";
        $sql = "select ".
            "q.name as queue_name, count(distinct th.ticket_id) as qtd ".
            "from ticket_history th ".
            "join queue q on th.queue_id = q.id ".
            "where th.history_type_id = 16 ".
            "and th.queue_id in (7,8,9,10,11,12,13,14,16,37) ".
            "and th.state_id = 4 ".
            "and date(th.create_time) between $sDate ".
            "group by q.name ".
            "order by q.name ";

        $resultSet = Yii::app()->dbANCINE->createCommand($sql)->queryAll();

        return $resultSet;
    }
    
    /**
     * Retorna SLA cumprido/violado por atendente dos papéis:
     * Central de Serviço e Suporte 2º Nível
     * @return array
     */
    public function dashSLAbyAgents() {
        $data = array();
        $idQueues = array(5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,37);
        $users = Yii::app()->dbANCINE->createCommand()
            ->select("DISTINCT u.id, concat(u.first_name,' ',u.last_name) AS user_fullname")
            ->from('users u')
            ->join('vw_user_role ur', 'u.id = ur.user_id and ur.role_id IN (1,3,4,15,16)')
            ->where('exists(select ticket_id from vw_tickets_encerrados where user_finish = u.id)')
            ->order('user_fullname')
            ->queryAll();
        $i = 0;
        foreach ($users as $item) {
            $data[$i]['id'] = $item['id'];
            $data[$i]['user_fullname'] = $item['user_fullname'];
            // retorna IN cumprido
            $rs = $this->slaAgent($item['id'],2,$idQueues);
            $data[$i]['qtd_in_filfull'] = $rs;
            // retorna SS cumpirdo
            $rs = $this->slaAgent($item['id'],4,$idQueues);
            $data[$i]['qtd_ss_filfull'] = $rs;
            // retorna IN violado
            $rs = $this->slaAgent($item['id'],2,$idQueues, FALSE);
            $data[$i]['qtd_in_violate'] = $rs;
            // retorna SS violado
            $rs = $this->slaAgent($item['id'],4,$idQueues, FALSE);
            $data[$i]['qtd_ss_violate'] = $rs;
            $i++;
        }
        return $data;
    }
    
    /**
     * Retorna a quantidade chamados Violados/Cumpridos por tipo, atendente e fila
     * @param int $idAgent
     * @param int $idType
     * @param array $idQueue
     * @param bool $filfull
     * @return array
     */
    private function slaAgent($idAgent, $idType, $idQueue, $filfull = TRUE) {
        $ret = Yii::app()->dbANCINE->createCommand()
            ->select('count(ticket_id) as qtd')
            ->from(($filfull ? 'vw_sla_fulfill' : 'vw_sla_violate'))
            ->where('type_id = :idType '.
                'and user_finish_id = :idUser '.
                'and queue_finish IN ('.FksUtils::arrayToList($idQueue).') '.
                'and date(finish_time) between :dtIni and :dtFim',array(
                ':idType' => $idType,
                ':idUser' => $idAgent,
                //':idQueue' => $this->arrayToList($idQueue),
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)))
            ->queryAll();
        return $ret[0]['qtd'];
    }
    
    /**
     * Retorna as estatísticas gerais padrão do sistema
     * @return array
     */
    public function dashTicketStatGeneral() {
        $ret = Yii::app()->dbANCINE->createCommand()
            ->select('*')
            ->from('vw_ticket_stat_general')
            ->order('qtd DESC')
            ->queryAll();
        return $ret;
    }
    
    /**
     * Retorna todas as perguntas da Pesquisa de Satisfação (Mestre)
     * @return array
     */
    public function dashPqsQuestions() {
        $ret = Yii::app()->dbANCINE->createCommand()
            ->select('*')
            ->from('vw_survey_questions')
            ->order('position')
            ->queryAll();
        return $ret;
    }
    
    /**
     * Retorna os quantitativos de resposta por pergunta da PQS
     * @param int $idQuestion
     * @return array
     */
    public function dashPqsAnswer($idQuestion) {
        $ret = Yii::app()->dbANCINE->createCommand()
            ->select('question_id, answer_id, answer, pos_answer, sum(amount) as amount, sum(amount_answered) as amount_answered, sum(amount_not_answered) as amount_not_answered')
            ->from('vw_survey_answers')
            ->where('question_id = :id and (date_vote between :dtIni and :dtFim or date_vote is null)', array(
                ':id' => $idQuestion,
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino)))
            ->group('question_id, answer_id, answer, pos_answer')
            ->order('pos_answer')
            ->queryAll();
        return $ret;
    }
}