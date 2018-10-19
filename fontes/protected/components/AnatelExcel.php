<?php

class AnatelExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     *
     * @param KpiAnatel $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI 01 - Chamados Abertos Via Customer com Atendimento em até 15 minutos.
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Taxa de Chamados Abertos Via Customer com Atendimento em até 15 Minutos')
            ->setCellValue('A2', '> 96% dos Chamados de Responsabilidade da Central de Serviços')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N1 Customer 15 Min.');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Fechamento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução')
            ->setCellValue('S8', 'Tempo Primeiro Atendimento');
        $xls->getActiveSheet()->getStyle('A8:S8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->getStartColor()->setRGB('eaeaea');

        $serviceDeskIds = array(23);
        //$slaId = array(2);
        //$servicosIds = array(171);
        $rsl = $model->rptCS();

        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['create_time'])
                ->setCellValue('I' . $i, $value['queue_create_name'])
                ->setCellValue('J' . $i, $value['name_ownwer'])
                ->setCellValue('K' . $i, $value['date_first_owner'])
                ->setCellValue('L' . $i, $value['first_queue_name'])
                ->setCellValue('M' . $i, $value['sla'])
                ->setCellValue('N' . $i, $value['finish_time'])
                ->setCellValue('O' . $i, $value['queue_finish_name'])
                ->setCellValue('P' . $i, $value['user_finish'])
                ->setCellValue('Q' . $i, $value['timePendingQueueCS'])
                ->setCellValue('R' . $i, $value['timeResolution'])
                ->setCellValue('S' . $i, $value['tempo_atendimento'])
                ->setCellValue('T' . $i, !empty($value['tempo_atendimento']) || $value['tempo_atendimento'] !== NULL ? FksUtils::timeToInt($value['tempo_atendimento']) : null);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("S9:S$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(T9:T$i,\"<=900\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(B9:B$i,\">0\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 01 - Chamados Abertos Via Agente ou Processo com Atendimento em até 15 minutos.
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Taxa de Chamados Abertos Via Agente ou Processo com Atendimento em até 15 Minutos')
            ->setCellValue('A2', '> 96% dos Chamados de Responsabilidade da Central de Serviços')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N1 Agente 15 Min.');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Fechamento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução')
            ->setCellValue('S8', 'Tempo Primeiro Atendimento');
        $xls->getActiveSheet()->getStyle('A8:S8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->getStartColor()->setRGB('eaeaea');

        $serviceDeskIds = array(23);
        $rsl = $model->rptCSByAgent();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['create_time'])
                ->setCellValue('I' . $i, $value['queue_create_name'])
                ->setCellValue('J' . $i, $value['name_ownwer'])
                ->setCellValue('K' . $i, $value['date_first_owner'])
                ->setCellValue('L' . $i, $value['first_queue_name'])
                ->setCellValue('M' . $i, $value['sla'])
                ->setCellValue('N' . $i, $value['finish_time'])
                ->setCellValue('O' . $i, $value['queue_finish_name'])
                ->setCellValue('P' . $i, $value['user_finish'])
                ->setCellValue('Q' . $i, $value['timePendingQueueCS'])
                ->setCellValue('R' . $i, $value['timeResolution'])
                ->setCellValue('S' . $i, $value['tempo_atendimento'])
                ->setCellValue('T' . $i, !empty($value['tempo_atendimento']) || $value['tempo_atendimento'] !== NULL ? FksUtils::timeToInt($value['tempo_atendimento']) : null);
            //->setCellValue('U' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
            //->setCellValue('U' . $i, (in_array($value['queue_finish'], $serviceDeskIds) ? 1 : 0));
            //->setCellValue('W' . $i, (in_array($value['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("S9:S$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(T9:T$i,\"<=900\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(B9:B$i,\">0\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 01 - Chamados Abertos e Solucionados pela Central de Serviços sem passar por outra Fila.
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Taxa de Chamados Abertos e Solucionados')
            ->setCellValue('A2', 'na Central de Serviços sem passar por outra Fila')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N1 Chamados Resolvidos');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Fechamento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('T')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);

        $queuesIds = array(22,23);
        $servicosIds = array(147,148,149,150,151,154,152,155,153,156);
        $rslCs = $model->rptTicketsResolvidosCS();

        /*foreach ($rslCs as $valueCs) {
            if (in_array($valueCs['service_id'], $servicosIds)) {
                $arrayCs[] = $valueCs;
            }
        }*/

        $i = 9;
        foreach ($rslCs as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['user_finish'])
                ->setCellValue('Q' . $i, $item['timePendingQueueCS'])
                ->setCellValue('R' . $i, $item['timeResolution'])
                ->setCellValue('S' . $i, !empty($item['timeResolution']) || $item['timeResolution'] !== NULL ? FksUtils::timeToInt($item['timeResolution']) : null)
                ->setCellValue('T' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('U' . $i, (in_array($item['queue_finish'], $queuesIds) ? 1 : 0));
            //->setCellValue('W' . $i, (in_array($value['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(T9:T$i,\"=1\",U9:U$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(T9:T$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 01 - Chamados Abertos e Solucionados pela Central de Serviços sem passar por outra Fila com SLA de 04 Horas.
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Taxa de Chamados Abertos e Solucionados')
            ->setCellValue('A2', 'na Central de Serviços sem passar por outra Fila com SLA de 04 Horas')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N1 SLA 04 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Fechamento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('T')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);

        $queuesIds = array(22,23,27);
        $slaId = array(13);
        $servicosIds = array(148,149,1413,150,154,152,155,153,156,1416);
        $rsl1 = $model->rptTicketsResolvidosCS();

        foreach ($rsl1 as $value4) {
            if ($value4['sla_id'] == 13 && in_array($value4['service_id'], $servicosIds) && in_array($value4['queue_finish'], $queuesIds)) {
                $array4[] = $value4;
            }
        }

        $i = 9;
        foreach ($array4 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['user_finish'])
                ->setCellValue('Q' . $i, $item['timePendingQueueCS'])
                ->setCellValue('R' . $i, $item['timeResolution'])
                ->setCellValue('S' . $i, !empty($item['timeResolution']) || $item['timeResolution'] !== NULL ? FksUtils::timeToInt($item['timeResolution']) : null)
                ->setCellValue('T' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('U' . $i, (in_array($item['queue_finish'], $queuesIds) ? 1 : 0))
                ->setCellValue('V' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(S9:S$i,\"<=14400\",T9:T$i,\"=1\",U9:U$i,\"=1\",V9:V$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(T9:T$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 01 - Chamados Abertos e Solucionados pela Central de Serviços sem passar por outra Fila com SLA de 08 Horas.
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Taxa de Chamados Abertos e Solucionados')
            ->setCellValue('A2', 'na Central de Serviços sem passar por outra Fila com SLA de 08 Horas')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N1 SLA 08 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Fechamento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('T')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);

        $queuesIds = array(22,23,27);
        $slaId = array(1);
        $servicosIds = array(148,149,1413,150,154,152,155,153,156,1416);

        foreach ($rsl1 as $valueN108) {
            if ($valueN108['sla_id'] == 1 && in_array($valueN108['service_id'], $servicosIds) && in_array($valueN108['queue_finish'], $queuesIds)) {
                $arrayN108[] = $valueN108;
            }
        }

        $i = 9;
        foreach ($arrayN108 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['user_finish'])
                ->setCellValue('Q' . $i, $item['timePendingQueueCS'])
                ->setCellValue('R' . $i, $item['timeResolution'])
                ->setCellValue('S' . $i, !empty($item['timeResolution']) || $item['timeResolution'] !== NULL ? FksUtils::timeToInt($item['timeResolution']) : null)
                ->setCellValue('T' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('U' . $i, (in_array($item['queue_finish'], $queuesIds) ? 1 : 0))
                ->setCellValue('V' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(S9:S$i,\"<=28800\",T9:T$i,\"=1\",U9:U$i,\"=1\",V9:V$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(T9:T$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 01 - Chamados Abertos e Solucionados pela Central de Serviços sem passar por outra Fila com SLA de 12 Horas.
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Taxa de Chamados Abertos e Solucionados')
            ->setCellValue('A2', 'na Central de Serviços sem passar por outra Fila com SLA de 12 Horas')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N1 SLA 12 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Fechamento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('S')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('T')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);

        $queuesIds = array(22,23,27);
        $slaId = array(8);
        $servicosIds = array(148,149,1413,150,154,152,155,153,156,1416);

        foreach ($rsl1 as $valueN112) {
            if ($valueN112['sla_id'] == 8 && in_array($valueN112['service_id'], $servicosIds) && in_array($valueN112['queue_finish'], $queuesIds)) {
                $arrayN112[] = $valueN112;
            }
        }

        $i = 9;
        foreach ($arrayN112 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['user_finish'])
                ->setCellValue('Q' . $i, $item['timePendingQueueCS'])
                ->setCellValue('R' . $i, $item['timeResolution'])
                ->setCellValue('S' . $i, !empty($item['timeResolution']) || $item['timeResolution'] !== NULL ? FksUtils::timeToInt($item['timeResolution']) : null)
                ->setCellValue('T' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('U' . $i, (in_array($item['queue_finish'], $queuesIds) ? 1 : 0))
                ->setCellValue('V' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(S9:S$i,\"<=43200\",T9:T$i,\"=1\",U9:U$i,\"=1\",V9:V$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(T9:T$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 02 - Taxa de resolução N2 Sla 06 Horas.
        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
            ->setCellValue('A1', 'Taxa de Resolução SLA 06 Horas')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade do Suporte Presencial N2')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N2 SLA 6 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Usuário Encerramento')
            ->setCellValue('R8', 'Tempo Pendente Fila SP')
            ->setCellValue('S8', 'Tempo Resolução')
            ->setCellValue('T8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:T8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('W')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('X')->setVisible(FALSE);

        // Array com os IDs das filas do Suporte Técnico Presencial SLA de 06 Horas
        $serviceDeskIds = array(21);
        $slaId = array(2);
        $servicosIds = array(171,122,133,139,144,1402);
        $rsl = $model->rptSP();

        foreach ($rsl as $value6) {
            if ($value6['sla_id'] == 2) {
                $array[] = $value6;
            }
        }

        $i = 9;
        foreach ($array as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['primary_user_finish'])
                ->setCellValue('Q' . $i, $item['user_finish'])
                ->setCellValue('R' . $i, $item['timePendingQueueSP'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['timeQueueSP'])
                ->setCellValue('U' . $i, !empty($item['timeQueueSP']) || $item['timeQueueSP'] !== NULL ? FksUtils::timeToInt($item['timeQueueSP']) : null)
                ->setCellValue('V' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($item['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('X' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $time = 3600 * 6;
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"<=$time\",W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI 02 - Taxa de resolução N2 Sla 08 Horas.
        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
            ->setCellValue('A1', 'Taxa de Resolução SLA 08 Horas')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade do Suporte Presencial N2')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N2 SLA 8 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Usuário Encerramento')
            ->setCellValue('R8', 'Tempo Pendente Fila SP')
            ->setCellValue('S8', 'Tempo Resolução')
            ->setCellValue('T8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:T8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('W')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('X')->setVisible(FALSE);

        $serviceDeskIds = array(21);
        $slaId = array(1);
        $servicosIds = array(161,107,116,118,120,122,123,130,133,135,138,139,140,1349,143,142,144,148,149,1413,154,152,1414,1415,211,212,
            213,219,222,235,237,238,239,242,244,245,246,1515,1516,1517,1518,1520,1521,1522,1524,1525,1526,1527,1529,1530,1531,1532);

        foreach ($rsl as $value8) {
            if ($value8['sla_id'] == 1) {
                $array8[] = $value8;
            }
        }

        $i = 9;
        foreach ($array8 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['primary_user_finish'])
                ->setCellValue('Q' . $i, $item['user_finish'])
                ->setCellValue('R' . $i, $item['timePendingQueueSP'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['timeQueueSP'])
                ->setCellValue('U' . $i, !empty($value['timeQueueSP']) || $item['timeQueueSP'] !== NULL ? FksUtils::timeToInt($item['timeQueueSP']) : null)
                ->setCellValue('V' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($item['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('X' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $time = 3600 * 8;
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"<=$time\",W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 02 - Taxa de resolução N2 Sla 09 Horas.
        $xls->createSheet(8);
        $xls->setActiveSheetIndex(8)
            ->setCellValue('A1', 'Taxa de Resolução SLA 09 Horas')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade do Suporte Presencial N2')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N2 SLA 9 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Usuário Encerramento')
            ->setCellValue('R8', 'Tempo Pendente Fila SP')
            ->setCellValue('S8', 'Tempo Resolução')
            ->setCellValue('T8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:T8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('W')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('X')->setVisible(FALSE);

        $serviceDeskIds = array(21);
        $slaId = array(5);
        $servicosIds = array(163,162,166,122,133,139,144);

        foreach ($rsl as $value9) {
            if ($value9['sla_id'] == 5) {
                $array9[] = $value9;
            }
        }

        $i = 9;
        foreach ($array9 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['primary_user_finish'])
                ->setCellValue('Q' . $i, $item['user_finish'])
                ->setCellValue('R' . $i, $item['timePendingQueueSP'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['timeQueueSP'])
                ->setCellValue('U' . $i, !empty($item['timeQueueSP']) || $item['timeQueueSP'] !== NULL ? FksUtils::timeToInt($item['timeQueueSP']) : null)
                ->setCellValue('V' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($item['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('X' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $time = 3600 * 9;
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"<=$time\",W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 02 - Taxa de resolução N2 Sla 10 Horas.
        $xls->createSheet(9);
        $xls->setActiveSheetIndex(9)
            ->setCellValue('A1', 'Taxa de Resolução SLA 10 Horas')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade do Suporte Presencial N2')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N2 SLA 10 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Usuário Encerramento')
            ->setCellValue('R8', 'Tempo Pendente Fila SP')
            ->setCellValue('S8', 'Tempo Resolução')
            ->setCellValue('T8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:T8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('W')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('X')->setVisible(FALSE);

        $serviceDeskIds = array(21);
        $slaId = array(6);
        $servicosIds = array(164,165);

        foreach ($rsl as $value10) {
            if ($value10['sla_id'] == 6) {
                $array10[] = $value10;
            }
        }

        $i = 9;
        foreach ($array10 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['primary_user_finish'])
                ->setCellValue('Q' . $i, $item['user_finish'])
                ->setCellValue('R' . $i, $item['timePendingQueueSP'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['timeQueueSP'])
                ->setCellValue('U' . $i, !empty($item['timeQueueSP']) || $item['timeQueueSP'] !== NULL ? FksUtils::timeToInt($item['timeQueueSP']) : null)
                ->setCellValue('V' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($item['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('X' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $time = 3600 * 10;
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"<=$time\",W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 02 - Taxa de resolução N2 Sla 12 Horas.
        $xls->createSheet(10);
        $xls->setActiveSheetIndex(10)
            ->setCellValue('A1', 'Taxa de Resolução SLA 12 Horas')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade do Suporte Presencial N2')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N2 SLA 12 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Usuário Encerramento')
            ->setCellValue('R8', 'Tempo Pendente Fila SP')
            ->setCellValue('S8', 'Tempo Resolução')
            ->setCellValue('T8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:T8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('W')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('X')->setVisible(FALSE);

        $serviceDeskIds = array(21);
        $slaId = array(8);
        $servicosIds = array(131,155,153,156,183,1515,1516,1517,1518,1520,1521,1522,1524,1525,1526,1527,1529,1530,1531,1532,141,117);

        foreach ($rsl as $value12) {
            if ($value12['sla_id'] == 8 && in_array($value12['service_id'], $servicosIds) && in_array($value12['queue_finish'], $serviceDeskIds)) {
                $array12[] = $value12;
            }
        }

        $i = 9;
        foreach ($array12 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['primary_user_finish'])
                ->setCellValue('Q' . $i, $item['user_finish'])
                ->setCellValue('R' . $i, $item['timePendingQueueSP'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['timeQueueSP'])
                ->setCellValue('U' . $i, !empty($item['timeQueueSP']) || $item['timeQueueSP'] !== NULL ? FksUtils::timeToInt($item['timeQueueSP']) : null)
                ->setCellValue('V' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($item['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('X' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $time = 3600 * 12;
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"<=$time\",W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 02 - Taxa de resolução N2 Sla 16 Horas.
        $xls->createSheet(11);
        $xls->setActiveSheetIndex(11)
            ->setCellValue('A1', 'Taxa de Resolução SLA 16 Horas')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade do Suporte Presencial N2')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('N2 SLA 16 Horas');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(41);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Usuário Encerramento')
            ->setCellValue('R8', 'Tempo Pendente Fila SP')
            ->setCellValue('S8', 'Tempo Resolução')
            ->setCellValue('T8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:T8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:T8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('U')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('V')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('W')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('X')->setVisible(FALSE);

        $serviceDeskIds = array(21);
        $slaId = array(9);
        $servicosIds = array(122,128,133,136,139,144);

        foreach ($rsl as $value16) {
            if ($value16['sla_id'] == 9 && in_array($value16['service_id'], $servicosIds) && in_array($value16['queue_finish'], $serviceDeskIds)) {
                $array16[] = $value16;
            }
        }

        $i = 9;
        foreach ($array16 as $item) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $item['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $item['ticket_id'])
                ->setCellValue('C' . $i, $item['title'])
                ->setCellValue('D' . $i, $item['type_name'])
                ->setCellValue('E' . $i, $item['priority_name'])
                ->setCellValue('F' . $i, $item['state_name'])
                ->setCellValue('G' . $i, $item['service_name'])
                ->setCellValue('H' . $i, $item['create_time'])
                ->setCellValue('I' . $i, $item['queue_create_name'])
                ->setCellValue('J' . $i, $item['name_ownwer'])
                ->setCellValue('K' . $i, $item['date_first_owner'])
                ->setCellValue('L' . $i, $item['first_queue_name'])
                ->setCellValue('M' . $i, $item['sla'])
                ->setCellValue('N' . $i, $item['finish_time'])
                ->setCellValue('O' . $i, $item['queue_finish_name'])
                ->setCellValue('P' . $i, $item['primary_user_finish'])
                ->setCellValue('Q' . $i, $item['user_finish'])
                ->setCellValue('R' . $i, $item['timePendingQueueSP'])
                ->setCellValue('S' . $i, $item['timeResolution'])
                ->setCellValue('T' . $i, $item['timeQueueSP'])
                ->setCellValue('U' . $i, !empty($item['timeQueueSP']) || $item['timeQueueSP'] !== NULL ? FksUtils::timeToInt($item['timeQueueSP']) : null)
                ->setCellValue('V' . $i, (in_array($item['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($item['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('X' . $i, (in_array($item['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $time = 3600 * 16;
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"<=$time\",W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(W9:W$i,\"=1\",V9:V$i,\"=1\",X9:X$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 01 - Total Geral dos Chamados do N1 Suporte Remoto.
        $xls->createSheet(12);
        $xls->setActiveSheetIndex(12)
            ->setCellValue('A1', 'Taxa de Chamados Abertos e Solucionados')
            ->setCellValue('A2', 'na Central de Serviços sem passar por outra Fila')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Total N1');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
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
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Atendimento')
            ->setCellValue('Q8', 'Tempo Pendente Fila CS')
            ->setCellValue('R8', 'Tempo Resolução')
            ->setCellValue('S8', 'Tempo Total Fila CS');
        $xls->getActiveSheet()->getStyle('A8:S8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->getStartColor()->setRGB('eaeaea');

        $serviceDeskIds = array(22,23);
        $servicosIds = array(147,148,149,150,151,154,152,155,153,156,1413,1416);
        $i = 9;
        $rsl = $model->rptTicketsResolvidosCS();
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['create_time'])
                ->setCellValue('I' . $i, $value['queue_create_name'])
                ->setCellValue('J' . $i, $value['name_ownwer'])
                ->setCellValue('K' . $i, $value['date_first_owner'])
                ->setCellValue('L' . $i, $value['first_queue_name'])
                ->setCellValue('M' . $i, $value['sla'])
                ->setCellValue('N' . $i, $value['finish_time'])
                ->setCellValue('O' . $i, $value['queue_finish_name'])
                ->setCellValue('P' . $i, $value['user_finish'])
                ->setCellValue('Q' . $i, $value['timePendingQueueCS'])
                ->setCellValue('R' . $i, $value['timeResolution'])
                ->setCellValue('S' . $i, $value['timeQueueCS'])
                ->setCellValue('T' . $i, !empty($value['timeQueueCS']) || $value['timeQueueCS'] !== NULL ? FksUtils::timeToInt($value['timeQueueCS']) : null)
                ->setCellValue('U' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('V' . $i, (in_array($value['queue_finish'], $serviceDeskIds) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(U9:U$i,\"=1\",V9:V$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(V9:V$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI 01 - Taxa de satisfação do usuário N1.
        $xls->createSheet(13);
        $xls->setActiveSheetIndex(13)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário N1')
            ->setCellValue('A3', 'Total de Tickets')
            ->setCellValue('A4', 'Total de Ótimo')
            ->setCellValue('A5', 'Total de Bom')
            ->setCellValue('A6', 'Total de Regular')
            ->setCellValue('A7', 'Total de Ruim')
            ->setCellValue('A8', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS N1');
        $xls->getActiveSheet()->getStyle('A1:B8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A3:B8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->setCellValue('A10', 'Nº Ticket')
            ->setCellValue('B10', 'Ticket ID')
            ->setCellValue('C10', 'Título')
            ->setCellValue('D10', 'Tipo')
            ->setCellValue('E10', 'Fila Fechamento')
            ->setCellValue('F10', 'Usuário Fechamento')
            ->setCellValue('G10', 'Cliente')
            ->setCellValue('H10', 'Envio')
            ->setCellValue('I10', 'Resposta')
            ->setCellValue('J10', 'Chave Verificação')
            ->setCellValue('K10', 'Pergunta')
            ->setCellValue('L10', 'Resposta')
            ->setCellValue('M10', 'Satisfação')
            ->setCellValue('N10', 'Insatisfação');
        $xls->getActiveSheet()->getStyle('A10:N10')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A10:N10')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A10:N10')->getFill()->getStartColor()->setRGB('eaeaea');

        $pqs = $model->rptRTAPqsN1();
        $i = 11;
        $id = 0;
        foreach ($pqs as $value) {
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
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B11:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(L11:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L11:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L11:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L11:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L11:L$i,\"Péssimo\")");

        // KPI 02 - Taxa de satisfação do usuário.
        $xls->createSheet(14);
        $xls->setActiveSheetIndex(14)
            ->setCellValue('A1', 'Taxa de Satisfação do Usuário N2')
            ->setCellValue('A3', 'Total de Tickets')
            ->setCellValue('A4', 'Total de Ótimo')
            ->setCellValue('A5', 'Total de Bom')
            ->setCellValue('A6', 'Total de Regular')
            ->setCellValue('A7', 'Total de Ruim')
            ->setCellValue('A8', 'Total de Péssimo');
        $xls->getActiveSheet()->setTitle('PQS N2');
        $xls->getActiveSheet()->getStyle('A1:B8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A3:B8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A3:B8')->getFill()->getStartColor()->setRGB('eaeaea');
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
        $xls->getActiveSheet()->setCellValue('A10', 'Nº Ticket')
            ->setCellValue('B10', 'Ticket ID')
            ->setCellValue('C10', 'Título')
            ->setCellValue('D10', 'Tipo')
            ->setCellValue('E10', 'Fila Fechamento')
            ->setCellValue('F10', 'Usuário Fechamento')
            ->setCellValue('G10', 'Cliente')
            ->setCellValue('H10', 'Envio')
            ->setCellValue('I10', 'Resposta')
            ->setCellValue('J10', 'Chave Verificação')
            ->setCellValue('K10', 'Pergunta')
            ->setCellValue('L10', 'Resposta')
            ->setCellValue('M10', 'Satisfação')
            ->setCellValue('N10', 'Insatisfação');
        $xls->getActiveSheet()->getStyle('A10:N10')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A10:N10')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A10:N10')->getFill()->getStartColor()->setRGB('eaeaea');

        $pqs = $model->rptRTAPqs();
        //$media = $model->mediaNotaskpi02();
        $i = 11;
        $id = 0;
        foreach ($pqs as $value) {
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
            ;
            $i++;
        }
        ($i != 11 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B3", "=COUNTIFS(B11:B$i,\">0\")");
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(L11:L$i,\"Ótimo\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(L11:L$i,\"Bom\")");
        $xls->getActiveSheet()->setCellValue("B6", "=COUNTIFS(L11:L$i,\"Regular\")");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIFS(L11:L$i,\"Ruim\")");
        $xls->getActiveSheet()->setCellValue("B8", "=COUNTIFS(L11:L$i,\"Péssimo\")");
        //$xls->getActiveSheet()->setCellValue("B7", "$media");

        // KPI 02 - Total Geral dos Chamados do N2 Suporte Presencial.
        $xls->createSheet(15);
        $xls->setActiveSheetIndex(15)
            ->setCellValue('A1', 'Total de Chamados')
            ->setCellValue('A2', 'Encaminhados e Solucionados no Suporte Presencial N2')
            ->setCellValue('A4', 'Total de Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Total de Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Total N2');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(35);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Prioridade')
            ->setCellValue('F8', 'Situação')
            ->setCellValue('G8', 'Serviço')
            ->setCellValue('H8', 'Criação')
            ->setCellValue('I8', 'Fila Criação')
            ->setCellValue('J8', 'Primeiro Proprietário')
            ->setCellValue('K8', 'Data Primeiro Proprietário')
            ->setCellValue('L8', 'Fila Primeiro Proprietário')
            ->setCellValue('M8', 'Sla')
            ->setCellValue('N8', 'Fechamento')
            ->setCellValue('O8', 'Fila Fechamento')
            ->setCellValue('P8', 'Usuário Encerramento')
            ->setCellValue('Q8', 'Tempo Pendente Fila SP')
            ->setCellValue('R8', 'Tempo Resolução')
            ->setCellValue('S8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:S8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:S8')->getFill()->getStartColor()->setRGB('eaeaea');

        $serviceDeskIds = array(21);
        $slaId = array(1,2,5,6,8,9);
        $servicosIds = array(171,122,133,139,144,1402,161,107,116,118,120,122,123,130,133,135,138,139,140,1349,143,142,144,148,149,
            1413,154,152,1414,1415,211,212,213,219,222,235,237,238,239,242,244,245,246,163,162,166,122,133,139,144,164,165,131,155,
            153,156,183,122,128,133,136,139,144,1522,1553,1524,1525,1526,1527,141,117);
        $rsl = $model->rptTicketsResolvidosSP();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['create_time'])
                ->setCellValue('I' . $i, $value['queue_create_name'])
                ->setCellValue('J' . $i, $value['name_ownwer'])
                ->setCellValue('K' . $i, $value['date_first_owner'])
                ->setCellValue('L' . $i, $value['first_queue_name'])
                ->setCellValue('M' . $i, $value['sla'])
                ->setCellValue('N' . $i, $value['finish_time'])
                ->setCellValue('O' . $i, $value['queue_finish_name'])
                ->setCellValue('P' . $i, $value['user_finish'])
                ->setCellValue('Q' . $i, $value['timePendingQueueSP'])
                ->setCellValue('R' . $i, $value['timeResolution'])
                ->setCellValue('S' . $i, $value['timeQueueSP'])
                ->setCellValue('T' . $i, !empty($value['timeQueueSP']) || $value['timeQueueSP'] !== NULL ? FksUtils::timeToInt($value['timeQueueSP']) : null)
                ->setCellValue('U' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('V' . $i, (in_array($value['queue_finish'], $serviceDeskIds) ? 1 : 0))
                ->setCellValue('W' . $i, (in_array($value['sla_id'], $slaId) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(T9:T$i,\"<=21600\",T9:T$i,\"<=28800\",T9:T$i,\"<=32400\",T9:T$i,\"<=36000\",T9:T$i,\"<=43200\",T9:T$i,\"<=57600\",U9:U$i,\"=1\",V9:V$i,\"=1\",W9:W$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(U9:U$i,\"=1\",V9:V$i,\"=1\",W9:W$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}
