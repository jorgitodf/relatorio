<?php
/* @var $this SiteController */

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
        <link rel="shortcut icon" href="<?php echo $this->baseUrl; ?>/img/favicon.png">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Bootstrap core CSS and external css -->
        <?php
        // Bootstrap v3.0.2 core CSS
        $cs->registerCssFile($this->baseUrl . '/css/bootstrap.min.css');
        $cs->registerCssFile($this->baseUrl . '/css/bootstrap-reset.css');
        // external css
        $cs->registerCssFile($this->baseUrl . '/css/font-awesome/css/font-awesome.css');
        // Custom styles for this template
        $cs->registerCssFile($this->baseUrl . '/css/style.css');
        $cs->registerCssFile($this->baseUrl . '/css/style-responsive.css');
        $cs->registerCssFile($this->baseUrl . '/css/tasks.css');
        $cs->registerCssFile($this->baseUrl . '/js/jquery-easy-pie-chart/jquery.easy-pie-chart.css');
        $cs->registerCssFile($this->baseUrl . '/css/owl.carousel.css');
        // Datetime Picker
        $cs->registerCssFile($this->baseUrl . '/js/bootstrap-datepicker/css/datepicker.css');
        $cs->registerCssFile($this->baseUrl . '/js/bootstrap-datetimepicker/css/datetimepicker.css');
        ?>

        <!--<link href="css/navbar-fixed-top.css" rel="stylesheet">-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="/js/html5shiv.js"></script>
          <script src="/js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="full-width">
        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="navbar-header">
                    <?php require_once('header-flatlab.php'); ?>
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--breadcrumbs start -->
                            <!-- ul class="breadcrumb">
                                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="#">Library</a></li>
                                <li class="active">Data</li>
                            </ul -->
                            <?php
                            $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                                'htmlOptions' => array('class' => 'breadcrumb'),
                            ));
                            ?>
                            <!--breadcrumbs end -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </section>
            </section>
            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <?php require_once('footer-flatlab.php'); ?>
            </footer>

        </section>
        <?php
        // js placed at the end of the document so the pages load faster
        //$cs->registerScriptFile($this->baseUrl . '/js/jquery.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/bootstrap.min.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/jquery.dcjqaccordion.2.7.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/hover-dropdown.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/jquery.scrollTo.min.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/jquery.nicescroll.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/respond.min.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/jquery.sparkline.js');
        //$cs->registerScriptFile($this->baseUrl . '/js/jquery-easy-pie-chart/jquery.easy-pie-chart.js');
        // common script for all pages
        //$cs->registerScriptFile($this->baseUrl . '/js/common-scripts.js');
        ?>

        <!-- js placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/bootstrap-dropdown.js"></script>
        <script class="include" type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/jquery.dcjqaccordion.2.7.js"></script>
        <script type="text/javascript" type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/hover-dropdown.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/jquery.nicescroll.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/respond.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/jquery.sparkline.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <!--common script for all pages-->
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/common-scripts.js"></script>
        <!--script for this page-->
        <script src="<?php echo $this->baseUrl; ?>/js/owl.carousel.js" ></script>
        <script src="<?php echo $this->baseUrl; ?>/js/jquery.customSelect.min.js" ></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/sparkline-chart.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/easy-pie-chart.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/js/count.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl; ?>/../../js/jquery.ba-bbq.js"></script>
        <!--script src="<?php echo $this->baseUrl; ?>/js/common-scripts.js"></script -->
        <script>
            //owl carousel
            $(document).ready(function () {
                $("#owl-demo").owlCarousel({
                    navigation: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true,
                    autoPlay: true
                });
            });

            //custom select box
            $(function () {
                $('select.styled').customSelect();
            });

        </script>


    </body>
</html>