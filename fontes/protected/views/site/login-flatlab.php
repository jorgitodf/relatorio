<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle .= '::Login';
$cs = Yii::app()->getClientScript();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo $this->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->baseUrl; ?>/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo $this->baseUrl; ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo $this->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo $this->baseUrl; ?>/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-body">
        <div class="container">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => false,
                'htmlOptions' => array('class' => 'form-signin'),
            ));
            ?>
            <h2 class="form-signin-heading">Entre com sua conta</h2>
            <div class="login-wrap">
                <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'login', 'autofocus' => null)); ?>
                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'senha')); ?>

                <div class="alert alert-block alert-danger fade in <?php echo (!$model->hasErrors() ? 'hide' : ''); ?>">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <?php echo $form->errorSummary($model); ?>
                </div>                    


                <label class="checkbox">
                    <?php echo $form->checkBox($model, 'rememberMe'); ?> Lembre-me
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal">Esqueceu a senha?</a>

                    </span>
                </label>
                <button class="btn btn-lg btn-login btn-block" type="submit">Acessar</button>
                <p>ou entre com</p>
                <div class="login-social-link">
                    <a href="index.php" class="facebook">
                        <i class="fa fa-facebook"></i>
                        Facebook
                    </a>
                    <a href="index.php" class="twitter">
                        <i class="fa fa-twitter"></i>
                        Twitter
                    </a>
                </div>
            </div>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Esqueceu a senha ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Digite seu email abaixo para redefinir sua senha.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                            <button class="btn btn-success" type="button">Reiniciar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
            <?php $this->endWidget(); ?>
        </div>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo $this->baseUrl; ?>/js/jquery.js"></script>
        <script src="<?php echo $this->baseUrl; ?>/js/bootstrap.min.js"></script>

    </body>
</html>
