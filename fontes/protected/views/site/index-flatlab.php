<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . '::Dashboard\'s';

$this->breadcrumbs = array(
    'Dashboard',
);
?>
<div class="row">
    <!--state overview start-->
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <?php $perfil = Yii::app()->user->id_perfil;
                    if ((in_array('4', $perfil)) || (in_array('0', $perfil))) {
                        $link = CHtml::normalizeUrl(array('report/ancine_rel'));
                    }
                    ?>
                    <a href="<?php echo $link; ?>">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/ancine.png">
                    </a>
                    <h1>ANCINE</h1>
                    <p>centralservico-ancine@ios.com.br</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>

            </section>
        </aside>
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <a href="#">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/cvm2.png">
                    </a>
                    <h1>CVM</h1>
                    <p>centralservico-cvm@ios.com.br</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>

            </section>
        </aside>  
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <?php $perfil = Yii::app()->user->id_perfil;
                        if ((in_array('2', $perfil)) || (in_array('0', $perfil))) {
                            $link = CHtml::normalizeUrl(array('report/iphan_rel'));
                        }
                    ?>
                    <a href="<?php echo $link; ?>">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/iphan.jpg">
                    </a>
                    <h1>IPHAN</h1>
                    <p>centralservico-iphan@ios.com.br</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>

            </section>
        </aside>  
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <a href="">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/terracap_3.jpg">
                    </a>
                    <h1>TERRACAP</h1>
                    <p>centralservico-terracap@ios.com.br</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>

            </section>
        </aside>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <?php $perfil = Yii::app()->user->id_perfil;
                    if ((in_array('4', $perfil)) || (in_array('0', $perfil))) {
                        $link = CHtml::normalizeUrl(array('report/anatel_rel'));
                    }
                    ?>
                    <a href="<?php echo $link; ?>">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/anatel.png">
                    </a>
                    <h1>ANATEL</h1>
                    <p>centralservico-anatel@ios.com.br</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>
            </section>
        </aside>
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <?php $perfil = Yii::app()->user->id_perfil;
                    if ((in_array('6', $perfil)) || (in_array('0', $perfil))) {
                        $link = CHtml::normalizeUrl(array('report/fraport_rel'));
                    }
                    ?>
                    <a href="<?php echo $link; ?>">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/fraport.png">
                    </a>
                    <h1>FRAPORT</h1>
                    <p>centralservico-fraport@ios.com.br</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>
            </section>
        </aside>
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <a href="#">
                        <img alt="" src="<?php echo $this->baseUrl; ?>/img/ios.png">
                    </a>
                    <h1>IOS</h1>
                    <p>central-servico@ios.com.br</p>
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                    <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                </ul>
            </section>
        </aside>
    </div>
</div>