<?php

/**
 * KpiAncineOld class
 * This class is SQL commands for Dashboard(index) page
 * 
 */
class KpiAncine extends CFormModel {
    
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
            'ilha' => 'Ilha'
        );
    }


    /**
     * Relatório Chamados INS02.
     * @return array
     */
    public function rptKPIINS02(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("id,ticket,tipo,titulo,servico,type_id,service_id,ticket_state_id,prioridade,
                status,sla,solicitante,DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao,
                fila_criacao,DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s') AS data_first_owner,
                user_name_first_owner,queue_name_first_owner,ticket_priority_id,
                DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name,user_name_first_queue,tempo_first_atendimento,
                tempo_first_atendimento_second,data_resolucao,
                CASE
		            WHEN ISNULL(sla_id) THEN 'Sla Não Informado'
		            ELSE sla_id
	            END AS sla_id")
            ->from("vw_ins_02 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY tipo ASC ")
            ->queryAll();

        return $tickets;
    }

    /**
     * Relatório Chamados INS0405.
     * @return array
     */
    public function rptKPIINS04(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao, tempo_sla, tempo_filas_ancine")
            ->from("vw_ins_04 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND queue_id_resolucao NOT IN (18,20,19,22,21,24,23,39,27)"
                . "ORDER BY ticket ASC ")
            ->queryAll();

        return $tickets;
    }

    /**
     * Relatório Chamados INS0405.
     * @return array
     */
    public function rptKPIINS0405(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, service_id, ticket_priority_id, prioridade, status, sla, sla_id,
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao, queue_id_resolucao,
                tempo_pendente, tempo_atendimento, tempo_filas_ancine, tempo_aberto")
            ->from("vw_ins_04_v2 ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND queue_id_resolucao NOT IN (18,20,19,22,21,24,23,39,27)"
                . "ORDER BY ticket ASC ")
            ->queryAll();

        return $tickets;
    }

    /**
     * Relatório Chamados INS07.
     * @return array
     */
    public function rptKPIINS07(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("faq_number, titulo, aplicabilidade, servico, criticidade, DATE_FORMAT(create_time, '%d/%m/%Y %H:%i:%s') AS create_time")
            ->from("vw_ins_07 ")
            ->where("date(create_time) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."'")
            ->queryAll();

        $qtd_srv = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_servico")
            ->from("service ")
            ->where("id IN (979,980,981,982,989,994,998,999,992,1001,1005,1006,1004,1011,1014,1024,1025,1031,1032,1034,
            1035,1036,1027,1028,1038,1039,1042,1041,1300,1306,1303,1045,1050,1052,1054,1055,1060,1062,1061,1063,1066,1069,1083,1089,1093,
            1099,1102,1095,1098,1132,1131,1115,1114,1119,1118,1127,1126,1123,1131,1132,1135,1238,1237,1293,1255,1254,1257,1261,1260,1258,1263,
            1265,1267,1283,1281,1274,1275,1277,1285,1290,1288,1234,1233,1227,1230,1231,1173,1179,1182,1188,1194,1197,1185,1200,1203,1206,
            1209,1212,1215,1218,1327,1330,1333,1336,1338,1341,1344,1347,1350,1353,1356,1359,1362,1365,1368,1371,1373,1300,1303,1306,1086,
            1191,1168,1122,1294,1176,1159,1162,1165,1170) AND  valid_id = 1 and create_time > '2018-01-01 00:00:00' ")
            ->queryAll();

        return $array = [$tickets, $qtd_srv[0]['qtd_servico']];
    }


    /**
     * Relatório Chamados INS Geral.
     * @return array
     */
    public function rptKPIINSGeral(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("id, ticket, tipo, titulo, servico, prioridade, status, sla, 
                solicitante, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i:%s') AS data_criacao, fila_criacao,
                DATE_FORMAT(data_first_owner, '%d/%m/%Y %H:%i:%s')AS data_first_owner, user_name_first_owner,
                queue_name_first_owner, DATE_FORMAT(data_first_queue, '%d/%m/%Y %H:%i:%s') AS data_first_queue,
                first_queue_name, user_name_first_queue, DATE_FORMAT(data_resolucao, '%d/%m/%Y %H:%i:%s') AS data_resolucao,
                queue_name_resolucao, user_name_resolucao,
                tempo_pendente_fila_resolucao, tempo_aberto_fila_resolucao, tempo_filas_ancine, tempo_sla")
            ->from("vw_report_ins_geral ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "ORDER BY id ASC ")
            ->queryAll();

        return $tickets;
    }

    /**
     * KPI INS 02-03 VIP.
     * @return array
     */
    public function rptKPI0203(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_first_atendimento_second <= 300  AND type_id IN (1,4,5) AND sla_id = 1")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND type_id IN (1,4,5) AND sla_id = 1")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 02-03 Severidade 2.
     * @return array
     */
    public function rptKPI0203P2(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_first_atendimento_second <= 900 AND type_id IN (1,4,5) AND sla_id = 3")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND type_id IN (1,4,5) AND sla_id = 3")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 02-03 Severidade 3.
     * @return array
     */
    public function rptKPI0203P3(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_first_atendimento_second <= 1200 AND type_id IN (1,4,5) AND sla_id = 4")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND type_id IN (1,4,5) AND sla_id = 4")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 02-03 Severidade 1.
     * @return array
     */
    public function rptKPI0203P1(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_first_atendimento_second <= 300  AND type_id IN (1,4,5) AND sla_id = 2")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND type_id IN (1,4,5) AND sla_id = 2")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 02-03 Serviços Críticos.
     * @return array
     */
    public function rptKPI0203ServCtri(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 2 AND tempo_first_atendimento_second <= 300 AND service_id IN (1376,1377,1378,1379,1380,1381,1382,1383,
                1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,
                1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,
                1432) AND type_id = 2")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 2 AND service_id IN (1376,1377,1378,1379,1380,1381,1382,1383,
                1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,
                1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,
                1432) AND type_id = 2")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 02-03 Serviços Não Críticos.
     * @return array
     */
    public function rptKPI0203ServNCtri(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id IN (1,2,3,4) AND tempo_first_atendimento_second <= 900 AND service_id NOT IN (1376,1377,1378,1379,1380,1381,1382,1383,
                1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,
                1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,
                1432) AND type_id = 2")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_02_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id IN (1,2,3,4) AND service_id NOT IN (1376,1377,1378,1379,1380,1381,1382,1383,
                1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,
                1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,
                1432) AND type_id = 2")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 04-05.
     * @return array
     */
    public function rptKPI0405(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_atendimento_liquido_sec <= 3600 AND sla_id = 1")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 1")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 04-05 Severidade 2.
     * @return array
     */
    public function rptKPI0405S2(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_atendimento_liquido_sec <= 14400 AND sla_id = 3")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 3")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 04-05 Severidade 3.
     * @return array
     */
    public function rptKPI0405S3(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_atendimento_liquido_sec <= 28800 AND sla_id = 4")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 4")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * KPI INS 04-05 Severidade 1.
     * @return array
     */
    public function rptKPI0405S1(){
        $qtd_in = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_in")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND tempo_atendimento_liquido_sec <= 3600 AND sla_id = 2")
            ->queryAll();

        $qtd_total = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_total")
            ->from("vw_ins_04_kpi ")
            ->where("date(data_resolucao) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."' "
                . "AND sla_id = 2")
            ->queryAll();

        return $array = [$qtd_in[0]['qtd_in'], $qtd_total[0]['qtd_total']];
    }

    /**
     * Relatório Chamados Teste.
     * @return array
     */
    public function rptKPITeste(){
        $tickets = Yii::app()->dbANCINE->createCommand()
            ->select("*")
            ->from("vw_gerencimento ")
            ->where("date(data_abertura) BETWEEN '".FksFormatter::StrToDate($this->dtInicio)."' AND '".FksFormatter::StrToDate($this->dtTermino)."'")
            ->queryAll();

        $sql = "SELECT 
                    th.id AS id,
                    th.ticket_id AS ticket_id,
                    q.name AS fila,
                    th.queue_id AS queue_id
                FROM
                    ticket_history th
                JOIN 
                    queue q ON (q.id = th.queue_id)
                WHERE EXISTS (SELECT 
                        MIN(th1.id) AS id
                    FROM
                        ticket_history th1
                    WHERE
                        (th1.history_type_id = 1 OR th1.history_type_id = 16) AND th1.state_id <> 9 AND th1.id = th.id
                    GROUP BY th1.ticket_id) 
                AND th.ticket_id IN (61099,61100)";
        $resultSet = Yii::app()->dbANCINE->createCommand($sql)->queryAll();

        print_r($resultSet);exit;

        /*$qtd_srv = Yii::app()->dbANCINE->createCommand()
            ->select("COUNT(id) AS qtd_servico")
            ->from("service ")
            ->where("valid_id = 1 and create_time > '2018-01-01 00:00:00' ")
            ->queryAll(); */

        //return $array = [$tickets, $qtd_srv[0]['qtd_servico']];
        return $tickets;
    }

}