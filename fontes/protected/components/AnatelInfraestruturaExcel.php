<?php

class AnatelInfraestruturaExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * @param KpiAnatel $model
     * @return string
     */
    public static function generate($model) {
        date_default_timezone_set('America/Sao_Paulo');
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelInfraestruturaExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelInfraestruturaExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI Infraestrutura - Relatório de Chamados Atendidos pela Fila de Infraestrutura.
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos pela Fila de Infraestrutura')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Infraestrutura')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores')
            ->setCellValue('A7', 'Tickets Sem SLA');
        $xls->getActiveSheet()->setTitle('Infraestrutura');
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
            ->setCellValue('S8', 'Tempo Pendente Fila de Infraestrutura')
            ->setCellValue('T8', 'Tempo Resolução')
            ->setCellValue('U8', 'Tempo Total Fila de Infraestrutura')
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

        // Array com os IDs das filas de Infraestrutura
        $queuesIds = array(140,128,129,131,139,133,130,58);
        $servicosIds = array(1439,413,415,417,396,404,397,389,391,390,405,400,420,421,418,394,407,432,408,435,434,410,411,399,446,438,439,441,442,443,445,448,449,450,392,401,393,431,437);
        $rsl = $model->rptINFRA();
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
                ->setCellValue('N' . $i, $value['date_first_queue_name'])
                ->setCellValue('O' . $i, $value['finish_time'])
                ->setCellValue('P' . $i, $value['queue_finish_name'])
                ->setCellValue('Q' . $i, !empty($value['user_finish']) || $value['user_finish'] !== NULL ? $value['user_finish'] : null)
                ->setCellValue('R' . $i, $value['data_encerramento'])
                ->setCellValue('S' . $i, !empty($value['timePendingQueueINFRA']) || $value['timePendingQueueINFRA'] !== NULL ? $value['timePendingQueueINFRA'] : null)
                ->setCellValue('T' . $i, !empty($value['timeResolution']) || $value['timeResolution'] !== NULL ? $value['timeResolution'] : null)
                ->setCellValue('U' . $i, $value['timeQueueINFRA'])
                ->setCellValue('V' . $i, $value['sla'])
                ->setCellValue('W' . $i, $value['time_rest_sla'])
                ->setCellValue('X' . $i, !empty($value['time_rest_sla_convert']) || $value['time_rest_sla_convert'] !== NULL ? $value['time_rest_sla_convert'] : null)
                ->setCellValue('Y' . $i, $value['mes_ref'])
                ->setCellValue('Z' . $i, !empty($value['time_rest_sla']) || $value['time_rest_sla'] !== NULL ? FksUtils::timeToInt($value['time_rest_sla']) : null)
                ->setCellValue('AA' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AB' . $i, (in_array($value['queue_finish_id'], $queuesIds) ? 1 : 0));
            if ($value['time_rest_sla'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('90EE90');
            } elseif ($value['sla'] == "" || $value['sla'] == null) {
                $xls->getActiveSheet()->getStyle("A$i:Y$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('feff80');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);

        $xls->getActiveSheet()->getStyle("T9:U$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("U9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->getStyle("V9:T$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8);
        $xls->getActiveSheet()->setCellValue("B4", '=COUNTIFS(Z9:Z'.$i.',">0",AA9:AA'.$i.',"=1",AB9:AB'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIFS(AA9:AA$i,\"=1\",AB9:AB$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIF(V9:V$i,\"=\")");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelInfraestruturaExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}