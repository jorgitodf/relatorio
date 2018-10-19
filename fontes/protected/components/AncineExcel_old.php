<?php

class AncineExcel  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * 
     * @param KpiAncineOld $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . AncineExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . AncineExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
                ->setLastModifiedBy("IOS Informática")
                ->setTitle("Relatório Técnico de Atividades")
                ->setSubject("Relatório Técnico de Atividades")
                ->setDescription("RTA Relatorio Tecnico de Atividades.")
                ->setKeywords("office PHPExcel php YiiExcel UPNFM")
                ->setCategory("Indicadores");
        // KPI 01 - Taxa de resolução na 1ª chamada.
        $xls->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Taxa de Resolução na Primeira Chamada')
                ->setCellValue('A2', '> 85% dos Chamados de responsabilidade do Service Desk')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi01');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Pendente')
                ->setCellValue('N8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        // Array com os IDs das filas do Service Desk
        $serviceDeskIds = array(5);
        $suportePresencialIds = array(1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,35,36,37,38);
        $rsl = $model->rptRTA();
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
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
                    ->setCellValue('O' . $i, (in_array($value['queue_id'], $suportePresencialIds) ? 1 : 0))
                    ->setCellValue('P' . $i, (in_array($value['queue_finish'], $serviceDeskIds) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(O9:O$i;\"=1\";P9:P$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(P9:P$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // // KPI 02 - Taxa de satisfação do usuário.
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
                ->setCellValue('A1', 'Taxa de satisfação do usuário')
                ->setCellValue('A2', '> 95% (Escala: 0-10, sendo 10 o máximo)')
                ->setCellValue('A4', 'Pesquisas respondidas')
                ->setCellValue('A5', 'Pesquisas recebidas')
                ->setCellValue('A6', 'Indicadores')
                ->setCellValue('A7', 'Média das Notas');
        $xls->getActiveSheet()->setTitle('kpi02');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A7:B7')->getFill()->getStartColor()->setRGB('FFFF00');
        $xls->getActiveSheet()->getStyle('A4:B7')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Fila Fechamento')
                ->setCellValue('F8', 'Usuário Fechamento')
                ->setCellValue('G8', 'Cliente')
                ->setCellValue('H8', 'Envio')
                ->setCellValue('I8', 'Resposta')
                ->setCellValue('J8', 'Chave Verificação')
                ->setCellValue('K8', 'Pergunta')
                ->setCellValue('L8', 'Resposta')
                ->setCellValue('M8', 'Satisfação')
                ->setCellValue('N8', 'Insatisfação');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        $pqs = $model->rptRTAPqs();
        $media = $model->mediaNotaskpi02();
        $i = 9;
        $id = 0;
        foreach ($pqs as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValue('B' . $i, $value['ticket_id'])
                        ->setCellValue('C' . $i, $value['title'])
                        ->setCellValue('D' . $i, $value['type_name'])
                        ->setCellValue('E' . $i, $value['queue_finish_name'])
                        ->setCellValue('E' . $i, $value['user_finish'])
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
        ($i != 9 ? $i-- : $i);
        //$xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SE(M9:M$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.VALORES(M9:M$i)+CONT.VALORES(N9:N$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");
        $xls->getActiveSheet()->setCellValue("B7", "$media");

        // KPI 03 - Tempo total de atendimento
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
                ->setCellValue('A1', 'Taxa de Resolução na Primeira Chamada')
                ->setCellValue('A2', '> 95% dos chamados de responsabilidade do Service Desk resolvidos')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi03');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Pendente')
                ->setCellValue('N8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptRTAKpi03();
        $filaFechamentoIds = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38);
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
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
                    ->setCellValue('O' . $i, (FksUtils::timeToInt($value['timeQueueCS']) - FksUtils::timeToInt($value['timePendingQueueCS'])))
                    ->setCellValue('P' . $i, (in_array($value['queue_finish'], $filaFechamentoIds) ? 1 : 0))
                    ->setCellValue('Q' . $i, ($value['bypass_cs'] > 0 ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(O9:O$i;\"<=28800\";P9:P$i;\"=1\";Q9:Q$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(P9:P$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // KPI 04 - Chamados críticos de Hardware e Software
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
                ->setCellValue('A1', 'Chamados críticos de Hardware e Software')
                ->setCellValue('A2', '> 85% dos chamados resolvidos em até 4 horas')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi04');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Pendente')
                ->setCellValue('N8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        // Array com os IDs das filas do Suporte Presencial
        $suportePresencialIds = array(6, 31, 32, 33, 34);
        // Array com os IDs dos Serviços
        $servicosIds = array(-1);

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
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
                    ->setCellValue('O' . $i, FksUtils::timeToInt($value['timeResolution']))
                    ->setCellValue('P' . $i, (in_array($value['queue_finish'], $suportePresencialIds) ? 1 : 0))
                    ->setCellValue('Q' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(O9:O$i;\"<=14400\";P9:P$i;\"=1\";Q9:Q$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(P9:P$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // KPI 05 - Chamados críticos de Hardware e Software
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
                ->setCellValue('A1', 'Chamados de Problemas de Hardware')
                ->setCellValue('A2', '> 85% dos chamados resolvidos ou encaminhados para assistência')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi05');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Pendente')
                ->setCellValue('N8', 'Tempo Resolução');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        $ola = $model->rptRtaOla();
        //$totalSPR = $model->kpiTotalSPR05();
        //Array com os IDs dos Serviços
        $filaFechamentoIds = array(27);

        $i = 9;
        foreach ($ola as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['priority_name'])
                    ->setCellValue('F' . $i, $value['state_name'])
                    ->setCellValue('G' . $i, $value['service_name'])
                    ->setCellValue('H' . $i, $value['create_time'])
                    ->setCellValue('I' . $i, $value['queue_create_name'])
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
                    ->setCellValue('O' . $i, FksUtils::timeToInt($value['time_move_ola']))
                    ->setCellValue('P' . $i, (in_array($value['queue_finish'], $filaFechamentoIds) ? 1 : 0));
                    //->setCellValue('Q' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0))
                    //->setCellValue('R' . $i, $value['type_id']);

            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        //$xls->getActiveSheet()->setCellValue("B4", "CONT.SES(O9:O$i;\"<=39600\";P9:P$i;\"=1\";Q9:Q$i;\"=1\";R9:R$i;\"=5\")");
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(O9:O$i;\"<=39600\";P9:P$i;\"=1\")");
        //$xls->getActiveSheet()->setCellValue("B5", "$totalSPR");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(P9:P$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // KPI 06 - Chamados de Problemas de Software
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
                ->setCellValue('A1', 'Chamados de Problemas de Software')
                ->setCellValue('A2', '> 85% dos chamados resolvidos em até 1 dia útil')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi06');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Total Pendente')
                ->setCellValue('N8', 'Tempo Total Resolução')
                ->setCellValue('O8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');


        // Array com os IDs dos Serviços
        $servicosIds = array(171,174,177,180,182,188,191,194,197,200,203,206,209,212,215,218,221,224,312,315,432,440);
        $suportePresencialIds = array(6,31,32,33,34);
        $rsl6 = $model->kpi06RTA();
        $i = 9;
        foreach ($rsl6 as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['priority_name'])
                    ->setCellValue('F' . $i, $value['state_name'])
                    ->setCellValue('G' . $i, $value['service_name'])
                    ->setCellValue('H' . $i, $value['create_time'])
                    ->setCellValue('I' . $i, $value['queue_create_name'])
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
                    ->setCellValue('O' . $i, $value['timeQueueSP'])
                    ->setCellValue('P' . $i, FksUtils::timeToInt($value['timeQueueSP']))
                    ->setCellValue('Q' . $i, (in_array($value['queue_finish'], $suportePresencialIds) ? 1 : 0))
                    ->setCellValue('R' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0));
                    //->setCellValue('R' . $i, $value['type_id']);
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(P9:P$i;\"<=39600\";Q9:Q$i;\"=1\";R9:R$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(Q9:Q$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // KPI 07 - Chamados para instalação de novas estações ou atualizações (upgrades)
        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
                ->setCellValue('A1', 'Chamados para instalação de novas estações ou atualizações (upgrades)')
                ->setCellValue('A2', '> 85% dos chamados resolvidos em até 3 dias úteis')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi07');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Pendente')
                ->setCellValue('N8', 'Tempo Resolução')
				->setCellValue('O8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

        // Array com os IDs dos Serviços
        $servicosIds = array(126,127,125);
        $suportePresencialIds = array(6, 30, 31, 32, 33, 34);
        $rsl = $model->kpi07RTA();
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
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
					->setCellValue('O' . $i, $value['timeQueueSP'])
                    ->setCellValue('P' . $i, FksUtils::timeToInt($value['timeQueueSP']))
                    ->setCellValue('Q' . $i, (in_array($value['queue_finish'], $suportePresencialIds) ? 1 : 0))
                    ->setCellValue('R' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        //$xls->getActiveSheet()->setCellValue("B4", "CONT.SES(O9:O$i;\"<=118800\";P9:P$i;\"=1\";Q9:Q$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(P9:P$i;\"<=118800\";Q9:Q$i;\"=1\";R9:R$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(Q9:Q$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // KPI 08 - Chamados para instalação ou atualizações de software
        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
                ->setCellValue('A1', 'Chamados para instalação ou atualizações de software')
                ->setCellValue('A2', '> 85% dos chamados resolvidos em até 3 dias úteis')
                ->setCellValue('A4', 'Demandas resolvidas')
                ->setCellValue('A5', 'Demandas recebidas')
                ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('kpi08');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Prioridade')
                ->setCellValue('F8', 'Situação')
                ->setCellValue('G8', 'Serviço')
                ->setCellValue('H8', 'Criação')
                ->setCellValue('I8', 'Fila Criação')
                ->setCellValue('J8', 'Fechamento')
                ->setCellValue('K8', 'Fila Fechamento')
                ->setCellValue('L8', 'Usuário Fechamento')
                ->setCellValue('M8', 'Tempo Pendente')
                ->setCellValue('N8', 'Tempo Resolução')
                ->setCellValue('O8', 'Tempo Total Fila Suporte');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

        // Array com os IDs dos Serviços
        $servicosIds = array(169,172,175,178,181,186,189,192,195,198,201,204,207,210,213,216,219,222,310,314,431,441);
        $suportePresencialIds = array(6, 31, 32, 33, 34);
        $rsl = $model->kpi08RTA();
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
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['timePending'])
                    ->setCellValue('N' . $i, $value['timeResolution'])
                    ->setCellValue('O' . $i, $value['timeQueueSP'])
                    ->setCellValue('P' . $i, FksUtils::timeToInt($value['timeQueueSP']))
                    ->setCellValue('Q' . $i, (in_array($value['queue_finish'], $suportePresencialIds) ? 1 : 0))
                    ->setCellValue('R' . $i, (in_array($value['service_id'], $servicosIds) ? 1 : 0));
            $i++;
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->getStyle("O9:O$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(P9:P$i;\"<=118800\";Q9:Q$i;\"=1\";R9:R$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.SE(Q9:Q$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");

        // KPI 09 - Taxa de satisfação do usuário 2º Nível
        $xls->createSheet(8);
        $xls->setActiveSheetIndex(8)
                ->setCellValue('A1', 'Taxa de satisfação do usuário 2º Nível')
                ->setCellValue('A2', '> 85% (Escala: 0-10, sendo 10 o máximo)')
                ->setCellValue('A4', 'Pesquisas respondidas')
                ->setCellValue('A5', 'Pesquisas recebidas')
                ->setCellValue('A6', 'Indicadores')
                ->setCellValue('A7', 'Média das Notas');
        $xls->getActiveSheet()->setTitle('kpi09');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A7:B7')->getFill()->getStartColor()->setRGB('FFFF00');
        $xls->getActiveSheet()->getStyle('A4:B7')->getFont()->setBold(true);

        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
                ->setCellValue('B8', 'Ticket ID')
                ->setCellValue('C8', 'Título')
                ->setCellValue('D8', 'Tipo')
                ->setCellValue('E8', 'Fila Fechamento')
                ->setCellValue('F8', 'Usuário Fechamento')
                ->setCellValue('G8', 'Cliente')
                ->setCellValue('H8', 'Envio')
                ->setCellValue('I8', 'Resposta')
                ->setCellValue('J8', 'Chave Verificação')
                ->setCellValue('K8', 'Pergunta')
                ->setCellValue('L8', 'Resposta')
                ->setCellValue('M8', 'Satisfação')
                ->setCellValue('N8', 'Insatisfação');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        // Array com os IDs das filas do Suporte Presencial
        $suportePresencialIds = array(6, 31, 32, 33, 34);
        $pqs = $model->rptRTAPqsKPI09();
        $media = $model->mediaNotaskpi09();
        $i = 9;
        $id = 0;
            foreach ($pqs as $value) {
            if (in_array($value['queue_finish'], $suportePresencialIds)) {
                if ($id != $value['ticket_id']) {
                    $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValue('B' . $i, $value['ticket_id'])
                            ->setCellValue('C' . $i, $value['title'])
                            ->setCellValue('D' . $i, $value['type_name'])
                            ->setCellValue('E' . $i, $value['queue_finish'])
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
        }
        ($i != 9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SE(M9:M$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue("B5", "CONT.VALORES(M9:M$i)+CONT.VALORES(N9:N$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue("B6", "=B4/B5");
        $xls->getActiveSheet()->setCellValue("B7", "$media");

        // Dados Gerais de todos os chamados ENCERRADOS no período
        $xls->createSheet(9);
        $xls->setActiveSheetIndex(9);
        $xls->getActiveSheet()->setTitle('Geral');

        $xls->getActiveSheet()->getStyle('A1:Q1')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A1:Q1')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A1:Q1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A1:Q1')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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
        $xls->getActiveSheet()->setCellValue('A1', 'Nº Ticket')
                ->setCellValue('B1', 'Ticket ID')
                ->setCellValue('C1', 'Título')
                ->setCellValue('D1', 'Tipo')
                ->setCellValue('E1', 'Prioridade')
                ->setCellValue('F1', 'Situação')
                ->setCellValue('G1', 'Serviço')
                ->setCellValue('H1', 'Criação')
                ->setCellValue('I1', 'Fila Criação')
                ->setCellValue('J1', 'Fechamento')
                ->setCellValue('K1', 'Fila Fechamento')
                ->setCellValue('L1', 'Usuário Fechamento')
                ->setCellValue('M1', 'Mudanças de Fila')
                ->setCellValue('N1', 'Tempo na CS')
                ->setCellValue('O1', 'Tempo Pendente na CS')
                ->setCellValue('P1', 'Tempo Pendente')
                ->setCellValue('Q1', 'Tempo Resolução');

        $rsl = $model->rptRTAGeral();
        $i = 2;
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
                    ->setCellValue('J' . $i, $value['finish_time'])
                    ->setCellValue('K' . $i, $value['queue_finish_name'])
                    ->setCellValue('L' . $i, $value['user_finish'])
                    ->setCellValue('M' . $i, $value['qtd_move'])
                    ->setCellValue('N' . $i, $value['timeQueueCS'])
                    ->setCellValue('O' . $i, $value['timePendingQueueCS'])
                    ->setCellValue('P' . $i, $value['timePending'])
                    ->setCellValue('Q' . $i, $value['timeResolution']);
            $i++;
        }

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
