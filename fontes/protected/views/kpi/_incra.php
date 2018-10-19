<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
/* @var $model KpiIncra */

//DET3
$totalKpi = $model->kpiTotal();
$kpi01 = $model->kpi01();
$kpi02 = $model->kpi02();
$kpi03 = $model->kpi03();
$kpi04 = $model->kpi04();
$kpi05 = $model->kpi05();
$kpi06 = $model->kpi06();
$kpi07 = $model->kpi07();
$kpi08 = $model->kpi08();
$kpi09 = $model->kpi09();
$kpi10 = $model->kpi10();
//DET2
$totalKpiDET2 = $model->kpiTotalDET02();
$kpi01DET2 = $model->kpi01DET02(); //satisfação
$kpi02DET2 = $model->kpi02DET02();
$kpi03DET2 = $model->kpi03DET02();
$kpi04DET2 = $model->kpi04DET02();

?>
<section class="panel">
    <header class="panel-heading">
        Níveis de Serviço DET3&#32;&#32;&#32;&#32;&#32;<span id="timer"></span>
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
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi01 * 100) / $totalKpi, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 80)
                        $cor = 'red';
                    else if (($kpiPerc >= 80) && ($kpiPerc <= 81))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Solicitações resolvidas em até 4 (quatro) horas">
                            <?php echo $kpi01; ?>
                        </h1>
                        <h1 class="" title="Meta >= 80%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Até 4 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi02 * 100) / $totalKpi, 2) : 0);
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
                        <h1 class=" count2" title="Solicitações resolvidas em até 8 (oito) horas">
                            <?php echo $kpi02; ?>
                        </h1>
                        <h1 class="" title="Meta >= 90%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Até 8 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi03 * 100) / $totalKpi, 2) : 0);
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
                    <div class="value light">
                        <h1 class=" count3" title="Solicitações resolvidas em até 12 (doze) horas">
                            <?php echo $kpi03; ?>
                        </h1>
                        <h1 class="" title="Meta >= 95%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Até 12 horas</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi04 * 100) / $totalKpi, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc < 99)
                        $cor = 'red';
                    else if (($kpiPerc >= 99) && ($kpiPerc <= 99.5))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class=" count4" title="Chamados resolvidos em até 03 (três) dias úteis.">
                            <?php echo $kpi04; ?>
                        </h1>
                        <h1 class="" title="Meta >= 99%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Até 3 dias</p>
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
                    $total = $kpi05['qtd_satisfaction'] + $kpi05['qtd_nosatisfaction'];
                    $kpiPerc = (!empty($total) ? round(($kpi05['qtd_nosatisfaction'] * 100) / $total, 2) : 0);
                    $smile = 'smile-o';
                    if ($kpiPerc > 8)
                        $smile = 'frown-o';
                    else if (($kpiPerc >= 7) && ($kpiPerc <= 8))
                        $smile = 'meh-o';
                    else
                        $smile = 'smile-o';
                    ?>
                    <div class="symbol terques">
                        <i class="fa fa-<?php echo $smile; ?>"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Insatisfação com o atendimento">
                            <?php echo $kpi05['qtd_nosatisfaction']; ?>
                        </h1>
                        <h1 class="" title="Meta <= 8%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Insatisfação</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($kpi06['qtd_total']) ? round(($kpi06['qtd_escalonada'] * 100) / $kpi06['qtd_total'], 2) : 0);
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
                    <div class="value light">
                        <h1 class="count1" title="Chamados com tempo de escalonamento para 2º e 3º níveis superior a 30(trinta) minutos">
                            <?php echo $kpi06['qtd_escalonada']; ?>
                        </h1>
                        <h1 class="" title="Meta <= 10%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Escalonamento</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi07 * 100) / $totalKpi, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 5)
                        $cor = 'red';
                    else if (($kpiPerc >= 4) && ($kpiPerc <= 5))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Solicitações Classificadas Incorretamente (quanto ao tipo ou categoria/catálogo de serviços)">
                            <?php echo $kpi07; ?>
                        </h1>
                        <h1 class="" title="Meta <= 5%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Reclassificação</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi08 * 100) / $totalKpi, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 3)
                        $cor = 'red';
                    else if (($kpiPerc >= 2) && ($kpiPerc <= 3))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados fechados sem comunicação ao usuário">
                            <?php echo $kpi08; ?>
                        </h1>
                        <h1 class="" title="Meta <= 3%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Comunicação</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($totalKpi) ? round(($kpi09 * 100) / $totalKpi, 2) : 0);
                    $cor = 'terques';
                    if ($kpiPerc > 3)
                        $cor = 'red';
                    else if (($kpiPerc >= 2) && ($kpiPerc <= 3))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Chamados reabertos">
                            <?php echo $kpi09; ?>
                        </h1>
                        <h1 class="" title="Meta <= 3%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Reabertura</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = (!empty($kpi10['qtd_total']) ? round(($kpi10['qtd_criticidade'] * 100) / $kpi10['qtd_total'], 2) : 100);
                    $cor = 'terques';
                    if ($kpiPerc < 90)
                        $cor = 'red';
                    else if (($kpiPerc >= 85) && ($kpiPerc <= 90))
                        $cor = 'yellow';
                    else
                        $cor = 'blue';
                    ?>
                    <div class="symbol <?php echo $cor; ?>">
                        <i class="fa fa-dashboard"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Solicitações de criticidade “alta” resolvidas em até 1 (uma) hora">
                            <?php echo $kpi10['qtd_criticidade']; ?>
                        </h1>
                        <h1 class="" title="Meta >= 90%">
                            <?php echo $kpiPerc; ?>%
                        </h1>
                        <p>Criticidade</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Níveis de Serviço DET2
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
                    // KPI 01 - Pesquisa de Satisfação
                    $total = $kpi01DET2['qtd_satisfaction'] + $kpi01DET2['qtd_nosatisfaction'];
                    $kpiPerc = (!empty($total) ? round(($kpi01DET2['qtd_satisfaction'] * 100) / $total, 2) : 0);
                    $smile = 'smile-o';
                    if (($total > 0) && ($kpiPerc < 85))
                        $smile = 'frown-o';
                    else if (($kpiPerc >= 85) && ($kpiPerc <= 86))
                        $smile = 'meh-o';
                    else
                        $smile = 'smile-o';
                    ?>
                    <div class="symbol terques">
                        <i class="fa fa-<?php echo $smile; ?>"></i>
                    </div>
                    <div class="value light">
                        <h1 class="count1" title="Valor apurado de satisfação ">
                            <?php echo $kpi01DET2['qtd_satisfaction']; //valor apurado de satisfação?>
                        </h1>

                        <h1 class="" title="Meta >= 85%">
                            <?php echo $kpiPerc; ?>%
                        </h1>

                        <p>Satisfação</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    // KPI 02 - Índice de incidentes críticos tratados em até 04 horas
                    $kpiPerc = 0;
                    $kpiPerc = (!empty($totalKpiDET2['Critico']) ? round(($kpi02DET2 * 100) / $totalKpiDET2['Critico'], 2) : 0);
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
                    <div class="value light">
                        <h1 class=" count2" title="Incidentes criticos resolvidos em até 4h.">
                            <?php echo $kpi02DET2; ?>
                        </h1>

                        <h1 class="" title="Meta >= 95%">
                            <?php echo $kpiPerc; ?>%
                        </h1>

                        <p>Incidentes criticos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = 0;
                    $kpiPerc = (!empty($totalKpiDET2['Urgente']) ? round(($kpi03DET2 * 100) / $totalKpiDET2['Urgente'], 2) : 0);
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
                    <div class="value light">
                        <h1 class=" count3" title="Incidentes urgentes resolvidos em até 8h.">
                            <?php echo $kpi03DET2; ?>
                        </h1>

                        <h1 class="" title="Meta >= 95%">
                            <?php echo $kpiPerc; ?>%
                        </h1>

                        <p>Incidentes urgentes</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <?php
                    $kpiPerc = 0;
                    $kpiPerc = (!empty($totalKpiDET2['Rotina']) ? round(($kpi04DET2 * 100) / $totalKpiDET2['Rotina'], 2) : 0);
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
                    <div class="value light">
                        <h1 class=" count4" title="Chamados de rotinas resolvidos dentro prazo do serviço.">
                            <?php echo $kpi04DET2; ?>
                        </h1>

                        <h1 class="" title="Meta >= 95%">
                            <?php echo $kpiPerc; ?>%
                        </h1>

                        <p>Chamados de rotina</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->
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