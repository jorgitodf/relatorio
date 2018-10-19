<?php

class AnatelN3Excel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiAnatel $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelN3Excel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelN3Excel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI 03 - Chamados de Banco de Dados Solucionados SLA 02 horas .
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Taxa de Chamados de Banco de Dados Solucionados')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Produção')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Banco de Dados');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
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
            ->setCellValue('O8', 'Data Atendimento')
            ->setCellValue('P8', 'Fila Atendimento')
            ->setCellValue('Q8', 'Usuário Atendimento')
            ->setCellValue('R8', 'Data de Encerramento')
            ->setCellValue('S8', 'Tempo Pendente Fila Banco de Dados')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Banco de Dados')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Restante Sla')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);

        $queuesIds = array(105,106,107,108,109,110);
        $servicosIds = array(109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692);
        $rsl = $model->rptPDBD();
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
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueuePD']) || $value['timePendingQueuePD'] !== NULL ? $value['timePendingQueuePD'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueuePD'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Z9:Z$i,\">0\",AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI 03 - KPI 03 - Chamados de Aplicações Web
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Taxa de Chamados de Aplicações Web Solucionados')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Produção')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Aplicações Web');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
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
            ->setCellValue('O8', 'Data Atendimento')
            ->setCellValue('P8', 'Fila Atendimento')
            ->setCellValue('Q8', 'Usuário Atendimento')
            ->setCellValue('R8', 'Data de Encerramento')
            ->setCellValue('S8', 'Tempo Pendente Fila Aplicações Web')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Aplicações Web')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Restante Sla')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);

        $queuesIds = array(105,106,107,108,109,110);
        $servicosIds = array(452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681);
        $rsl = $model->rptAWEB();
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
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueuePD']) || $value['timePendingQueuePD'] !== NULL ? $value['timePendingQueuePD'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueuePD'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Z9:Z$i,\">0\",AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI 03 - KPI 03 - Chamados de Aplicações Departamentais
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Taxa de Chamados de Aplicações Departamentais Solucionados')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Produção')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Aplicações Departamentais');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
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
            ->setCellValue('O8', 'Data Atendimento')
            ->setCellValue('P8', 'Fila Atendimento')
            ->setCellValue('Q8', 'Usuário Atendimento')
            ->setCellValue('R8', 'Data de Encerramento')
            ->setCellValue('S8', 'Tempo Pendente Fila Aplicações Departamentais')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Aplicações Departamentais')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Restante Sla')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);

        $queuesIds = array(105,106,107,108,109,110);
        $servicosIds = array(462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671);
        $rsl = $model->rptADP();
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
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueuePD']) || $value['timePendingQueuePD'] !== NULL ? $value['timePendingQueuePD'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueuePD'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Z9:Z$i,\">0\",AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI 03 - KPI 03 - Chamados de Servidores e Sistemas Operacionais
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Taxa de Chamados de Servidores e Sistemas Operacionais Solucionados')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Produção')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Servidores e SO');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
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
            ->setCellValue('O8', 'Data Atendimento')
            ->setCellValue('P8', 'Fila Atendimento')
            ->setCellValue('Q8', 'Usuário Atendimento')
            ->setCellValue('R8', 'Data de Encerramento')
            ->setCellValue('S8', 'Tempo Pendente Fila Servidores e Sistemas Operacionais')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Servidores e Sistemas Operacionais')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Restante Sla')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);

        $queuesIds = array(105,106,107,108,109,110);
        $servicosIds = array(508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799,800,801,802,803,804,805,806,807,808,809,810,811,812,813);
        $rsl = $model->rptSSOP();
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
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueuePD']) || $value['timePendingQueuePD'] !== NULL ? $value['timePendingQueuePD'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueuePD'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Z9:Z$i,\">0\",AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI 03 - KPI 03 - Chamados de Virtualização
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Taxa de Chamados de Virtualização Solucionados')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Produção')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Virtualização');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
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
            ->setCellValue('O8', 'Data Atendimento')
            ->setCellValue('P8', 'Fila Atendimento')
            ->setCellValue('Q8', 'Usuário Atendimento')
            ->setCellValue('R8', 'Data de Encerramento')
            ->setCellValue('S8', 'Tempo Pendente Fila Virtualização')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Virtualização')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Restante Sla')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);

        $queuesIds = array(105,106,107,108,109,110);
        $servicosIds = array(814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831);
        $rsl = $model->rptVIRT();
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
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueuePD']) || $value['timePendingQueuePD'] !== NULL ? $value['timePendingQueuePD'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueuePD'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Z9:Z$i,\">0\",AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // KPI 03 - KPI 03 - Chamados de Produção Reabertos
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Taxa de Chamados de Produção Reabertos')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Produção')
            ->setCellValue('A4', 'Demandas resolvidas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Tickets Reabertos');
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
        $xls->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
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
            ->setCellValue('O8', 'Data Atendimento')
            ->setCellValue('P8', 'Fila Atendimento')
            ->setCellValue('Q8', 'Usuário Atendimento')
            ->setCellValue('R8', 'Data de Encerramento')
            ->setCellValue('S8', 'Tempo Pendente Fila Virtualização')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila Virtualização')
            ->setCellValue('V8', 'Sla')
            ->setCellValue('W8', 'Tempo Restante Sla')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:Y8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('Z')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);

        $queuesIds = array(105,106,107,108,109,110);
        $servicosIds = array(109,110,111,112,113,114,115,693,694,695,696,698,700,702,704,706,708,709,711,713,715,716,718,742,744,762,759,756,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,682,683,684,685,686,687,688,689,690,691,692,452,453,455,457,458,459,477,479,481,482,484,672,673,674,675,676,677,679,678,680,681,462,538,542,544,540,541,545,547,485,486,487,549,550,551,553,556,557,558,489,559,560,563,565,571,561,562,564,566,572,490,493,569,573,503,580,581,582,505,506,583,584,585,586,587,614,588,607,615,608,609,616,610,611,617,612,613,618,619,620,621,622,623,464,465,466,624,474,475,476,625,626,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,471,472,473,650,651,652,653,654,655,656,657,658,659,467,469,470,660,661,662,663,664,495,498,501,665,667,668,669,670,671,508,510,511,513,780,781,785,782,783,784,786,787,788,789,790,791,792,793,794,796,797,798,799,800,801,802,803,804,805,806,807,808,809,810,811,812,813,814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831);
        $rsl = $model->rptREOPD();
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
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueuePD']) || $value['timePendingQueuePD'] !== NULL ? $value['timePendingQueuePD'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueuePD'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", "=COUNTIFS(Z9:Z$i,\">0\",AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelN3Excel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}
