<?php

class FraportExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiFraport $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . FraportExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . FraportExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI - SLA de 08 Horas
        $slaSecond = (8 * 3600);
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 08 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 08 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $rst = $model->rptKPIReport();
        $array = [];
        foreach ($rst as $value8) {
            if ($value8['sla_id'] == 1) {
                $array[] = $value8;
            }
        }

        $i = 9;
        if (!empty($array) || $array != null) {
            foreach ($array as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI - SLA de 12 Horas
        $slaSecond = (12 * 3600);
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 12 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 12 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array12 = [];
        foreach ($rst as $value12) {
            if ($value12['sla_id'] == 2) {
                $array12[] = $value12;
            }
        }

        $i = 9;
        if (!empty($array12) || $array12 != null) {
            foreach ($array12 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI - SLA de 16 Horas
        $slaSecond = (16 * 3600);
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 16 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 16 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array16 = [];
        foreach ($rst as $value16) {
            if ($value16['sla_id'] == 3) {
                $array16[] = $value16;
            }
        }

        $i = 9;
        if (!empty($array16) || $array16 != null) {
            foreach ($array16 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI - SLA de 18 Horas
        $slaSecond = (18 * 3600);
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 18 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 18 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array18 = [];
        foreach ($rst as $value18) {
            if ($value18['sla_id'] == 4) {
                $array18[] = $value18;
            }
        }

        $i = 9;
        if (!empty($array18) || $array18 != null) {
            foreach ($array18 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI - SLA de 24 Horas
        $slaSecond = (24 * 3600);
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 24 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 24 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array24 = [];
        foreach ($rst as $value24) {
            if ($value24['sla_id'] == 5) {
                $array24[] = $value24;
            }
        }

        $i = 9;
        if (!empty($array24) || $array24 != null) {
            foreach ($array24 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI - SLA de 42 Horas
        $slaSecond = (42 * 3600);
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 42 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 42 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array42 = "";
        foreach ($rst as $value42) {
            if ($value42['sla_id'] == 6) {
                $array42[] = $value42;
            }
        }

        $i = 9;
        if (!empty($array42) || $array42 != null) {
            foreach ($array42 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI - SLA de 48 Horas
        $slaSecond = (48 * 3600);
        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 48 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 48 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array48 = [];
        foreach ($rst as $value48) {
            if ($value48['sla_id'] == 7) {
                $array48[] = $value48;
            }
        }

        $i = 9;
        if (!empty($array48) || $array48 != null) {
            foreach ($array48 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI - SLA de 56 Horas
        $slaSecond = (56 * 3600);
        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
            ->setCellValue('A1', 'Relatório de Chamados com SLA de 56 Horas')
            ->setCellValue('A2', '> 90% dos Chamados Atendidos')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('SLA 56 Hrs');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $array56 = [];
        foreach ($rst as $value56) {
            if ($value56['sla_id'] == 8) {
                $array56[] = $value56;
            }
        }

        $i = 9;
        if (!empty($array56) || $array56 != null) {
            foreach ($array56 as $item) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $item['ticket_id'])
                    ->setCellValue('C' . $i, $item['title'])
                    ->setCellValue('D' . $i, $item['type_name'])
                    ->setCellValue('E' . $i, $item['priority_name'])
                    ->setCellValue('F' . $i, $item['state_name'])
                    ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                    ->setCellValue('H' . $i, $item['create_time'])
                    ->setCellValue('I' . $i, $item['queue_create_name'])
                    ->setCellValue('J' . $i, $item['name_ownwer'])
                    ->setCellValue('K' . $i, $item['date_first_owner'])
                    ->setCellValue('L' . $i, $item['first_queue_name'])
                    ->setCellValue('M' . $i, $item['date_resolution'])
                    ->setCellValue('N' . $i, $item['queue_resolution'])
                    ->setCellValue('O' . $i, $item['atendente_resolution'])
                    ->setCellValue('P' . $i, $item['data_encerramento'])
                    ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                    ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                    ->setCellValue('S' . $i, $item['timeResolution'])
                    ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                    ->setCellValue('U' . $i, $item['mes_ref'])
                    ->setCellValue('V' . $i, $item['solicitante'])
                    ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                    ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                    ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                    ->setCellValue('Z' . $i, 1);
                if ($item['time_rest_sla'] < "00:00:00") {
                    $xls->getActiveSheet()->getStyle("A$i:X$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
                }
                $i++;
            }
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Y9:Y'.$i.',"<='.$slaSecond.'")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(Z9:Z$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI - Geral SLA
        $xls->createSheet(8);
        $xls->setActiveSheetIndex(8)
            ->setCellValue('A1', 'Relatório de Chamados com SLAs Geral')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Geral');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Total Resolução')
            ->setCellValue('T8', 'Tempo na Fila de Resolução')
            ->setCellValue('U8', 'Mês Referência')
            ->setCellValue('V8', 'Solicitante')
            ->setCellValue('W8', 'Sla')
            ->setCellValue('X8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:X8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:X8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);

        $arrayGral = [];
        foreach ($rst as $valueGral) {
            if ($valueGral['time_rest_sla'] >= "00:00:00") {
                $arrayGral[] = $valueGral;
            }
        }

        $i = 9;
        foreach ($arrayGral as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['date_resolution'])
                ->setCellValue('N' . $i, $item['queue_resolution'])
                ->setCellValue('O' . $i, $item['atendente_resolution'])
                ->setCellValue('P' . $i, $item['data_encerramento'])
                ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['TimeQueueResolution'])
                ->setCellValue('U' . $i, $item['mes_ref'])
                ->setCellValue('V' . $i, $item['solicitante'])
                ->setCellValue('W' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                ->setCellValue('X' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                ->setCellValue('Y' . $i, !empty($item['TimeQueueResolution']) || $item['TimeQueueResolution'] !== NULL ? FksUtils::timeToInt($item['TimeQueueResolution']) : null)
                ->setCellValue('Z' . $i, 1);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', "=COUNTA(Z9:Z".$i.")");
        $xls->getActiveSheet()->setCellValue("B5", "='SLA 08 Hrs'!B5+'SLA 12 Hrs'!B5+'SLA 16 Hrs'!B5+'SLA 18 Hrs'!B5+'SLA 24 Hrs'!B5+'SLA 42 Hrs'!B5+'SLA 48 Hrs'!B5+'SLA 56 Hrs'!B5");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI - CHAMADOS CENTRAL DE SERVIÇOS FRAPORT
        $xls->createSheet(9);
        $xls->setActiveSheetIndex(9)
            ->setCellValue('A1', 'Relatório de Chamados Central de Serviços Fraport')
            ->setCellValue('A2', '')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('CS Fraport');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(50);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(85);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('S')->setWidth(38);
        $xls->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('X')->setWidth(31);
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Id')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Status')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Data de Criação')
            ->setCellValue('I8', 'Fila de Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Data Resolução')
            ->setCellValue('N8', 'Fila Resolução')
            ->setCellValue('O8', 'Atendente Resolução')
            ->setCellValue('P8', 'Data Encerramento')
            ->setCellValue('Q8', 'Tempo Primeiro Atendimento')
            ->setCellValue('R8', 'Tempo Pendente Central Serviços')
            ->setCellValue('S8', 'Tempo Pendente Central Serviços Fraport')
            ->setCellValue('T8', 'Tempo Total Resolução')
            ->setCellValue('U8', 'Tempo na Fila de Resolução')
            ->setCellValue('V8', 'Mês Referência')
            ->setCellValue('W8', 'Solicitante')
            ->setCellValue('X8', 'Sla')
            ->setCellValue('Y8', 'Sla Restante');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);

        $rstf = $model->rptKPIReportCSF();

        $i = 9;
        foreach ($rstf as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, !empty($item['service_name']) || $item['service_name'] != NULL ? $item['service_name'] : 'Serviço Não Informado na Abertura do Chamado')
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['date_resolution'])
                ->setCellValue('N' . $i, $item['queue_resolution'])
                ->setCellValue('O' . $i, $item['atendente_resolution'])
                ->setCellValue('P' . $i, $item['data_encerramento'])
                ->setCellValue('Q' . $i, $item['tempo_primeiro_atendimento'])
                ->setCellValue('R' . $i, $item['timePendingQueueCS'])
                ->setCellValue('S' . $i, $item['timePendingQueueCSF'])
                ->setCellValue('T' . $i, $item['timeResolution'])
                ->setCellValue('U' . $i, $item['TimeQueueResolution'])
                ->setCellValue('V' . $i, $item['mes_ref'])
                ->setCellValue('W' . $i, $item['solicitante'])
                ->setCellValue('X' . $i, !empty($item['sla']) || $item['sla'] !== NULL ? $item['sla'] : null)
                ->setCellValue('Y' . $i, !empty($item['time_rest_sla']) || $item['time_rest_sla'] !== NULL ? $item['time_rest_sla'] : null)
                ->setCellValue('Z' . $i, !empty($item['time_rest_sla_int']) || $item['time_rest_sla_int'] !== NULL ? $item['time_rest_sla_int'] : null)
                ->setCellValue('AA' . $i, 1);
            if ($item['time_rest_sla'] < "00:00:00") {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFDAB9');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(Z9:Z'.$i.',">=0")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(AA9:AA$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, FraportExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}