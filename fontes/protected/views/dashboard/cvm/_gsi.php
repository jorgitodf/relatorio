<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 03/11/16
 * Time: 15:53
 */

/* @var $this DashboardController */
/* @var $model DashboardGsi */
/* @var $form CActiveForm */

$dashPainels = $model->dash01GstStats();
$dashPainels1 = $model->dashGeralGSI_I();
$dashPainels2 = $model->dashGeralGSI_II();
$dashPainels3 = $model->dashGeralGSI_III();
$cmbAgents = $model->dashEstatAgentesGSI();
$dashQueues = $model->dash03Stats();
//print_r($dashPainels);exit;
//$dashAgents = $model->dash02Stats();
//$dashQueues = $model->dashTicketByQueue();
$dashStat = $model->dashTicketStatGeneral();

// Register Ajax - Change Agents
$cs = Yii::app()->getClientScript();
$cs->registerScript("jsCommon",
    "$(\"#cmbAgents\").change(function () { ".
    "  $(\"#DashboardIncra_userId\").val(this.value); " .
    "  $(\"#filtro-form\").submit(); " .
    "});");



?>

<div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-group"></i>
            </div>
            <div class="value">
                <?php
                //0
                $total = $dashPainels[0]['dash_qtd_aberto'];
                $perc1 = round(($dashPainels[0]['dash_qtd_aberto'] / $total) * 100,2);
                $perc2 = round(($dashPainels[0]['dash_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class="count popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels[0]['dash_qtd_aberto']?>." data-placement="top" data-trigger="hover"><?php echo $dashPainels[0]['dash_qtd_aberto'];?></h1>
                <h1 class="count popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels[0]['dash_qtd_fechado'] . " (" . $perc2;?>%)." data-placement="top" data-trigger="hover"><?php echo $dashPainels[0]['dash_qtd_fechado'];?></h1>
                <p>Geral</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol red">
                <i class="fa fa-gears"></i>
            </div>
            <div class="value">
                <?php
                //1
                $total = $dashPainels[0]['dash_qtd_aberto'];
                $perc1 = round(($dashPainels1[0]['dash01_qtd_aberto'] / $total) * 100,2);
                $total = $dashPainels[0]['dash_qtd_fechado'];
                $perc2 = round(($dashPainels1[0]['dash01_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class=" count2 popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels1[0]['dash01_qtd_aberto'] . ".<br /><b>" . $perc1;?>%</b> dos chamados são abertos na GSI." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels1[0]['dash01_qtd_aberto'];?></h1>
                <h1 class=" count2 popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels1[0]['dash01_qtd_fechado'] . ".<br /><b>" . $perc2;?>%</b> dos chamados são fechados na GSI." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels1[0]['dash01_qtd_fechado'];?></h1>
                <p>GSI I</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol yellow">
                <i class="fa fa-desktop"></i>
            </div>
            <div class="value">
                <?php
                //2
                $total = $dashPainels[0]['dash_qtd_aberto'];
                $perc1 = round(($dashPainels2[0]['dash02_qtd_aberto'] / $total) * 100,2);
                $total = $dashPainels[0]['dash_qtd_fechado'];
                $perc2 = round(($dashPainels2[0]['dash02_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class=" count3 popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels2[0]['dash02_qtd_aberto'] . ".<br /><b>" . $perc1;?>%</b> dos chamados são abertos no SSI." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels2[0]['dash02_qtd_aberto'];?></h1>
                <h1 class=" count3 popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels2[0]['dash02_qtd_fechado'] . ".<br /><b>" . $perc2;?>%</b> dos chamados são fechados no SSI." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels2[0]['dash02_qtd_fechado'];?></h1>
                <p>GSI II</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol blue">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="value">
                <?php
                //3
                $total = $dashPainels[0]['dash_qtd_aberto'];
                $perc1 = round(($dashPainels3[0]['dash03_qtd_aberto'] / $total) * 100,2);
                $total = $dashPainels[0]['dash_qtd_fechado'];
                $perc2 = round(($dashPainels3[0]['dash03_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class=" count4 popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels3[0]['dash03_qtd_aberto'] . ".<br /><b>" . $perc1;?>%</b> dos chamados são abertos no SEI." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels3[0]['dash03_qtd_aberto'];?></h1>
                <h1 align="center" class=" count4 popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels3[0]['dash03_qtd_fechado'] . ".<br /><b>" . $perc2;?>%</b> dos chamados são fechados no SEI." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels3[0]['dash03_qtd_fechado'];?></h1>
                <p>GSI III</p>
            </div>
        </section>
    </div>

</div>
<div class="row">
    <div class="col-lg-6 col-sm-6">
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Atendimento atendentes</h1>
                    <p>Central de Serviço e Suporte 2º Nível(+Subfilas)</p>
                </div>
                <div class="task-option">
                    <?php
                    /*
                    $options = CHtml::listData($cmbAgents,'user_id','full_name');
                    $options[''] = '< Todos >';
                    asort($options);
                    echo CHtml::dropDownList('cmbAgents', $model->userId, $options,
                        array('class'=>'styled hasCustomSelect'));
                    */
                    ?>
                </div>
            </div>
            <table id="attendeeAgents" class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Atendente</th>
                    <th>Criados</th>
                    <th>Atendido</th>
                    <th>Pendentes</th>
                    <th>Encerrados</th>
                 <!--   <th>Tempo de atendimento</th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($cmbAgents as $value) {
                    echo "<tr><td>" . $value['user_name'] . "</td>";
                    echo "<td>" . $value['qtd_aberto'] . "</td>";
                    echo "<td>" . $value['qtd_atendido'] . "</td>";
                    echo "<td>" . $value['qtd_pendente'] . "</td>";
                    echo "<td>" . $value['qtd_encerrado'] . "</td>";
                   // echo "<td>" . $value['tempo_atendimento'] . "</td></tr>";
                }

                ?>
                </tbody>
            </table>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Encerrados por Fila</h1>
                    <p>Todas as filas</p>
                </div>
            </div>
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Fila</th>
                    <th>Qtd</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($dashQueues as $value){
                    echo "<tr><td>".$value['queue_name'] . "</td>";
                    echo "<td>".$value['qtd'] . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <section class="panel">
                <header class="panel-heading ">
                    VISÃO GERAL
                              <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                </header>
                <div class="panel-body" style="display: block;">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="summary-title">ENCERRADOS: </span>
                            <span class="summary-number"><b><?php echo $model->dashGSIEncerrados(); ?></b></span>
                        </li>
                        <li class="list-group-item">
                            <span class="summary-title">ABERTOS: </span>
                            <span class="summary-number"><b><?php echo $model->dashGSITicketsAbertos(); ?></b></span>
                        </li>
                        <li class="list-group-item">
                            <span class="summary-title">BLOQUEADOS: </span>
                            <span class="summary-number"><b><?php echo $model->dashGSITicketsBloqueados(); ?></b></span>
                        </li>
                        <li class="list-group-item">
                            <span class="summary-title">AGENTES: </span>
                            <span class="summary-number"><b><?php echo $model->dashAgentes(); ?></b></span>
                        </li>
                        <li class="list-group-item">
                            <span class="summary-title">PENDENTES: </span>
                            <span class="summary-number"><b><?php echo $model->dashGSITicketsPendente(); ?></b></span>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 col-sm-5">
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Estatísticas Gerais</h1>
                    <p>Geral</p>
                </div>
            </div>
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Atividade</th>
                    <th>Valor Apurado</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($dashStat as $value){
                    echo "<tr><td>".$value['title']."</td>";
                    echo "<td>".$value['qtd']."</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>
    <!--
    <div class="col-lg-6 col-sm-6">
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Pesquisa de Satisfação</h1>
                    <p>Geral - Todas as filas</p>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed"><tbody>
                    <?php
                    // $lst = $model->dashPqsQuestions();
                    //foreach ($lst as $value) {
                    // retorna respostas
                    //  $answers = $model->dashPqsAnswer($value['question_id']);
                    //   $total = 0;
                    //   $totalAnswered = 0;
                    //  $totalNotAnswered = 0;
                    //   $total = 0;
                    // foreach ($answers as $item) {
                    //     $total += $item['amount'];
                    //       $totalAnswered += $item['amount_answered'];
                    //       $totalNotAnswered += $item['amount_not_answered'];
                    //    }

                    //   echo "<tr><td><p class=\"text-muted\">".$value['question']."</p></td><td>";

                    //    if ($value['question_id'] != 10) {
                    // Não é TextArea (Comentário)
                    //  foreach ($answers as $item) {
                    //     $perc = ($item['amount'] == 0 ? 0 : round($item['amount'] * 100 / $total, 2));
                    //      echo $item['answer']." ($perc%)<div class=\"progress progress-sm\">";
                    //     echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$perc\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $perc%\">";
                    //      echo "<span class=\"sr-only\">$perc% Complete</span>";
                    //       echo "</div></div>";
                    //   }
                    //  } else {
                    // É TextArea (Comentário)
                    //    $total = $totalAnswered + $totalNotAnswered;
                    //     $perc = ($item['amount_answered'] == 0 ? 0 : round($item['amount_answered'] * 100 / $total, 2));
                    // Respondido
                    //    echo "Respondido ($perc%)<div class=\"progress progress-sm\">";
                    //   echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$perc\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $perc%\">";
                    //    echo "<span class=\"sr-only\">$perc% Complete</span>";
                    //    echo "</div></div>";

                    // $perc = ($item['amount_not_answered'] == 0 ? 0 : round($item['amount_not_answered'] * 100 / $total, 2));
                    // Não respondido
                    //   echo "Não Respondido ($perc%)<div class=\"progress progress-sm\">";
                    //   echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$perc\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $perc%\">";
                    //  echo "<span class=\"sr-only\">$perc% Complete</span>";
                    //  echo "</div></div>";
                    // }

                    //  echo "</td></tr>";
                    //    }
                    ?>
                    </tbody></table>
            </div>
        </section>
    </div>
    -->

</div>
