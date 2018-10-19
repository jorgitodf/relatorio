<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 29/09/16
 * Time: 10:05
 */


/**
 * Dashboard class
 * This class is SQL commands for Dashboard(index) page
 *
 */
class DashboardCvm extends CFormModel
{

    public $dtInicial;
    public $dtFinal;
    public $ticketsAbertos;
    public $ticketsAbertosFila;
    public $ticketsEncerrados;
    public $ticketsEncerradosFila;
    public $userId;
    public $tipo;


    /**
     * Valida data de Início e Término
     * @param type $attribute
     * @param type $params
     */
    public function validarPeriodo($attribute, $params)
    {
        if (!empty($this->dtInicial) && !empty($this->dtFinal)) {
            $dt1 = new DateTime(FksFormatter::formatarDateToSQLDate($this->dtInicial));
            $dt2 = new DateTime(FksFormatter::formatarDateToSQLDate($this->dtFinal));
            if ($dt1 > $dt2) {
                $this->addError($attribute, 'Data de Término deve ser maior que Data de Início!');
            }
        }
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dtInicial, dtFinal', 'required', 'on' => 'search'),
            array('dtInicial, dtFinal, tipo', 'required', 'on' => 'report'),
            array('dtFinal', 'validarPeriodo'),
            array('dtInicial, dtFinal, tipo, userId, userFullName', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'dtInicial' => 'Início',
            'dtFinal' => 'Término',
            'userId' => 'Atendente',
            'userFullName' => 'Atendente',
        );
    }

    /**
     * @internal Retorna a quantidade de tickets encerrados
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dash01Stats()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sql = "select * " .
            "from ( " .
            "select count(t.id) as dash01_qtd_aberto  " .
            "from ticket t " .
            "where date(t.create_time) between $sDate " .
            ")t1,( " .
            "select count(t.ticket_id) as dash01_qtd_fechado " .
            "from vw_tickets_encerrados t " .
            "where date(t.finish_time) between $sDate " .
            ")t2";
        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();

        return $resultSet;
    }


    /**
     * Retorna quantitavivos por Atendente dos papéis:
     * Central de Serviço e Suporte 2ºNível
     * Total de Chamados Criados, Abertos Pendentes, Resolvidos e Encerrados
     * @return array
     */
    public function dash02Stats()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sUserId = empty($this->userId) ? '' : " AND u.user_id = " . $this->userId . " ";
        $sql = "select " .
            "u.* " .
            ",t1.qtd as qtd_criado " .
            ",t2.qtd as qtd_aberto " .
            ",t3.qtd as qtd_pendente " .
            ",t4.qtd as qtd_resolvido " .
            ",t5.qtd as qtd_encerrado " .
            "from vw_user_role u " .
            "left join ( " .
            "select create_by as user_id, count(*) as qtd  " .
            "from ticket  " .
            "where DATE(create_time) BETWEEN $sDate " .
            "group by create_by " .
            ") t1 on u.user_id = t1.user_id " .
            "left join ( " .
            "select user_id as user_id, count(*) as qtd  " .
            "from ticket  " .
            "where DATE(create_time) BETWEEN $sDate " .
            "and ticket_state_id in (select id from ticket_state where type_id = 2) " .
            "group by user_id " .
            ") t2 on u.user_id = t2.user_id " .
            "left join ( " .
            "select user_id as user_id, count(*) as qtd  " .
            "from ticket  " .
            "where DATE(create_time) BETWEEN $sDate " .
            "and ticket_state_id in (select id from ticket_state where type_id = 4) " .
            "group by user_id " .
            ") t3 on u.user_id = t3.user_id " .
            "left join ( " .
            "select user_id as user_id, count(*) as qtd  " .
            "from ticket  " .
            "where DATE(create_time) BETWEEN $sDate " .
            "and ticket_state_id in (3) " .
            "group by user_id " .
            ") t4 on u.user_id = t4.user_id " .
            "left join ( " .
            "select user_finish as user_id, count(*) as qtd  " .
            "from vw_tickets_encerrados  " .
            "where DATE(finish_time) BETWEEN $sDate " .
            "group by user_finish " .
            ") t5 on u.user_id = t5.user_id " .
            "where u.role_id in (1,2) $sUserId ORDER BY u.first_name";

        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();

