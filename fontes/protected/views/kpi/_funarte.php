<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiFunarte */

$qtdChamINS0203 = $model->rptKPI0203();
$qtdChamINS0203P2 = $model->rptKPI0203P2();
$qtdChamINS0203P3 = $model->rptKPI0203P3();
$qtdChamINS0203P1 = $model->rptKPI0203P1();
$qtdChamINS0405 = $model->rptKPI0405();
$qtdChamINS0405P2 = $model->rptKPI0405P2();
$qtdChamINS0405P3 = $model->rptKPI0405P3();
$qtdChamINS0405P1 = $model->rptKPI0405P1();
$qtdChamINS06 = $model->rptKPI06();
$qtdChamINS06P2 = $model->rptKPI06P2();
$qtdChamINS06P3 = $model->rptKPI06P3();
$qtdChamINS06P1 = $model->rptKPI06P1();
$qtdChamINS12 = $model->rptKPI12();
$qtdChamINS12P2 = $model->rptKPI12P2();
$qtdChamINS12P3 = $model->rptKPI12P3();
$qtdChamINS12P1 = $model->rptKPI12P1();
$qtdChamINS13 = $model->rptKPI13();
$qtdChamINS13P2 = $model->rptKPI13P2();
$qtdChamINS13P3 = $model->rptKPI13P3();
$qtdChamINS13P1 = $model->rptKPI13P1();
$qtdChamINS15 = $model->rptKPI15();
$qtdChamINS15P2 = $model->rptKPI15P2();
$qtdChamINS15P3 = $model->rptKPI15P3();
$qtdChamINS15P1 = $model->rptKPI15P1();
$qtdChamINS16 = $model->rptKPI16();
$qtdChamINS16P2 = $model->rptKPI16P2();
$qtdChamINS16P3 = $model->rptKPI16P3();
$qtdChamINS16P1 = $model->rptKPI16P1();
$qtdChamINS23 = $model->rptKPI23();
$qtdChamINS23P2 = $model->rptKPI23P2();
$qtdChamINS23P3 = $model->rptKPI23P3();
$qtdChamINS23P1 = $model->rptKPI23P1();
$qtdChamINS26 = $model->rptKPI26();
$qtdChamINS26P2 = $model->rptKPI26P2();
$qtdChamINS26P3 = $model->rptKPI26P3();
$qtdChamINS26P1 = $model->rptKPI26P1();
$qtdChamINS27 = $model->rptKPI27();
$qtdChamINS27P2 = $model->rptKPI27P2();
$qtdChamINS27P3 = $model->rptKPI27P3();
$qtdChamINS27P1 = $model->rptKPI27P1();

?>

