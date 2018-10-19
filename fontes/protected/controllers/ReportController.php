<?php

class ReportController extends Controller {


    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', 'actions' => array('cvm','ajaxCheckboxService', 'terracap', 'ancine', 'ancine_rel',
                'iphan_rel', 'anatel', 'anatel_rel', 'anateln3', 'anatelSustentacao', 'anatelRedes', 'anatelImpressoras', 'anatelFiscalizacao'),
                'users' => array('ios'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'anatel', 'anatel_rel', 'anateln3', 'anatelSustentacao',
                'anatelRedes', 'anatelImpressoras', 'anatelGDados', 'anatelBiblioteca', 'anatelInfraestrutura', 'anatelFiscalizacao'), 'users' => array('anatel'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'fraport', 'fraport_rel'), 'users' => array('fraport'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'cvm', 'cvm_rel'), 'users' => array('cvm'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'funarte', 'funarte_rel'), 'users' => array('funarte'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'ancine', 'ancine_rel'), 'users' => array('Ancine'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'terracap'), 'users' => array('terracap'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Generate report for FRAPORT
     */
    public function actionFraport() {
        $model = new KpiFraport('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiFraport'])){
            $model->attributes = $_POST['KpiFraport'];
            if ($model->validate()){
                $uri = FraportExcel::generate($model);
            }
        }

        $this->render('fraport', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }


    /**
     * Generate report for INCRA
     */
    public function actionIncra() {
        $model = new KpiIncra('report');
        $uri = '';
        $model->unsetAttributes();  // clear any default values
        $model->tipo = 0;
        if (isset($_POST['KpiIncra'])){
            $model->attributes = $_POST['KpiIncra'];
            if ($model->validate()){
                if ($model->tipo == 0) {
                    $uri = IncraExcel::generateDET3($model);
                } else if ($model->tipo == 1) {
                    $uri = IncraExcel::generateDET2($model);
                }
            }
        }

        $this->render('incra', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for INCRA QTD DE CHAMADOS
     */
    public function actionIncra_rel() {
        $model = new KpiIncra('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiIncra'])){
            $model->attributes = $_POST['KpiIncra'];
            if ($model->validate()){
                $uri = IncraExcelChamados::generate($model);
            }
        }

        $this->render('incra_rel', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }


    /**
     * Generate report for CVM
     */
    public function actionCvm() {
        $model = new KpiCvm('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiCvm'])){
            //$model->attributes = $_POST['KpiCvm'];
            $model->dtInicio = $_POST['KpiCvm']['dtInicio'];
            $model->dtTermino = $_POST['KpiCvm']['dtTermino'];
            $model->ilha = $_POST['KpiCvm']['ilha'];
            if ($model->ilha == 4) {
                $model->servicesIds = $_POST['KpiCvm']['servicesIds'];
            }

            if ($model->validate()){
                if ($model->ilha == 1) {
                    $uri = CvmExcel::generateXls71($model);
                } else if ($model->ilha == 2) {
                    $uri = CvmExcel::generateXls72($model);
                } else if ($model->ilha == 3) {
                    $uri = CvmExcel::generateXls73($model);
                } else if ($model->ilha == 4) {
                    $uri = CvmExcel::generateXls74($model);
                } else if ($model->ilha == 5) {
                    $uri = CvmExcel::generateXls75($model);
                } else if ($model->ilha == 6) {
                    $uri = CvmExcel::generateXls76($model);
                } else if ($model->ilha == 7) {
                    $uri = CvmExcel::generateXls77($model);
                }
                
                //$uri = 'teste.xlsx';
            }
        }

        $this->render('cvm', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    public function actionAjaxCheckboxService() {
        $ilha = (int) $_POST['ilha'];
        if ($ilha == 4) {
            $model = new KpiCvm();
            $data = $model->listaOtrsServico();
            $data = CHtml::listData($data, 'service_id', 'service_name');
            echo CHtml::dropDownList(CHtml::activeName($model, 'servicesIds'), '', $data, array('multiple' => true));
        }
    }


    /**
     * Generate report for FUNARTE
     */
    public function actionFunarte() {
        $model = new KpiFunarte('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiFunarte'])){
            $model->dtInicio = $_POST['KpiFunarte']['dtInicio'];
            $model->dtTermino = $_POST['KpiFunarte']['dtTermino'];
            $model->ilha = $_POST['KpiFunarte']['ilha'];

            if ($model->validate()){
                if ($model->ilha == 2) {
                    $uri = FunarteExcel::generateXlsINS02($model);
                } else if ($model->ilha == 3) {
                    $uri = FunarteExcel::generateXlsINS03($model);
                } else if ($model->ilha == 5) {
                    $uri = FunarteExcel::generateXlsINS05($model);
                } else if ($model->ilha == 6) {
                    $uri = FunarteExcel::generateXlsINS06($model);
                } else if ($model->ilha == 7) {
                    $uri = FunarteExcel::generateXlsINS07($model);
                //} else if ($model->ilha == 9) {
                //    $uri = FunarteExcel::generateXlsINS09($model);
                } else if ($model->ilha == 10) {
                    $uri = FunarteExcel::generateXlsINS10($model);
                } else if ($model->ilha == 11) {
                    $uri = FunarteExcel::generateXlsINS11($model);
                } else if ($model->ilha == 12) {
                    $uri = FunarteExcel::generateXlsINS12($model);
                } else if ($model->ilha == 13) {
                    $uri = FunarteExcel::generateXlsINS13($model);
                } else if ($model->ilha == 14) {
                    $uri = FunarteExcel::generateXlsINS14($model);
                } else if ($model->ilha == 15) {
                    $uri = FunarteExcel::generateXlsINS15($model);
                } else if ($model->ilha == 16) {
                    $uri = FunarteExcel::generateXlsINS16($model);
                } else if ($model->ilha == 17) {
                    $uri = FunarteExcel::generateXlsINS17($model);
                } else if ($model->ilha == 18) {
                    $uri = FunarteExcel::generateXlsINS18($model);
                } else if ($model->ilha == 23) {
                    $uri = FunarteExcel::generateXlsINS23($model);
                } else if ($model->ilha == 26) {
                    $uri = FunarteExcel::generateXlsINS26($model);
                } else if ($model->ilha == 27) {
                    $uri = FunarteExcel::generateXlsINS27($model);
                } else if ($model->ilha == 28) {
                    $uri = FunarteExcel::generateXlsINSGeral($model);
                }

            }
        }

        $this->render('funarte', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }


    /**
     *
     * return fileNamePath
     */
    protected function excelGenerate($form) {
        $model = new KpiCvm('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiCvm'])){
            $model->dtInicio = $_POST['KpiCvm']['dtInicio'];
            $model->dtTermino = $_POST['KpiCvm']['dtTermino'];
            $model->ilha = $_POST['KpiCvm']['ilha'];
        }
        if ($model->validate()){
            if ($model->ilha == 4) {
                $uri = CvmExcel::generateXls74($model, $form);
            }
            //$uri = 'teste.xlsx';
        }

        $this->render('cvm', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }
    
    
    /**
     * Generate report for ANCINE
     */
    /*public function actionAncine() {
        $model = new KpiAncine('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAncine'])){
            $model->attributes = $_POST['KpiAncine'];
            if ($model->validate()){
                $uri = AncineExcel::generate($model);
                //$uri = 'teste.xlsx';
            }
        }

        $this->render('ancine', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }*/

    /**
     * Generate report for ANCINE QTD DE CHAMADOS
     */
    public function actionAncine_rel() {
        $model = new KpiAncine('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAncine'])){
            $model->attributes = $_POST['KpiAncine'];
            if ($model->validate()){
                $uri = AncineExcelChamados::generate($model);
                //$uri = 'teste.xlsx';
            }
        }

        $this->render('ancine', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANCINE
     */
    public function actionAncine() {
        $model = new KpiAncine('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAncine'])){
            $model->dtInicio = $_POST['KpiAncine']['dtInicio'];
            $model->dtTermino = $_POST['KpiAncine']['dtTermino'];
            $model->ilha = $_POST['KpiAncine']['ilha'];

            if ($model->validate()){
                if ($model->ilha == 2) {
                    $uri = AncineExcel::generateXlsINS02($model);
                } else if ($model->ilha == 4) {
                    $uri = AncineExcel::generateXlsINS04($model);
                } else if ($model->ilha == 7) {
                    $uri = AncineExcel::generateXlsINS07($model);
                } else if ($model->ilha == 0) {
                    $uri = AncineExcel::generateXlsINSGeral($model);
                }
            }
        }

        $this->render('ancine', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }


    /**
     * Generate report for ANCINE
     */
    public function actionTerracap() {
        $model = new KpiTerracap('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiTerracap'])){
            $model->dtInicio = $_POST['KpiTerracap']['dtInicio'];
            $model->dtTermino = $_POST['KpiTerracap']['dtTermino'];
            $model->ilha = $_POST['KpiTerracap']['ilha'];

            if ($model->validate()){
                if ($model->ilha == 1) {
                    $uri = TerracapExcel::generateXlsINS01($model);
                } else if ($model->ilha == 2) {
                    $uri = TerracapExcel::generateXlsINS02($model);
                } else if ($model->ilha == 3) {
                    $uri = TerracapExcel::generateXlsINS03($model);
                } else if ($model->ilha == 4) {
                    $uri = TerracapExcel::generateXlsINS04($model);
                } else if ($model->ilha == 5) {
                    $uri = TerracapExcel::generateXlsINS05($model);
                } else if ($model->ilha == 6) {
                    $uri = TerracapExcel::generateXlsINS06($model);
                } else if ($model->ilha == 7) {
                    $uri = TerracapExcel::generateXlsINS07($model);
                }
            }
        }

        $this->render('terracap', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL
     */
    public function actionAnatel() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelExcel::generate($model);
            }
        }

        $this->render('anatel', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL
     */
    public function actionAnatelN3() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelN3Excel::generate($model);
            }
        }

        $this->render('anateln3', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL SUSTENTAÇÃO
     */
    public function actionAnatelSustentacao() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelSustentacaoExcel::generate($model);
            }
        }

        $this->render('anatelSustentacao', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL REDES
     */
    public function actionAnatelRedes() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelRedes2Excel::generate($model);
            }
        }

        $this->render('anatelRedes', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL IMPRESSORAS
     */
    public function actionAnatelImpressoras() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelImpressoras2Excel::generate($model);
            }
        }

        $this->render('anatelImpressoras', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL INFRAESTRUTURA
     */
    public function actionAnatelInfraestrutura() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelInfraestruturaExcel::generate($model);
            }
        }

        $this->render('anatelInfraestrutura', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL GESTÃO DE DADOS
     */
    public function actionAnatelGDados() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelGDados2Excel::generate($model);
            }
        }

        $this->render('anatelGDados', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL FISCALIZAÇÃO
     */
    public function actionAnatelFiscalizacao() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelFiscalizacaoExcel::generate($model);
            }
        }

        $this->render('anatelFiscalizacao', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for ANATEL BIBLIOTECA
     */
    public function actionAnatelBiblioteca() {
        $model = new KpiAnatel('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            if ($model->validate()){
                $uri = AnatelBiblioteca2Excel::generate($model);
            }
        }

        $this->render('anatelBiblioteca', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }

    /**
     * Generate report for IPHAN QTD DE CHAMADOS
     */
    public function actionIphan_rel() {
        $model = new KpiIphan('search');
        $uri = '';
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['KpiIphan'])){
            $model->attributes = $_POST['KpiIphan'];
            if ($model->validate()){
                $uri = IphanExcelChamados::generate($model);
            }
        }

        $this->render('iphan_rel', array(
            'model' => $model,
            'uri' => $uri,
        ));
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Action the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Action::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Action $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'action-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


}