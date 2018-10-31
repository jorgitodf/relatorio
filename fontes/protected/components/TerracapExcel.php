<?php

class TerracapExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * 
     * @param KpiTerracap $model
     * @return string
     */
    public static function generateXlsINS02($model) {

        $fileName = dirname(__FILE__) . '/../../assets/TerracapreportINS02' . TerracapExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=TerracapreportINS02' . TerracapExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS02
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos dentro do TIA INS02 - Meta 98%')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 05 Minutos')
            ->setCellValue('A4', 'Total de Tickets SLA Vip com Início de Atendimento <= 05 Minutos')
            ->setCellValue('A5', 'Total de Tickets SLA Vip Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02 VIP');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(80);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(9);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Tempo Primeito Atendimento')
            ->setCellValue('R8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);

        $rst = $model->rptKPIINS02();
        $typeIds = array(2,4,5,6);
        $slaIds = array(18,19,32,20,33,21,25,26,22,34,27,28,29,30,23,31,24); //IDs dos SLAs VIP
        $servicesIds = array(1020,1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,1041,1042,
            1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,
            1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,
            1095,1096,1097,1098,1099,1100,1101,1102,1103,1104,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,1117,1118,1119,1120,
            1121,1122,1123,1124,1125,1126,1127,1128,1129,1130,1131,1132,1133,1134,1135,1136,1137,1138,1139,1140,1141,1142,1143,1144,1145,1146,
            1147,1148,1149,1150,1151,1152,1153,1154,1155,1156,1157,1158,1159,1160,1161,1162,1163,1164,1165,1166,1167,1168,1169,1170,1171,1172,
            1173,1174,1175,1176,1177,1178,1179,1180,1181,1182,1183,1184,1185,1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,
            1199,1200,1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1222,1223,1224,
            1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236,1237,1238,1239,1240,1241,1242,1243,1244,1245,1246,1247,1248,1249,1250,
            1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,1261,1262,1263,1264,1265,1266,1267,1268,1269,1270,1271,1272,1273,1274,1275,1276,
            1277,1278,1279,1280,1281,1282,1283,1284,1285,1286,1287,1288,1289,1290,1291,1292,1293,1294,1295,1296,1297,1298,1299,1300,1301,1302,
            1303,1304,1305,1306,1307,1308,1309,1310,1311,1312,1313,1314,1315,1316,1317,1318,1319,1320,1321,1322,1323,1324,1325,1326,1327,1328,
            1329,1330,1331,1332,1333,1334,1335,1336,1337,1338,1339,1340,1341,1342,1343,1344,1345,1346,1347,1348,1349,1350,1351,1352,1353,1354,
            1355,1356,1357,1358,1359,1360,1361,1362,1363,1364,1365,1366);

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if (in_array($valueP1['sla_id'], $slaIds) && in_array($valueP1['type_id'], $typeIds) && in_array($valueP1['service_id'], $servicesIds)) {
                $arrayP1[] = $valueP1;
            }
        }

        $i = 9;
        foreach ($arrayP1 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, !empty($item['tempo_first_atendimento']) || $item['tempo_first_atendimento'] != NULL ? $item['tempo_first_atendimento'] : null)
                ->setCellValue('R' . $i, $item['sla'])
                ->setCellValue('S' . $i, !empty($item['tempo_first_atendimento_second']) || $item['tempo_first_atendimento_second'] != NULL ? $item['tempo_first_atendimento_second'] : null);
            if ($item['tempo_first_atendimento_second'] > 300) {
                $xls->getActiveSheet()->getStyle("A$i:R$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(S9:S'.$i.',"<=300")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos dentro do TIA INS02 - Meta 98%')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 15 Minutos')
            ->setCellValue('A4', 'Total de Tickets SLA Não Vip com Início de Atendimento <= 15 Minutos')
            ->setCellValue('A5', 'Total de Tickets SLA Não Vip Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02 Não VIP');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(80);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(9);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Tempo Primeito Atendimento')
            ->setCellValue('R8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);

        $typeIds = array(2,4,5,6);
        $slaIds = array(6,12,3,9,17,7,8,4,5,13,16,15,1,10,14,11,2); //IDs dos SLAs Não VIP
        $servicesIds = array(1020,1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,1041,1042,
            1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,
            1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,
            1095,1096,1097,1098,1099,1100,1101,1102,1103,1104,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,1117,1118,1119,1120,
            1121,1122,1123,1124,1125,1126,1127,1128,1129,1130,1131,1132,1133,1134,1135,1136,1137,1138,1139,1140,1141,1142,1143,1144,1145,1146,
            1147,1148,1149,1150,1151,1152,1153,1154,1155,1156,1157,1158,1159,1160,1161,1162,1163,1164,1165,1166,1167,1168,1169,1170,1171,1172,
            1173,1174,1175,1176,1177,1178,1179,1180,1181,1182,1183,1184,1185,1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,
            1199,1200,1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1222,1223,1224,
            1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236,1237,1238,1239,1240,1241,1242,1243,1244,1245,1246,1247,1248,1249,1250,
            1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,1261,1262,1263,1264,1265,1266,1267,1268,1269,1270,1271,1272,1273,1274,1275,1276,
            1277,1278,1279,1280,1281,1282,1283,1284,1285,1286,1287,1288,1289,1290,1291,1292,1293,1294,1295,1296,1297,1298,1299,1300,1301,1302,
            1303,1304,1305,1306,1307,1308,1309,1310,1311,1312,1313,1314,1315,1316,1317,1318,1319,1320,1321,1322,1323,1324,1325,1326,1327,1328,
            1329,1330,1331,1332,1333,1334,1335,1336,1337,1338,1339,1340,1341,1342,1343,1344,1345,1346,1347,1348,1349,1350,1351,1352,1353,1354,
            1355,1356,1357,1358,1359,1360,1361,1362,1363,1364,1365,1366);

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if (in_array($valueP2['sla_id'], $slaIds) && in_array($valueP2['type_id'], $typeIds) && in_array($valueP2['service_id'], $servicesIds)) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        foreach ($arrayP2 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, !empty($item['tempo_first_atendimento']) || $item['tempo_first_atendimento'] != NULL ? $item['tempo_first_atendimento'] : null)
                ->setCellValue('R' . $i, $item['sla'])
                ->setCellValue('S' . $i, !empty($item['tempo_first_atendimento_second']) || $item['tempo_first_atendimento_second'] != NULL ? $item['tempo_first_atendimento_second'] : null);
            if ($item['tempo_first_atendimento_second'] > 900) {
                $xls->getActiveSheet()->getStyle("A$i:R$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(S9:S'.$i.',"<=900")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos dentro do TIA INS02 - Meta 99,50%')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 05 Minutos')
            ->setCellValue('A4', 'Total de Tickets Serviços Críticos com Início de Atendimento <= 05 Minutos')
            ->setCellValue('A5', 'Total de Tickets Serviços Críticos Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02 Serviços Críticos');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(80);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(9);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Tempo Primeito Atendimento')
            ->setCellValue('R8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);

        $typeIds = array(2,4,5,6);
        $slaIds = array(12,19); //IDs dos SLAs para Serviços Críticos
        $servicesIds = array(1367,1368,1369,1370,1371,1372,1373,1374,1375,1376,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387,1388,1389,1390,1391,1392,1393); //IDs dos Serviços Críticos

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if (in_array($valueP3['sla_id'], $slaIds) && in_array($valueP3['type_id'], $typeIds) && in_array($valueP3['service_id'], $servicesIds)) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        foreach ($arrayP3 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, !empty($item['tempo_first_atendimento']) || $item['tempo_first_atendimento'] != NULL ? $item['tempo_first_atendimento'] : null)
                ->setCellValue('R' . $i, $item['sla'])
                ->setCellValue('S' . $i, !empty($item['tempo_first_atendimento_second']) || $item['tempo_first_atendimento_second'] != NULL ? $item['tempo_first_atendimento_second'] : null);
            if ($item['tempo_first_atendimento_second'] > 300) {
                $xls->getActiveSheet()->getStyle("A$i:R$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(S9:S'.$i.',"<=300")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, TerracapExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS04($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS0405' . TerracapExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS0405' . TerracapExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS04.05
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04.05')
            ->setCellValue('A2', '95% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Solucionados dentro SLA 1 Hora (VIP e Severidade 1)')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04.05 VIP');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(62);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Data Resolução')
            ->setCellValue('R8', 'Fila Resolução')
            ->setCellValue('S8', 'Atendente Resolução')
            ->setCellValue('T8', 'Tempo Pendente')
            ->setCellValue('U8', 'Tempo Aberto em Atendimento')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Filas Terracap')
            ->setCellValue('X8', 'Sla Consumido');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Y')->setVisible(FALSE);

        $rst = $model->rptKPIINS0405();
        $slaIds = array(1,2);

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if (in_array($valueP1['sla_id'], $slaIds)) {
                $arrayP1[] = $valueP1;
            }
        }

        $i = 9;
        $t = 0;
        foreach ($arrayP1 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente'])
                ->setCellValue('U' . $i, $item['tempo_atendimento'])
                ->setCellValue('V' . $i, $item['sla'])
                ->setCellValue('W' . $i, $item['tempo_filas_ancine'])
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoTerracapV3($item['tempo_aberto'], $item['tempo_filas_ancine']))
                ->setCellValue('Y' . $i, !empty($item['tempo_aberto']) || $item['tempo_aberto'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimentoTerracapV3($item['tempo_aberto'], $item['tempo_filas_ancine'])) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04.05')
            ->setCellValue('A2', '95% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Solucionados dentro SLA 4 Horas (Severidade 02)')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04.05 Severidade 02');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Data Resolução')
            ->setCellValue('R8', 'Fila Resolução')
            ->setCellValue('S8', 'Atendente Resolução')
            ->setCellValue('T8', 'Tempo Pendente')
            ->setCellValue('U8', 'Tempo Aberto em Atendimento')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Filas Terracap')
            ->setCellValue('X8', 'Sla Consumido');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Y')->setVisible(FALSE);

        $slaIds = array(3);

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if (in_array($valueP3['sla_id'], $slaIds)) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        $t = 0;
        foreach ($arrayP3 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente'])
                ->setCellValue('U' . $i, $item['tempo_atendimento'])
                ->setCellValue('V' . $i, $item['sla'])
                ->setCellValue('W' . $i, $item['tempo_filas_ancine'])
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoTerracapV3($item['tempo_aberto'], $item['tempo_filas_ancine']))
                ->setCellValue('Y' . $i, !empty($item['tempo_aberto']) || $item['tempo_aberto'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimentoTerracapV3($item['tempo_aberto'], $item['tempo_filas_ancine'])) : 0);
            if ($t > 14400) {
                $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<=14400")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04.05')
            ->setCellValue('A2', '95% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Solucionados dentro SLA 8 Horas (Severidade 03)')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04.05 Severidade 03');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Data Resolução')
            ->setCellValue('R8', 'Fila Resolução')
            ->setCellValue('S8', 'Atendente Resolução')
            ->setCellValue('T8', 'Tempo Pendente')
            ->setCellValue('U8', 'Tempo Aberto em Atendimento')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Filas Terracap')
            ->setCellValue('X8', 'Sla Consumido');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Y')->setVisible(FALSE);

        $slaIds = array(4);

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if (in_array($valueP4['sla_id'], $slaIds)) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
        $t = 0;
        $slaInt = (3600 * 8);
        foreach ($arrayP4 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente'])
                ->setCellValue('U' . $i, $item['tempo_atendimento'])
                ->setCellValue('V' . $i, $item['sla'])
                ->setCellValue('W' . $i, $item['tempo_filas_ancine'])
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoTerracapV3($item['tempo_aberto'], $item['tempo_filas_ancine']))
                ->setCellValue('Y' . $i, !empty($item['tempo_aberto']) || $item['tempo_aberto'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimentoTerracapV3($item['tempo_aberto'], $item['tempo_filas_ancine'])) : 0);
            if ($t > $slaInt) {
                $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaInt.'")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, TerracapExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS07($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS07' . TerracapExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS07' . TerracapExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS07
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de FAQs no Período INS07')
            ->setCellValue('A2', '95% de FAQs Criadas')
            ->setCellValue('A4', 'Total de FAQs Criadas no Período')
            ->setCellValue('A5', 'Total de Serviços Cadastrados e Ativos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS07 FAQ');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(95);
        $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        $xls->getActiveSheet()->setCellValue('A8', 'Nº Faq')
            ->setCellValue('B8', 'Título')
            ->setCellValue('C8', 'Aplicabilidade')
            ->setCellValue('D8', 'Serviço Vinculado')
            ->setCellValue('E8', 'Criticidade')
            ->setCellValue('F8', 'Data de Criação');
        $xls->getActiveSheet()->getStyle('A8:F8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:F8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:F8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $xls->getActiveSheet()->getColumnDimension('G')->setVisible(FALSE);

        $rst = $model->rptKPIINS07();

        $i = 9;
        foreach ($rst[0] as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['faq_number'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['titulo'])
                ->setCellValue('C' . $i, $item['aplicabilidade'])
                ->setCellValue('D' . $i, $item['servico'])
                ->setCellValue('E' . $i, $item['criticidade'])
                ->setCellValue('F' . $i, $item['create_time'])
                ->setCellValue('G' . $i, !empty($item['faq_number']) || $item['faq_number'] != NULL ? 1 : 0);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(G9:G'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, TerracapExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINSGeral($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINSGeral' . TerracapExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINSGeral' . TerracapExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório Geral de Chamados Tratados no Período')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Solucionados ');
        $xls->getActiveSheet()->setTitle('Geral');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(80);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Status')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeira Fila')
            ->setCellValue('O8', 'Primeira Fila')
            ->setCellValue('P8', 'Atendente Primeira Fila')
            ->setCellValue('Q8', 'Data Resolução')
            ->setCellValue('R8', 'Fila Resolução')
            ->setCellValue('S8', 'Atendente Resolução')
            ->setCellValue('T8', 'Tempo Pendente Fila Resolução')
            ->setCellValue('U8', 'Tempo Aberto Fila Resolução')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Filas Terracap')
            ->setCellValue('X8', 'Sla Consumido');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $rst = $model->rptKPIINSGeral();

        $i = 9;
        $t = 0;
        foreach ($rst as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['solicitante'])
                ->setCellValue('H' . $i, $item['status'])
                ->setCellValue('I' . $i, $item['data_criacao'])
                ->setCellValue('J' . $i, $item['fila_criacao'])
                ->setCellValue('K' . $i, $item['user_name_first_owner'])
                ->setCellValue('L' . $i, $item['data_first_owner'])
                ->setCellValue('M' . $i, $item['queue_name_first_owner'])
                ->setCellValue('N' . $i, $item['data_first_queue'])
                ->setCellValue('O' . $i, $item['first_queue_name'])
                ->setCellValue('P' . $i, $item['user_name_first_queue'])
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, $item['sla'])
                ->setCellValue('W' . $i, $item['tempo_filas_ancine'])
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoTerracap($item['tempo_sla'], $item['tempo_filas_ancine']));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("Q9:Q$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, TerracapExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}
