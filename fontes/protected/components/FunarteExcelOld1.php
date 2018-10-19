<?php

class FunarteExcelOld1  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiFunarte $model
     * @return string
     */

    public static function generateXlsINS0203($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS0203' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS0203' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS0203
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02-03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 5 Minutos')
            ->setCellValue('A4', 'Total de Tickets Vip com Início de Atendimento <= 5 Minutos')
            ->setCellValue('A5', 'Total de Tickets Vip Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02-03 VIP (1 Hora)');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(73);
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

        $rst = $model->rptKPIINS0203();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02-03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 10 Minutos')
            ->setCellValue('A4', 'Total de Tickets Prioridade 2 (3 Horas) com Início de Atendimento <= 10 Minutos')
            ->setCellValue('A5', 'Total de Tickets Prioridade 2 Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02-03 Prioridade 2 (3 Horas)');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(73);
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

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
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
            if ($item['tempo_first_atendimento_second'] > 600) {
                $xls->getActiveSheet()->getStyle("A$i:R$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(S9:S'.$i.',"<=600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02-03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 15 Minutos')
            ->setCellValue('A4', 'Total de Tickets Prioridade 3 (6 Horas) com Início de Atendimento <= 15 Minutos')
            ->setCellValue('A5', 'Total de Tickets Prioridade 3 Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02-03 Prioridade 3 (6 Horas)');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(73);
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

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
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

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02-03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 10 Minutos')
            ->setCellValue('A4', 'Total de Tickets Prioridade 2 (2 Horas) com Início de Atendimento <= 10 Minutos')
            ->setCellValue('A5', 'Total de Tickets Prioridade 2 Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02-03 Prioridade 2 (2 Horas)');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(73);
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

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if ($valueP4['sla_id'] == 4) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
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
                ->setCellValue('Q' . $i, !empty($item['tempo_first_atendimento']) || $item['tempo_first_atendimento'] != NULL ? $item['tempo_first_atendimento'] : null)
                ->setCellValue('R' . $i, $item['sla'])
                ->setCellValue('S' . $i, !empty($item['tempo_first_atendimento_second']) || $item['tempo_first_atendimento_second'] != NULL ? $item['tempo_first_atendimento_second'] : null);
            if ($item['tempo_first_atendimento_second'] > 600) {
                $xls->getActiveSheet()->getStyle("A$i:R$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(S9:S'.$i.',"<=600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02-03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 15 Minutos')
            ->setCellValue('A4', 'Total de Tickets Prioridade 3 (4 Horas) com Início de Atendimento <= 15 Minutos')
            ->setCellValue('A5', 'Total de Tickets Prioridade 3 Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02-03 Prioridade 3 (4 Horas)');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(73);
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

        $arrayP5 = [];
        foreach ($rst as $valueP5) {
            if ($valueP5['sla_id'] == 5) {
                $arrayP5[] = $valueP5;
            }
        }

        $i = 9;
        foreach ($arrayP5 as $item) {
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

        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02-03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 5 Minutos')
            ->setCellValue('A4', 'Total de Tickets Prioridade 1 (1 Hora) com Início de Atendimento <= 5 Minutos')
            ->setCellValue('A5', 'Total de Tickets Prioridade 1 Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02-03 Prioridade 1 (1 Hora)');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(73);
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

        $arrayP6 = [];
        foreach ($rst as $valueP6) {
            if ($valueP6['sla_id'] == 6) {
                $arrayP6[] = $valueP6;
            }
        }

        $i = 9;
        foreach ($arrayP6 as $item) {
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
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS05($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS05' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS05' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS05
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04')
            ->setCellValue('A2', '5% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Requisição Solucionados acima do SLA Vip')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04 Vip');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS05();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1 && $valueP1['type_id'] == 4) {
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Requisição Solucionados acima do SLA 3 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04 Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2 && $valueP2['type_id'] == 4) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        $t1 = 0;
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t1 = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t1 > 10800) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">10800")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Requisição Solucionados acima do SLA 6 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04 Prioridade 3');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3 && $valueP3['type_id'] == 4) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t2 > 21600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">21600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS04')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Requisição Solucionados acima do SLA 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS04 Prioridade 1');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if ($valueP4['sla_id'] == 6 && $valueP4['type_id'] == 4) {
                $arrayP4[] = $valueP3;
            }
        }

        $i = 9;
        $t3 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t3 = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t3 > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS05')
            ->setCellValue('A2', '5% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Informações/Dúvidas Solucionados acima do SLA Vip')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS05 Vip');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP5 = [];
        foreach ($rst as $valueP5) {
            if ($valueP5['sla_id'] == 1 && $valueP5['type_id'] == 7) {
                $arrayP5[] = $valueP5;
            }
        }

        $i = 9;
        $t = 0;
        foreach ($arrayP5 as $item) {
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
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS05')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Informações/Dúvidas Solucionados acima do SLA 3 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS05 Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP6 = [];
        foreach ($rst as $valueP6) {
            if ($valueP6['sla_id'] == 2 && $valueP6['type_id'] == 7) {
                $arrayP6[] = $valueP6;
            }
        }

        $i = 9;
        $t1 = 0;
        foreach ($arrayP6 as $item) {
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
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t1 = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t1 > 10800) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">10800")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS05')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Informações/Dúvidas Solucionados acima do SLA 6 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS05 Prioridade 3');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP7 = [];
        foreach ($rst as $valueP7) {
            if ($valueP7['sla_id'] == 3 && $valueP7['type_id'] == 7) {
                $arrayP7[] = $valueP7;
            }
        }

        $i = 9;
        $t2 = 0;
        foreach ($arrayP7 as $item) {
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
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t2 > 21600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">21600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS05')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Informações/Dúvidas Solucionados acima do SLA 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS05 Prioridade 1');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(66);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP8 = [];
        foreach ($rst as $valueP8) {
            if ($valueP8['sla_id'] == 6 && $valueP8['type_id'] == 7) {
                $arrayP8[] = $valueP8;
            }
        }

        $i = 9;
        $t3 = 0;
        foreach ($arrayP8 as $item) {
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
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t3 = FksUtils::timeToInt($item['tempo_aberto_fila_resolucao']) : 0);
            if ($t3 > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS06($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS06' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS06' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS06
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS06')
            ->setCellValue('A2', '5% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Incidentes Solucionados acima do SLA 1 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS06 Prioridade 1');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS06();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1 || $valueP1['sla_id'] == 6) {
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">3600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS06')
            ->setCellValue('A2', '5% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Incidentes Solucionados acima do SLA 2 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS06 Prioridade 2');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS06();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 4) {
                $arrayP1[] = $valueP1;
            }
        }

        $i = 9;
        $t1 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t1 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t > 7200) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">7200")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[2]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS06')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Incidentes Solucionados acima do SLA 4 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS06 Prioridade 3');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst[0] as $valueP2) {
            if ($valueP2['sla_id'] == 5) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t1 > 14400) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',">14400")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[3]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS07($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS07' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS07' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Fator de Atualização da Base de Conhecimento')
            ->setCellValue('A2', 'Scripts atualizados ou incluídos')
            ->setCellValue('A4', 'Total de scripts atualizados/revisados')
            ->setCellValue('A5', 'Total de scripts')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('INS07');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº FAQ')
            ->setCellValue('B8', 'Categoria')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Situação')
            ->setCellValue('E8', 'Criação')
            ->setCellValue('F8', 'Usuário Criação')
            ->setCellValue('G8', 'Alteração')
            ->setCellValue('H8', 'Usuário Alteração');
        $xls->getActiveSheet()->getStyle('A8:H8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:H8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:H8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptFaq();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['faq_number'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['category_name'])
                ->setCellValue('C' . $i, $value['faq_title'])
                ->setCellValue('D' . $i, $value['state_name'])
                ->setCellValue('E' . $i, $value['time_create'])
                ->setCellValue('F' . $i, $value['user_created'])
                ->setCellValue('G' . $i, $value['time_change'])
                ->setCellValue('H' . $i, $value['user_changed']);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /* public static function generateXlsINS09($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS09' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS09' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS09
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS09')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Solucionados dentro SLA 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS09 Prioridade 1');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS09();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1 || $valueP1['sla_id'] == 6) {
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS09')
            ->setCellValue('A2', '95% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Solucionados dentro SLA 3 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS09 Prioridade 2');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst[0] as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        $t1 = 0;
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t1 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t1 > 10800) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=10800")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[2]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS09')
            ->setCellValue('A2', '90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Solucionados dentro SLA 6 Horas')
            ->setCellValue('A5', 'Total de Tickets Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS09 Prioridade 3');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst[0] as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t2 > 21600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=21600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[3]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    } */

    public static function generateXlsINS10($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS10' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS10' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS10 - PQS
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário Tickets Vip')
            ->setCellValue('A3', 'Total de PQS Enviadas e Respondidas')
            ->setCellValue('A4', 'Total de PQS Enviadas e Não Respondidas')
            ->setCellValue('A5', 'Total de Ótimo')
            ->setCellValue('A6', 'Total de Bom')
            ->setCellValue('A7', 'Total de Regular')
            ->setCellValue('A8', 'Total de Ruim')
            ->setCellValue('A9', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS Vip');
        $xls->getActiveSheet()->getStyle('A1:B9')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(59);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A11', 'Nº Ticket')
            ->setCellValue('B11', 'Ticket ID')
            ->setCellValue('C11', 'Título')
            ->setCellValue('D11', 'Tipo')
            ->setCellValue('E11', 'Fila Fechamento')
            ->setCellValue('F11', 'Usuário Fechamento')
            ->setCellValue('G11', 'Cliente')
            ->setCellValue('H11', 'Envio')
            ->setCellValue('I11', 'Resposta')
            ->setCellValue('J11', 'Chave Verificação')
            ->setCellValue('K11', 'Pergunta')
            ->setCellValue('L11', 'Resposta')
            ->setCellValue('M11', 'Satisfação')
            ->setCellValue('N11', 'Insatisfação')
            ->setCellValue('O11', 'Regular');
        $xls->getActiveSheet()->getStyle('A11:O11')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->getStartColor()->setRGB('eaeaea');

        $pqs = $model->rptRTAPqs();

        $arrayP1 = [];
        foreach ($pqs[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
                $arrayP1[] = $valueP1;
            }
        }

        $i = 12;
        $id = 0;
        foreach ($arrayP1 as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['queue_finish_name'])
                    ->setCellValue('F' . $i, $value['user_finish'])
                    ->setCellValue('G' . $i, $value['send_to'])
                    ->setCellValue('H' . $i, $value['send_time'])
                    ->setCellValue('I' . $i, $value['vote_time'])
                    ->setCellValue('J' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('K' . $i, $value['question'])
                ->setCellValue('L' . $i, $value['answer'])
                ->setCellValue('M' . $i, $value['satisfaction'])
                ->setCellValue('N' . $i, $value['nosatisfaction'])
                ->setCellValue('O' . $i, $value['regular'])
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B12:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "$pqs[1]");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L12:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L12:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L12:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L12:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B9", "=COUNTIFS(L12:L$i,\"Péssimo\")");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário Tickets Prioridade 2 - Sla 3 Horas')
            ->setCellValue('A3', 'Total de PQS Enviadas e Respondidas')
            ->setCellValue('A4', 'Total de PQS Enviadas e Não Respondidas')
            ->setCellValue('A5', 'Total de Ótimo')
            ->setCellValue('A6', 'Total de Bom')
            ->setCellValue('A7', 'Total de Regular')
            ->setCellValue('A8', 'Total de Ruim')
            ->setCellValue('A9', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:B9')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(59);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A11', 'Nº Ticket')
            ->setCellValue('B11', 'Ticket ID')
            ->setCellValue('C11', 'Título')
            ->setCellValue('D11', 'Tipo')
            ->setCellValue('E11', 'Fila Fechamento')
            ->setCellValue('F11', 'Usuário Fechamento')
            ->setCellValue('G11', 'Cliente')
            ->setCellValue('H11', 'Envio')
            ->setCellValue('I11', 'Resposta')
            ->setCellValue('J11', 'Chave Verificação')
            ->setCellValue('K11', 'Pergunta')
            ->setCellValue('L11', 'Resposta')
            ->setCellValue('M11', 'Satisfação')
            ->setCellValue('N11', 'Insatisfação')
            ->setCellValue('O11', 'Regular');
        $xls->getActiveSheet()->getStyle('A11:O11')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->getStartColor()->setRGB('eaeaea');

        $arrayP2 = [];
        foreach ($pqs[0] as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 12;
        $id = 0;
        foreach ($arrayP2 as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['queue_finish_name'])
                    ->setCellValue('F' . $i, $value['user_finish'])
                    ->setCellValue('G' . $i, $value['send_to'])
                    ->setCellValue('H' . $i, $value['send_time'])
                    ->setCellValue('I' . $i, $value['vote_time'])
                    ->setCellValue('J' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('K' . $i, $value['question'])
                ->setCellValue('L' . $i, $value['answer'])
                ->setCellValue('M' . $i, $value['satisfaction'])
                ->setCellValue('N' . $i, $value['nosatisfaction'])
                ->setCellValue('O' . $i, $value['regular'])
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B12:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "$pqs[2]");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L12:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L12:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L12:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L12:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B9", "=COUNTIFS(L12:L$i,\"Péssimo\")");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário Tickets Prioridade 3 - Sla 6 Horas')
            ->setCellValue('A3', 'Total de PQS Enviadas e Respondidas')
            ->setCellValue('A4', 'Total de PQS Enviadas e Não Respondidas')
            ->setCellValue('A5', 'Total de Ótimo')
            ->setCellValue('A6', 'Total de Bom')
            ->setCellValue('A7', 'Total de Regular')
            ->setCellValue('A8', 'Total de Ruim')
            ->setCellValue('A9', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS Prioridade 3');
        $xls->getActiveSheet()->getStyle('A1:B9')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(59);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A11', 'Nº Ticket')
            ->setCellValue('B11', 'Ticket ID')
            ->setCellValue('C11', 'Título')
            ->setCellValue('D11', 'Tipo')
            ->setCellValue('E11', 'Fila Fechamento')
            ->setCellValue('F11', 'Usuário Fechamento')
            ->setCellValue('G11', 'Cliente')
            ->setCellValue('H11', 'Envio')
            ->setCellValue('I11', 'Resposta')
            ->setCellValue('J11', 'Chave Verificação')
            ->setCellValue('K11', 'Pergunta')
            ->setCellValue('L11', 'Resposta')
            ->setCellValue('M11', 'Satisfação')
            ->setCellValue('N11', 'Insatisfação')
            ->setCellValue('O11', 'Regular');
        $xls->getActiveSheet()->getStyle('A11:O11')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->getStartColor()->setRGB('eaeaea');

        $arrayP3 = [];
        foreach ($pqs[0] as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 12;
        $id = 0;
        foreach ($arrayP3 as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['queue_finish_name'])
                    ->setCellValue('F' . $i, $value['user_finish'])
                    ->setCellValue('G' . $i, $value['send_to'])
                    ->setCellValue('H' . $i, $value['send_time'])
                    ->setCellValue('I' . $i, $value['vote_time'])
                    ->setCellValue('J' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('K' . $i, $value['question'])
                ->setCellValue('L' . $i, $value['answer'])
                ->setCellValue('M' . $i, $value['satisfaction'])
                ->setCellValue('N' . $i, $value['nosatisfaction'])
                ->setCellValue('O' . $i, $value['regular'])
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B12:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "$pqs[3]");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L12:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L12:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L12:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L12:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B9", "=COUNTIFS(L12:L$i,\"Péssimo\")");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário Tickets Prioridade 2 IN - Sla 2 Horas')
            ->setCellValue('A3', 'Total de PQS Enviadas e Respondidas')
            ->setCellValue('A4', 'Total de PQS Enviadas e Não Respondidas')
            ->setCellValue('A5', 'Total de Ótimo')
            ->setCellValue('A6', 'Total de Bom')
            ->setCellValue('A7', 'Total de Regular')
            ->setCellValue('A8', 'Total de Ruim')
            ->setCellValue('A9', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS Prioridade 2 IN');
        $xls->getActiveSheet()->getStyle('A1:B9')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(59);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A11', 'Nº Ticket')
            ->setCellValue('B11', 'Ticket ID')
            ->setCellValue('C11', 'Título')
            ->setCellValue('D11', 'Tipo')
            ->setCellValue('E11', 'Fila Fechamento')
            ->setCellValue('F11', 'Usuário Fechamento')
            ->setCellValue('G11', 'Cliente')
            ->setCellValue('H11', 'Envio')
            ->setCellValue('I11', 'Resposta')
            ->setCellValue('J11', 'Chave Verificação')
            ->setCellValue('K11', 'Pergunta')
            ->setCellValue('L11', 'Resposta')
            ->setCellValue('M11', 'Satisfação')
            ->setCellValue('N11', 'Insatisfação')
            ->setCellValue('O11', 'Regular');
        $xls->getActiveSheet()->getStyle('A11:O11')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->getStartColor()->setRGB('eaeaea');

        $arrayP4 = [];
        foreach ($pqs[0] as $valueP4) {
            if ($valueP4['sla_id'] == 4) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 12;
        $id = 0;
        foreach ($arrayP4 as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['queue_finish_name'])
                    ->setCellValue('F' . $i, $value['user_finish'])
                    ->setCellValue('G' . $i, $value['send_to'])
                    ->setCellValue('H' . $i, $value['send_time'])
                    ->setCellValue('I' . $i, $value['vote_time'])
                    ->setCellValue('J' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('K' . $i, $value['question'])
                ->setCellValue('L' . $i, $value['answer'])
                ->setCellValue('M' . $i, $value['satisfaction'])
                ->setCellValue('N' . $i, $value['nosatisfaction'])
                ->setCellValue('O' . $i, $value['regular'])
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B12:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "$pqs[4]");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L12:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L12:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L12:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L12:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B9", "=COUNTIFS(L12:L$i,\"Péssimo\")");

        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário Tickets Prioridade 3 IN - Sla 4 Horas')
            ->setCellValue('A3', 'Total de PQS Enviadas e Respondidas')
            ->setCellValue('A4', 'Total de PQS Enviadas e Não Respondidas')
            ->setCellValue('A5', 'Total de Ótimo')
            ->setCellValue('A6', 'Total de Bom')
            ->setCellValue('A7', 'Total de Regular')
            ->setCellValue('A8', 'Total de Ruim')
            ->setCellValue('A9', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS Prioridade 3 IN');
        $xls->getActiveSheet()->getStyle('A1:B9')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(59);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A11', 'Nº Ticket')
            ->setCellValue('B11', 'Ticket ID')
            ->setCellValue('C11', 'Título')
            ->setCellValue('D11', 'Tipo')
            ->setCellValue('E11', 'Fila Fechamento')
            ->setCellValue('F11', 'Usuário Fechamento')
            ->setCellValue('G11', 'Cliente')
            ->setCellValue('H11', 'Envio')
            ->setCellValue('I11', 'Resposta')
            ->setCellValue('J11', 'Chave Verificação')
            ->setCellValue('K11', 'Pergunta')
            ->setCellValue('L11', 'Resposta')
            ->setCellValue('M11', 'Satisfação')
            ->setCellValue('N11', 'Insatisfação')
            ->setCellValue('O11', 'Regular');
        $xls->getActiveSheet()->getStyle('A11:O11')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->getStartColor()->setRGB('eaeaea');

        $arrayP5 = [];
        foreach ($pqs[0] as $valueP5) {
            if ($valueP5['sla_id'] == 5) {
                $arrayP5[] = $valueP5;
            }
        }

        $i = 12;
        $id = 0;
        foreach ($arrayP5 as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['queue_finish_name'])
                    ->setCellValue('F' . $i, $value['user_finish'])
                    ->setCellValue('G' . $i, $value['send_to'])
                    ->setCellValue('H' . $i, $value['send_time'])
                    ->setCellValue('I' . $i, $value['vote_time'])
                    ->setCellValue('J' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('K' . $i, $value['question'])
                ->setCellValue('L' . $i, $value['answer'])
                ->setCellValue('M' . $i, $value['satisfaction'])
                ->setCellValue('N' . $i, $value['nosatisfaction'])
                ->setCellValue('O' . $i, $value['regular'])
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B12:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "$pqs[5]");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L12:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L12:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L12:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L12:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B9", "=COUNTIFS(L12:L$i,\"Péssimo\")");

        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário Tickets Prioridade 1 - Sla 1 Hora')
            ->setCellValue('A3', 'Total de PQS Enviadas e Respondidas')
            ->setCellValue('A4', 'Total de PQS Enviadas e Não Respondidas')
            ->setCellValue('A5', 'Total de Ótimo')
            ->setCellValue('A6', 'Total de Bom')
            ->setCellValue('A7', 'Total de Regular')
            ->setCellValue('A8', 'Total de Ruim')
            ->setCellValue('A9', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS Prioridade 1');
        $xls->getActiveSheet()->getStyle('A1:B9')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(59);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B9')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A11', 'Nº Ticket')
            ->setCellValue('B11', 'Ticket ID')
            ->setCellValue('C11', 'Título')
            ->setCellValue('D11', 'Tipo')
            ->setCellValue('E11', 'Fila Fechamento')
            ->setCellValue('F11', 'Usuário Fechamento')
            ->setCellValue('G11', 'Cliente')
            ->setCellValue('H11', 'Envio')
            ->setCellValue('I11', 'Resposta')
            ->setCellValue('J11', 'Chave Verificação')
            ->setCellValue('K11', 'Pergunta')
            ->setCellValue('L11', 'Resposta')
            ->setCellValue('M11', 'Satisfação')
            ->setCellValue('N11', 'Insatisfação')
            ->setCellValue('O11', 'Regular');
        $xls->getActiveSheet()->getStyle('A11:O11')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A11:O11')->getFill()->getStartColor()->setRGB('eaeaea');

        $arrayP6 = [];
        foreach ($pqs[0] as $valueP6) {
            if ($valueP6['sla_id'] == 6) {
                $arrayP6[] = $valueP6;
            }
        }

        $i = 12;
        $id = 0;
        foreach ($arrayP6 as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['queue_finish_name'])
                    ->setCellValue('F' . $i, $value['user_finish'])
                    ->setCellValue('G' . $i, $value['send_to'])
                    ->setCellValue('H' . $i, $value['send_time'])
                    ->setCellValue('I' . $i, $value['vote_time'])
                    ->setCellValue('J' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('K' . $i, $value['question'])
                ->setCellValue('L' . $i, $value['answer'])
                ->setCellValue('M' . $i, $value['satisfaction'])
                ->setCellValue('N' . $i, $value['nosatisfaction'])
                ->setCellValue('O' . $i, $value['regular'])
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B12:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "$pqs[6]");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L12:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L12:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L12:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L12:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B9", "=COUNTIFS(L12:L$i,\"Péssimo\")");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS11($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS11' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS11' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS11
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS11')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Prioridade Alta Tratados Até 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS11 Prioridade 1');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(51);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS11();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1 || $valueP1['sla_id'] == 6) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, $item['tempo_primeiro_atendimento']);
            if ($item['tempo_primeiro_atendimento'] >= 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS11')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Prioridade Média Tratados Até 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS11 Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(51);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst[0] as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, $item['tempo_primeiro_atendimento']);
            if ($item['tempo_primeiro_atendimento'] >= 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[2]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS11')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Prioridade Baixa Tratados Até 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS11 Prioridade 3');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(51);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst[0] as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, $item['tempo_primeiro_atendimento']);
            if ($item['tempo_primeiro_atendimento'] >= 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[3]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS12($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS12' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS12' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS12
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS12')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Requisição Backlog Vip')
            ->setCellValue('A5', 'Total de Tickets Requisição Recebidos Vip')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS12 VIP');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        //$xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS12();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS12')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Requisição Backlog Prioridade 2')
            ->setCellValue('A5', 'Total de Tickets Requisição Recebidos Prioridade 2')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS12 Prioridade 2');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        //$xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst[0] as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[2]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS12')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Requisição Backlog Prioridade 3')
            ->setCellValue('A5', 'Total de Tickets Requisição Recebidos Prioridade 3')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS12 Prioridade 3');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        //$xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst[0] as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[3]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS12')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Requisição Backlog Prioridade 1')
            ->setCellValue('A5', 'Total de Tickets Requisição Recebidos Prioridade 1')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS12 Prioridade 1');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        //$xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP4 = [];
        foreach ($rst[0] as $valueP4) {
            if ($valueP4['sla_id'] == 6) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[4]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS13($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS13' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS13' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS13
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS13')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Incidentes Backlog Vip')
            ->setCellValue('A5', 'Total de Tickets Incidentes Recebidos Vip')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS13 VIP');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $rst = $model->rptKPIINS13();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS13')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Incidentes Backlog Prioridade 2')
            ->setCellValue('A5', 'Total de Tickets Incidentes Recebidos Prioridade 2')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS13 Prioridade 2');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $arrayP2 = [];
        foreach ($rst[0] as $valueP2) {
            if ($valueP2['sla_id'] == 4) {
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[2]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS13')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Incidentes Backlog Prioridade 3')
            ->setCellValue('A5', 'Total de Tickets Incidentes Recebidos Prioridade 3')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS13 Prioridade 3');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $arrayP3 = [];
        foreach ($rst[0] as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[3]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS13')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Incidentes Backlog Prioridade 1')
            ->setCellValue('A5', 'Total de Tickets Incidentes Recebidos Prioridade 1')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS13 Prioridade 1');
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
            ->setCellValue('Q8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Q8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $arrayP4 = [];
        foreach ($rst[0] as $valueP4) {
            if ($valueP4['sla_id'] == 6) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
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
                ->setCellValue('Q' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[4]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS14($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS14' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS14' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS14
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS14')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Problemas Solucionados dentro SLA 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS14 Prioridade 1');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS14();

        $arrayP1 = [];
        foreach ($rst[0] as $valueP1) {
            if ($valueP1['sla_id'] == 1 || $valueP1['sla_id'] == 6) {
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS14')
            ->setCellValue('A2', '95% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Problemas Solucionados dentro SLA 3 Horas')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS14 Prioridade 2');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst[0] as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        $t1 = 0;
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t1 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t1 > 10800) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=10800")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[2]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS14')
            ->setCellValue('A2', '90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets Problemas Solucionados dentro SLA 6 Horas')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS14 Prioridade 3');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst[0] as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t2 > 21600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=21600")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[3]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS15($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS15' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS15' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS15
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS15')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets de Resolvidos para Atendidos')
            ->setCellValue('A5', 'Total de Tickets Resolvidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS15 Vip');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS15();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['check_ticket']) || $item['check_ticket'] != NULL ? $item['check_ticket'] : null);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=B5-COUNTIF(AB9:AB'.$i.',"=0")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(AB9:AB'.$i.',"=1")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS15')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets de Resolvidos para Atendidos')
            ->setCellValue('A5', 'Total de Tickets Resolvidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS15 Prioridade 2');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        $t1 = 0;
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['check_ticket']) || $item['check_ticket'] != NULL ? $item['check_ticket'] : null);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=B5-COUNTIF(AB9:AB'.$i.',"=0")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(AB9:AB'.$i.',"=1")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS15')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets de Resolvidos para Atendidos')
            ->setCellValue('A5', 'Total de Tickets Resolvidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS15 Prioridade 3');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['check_ticket']) || $item['check_ticket'] != NULL ? $item['check_ticket'] : null);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=B5-COUNTIF(AB9:AB'.$i.',"=0")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(AB9:AB'.$i.',"=1")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS15')
            ->setCellValue('A2', '10% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets de Resolvidos para Atendidos')
            ->setCellValue('A5', 'Total de Tickets Resolvidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS15 Prioridade 1');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if ($valueP4['sla_id'] == 6) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
        $t3 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']) : null)
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['check_ticket']) || $item['check_ticket'] != NULL ? $item['check_ticket'] : null);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=B5-COUNTIF(AB9:AB'.$i.',"=0")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(AB9:AB'.$i.',"=1")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS16($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS16' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS16' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS16
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS16')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Notas Após Resolução')
            ->setCellValue('A5', 'Total de Tickets Recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS16 Prioridade 1');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Data da Nota')
            ->setCellValue('AB8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AD')->setVisible(FALSE);

        $rst = $model->rptKPIINS16();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1 || $valueP1['sla_id'] == 6) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['data_nota'])
                ->setCellValue('AB' . $i, $item['sla'])
                ->setCellValue('AC' . $i, !empty($item['data_nota']) || $item['data_nota'] != NULL ? 1 : 0);
            if ($item['data_nota'] == NULL) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AC9:CB'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(B9:B$i,\">0\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS16')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Notas Após Resolução')
            ->setCellValue('A5', 'Total de Tickets Recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS16 Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Data da Nota')
            ->setCellValue('AB8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AD')->setVisible(FALSE);

        $rst = $model->rptKPIINS16();

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2 || $valueP2['sla_id'] == 4) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['data_nota'])
                ->setCellValue('AB' . $i, $item['sla'])
                ->setCellValue('AC' . $i, !empty($item['data_nota']) || $item['data_nota'] != NULL ? 1 : 0);
            if ($item['data_nota'] == NULL) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AC9:CB'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(B9:B$i,\">0\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS16')
            ->setCellValue('A2', '100% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Notas Após Resolução')
            ->setCellValue('A5', 'Total de Tickets Recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS16 Prioridade 3');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Data da Nota')
            ->setCellValue('AB8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AB8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AD')->setVisible(FALSE);

        $rst = $model->rptKPIINS16();

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3 || $valueP3['sla_id'] == 5) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['data_nota'])
                ->setCellValue('AB' . $i, $item['sla'])
                ->setCellValue('AC' . $i, !empty($item['data_nota']) || $item['data_nota'] != NULL ? 1 : 0);
            if ($item['data_nota'] == NULL) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AC9:CB'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(B9:B$i,\">0\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS17($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS17' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS17' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS17
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS17')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Reabertos Vip - 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Vip')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS17 VIP');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
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
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'E-mail Solicitante')
            ->setCellValue('I8', 'Status')
            ->setCellValue('J8', 'Data de Criação')
            ->setCellValue('K8', 'Fila de Criação')
            ->setCellValue('L8', 'Primeiro Proprietário')
            ->setCellValue('M8', 'Data Primeiro Proprietário')
            ->setCellValue('N8', 'Fila Primeiro Proprietário')
            ->setCellValue('O8', 'Data Primeira Fila')
            ->setCellValue('P8', 'Primeira Fila')
            ->setCellValue('Q8', 'Atendente Primeira Fila')
            ->setCellValue('R8', 'Data Resolução')
            ->setCellValue('S8', 'Fila Resolução')
            ->setCellValue('T8', 'Atendente Resolução')
            ->setCellValue('U8', 'Data Atendimento')
            ->setCellValue('V8', 'Fila Atendimento')
            ->setCellValue('W8', 'Atendente Atendimento')
            ->setCellValue('X8', 'Sla');
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

        $rst = $model->rptKPIINS17();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
                ->setCellValue('G' . $i, $item['customer'])
                ->setCellValue('H' . $i, $item['email_customer'])
                ->setCellValue('I' . $i, $item['status'])
                ->setCellValue('J' . $i, $item['data_criacao'])
                ->setCellValue('K' . $i, $item['fila_criacao'])
                ->setCellValue('L' . $i, $item['user_name_first_owner'])
                ->setCellValue('M' . $i, $item['data_first_owner'])
                ->setCellValue('N' . $i, $item['queue_name_first_owner'])
                ->setCellValue('O' . $i, $item['data_first_queue'])
                ->setCellValue('P' . $i, $item['first_queue_name'])
                ->setCellValue('Q' . $i, $item['user_name_first_queue'])
                ->setCellValue('R' . $i, $item['data_resolucao'])
                ->setCellValue('S' . $i, $item['queue_name_resolucao'])
                ->setCellValue('T' . $i, $item['user_name_resolucao'])
                ->setCellValue('U' . $i, $item['data_atendimento'])
                ->setCellValue('V' . $i, $item['fila_atendimento'])
                ->setCellValue('W' . $i, $item['user_name_atendimento'])
                ->setCellValue('X' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        //$xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        //$xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        //$xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS17')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Reabertos Prioridade 2 - 3 Horas')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Prioridade 2')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS17 Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(12);
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
            ->setCellValue('H8', 'E-mail Solicitante')
            ->setCellValue('I8', 'Status')
            ->setCellValue('J8', 'Data de Criação')
            ->setCellValue('K8', 'Fila de Criação')
            ->setCellValue('L8', 'Primeiro Proprietário')
            ->setCellValue('M8', 'Data Primeiro Proprietário')
            ->setCellValue('N8', 'Fila Primeiro Proprietário')
            ->setCellValue('O8', 'Data Primeira Fila')
            ->setCellValue('P8', 'Primeira Fila')
            ->setCellValue('Q8', 'Atendente Primeira Fila')
            ->setCellValue('R8', 'Data Resolução')
            ->setCellValue('S8', 'Fila Resolução')
            ->setCellValue('T8', 'Atendente Resolução')
            ->setCellValue('U8', 'Data Atendimento')
            ->setCellValue('V8', 'Fila Atendimento')
            ->setCellValue('W8', 'Atendente Atendimento')
            ->setCellValue('X8', 'Sla');
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

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
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
                ->setCellValue('G' . $i, $item['customer'])
                ->setCellValue('H' . $i, $item['email_customer'])
                ->setCellValue('I' . $i, $item['status'])
                ->setCellValue('J' . $i, $item['data_criacao'])
                ->setCellValue('K' . $i, $item['fila_criacao'])
                ->setCellValue('L' . $i, $item['user_name_first_owner'])
                ->setCellValue('M' . $i, $item['data_first_owner'])
                ->setCellValue('N' . $i, $item['queue_name_first_owner'])
                ->setCellValue('O' . $i, $item['data_first_queue'])
                ->setCellValue('P' . $i, $item['first_queue_name'])
                ->setCellValue('Q' . $i, $item['user_name_first_queue'])
                ->setCellValue('R' . $i, $item['data_resolucao'])
                ->setCellValue('S' . $i, $item['queue_name_resolucao'])
                ->setCellValue('T' . $i, $item['user_name_resolucao'])
                ->setCellValue('U' . $i, $item['data_atendimento'])
                ->setCellValue('V' . $i, $item['fila_atendimento'])
                ->setCellValue('W' . $i, $item['user_name_atendimento'])
                ->setCellValue('X' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        //$xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        //$xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        //$xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS17')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Reabertos Prioridade 3 - 6 Horas')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Prioridade 3')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS17 Prioridade 3');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(12);
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
            ->setCellValue('H8', 'E-mail Solicitante')
            ->setCellValue('I8', 'Status')
            ->setCellValue('J8', 'Data de Criação')
            ->setCellValue('K8', 'Fila de Criação')
            ->setCellValue('L8', 'Primeiro Proprietário')
            ->setCellValue('M8', 'Data Primeiro Proprietário')
            ->setCellValue('N8', 'Fila Primeiro Proprietário')
            ->setCellValue('O8', 'Data Primeira Fila')
            ->setCellValue('P8', 'Primeira Fila')
            ->setCellValue('Q8', 'Atendente Primeira Fila')
            ->setCellValue('R8', 'Data Resolução')
            ->setCellValue('S8', 'Fila Resolução')
            ->setCellValue('T8', 'Atendente Resolução')
            ->setCellValue('U8', 'Data Atendimento')
            ->setCellValue('V8', 'Fila Atendimento')
            ->setCellValue('W8', 'Atendente Atendimento')
            ->setCellValue('X8', 'Sla');
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

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
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
                ->setCellValue('G' . $i, $item['customer'])
                ->setCellValue('H' . $i, $item['email_customer'])
                ->setCellValue('I' . $i, $item['status'])
                ->setCellValue('J' . $i, $item['data_criacao'])
                ->setCellValue('K' . $i, $item['fila_criacao'])
                ->setCellValue('L' . $i, $item['user_name_first_owner'])
                ->setCellValue('M' . $i, $item['data_first_owner'])
                ->setCellValue('N' . $i, $item['queue_name_first_owner'])
                ->setCellValue('O' . $i, $item['data_first_queue'])
                ->setCellValue('P' . $i, $item['first_queue_name'])
                ->setCellValue('Q' . $i, $item['user_name_first_queue'])
                ->setCellValue('R' . $i, $item['data_resolucao'])
                ->setCellValue('S' . $i, $item['queue_name_resolucao'])
                ->setCellValue('T' . $i, $item['user_name_resolucao'])
                ->setCellValue('U' . $i, $item['data_atendimento'])
                ->setCellValue('V' . $i, $item['fila_atendimento'])
                ->setCellValue('W' . $i, $item['user_name_atendimento'])
                ->setCellValue('X' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        //$xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        //$xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        //$xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS17')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Incidentes Reabertos Prioridade 2 - 2 Horas')
            ->setCellValue('A5', 'Total de Tickets Incidentes Resolvidos Prioridade 2')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS17 Prioridade 2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(12);
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
            ->setCellValue('H8', 'E-mail Solicitante')
            ->setCellValue('I8', 'Status')
            ->setCellValue('J8', 'Data de Criação')
            ->setCellValue('K8', 'Fila de Criação')
            ->setCellValue('L8', 'Primeiro Proprietário')
            ->setCellValue('M8', 'Data Primeiro Proprietário')
            ->setCellValue('N8', 'Fila Primeiro Proprietário')
            ->setCellValue('O8', 'Data Primeira Fila')
            ->setCellValue('P8', 'Primeira Fila')
            ->setCellValue('Q8', 'Atendente Primeira Fila')
            ->setCellValue('R8', 'Data Resolução')
            ->setCellValue('S8', 'Fila Resolução')
            ->setCellValue('T8', 'Atendente Resolução')
            ->setCellValue('U8', 'Data Atendimento')
            ->setCellValue('V8', 'Fila Atendimento')
            ->setCellValue('W8', 'Atendente Atendimento')
            ->setCellValue('X8', 'Sla');
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

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if ($valueP4['sla_id'] == 4) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
        foreach ($arrayP4 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['customer'])
                ->setCellValue('H' . $i, $item['email_customer'])
                ->setCellValue('I' . $i, $item['status'])
                ->setCellValue('J' . $i, $item['data_criacao'])
                ->setCellValue('K' . $i, $item['fila_criacao'])
                ->setCellValue('L' . $i, $item['user_name_first_owner'])
                ->setCellValue('M' . $i, $item['data_first_owner'])
                ->setCellValue('N' . $i, $item['queue_name_first_owner'])
                ->setCellValue('O' . $i, $item['data_first_queue'])
                ->setCellValue('P' . $i, $item['first_queue_name'])
                ->setCellValue('Q' . $i, $item['user_name_first_queue'])
                ->setCellValue('R' . $i, $item['data_resolucao'])
                ->setCellValue('S' . $i, $item['queue_name_resolucao'])
                ->setCellValue('T' . $i, $item['user_name_resolucao'])
                ->setCellValue('U' . $i, $item['data_atendimento'])
                ->setCellValue('V' . $i, $item['fila_atendimento'])
                ->setCellValue('W' . $i, $item['user_name_atendimento'])
                ->setCellValue('X' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        //$xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        //$xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        //$xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS17')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Incidentes Reabertos Prioridade 4 - 4 Horas')
            ->setCellValue('A5', 'Total de Tickets Incidentes Resolvidos Prioridade 4')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS17 Prioridade 4');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(12);
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
            ->setCellValue('H8', 'E-mail Solicitante')
            ->setCellValue('I8', 'Status')
            ->setCellValue('J8', 'Data de Criação')
            ->setCellValue('K8', 'Fila de Criação')
            ->setCellValue('L8', 'Primeiro Proprietário')
            ->setCellValue('M8', 'Data Primeiro Proprietário')
            ->setCellValue('N8', 'Fila Primeiro Proprietário')
            ->setCellValue('O8', 'Data Primeira Fila')
            ->setCellValue('P8', 'Primeira Fila')
            ->setCellValue('Q8', 'Atendente Primeira Fila')
            ->setCellValue('R8', 'Data Resolução')
            ->setCellValue('S8', 'Fila Resolução')
            ->setCellValue('T8', 'Atendente Resolução')
            ->setCellValue('U8', 'Data Atendimento')
            ->setCellValue('V8', 'Fila Atendimento')
            ->setCellValue('W8', 'Atendente Atendimento')
            ->setCellValue('X8', 'Sla');
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

        $arrayP5 = [];
        foreach ($rst as $valueP5) {
            if ($valueP5['sla_id'] == 5) {
                $arrayP5[] = $valueP5;
            }
        }

        $i = 9;
        foreach ($arrayP5 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['customer'])
                ->setCellValue('H' . $i, $item['email_customer'])
                ->setCellValue('I' . $i, $item['status'])
                ->setCellValue('J' . $i, $item['data_criacao'])
                ->setCellValue('K' . $i, $item['fila_criacao'])
                ->setCellValue('L' . $i, $item['user_name_first_owner'])
                ->setCellValue('M' . $i, $item['data_first_owner'])
                ->setCellValue('N' . $i, $item['queue_name_first_owner'])
                ->setCellValue('O' . $i, $item['data_first_queue'])
                ->setCellValue('P' . $i, $item['first_queue_name'])
                ->setCellValue('Q' . $i, $item['user_name_first_queue'])
                ->setCellValue('R' . $i, $item['data_resolucao'])
                ->setCellValue('S' . $i, $item['queue_name_resolucao'])
                ->setCellValue('T' . $i, $item['user_name_resolucao'])
                ->setCellValue('U' . $i, $item['data_atendimento'])
                ->setCellValue('V' . $i, $item['fila_atendimento'])
                ->setCellValue('W' . $i, $item['user_name_atendimento'])
                ->setCellValue('X' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        //$xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        //$xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        //$xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS17')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Reabertos Prioridade 1 - 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Prioridade 1')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS17 Prioridade 1');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(56);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(12);
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
            ->setCellValue('H8', 'E-mail Solicitante')
            ->setCellValue('I8', 'Status')
            ->setCellValue('J8', 'Data de Criação')
            ->setCellValue('K8', 'Fila de Criação')
            ->setCellValue('L8', 'Primeiro Proprietário')
            ->setCellValue('M8', 'Data Primeiro Proprietário')
            ->setCellValue('N8', 'Fila Primeiro Proprietário')
            ->setCellValue('O8', 'Data Primeira Fila')
            ->setCellValue('P8', 'Primeira Fila')
            ->setCellValue('Q8', 'Atendente Primeira Fila')
            ->setCellValue('R8', 'Data Resolução')
            ->setCellValue('S8', 'Fila Resolução')
            ->setCellValue('T8', 'Atendente Resolução')
            ->setCellValue('U8', 'Data Atendimento')
            ->setCellValue('V8', 'Fila Atendimento')
            ->setCellValue('W8', 'Atendente Atendimento')
            ->setCellValue('X8', 'Sla');
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

        $arrayP6 = [];
        foreach ($rst as $valueP6) {
            if ($valueP6['sla_id'] == 6) {
                $arrayP6[] = $valueP6;
            }
        }

        $i = 9;
        foreach ($arrayP6 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['ticket'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['id'])
                ->setCellValue('C' . $i, $item['titulo'])
                ->setCellValue('D' . $i, $item['tipo'])
                ->setCellValue('E' . $i, $item['prioridade'])
                ->setCellValue('F' . $i, !empty($item['servico']) || $item['servico'] != NULL ? $item['servico'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('G' . $i, $item['customer'])
                ->setCellValue('H' . $i, $item['email_customer'])
                ->setCellValue('I' . $i, $item['status'])
                ->setCellValue('J' . $i, $item['data_criacao'])
                ->setCellValue('K' . $i, $item['fila_criacao'])
                ->setCellValue('L' . $i, $item['user_name_first_owner'])
                ->setCellValue('M' . $i, $item['data_first_owner'])
                ->setCellValue('N' . $i, $item['queue_name_first_owner'])
                ->setCellValue('O' . $i, $item['data_first_queue'])
                ->setCellValue('P' . $i, $item['first_queue_name'])
                ->setCellValue('Q' . $i, $item['user_name_first_queue'])
                ->setCellValue('R' . $i, $item['data_resolucao'])
                ->setCellValue('S' . $i, $item['queue_name_resolucao'])
                ->setCellValue('T' . $i, $item['user_name_resolucao'])
                ->setCellValue('U' . $i, $item['data_atendimento'])
                ->setCellValue('V' . $i, $item['fila_atendimento'])
                ->setCellValue('W' . $i, $item['user_name_atendimento'])
                ->setCellValue('X' . $i, $item['sla']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        //$xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');
        //$xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        //$xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS18($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS18' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS18' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS18
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Sem Tratamento Mesmo Dia INS18')
            ->setCellValue('A2', '100% dos Chamados Abertos')
            ->setCellValue('A4', 'Total de Tickets Tratados Fora Dia Abertura')
            ->setCellValue('A5', 'Total de Tickets Recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS18');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Data Primeiro Tratamento');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS18();

        $i = 9;
        foreach ($rst[0] as $item) {
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
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['data_first_owner'])
                ->setCellValue('AB' . $i, !empty($item['ticket_next_day']) || $item['ticket_next_day'] != NULL ? 1 : 0);
            if ($item['ticket_next_day'] > 0) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "$rst[1]");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS23($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS23' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS23' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS23
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS23')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Vip Resolvidos com E-mail Enviado Dinfo')
            ->setCellValue('A5', 'Total de Tickets Vip Resolvidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS23 VIP');
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
            ->setCellValue('T8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        //$xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS23();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, !empty($item['sla']) || $item['sla'] != NULL ? $item['sla'] : 'Sla Informado na Abertura do Chamado')
                ->setCellValue('U' . $i, $item['check_email']);
            if ($item['check_email'] == 1) {
                $xls->getActiveSheet()->getStyle("A$i:T$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(U9:U'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS23')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Resolvidos Prioridade 2 com E-mail Enviado Dinfo')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Prioridade 2')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS23 Prioridade 2');
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
            ->setCellValue('T8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, !empty($item['sla']) || $item['sla'] != NULL ? $item['sla'] : 'Sla Informado na Abertura do Chamado')
                ->setCellValue('U' . $i, $item['check_email']);
            if ($item['check_email'] == 1) {
                $xls->getActiveSheet()->getStyle("A$i:T$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(U9:U'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS23')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Resolvidos Prioridade 3 com E-mail Enviado Dinfo')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Prioridade 3')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS23 Prioridade 3');
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
            ->setCellValue('T8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, !empty($item['sla']) || $item['sla'] != NULL ? $item['sla'] : 'Sla Informado na Abertura do Chamado')
                ->setCellValue('U' . $i, $item['check_email']);
            if ($item['check_email'] == 1) {
                $xls->getActiveSheet()->getStyle("A$i:T$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(U9:U'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS23')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Tickets Resolvidos Prioridade 1 com E-mail Enviado Dinfo')
            ->setCellValue('A5', 'Total de Tickets Resolvidos Prioridade 1')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS23 Prioridade 1');
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
            ->setCellValue('T8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Q8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if ($valueP4['sla_id'] == 6) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
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
                ->setCellValue('T' . $i, !empty($item['sla']) || $item['sla'] != NULL ? $item['sla'] : 'Sla Informado na Abertura do Chamado')
                ->setCellValue('U' . $i, $item['check_email']);
            if ($item['check_email'] == 1) {
                $xls->getActiveSheet()->getStyle("A$i:T$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(U9:U'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS26($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS26' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS26' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS26
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Média Geral INS26')
            ->setCellValue('A2', 'Tempo entre a notificação do problema e o diagnóstico do erro conhecido')
            ->setCellValue('A4', 'Tempo Médio do Total de Tickets Tratados')
            ->setCellValue('A5', 'Tempo Médio (Limite)')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS26');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Tempo Primeiro Tratamento');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst1 = $model->rptKPIINS26();

        $i = 9;
        foreach ($rst1[0] as $item) {
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
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['time_first_tratamento'])
                ->setCellValue('AB' . $i, FksUtils::timeToInt($item['time_first_tratamento']));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("B4")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME6);
        $xls->getActiveSheet()->setCellValue('AC9', "=SUM(AB9:AB$i)/$rst1[1]");
        $xls->getActiveSheet()->setCellValue('B4', "=TIME(AC9/3600,MOD(AC9/60,60),MOD(AC9,60))");
        $xls->getActiveSheet()->setCellValue("B5", "00:05:00");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=(SUM(AB9:AB$i)/$rst1[1])/(60*5)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS27($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS27' . FunarteExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS27' . FunarteExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - INS27
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS27')
            ->setCellValue('A2', '80% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets RDM Solucionados dentro SLA Vip')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS27 Vip');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $rst = $model->rptKPIINS27();

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if ($valueP1['sla_id'] == 1) {
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS27')
            ->setCellValue('A2', '80% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets RDM Solucionados dentro SLA 3 Horas')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS27 Prioridade 2');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if ($valueP2['sla_id'] == 2) {
                $arrayP2[] = $valueP2;
            }
        }

        $i = 9;
        $t1 = 0;
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
                ->setCellValue('Q' . $i, $item['data_resolucao'])
                ->setCellValue('R' . $i, $item['queue_name_resolucao'])
                ->setCellValue('S' . $i, $item['user_name_resolucao'])
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t1 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t1 > 10800) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=10800")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS27')
            ->setCellValue('A2', '80% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets RDM Solucionados dentro SLA 6 Horas')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS27 Prioridade 3');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if ($valueP3['sla_id'] == 3) {
                $arrayP3[] = $valueP3;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t2 > 21600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=21600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS27')
            ->setCellValue('A2', '80% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Tickets RDM Solucionados dentro SLA 1 Hora')
            ->setCellValue('A5', 'Total de Tickets Recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS27 Prioridade 1');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('V8', 'Fila de Atendimento')
            ->setCellValue('W8', 'Data de Atendimento')
            ->setCellValue('X8', 'Atendente Fila de Atendimento')
            ->setCellValue('Y8', 'Tempo Fila de Atendimento')
            ->setCellValue('Z8', 'Tempo Total do Atendimento')
            ->setCellValue('AA8', 'Sla');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if ($valueP4['sla_id'] == 6) {
                $arrayP4[] = $valueP4;
            }
        }

        $i = 9;
        $t2 = 0;
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
                ->setCellValue('T' . $i, $item['tempo_pendente_fila_resolucao'])
                ->setCellValue('U' . $i, $item['tempo_aberto_fila_resolucao'])
                ->setCellValue('V' . $i, !empty($item['fila_atendimento']) || $item['fila_atendimento'] != NULL ? $item['fila_atendimento'] : null)
                ->setCellValue('W' . $i, !empty($item['data_atendimento']) || $item['data_atendimento'] != NULL ? $item['data_atendimento'] : null)
                ->setCellValue('X' . $i, !empty($item['user_name_atendimento']) || $item['user_name_atendimento'] != NULL ? $item['user_name_atendimento'] : null)
                ->setCellValue('Y' . $i, !empty($item['tempo_fila_atendimento']) || $item['tempo_fila_atendimento'] != NULL ? $item['tempo_fila_atendimento'] : null)
                ->setCellValue('Z' . $i, FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento']))
                ->setCellValue('AA' . $i, $item['sla'])
                ->setCellValue('AB' . $i, !empty($item['tempo_aberto_fila_resolucao']) || $item['tempo_aberto_fila_resolucao'] != NULL ? $t2 = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimento($item['tempo_aberto_fila_resolucao'], $item['tempo_fila_atendimento'])) : 0);
            if ($t2 > 3600) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(AB9:AB'.$i.',"<=3600")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FunarteExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}