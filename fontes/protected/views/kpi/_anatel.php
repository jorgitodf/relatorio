<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiAnatel */

$qtdTotalCAC = $model->qtdTotalChamadosAbertosCustomer();
$qtdChamTrat15MinCust = $model->qtdChamadosAbertosCustomerTratadosAte15Min();
$qtdTotalChamAbeAgProc = $model->qtdTotalChamadosAbertosAgenteProcesso();
$qtdChamTrat15MinAgeProc = $model->qtdChamadosAbertosAgenteProcessoTratadosAte15Min();
$qtdChamAbeFecN1 = $model->qtdChamadosAbertosEFechadosN1();
$qtdChamAbertoN1 = $model->qtdChamadosAbertosN1();
$kpi02_1 = $model->kpi02_1();
$kpi02_2 = $model->kpi02_2();
$kpi02_3 = $model->kpi02_3();
$kpi02_4 = $model->kpi02_4();
$kpi02_5 = $model->kpi02_5();
$qtdChamFechadN2 = $model->qtdChamadosFechadosN2();

?>

<section class="panel">
    <header class="panel-heading">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-md-6 offset-md-3">
                <span id="timer"></span>
            </div>
        </div>
        <div>Atendimento 1º Nível - Service Desk
            <span class="tools pull-right">
                <a class="fa fa-chevron-up" href="javascript:;"></a>
                <a class="fa fa-times" href="javascript:;"></a>
            </span>
        </div>
    </header>
    <div style="display: block" class="panel-body profile-activity">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 01
                    $kpiPerc = (!empty($qtdTotalCAC) ? round(($qtdChamTrat15MinCust * 100) / $qtdTotalCAC, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Abertos Via Customer">
                            <?php echo $qtdTotalCAC; ?>
                        </h1>
                        <h1 class="" title="Taxa de Chamados Tratados em Até 15 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados Abertos Customer</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 01
                    $kpiPerc = (!empty($qtdTotalChamAbeAgProc) ? round(($qtdChamTrat15MinAgeProc * 100) / $qtdTotalChamAbeAgProc, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 90) && ($kpiPerc <= 96))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Abertos Via Agente ou Processo">
                            <?php echo $qtdTotalChamAbeAgProc; ?>
                        </h1>
                        <h1 class="" title="Taxa de Chamados Tratados em Até 15 Minutos">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados Abertos Agente</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 01
                    $kpiPerc = (!empty($qtdChamAbertoN1) ? round(($qtdChamAbeFecN1 * 100) / $qtdChamAbertoN1, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 59)
                        $cor = 'red';
                    else if (($kpiPerc >= 59) && ($kpiPerc < 60))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Encerrados no N1">
                            <?php echo $qtdChamAbeFecN1; ?>
                        </h1>
                        <h1 class="" title="Taxa de Chamados Abertos e Encerrados no N1">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Chamados Encerrados N1</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Atendimento 2º Nível - Atendimento Presencial
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
                        <h1 class="count1" title="Total de Chamados Abertos Suporte Presencial com SLA de 6 Horas">
                            <?php echo $kpi02_1['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 6 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Suporte Presencial SLA 6 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_2['qtd_total']) ? round(($kpi02_2['qtd'] * 100) / $kpi02_2['qtd_total'], 2) : 0);
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
                        <h1 class="count1" title="Total de Chamados Abertos Suporte Presencial com SLA de 8 Horas">
                            <?php echo $kpi02_2['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 8 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Suporte Presencial SLA 8 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_3['qtd_total']) ? round(($kpi02_3['qtd'] * 100) / $kpi02_3['qtd_total'], 2) : 0);
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
                        <h1 class="count1" title="Total de Chamados Abertos Suporte Presencial com SLA de 9 Horas">
                            <?php echo $kpi02_3['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 9 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Suporte Presencial SLA 9 horas</p>
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
                        <h1 class="count1" title="Total de Chamados Abertos Suporte Presencial com SLA de 10 Horas">
                            <?php echo $kpi02_4['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 10 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Suporte Presencial SLA 10 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $kpiPerc = (!empty($kpi02_5['qtd_total']) ? round(($kpi02_5['qtd'] * 100) / $kpi02_5['qtd_total'], 2) : 0);
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
                        <h1 class="count1" title="Total de Chamados Abertos Suporte Presencial com SLA de 16 Horas">
                            <?php echo $kpi02_5['qtd_total']; ?>
                        </h1>
                        <h1 class="" title="Chamados Fechados em até 16 Horas - Meta > 95%">
                            <?php echo $kpiPerc; ?> %
                        </h1>
                        <p>Suporte Presencial SLA 16 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-5">
                <section class="panel">
                    <?php
                    // KPI 02
                    $cor = 'terques';
                    if ($qtdChamFechadN2['qtd_abertos'] > 0)
                        $cor = 'red';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Total de Chamados Abertos Suporte Presencial N2">
                            <?php echo $qtdChamFechadN2['qtd_abertos']; ?>
                        </h1>
                        <h1 class="" title="Total de Chamados Fechados no N2">
                            <?php echo $qtdChamFechadN2['qtd_fechados']; ?>
                        </h1>
                        <p>Tickets Fechados N2</p>
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