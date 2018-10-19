<?php

class AnatelSustentacaoExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiAnatel $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelSustentacaoExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelSustentacaoExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");
        // KPI Sustentação - Relatório de Chamados Atendidos pela Fila de Sustentação.
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos pela Fila de Sustentação')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Sustentação')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Sustentação');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(22);
        $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setWidth(103);
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
        $xls->getActiveSheet()->getColumnDimension('AD')->setWidth(30);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Sistema')
            ->setCellValue('E8', 'Tipo')
            ->setCellValue('F8', 'Prioridade')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Situação')
            ->setCellValue('I8', 'Serviço')
            ->setCellValue('J8', 'Observação')
            ->setCellValue('K8', 'Criação')
            ->setCellValue('L8', 'Fila Criação')
            ->setCellValue('M8', 'Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeiro Proprietário')
            ->setCellValue('O8', 'Fila Primeiro Atendimento')
            ->setCellValue('P8', 'Data Fila Primeiro Atendimento')
            ->setCellValue('Q8', 'Sla')
            ->setCellValue('R8', 'Data Atendimento')
            ->setCellValue('S8', 'Fila Atendimento')
            ->setCellValue('T8', 'Usuário Atendimento')
            ->setCellValue('U8', 'Tempo Pendente Fila Atendimento')
            ->setCellValue('V8', 'Tempo Resolução')
            ->setCellValue('W8', 'Tempo Total Fila Atendimento')
            ->setCellValue('X8', 'Tempo Restante Sla')
            ->setCellValue('Y8', 'Tempo Restante Sla Numérico')
            ->setCellValue('Z8', 'Mês Referência')
            ->setCellValue('AA8', '')
            ->setCellValue('AB8', '')
            ->setCellValue('AC8', '')
            ->setCellValue('AD8', 'Solucionados na Sustentação');
        $xls->getActiveSheet()->getStyle('A8:AD8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AD8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AD8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AD8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AD')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AA')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);

        // Array com os IDs das filas de Sustentação
        $queuesIds = array(18,19,26,116,117,118);
        $servicosIds = array(191,192,193);
        $tsr = $model->rptSUST();
        $i = 9;
        foreach ($tsr as $value) {
            $idServicos = in_array($value['service_id'], $servicosIds) ? 1 : 0;
            $idQueues = in_array($value['queue_finish'], $queuesIds) ? 1 : 0;
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['nome_sistema'])
                ->setCellValue('E' . $i, $value['type_name'])
                ->setCellValue('F' . $i, $value['priority_name'])
                ->setCellValue('G' . $i, $value['solicitante'])
                ->setCellValue('H' . $i, $value['state_name'])
                ->setCellValue('I' . $i, !empty($value['service_name']) || $value['service_name'] !== NULL ? $value['service_name'] : "Serviço Não Informado na Abertura do Chamado")
                ->setCellValue('J' . $i, $value['observation'])
                ->setCellValue('K' . $i, $value['create_time'])
                ->setCellValue('L' . $i, $value['queue_create_name'])
                ->setCellValue('M' . $i, $value['name_ownwer'])
                ->setCellValue('N' . $i, $value['date_first_owner'])
                ->setCellValue('O' . $i, $value['first_queue_name'])
                ->setCellValue('P' . $i, $value['date_first_queue_name'])
                ->setCellValue('Q' . $i, !empty($value['sla']) || $value['sla'] !== NULL ? $value['sla'] : "Sla Desconhecido")
                ->setCellValue('R' . $i, $value['finish_time'])
                ->setCellValue('S' . $i, $value['queue_finish_name'])
                ->setCellValue('T' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('U' . $i, !empty($value['timePendingQueueFinish']) || $value['timePendingQueueFinish'] !== NULL ? $value['timePendingQueueFinish'] : null)
                ->setCellValue('V' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('W' . $i, $value['timeQueueFinish'])
                ->setCellValue('X' . $i, $value['time_rest_sla'])
                ->setCellValue('Y' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Z' . $i, $value['mes_ref'])
                ->setCellValue('AA' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AB' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AC' . $i, (in_array($value['queue_finish'], $queuesIds) ? 1 : 0))
                ->setCellValue('AD' . $i, ($idServicos == 1 && $idQueues == 1) ? "Sim" : "Não");
            if ($idServicos == 1 && $idQueues == 1) {
                $xls->getActiveSheet()->getStyle("AD$i")->getFont()->setBold(true);
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIFS(AA9:AA'.$i.',">0",AB9:AB$'.$i.',"=1",AC9:AC'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIFS(AB9:AB'.$i.',"=1",AC9:AC'.$i.',"=1")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");


        // KPI Sustentação - Relatório de Chamados Atendidos pela Fila de Sustentação Reabertos.
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos e Reabertos pela Fila de Sustentação')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Sustentação')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('Sustentação Reabertos');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getSheetView()->setZoomScale(80);

        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(22);
        $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('I')->setWidth(103);
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
        $xls->getActiveSheet()->getColumnDimension('W')->setWidth(40);
        $xls->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('Y')->setWidth(21);
        $xls->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AC')->setWidth(28);
        $xls->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('AE')->setWidth(27);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Sistema')
            ->setCellValue('E8', 'Tipo')
            ->setCellValue('F8', 'Prioridade')
            ->setCellValue('G8', 'Solicitante')
            ->setCellValue('H8', 'Situação')
            ->setCellValue('I8', 'Serviço')
            ->setCellValue('J8', 'Observação')
            ->setCellValue('K8', 'Criação')
            ->setCellValue('L8', 'Fila de Criação')
            ->setCellValue('M8', 'Primeiro Proprietário')
            ->setCellValue('N8', 'Data Primeiro Proprietário')
            ->setCellValue('O8', 'Primeira Fila na Sustentação')
            ->setCellValue('P8', 'Data na Primeira Fila na Sustentação')
            ->setCellValue('Q8', 'Atendente Primeiro Atendimento')
            ->setCellValue('R8', 'Fila Primeiro Atendimento')
            ->setCellValue('S8', 'Data da Primeiro Atendimento')
            ->setCellValue('T8', 'Atendente Atendimento Após Reabertura')
            ->setCellValue('U8', 'Data Atendimento Após Reabertura')
            ->setCellValue('V8', 'Fila Atendimento Após Reabertura')
            ->setCellValue('W8', 'Tempo Pendente Fila Primeiro Atendimento')
            ->setCellValue('X8', 'Tempo Total Fila Primeiro Atendimento')
            ->setCellValue('Y8', 'Tempo Total Pendente')
            ->setCellValue('Z8', 'Tempo Total Resolução')
            ->setCellValue('AA8', 'Sla')
            ->setCellValue('AB8', 'Tempo Restante Sla')
            ->setCellValue('AC8', 'Tempo Restante Sla Numérico')
            ->setCellValue('AD8', 'Mês Referência')
            ->setCellValue('AE8', 'Solucionados na Sustentação');
        $xls->getActiveSheet()->getStyle('A8:AE8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AE8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AE8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('T8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AB')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AC8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AC')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AD8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AD')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AE8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AE')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AF')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AG')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AH')->setVisible(FALSE);

        // Array com os IDs das filas de Sustentação
        $queuesIds = array(18,19,26,116,117,118);
        $servicosIds = array(191,192,193);
        $rsl = $model->rptSUSTREOPEN();
        $i = 9;
        foreach ($rsl as $value) {
            $idServicos = in_array($value['service_id'], $servicosIds) ? 1 : 0;
            $idQueues = in_array($value['queue_id_primeira_resolucao'], $queuesIds) ? 1 : 0;
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, !empty($value['tn']) || $value['tn'] !== NULL ? $value['tn'] : null, PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, !empty($value['ticket_id']) || $value['ticket_id'] !== NULL ? $value['ticket_id'] : null)
                ->setCellValue('C' . $i, !empty($value['title']) || $value['title'] !== NULL ? $value['title'] : null)
                ->setCellValue('D' . $i, !empty($value['nome_sistema']) || $value['nome_sistema'] !== NULL ? $value['nome_sistema'] : null)
                ->setCellValue('E' . $i, !empty($value['type_name']) || $value['type_name'] !== NULL ? $value['type_name'] : null)
                ->setCellValue('F' . $i, !empty($value['priority_name']) || $value['priority_name'] !== NULL ? $value['priority_name'] : null)
                ->setCellValue('G' . $i, !empty($value['solicitante']) || $value['solicitante'] !== NULL ? $value['solicitante'] : null)
                ->setCellValue('H' . $i, !empty($value['state_name']) || $value['state_name'] !== NULL ? $value['state_name'] : null)
                ->setCellValue('I' . $i, !empty($value['service_name']) || $value['service_name'] !== NULL ? $value['service_name'] : null)
                ->setCellValue('J' . $i, !empty($value['observation']) || $value['observation'] !== NULL ? $value['observation'] : null)
                ->setCellValue('K' . $i, !empty($value['create_time']) || $value['create_time'] !== NULL ? $value['create_time'] : null)
                ->setCellValue('L' . $i, !empty($value['queue_create_name']) || $value['queue_create_name'] !== NULL ? $value['queue_create_name'] : null)
                ->setCellValue('M' . $i, !empty($value['name_ownwer']) || $value['name_ownwer'] !== NULL ? $value['name_ownwer'] : null)
                ->setCellValue('N' . $i, !empty($value['date_first_owner']) || $value['date_first_owner'] !== NULL ? $value['date_first_owner'] : null)
                ->setCellValue('O' . $i, !empty($value['first_queue_name_sust']) || $value['first_queue_name_sust'] !== NULL ? $value['first_queue_name_sust'] : null)
                ->setCellValue('P' . $i, !empty($value['date_first_queue_name_sust']) || $value['date_first_queue_name_sust'] !== NULL ? $value['date_first_queue_name_sust'] : null)
                ->setCellValue('Q' . $i, !empty($value['atendente_primeira_resolucao']) || $value['atendente_primeira_resolucao'] !== NULL ? $value['atendente_primeira_resolucao'] : null)
                ->setCellValue('R' . $i, !empty($value['fila_primeira_resolucao']) || $value['fila_primeira_resolucao'] !== NULL ? $value['fila_primeira_resolucao'] : null)
                ->setCellValue('S' . $i, !empty($value['data_primeira_resolucao']) || $value['data_primeira_resolucao'] !== NULL ? $value['data_primeira_resolucao'] : null)
                ->setCellValue('T' . $i, !empty($value['atendente_resolucao']) || $value['atendente_resolucao'] !== NULL ? $value['atendente_resolucao'] : null)
                ->setCellValue('U' . $i, !empty($value['data_resolucao']) || $value['data_resolucao'] !== NULL ? $value['data_resolucao'] : null)
                ->setCellValue('V' . $i, !empty($value['fila_resolucao']) || $value['fila_resolucao'] !== NULL ? $value['fila_resolucao'] : null)
                ->setCellValue('W' . $i, !empty($value['timePendingQueueFirstResolution']) || $value['timePendingQueueFirstResolution'] !== NULL ? $value['timePendingQueueFirstResolution'] : null)
                ->setCellValue('X' . $i, !empty($value['timeQueueFirstResolution']) || $value['timeQueueFirstResolution'] !== NULL ? $value['timeQueueFirstResolution'] : null)
                ->setCellValue('Y' . $i, !empty($value['total_pendente']) || $value['total_pendente'] !== NULL ? $value['total_pendente'] : null)
                ->setCellValue('Z' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('AA' . $i, !empty($value['sla']) || $value['sla'] !== NULL ? $value['sla'] : "Sla Desconhecido")
                ->setCellValue('AB' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AC' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('AD' . $i, !empty($value['mes_ref']) || $value['mes_ref'] !== NULL ? $value['mes_ref'] : null)
                ->setCellValue('AE' . $i, ($idServicos == 1 && $idQueues == 1) ? "Sim" : "Não")
                ->setCellValue('AF' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('AG' . $i, $idServicos)
                ->setCellValue('AH' . $i, $idQueues);
            if ($idServicos == 1 && $idQueues == 1) {
                $xls->getActiveSheet()->getStyle("AE$i")->getFont()->setBold(true);
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("N9:N$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("P9:P$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("S9:S$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:V$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("Z9:Z$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME6);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIFS(AF9:AF'.$i.',">0",AG9:AG'.$i.',"=1",AH9:AH'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", '=COUNTIFS(AG9:AG'.$i.',"=1",AH9:AH'.$i.',"=1")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelSustentacaoExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}
