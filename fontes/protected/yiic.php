<?php

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../../../yii-1.1.17/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';
$config=dirname(__FILE__).'/config/main.php';

define('YII_DEBUG',true);

require_once($yiic);

    $app = Yii::createConsoleApplication($config);
 
    //Now you can run application
    $app->run();
