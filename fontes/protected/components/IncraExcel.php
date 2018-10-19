<?php

class IncraExcel {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * Gera planilha com os Indicadores da DET3
     * @param KpiIncra $model
     * @return string
     */
    public static function generateDET3($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . IncraExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . IncraExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
                ->setLastModifiedBy("IOS Informática")
                ->setTitle("Relatório Técnico de Atividades")
                ->setSubject("Relatório Técnico de Atividades")
                ->setDescription("RTA Relatorio Tecnico de Atividades.")
                ->setKeywords("office PHPExcel php YiiExcel UPNFM")
                ->setCategory("Indicadores");
        // Solicitações atendidas em até 4 horas
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Índice de Solicitações resolvidas em até 4 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 4 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.01');
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
            ->setCellValue('O8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

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
                ->setCellValue('O' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])))
                ->setCellValue('P' . $i, '=IF('.(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])).'>14400,0,1)');
                    
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(P9:P' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações atendidas em até 8 horas
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Índice de Solicitações resolvidas em até 8 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 8 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.02');
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
            ->setCellValue('O8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

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
                ->setCellValue('O' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])))
                ->setCellValue('P' . $i, '=IF('.(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])).'>28800,0,1)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(P9:P' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações atendidas em até 12 horas
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Índice de Solicitações resolvidas em até 12 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 12 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.03');
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
            ->setCellValue('O8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

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
                ->setCellValue('O' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])))
                ->setCellValue('P' . $i, '=IF('.(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])).'>43200,0,1)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(P9:P' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações atendidas em até 3 dias
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Índice de Solicitações resolvidas em até 3 dias')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 3 dias')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.04');
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
            ->setCellValue('O8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

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
                ->setCellValue('O' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])))
                ->setCellValue('P' . $i, '=IF('.(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])).'>129600,0,1)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(P9:P' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Respostas da pesquisa de satisfação
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Índice de Pesquisa de Insatisfação("Ruim/Péssimo")')
            ->setCellValue('A2', 'Total de pesquisas recebidas')
            ->setCellValue('A4', 'Insatisfação "Ruim/Péssimo"')
            ->setCellValue('A5', 'Pesquisas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.05');
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
        $xls->getActiveSheet()->getColumnDimension('M')->setWidth(100);
        $xls->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Cliente')
            ->setCellValue('F8', 'Envio')
            ->setCellValue('G8', 'Resposta')
            ->setCellValue('H8', 'Chave Verificação')
            ->setCellValue('I8', 'Pergunta')
            ->setCellValue('J8', 'Resposta')
            ->setCellValue('K8', 'Satisfação')
            ->setCellValue('L8', 'Insatisfação')
            ->setCellValue('M8', 'Comentário')
            ->setCellValue('N8', 'Fila Encerramento');
        $xls->getActiveSheet()->getStyle('A8:N8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:N8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptRTAPqs();

        $i = 9;
        $id = 0;
        foreach ($rsl as $value) {
            if ($id != $value['ticket_id']){
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['send_to'])
                    ->setCellValue('F' . $i, $value['send_time'])
                    ->setCellValue('G' . $i, $value['vote_time'])
                    ->setCellValue('H' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('I' . $i, $value['question'])
                ->setCellValue('J' . $i, $value['answer'])
                ->setCellValue('K' . $i, $value['satisfaction'])
                ->setCellValue('L' . $i, $value['nosatisfaction'])
                ->setCellValue('M' . $i, $value['question_id'] == 10 ? $value['vote_value']: '')
                ->setCellValue('N' . $i, $value['queue_finish_name']);
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(J9:J' . $i . ')');
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações globais escalonadas em tempo superior a 30(trinta) minutos
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Índice de Solicitações escalonadas superior a 30 min')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas escalonadas superior a 30 min')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.06');
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
        $xls->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
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
            ->setCellValue('O8', '1ª Mudança')
            ->setCellValue('P8', 'Tempo Mudança');
        $xls->getActiveSheet()->getStyle('A8:P8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:P8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:P8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptRTAEscalado();

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
                ->setCellValue('O' . $i, $value['change_first_move'])
                ->setCellValue('P' . $i, $value['time_move'])
                ->setCellValue('Q' . $i, $value['escalated_queue'])
                ->setCellValue('R' . $i, '=IF('.(FksUtils::timeToInt($value['time_move']) - FksUtils::timeToInt($value['timePendingCS'])).'<=1800,0,1)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(R9:R' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações globais classificadas incorretamente
        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
            ->setCellValue('A1', 'Índice de Solicitações classificadas incorretamente')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas classificadas incorretamente')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.07');
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

        $rsl = $model->rptRTAReclassificado();

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
                ->setCellValue('O' . $i, '=IF('.$value['reclassified'].'>1,1,0)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(O9:O' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações globais fechadas sem autorização do usuário
        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
            ->setCellValue('A1', 'Índice de Solicitações fechadas sem autorização do usuário')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas fechadas sem autorização')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.08');
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

        $rsl = $model->rptRTANotificacao();

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
                ->setCellValue('O' . $i, '=IF('.$value['notified'].'>1,1,0)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(O9:O' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações globais reabertas
        $xls->createSheet(8);
        $xls->setActiveSheetIndex(8)
            ->setCellValue('A1', 'Índice de Solicitações reabertas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas reabertas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.09');
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

        $rsl = $model->rptRTAReaberto();

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
                ->setCellValue('O' . $i, '=IF('.$value['reopen'].'>=1,1,0)');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(O9:O' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Solicitações de criticidade “alta” resolvidas em até 1 hora da abertura do chamado
        $xls->createSheet(9);
        $xls->setActiveSheetIndex(9)
            ->setCellValue('A1', 'Índice de Solicitações de criticidade “alta” resolvidas em até 1 hora')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas criticidade Alta')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.10');
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
            ->setCellValue('O8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

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
                ->setCellValue('O' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])))
                ->setCellValue('P' . $i, '=IF(OR('.$value['priority_id'].'=4,'.$value['priority_id'].
                        '=5),IF('.(FksUtils::timeToInt($value['timeResolution']) - FksUtils::timeToInt($value['timePending'])).'<=3600,"0","1"),"0")');
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', "=COUNTIF(P9:P$i,\"=1\")");
        $xls->getActiveSheet()->setCellValue('B5', "=COUNTA(B9:B$i)");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=IF(B4=0,1,B4/B5)');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, IncraExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * Gera planilha com os Indicadores da DET2
     * @param KpiIncra $model
     * @return string
     */
    public static function generateDET2($model) {
        $fileName = dirname(__FILE__) . '/../../assets/reportDET2' . IncraExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=reportDET2' . IncraExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
                ->setLastModifiedBy("IOS Informática")
                ->setTitle("Relatório Técnico de Atividades")
                ->setSubject("Relatório Técnico de Atividades")
                ->setDescription("RTA Relatorio Tecnico de Atividades.")
                ->setKeywords("office PHPExcel php YiiExcel UPNFM")
                ->setCategory("Indicadores");

        // Grau de Satisfação do Usuário
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Grau de Satisfação do Usuário')
            ->setCellValue('A2', 'Total de pesquisas recebidas')
            ->setCellValue('A4', 'Satisfação "Ótimo/Bom"')
            ->setCellValue('A5', 'Pesquisas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.01');
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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Cliente')
            ->setCellValue('F8', 'Envio')
            ->setCellValue('G8', 'Resposta')
            ->setCellValue('H8', 'Chave Verificação')
            ->setCellValue('I8', 'Pergunta')
            ->setCellValue('J8', 'Resposta')
            ->setCellValue('K8', 'Satisfação')
            ->setCellValue('L8', 'Insatisfação');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptRTAPqsDET2();

        $i = 9;
        $id = 0;
        foreach ($rsl as $value) {
            if ($id != $value['ticket_id']){
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['send_to'])
                    ->setCellValue('F' . $i, $value['send_time'])
                    ->setCellValue('G' . $i, $value['vote_time'])
                    ->setCellValue('H' . $i, $value['public_survey_key']);
                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('I' . $i, $value['question'])
                ->setCellValue('J' . $i, $value['answer'])
                ->setCellValue('K' . $i, $value['satisfaction'])
                ->setCellValue('L' . $i, $value['nosatisfaction']);
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(K9:K' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(J9:J' . $i . ')');
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Incidentes críticos tratados em até 04 horas
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Índice de incidentes críticos tratados em até 04 horas')
            ->setCellValue('A2', 'Total de Incidentes críticos')
            ->setCellValue('A4', 'Incidentes críticos')
            ->setCellValue('A5', 'Incidentes críticos recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.02');
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
            ->setCellValue('H8', 'SLA')
            ->setCellValue('I8', 'Criação')
            ->setCellValue('J8', 'Fila Criação')
            ->setCellValue('K8', 'Fechamento')
            ->setCellValue('L8', 'Fila Fechamento')
            ->setCellValue('M8', 'Usuário Fechamento')
            ->setCellValue('N8', 'Tempo Pendente')
            ->setCellValue('O8', 'Tempo Pendente DET2')
            ->setCellValue('P8', 'Tempo Resolução')
            ->setCellValue('Q8', 'Tempo Resolução DET2')
            ->setCellValue('R8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptRTADET2();
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['sla_name'])
                ->setCellValue('I' . $i, $value['create_time'])
                ->setCellValue('J' . $i, $value['queue_create_name'])
                ->setCellValue('K' . $i, $value['finish_time'])
                ->setCellValue('L' . $i, $value['queue_finish_name'])
                ->setCellValue('M' . $i, $value['user_finish'])
                ->setCellValue('N' . $i, $value['timePending'])
                ->setCellValue('O' . $i, $value['timePendingDET2'])
                ->setCellValue('P' . $i, $value['timeResolution'])
                ->setCellValue('Q' . $i, $value['timeDET2'])
                ->setCellValue('R' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeDET2'])-FksUtils::timeToInt($value['timePendingDET2'])))
                ->setCellValue('S' . $i, 1)
                ->setCellValue('T' . $i, ($value['sla_id'] == 1 ? 1 : 0))
                ->setCellValue('U' . $i, ((FksUtils::timeToInt($value['timeDET2'])-FksUtils::timeToInt($value['timePendingDET2'])) <= 14400 ? 1 : 0));

            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue("B4", "CONT.SES(S9:S".$i.";\"=1\";T9:T".$i.";\"=1\";U9:U".$i.";\"=1\")");
        $xls->getActiveSheet()->setCellValue('B5', "CONT.SES(S9:S$i;\"=1\";T9:T$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Incidentes Urgentes tratados em até 08 horas
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Índice de incidentes urgentes tratados em até 08 horas')
            ->setCellValue('A2', 'Total de Incidentes urgentes')
            ->setCellValue('A4', 'Incidentes urgentes')
            ->setCellValue('A5', 'Incidentes urgentes recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.03');
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
            ->setCellValue('H8', 'SLA')
            ->setCellValue('I8', 'Criação')
            ->setCellValue('J8', 'Fila Criação')
            ->setCellValue('K8', 'Fechamento')
            ->setCellValue('L8', 'Fila Fechamento')
            ->setCellValue('M8', 'Usuário Fechamento')
            ->setCellValue('N8', 'Tempo Pendente')
            ->setCellValue('O8', 'Tempo Pendente DET2')
            ->setCellValue('P8', 'Tempo Resolução')
            ->setCellValue('Q8', 'Tempo Resolução DET2')
            ->setCellValue('R8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');

        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['sla_name'])
                ->setCellValue('I' . $i, $value['create_time'])
                ->setCellValue('J' . $i, $value['queue_create_name'])
                ->setCellValue('K' . $i, $value['finish_time'])
                ->setCellValue('L' . $i, $value['queue_finish_name'])
                ->setCellValue('M' . $i, $value['user_finish'])
                ->setCellValue('N' . $i, $value['timePending'])
                ->setCellValue('O' . $i, $value['timePendingDET2'])
                ->setCellValue('P' . $i, $value['timeResolution'])
                ->setCellValue('Q' . $i, $value['timeDET2'])
                ->setCellValue('R' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeDET2'])-FksUtils::timeToInt($value['timePendingDET2'])))
                ->setCellValue('S' . $i, 1)
                ->setCellValue('T' . $i, ($value['sla_id'] == 2 ? 1 : 0))
                ->setCellValue('U' . $i, ((FksUtils::timeToInt($value['timeDET2'])-FksUtils::timeToInt($value['timePendingDET2'])) <= 28800 ? 1 : 0));

            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', "CONT.SES(S9:S$i;\"=1\";T9:T$i;\"=1\";U9:U$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue('B5', "CONT.SES(S9:S$i;\"=1\";T9:T$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // Incidentes Rotina tratados em até 08 horas
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Índice de incidentes rotinas tratados em até 04 horas')
            ->setCellValue('A2', 'Total de Incidentes rotinas')
            ->setCellValue('A4', 'Incidentes rotinas')
            ->setCellValue('A5', 'Incidentes rotinas recebidos')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->setTitle('IN.04');
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
            ->setCellValue('H8', 'SLA')
            ->setCellValue('I8', 'Criação')
            ->setCellValue('J8', 'Fila Criação')
            ->setCellValue('K8', 'Fechamento')
            ->setCellValue('L8', 'Fila Fechamento')
            ->setCellValue('M8', 'Usuário Fechamento')
            ->setCellValue('N8', 'Tempo Pendente')
            ->setCellValue('O8', 'Tempo Pendente DET2')
            ->setCellValue('P8', 'Tempo Resolução')
            ->setCellValue('Q8', 'Tempo Resolução DET2')
            ->setCellValue('R8', 'Tempo Real');
        $xls->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('eaeaea');

        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['priority_name'])
                ->setCellValue('F' . $i, $value['state_name'])
                ->setCellValue('G' . $i, $value['service_name'])
                ->setCellValue('H' . $i, $value['sla_name'])
                ->setCellValue('I' . $i, $value['create_time'])
                ->setCellValue('J' . $i, $value['queue_create_name'])
                ->setCellValue('K' . $i, $value['finish_time'])
                ->setCellValue('L' . $i, $value['queue_finish_name'])
                ->setCellValue('M' . $i, $value['user_finish'])
                ->setCellValue('N' . $i, $value['timePending'])
                ->setCellValue('O' . $i, $value['timePendingDET2'])
                ->setCellValue('P' . $i, $value['timeResolution'])
                ->setCellValue('Q' . $i, $value['timeDET2'])
                ->setCellValue('R' . $i, FksUtils::intToTime(FksUtils::timeToInt($value['timeDET2'])-FksUtils::timeToInt($value['timePendingDET2'])))
                ->setCellValue('S' . $i, 1)
                ->setCellValue('T' . $i, ($value['sla_id'] == 3 ? 1 : 0))
                ->setCellValue('U' . $i, ((FksUtils::timeToInt($value['timeDET2'])-FksUtils::timeToInt($value['timePendingDET2'])) <= 14400 ? 1 : 0));
                    
            $i++;
        }
        ($i!=9 ? $i-- : $i);
        $xls->getActiveSheet()->setCellValue('B4', "CONT.SES(S9:S$i;\"=1\";T9:T$i;\"=1\";U9:U$i;\"=1\")");
        $xls->getActiveSheet()->setCellValue('B5', "CONT.SES(S9:S$i;\"=1\";T9:T$i;\"=1\")");
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');
        
        // Contabilização por Fila
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4);
        $xls->getActiveSheet()->setTitle('Geral');
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getColumnDimension('B')->setWidth(6);
        $xls->getActiveSheet()->getColumnDimension('C')->setWidth(6);
        $xls->getActiveSheet()->getColumnDimension('D')->setWidth(8);
        $xls->getActiveSheet()->getColumnDimension('E')->setWidth(6);
        $xls->getActiveSheet()->getColumnDimension('F')->setWidth(6);
        $xls->getActiveSheet()->getColumnDimension('G')->setWidth(8);
        $xls->getActiveSheet()->getColumnDimension('H')->setWidth(6);
        $xls->getActiveSheet()->getColumnDimension('I')->setWidth(6);
        $xls->getActiveSheet()->getColumnDimension('J')->setWidth(8);
        $xls->getActiveSheet()->mergeCells('B1:D1');
        $xls->getActiveSheet()->mergeCells('E1:G1');
        $xls->getActiveSheet()->mergeCells('H1:J1');
        
        $xls->getActiveSheet()->setCellValue('A2','Filas');
        $xls->getActiveSheet()->setCellValue('B1','Críticos');
        $xls->getActiveSheet()->setCellValue('E1','Urgentes');
        $xls->getActiveSheet()->setCellValue('H1','Rotinas');
        $xls->getActiveSheet()->setCellValue('B2','Total');
        $xls->getActiveSheet()->setCellValue('C2','OK');
        $xls->getActiveSheet()->setCellValue('D2','%');
        $xls->getActiveSheet()->setCellValue('E2','Total');
        $xls->getActiveSheet()->setCellValue('F2','OK');
        $xls->getActiveSheet()->setCellValue('G2','%');
        $xls->getActiveSheet()->setCellValue('H2','Total');
        $xls->getActiveSheet()->setCellValue('I2','OK');
        $xls->getActiveSheet()->setCellValue('J2','%');
        $xls->getActiveSheet()->getStyle('A1:J2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A1:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('A2:J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A2:J2')->getFill()->getStartColor()->setRGB('eaeaea');
        
        // Preenche as Filas
        $xls->getActiveSheet()->setCellValue('A3','DET-2 - Rede');
        $xls->getActiveSheet()->setCellValue('A4','DET-2 - Rede::Aplicação');
        $xls->getActiveSheet()->setCellValue('A5','DET-2 - Rede::Banco de Dados');
        $xls->getActiveSheet()->setCellValue('A6','DET-2 - Rede::Correio Eletrônico');
        $xls->getActiveSheet()->setCellValue('A7','DET-2 - Rede::Infraestrutura');
        $xls->getActiveSheet()->setCellValue('A8','DET-2 - Rede::Monitoramento');
        $xls->getActiveSheet()->setCellValue('A9','DET-2 - Rede::Multimídia');
        $xls->getActiveSheet()->setCellValue('A10','DET-2 - Rede::Rede Windows');
        $xls->getActiveSheet()->setCellValue('A11','DET-2 - Rede::Segurança');
        $xls->getActiveSheet()->setCellValue('A12','DET-2 - Rede::Storage');

        // ++ Plotando formulas
        // Total Critico
        $xls->getActiveSheet()->setCellValue("B3","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A3)");
        $xls->getActiveSheet()->setCellValue("B4","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A4)");
        $xls->getActiveSheet()->setCellValue("B5","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A5)");
        $xls->getActiveSheet()->setCellValue("B6","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A6)");
        $xls->getActiveSheet()->setCellValue("B7","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A7)");
        $xls->getActiveSheet()->setCellValue("B8","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A8)");
        $xls->getActiveSheet()->setCellValue("B9","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A9)");
        $xls->getActiveSheet()->setCellValue("B10","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A10)");
        $xls->getActiveSheet()->setCellValue("B11","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A11)");
        $xls->getActiveSheet()->setCellValue("B12","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A12)");
        // OK Critico
        $xls->getActiveSheet()->setCellValue("C3","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A3,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C4","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A4,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C5","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A5,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C6","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A6,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C7","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A7,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C8","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A8,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C9","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A9,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C10","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A10,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C11","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A11,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("C12","=COUNTIFS(IN.02!\$D$9:\$D$".$i.",\"=Incidente\",IN.02!\$H$9:\$H$".$i.",\"=04 Horas: Critico\",IN.02!\$L$9:\$L$".$i.",A12,IN.02!\$U$9:\$U$".$i.",\"=1\")");
        // % Critico
        $xls->getActiveSheet()->setCellValue("D3","=IF(C3>0,(C3/B3)*100,0)");
        $xls->getActiveSheet()->setCellValue("D4","=IF(C4>0,(C4/B4)*100,0)");
        $xls->getActiveSheet()->setCellValue("D5","=IF(C5>0,(C5/B5)*100,0)");
        $xls->getActiveSheet()->setCellValue("D6","=IF(C6>0,(C6/B6)*100,0)");
        $xls->getActiveSheet()->setCellValue("D7","=IF(C7>0,(C7/B7)*100,0)");
        $xls->getActiveSheet()->setCellValue("D8","=IF(C8>0,(C8/B8)*100,0)");
        $xls->getActiveSheet()->setCellValue("D9","=IF(C9>0,(C9/B9)*100,0)");
        $xls->getActiveSheet()->setCellValue("D10","=IF(C10>0,(C10/B10)*100,0)");
        $xls->getActiveSheet()->setCellValue("D11","=IF(C11>0,(C11/B11)*100,0)");
        $xls->getActiveSheet()->setCellValue("D12","=IF(C12>0,(C12/B12)*100,0)");

        // Total Urgente
        $xls->getActiveSheet()->setCellValue("E3","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A3)");
        $xls->getActiveSheet()->setCellValue("E4","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A4)");
        $xls->getActiveSheet()->setCellValue("E5","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A5)");
        $xls->getActiveSheet()->setCellValue("E6","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A6)");
        $xls->getActiveSheet()->setCellValue("E7","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A7)");
        $xls->getActiveSheet()->setCellValue("E8","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A8)");
        $xls->getActiveSheet()->setCellValue("E9","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A9)");
        $xls->getActiveSheet()->setCellValue("E10","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A10)");
        $xls->getActiveSheet()->setCellValue("E11","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A11)");
        $xls->getActiveSheet()->setCellValue("E12","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A12)");
        // OK Urgente
        $xls->getActiveSheet()->setCellValue("F3","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A3,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F4","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A4,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F5","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A5,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F6","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A6,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F7","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A7,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F8","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A8,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F9","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A9,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F10","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A10,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F11","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A11,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("F12","=COUNTIFS(IN.03!\$D$9:\$D$".$i.",\"=Incidente\",IN.03!\$H$9:\$H$".$i.",\"=08 horas: Urgente\",IN.03!\$L$9:\$L$".$i.",A12,IN.03!\$U$9:\$U$".$i.",\"=1\")");
        // % Urgente
        $xls->getActiveSheet()->setCellValue("G3","=IF(F3>0,(F3/E3)*100,0)");
        $xls->getActiveSheet()->setCellValue("G4","=IF(F4>0,(F4/E4)*100,0)");
        $xls->getActiveSheet()->setCellValue("G5","=IF(F5>0,(F5/E5)*100,0)");
        $xls->getActiveSheet()->setCellValue("G6","=IF(F6>0,(F6/E6)*100,0)");
        $xls->getActiveSheet()->setCellValue("G7","=IF(F7>0,(F7/E7)*100,0)");
        $xls->getActiveSheet()->setCellValue("G8","=IF(F8>0,(F8/E8)*100,0)");
        $xls->getActiveSheet()->setCellValue("G9","=IF(F9>0,(F9/E9)*100,0)");
        $xls->getActiveSheet()->setCellValue("G10","=IF(F10>0,(F10/E10)*100,0)");
        $xls->getActiveSheet()->setCellValue("G11","=IF(F11>0,(F11/E11)*100,0)");
        $xls->getActiveSheet()->setCellValue("G12","=IF(F12>0,(F12/E12)*100,0)");

        // Total Rotina
        $xls->getActiveSheet()->setCellValue("H3","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A3)");
        $xls->getActiveSheet()->setCellValue("H4","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A4)");
        $xls->getActiveSheet()->setCellValue("H5","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A5)");
        $xls->getActiveSheet()->setCellValue("H6","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A6)");
        $xls->getActiveSheet()->setCellValue("H7","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A7)");
        $xls->getActiveSheet()->setCellValue("H8","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A8)");
        $xls->getActiveSheet()->setCellValue("H9","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A9)");
        $xls->getActiveSheet()->setCellValue("H10","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A10)");
        $xls->getActiveSheet()->setCellValue("H11","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A11)");
        $xls->getActiveSheet()->setCellValue("H12","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A12)");
        // OK Rotina
        $xls->getActiveSheet()->setCellValue("I3","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A3,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I4","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A4,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I5","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A5,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I6","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A6,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I7","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A7,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I8","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A8,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I9","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A9,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I10","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A10,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I11","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A11,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        $xls->getActiveSheet()->setCellValue("I12","=COUNTIFS(IN.04!\$D$9:\$D$".$i.",\"=Incidente\",IN.04!\$H$9:\$H$".$i.",\"=04 Horas - Rotinas\",IN.04!\$L$9:\$L$".$i.",A12,IN.04!\$U$9:\$U$".$i.",\"=1\")");
        // % Rotina
        $xls->getActiveSheet()->setCellValue("J3","=IF(I3>0,(I3/H3)*100,0)");
        $xls->getActiveSheet()->setCellValue("J4","=IF(I4>0,(I4/H4)*100,0)");
        $xls->getActiveSheet()->setCellValue("J5","=IF(I5>0,(I5/H5)*100,0)");
        $xls->getActiveSheet()->setCellValue("J6","=IF(I6>0,(I6/H6)*100,0)");
        $xls->getActiveSheet()->setCellValue("J7","=IF(I7>0,(I7/H7)*100,0)");
        $xls->getActiveSheet()->setCellValue("J8","=IF(I8>0,(I8/H8)*100,0)");
        $xls->getActiveSheet()->setCellValue("J9","=IF(I9>0,(I9/H9)*100,0)");
        $xls->getActiveSheet()->setCellValue("J10","=IF(I10>0,(I10/H10)*100,0)");
        $xls->getActiveSheet()->setCellValue("J11","=IF(I11>0,(I11/H11)*100,0)");
        $xls->getActiveSheet()->setCellValue("J12","=IF(I12>0,(I12/H12)*100,0)");

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, IncraExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(false);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }
}
