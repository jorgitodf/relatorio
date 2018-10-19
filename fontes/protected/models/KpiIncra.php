<?php

/**
 * KpiIncra class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiIncra extends CFormModel {
    
    public $dtInicio;
    public $dtTermino;
    public $tipo;


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
            array('dtInicio, dtTermino, tipo', 'safe'),
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
    public function rptRTA(){
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("ticket_id,tn,title,create_time,type_id,type_name,priority_id,priority_name,state_id,state_name,
            service_id,service_name,queue_create,queue_create_name,queue_finish,queue_finish_name,finish_time,user_finish_id,
            user_finish,TIME_FORMAT(timePending, '%T') AS timePending, TIME_FORMAT(timeResolution, '%T') AS timeResolution")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim ", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();

        return $tickets;
    }

    /**
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptRTA10(){
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("ticket_id,tn,title,create_time,type_id,type_name,priority_id,priority_name,state_id,state_name,
            service_id,service_name,queue_create,queue_create_name,queue_finish,queue_finish_name,finish_time,user_finish_id,
            user_finish,TIME_FORMAT(timePending, '%T') AS timePending, TIME_FORMAT(timeResolution, '%T') AS timeResolution")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim AND priority_id IN (4,5) ", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->queryAll();

        return $tickets;
    }
    
    /**
     * Solicitações globais resolvidas no periodo.
     * @return array
     */
    public function rptRTADET2(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("*")
                ->from("vw_kpi_det2")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
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
        $pqs = Yii::app()->dbINCRA->createCommand()
                ->select("*")
                ->from("vw_kpi_pqs")
                ->where("date(vote_time) between :dtIni and :dtFim "
                    . "and queue_finish IN (1,2,3,6) ", array(
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
    public function rptRTAPqsDET2(){
        $pqs = Yii::app()->dbINCRA->createCommand()
                ->select("*")
                ->from("vw_kpi_pqs")
                ->where("queue_finish in (9,10,11,12,13,14,15,16,17,18,24) "
                        . "and date(vote_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $pqs;
    }
    
    /**
     * Solicitações globais escalonadas em tempo superior a 30(trinta) minutos
     * @return array qtd_total e qtd_escalonada
     */
    public function rptRTAEscalado(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("*")
                ->from("vw_kpi_escalonado")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets;
    }
    
    /**
     * Solicitações globais classificadas incorretamente
     * @return array qtd reclassificado
     */
    public function rptRTAReclassificado(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("kpi.*, coalesce(r.ticket_id,0) as reclassified")
                ->from("vw_kpi kpi")
                ->leftJoin("vw_reclassified r",'kpi.ticket_id = r.ticket_id')
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets;
    }
    
    /**
     * Total de solicitações globais fechadas sem autorização do usuário, 
     * dividido pelo total de solicitações recebidas, multiplicado por 
     * 100 (cem). Meta <= 3.
     * @return array qtd notificacao
     */
    public function rptRTANotificacao(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("kpi.*, coalesce(n.ticket_id,0) as notified")
                ->from("vw_kpi kpi")
                ->leftJoin("vw_notify_resolution n",'kpi.ticket_id = n.ticket_id')
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets;
    }
    
    /**
     * Solicitações globais reabertas
     * @return array qtd notificacao
     */
    public function rptRTAReaberto(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("kpi.*, coalesce(r.qtd_reopen,0) as reopen")
                ->from("vw_kpi kpi")
                ->leftJoin('vw_reopen r','kpi.ticket_id = r.ticket_id')
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets;
    }
    
    /**
     * Solicitações resolvidas em até 4 (quatro) horas
     * Total de solicitações globais resolvidas em até 4 (quatro) horas 
     * da abertura do chamado, dividido pelo total de solicitações recebidas, 
     * multiplicado por 100 (cem). Meta >= 80.
     * @return int total de solicitações
     */
    public function kpiTotal(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Solicitações resolvidas em até 4 (quatro) horas
     * Total de solicitações globais resolvidas em até 4 (quatro) horas 
     * da abertura do chamado, dividido pelo total de solicitações recebidas, 
     * multiplicado por 100 (cem). Meta >= 80.
     * @return int total de solicitações
     */
    public function kpi01(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim and (fncTime2ToInt(timeResolution)-fncTime2ToInt(timePending)) <= :time", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '14400',
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }

    public function totalHorasPendentes($idTicket) {
        $horas = Yii::app()->dbINCRA->createCommand()
            ->select("fncTotalHorasPendentes(1, $idTicket)")
            ->queryAll();
        return $horas;
    }
    
    /**
     * Total de solicitações resolvidas globais em até 08 (oito) horas do seu 
     * recebimento, dividido pelo total de solicitações recebidas, 
     * multiplicado por 100 (cem). Meta >= 90.
     * @return int total de solicitações
     */
    public function kpi02(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim and (fncTime2ToInt(timeResolution)-fncTime2ToInt(timePending)) <= :time", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '28800',
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Total de solicitações globais resolvidas em até 12 (doze) horas do seu 
     * recebimento, dividido pelo total de solicitações recebidas, 
     * multiplicado por 100 (cem). Meta >= 95.
     * @return int total de solicitações
     */
    public function kpi03(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim and (fncTime2ToInt(timeResolution)-fncTime2ToInt(timePending)) <= :time", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '43200',
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Total de solicitações globais resolvidas em até 3 (três) dias úteis do 
     * seu recebimento, dividido pelo total de solicitações recebidas, 
     * multiplicada por 100 (cem). Meta >= 99.
     * @return int total de solicitações
     */
    public function kpi04(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim and (fncTime2ToInt(timeResolution)-fncTime2ToInt(timePending)) <= :time", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '57600', // 8h * 3d = 16h
                ))
                ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Total de respostas da pesquisa de satisfação que consideram o 
     * atendimento “Ruim/Péssimo”, dividido pelo total geral de respostas da 
     * pesquisa de satisfação, multiplicado por 100 (cem). Meta <= 8.
     * @return array qtd_satisfaction e qtd_nosatisfaction
     */
    public function kpi05(){
        $pqs = Yii::app()->dbINCRA->createCommand()
                ->select("count(satisfaction) as qtd_satisfaction, count(nosatisfaction) as qtd_nosatisfaction")
                ->from("vw_kpi_pqs")
                ->where("question_id <> 10 AND queue_finish IN (1,2,3,5,6,7,8) and date(vote_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $pqs[0];
    }
    
    /**
     * Total de solicitações globais escalonadas em tempo superior a 
     * 30(trinta) minutos, dividido pelo total de solicitações escalonadas, 
     * multiplicado por 100 (cem). Meta <= 10.
     * @return array qtd_total e qtd_escalonada
     */
    public function kpi06(){
        $pqs = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_kpi_escalonado")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        $qtdTotal = $pqs[0]['qtd'];
        $pqs = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_kpi_escalonado")
                ->where("date(finish_time) between :dtIni and :dtFim and (fncTime2ToInt(time_move)-fncTime2ToInt(timePendingCS)) > :time", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '1800', // 30min = 1800
                ))
                ->queryAll();
        $totalEscala = $pqs[0]['qtd'];
        
        return array('qtd_total' => $qtdTotal, 'qtd_escalonada' => $totalEscala);
    }
    
    /**
     * Total de solicitações globais classificadas incorretamente, dividido 
     * pelo total de solicitações recebidas, multiplicado por 100 (cem). Meta <= 5.
     * @return array qtd reclassificado
     */
    public function kpi07(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_kpi_reclassificado")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets[0]['qtd'];
    }
    
    /**
     * Total de solicitações globais fechadas sem autorização do usuário, 
     * dividido pelo total de solicitações recebidas, multiplicado por 
     * 100 (cem). Meta <= 3.
     * @return array qtd notificacao
     */
    public function kpi08(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_kpi_notificacao")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets[0]['qtd'];
    }
    
    /**
     * Total de solicitações globais reabertas, dividido pelo total de 
     * solicitações recebidas, multiplicado por 100 (cem). Meta <= 3.
     * @return array qtd notificacao
     */
    public function kpi09(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_tickets_reabertos")
                ->where("date(finish_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        
        return $tickets[0]['qtd'];
    }
    
    /**
     * Total de solicitações de criticidade “alta” resolvidas em até 
     * 1 (uma) horas da abertura do chamado, dividido pelo total de 
     * solicitações de criticidade “alta” recebidas, multiplicado por 
     * 100 (cem). Meta >= 90.
     * @return array qtd_total e qtd_criticidade
     */
    public function kpi10(){
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim "
                        . "and priority_id in (4,5)", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();
        $qtdTotal = $tickets[0]['qtd'];
        $tickets = Yii::app()->dbINCRA->createCommand()
                ->select("count(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("date(finish_time) between :dtIni and :dtFim "
                        . "and (fncTime2ToInt(timeResolution)-fncTime2ToInt(timePending)) <= :time "
                        . "and priority_id in (4,5)", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                    ':time' => '3600', // 1h = 3600
                ))
                ->queryAll();
        $totalPriority = $tickets[0]['qtd'];
        
        return array('qtd_total' => $qtdTotal, 'qtd_criticidade' => $totalPriority);
    }

    
    public function kpiTotalDET02(){
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("count(ticket_id) as qtd, sla_id")
            ->from("vw_kpi_det2")
            ->where("date(finish_time) between :dtIni and :dtFim", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
            ))
            ->group('sla_id')
            ->queryAll();
        $rs = array('Critico' => 0, 'Urgente'=>0,'Rotina'=>0);
        foreach ($tickets as $value){
            if ($value['sla_id'] == 1){
                $rs['Critico'] = $value['qtd'];
            }
            if ($value['sla_id'] == 2){
                $rs['Urgente'] = $value['qtd'];
            }
            if ($value['sla_id'] == 3){
                $rs['Rotina'] = $value['qtd'];
            }
        }
        
        return $rs;
    }

    /**
     * Total de respostas da pesquisa de satisfação que consideram o 
     * atendimento bom e ótimo no mês calendário dividido pelo total de 
     * respostas da pesquisa de satisfação no mês calendário, multiplicado 
     * por 100 (cem). Para fins de calculo deste indicador somente serão 
     * utilizadas respostas a pesquisa de satisfação realizada pela DET. 
     * Meta >= 90.
     * @return array qtd_total e qtd_criticidade
     */
    public function kpi01DET02(){
        $pqs = Yii::app()->dbINCRA->createCommand()
                ->select("count(satisfaction) as qtd_satisfaction, count(nosatisfaction) as qtd_nosatisfaction")
                ->from("vw_kpi_pqs")
                ->where("question_id <> 10 "
                        . "and queue_finish in (9,10,11,12,13,14,15,16,17,18,24) "
                        . "and date(vote_time) between :dtIni and :dtFim", array(
                    ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $pqs[0];
    }

    /**
     * Índice de incidentes críticos tratados em até 04 horas.
     * (número de incidentes críticos solucionados em até 04 horas) / 
     * (total mensal de incidentes críticos) * 100.
     * Meta >= 95.
     * @return array qtd
     */
    public function kpi02DET02(){
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("count(ticket_id) as qtd")
            ->from("vw_kpi_det2")
            // ->where("type_id = 2 and sla_id = 1 "
            ->where("type_id IN (1,2,3,4,5,6) and sla_id = 1 "
                ."and date(finish_time) between :dtIni and :dtFim "
                ."and (fncTime2ToInt(timeDET2) - fncTime2ToInt(timePendingDET2)) <= :time", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ':time' => '14400', //4 horas
            ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }
    
    /**
     * Índice de incidentes críticos tratados em até 08 horas.
     * (número de incidentes críticos solucionados em até 08 horas) / 
     * (total mensal de incidentes críticos) * 100.
     * Meta >= 95.
     * @return array qtd
     */
    public function kpi03DET02()
    {
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("count(ticket_id) as qtd")
            ->from("vw_kpi_det2")
            ->where("type_id IN (1,2,3,4,5,6) and sla_id = 2 "
                . "and date(finish_time) between :dtIni and :dtFim "
                . "and (fncTime2ToInt(timeDET2) - fncTime2ToInt(timePendingDET2)) <= :time", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ':time' => '28800', //8 horas
            ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Índice de tarefas realizadas dentro do prazo previamente especificado 04 horas.
     * (número de tarefas realizadas dentro do prazo previamente especificado 04 horas) / 
     * (total mensal de tarefas realizadas) * 100.
     * Meta >= 95.
     * @return array qtd
     */
    public function kpi04DET02(){
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("count(ticket_id) as qtd")
            ->from("vw_kpi_det2")
            ->where("type_id IN (1,2,3,4,5,6) and sla_id = 3 "
                ."and date(finish_time) between :dtIni and :dtFim "
                ."and (fncTime2ToInt(timeDET2) - fncTime2ToInt(timePendingDET2)) <= :time", array(
                ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ':time' => '14400', //4 horas
            ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

    /**
     * Retorna a Quantidade de Chamados Abertos dentro de um período.
     * @return array
     */
    public function rptQTDChamadosAbertos(){
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("COUNT(id) AS qtd ")
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
        $tickets = Yii::app()->dbINCRA->createCommand()
            ->select("COUNT(th.ticket_id) AS qtd ")
            ->from("ticket AS ti ")
            ->join("ticket_history AS th", "ti.id = th.ticket_id")
            ->where("th.state_id = 6 AND th.history_type_id = 27 AND th.create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }
    
}