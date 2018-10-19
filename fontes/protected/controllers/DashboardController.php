<?php

class DashboardController extends Controller {
    
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
     * Show Dashboard INCRA
     */
    public function actionIncra() {
        $model = new DashboardIncra('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardIncra'])){
            $model->attributes = $_POST['DashboardIncra'];
            $model->validate();
        }

        $this->render('incra/index', array(
            'model' => $model,
        ));
    }
    
    /**
     * Show Dashboard ANCINE
     */
    public function actionAncine() {
        $model = new DashboardAncine('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardAncine'])){
            $model->attributes = $_POST['DashboardAncine'];
            $model->validate();
        }

        $this->render('ancine/index', array(
            'model' => $model,
        ));
    }

    /**
     * Show Dashboard FRAPORT
     */
    public function actionFraport() {
        $model = new DashboardFraport('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardFraport'])){
            $model->attributes = $_POST['DashboardFraport'];
            $model->validate();
        }

        $this->render('fraport/index', array(
            'model' => $model,
        ));
    }

    /**
     * Show Dashboard ANATEL
     */
    public function actionAnatel() {
        $model = new DashboardAnatel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardAnatel'])){
            $model->attributes = $_POST['DashboardAnatel'];
            $model->validate();
        }
        $this->render('anatel/index', array(
            'model' => $model,
        ));
    }


    /**
     * Show Dashboard CVM
     */
    public function actionCvm()
    {
        $model = new DashboardCvm('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardCvm'])) {
            $model->attributes = $_POST['DashboardCvm'];
            $model->validate();
        }

        $this->render('cvm/index', array(
            'model' => $model,
        ));
    }

    /**
     * Show Dashboard GST
     */
    public function actionGst()
    {
        $model = new DashboardGst('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardGst'])) {
            $model->attributes = $_POST['DashboardGst'];
            $model->validate();
        }

        $this->render('cvm/gst', array(
            'model' => $model,
        ));
    }

    /**
     * Show Dashboard GSI
     */
    public function actionGsi()
    {
        $model = new DashboardGsi('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['DashboardGsi'])) {
            $model->attributes = $_POST['DashboardGsi'];
            $model->validate();
        }

        $this->render('CVM/gsi', array(
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

}
