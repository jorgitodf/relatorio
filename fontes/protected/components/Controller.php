<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main-'; //'//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * @var string the default TbButtonColumn for the TbGridView.
     * Show buttons Edit, Delete anda View
     */
    public $gridViewTemplate = '{update}{delete}{view}';

    /**
     *
     * @var string the base path for register JavaScript and CSS files
     */
    public $baseUrl = '';

    /**
     *
     * @var string the theme name for render layout
     */
    public $themeName = '';

    /**
     * 
     * @param type $action
     */
    protected function beforeAction($action) {
        $this->baseUrl = Yii::app()->theme->baseUrl;
        $this->pageTitle = Yii::app()->name;
        return parent::beforeAction($action);
    }

    /**
     * @param string $id id of this controller
     * @param CWebModule $module the module that this controller belongs to.
     */
    public function __construct($id, $module = NULL) {
        $this->themeName = Yii::app()->theme->name;
        $this->layout .= $this->themeName;
        parent::__construct($id, $module);
    }

    /**
     * Permissions validate from RBAC.
     * @param string the controller to be validated
     */
    public function validationAccessRules($nameController) {
        $rbac = Usuario::rbac($nameController);
        // deny authenticated user to all actions
        $acesso = array('deny', 'actions' => array('*'), 'users' => array('@'),);
        switch ($rbac) {
            case '01': // Completo
                $this->gridViewTemplate = '{update}{delete}{view}';
                $acesso = array('allow', 'actions' => array('index', 'create', 'update', 'delete', 'view'), 'users' => array('@'),);
                break;
            case '02': // Edição
                $this->gridViewTemplate = '{update}{view}';
                $acesso = array('allow', 'actions' => array('index', 'create', 'update', 'view'), 'users' => array('@'),);
                break;
            case '03': // Leitura
                $this->gridViewTemplate = '{view}';
                $acesso = array('allow', 'actions' => array('index', 'view'), 'users' => array('@'),);
                break;
        }
        return $acesso;
    }

}