<section class="panel">
    <header class="panel-heading">
        <span>INS 02-03</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="timer"></span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0203[0]) ? round(($qtdChamINS0203[0] * 100) / $qtdChamINS0203[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc < 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Vip (Sla 1 Hora) com Início de Atendimento <= 5 Minutos">
                            <?php echo $qtdChamINS0203[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets com Início de Atendimento <= 5 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla 1 Hora - Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0203P2[0]) ? round(($qtdChamINS0203P2[0] * 100) / $qtdChamINS0203P2[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc < 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 2 (Sla 2 e 3 Horas) com Início de Atendimento <= 10 Minutos">
                            <?php echo $qtdChamINS0203P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 90% Tickets com Início de Atendimento <= 10 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0203P3[0]) ? round(($qtdChamINS0203P3[0] * 100) / $qtdChamINS0203P3[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc < 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 3 (Sla 4 e 6 Horas) com Início de Atendimento <= 15 Minutos">
                            <?php echo $qtdChamINS0203P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 90% Tickets com Início de Atendimento <= 15 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0203P1[0]) ? round(($qtdChamINS0203P1[0] * 100) / $qtdChamINS0203P1[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc < 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 1 (Sla 1 Hora) com Início de Atendimento <= 5 Minutos">
                            <?php echo $qtdChamINS0203P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets com Início de Atendimento <= 5 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 04-05 - Requisição de Serviço e Informações/Dúvidas</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0405[0]) ? round(($qtdChamINS0405[0] * 100) / $qtdChamINS0405[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 6)
                        $cor = 'red';
                    else if (($kpiPerc >= 5) && ($kpiPerc <= 6))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Vip (Sla 1 Hora) Solucionados acima de 1 Hora">
                            <?php echo $qtdChamINS0405[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 5% Tickets Solucionados acima do SLA 1 Hora Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla 1 Hora - Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0405P2[0]) ? round(($qtdChamINS0405P2[0] * 100) / $qtdChamINS0405P2[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 10)
                        $cor = 'red';
                    else if (($kpiPerc >= 9) && ($kpiPerc <= 10))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 2 (Sla 2 e 3 Horas) Solucionados acima de 2 e 3 Horas">
                            <?php echo $qtdChamINS0405P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 10% Tickets Solucionados acima do SLA 2 e 3 Horas">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0405P3[0]) ? round(($qtdChamINS0405P3[0] * 100) / $qtdChamINS0405P3[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 10)
                        $cor = 'red';
                    else if (($kpiPerc >= 9) && ($kpiPerc <= 10))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 3 (Sla 4 e 6 Horas) Solucionados acima de 4 e 6 Horas">
                            <?php echo $qtdChamINS0405P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 10% Tickets Solucionados acima do SLA 4 e 6 Horas">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0405P1[0]) ? round(($qtdChamINS0405P1[0] * 100) / $qtdChamINS0405P1[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 6)
                        $cor = 'red';
                    else if (($kpiPerc >= 5) && ($kpiPerc <= 6))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 1 (Sla 1 Hora) Solucionados acima de 1 Hora">
                            <?php echo $qtdChamINS0405P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 5% Tickets Solucionados acima do SLA 1 Hora Prioridade 1">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 06 - Incidentes</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS06[0]) ? round(($qtdChamINS06[0] * 100) / $qtdChamINS06[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 6)
                        $cor = 'red';
                    else if (($kpiPerc >= 5) && ($kpiPerc <= 6))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Vip (Sla 1 Hora) Solucionados acima de 1 Hora">
                            <?php echo $qtdChamINS06[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 5% Tickets Incidentes Solucionados acima do SLA 1 Hora Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Sla Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS06P2[0]) ? round(($qtdChamINS06P2[0] * 100) / $qtdChamINS06P2[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 10)
                        $cor = 'red';
                    else if (($kpiPerc >= 9) && ($kpiPerc <= 10))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Prioridade 2 (Sla 2 Horas) Solucionados acima de 2 Horas">
                            <?php echo $qtdChamINS06P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 10% Tickets Incidentes Solucionados acima do SLA 2 Horas">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Sla Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS06P3[0]) ? round(($qtdChamINS06P3[0] * 100) / $qtdChamINS06P3[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 10)
                        $cor = 'red';
                    else if (($kpiPerc >= 9) && ($kpiPerc <= 10))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Prioridade 3 (Sla 4 Horas) Solucionados acima de 4 Horas">
                            <?php echo $qtdChamINS06P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 10% Tickets Incidentes Solucionados acima do SLA 4 Horas">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Sla Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS06P1[0]) ? round(($qtdChamINS06P1[0] * 100) / $qtdChamINS06P1[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 6)
                        $cor = 'red';
                    else if (($kpiPerc >= 5) && ($kpiPerc <= 6))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Prioridade 1 (Sla 1 Hora) Solucionados acima de 1 Hora">
                            <?php echo $qtdChamINS06P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: <= 5% Tickets Incidentes Solucionados acima do SLA 1 Hora Prioridade 1">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Sla Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 12 - Requisição Backlog</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS12[0]) ? round(100-((100*$qtdChamINS12[0])/$qtdChamINS12[1]),2) : 100);
                    $cor = 'terques';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Requisição Backlog Vip">
                            <?php echo $qtdChamINS12[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Requisição Solucionados Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets RQ Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS12P2[0]) ? round(100-((100*$qtdChamINS12P2[0])/$qtdChamINS12P2[1]),2) : 100);
                    $cor = 'terques';
                    if ($kpiPerc < 95)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Requisição Backlog Prioridade 2 (Sla 3 Horas)">
                            <?php echo $qtdChamINS12P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Requisição Solucionados Prioridade 2 (Sla 3 Horas)">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets RQ Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS12P3[0]) ? round(100-((100*$qtdChamINS12P3[0])/$qtdChamINS12P3[1]),2) : 100);
                    $cor = 'terques';
                    if ($kpiPerc < 95)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Requisição Backlog Prioridade 3 (Sla 6 Horas)">
                            <?php echo $qtdChamINS12P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Requisição Solucionados Prioridade 3 (Sla 6 Horas)">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets RQ Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS12P1[0]) ? round(100-((100*$qtdChamINS12P1[0])/$qtdChamINS12P1[1]),2) : 100);
                    $cor = 'terques';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Requisição Backlog Prioridade 1 (Sla 1 Hora)">
                            <?php echo $qtdChamINS12P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Requisição Solucionados Prioridade 1 (Sla 1 Hora)">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets RQ Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 13 - Incidentes Backlog</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS13[0]) ? round(100-((100*$qtdChamINS13[0])/$qtdChamINS13[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Backlog Vip">
                            <?php echo $qtdChamINS13[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Incidentes Solucionados Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS13P2[0]) ? round(100-((100*$qtdChamINS13P2[0])/$qtdChamINS13P2[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 95)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Backlog Prioridade 2 (Sla 2 Horas)">
                            <?php echo $qtdChamINS13P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Incidentes Solucionados Prioridade 2 (Sla 2 Horas)">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS13P3[0]) ? round(100-((100*$qtdChamINS13P3[0])/$qtdChamINS13P3[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 95)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Backlog Prioridade 3 (Sla 4 Horas)">
                            <?php echo $qtdChamINS13P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Incidentes Solucionados Prioridade 3 (Sla 4 Horas)">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS13P1[0]) ? round(100-((100*$qtdChamINS13P1[0])/$qtdChamINS13P1[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Incidentes Backlog Prioridade 1 (Sla 1 Hora)">
                            <?php echo $qtdChamINS13P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Incidentes Solucionados Prioridade 1 (Sla 1 Hora)">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 15 - Resolvidos para Atendidos</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS15[0]) ? round(($qtdChamINS15[0] * 100) / $qtdChamINS15[1], 2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets de Resolvidos para Atendidos Vip">
                            <?php echo $qtdChamINS15[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Solucionados Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS15P2[0]) ? round(($qtdChamINS15P2[0] * 100) / $qtdChamINS15P2[1], 2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets de Resolvidos para Atendidos Prioridade 2">
                            <?php echo $qtdChamINS15P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Solucionados Prioridade 2">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS15P3[0]) ? round(($qtdChamINS15P3[0] * 100) / $qtdChamINS15P3[1], 2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets de Resolvidos para Atendidos Prioridade 3">
                            <?php echo $qtdChamINS15P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Solucionados Prioridade 3">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS15P1[0]) ? round(($qtdChamINS15P1[0] * 100) / $qtdChamINS15P1[1], 2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets de Resolvidos para Atendidos Prioridade 1">
                            <?php echo $qtdChamINS15P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Solucionados Prioridade 1">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 16 - Notas Após Resolução</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS16[0]) ? round(100-((100*$qtdChamINS16[0])/$qtdChamINS16[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Notas Após Resolução Vip">
                            <?php echo $qtdChamINS16[1]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS16P2[0]) ? round(100-((100*$qtdChamINS16P2[0])/$qtdChamINS16P2[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Notas Após Resolução Prioridade 2">
                            <?php echo $qtdChamINS16P2[1]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Prioridade 2">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS16P3[0]) ? round(100-((100*$qtdChamINS16P3[0])/$qtdChamINS16P3[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Notas Após Resolução Prioridade 3">
                            <?php echo $qtdChamINS16P3[1]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Prioridade 3">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS16P1[0]) ? round(100-((100*$qtdChamINS16P1[0])/$qtdChamINS16P1[1]),2) : 100);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Notas Após Resolução Prioridade 1">
                            <?php echo $qtdChamINS16P1[1]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Prioridade 1">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 23 - Incidentes</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS23[0]) ? round((100*$qtdChamINS23[0])/$qtdChamINS23[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Vip Resolvidos com E-mail Enviado Dinfo">
                            <?php echo $qtdChamINS23[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS23P2[0]) ? round((100*$qtdChamINS23P2[0])/$qtdChamINS23P2[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 2 Resolvidos com E-mail Enviado Dinfo">
                            <?php echo $qtdChamINS23P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Prioridade 2">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS23P3[0]) ? round((100*$qtdChamINS23P3[0])/$qtdChamINS23P3[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 3 Resolvidos com E-mail Enviado Dinfo">
                            <?php echo $qtdChamINS23P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Prioridade 3">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS23P1[0]) ? round((100*$qtdChamINS23P1[0])/$qtdChamINS23P1[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 98)
                        $cor = 'red';
                    else if (($kpiPerc >= 98) && ($kpiPerc <= 99))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 1 Resolvidos com E-mail Enviado Dinfo">
                            <?php echo $qtdChamINS23P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 100% Tickets Resolvidos Prioridade 1">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 26 - Problemas</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS26[0]) ? round((100*$qtdChamINS26[0])/$qtdChamINS26[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Vip Resolvidos com 1º Tratamento em até 5 Minutos">
                            <?php echo $qtdChamINS26[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Resolvidos Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS26P2[0]) ? round((100*$qtdChamINS26P2[0])/$qtdChamINS26P2[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 2 Resolvidos com 1º Tratamento em até 5 Minutos">
                            <?php echo $qtdChamINS26P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Resolvidos Prioridade 2">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS26P3[0]) ? round((100*$qtdChamINS26P3[0])/$qtdChamINS26P3[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Prioridade 3 Resolvidos com 1º Tratamento em até 5 Minutos">
                            <?php echo $qtdChamINS26P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Resolvidos Prioridade 3">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS26P1[0]) ? round((100*$qtdChamINS26P1[0])/$qtdChamINS26P1[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <?php
                            $ta = "Meta: >= 95% Tickets Resolvidos Prioridade 1";
                            $tb = "Nenhum Ticket nesse período...";
                        ?>
                        <h1 class="count1" title="Total de Tickets Prioridade 1 Resolvidos com 1º Tratamento em até 5 Minutos">
                            <?php echo $qtdChamINS26P1[0]; ?>
                        </h1>
                        <h1 class="" title="<?php echo $qtdChamINS26P1[1] != '0' || $qtdChamINS26P1[1] != null ? $ta : $tb; ?>">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 27 - RDM</span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS27[0]) ? round((100*$qtdChamINS27[0])/$qtdChamINS27[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets RDM Solucionados dentro SLA Vip">
                            <?php echo $qtdChamINS27[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Resolvidos Vip">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Vip</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS27P2[0]) ? round((100*$qtdChamINS27P2[0])/$qtdChamINS27P2[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets RDM Solucionados dentro SLA 3 Horas">
                            <?php echo $qtdChamINS27P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Resolvidos Prioridade 2">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS27P3[0]) ? round((100*$qtdChamINS27P3[0])/$qtdChamINS27P3[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets RDM Solucionados dentro SLA 6 Horas">
                            <?php echo $qtdChamINS27P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Resolvidos Prioridade 3">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS27P1[0]) ? round((100*$qtdChamINS27P1[0])/$qtdChamINS27P1[1],2) : 0);
                    $cor = 'teINues';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 95) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <?php
                        $ta = "Meta: >= 95% Tickets Resolvidos Prioridade 1";
                        $tb = "Nenhum Ticket nesse período...";
                        ?>
                        <h1 class="count1" title="Total de Tickets RDM Solucionados dentro SLA 1 Hora">
                            <?php echo $qtdChamINS27P1[0]; ?>
                        </h1>
                        <h1 class="" title="<?php echo $qtdChamINS27P1[1] != '0' || $qtdChamINS27P1[1] != null ? $ta : $tb; ?>">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Prioridade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<style>
    .div-result {

    }
    .border {
        border: 1px solid black;
    }
</style>

<script>
    var tempo = new Number();
    // Tempo em segundos
    tempo = 180; //3 minutos.

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
            //$("#timer").html(horaImprimivel);
            var timer = document.getElementById("timer");
            timer.innerHTML = horaImprimivel;

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