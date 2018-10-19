<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiAncine */

$qtdChamINS0203 = $model->rptKPI0203();
$qtdChamINS0203P2 = $model->rptKPI0203P2();
$qtdChamINS0203P3 = $model->rptKPI0203P3();
$qtdChamINS0203P1 = $model->rptKPI0203P1();
$qtdChamINS0203ServCtri = $model->rptKPI0203ServCtri();
$qtdChamINS0203ServNCtri = $model->rptKPI0203ServNCtri();
$qtdChamINS0405 = $model->rptKPI0405();
$qtdChamINS0405P2 = $model->rptKPI0405S2();
$qtdChamINS0405P3 = $model->rptKPI0405S3();
$qtdChamINS0405S1 = $model->rptKPI0405S1();
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
                        <h1 class="count1" title="Total de Tickets Severidade 2 (Sla 4 Horas) com Início de Atendimento <= 15 Minutos">
                            <?php echo $qtdChamINS0203P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 90% Tickets com Início de Atendimento <= 15 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Severidade 2</p>
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
                        <h1 class="count1" title="Total de Tickets Severidade 3 (Sla 8 Horas) com Início de Atendimento <= 15 Minutos">
                            <?php echo $qtdChamINS0203P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 90% Tickets com Início de Atendimento <= 15 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Severidade 3</p>
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
                        <h1 class="count1" title="Total de Tickets Severidade 1 (Sla 1 Hora) com Início de Atendimento <= 5 Minutos">
                            <?php echo $qtdChamINS0203P1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets com Início de Atendimento <= 5 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Severidade 1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0203ServCtri[0]) ? round(($qtdChamINS0203ServCtri[0] * 100) / $qtdChamINS0203ServCtri[1], 2) : 0);
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
                        <h1 class="count1" title="Total de Tickets Incidentes Serviços Críticos com Início de Atendimento <= 5 Minutos">
                            <?php echo $qtdChamINS0203ServCtri[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets com Início de Atendimento <= 5 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Serv. Críticos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0203ServNCtri[0]) ? round(($qtdChamINS0203ServNCtri[0] * 100) / $qtdChamINS0203ServNCtri[1], 2) : 0);
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
                        <h1 class="count1" title="Total de Tickets Incidentes Serviços Não Críticos com Início de Atendimento <= 15 Minutos">
                            <?php echo $qtdChamINS0203ServNCtri[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets com Início de Atendimento <= 15 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets IN Serv. Ñ Críticos</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        <span>INS 04-05</span>
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
                    if ($kpiPerc < 93)
                        $cor = 'red';
                    else if (($kpiPerc >= 93) && ($kpiPerc <= 94))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Vip Solucionados até 1 Hora">
                            <?php echo $qtdChamINS0405[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Solucionados SLA Vip 1 Hora">
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
                    if ($kpiPerc < 93)
                        $cor = 'red';
                    else if (($kpiPerc >= 93) && ($kpiPerc <= 94))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Severidade 2 (Sla 4 Horas) Solucionados até 4 Horas">
                            <?php echo $qtdChamINS0405P2[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Solucionados SLA 4 Horas">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Severidade 2</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0405P3[0]) ? round(($qtdChamINS0405P3[0] * 100) / $qtdChamINS0405P3[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 93)
                        $cor = 'red';
                    else if (($kpiPerc >= 93) && ($kpiPerc <= 94))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Severidade 3 (Sla 8 Horas) Solucionados até 8 Horas">
                            <?php echo $qtdChamINS0405P3[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Solucionados SLA 8 Horas">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Severidade 3</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-5 col-md-5">
                <section class="panel col-lg-12 col-sm-12 col-md-12">
                    <?php
                    $kpiPerc = (!empty($qtdChamINS0405S1[0]) ? round(($qtdChamINS0405S1[0] * 100) / $qtdChamINS0405S1[1], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 93)
                        $cor = 'red';
                    else if (($kpiPerc >= 93) && ($kpiPerc <= 94))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light div-result">
                        <h1 class="count1" title="Total de Tickets Severidade 1 (Sla 1 Hora) Solucionados até 1 Hora">
                            <?php echo $qtdChamINS0405S1[0]; ?>
                        </h1>
                        <h1 class="" title="Meta: >= 95% Tickets Solucionados SLA 1 Hora">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Tickets Sla Severidade 1</p>
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