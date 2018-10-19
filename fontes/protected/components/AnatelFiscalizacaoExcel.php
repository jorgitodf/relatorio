<?php

class AnatelFiscalizacaoExcel  {

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
        $fileName = dirname(__FILE__) . '/../../assets/report' . AnatelFiscalizacaoExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AnatelFiscalizacaoExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Relatório Técnico de Atividades")
            ->setSubject("Relatório Técnico de Atividades")
            ->setDescription("RTA Relatorio Tecnico de Atividades.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // KPI Gestão de Dados - Relatório de Chamados Atendidos pela Fila de Fiscalização.
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Relatório de Chamados Atendidos pela Fila de Fiscalização')
            ->setCellValue('A2', '> 95% dos Chamados de Responsabilidade da Fila de Fiscalização')
            ->setCellValue('A4', 'Demandas resolvidas dentro do SLA')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores')
            ->setCellValue('A7', 'Tickets Sem SLA');
        $xls->getActiveSheet()->setTitle('Fiscalização');
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
        $xls->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
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
            ->setCellValue('T8', 'Tempo Aberto na Central de Serviços')
            ->setCellValue('U8', 'Tempo Pendente na Central de Serviços')
            ->setCellValue('V8', 'Tempo Aberto Fila de Fiscalização')
            ->setCellValue('W8', 'Tempo Pendente Fila de Fiscalização')
            ->setCellValue('X8', 'Tempo Total do Chamado')
            ->setCellValue('Y8', 'Sla')
            ->setCellValue('Z8', 'Sla Restante')
            ->setCellValue('AA8', 'Mês Referência');
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:AA8')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('Z')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('AA')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getColumnDimension('AB')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AC')->setVisible(FALSE);
        $xls->getActiveSheet()->getColumnDimension('AD')->setVisible(FALSE);

        // Array com os IDs das filas de Fiscalização
        $queuesIds = array(23,40,41,42,43,44,124,125,126,127,151);
        $servicosIds = array(285,284,286,287,304,306,328,324,281,282,283,311,312,326,329,263,264,265,267,268,269,270,271,273,274,330,334,335);
        $rsl = $model->rptREPORTFiscalizacao();

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
                ->setCellValue('U' . $i, !empty($value['tempo_pendente_cs']) || $value['tempo_pendente_cs'] !== NULL ? $value['tempo_pendente_cs'] : null)
                ->setCellValue('V' . $i, $value['tempo_atendimento'])
                ->setCellValue('W' . $i, $value['tempo_pendente_filas_fiscalizacao'])
                ->setCellValue('X' . $i, $value['total_tempo_resolucao'])
                ->setCellValue('Y' . $i, $value['sla'])
                ->setCellValue('Z' . $i, !empty($value['sla_restante']) || $value['sla_restante'] !== NULL ? $value['sla_restante'] : null)
                ->setCellValue('AA' . $i, $value['mes_ref']    )
                ->setCellValue('AB' . $i, !empty($value['sla_restante']) || $value['sla_restante'] !== NULL ? FksUtils::timeToInt($value['sla_restante']) : null)
                ->setCellValue('AC' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                ->setCellValue('AD' . $i, (in_array($value['queue_resolucao_id'], $queuesIds) ? 1 : 0));
            if ($value['sla_restante'] < 0) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF9999');
            } elseif ($value['sla'] == "" || $value['sla'] == null) {
                $xls->getActiveSheet()->getStyle("A$i:AA$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('feff80');
            }
            $i++;
        }
        ($i != 9 ? $i-- : $i);

        $xls->getActiveSheet()->setCellValue("B4", '=COUNTIFS(AB9:AB'.$i.',">0",AC9:AC'.$i.',"=1",AD9:AD'.$i.',"=1")');
        $xls->getActiveSheet()->setCellValue("B5", "=COUNTIF(AC9:AC$i,\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=IF(B4,B4/B5,0)");
        $xls->getActiveSheet()->setCellValue("B7", "=COUNTIF(Y9:Y$i,\"=\")");


        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, AnatelFiscalizacaoExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

}