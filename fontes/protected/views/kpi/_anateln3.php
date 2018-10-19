<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiAnatel */

$kpi03_1 = $model->kpi03_1();
$kpi03_2 = $model->kpi03_2();
$kpi03_3 = $model->kpi03_3();
$kpi03_4 = $model->kpi03_4();
$kpi03_5 = $model->kpi03_5();
$kpi03_6 = $model->kpi03_6();
$kpi03_7 = $model->kpi03_7();
$kpi03_8 = $model->kpi03_8();
$kpi03_9 = $model->kpi03_9();
$kpi03_10 = $model->kpi03_10();
$kpi03_11 = $model->kpi03_11();
$kpiStiPAD_1 = $model->kpiStiPAD_1();
$kpiStiPAD_2 = $model->kpiStiPAD_2();
$kpiStiPAD_3 = $model->kpiStiPAD_3();
$kpiStiPAD_4 = $model->kpiStiPAD_4();
$kpiStiPAD_5 = $model->kpiStiPAD_5();
$kpiStiPAD_6 = $model->kpiStiPAD_6();
$kpiStiPAD_7 = $model->kpiStiPAD_7();
$kpiStiSSOp_1 = $model->kpiStiSSOp_1();
$kpiStiSSOp_2 = $model->kpiStiSSOp_2();
$kpiStiSSOp_3 = $model->kpiStiSSOp_3();
$kpiStiSSOp_4 = $model->kpiStiSSOp_4();
$kpiStiVirt_1 = $model->kpiStiVirt_1();
$kpiStiVirt_2 = $model->kpiStiVirt_2();
$kpiStiVirt_3 = $model->kpiStiVirt_3();
$kpiStiVirt_4 = $model->kpiStiVirt_4();
$kpiStiAplWeb_1 = $model->kpiStiAplWeb_1();
$kpiStiAplWeb_2 = $model->kpiStiAplWeb_2();
$kpiStiAplWeb_3 = $model->kpiStiAplWeb_3();
$kpiStiAplWeb_4 = $model->kpiStiAplWeb_4();
?>

