<?php

class AnatelGDados2Excel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiAnatel $model
     * @return string
     */
    public static function generate($model) {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('d_m_Y');
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelGDados2Excel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelGDados2Excel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI Gestão de Dados - Relatório de Chamados Atendidos pela Fila de Gestão de Dados.
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos pela Fila de Gestão de Dados')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Gestão de Dados')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores')
            ->setCellValue('A7', 'Tickets Sem SLA');
        $xls->getActiveSheet()->setTitle('Gestão de Dados');
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

        // Array com os IDs das filas de Gestão de Dados
        $queuesIds = array(142,143,144,145,146);
        $servicosIds = array(1482,1485,1484,1483,1490,1492,1495,1497,1493,1500,1503,1486,1488,1480,1506,1478,1504,1502,1501,1499,1496,1498,1494,1505,1491,1481,1479,1487,1489,1444,1507,1442,1473,
            1474,1477,1472,1476,1475,1441,1465,1462,1446,1454,1471,1456,1466,1455,1453,1467,1448,1445,1450,1451,1459,1460,1449,1464,1452,1463,1461,1457,1458,1469,1468,1470,1447,
            1508,1509,1510,1511,1512);
        $rsl = $model->rptREPORTGestaoDeDados();
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


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelGDados2Excel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}