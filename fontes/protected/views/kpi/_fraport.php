<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiFraport */

$qtdChamAbeFecN1 = $model->qtdChamadosAbertosEFechadosCSSR();
$qtdChamAbertoN1 = $model->qtdChamadosAbertosN1();
$kpi02_1 = $model->kpi02_1();
$kpi02_2 = $model->kpi02_2();
$kpi02_3 = $model->kpi02_3();
$kpi02_4 = $model->kpi02_4();
$kpi02_5 = $model->kpi02_5();
$kpi02_6 = $model->kpi02_6();
$kpi02_7 = $model->kpi02_7();
$kpi02_8 = $model->kpi02_8();
//$qtdChamFechadN2 = $model->qtdChamadosFechadosN2();

?>

<section class="panel">
    <header class="panel-heading">
        <span id="timer"></span>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($qtdChamAbertoN1) ? round(($qtdChamAbeFecN1 * 100) / $qtdChamAbertoN1, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 49)
                        $cor = 'red';
                    else if (($kpiPerc >= 49) && ($kpiPerc < 50))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Encerrados na Central de Serviços - Suporte Téc. Remoto">
                            <?php echo $qtdChamAbeFecN1; ?>
                        </h1>
                        <h1 class="" title="Taxa de Chamados Abertos e Encerrados na Central de Serviços - Suporte Téc. Remoto">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados Encerrados na Central de Serviços - Suporte Téc. Remoto</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section class="panel">
    <header class="panel-heading">
        SLA s
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_1['qtd_total']) ? round(($kpi02_1['qtd'] * 100) / $kpi02_1['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 8 Horas">
                            <?php echo $kpi02_1['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 8 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 8 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_2['qtd_total']) ? round(($kpi02_2['qtd'] * 100) / $kpi02_2['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 12 Horas">
                            <?php echo $kpi02_2['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 12 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 12 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_3['qtd_total']) ? round(($kpi02_3['qtd'] * 100) / $kpi02_3['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 16 Horas">
                            <?php echo $kpi02_3['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 16 horas</p>
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
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_4['qtd_total']) ? round(($kpi02_4['qtd'] * 100) / $kpi02_4['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 18 Horas">
                            <?php echo $kpi02_4['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 18 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 18 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_5['qtd_total']) ? round(($kpi02_5['qtd'] * 100) / $kpi02_5['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 24 Horas">
                            <?php echo $kpi02_5['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 24 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 24 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_6['qtd_total']) ? round(($kpi02_6['qtd'] * 100) / $kpi02_6['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 42 Horas">
                            <?php echo $kpi02_6['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 42 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 42 horas</p>
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
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_7['qtd_total']) ? round(($kpi02_7['qtd'] * 100) / $kpi02_7['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 48 Horas">
                            <?php echo $kpi02_7['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 48 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 48 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($kpi02_8['qtd_total']) ? round(($kpi02_8['qtd'] * 100) / $kpi02_8['qtd_total'], 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 91))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados com SLA de 56 Horas">
                            <?php echo $kpi02_8['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 56 Horas - Meta > 90%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados com SLA 56 horas</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

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