<?php

/**
 * KpiIphan class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiIphan extends CFormModel {
    
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
     * Retorna a Quantidade de Chamados Abertos dentro de um período.
     * @return array
     */
    public function rptQTDChamadosAbertos(){
        $tickets = Yii::app()->dbIPHAN->createCommand()
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
        $tickets = Yii::app()->dbIPHAN->createCommand()
            ->select("COUNT(th.ticket_id) AS qtd ")
            ->from("ticket AS ti ")
            ->join("ticket_history AS th", "ti.id = th.ticket_id")
            ->where("th.state_id = 3 AND th.history_type_id = 27 AND th.create_time BETWEEN :dtIni and :dtFim "
                , array(':dtIni' => FksFormatter::StrToDate($this->dtInicio),
                    ':dtFim' => FksFormatter::StrToDate($this->dtTermino),
                ))
            ->queryAll();

        return $tickets[0]['qtd'];
    }

}