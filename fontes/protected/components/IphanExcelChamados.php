<?php

class IphanExcelChamados  {

    const versaoExcel = 'Excel2007';
    const extensao = '.xlsx';
    const fmtHora = '[h]:mm:ss';

    /**
     * 
     * @param KpiIphan $model
     * @return string
     */
    public static function generate($model) {
        $fileName = dirname(__FILE__) . '/../../assets/report' . IphanExcelChamados::extensao;
        $uri = Yii::app()->baseUrl . '/fileDownload.php?file=report' . IphanExcelChamados::extensao;

        $xls = new PHPExcel();
        $xls->getProperties()->setCreator("IOS Informática")
                ->setLastModifiedBy("IOS Informática")
                ->setTitle("Relatório Quantidade de Chamados Abertos e Fechados")
                ->setSubject("Relatório Quantidade de Chamados Abertos e Fechados")
                ->setDescription("RTA de Chamados Abertos e Fechados.")
                ->setKeywords("office PHPExcel php YiiExcel UPNFM")
                ->setCategory("Chamados");

        $xls->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Relatório Quantidade de Chamados Abertos e Fechados')
                ->setCellValue('A4', 'Total de Chamados Abertos')
                ->setCellValue('A5', 'Total de Chamados Fechados')
                ->setCellValue('A6', 'Período');
        $xls->getActiveSheet()->setTitle('Iphan');
        $xls->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
        $xls->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $xls->getActiveSheet()->getStyle('A4:B6')->getFill()->getStartColor()->setRGB('eaeaea');
        $xls->getActiveSheet()->getStyle('A4:B6')->getFont()->setBold(true);
        $xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $xls->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $qtdAbe = $model->rptQTDChamadosAbertos();
        $qtdFec = $model->rptQTDChamadosFechados();

        $xls->getActiveSheet()->getStyle("B4")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $xls->getActiveSheet()->setCellValue("B4", $qtdAbe);
        $xls->getActiveSheet()->setCellValue("B5", $qtdFec);
        $xls->getActiveSheet()->setCellValue("B6", FksFormatter::DtEnToBr(FksFormatter::StrToDate($model->dtInicio))." a ".FksFormatter::DtEnToBr(FksFormatter::StrToDate($model->dtTermino)));

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