        return $resultSet;
    }


    /**
     * Retorna a quantidade de chamados encerrados por fila
     * @return array
     */
    public function dash03Stats()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sql = "select " .
            "q.name as queue_name, " .
            "count(te.ticket_id) as qtd " .
            "from vw_tickets_encerrados te " .
            "join queue q on te.queue_finish = q.id " .
            "where date(te.finish_time) between $sDate " .
            "group by q.id, q.name " .
            "order by q.name ";

        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();

        return $resultSet;
    }
    /**
     * Retorna a quantidade de chamados encaminhados por fila do 2º Nível
     * @return array
     */
    public function dash04ForwardedByQueue(){
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sql = "select ".
            "q.name as queue_name, count(distinct th.ticket_id) as qtd ".
            "from ticket_history th ".
            "join queue q on th.queue_id = q.id ".
            "where th.history_type_id = 16 ".
            "and th.queue_id in (1,2,3,4,5,6,7,8,10,13,14,15,16,18,20,24) ".
            "and th.state_id = 4 ".
            "and date(th.create_time) between $sDate ".
            "group by q.name ".
            "order by q.name ";

        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();

        return $resultSet;
    }


    /**
     * Retorna SLA cumprido/violado por atendente dos papéis:
     * Central de Serviço e Suporte 2º Nível
     * @return array
     */
    public function dashSLAbyAgents()
    {
        $data = array();
        $idQueues = array(1,2,3,4,5,6,7,8,10,13,14,15,16,18,20,24);
        $users = Yii::app()->dbCVM->createCommand()
            ->select("u.id, concat(u.first_name,' ',u.last_name) AS user_fullname")
            ->from('users u')
            ->join('vw_user_roles ur', 'u.id = ur.user_id and ur.role_id IN (1,2)')
            ->where('exists(select ticket_id from vw_tickets_encerrados where user_finish = u.id)')
            ->order('user_fullname')
            ->queryAll();
        $i = 0;
        foreach ($users as $item) {
            $data[$i]['id'] = $item['id'];
            $data[$i]['user_fullname'] = $item['user_fullname'];
            // retorna IN cumprido
            $rs = $this->slaAgent($item['id'], 2, $idQueues);
            $data[$i]['qtd_in_filfull'] = $rs;
            // retorna SS cumpirdo
            $rs = $this->slaAgent($item['id'], 4, $idQueues);
            $data[$i]['qtd_ss_filfull'] = $rs;
            // retorna IN violado
            $rs = $this->slaAgent($item['id'], 2, $idQueues, FALSE);
            $data[$i]['qtd_in_violate'] = $rs;
            // retorna SS violado
            $rs = $this->slaAgent($item['id'], 4, $idQueues, FALSE);
            $data[$i]['qtd_ss_violate'] = $rs;
            $i++;
        }
        return $data;
    }

    /**
     * @internal Retorna a quantidade de tickets encerrados na Central de Servicos
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashGeralCS()
    {

        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";

        $sql = "SELECT * FROM (SELECT COUNT(*) AS dash02_qtd_aberto FROM vw_first_history fh JOIN ticket_history th ON (fh.history_id = th.id AND th.queue_id IN (1,18)) WHERE DATE(th.create_time) BETWEEN $sDate) t1,
(SELECT COUNT(t.ticket_id) AS dash02_qtd_fechado FROM vw_tickets_encerrados t WHERE DATE(t.finish_time) between $sDate AND t.queue_finish IN (1 , 18)) t2;SELECT * FROM (SELECT COUNT(*) AS dash02_qtd_aberto FROM vw_first_history fh JOIN ticket_history th ON (fh.history_id = th.id AND th.queue_id IN (1 , 18)) WHERE DATE(th.create_time) BETWEEN $sDate) t1,
(SELECT COUNT(t.ticket_id) AS dash02_qtd_fechado FROM vw_tickets_encerrados t WHERE DATE(t.finish_time) between $sDate AND t.queue_finish IN (1 , 18)) t2;";

        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();
        return $resultSet;

    }


    /**
     * @internal Retorna a quantidade de tickets encerrados Suporte Local
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashGeralSP()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";

        $sql = "SELECT * FROM (SELECT COUNT(*) AS dash03_qtd_aberto FROM vw_tickets_encerrados t
				WHERE DATE(t.create_time) BETWEEN $sDate AND t.create_time IN (2,3,4,19,20)) t1,
				(SELECT COUNT(t.ticket_id) AS dash03_qtd_fechado FROM vw_tickets_encerrados t 
                WHERE DATE(t.finish_time) between $sDate AND t.queue_finish IN (2,3,4,19,20)) t2;
                ";

        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();
        return $resultSet;
    }


    /**
     * @internal Retorna a quantidade de tickets encerrados nas outras filas
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashOutros()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";

        $sql = "SELECT COUNT(*) AS dash04_qtd_fechado FROM otrs_cvm.vw_tickets_encerrados WHERE DATE(create_time) BETWEEN $sDate
        AND queue_finish not IN (1,2,3,4,12,18,19,20);";

        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();
        return $resultSet;
    }

    /**
     * @internal Retorna estatistica dos Agentes TOP 10
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashEstatAgentes()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sUserId = empty($this->userId) ? '' : " AND u.user_id = " . $this->userId . " ";
        $sql = "select " .
            "u.id, concat(u.first_name,' ',u.last_name) as user_name, " .
            "tb1.qtd as qtd_create, " .
            "tb2.qtd as qtd_closed, " .
            "tb3.qtd as qtd_aberto, " .
            "tb4.qtd as qtd_andamento, " .
            "tb5.qtd as qtd_pendente, " .
            "tb6.qtd as qtd_resolvido, " .
            "'<span class=\"inlinebar\">1,3,4,5,3,5</span>' as stat " .
            "from users u " .
            "left join ( " .
            "select create_by as user_id, count(*) as qtd " .
            "from ticket  " .
            "where DATE(create_time) BETWEEN  $sDate  " .
            "group by create_by) as tb1 ON u.id = tb1.user_id " .
            "left join ( " .
            "select user_finish, count(*) as qtd " .
            "from vw_tickets_encerrados  " .
            "where DATE(finish_time) BETWEEN $sDate  " .
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
            //"where u.id IN (3,4,5,7,8,10,34,37,44,45,56,59,60) " .
            "where u.id in (select user_id from vw_user_roles where role_id in (1,18,4,3,2)) " .
            "$sUserId order by (coalesce(tb1.qtd,0) + coalesce(tb2.qtd,0)) DESC ";
        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();

        return $resultSet;
    }


    /**
     * Retorna as estatísticas gerais padrão do sistema
     * @return array
     */
    public function dashTicketStatGeneral()
    {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('*')
            ->from('vw_ticket_stat_general')
            ->order('qtd DESC')
            ->queryAll();
        return $ret;
    }

    /**
     * Retorna a quantidade chamados Violados/Cumpridos por tipo, atendente e fila
     * @param int $idAgent
     * @param int $idType
     * @param array $idQueue
     * @param bool $filfull
     * @return array
     */
    private function slaAgent($idAgent, $idType, $idQueue, $filfull = TRUE)
    {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('count(ticket_id) as qtd')
            ->from(($filfull ? 'vw_sla_fulfill' : 'vw_sla_violate'))
            ->where('type_id = :idType ' .
                'and user_finish_id = :idUser ' .
                'and queue_finish IN (' . FksUtils::arrayToList($idQueue) . ') ' .
                'and date(finish_time) between :dtIni and :dtFim', array(
                ':idType' => $idType,
                ':idUser' => $idAgent,
                //':idQueue' => $this->arrayToList($idQueue),
                ':dtIni' => FksFormatter::StrToDate($this->dtInicial),
                ':dtFim' => FksFormatter::StrToDate($this->dtFinal)))
            ->queryAll();
        return $ret[0]['qtd'];
    }
    
    /**
     * Retorna todas as perguntas da Pesquisa de Satisfação (Mestre)
     * @return array
     */
    public function dashPqsQuestions() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('*')
            ->from('vw_survey_questions')
            ->where('survey_id not in (1)')
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
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('question_id, answer_id, answer, pos_answer, sum(amount) as amount, sum(amount_answered) as amount_answered, sum(amount_not_answered) as amount_not_answered')
            ->from('vw_survey_answers_new')
            ->where('question_id = :id and (date_vote between :dtIni and :dtFim or date_vote is null)', array(
                ':id' => $idQuestion,
                ':dtIni' => FksFormatter::StrToDate($this->dtInicial),
                ':dtFim' => FksFormatter::StrToDate($this->dtFinal)))
            ->group('question_id, answer_id, answer, pos_answer')
            ->order('pos_answer')
            ->queryAll();
        return $ret;
    }
}
