<?php

class KPIController extends Controller {
    
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

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
            array('allow', 'actions' => array('cvm','ajaxCheckboxService', 'incra', 'ancine', 'ancine_rel', 'incra_rel', 'iphan_rel', 'anatel', 'anatel_rel', 'anateln3', 'anatelSustentacao', 'anatelRedes', 'anatelImpressoras'), 'users' => array('ios'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'anatel', 'anatel_rel', 'anateln3', 'anatelSustentacao', 'anatelRedes', 'anatelImpressoras', 'anatelGDados'), 'users' => array('anatel'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'fraport', 'fraport_rel'), 'users' => array('fraport'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'funarte'), 'users' => array('funarte'),
            ),
            array('allow', 'actions' => array('ajaxCheckboxService', 'ancine', 'ancine_rel'), 'users' => array('Ancine'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        throw new CHttpException(404, 'The requested page does not exist.');
    }

    /**
     * Show KPI INCRA
     */
    public function actionIncra() {
        $model = new KpiIncra('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiIncra'])){
            $model->attributes = $_POST['KpiIncra'];
            $model->validate();
        }

        $this->render('incra', array(
            'model' => $model,
        ));
    }
    
    /**
     * Show KPI ANCINE
    */
    public function actionAncine() {
        $model = new KpiAncine('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiAncine'])){
            $model->attributes = $_POST['KpiAncine'];
            $model->validate();
        }

        $this->render('ancine', array(
            'model' => $model,
        ));
    }

    /**
     * Show KPI FRAPORT
     */
    public function actionFraport() {
        $model = new KpiFraport('search');
        $model->unsetAttributes();
        if (isset($_POST['KpiFraport'])){
            $model->attributes = $_POST['KpiFraport'];
            $model->validate();
        }
        $this->render('fraport', array(
            'model' => $model,
        ));
    }

    /**
     * Show KPI FUNARTE
     */
    public function actionFunarte() {
        $model = new KpiFunarte('search');
        $model->unsetAttributes();
        if (isset($_POST['KpiFunarte'])){
            $model->attributes = $_POST['KpiFunarte'];
            $model->validate();
        }
        $this->render('funarte', array(
            'model' => $model,
        ));
    }

    /**
     * Show KPI CVM
     */
    public function actionCvm() {
        $model = new KpiCvm('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiCvm'])){
            $model->attributes = $_POST['KpiCvm'];
            $model->validate();
        }

        $this->render('cvm', array(
            'model' => $model,
        ));
    }


    /**
     * Show KPI ANATEL
     */
    public function actionAnatel() {
        $model = new KpiAnatel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            $model->validate();
        }

        $this->render('anatel', array(
            'model' => $model,
        ));
    }

    /**
     * Show KPI ANATEL N3
     */
    public function actionAnatelN3() {
        $model = new KpiAnatel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['KpiAnatel'])){
            $model->attributes = $_POST['KpiAnatel'];
            $model->validate();
        }

        $this->render('anateln3', array(
            'model' => $model,
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

    public static function intToTime($seconds) {
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);
        $hours = strlen($hours)<=1 ? strrev(substr(strrev(str_pad($hours,2,'0',STR_PAD_LEFT)),0,2)) : $hours;
        $mins = strrev(substr(strrev(str_pad($mins,2,'0',STR_PAD_LEFT)),0,2));
        $secs = strrev(substr(strrev(str_pad($secs,2,'0',STR_PAD_LEFT)),0,2));
        return $hours . ':' . $mins . ':' . $secs;
    }

}