<section class="panel">
    <header class="panel-heading">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-md-6 offset-md-3">
                <span id="timer"></span>
            </div>
        </div>
        <div>Atendimento 3º Nível - Produção: Aplicações Web - Atendimento Remoto
            <span class="tools pull-right">
                <a class="fa fa-chevron-up" href="javascript:;"></a>
                <a class="fa fa-times" href="javascript:;"></a>
            </span>
        </div>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiAplWeb_1['qtd_abertos']) ? round(($kpiStiAplWeb_1['qtd_fechados'] * 100) / $kpiStiAplWeb_1['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 08 Horas">
                            <?php echo $kpiStiAplWeb_1['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 08 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiAplWeb_1['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiAplWeb_2['qtd_abertos']) ? round(($kpiStiAplWeb_2['qtd_fechados'] * 100) / $kpiStiAplWeb_2['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 12 Horas">
                            <?php echo $kpiStiAplWeb_2['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 12 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiAplWeb_2['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiAplWeb_3['qtd_abertos']) ? round(($kpiStiAplWeb_3['qtd_fechados'] * 100) / $kpiStiAplWeb_3['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 16 Horas">
                            <?php echo $kpiStiAplWeb_3['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiAplWeb_3['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiAplWeb_4['qtd_abertos']) ? round(($kpiStiAplWeb_4['qtd_fechados'] * 100) / $kpiStiAplWeb_4['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 20 Horas">
                            <?php echo $kpiStiAplWeb_4['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 20 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiAplWeb_4['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Atendimento 3º Nível - Produção: Banco de Dados - Atendimento Remoto
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_1['qtd_abertos']) ? round(($kpi03_1['qtd_fechados'] * 100) / $kpi03_1['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 02 Horas">
                            <?php echo $kpi03_1['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 02 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_1['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_2['qtd_abertos']) ? round(($kpi03_2['qtd_fechados'] * 100) / $kpi03_2['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 04 Horas">
                            <?php echo $kpi03_2['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 04 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_2['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_3['qtd_abertos']) ? round(($kpi03_3['qtd_fechados'] * 100) / $kpi03_3['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 06 Horas">
                            <?php echo $kpi03_3['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 06 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_3['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_4['qtd_abertos']) ? round(($kpi03_4['qtd_fechados'] * 100) / $kpi03_4['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 08 Horas">
                            <?php echo $kpi03_4['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 08 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_4['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_5['qtd_abertos']) ? round(($kpi03_5['qtd_fechados'] * 100) / $kpi03_5['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 10 Horas">
                            <?php echo $kpi03_5['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 10 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_5['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_6['qtd_abertos']) ? round(($kpi03_6['qtd_fechados'] * 100) / $kpi03_6['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 12 Horas">
                            <?php echo $kpi03_6['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 12 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_6['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_7['qtd_abertos']) ? round(($kpi03_7['qtd_fechados'] * 100) / $kpi03_7['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 14 Horas">
                            <?php echo $kpi03_7['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 14 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_7['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_8['qtd_abertos']) ? round(($kpi03_8['qtd_fechados'] * 100) / $kpi03_8['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 16 Horas">
                            <?php echo $kpi03_8['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_8['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_9['qtd_abertos']) ? round(($kpi03_9['qtd_fechados'] * 100) / $kpi03_9['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 18 Horas">
                            <?php echo $kpi03_9['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 18 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_9['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_10['qtd_abertos']) ? round(($kpi03_10['qtd_fechados'] * 100) / $kpi03_10['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 20 Horas">
                            <?php echo $kpi03_10['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 20 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_10['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpi03_11['qtd_abertos']) ? round(($kpi03_11['qtd_fechados'] * 100) / $kpi03_11['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 24 Horas">
                            <?php echo $kpi03_11['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 24 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpi03_11['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>

        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Atendimento 3º Nível - Produção: Aplicações Departamentais - Atendimento Remoto
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_1['qtd_abertos']) ? round(($kpiStiPAD_1['qtd_fechados'] * 100) / $kpiStiPAD_1['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 14 Horas">
                            <?php echo $kpiStiPAD_1['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 14 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_1['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_2['qtd_abertos']) ? round(($kpiStiPAD_2['qtd_fechados'] * 100) / $kpiStiPAD_2['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 16 Horas">
                            <?php echo $kpiStiPAD_2['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_2['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_3['qtd_abertos']) ? round(($kpiStiPAD_3['qtd_fechados'] * 100) / $kpiStiPAD_3['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 18 Horas">
                            <?php echo $kpiStiPAD_3['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 18 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_3['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_4['qtd_abertos']) ? round(($kpiStiPAD_4['qtd_fechados'] * 100) / $kpiStiPAD_4['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 20 Horas">
                            <?php echo $kpiStiPAD_4['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 20 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_4['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_5['qtd_abertos']) ? round(($kpiStiPAD_5['qtd_fechados'] * 100) / $kpiStiPAD_5['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 26 Horas">
                            <?php echo $kpiStiPAD_5['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 26 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_5['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_6['qtd_abertos']) ? round(($kpiStiPAD_6['qtd_fechados'] * 100) / $kpiStiPAD_6['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 30 Horas">
                            <?php echo $kpiStiPAD_6['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 30 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_6['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiPAD_7['qtd_abertos']) ? round(($kpiStiPAD_7['qtd_fechados'] * 100) / $kpiStiPAD_7['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 32 Horas">
                            <?php echo $kpiStiPAD_7['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 32 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiPAD_7['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Atendimento 3º Nível - Produção: Servidores e Sistemas Operacionais - Atendimento Remoto
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiSSOp_1['qtd_abertos']) ? round(($kpiStiSSOp_1['qtd_fechados'] * 100) / $kpiStiSSOp_1['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 16 Horas">
                            <?php echo $kpiStiSSOp_1['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiSSOp_1['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiSSOp_2['qtd_abertos']) ? round(($kpiStiSSOp_2['qtd_fechados'] * 100) / $kpiStiSSOp_2['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 18 Horas">
                            <?php echo $kpiStiSSOp_2['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 18 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiSSOp_2['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiSSOp_3['qtd_abertos']) ? round(($kpiStiSSOp_3['qtd_fechados'] * 100) / $kpiStiSSOp_3['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 20 Horas">
                            <?php echo $kpiStiSSOp_3['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 20 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiSSOp_3['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiSSOp_4['qtd_abertos']) ? round(($kpiStiSSOp_4['qtd_fechados'] * 100) / $kpiStiSSOp_4['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 24 Horas">
                            <?php echo $kpiStiSSOp_4['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 24 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiSSOp_4['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Atendimento 3º Nível - Produção: Virtualização - Atendimento Remoto
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiVirt_1['qtd_abertos']) ? round(($kpiStiVirt_1['qtd_fechados'] * 100) / $kpiStiVirt_1['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 16 Horas">
                            <?php echo $kpiStiVirt_1['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiVirt_1['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiVirt_2['qtd_abertos']) ? round(($kpiStiVirt_2['qtd_fechados'] * 100) / $kpiStiVirt_2['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 18 Horas">
                            <?php echo $kpiStiVirt_2['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 18 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiVirt_2['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiVirt_3['qtd_abertos']) ? round(($kpiStiVirt_3['qtd_fechados'] * 100) / $kpiStiVirt_3['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 20 Horas">
                            <?php echo $kpiStiVirt_3['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 20 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiVirt_3['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-4">
                <section class="panel">
                    <?php
                    // KPI 03
                    $kpiPerc = (!empty($kpiStiVirt_4['qtd_abertos']) ? round(($kpiStiVirt_4['qtd_fechados'] * 100) / $kpiStiVirt_4['qtd_abertos'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 94)
                        $cor = 'red';
                    else if (($kpiPerc >= 94) && ($kpiPerc <= 95))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Fechados Produção com SLA de 24 Horas">
                            <?php echo $kpiStiVirt_4['qtd_fechados']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 24 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Total Abertos: <?php echo $kpiStiVirt_4['qtd_abertos']; ?></p>
                    </div>
                </section>
            </div>
        </div>
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