<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 03/11/16
 * Time: 15:55
 */



/**
 * Dashboard class
 * This class is SQL commands for Dashboard(index) page
 *
 */
class DashboardGsi extends CFormModel
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
    public function dash01GstStats()
    {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sql = "select * " .
            "from ( " .
            "select count(t.id) as dash_qtd_aberto  " .
            "from ticket t " .
            "where date(t.create_time) between $sDate " .
            ")t1,( " .
            "select count(t.ticket_id) as dash_qtd_fechado " .
            "from vw_tickets_encerrados t " .
            "where date(t.finish_time) between $sDate " .
            ")t2";
        $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();

        return $resultSet;
    }
    /**
     * @internal Retorna a quantidade de tickets encerrados GSI I
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashGeralGSI_I() {
        {
            {
                $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
                    FksFormatter::StrToDate($this->dtFinal) . "' ";

                $sql = "SELECT * FROM(SELECT COUNT(*) AS dash01_qtd_aberto FROM vw_first_move fh
            JOIN ticket_history th ON (fh.history_id = th.id AND th.queue_id IN (8))
            WHERE DATE(th.create_time) BETWEEN $sDate) t1,
           (SELECT COUNT(t.ticket_id) AS dash01_qtd_fechado
            FROM vw_tickets_encerrados t
            WHERE DATE(t.finish_time) BETWEEN $sDate
            AND t.queue_finish IN (8)) t2;";

                $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();
                return $resultSet;
            }
        }
    }
    /**
     * @internal Retorna a quantidade de tickets encerrados GSI II
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashGeralGSI_II()
        {
            {
                $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
                    FksFormatter::StrToDate($this->dtFinal) . "' ";

                $sql = "SELECT * FROM(SELECT COUNT(*) AS dash02_qtd_aberto FROM vw_first_move fh
            JOIN ticket_history th ON (fh.history_id = th.id AND th.queue_id IN (9))
            WHERE DATE(th.create_time) BETWEEN $sDate) t1,
           (SELECT COUNT(t.ticket_id) AS dash02_qtd_fechado
            FROM vw_tickets_encerrados t
            WHERE DATE(t.finish_time) BETWEEN $sDate
            AND t.queue_finish IN (9)) t2;";

                $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();
                return $resultSet;
            }
        }

    /**
     * @internal Retorna a quantidade de tickets encerrados GSI II
     * @return integer Quantidade de tickets
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashGeralGSI_III()
    {
        {
            $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
                FksFormatter::StrToDate($this->dtFinal) . "' ";

            $sql = "SELECT * FROM(SELECT COUNT(*) AS dash03_qtd_aberto FROM vw_first_move fh
            JOIN ticket_history th ON (fh.history_id = th.id AND th.queue_id IN (10))
            WHERE DATE(th.create_time) BETWEEN $sDate) t1,
           (SELECT COUNT(t.ticket_id) AS dash03_qtd_fechado
            FROM vw_tickets_encerrados t
            WHERE DATE(t.finish_time) BETWEEN $sDate
            AND t.queue_finish IN (10)) t2;";

            $resultSet = Yii::app()->dbCVM->createCommand($sql)->queryAll();
            return $resultSet;
        }
    }

    /**
     * @internal Retorna estatistica dos Agentes TOP 10 GST
     * @return array
     * @param null
     * @author Franklin Farias
     *
     */
    public function dashEstatAgentesGSI() {
        $sDate = " '" . FksFormatter::StrToDate($this->dtInicial) . "' and '" .
            FksFormatter::StrToDate($this->dtFinal) . "' ";
        $sql = "select " .
            "	u.id, concat(u.first_name,' ',u.last_name) as user_name, " .
            "	tb1.qtd as qtd_atendido, " .
            "	tb2.qtd as qtd_encerrado, " .
            "	tb3.qtd as qtd_aberto,  " .
            "	tb5.qtd as qtd_pendente, " .
            "	tb6.qtd as qtd_resolvido, " .
            "   fncTempoAtendimentoAgente(u.id) as tempo_atendimento, " .
            "	'<span class=\"inlinebar\">1,3,4,5,3,5</span>' as stat " .
            "from users u " .
            "left join ( " .
            "	select th.create_by as user_id, count(th.ticket_id) as qtd " .
            "	from ticket_history th " .
            "	join ( " .
            "		select max(th.id) as history_id, ticket_id " .
            "		from ticket_history th " .
            "		where 1 = 1 " .
            "		and th.history_type_id = 27 " .
            "		and th.state_id = 12 " .
            "		group by th.ticket_id) tb1 on th.id = tb1.history_id " .
            "   where DATE(th.change_time) BETWEEN $sDate " .
            "	group by th.create_by) as tb1 ON u.id = tb1.user_id " .
            "left join ( " .
            "	select att.user_finish, count(*) as qtd " .
            "	from vw_tickets_encerrados te " .
            "	join (select distinct ticket_id, change_by as user_finish from ticket_history " .
            "	where state_id IN (3,12)) att on te.ticket_id = att.ticket_id " .
            "	where DATE(te.finish_time) BETWEEN $sDate " .
            "	group by att.user_finish) as tb2 ON u.id = tb2.user_finish " .
            "left join ( " .
            "	select t.user_id, count(t.id) as qtd " .
            "	from ticket t " .
            "	where 1=1 " .
            "    and t.ticket_state_id in (select id from ticket_state where type_id = 2) " .
            "	group by t.user_id) as tb3 ON u.id = tb3.user_id " .
            "left join ( " .
            "	select user_id, count(*) as qtd " .
            "	from ticket " .
            "	where ticket_state_id = 6 " .
            "	group by user_id) as tb5 ON u.id = tb5.user_id " .
            "left join ( " .
            "	select user_id, count(*) as qtd " .
            "	from ticket " .
            "	where ticket_state_id = 3 AND DATE(change_time) BETWEEN $sDate " .
            "	group by user_id) as tb6 ON u.id = tb6.user_id " .
            "where u.id IN (select user_id from vw_user_roles where role_id in (6,9,10,11)) " .
            "order by (coalesce(tb1.qtd,0) + coalesce(tb2.qtd,0)) DESC";
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


    public function dashGSIEncerrados() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd')
            ->from('vw_tickets_encerrados')
            ->where('queue_finish IN (7,8,9,10,13) AND DATE(finish_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicial),
                ':dtFim' => FksFormatter::StrToDate($this->dtFinal)))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    public function dashGSITicketsAbertos() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd')
            ->from('ticket')
            ->where('queue_id IN (7,8,9,10,13) ' .
                'AND ticket_state_id in (select id from ticket_state where type_id in (1,2)) '.
                'AND DATE(create_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicial),
                ':dtFim' => FksFormatter::StrToDate($this->dtFinal)))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    public function dashGSITicketsBloqueados() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd')
            ->from('ticket')
            ->where('ticket_lock_id in (1,3) '.
                'AND queue_id IN (7,8,9,10,13) '.
                'AND DATE(create_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicial),
                ':dtFim' => FksFormatter::StrToDate($this->dtFinal)))
            ->queryAll();
        return $ret[0]['qtd'];
    }
    public function dashGSITicketsPendente() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd')
            ->from('ticket')
            ->where('ticket_state_id in (select id from ticket_state where type_id in (4,5)) '.
                'AND queue_id IN (7,8,9,10) '.
                'AND DATE(create_time) BETWEEN :dtIni and :dtFim', array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicial),
                ':dtFim' => FksFormatter::StrToDate($this->dtFinal)))
            ->queryAll();
        return $ret[0]['qtd'];
    }

    public function dashAgentes() {
        $ret = Yii::app()->dbCVM->createCommand()
            ->select('COUNT(*) as qtd')
            ->from('users')
            ->where('valid_id = 1')
            ->queryAll();
        return $ret[0]['qtd'];
    }


}