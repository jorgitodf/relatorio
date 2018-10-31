<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
// Translations I18n
//Yii::app()->sourceLanguage = 'xx';
Yii::app()->language = 'pt_br';

// DATABASE CONFIGURATION
// 1 - PRODUCAO | 2 - DESENVOLVIMENTO
define('DATABASE', 2);

if (DATABASE == 1) {
    // CVM
    $hostCVM = '192.168.25.55';
    $dbnameCVM = 'otrs_cvm';
    $usernameCVM = 'otrs';
    $passwordCVM = 'Otrs@123cvm';
    // INCRA
    $hostINCRA = '172.20.0.95';
    $dbnameINCRA = 'otrs';
    $usernameINCRA = 'u_dashotrs';
    $passwordINCRA = 'd@2h0t5s';
    // ANCINE
    $hostANCINE = '192.168.21.70';
    $dbnameANCINE = 'bd_otrs_ancine';
    $usernameANCINE = 'u_otrs_ancine';
    $passwordANCINE = 'Otrs!123';
    // ANATEL
    $hostANATEL = 'anatelbdpd02';
    $dbnameANATEL = 'prod_otrs';
    $usernameANATEL = 'otrs_user';
    $passwordANATEL = 'r7TaxXWmC68YWQK';
    // IPHAN
    $hostIPHAN = '192.168.255.58';
    $dbnameIPHAN = 'otrs_iphan';
    $usernameIPHAN = 'root';
    $passwordIPHAN = 'root!123';
    // FRAPORT
    $hostFRAPORT = '192.168.255.58';
    $dbnameFRAPORT = 'otrs_fraport';
    $usernameFRAPORT = 'otrs_fraport';
    $passwordFRAPORT = 'otrs_fraport';
    // FUNARTE
    $hostFUNARTE = '192.168.1.171';
    $dbnameFUNARTE = 'otrs';
    $usernameFUNARTE = 'user_dash';
    $passwordFUNARTE = 'Otrs@Fun@rt$!123';
} else {
    // CVM
    $hostCVM = 'localhost';
    $dbnameCVM = 'otrs_cvm';
    $usernameCVM = 'root';
    $passwordCVM = 'root';
    // INCRA
    $hostINCRA = 'localhost';
    $dbnameINCRA = 'otrs_incra';
    $usernameINCRA = 'root';
    $passwordINCRA = 'root';
    // ANCINE
    $hostANCINE = 'localhost:3306';
    $dbnameANCINE = 'bd_otrs_ancine';
    $usernameANCINE = 'root';
    $passwordANCINE = 'root';
    // ANATEL
    $hostANATEL = 'localhost:3306';
    $dbnameANATEL = 'prod_otrs';
    $usernameANATEL = 'root';
    $passwordANATEL = 'root';
    // IPHAN
    $hostIPHAN = '192.168.255.58';
    $dbnameIPHAN = 'otrs_iphan';
    $usernameIPHAN = 'root';
    $passwordIPHAN = 'root!123';
    // FRAPORT
    $hostFRAPORT = 'localhost';
    $dbnameFRAPORT = 'otrs_fraport';
    $usernameFRAPORT = 'root';
    $passwordFRAPORT = 'root';
    // FUNARTE
    $hostFUNARTE = 'localhost';
    $dbnameFUNARTE = 'otrs';
    $usernameFUNARTE = 'root';
    $passwordFUNARTE = 'root';
    // TERRACAP
    $hostTERRACAP = 'localhost';
    $dbnameTERRACAP = 'db_otrs';
    $usernameTERRACAP = 'root';
    $passwordTERRACAP = 'root';
}

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => "Dashboard OTRS",
    //Theme
    'theme' => 'flatlab',
    // preloading 'log' component
    'preload' => array(
        'log',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.sistema.*',
        'application.components.*',
        //--> Auditoria
        //'application.modules.auditTrail.models.AuditTrail',
        //--> YiiExcel
        'application.vendor.phpexcel.PHPExcel',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        //--> Auditoria
        //'auditTrail' => array('userClass' => 'Usuario', // the class name for the user object
        //    'userIdColumn' => 'id_usuario', // the column name of the primary key for the user
        //    'userNameColumn' => 'login'), // the column name of the primary key for the user),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        /* 'urlManager' => array(
          'urlFormat' => 'path',
          'rules' => array(
          '<controller:\w+>/<id:\d+>' => '<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
          ),
          ), */
        /*
          'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ),
         */
        // uncomment the following to use a MySQL database
        // uncomment the following to use a MySQL database
        'dbINCRA' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostINCRA;dbname=$dbnameINCRA",
            'emulatePrepare' => true,
            'username' => $usernameINCRA,
            'password' => $passwordINCRA,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbANCINE' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostANCINE;dbname=$dbnameANCINE",
            'emulatePrepare' => true,
            'username' => $usernameANCINE,
            'password' => $passwordANCINE,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbANATEL' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostANATEL;dbname=$dbnameANATEL",
            'emulatePrepare' => true,
            'username' => $usernameANATEL,
            'password' => $passwordANATEL,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbFRAPORT' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostFRAPORT;dbname=$dbnameFRAPORT",
            'emulatePrepare' => true,
            'username' => $usernameFRAPORT,
            'password' => $passwordFRAPORT,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbFUNARTE' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostFUNARTE;dbname=$dbnameFUNARTE",
            'emulatePrepare' => true,
            'username' => $usernameFUNARTE,
            'password' => $passwordFUNARTE,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbCVM' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostCVM;dbname=$dbnameCVM",
            'emulatePrepare' => true,
            'username' => $usernameCVM,
            'password' => $passwordCVM,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbIPHAN' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostIPHAN;dbname=$dbnameIPHAN",
            'emulatePrepare' => true,
            'username' => $usernameIPHAN,
            'password' => $passwordIPHAN,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        // uncomment the following to use a MySQL database
        'dbTERRACAP' => array(
            'class' => 'CDbConnection', // DO NOT FORGET THIS!
            'connectionString' => "mysql:host=$hostTERRACAP;dbname=$dbnameTERRACAP",
            'emulatePrepare' => true,
            'username' => $usernameTERRACAP,
            'password' => $passwordTERRACAP,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    //'levels' => 'info',
                    //'levels' => 'trace info profile warning error',
                    //'categories' => 'system.db.*',
                    //'logFile' => 'sql.log',
                    //'categories' => 'system.*,application.*',
                    'levels' => 'trace info profile warning error',
                    'categories' => 'system.*',
                ),
                // uncomment the following to show log messages on web pages
                //array(
                //    'class' => 'CWebLogRoute',
                //),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'franklin@fksapiens.com.br',
        'slogan' => 'FKSapiens Sistemas',
        // short: dd/MM/yy; medium: dd/MM/yyyy;
        'dtFormat' => 'medium',
        'dtTimeFormat' => 'dd/MM/yyyy hh:mm:ss',
        'pageSize' => 10, // registros por pagina. Paginação.
        // autenticacao LDAP
        //'ldap_server' => '192.168.255.203', // 192.168.255.203 (AD-ios)
        'ldap_server' => '127.0.1.1',
        'ldap_domain' => '@fksapiens.com.br',
    ),
);
