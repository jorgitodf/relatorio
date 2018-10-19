<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiCvm */
?>
<section class="panel">
    <header class="panel-heading">
        7.1 Ilha Suporte Soluções Comeciais&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="timer71"></span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de chamados desta Ilha">
                            <?php
                            $model->idQueue = array(1);
                            $kpiWidget10 = $model->kpiWidget10();
                            $allTicketsClosed = $model->allTicketsClosed();
                            echo $kpiWidget10;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado sobre a quantidade total de chamados encerrados no período.">
                            <?php
                            echo $allTicketsClosed != 0 ? (round($kpiWidget10 / $allTicketsClosed, 2) * 100) : 0;
                            ?>%
                        </h1>
                        <p>Geral</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(1);
                    $model->timeInSeconds = 900;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 91)
                        $cor = 'blue';
                    else if (($kpiPerc >= 90) && ($kpiPerc < 91))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.1.2">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 15 min.">
                            <?php
                            echo $tempoNaFila;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 90%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>15 minutos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(1);
                    $model->timeInSeconds = 7200;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 96)
                        $cor = 'blue';
                    else if (($kpiPerc >= 95) && ($kpiPerc < 96))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.1.3">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 2 horas.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 95%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>2 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(1);
                    $model->timeInSeconds = 43200;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 99.5)
                        $cor = 'blue';
                    else if (($kpiPerc >= 99) && ($kpiPerc < 99.5))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.1.4">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 12 horas.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 99%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>12 horas</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(1);
                    $model->timeInSeconds = 144000;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 100)
                        $cor = 'blue';
                    else if (($kpiPerc >= 99) && ($kpiPerc < 100))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.1.5">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 5 dias.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 100%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>5 dias</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(1);
                    $kpiTime = KpiController::intToTime($model->tempoTratamento());
                    $cor = 'terques';
                    if ($kpiTime <= "00:15:00")
                        $cor = 'blue';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.1.6">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Tempo médio de tratamento deve ser <= 15min.">
                            <?php
                            echo $kpiTime;
                            ?>
                        </h1>
                        <p>Tratamento</p>
                    </div>
                </section>
            </div>
        <!--state overview end-->
        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        7.2 Ilha Suporte Soluções Corporativas
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de chamados desta Ilha">
                            <?php
                            $model->idQueue = array(18);
                            $kpiWidget10 = $model->kpiWidget10();
                            echo $kpiWidget10;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado sobre a quantidade total de chamados encerrados no período.">
                            <?php
                            echo $allTicketsClosed != 0 ? (round($kpiWidget10 / $allTicketsClosed, 2) * 100) : 0;
                            ?>%
                        </h1>
                        <p>Geral</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(18);
                    $model->timeInSeconds = 900;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 86)
                        $cor = 'blue';
                    else if (($kpiPerc >= 85) && ($kpiPerc < 86))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.2.2">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 15 min.">
                            <?php
                            echo $tempoNaFila;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 90%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>15 minutos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(18);
                    $model->timeInSeconds = 7200;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 96)
                        $cor = 'blue';
                    else if (($kpiPerc >= 95) && ($kpiPerc < 96))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.2.3">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 2 horas.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 95%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>2 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(18);
                    $model->timeInSeconds = 43200;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 99.5)
                        $cor = 'blue';
                    else if (($kpiPerc > 99) && ($kpiPerc < 99.5))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.2.4">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 12 horas.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 99%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>12 horas</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(18);
                    $model->timeInSeconds = 144000;
                    $tempoNaFila = $model->tempoNaFila();
                    //$kpiWidget11 = $model->kpiWidget11();
                    $kpiPerc = $kpiWidget10 != 0 ? (round($tempoNaFila / $kpiWidget10, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 100)
                        $cor = 'blue';
                    else if (($kpiPerc >= 99) && ($kpiPerc < 100))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.1.5">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 5 dias.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 100%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>5 dias</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(18);
                    $kpiTime = KpiController::intToTime($model->tempoTratamento());
                    $cor = 'terques';
                    if ($kpiTime <= "00:15:00")
                        $cor = 'blue';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.2.6">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Tempo médio de tratamento deve ser <= 15min.">
                            <?php
                            echo $kpiTime;
                            ?>
                        </h1>
                        <p>Tratamento</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        7.3 Ilha Suporte Local (RJ,SP,DF)
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de chamados desta Ilha">
                            <?php
                            $model->idQueue = array(2,3,4);
                            $kpiWidget1073 = $model->kpiWidget10();
                            $allTicketsClosed73 = $model->allTicketsClosed();
                            echo $kpiWidget1073;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado sobre a quantidade total de chamados encerrados no período.">
                            <?php
                            echo  $allTicketsClosed73 != 0 ? (round($kpiWidget1073 /  $allTicketsClosed73, 2) * 100) : 0;
                            ?>%
                        </h1>
                        <p>Geral</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(2,3,4);
                    $model->timeInSeconds = 21600;
                    $tempoNaFila = $model->tempoNaFila();
                    $kpiPerc = $kpiWidget1073 != 0 ? (round($tempoNaFila / $kpiWidget1073, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 96)
                        $cor = 'blue';
                    else if (($kpiPerc >= 95) && ($kpiPerc < 96))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.3.2">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 6 horas.">
                            <?php
                            echo $tempoNaFila;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 95%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>15 minutos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(2,3,4);
                    $model->timeInSeconds = 43200;
                    $tempoNaFila = $model->tempoNaFila();
                    $kpiPerc = $kpiWidget1073 != 0 ? (round($tempoNaFila / $kpiWidget1073, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 98)
                        $cor = 'blue';
                    else if (($kpiPerc >= 97) && ($kpiPerc < 98))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.3.3">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 12 horas.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 97%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>12 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(2,3,4);
                    $model->timeInSeconds = 86400;
                    $tempoNaFila = $model->tempoNaFila();
                    $kpiPerc = $kpiWidget1073 != 0 ? (round($tempoNaFila / $kpiWidget1073, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 99.5)
                        $cor = 'blue';
                    else if (($kpiPerc > 99) && ($kpiPerc < 99.5))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.3.4">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 24 horas.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 99%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>24 horas</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(2,3,4);
                    $model->timeInSeconds = 144000;
                    $tempoNaFila = $model->tempoNaFila();
                    $kpiPerc = $kpiWidget1073 != 0 ? (round($tempoNaFila / $kpiWidget1073, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 100)
                        $cor = 'blue';
                    else if (($kpiPerc >= 99) && ($kpiPerc < 100))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.3.5">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 5 dias.">
                            <?php echo $tempoNaFila; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 100%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>5 dias</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        7.4 Ilha Administração de Redes Locais
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de chamados desta Ilha">
                            <?php
                            $model->idQueue = array(5,14,15,16);
                            $model->servicesIds = array(191, 227, 234, 235,
                                237, 236, 228, 231, 233, 230, 229, 232, 197, 210,
                                211, 213, 212, 206, 207, 209, 208, 202, 203, 205,
                                204, 214, 215, 216, 217, 218, 219, 221, 220, 198,
                                199, 201, 200, 238, 239, 240, 192, 194, 195, 193,
                                196, 222, 224, 223, 226, 225);
                            $resolucaoServicos =  $model->kpiResolucaoServicos();
                            $kpiWidget1074 = $model->kpiWidget10();
                            $allTicketsClosed74 = $model->allTicketsClosed();
                            echo $kpiWidget1074;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado sobre a quantidade total de chamados encerrados no período.">
                            <?php
                            echo $allTicketsClosed74 != 0 ? (round($resolucaoServicos / $allTicketsClosed74, 2) * 100) : 0;
                            ?>%
                        </h1>
                        <p>Geral</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(5,14,15,16);
                    $model->timeInSeconds = 21600;
                    $tempoNaFilaResolucaoServicos = $model->kpiTempoNaFilaResolucaoServicos();
                    $kpiPerc = $kpiWidget1074 != 0 ? (round($tempoNaFilaResolucaoServicos / $kpiWidget1074, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 91)
                        $cor = 'blue';
                    else if (($kpiPerc >= 90) && ($kpiPerc < 91))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.4.2">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 6 horas.">
                            <?php
                            echo $tempoNaFilaResolucaoServicos;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 90%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>6 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(5,14,15,16);
                    $model->timeInSeconds = 43200;
                    $tempoNaFilaResolucaoServicos = $model->kpiTempoNaFilaResolucaoServicos();
                    $kpiPerc = $kpiWidget1074 != 0 ? (round($tempoNaFilaResolucaoServicos / $kpiWidget1074, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 98)
                        $cor = 'blue';
                    else if (($kpiPerc >= 97) && ($kpiPerc < 98))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.4.3">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 12 horas.">
                            <?php echo $tempoNaFilaResolucaoServicos; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 97%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>12 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(5,14,15,16);
                    $model->timeInSeconds = 86400;
                    $tempoNaFilaResolucaoServicos = $model->kpiTempoNaFilaResolucaoServicos();
                    $kpiPerc = $kpiWidget1074 != 0 ? (round($tempoNaFilaResolucaoServicos / $kpiWidget1074, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 99.5)
                        $cor = 'blue';
                    else if (($kpiPerc > 99) && ($kpiPerc < 99.5))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.4.4">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 24 horas.">
                            <?php echo $tempoNaFilaResolucaoServicos; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 99%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>24 horas</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(5,14,15,16);
                    $model->timeInSeconds = 144000;
                    $tempoNaFilaResolucaoServicos = $model->kpiTempoNaFilaResolucaoServicos();
                    $kpiPerc = $kpiWidget1074 != 0 ? (round($tempoNaFilaResolucaoServicos / $kpiWidget1074, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 100)
                        $cor = 'blue';
                    else if (($kpiPerc >= 99) && ($kpiPerc < 100))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.4.5">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados em 5 dias.">
                            <?php echo $tempoNaFilaResolucaoServicos; ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 100%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>5 dias</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        7.5 Ilha Monitoramento & Gestão Telessuporte
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de chamados desta Ilha">
                            <?php
                            $model->idQueue = array(1,18);
                            $kpi = $model->kpiWidget14();
                            $allTicketsClosed75 = $model->allTicketsClosed();
                            echo $kpi[0];
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado sobre a quantidade total de chamados encerrados no período.">
                            <?php
                            echo $allTicketsClosed75 != 0 ? (round($kpi[0] / $allTicketsClosed75, 2) * 100) : 0;
                            ?>%
                        </h1>
                        <p>Geral</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(1);
                    $kpi = $model->kpiWidget14();
                    $kpiPerc = $kpi[0] != 0 ? (round($kpi[1] / $kpi[0], 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 71)
                        $cor = 'blue';
                    else if (($kpiPerc >= 70) && ($kpiPerc < 70))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.5.2">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados 1º contato.">
                            <?php
                            echo $kpi[1];
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 70%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>ISSCom</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(18);
                    $kpi = $model->kpiWidget14();
                    $kpiPerc = $kpi[0] != 0 ? (round($kpi[1] / $kpi[0], 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 51)
                        $cor = 'blue';
                    else if (($kpiPerc >= 50) && ($kpiPerc < 50))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.5.3">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados 1º contato.">
                            <?php
                            echo $kpi[1];
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 50%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>ISSCorp</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->kpiWidget20();
                    $allTicketsClosed75 = $model->allTicketsClosed();
                    $kpiPerc = $allTicketsClosed75 != 0 ? (round($model->kpiWidget20 / $allTicketsClosed75, 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc <= 2)
                        $cor = 'blue';
                    else if (($kpiPerc >= 1.5) && ($kpiPerc < 2))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.5.4">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados encerrados inconsistentes.">
                            <?php
                            echo $model->kpiWidget20;
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 2%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Inconsistências</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $rs = $model->kpiWidget16();
                    $qtd = $rs[0]['q1'] + $rs[0]['q2'] + $rs[0]['q3'] + $rs[0]['q4'];
                    $kpiPerc = (round($qtd / 4, 2) * 100);
                    $cor = 'terques';
                    if ($kpi >= 71 || $kpi == 0)
                        $cor = 'blue';
                    else if (($kpiPerc >= 70) && ($kpiPerc < 70))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.5.5">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Pesquisa respondidas com Ótimo ou Bom.">
                            <?php
                            echo $rs[0]['q1'] + $rs[0]['q2'] + $rs[0]['q3'] + $rs[0]['q4'];
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 70%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Satisfação</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $rs = $model->kpiWidget17();
                    $qtd = $rs[0]['q1'] + $rs[0]['q2'] + $rs[0]['q3'] + $rs[0]['q4'];
                    $kpiPerc = (round($qtd / 4, 2) * 100);
                    $cor = 'terques';
                    if ($kpi <= 10)
                        $cor = 'blue';
                    else if (($kpiPerc >= 11) && ($kpiPerc < 10))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.5.6">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Pesquisa respondidas com Ruim.">
                            <?php
                            echo $rs[0]['q1'] + $rs[0]['q2'] + $rs[0]['q3'] + $rs[0]['q4'];
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 10%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Insatisfação</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        7.6 Ilha Monitoramento & Gestão Suporte Local e Redes Locais
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(2,3,4);
                    $model->servicesIds = array(191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201,
                        202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217,
                        218, 219, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233,
                        234, 235, 236, 237, 238, 239, 240); //ADM Rede
                    $kpi = $model->kpiWidget22();
                    $kpiPerc = $kpi[0] != 0 ? (round($kpi[1] / $kpi[0], 2) * 100) : 0;
                    $cor = 'terques';
                    if ($kpiPerc >= 81)
                        $cor = 'blue';
                    else if (($kpiPerc >= 80) && ($kpiPerc < 81))
                        $cor = 'yellow';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.6.1">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de chamados.">
                            <?php
                            echo $kpi[1];
                            ?>
                        </h1>
                        <h1 class="" title="Percentual apurado acima da meta de 80%.">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Assertividade</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->idQueue = array(2,3,4);
                    $model->servicesIds = array(191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201,
                        202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217,
                        218, 219, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233,
                        234, 235, 236, 237, 238, 239, 240);
                    $model->kpiWidget23();
                    $kpi = round($model->kpiWidget23);
                    $kpiTime = KpiController::intToTime($kpi);
                    $cor = 'terques';
                    if ($kpiTime <= "02:00:00")
                        $cor = 'blue';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.6.2">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Tempo médio de suspenção deve ser <= 180min.">
                            <?php
                            echo $kpiTime;
                            ?>
                        </h1>
                        <p>Pendências</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $model->kpiWidget24();
                    $kpi = round(($model->kpiWidget24 <= 0 ? 0 : ($model->kpiWidget25 / $model->kpiWidget24)));
                    $kpiTime = KpiController::intToTime($kpi);
                    $cor = 'terques';
                    if ($kpiTime <= "01:00:00")
                        $cor = 'blue';
                    else
                        $cor = 'red';
                    ?>
                    <div class="symbol <?php echo $cor; ?>" title="Ilha 7.6.3">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Tempo médio de Escalação deve ser <= 60min.">
                            <?php
                            echo $kpiTime;
                            ?>
                        </h1>
                        <p>Escalação</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
        <!--state overview start-->
    </div>
</section>
<script>
    var tempo = new Number();
    // Tempo em segundos
    tempo = 300; //5min.

    function startCountdown() {

        // Se o tempo não for zerado
        if ((tempo - 1) >= 0) {

            // Pega a parte inteira dos minutos
            var min = parseInt(tempo / 60);
            // Calcula os segundos restantes
            var seg = tempo % 60;

            // Formata o número menor que dez, ex: 08, 07, ...
            if (min < 10) {
                min = "0" + min;
                min = min.substr(0, 2);
            }
            if (seg <= 9) {
                seg = "0" + seg;
            }

            // Cria a variável para formatar no estilo hora/cronômetro
            horaImprimivel = 'Atualização automática em 00:' + min + ':' + seg;
            //JQuery pra setar o valor
            //$("#timer71").html(horaImprimivel);
            var timer71 = document.getElementById("timer71");
            timer71.innerHTML = horaImprimivel;

            // Define que a função será executada novamente em 1000ms = 1 segundo
            setTimeout('startCountdown()', 1000);

            // diminui o tempo
            tempo--;

            // Quando o contador chegar a zero faz esta ação
        } else {
            document.getElementById("filtro-form").submit();
        }

    }
    // Chama a função ao carregar a tela
    startCountdown();

</script>

