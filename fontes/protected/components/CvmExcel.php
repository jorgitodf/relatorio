<?php

class CvmExcel {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * 7.1 Ilha Suporte Soluções Comeciais
     * @param KpiCvm $model
     * @return string
     */
    public static function generateXls71($model) {
        //7.1 Ilha Suporte Soluções Comeciais
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Suporte Soluções Comeciais")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.1 Ilha Suporte Soluções Comeciais, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");
        // 7.1.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Índice de chamadas telefonicas abandonadas')
            ->setCellValue('A2', 'Total de chamadas Telefonicas')
            ->setCellValue('A4', 'Total de chamadas abandonadas')
            ->setCellValue('A5', 'Total de chamadas telefonicas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.1');
        //7.1.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 15 min')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 15 min')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1); //CentralDeServicos
        $rsl = $model->rptTicketsEncerradosPorTempo();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', 'CONT.SE(L9:L' . $i . ',"<=00:15:00")');
        $xls->getActiveSheet()->setCellValue('B5', 'CONT.VALORES(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', 'B4/B5');

        //7.1.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 2 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em até 2 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1); //CentralDeServicos
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', 'CONT.SE(L9:L' . $i . ',"<=02:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', 'CONT.VALORES(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', 'B4/B5');

        //7.1.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 12horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em até 12 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1); //CentralDeServicos
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', 'CONT.SE(L9:L' . $i . ',"<=12:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', 'CONT.VALORES(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', 'B4/B5');

        //7.1.5
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 5 dias')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em até 5 dias')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.5');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1); //CentralDeServicos
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', 'CONT.SE(L9:L' . $i . ',"<=120:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', 'CONT.VALORES(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', 'B4/B5');

        //7.1.6
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Tempo médio na fila de espera')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Total de Tempos em Espera')
            ->setCellValue('A5', 'Total de chamadas telefônicas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.6');

        //7.1.7
        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
            ->setCellValue('A1', 'Índice de chamadas telefônicas atendidas em até 20 segundos')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Chamadas em até 20 segundos')
            ->setCellValue('A5', 'Total de chamadas telefônicas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.7');

        //7.1.8
        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
            ->setCellValue('A1', 'Tempo médio de tratamento inicial dos chamados encaminhados via email, callback ou via web')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Total tempo de espera')
            ->setCellValue('A5', 'Total de demandas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.1.8');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1); //CentralDeServicos
        $i = 9;
        $equa = '';
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, str_replace('-', '', $value['time_1_response']));
            $equa .= (empty($equa) ? 'L' . $i : '+L' . $i);
            $i++;
        }
        $i--;
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', "$equa");
        $xls->getActiveSheet()->setCellValue('B5', 'CONT.VALORES(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', 'B4/B5');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * 7.2 Ilha Suporte Soluções Corporativas
     * @param Report $model
     * @param index $form
     * @return string
     */
    public static function generateXls72($model) {
        //7.2 Ilha Suporte Soluções Corporativas
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Suporte Soluções Comeciais")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.1 Ilha Suporte Soluções Comeciais, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");
        // 7.2.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Índice de chamadas telefonicas abandonadas')
            ->setCellValue('A2', 'Total de chamadas Telefonicas')
            ->setCellValue('A4', 'Total de chamadas abandonadas')
            ->setCellValue('A5', 'Total de chamadas telefonicas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.1');
        //7.2.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 15 min')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 15 min')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(18); //Suporte Externo
        $rsl = $model->rptTicketsEncerradosPorTempo();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=00:15:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        //7.2.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 2 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em até 2 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(18); //Suporte Externo
        /**
         * Linha comentada devido o fato da consulta já ter sido executada
         * $rsl = $model->rptTicketsEncerradosPorTempo();
         */
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=02:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        //7.2.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 12horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em até 12 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(18); //Suporte Externo
        /**
         * Linha comentada devido o fato da consulta já ter sido executada
         * $rsl = $model->rptTicketsEncerradosPorTempo();
         */
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=12:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        //7.2.5
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 5 dias')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em até 5 dias')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.5');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(18); //Suporte Externo
        /**
         * Linha comentada devido o fato da consulta já ter sido executada
         * $rsl = $model->rptTicketsEncerradosPorTempo();
         */
        $i = 9;
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=120:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        //7.2.6
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Tempo médio na fila de espera')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Total de Tempos em Espera')
            ->setCellValue('A5', 'Total de chamadas telefônicas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.6');

        //7.2.7
        $xls->createSheet(6);
        $xls->setActiveSheetIndex(6)
            ->setCellValue('A1', 'Índice de chamadas telefônicas atendidas em até 20 segundos')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Chamadas em até 20 segundos')
            ->setCellValue('A5', 'Total de chamadas telefônicas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.7');

        //7.2.8
        $xls->createSheet(7);
        $xls->setActiveSheetIndex(7)
            ->setCellValue('A1', 'Tempo médio de tratamento inicial dos chamados encaminhados via email, callback ou via web')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Total tempo de espera')
            ->setCellValue('A5', 'Total de demandas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.2.8');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(18); //Suporte Externo
        /**
         * Linha comentada devido o fato da consulta já ter sido executada
         * $rsl = $model->rptTicketsEncerradosPorTempo();
         */
        $i = 9;
        $equa = '';
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, str_replace('-', '', $value['time_1_response']));
            $equa .= (empty($equa) ? 'L' . $i : '+L' . $i);
            $i++;
        }
        $i--;
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', "=$equa");
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * 7.3 Ilha Suporte Local(RJ,SP,DF)
     * @param Report $model
     * @param index $form
     * @return string
     */
    public static function generateXls73($model) {
        //7.3 Ilha Suporte Local(RJ,SP,DF)
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Suporte Soluções Comeciais")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.1 Ilha Suporte Soluções Comeciais, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");
        // 7.3.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 6 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 6 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.3.1');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(2, 3, 4); //Local(RJ,SP,BR)
        $rsl = $model->rptTicketsEncerradosPorTempo();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=06:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.3.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 12 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 12 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.3.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(2, 3, 4); //Local(RJ,SP,BR)
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=12:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.3.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 24 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 24 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.3.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(2, 3, 4); //Local(RJ,SP,BR)
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=24:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.3.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 5 dias')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 5 dias')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.3.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(2, 3, 4); //Local(RJ,SP,BR)
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");

            $i++;
        }
        $i--;
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=120:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * 7.4 Ilha Suporte Local Administração de Redes Locais
     * @param Report $model
     * @param index $form
     * @return string
     */
    public static function generateXls74($model) {
        //7.4 Ilha Suporte Local Administração de Redes Locais
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Suporte Local Administração de Redes Locais")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.4 Ilha Suporte Local Administração de Redes Locais, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");
        // 7.4.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 6 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 6 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.4.1');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        //$model->idQueue = array(2, 3, 4); //Administracao Redes Locais
        $rsl = $model->rptTicketsEncerradosPorTempoServico();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_in_queue']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=06:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.4.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 12 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 12 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.4.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        //$model->idQueue = array(2, 3, 4); //Administracao Redes Locais
        /**
         * Linha comentada devido a consulta ter sido feita
         * $rsl = $model->rptTicketsEncerradosPorTempoServico();
         */
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_in_queue']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=12:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.4.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 24 horas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 24 horas')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.4.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        //$model->idQueue = array(2, 3, 4); //Administracao Redes Locais
        /**
         * Linha comentada devido a consulta ter sido feita
         * $rsl = $model->rptTicketsEncerradosPorTempoServico();
         */
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_in_queue']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=24:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.4.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Indice de demandas resolvidas em até 5 dias')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas em 5 dias')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.4.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        //$model->idQueue = array(2, 3, 4); //Administracao Redes Locais
        /**
         * Linha comentada devido a consulta ter sido feita
         * $rsl = $model->rptTicketsEncerradosPorTempoServico();
         */
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_in_queue']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=120:00:00")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * 7.5 Ilha Monitoramento e Gestao de Telesuporte
     * @param Report $model
     * @param index $form
     * @return string
     */
    public static function generateXls75($model) {
        //7.5 Ilha Monitoramento e Gestao de Telesuporte
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Monitoramento e Gestao de Telesuporte")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.5 Ilha Monitoramento e Gestao de Telesuporte, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // 7.5.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Indice de demandas para ilha de suporte comercial resolvidas no 1º contato')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas no 1º contato')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.5.1');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Qtd Contato');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1); //Central de Servicos
        $rsl = $model->rptTicketsEncerradosSemEncaminhamento();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValueExplicit('L' . $i, $value['qtd_contact'], PHPExcel_Cell_DataType::TYPE_NUMERIC);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.5.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Indice de demandas para ilha de suporte corporativo resolvidas no 1º contato')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas no 1º contato')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.5.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Qtd Contato');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(18); //Suporte Externo
        $rsl = $model->rptTicketsEncerradosSemEncaminhamento();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValueExplicit('L' . $i, $value['qtd_contact'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"<=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.5.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Indice de dados inconsistentes e/ou incompletos dentro do universo de demandas')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas inconsistentes e/ou incompletos')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.5.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Inconsistente');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        //$model->idQueue = array(); //Tudo
        $rsl = $model->rptTicketsEncerradosInconsistentes();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['inconsistent']);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"=TRUE")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.5.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Indice de satisfação com o atendimento')
            ->setCellValue('A2', 'Total de respostas recebidas')
            ->setCellValue('A4', 'Respostas com Ótimo/Bom')
            ->setCellValue('A5', 'Respostas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.5.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fechamento')
            ->setCellValue('I8', 'Fila Fechamento')
            ->setCellValue('J8', 'Envio')
            ->setCellValue('K8', 'Resposta')
            ->setCellValue('L8', 'Chave')
            ->setCellValue('M8', 'Pergunta')
            ->setCellValue('N8', 'Voto')
            ->setCellValue('O8', 'Satisfação');
        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');


        $rsl = $model->rptPesquisaSatisfacaoNew();
        $i = 9;
        $id = 0;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['state_name'])
                    ->setCellValue('F' . $i, $value['service_name'])
                    ->setCellValue('G' . $i, $value['create_time'])
                    ->setCellValue('H' . $i, $value['finish_time'])
                    ->setCellValue('I' . $i, $value['queue_finish_name'])
                    ->setCellValue('J' . $i, $value['send_time'])
                    ->setCellValue('K' . $i, $value['vote_time'])
                    ->setCellValue('L' . $i, $value['public_survey_key']);

                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('M' . $i, $value['question'])
                ->setCellValue('N' . $i, $value['question_id'] == 10 ? $value['vote_value']:$value['answer']);
                //->setCellValue('O' . $i, $value['satisfaction']);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(O9:O' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.5.5
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Indice de insatisfação com o atendimento')
            ->setCellValue('A2', 'Total de respostas recebidas')
            ->setCellValue('A4', 'Respostas com Ruim/Péssimo')
            ->setCellValue('A5', 'Respostas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.5.5');

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
        $xls->getActiveSheet()->setCellValue('A8', 'Nº Ticket')
            ->setCellValue('B8', 'Ticket ID')
            ->setCellValue('C8', 'Título')
            ->setCellValue('D8', 'Tipo')
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fechamento')
            ->setCellValue('I8', 'Fila Fechamento')
            ->setCellValue('J8', 'Envio')
            ->setCellValue('K8', 'Resposta')
            ->setCellValue('L8', 'Chave')
            ->setCellValue('M8', 'Pergunta')
            ->setCellValue('N8', 'Voto')
            ->setCellValue('O8', 'Insatisfação');


        $xls->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:O8')->getFill()->getStartColor()->setRGB('eaeaea');

        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            if ($id != $value['ticket_id']) {
                $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $value['ticket_id'])
                    ->setCellValue('C' . $i, $value['title'])
                    ->setCellValue('D' . $i, $value['type_name'])
                    ->setCellValue('E' . $i, $value['state_name'])
                    ->setCellValue('F' . $i, $value['service_name'])
                    ->setCellValue('G' . $i, $value['create_time'])
                    ->setCellValue('H' . $i, $value['finish_time'])
                    ->setCellValue('I' . $i, $value['queue_finish_name'])
                    ->setCellValue('J' . $i, $value['send_time'])
                    ->setCellValue('K' . $i, $value['vote_time'])
                    ->setCellValue('L' . $i, $value['public_survey_key']);
                ;

                $id = $value['ticket_id'];
            }
            $xls->getActiveSheet()->setCellValue('M' . $i, $value['question'])
                ->setCellValue('N' . $i, $value['question_id'] == 10 ? $value['vote_value']:$value['answer']);
                //->setCellValue('O' . $i, $value['nosatisfaction']);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(O9:O' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * 7.6 Ilha Monitoramento e Gestao de Suporte
     * @param Report $model
     * @param index $form
     * @return string
     */
    public static function generateXls76($model) {
        //7.6 Ilha Monitoramento e gestão de suporte local e administração de redes locais
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Monitoramento e Gestao de Suporte")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.6 Ilha Monitoramento e Gestao de Suporte, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // 7.6.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Indice de demandas resolvidas no primeiro contato com o usuário')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Demandas resolvidas no 1º contato')
            ->setCellValue('A5', 'Demandas recebidas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.6.1');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Qtd Contato');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(2, 3, 4); //Suporte Local
        $model->servicesIds = array(191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201,
            202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217, 218,
            219, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235,
            236, 237, 238, 239, 240); //ADM Rede
        $rsl = $model->rptTicketsEncerradosSemReabertura();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValueExplicit('L' . $i, $value['first_contact'], PHPExcel_Cell_DataType::TYPE_NUMERIC);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->setCellValue('B4', '=COUNTIF(L9:L' . $i . ',"=1")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.6.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Tempo médio de suspenção de chamados')
            ->setCellValue('A2', 'Total de demandas recebidas')
            ->setCellValue('A4', 'Somatório tempos de suspenção')
            ->setCellValue('A5', 'Demandas suspensas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.6.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Pendência');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $rsl = $model->rptTicketsEncerradosSuporteSuspensao();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_pending']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);

            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', "=SUM(L9:L$i)");
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.6.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Tempo médio de suspenção de escalonamento')
            ->setCellValue('A2', 'Total de demandas')
            ->setCellValue('A4', 'Somatório tempos de escalonamento')
            ->setCellValue('A5', 'Demandas ')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.6.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(2, 3, 4); //Suporte Local
        $model->servicesIds = array(191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201,
            202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217, 218,
            219, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235,
            236, 237, 238, 239, 240); //ADM Rede
        $rsl = $model->rptTicketsEncerradosPorTempoOLA();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish']);
            $j = 0;
            $equa = '';
            foreach ($model->idQueue as $timeQueue) {
                $cell = $alfa[$j] . $i;
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFont()->setBold(true);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $xls->getActiveSheet()->getStyle($alfa[$j] . "8")->getFill()->getStartColor()->setRGB('eaeaea');
                $xls->getActiveSheet()->setCellValue($alfa[$j] . "8", "Tempo $timeQueue");
                $xls->getActiveSheet()->setCellValue($cell, $value["time_in_queue$timeQueue"]);
                $xls->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
                $equa .= (empty($equa) ? $cell : '+' . $cell);
                $j++;
            }
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $xls->getActiveSheet()->setCellValue('L' . $i, "=$equa");
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', "=SUM(L9:L$i)");
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTA(A9:A' . $i . ')');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.6.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Tempo médio de disponibilidade serviços de rede local')
            ->setCellValue('A2', 'Total de serviços')
            ->setCellValue('A4', 'Somatório tempos de disponibilidade')
            ->setCellValue('A5', 'Serviços de Rede ')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.6.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo Total');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }

    /**
     * 7.7 Ilha Monitoramento e Gestao de Suporte(IN,PR,LB,CN&MD)
     * @param Report $model
     * @param index $form
     * @return string
     */
    public static function generateXls77($model) {
        //7.7 Ilha Monitoramento e gestão de suporte IM,PM,CM,CH,RM
        $fileName = dirname(__FILE__) . '/../../assets/report' . CvmExcel::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . CvmExcel::extensao;
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
            ->setLastModifiedBy("IOS Informática")
            ->setTitle("Ilha Monitoramento e Gestao de Suporte")
            ->setSubject("Ilha Suporte Soluções Comeciais")
            ->setDescription("7.7 Ilha Monitoramento e Gestao de Suporte, indicadores.")
            ->setKeywords("office PHPExcel php YiiExcel UPNFM")
            ->setCategory("Indicadores");

        // 7.7.1
        $xls->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tempo médio de direcionamento de incidentes')
            ->setCellValue('A2', 'Somatório dos tempos')
            ->setCellValue('A4', 'Demandas tipo incidente')
            ->setCellValue('A5', 'Total de incidentes')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.7.1');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->typeIds = array(2);
        $rsl = $model->rptTicketsEncerradosPorTipo();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_1_response']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', '=SUMIF(D9:D' . $i . ',"Incidente",L9:L' . $i . ')');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTIF(D9:D' . $i . ',"Incidente")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.7.2
        $xls->createSheet(1);
        $xls->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Tempo médio de direcionamento de outras demandas')
            ->setCellValue('A2', 'Somatório dos tempos')
            ->setCellValue('A4', 'Demandas tipo outras')
            ->setCellValue('A5', 'Total de outras demandas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.7.2');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->typeIds = array(1,4);
        $rsl = $model->rptTicketsEncerradosPorTipo();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_1_response']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', '=SUMIF(D9:D' . $i . ',"<>Incidente",L9:L' . $i . ')');
        //$xls->getActiveSheet()->setCellValue('B4', '=SUMIFS(L9:L' . $i . ',D9:D' . $i . ',"<>Incidente",J9:J' . $i . ',"<>PDS")');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTIF(D9:D' . $i . ',"<>Incidente")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.7.3
        $xls->createSheet(2);
        $xls->setActiveSheetIndex(2)
            ->setCellValue('A1', 'Tempo médio de atualização de informações')
            ->setCellValue('A2', 'Somatório dos tempos')
            ->setCellValue('A4', 'Demandas tipo incidentes')
            ->setCellValue('A5', 'Total de incidentes')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.7.3');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->idQueue = array(1,18,2,3,4); // CS,SE,RJ,SP,BR
        $rsl = $model->rptTicketsIncidentesFila();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_update']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', '=SUMIF(D9:D' . $i . ',"Incidente",L9:L' . $i . ')');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTIF(D9:D' . $i . ',"Incidente")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.7.4
        $xls->createSheet(3);
        $xls->setActiveSheetIndex(3)
            ->setCellValue('A1', 'Problemas atendidos no prazo acordado')
            ->setCellValue('A2', 'Total de problemas atendidos')
            ->setCellValue('A4', 'Demandas tipo problemas')
            ->setCellValue('A5', 'Total de problemas')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.7.4');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $model->typeIds = array(5);
        $rsl = $model->rptTicketsEncerradosPorTipo();
        $i = 9;
        $alfa = array("M", "N", "O", "P", "Q", "R");
        foreach ($rsl as $value) {
            $xls->getActiveSheet()->setCellValueExplicit('A' . $i, $value['tn'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B' . $i, $value['ticket_id'])
                ->setCellValue('C' . $i, $value['title'])
                ->setCellValue('D' . $i, $value['type_name'])
                ->setCellValue('E' . $i, $value['state_name'])
                ->setCellValue('F' . $i, $value['service_name'])
                ->setCellValue('G' . $i, $value['create_time'])
                ->setCellValue('H' . $i, $value['queue_create'])
                ->setCellValue('I' . $i, $value['finish_time'])
                ->setCellValue('J' . $i, $value['queue_finish'])
                ->setCellValue('K' . $i, $value['user_finish'])
                ->setCellValue('L' . $i, $value['time_update']);
            $xls->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
            $i++;
        }
        ($i > 9 ? $i-- : $i = 9);
        $xls->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B4', '=SUMIF(D9:D' . $i . ',"Problema",L9:L' . $i . ')');
        $xls->getActiveSheet()->setCellValue('B5', '=COUNTIF(D9:D' . $i . ',"Problema")');
        $xls->getActiveSheet()->getStyle('B6')->getNumberFormat()->setFormatCode(CvmExcel::fmtHora);
        $xls->getActiveSheet()->setCellValue('B6', '=B4/B5');

        // 7.7.5
        $xls->createSheet(4);
        $xls->setActiveSheetIndex(4)
            ->setCellValue('A1', 'Liberações atendidas no prazo acordado')
            ->setCellValue('A2', 'Total de liberações atendidos')
            ->setCellValue('A4', 'Demandas tipo liberações')
            ->setCellValue('A5', 'Total de liberaçoes')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.7.5');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        // 7.7.6
        $xls->createSheet(5);
        $xls->setActiveSheetIndex(5)
            ->setCellValue('A1', 'Informações sobre configuração e mudança')
            ->setCellValue('A2', 'Total de configurações e mudanças atendidos')
            ->setCellValue('A4', 'Demandas tipo configurações e mudanças')
            ->setCellValue('A5', 'Total de configurações e mudanças')
            ->setCellValue('A6', 'Indicadores');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setWidth(41);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->setTitle('7.7.6');

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
            ->setCellValue('E8', 'Situação')
            ->setCellValue('F8', 'Serviço')
            ->setCellValue('G8', 'Criação')
            ->setCellValue('H8', 'Fila Criação')
            ->setCellValue('I8', 'Fechamento')
            ->setCellValue('J8', 'Fila Fechamento')
            ->setCellValue('K8', 'Atendente')
            ->setCellValue('L8', 'Tempo');
        $xls->getActiveSheet()->getStyle('A8:L8')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A8:L8')->getFill()->getStartColor()->setRGB('eaeaea');

        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        // END
        $xls->setActiveSheetIndex(0);
        $xlsWriter = PHPExcel_IOFactory::createWriter($xls, CvmExcel::versaoExcel);
        $xlsWriter->setPreCalculateFormulas(true);

        $xlsWriter->save($fileName);
        unset($xlsWriter);
        unset($xls);
        return $uri;
    }
}