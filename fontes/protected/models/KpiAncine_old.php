<?php

/**
 * KpiAncineOld class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiAncineOld extends CFormModel {
    
    public $dtInicio;
    public $dtTermino;
    
    //private $idKPI05 = '154,76,156';
    private $idKPI06 = '171,174,177,180,182,188,191,194,197,200,203,206,209,212,215,218,221,224,312,315,432,440';
    private $idKPI07 = '126,127,125';
    private $idKPI08 = '169,172,175,178,181,186,189,192,195,198,201,204,207,210,213,216,219,222,310,314,431,441';

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
    public function rptRTA(){
        $tickets = Yii::app()->dbANCINE->createCommand()
                ->select("k.tn, k.ticket_id, k.title, k.type_name, k.priority_name, k.state_name, k.service_name, 
                    k.create_time, k.queue_create_name, k.finish_time, k.queue_finish_name, k.user_finish, k.timePending, 
                    k.timeResolution, th.queue_id, k.queue_finish ")
                ->from("vw_kpi AS k ")
                ->join("ticket_history AS th", "k.ticket_id = th.ticket_id ")
                ->where("date(k.finish_time) between :dtIni and :dtFim "
                    . " and th.history_type_id = 16 and (th.queue_id = 6 OR th.queue_id > 30) and k.queue_finish = 5 "
                    . " group by k.ticket_id, k.timePending, k.timeResolution, th.queue_id order by k.ticket_id ASC "
                    , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $tickets;
    }

    /**
     * Retorna a Quantidade de Chamados Abertos dentro de um período.
     * @return array
     */
    public function rptQTDChamadosAbertos(){
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("tn,ticket_id,title,type_name,priority_name,state_name,service_name,create_time,queue_create_name,
                finish_time,queue_finish_name,user_finish,qtd_move,timeQueueCS,timePendingQueueCS,timePending,timeResolution")
            ->from("vw_kpi")
            ->where("date(finish_time) between :dtIni and :dtFim order by create_time ASC "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets;
    }

    public function rptRTAKpi03(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_id, service_name, create_time, queue_create_name, finish_time, 
            queue_finish_name, user_finish, timePending, timeResolution, queue_finish, bypass_cs, timeQueueCS, timePendingQueueCS")
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
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("tn, ticket_id, title, type_id, type_name, priority_name, state_name, service_name, create_time, 
                    queue_create_name, finish_time, queue_finish_name, user_finish, timePending, timeResolution, queue_finish, 
                    service_id, qtd_move, timeQueueCS, timePending, timePendingQueueCS, timeResolution, timeQueueSP")
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
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time, queue_create_name, finish_time, 
            queue_finish_name, user_finish, timePending, timeResolution, timeResolution, queue_finish, service_id, qtd_move, timeQueueCS, timePending, 
            timePendingQueueCS, timeResolution, timeQueueSP")
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
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("tn, ticket_id, title, type_name, priority_name, state_name, service_name, create_time, queue_create_name, finish_time, 
            queue_finish_name, user_finish, timePending, timeResolution, timeResolution, queue_finish, service_id, qtd_move, timeQueueCS, timePending, 
            timePendingQueueCS, timeResolution, timeQueueSP")
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $pqs = Yii::app()->dbANCINE->createCommand()
                ->select("tn, ticket_id, title, type_name, queue_finish_name, user_finish, send_to, send_time, vote_time, 
                public_survey_key, question, answer, satisfaction, nosatisfaction")
                ->from("vw_kpi_pqs")
                ->where("queue_finish in (5)"
                        . "and date(vote_time) between :dtIni and :dtFim " , array(
                        ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                        ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
                ->queryAll();

        return $pqs;
    }

    public function rptRTAPqsKPI09(){
        $pqs = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
    $media = Yii::app()->dbANCINE->createCommand()
        ->select("FORMAT(AVG(answer),2) AS 'media'")
        ->from("vw_kpi_pqs")
        ->where("queue_finish in (5) and question_id = 2 "
            . "and date(vote_time) between :dtIni and :dtFim ", array(
            ':dtIni' => FksFormatter::StrToDate($this->dtInicio),
            ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
        ))
        ->queryAll();

    return $media[0]['media'];
    }

    public function mediaNotaskpi09(){
        $media = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
                ->select("COUNT(ticket_id) as qtd")
                ->from("vw_kpi")
                ->where("queue_create = 5 "
                        . "and queue_finish IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38)"
                        . "and date(finish_time) between :dtIni and :dtFim "
                        . "and (fncTime2ToInt(timeQueueCS) - fncTime2ToInt(timePendingQueueCS)) <= :time "
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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
        $tickets = Yii::app()->dbANCINE->createCommand()
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