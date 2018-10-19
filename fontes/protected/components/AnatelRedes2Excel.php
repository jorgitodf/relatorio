<?php

class AnatelRedes2Excel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiAnatel $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelRedes2Excel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelRedes2Excel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI Redes - Relatório de Chamados Atendidos pela Fila de Redes (Hittss).
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos pela Fila de Redes')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Redes')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores')
            ->setCellValue('A7', 'Tickets Sem SLA');
        $xls->getActiveSheet()->setTitle('Redes');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B7')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle("A7:B7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('feff80');
        $xls->getActiveSheet()->getStyle('A4:B7')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Solicitante')
            ->setCellValue('G8', 'Situação')
            ->setCellValue('H8', 'Serviço')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Primeira Fila Atendimento')
            ->setCellValue('O8', 'Data Primeira Fila Atendimento')
            ->setCellValue('P8', 'Fila do Atendimento (Resolução)')
            ->setCellValue('Q8', 'Data do Atendimento (Resolução)')
            ->setCellValue('R8', 'Atendente (Resolução)')
            ->setCellValue('S8', 'Tempo Primeiro Atendimento')
            ->setCellValue('T8', 'Tempo na Central de Serviços')
            ->setCellValue('U8', 'Tempo na Fila de Atendimento (Resolução)')
            ->setCellValue('V8', 'Tempo Total Pendente')
            ->setCellValue('W8', 'Tempo Total de Resolução')
            ->setCellValue('X8', 'Sla')
            ->setCellValue('Y8', 'Sla Restante')
            ->setCellValue('Z8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Z8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Z8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Z8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        // Array com os IDs das filas de Redes
        $queuesIds = array(111,112,113,114,115,119);
        $servicosIds = array(158,159,167,168,169,170,172,173,174,175,176,181,182,183,184,1350,1351,1352,1353,1354,1355,1356,1357,1358,
            1359,1360,1361,1362,1363,1364,1365,1366,1367,1368,1369,1370,1371,1372,1373,1374,
            1375,1376,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387,1418,1419);
        $rsl = $model->rptREPORTRedes();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['solicitante'])
                ->setCellValue('G' . $i, $value['state_name'])
                ->setCellValue('H' . $i, $value['service_name'])
                ->setCellValue('I' . $i, $value['create_time'])
                ->setCellValue('J' . $i, $value['queue_create_name'])
                ->setCellValue('K' . $i, $value['name_first_ownwer'])
                ->setCellValue('L' . $i, $value['date_first_ownwer'])
                ->setCellValue('M' . $i, $value['queue_first_ownwer'])
                ->setCellValue('N' . $i, $value['first_queue_name'])
                ->setCellValue('O' . $i, $value['date_first_queue_name'])
                ->setCellValue('P' . $i, $value['fila_resolucao'])
                ->setCellValue('Q' . $i, $value['data_resolucao'])
                ->setCellValue('R' . $i, !empty($value['atendente_resolucao']) || $value['atendente_resolucao'] !== NULL ? $value['atendente_resolucao'] : null)
                ->setCellValue('S' . $i, $value['tempo_primeiro_atendimento'])
                ->setCellValue('T' . $i, !empty($value['tempo_na_fila_cs']) || $value['tempo_na_fila_cs'] !== NULL ? $value['tempo_na_fila_cs'] : null)
                ->setCellValue('U' . $i, !empty($value['tempo_na_fila_resolucao']) || $value['tempo_na_fila_resolucao'] !== NULL ? $value['tempo_na_fila_resolucao'] : null)
                ->setCellValue('V' . $i, $value['tempo_total_pendente'])
                ->setCellValue('W' . $i, $value['total_tempo_resolucao'])
                ->setCellValue('X' . $i, $value['sla'])
                ->setCellValue('Y' . $i, !empty($value['sla_restante']) || $value['sla_restante'] !== NULL ? $value['sla_restante'] : null)
                ->setCellValue('Z' . $i, $value['mes_ref'])
                ->setCellValue('AA' . $i, !empty($value['sla_restante']) || $value['sla_restante'] !== NULL ? FksUtils::timeToInt($value['sla_restante']) : null)
                ->setCellValue('AB' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AC' . $i, (in_array($value['queue_resolucao_id'], $queuesIds) ? 1 : 0));
            if ($value['sla_restante'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            } elseif ($value['sla'] == "" || $value['sla'] == null) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('feff80');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);

        $xls->getActiveSheet()->setCellValue("B4", '=COUNTIFS(AA9:AA'.$i.',">0",AB9:AB'.$i.',"=1",AC9:AC'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIF(X9:X$i,\"=\")");

        // KPI Telefonia - Relatório de Chamados Atendidos pela Fila de Telefonia.
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos pela Fila de Telefonia')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Telefonia')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores')
            ->setCellValue('A7', 'Tickets Sem SLA');
        $xls->getActiveSheet()->setTitle('Telefonia');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B7')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle("A7:B7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('feff80');
        $xls->getActiveSheet()->getStyle('A4:B7')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Solicitante')
            ->setCellValue('G8', 'Situação')
            ->setCellValue('H8', 'Serviço')
            ->setCellValue('I8', 'Data de Criação')
            ->setCellValue('J8', 'Fila de Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Proprietário')
            ->setCellValue('N8', 'Primeira Fila Atendimento')
            ->setCellValue('O8', 'Data Primeira Fila Atendimento')
            ->setCellValue('P8', 'Fila do Atendimento (Resolução)')
            ->setCellValue('Q8', 'Data do Atendimento (Resolução)')
            ->setCellValue('R8', 'Atendente (Resolução)')
            ->setCellValue('S8', 'Tempo Primeiro Atendimento')
            ->setCellValue('T8', 'Tempo na Central de Serviços')
            ->setCellValue('U8', 'Tempo na Fila de Atendimento (Resolução)')
            ->setCellValue('V8', 'Tempo Total Pendente')
            ->setCellValue('W8', 'Tempo Total de Resolução')
            ->setCellValue('X8', 'Sla')
            ->setCellValue('Y8', 'Sla Restante')
            ->setCellValue('Z8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Z8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Z8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Z8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        // Array com os IDs das filas de Telefonia
        $queuesIds = array(111,112,113,114,115,119);
        $servicosIds = array(195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,
            222,223,224,225,226,227,228,229,230,231,232,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,1398,1399,
            1400,1401,1402,1403,1404,1405,1406,1407,1408,1409,1410,1414,1415,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,
            1432,1433,1434,1435,1436,1437,1438);
        $rsl = $model->rptREPORTTelefonia();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['solicitante'])
                ->setCellValue('G' . $i, $value['state_name'])
                ->setCellValue('H' . $i, $value['service_name'])
                ->setCellValue('I' . $i, $value['create_time'])
                ->setCellValue('J' . $i, $value['queue_create_name'])
                ->setCellValue('K' . $i, $value['name_first_ownwer'])
                ->setCellValue('L' . $i, $value['date_first_ownwer'])
                ->setCellValue('M' . $i, $value['queue_first_ownwer'])
                ->setCellValue('N' . $i, $value['first_queue_name'])
                ->setCellValue('O' . $i, $value['date_first_queue_name'])
                ->setCellValue('P' . $i, $value['fila_resolucao'])
                ->setCellValue('Q' . $i, $value['data_resolucao'])
                ->setCellValue('R' . $i, !empty($value['atendente_resolucao']) || $value['atendente_resolucao'] !== NULL ? $value['atendente_resolucao'] : null)
                ->setCellValue('S' . $i, $value['tempo_primeiro_atendimento'])
                ->setCellValue('T' . $i, !empty($value['tempo_na_fila_cs']) || $value['tempo_na_fila_cs'] !== NULL ? $value['tempo_na_fila_cs'] : null)
                ->setCellValue('U' . $i, !empty($value['tempo_na_fila_resolucao']) || $value['tempo_na_fila_resolucao'] !== NULL ? $value['tempo_na_fila_resolucao'] : null)
                ->setCellValue('V' . $i, $value['tempo_total_pendente'])
                ->setCellValue('W' . $i, $value['total_tempo_resolucao'])
                ->setCellValue('X' . $i, $value['sla'])
                ->setCellValue('Y' . $i, !empty($value['sla_restante']) || $value['sla_restante'] !== NULL ? $value['sla_restante'] : null)
                ->setCellValue('Z' . $i, $value['mes_ref'])
                ->setCellValue('AA' . $i, !empty($value['sla_restante']) || $value['sla_restante'] !== NULL ? FksUtils::timeToInt($value['sla_restante']) : null)
                ->setCellValue('AB' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AC' . $i, (in_array($value['queue_resolucao_id'], $queuesIds) ? 1 : 0));
            if ($value['sla_restante'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            } elseif ($value['sla'] == "" || $value['sla'] == null) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('feff80');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);

        $xls->getActiveSheet()->setCellValue("B4", '=COUNTIFS(AA9:AA'.$i.',">0",AB9:AB'.$i.',"=1",AC9:AC'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIF(X9:X$i,\"=\")");

        // KPI Redes - Relatório de Chamados Atendidos pela Fila de Redes Reabertos.
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos e Reabertos pela Fila de Redes')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Redes')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Redes Reabertos');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
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
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Solicitante')
            ->setCellValue('G8', 'Situação')
            ->setCellValue('H8', 'Serviço')
            ->setCellValue('I8', 'Criação')
            ->setCellValue('J8', 'Fila Criação')
            ->setCellValue('K8', 'Primeiro Proprietário')
            ->setCellValue('L8', 'Data Primeiro Proprietário')
            ->setCellValue('M8', 'Fila Primeiro Atendimento')
            ->setCellValue('N8', 'Data Fila Primeiro Atendimento')
            ->setCellValue('O8', 'Sla')
            ->setCellValue('P8', 'Data Atendimento')
            ->setCellValue('Q8', 'Fila Atendimento')
            ->setCellValue('R8', 'Usuário Atendimento')
            ->setCellValue('S8', 'Tempo Pendente Fila Atendimento')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Atendimento')
            ->setCellValue('V8', 'Tempo Restante Sla')
            ->setCellValue('W8', 'Tempo Restante Sla Numérico')
            ->setCellValue('X8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Y')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);

        // Array com os IDs das filas de Redes
        $queuesIds = array(111,112,113,114,115,119);
        $servicosIds = array(158,159,167,168,169,170,172,173,174,175,176,181,182,183,184,198,201,202,204,205,207,208,210,216,218,219,220,
            221,222,226,227,228,229,234,236,250,251,1350,1351,1352,1353,1355,1356,1357,1358,1359,1360,1361,1362,1363,1364,1365,1366,1367,
            1368,1369,1370,1371,1372,1373,1374,1375,1376,1377,1378,1379,1380,1381,1382,1383,1384,1385,1387,1402,1410,1415);
        $rsl = $model->rptREDESROPEN();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['solicitante'])
                ->setCellValue('G' . $i, $value['state_name'])
                ->setCellValue('H' . $i, $value['service_name'])
                ->setCellValue('I' . $i, $value['create_time'])
                ->setCellValue('J' . $i, $value['queue_create_name'])
                ->setCellValue('K' . $i, $value['name_ownwer'])
                ->setCellValue('L' . $i, $value['date_first_owner'])
                ->setCellValue('M' . $i, $value['first_queue_name'])
                ->setCellValue('N' . $i, $value['create_time_first_queue'])
                ->setCellValue('O' . $i, $value['sla'])
                ->setCellValue('P' . $i, $value['finish_time'])
                ->setCellValue('Q' . $i, $value['queue_finish_name'])
                ->setCellValue('R' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('S' . $i, !empty($value['timePendingQueueREDES']) || $value['timePendingQueueREDES'] !== NULL ? $value['timePendingQueueREDES'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueueREDES'])
                ->setCellValue('V' . $i, $value['time_rest_sla'])
                ->setCellValue('W' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('X' . $i, $value['mes_ref'])
                ->setCellValue('Y' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('Z' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AA' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            //$servicosIds = in_array($value['service_id'], $servicosIds) ? 1 : 0;
            //$queuesIds = in_array($value['queue_finish'], $queuesIds) ? 1 : 0;
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("S9:S$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Y9:Y$i,\">0\",Z9:Z$i,\"=1\",AA9:AA$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(Z9:Z$i,\"=1\",AA9:AA$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelRedes2Excel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}
