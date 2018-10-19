<?php

class AncineExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * 
     * @param KpiAncine $model
     * @return string
     */
    public static function generateXlsINS02($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS0203' . AncineExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS0203' . AncineExcel::extensao;

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
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02.03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 5 Minutos')
            ->setCellValue('A4', 'Total de Tickets Vip (Sla 1 Hora) com Início de Atendimento <= 5 Minutos')
            ->setCellValue('A5', 'Total de Tickets Vip (Sla 1 Hora) Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02.03 VIP');
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
        $typeIds = array(1,4,5);
        $slaIds = array(1,2);

        $arrayP1 = [];
        foreach ($rst as $valueP1) {
            if (in_array($valueP1['sla_id'], $slaIds) && in_array($valueP1['type_id'], $typeIds)) {
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
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02.03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 15 Minutos')
            ->setCellValue('A4', 'Total de Tickets Severidade 2 (Sla 4 Horas) com Início de Atendimento <= 15 Minutos')
            ->setCellValue('A5', 'Total de Tickets Severidade 2 (Sla 4 Horas) Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02.03 Severidade 2');
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

        $slaIds = array(3);

        $arrayP2 = [];
        foreach ($rst as $valueP2) {
            if (in_array($valueP2['sla_id'], $slaIds) && in_array($valueP2['type_id'], $typeIds)) {
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
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02.03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 20 Minutos')
            ->setCellValue('A4', 'Total de Tickets Severidade 3 (Sla 8 Horas) com Início de Atendimento <= 20 Minutos')
            ->setCellValue('A5', 'Total de Tickets Severidade 3 (Sla 8 Horas) Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02.03 Severidade 3');
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

        $slaIds = array(4);

        $arrayP3 = [];
        foreach ($rst as $valueP3) {
            if (in_array($valueP3['sla_id'], $slaIds) && in_array($valueP3['type_id'], $typeIds)) {
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
            if ($item['tempo_first_atendimento_second'] > 1200) {
                $xls->getActiveSheet()->getStyle("A$i:R$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(S9:S'.$i.',"<=1200")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIF(B9:B'.$i.',">0")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02.03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 5 Minutos')
            ->setCellValue('A4', 'Total de Tickets Incidentes Serviços Críticos com Início de Atendimento <= 5 Minutos')
            ->setCellValue('A5', 'Total de Tickets Incidentes Serviços Críticos Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02.03 IN Srv Críticos');
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

        $servicosIds = array(1376,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,1401,1402,1403,1404,1405,1406,1407,1408,
            1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,1432);
        $slaIdsP4 = array(2);
        $typeIdsIN = array(2);

        $arrayP4 = [];
        foreach ($rst as $valueP4) {
            if (in_array($valueP4['service_id'], $servicosIds) && in_array($valueP4['sla_id'], $slaIdsP4) &&
                in_array($valueP4['type_id'], $typeIdsIN)) {
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

        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Relatório de Chamados Tratados no Período INS02.03')
            ->setCellValue('A2', 'Tempo para início de atendimento <= 15 Minutos')
            ->setCellValue('A4', 'Total de Tickets Incidentes Serviços Não Críticos com Início de Atendimento <= 15 Minutos')
            ->setCellValue('A5', 'Total de Tickets Incidentes Serviços Não Críticos Solucionados')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('INS02.03 IN Srv Não Críticos');
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

        $slaIdsP5 = array(1,2,3,4);

        $arrayP5 = [];
        foreach ($rst as $valueP5) {
            if (!in_array($valueP5['service_id'], $servicosIds) && in_array($valueP5['sla_id'], $slaIdsP5) &&
                in_array($valueP5['type_id'], $typeIdsIN)) {
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

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AncineExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS04($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS0405' . AncineExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS0405' . AncineExcel::extensao;

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
            ->setCellValue('W8', 'Tempo Filas Ancine')
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
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoAncineV3($item['tempo_aberto'], $item['tempo_filas_ancine']))
                ->setCellValue('Y' . $i, !empty($item['tempo_aberto']) || $item['tempo_aberto'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimentoAncineV3($item['tempo_aberto'], $item['tempo_filas_ancine'])) : 0);
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
            ->setCellValue('W8', 'Tempo Filas Ancine')
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
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoAncineV3($item['tempo_aberto'], $item['tempo_filas_ancine']))
                ->setCellValue('Y' . $i, !empty($item['tempo_aberto']) || $item['tempo_aberto'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimentoAncineV3($item['tempo_aberto'], $item['tempo_filas_ancine'])) : 0);
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
            ->setCellValue('W8', 'Tempo Filas Ancine')
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
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoAncineV3($item['tempo_aberto'], $item['tempo_filas_ancine']))
                ->setCellValue('Y' . $i, !empty($item['tempo_aberto']) || $item['tempo_aberto'] != NULL ? $t = FksUtils::timeToInt(FksUtils::calculaTempoTotalAtendimentoAncineV3($item['tempo_aberto'], $item['tempo_filas_ancine'])) : 0);
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
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AncineExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINS07($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINS07' . AncineExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINS07' . AncineExcel::extensao;

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
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AncineExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    public static function generateXlsINSGeral($model) {

        $fileName = dirname(__FILE__) . '/../../assets/reportINSGeral' . AncineExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportINSGeral' . AncineExcel::extensao;

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
            ->setCellValue('W8', 'Tempo Filas Ancine')
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
                ->setCellValue('X' . $i, FksUtils::calculaTempoTotalAtendimentoAncine($item['tempo_sla'], $item['tempo_filas_ancine']));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("Q9:Q$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(B9:B'.$i.',">0")');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AncineExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}
