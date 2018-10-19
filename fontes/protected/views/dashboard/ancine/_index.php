<?php
/* @var $this DashboardController */
/* @var $form CActiveForm */
/* @var $model DashboardAncine */

$dashPainels = $model->dash01Stats();
$dashAgents = $model->dash02Stats();
$dashQueues = $model->dash03Stats();
$dashForwQueue = $model->dash04ForwardedByQueue();
$dashSLA = $model->dashSLAbyAgents();
$dashStat = $model->dashTicketStatGeneral();
// Ajax
$cmbAgents = $model->dashAllAgents();
// Register Ajax - Change Agents
$cs = Yii::app()->getClientScript();
$cs->registerScript("jsCommon",
        "$(\"#cmbAgents\").change(function () { ".
        "  $(\"#DashboardAncine_userId\").val(this.value); " .
        "  $(\"#filtro-form\").submit(); " .
        "});");

?>

<div class="row state-overview">    
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-user"></i>
            </div>
            <div class="value">
                <?php
                $total = $dashPainels[0]['dash01_qtd_aberto']+$dashPainels[0]['dash01_qtd_fechado'];
                $perc1 = round(($dashPainels[0]['dash01_qtd_aberto'] / $total) * 100,2);
                $perc2 = round(($dashPainels[0]['dash01_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class="count popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels[0]['dash01_qtd_aberto'] . " (" . $perc1;?>%)." data-placement="top" data-trigger="hover"><?php echo $dashPainels[0]['dash01_qtd_aberto'];?></h1>
                <h1 class="count popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels[0]['dash01_qtd_fechado'] . " (" . $perc2;?>%)." data-placement="top" data-trigger="hover"><?php echo $dashPainels[0]['dash01_qtd_fechado'];?></h1>
                <p>Geral</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol red">
                <i class="fa fa-tags"></i>
            </div>
            <div class="value">
                <?php
                $total = $dashPainels[0]['dash01_qtd_aberto'];
                $perc1 = round(($dashPainels[0]['dash02_qtd_aberto'] / $total) * 100,2);
                $total = $dashPainels[0]['dash01_qtd_fechado'];
                $perc2 = round(($dashPainels[0]['dash02_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class=" count2 popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels[0]['dash02_qtd_aberto'] . ".<br /><b>" . $perc1;?>%</b> dos chamados são abertos no 1º Nível." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels[0]['dash02_qtd_aberto'];?></h1>
                <h1 class=" count2 popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels[0]['dash02_qtd_fechado'] . ".<br /><b>" . $perc2;?>%</b> dos chamados são fechados no 1º Nível." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels[0]['dash02_qtd_fechado'];?></h1>
                <p>Central Serviços</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol yellow">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="value">
                <?php
                $total = $dashPainels[0]['dash01_qtd_aberto'];
                $perc1 = round(($dashPainels[0]['dash03_qtd_aberto'] / $total) * 100,2);
                $total = $dashPainels[0]['dash01_qtd_fechado'];
                $perc2 = round(($dashPainels[0]['dash03_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class=" count3 popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels[0]['dash03_qtd_aberto'] . ".<br /><b>" . $perc1;?>%</b> dos chamados são abertos no 2º Nível." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels[0]['dash03_qtd_aberto'];?></h1>
                <h1 class=" count3 popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels[0]['dash03_qtd_fechado'] . ".<br /><b>" . $perc2;?>%</b> dos chamados são fechados no 2º Nível." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels[0]['dash03_qtd_fechado'];?></h1>
                <p>Suporte 2º Nível/+Subfilas</p>
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
                $total = $dashPainels[0]['dash01_qtd_aberto'];
                $perc1 = round(($dashPainels[0]['dash04_qtd_aberto'] / $total) * 100,2);
                $total = $dashPainels[0]['dash01_qtd_fechado'];
                $perc2 = round(($dashPainels[0]['dash04_qtd_fechado'] / $total) * 100,2);
                ?>
                <h1 class=" count4 popovers" data-original-title="Chamados Abertos" data-content="Quantidade de chamados abertos no período: <?php echo $dashPainels[0]['dash04_qtd_aberto'] . ".<br /><b>" . $perc1;?>%</b> dos chamados são abertos no 3º Nível." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels[0]['dash04_qtd_aberto'];?></h1>
                <h1 class=" count4 popovers" data-original-title="Chamados Fechados" data-content="Quantidade de chamados encerrados no período: <?php echo $dashPainels[0]['dash04_qtd_fechado'] . ".<br /><b>" . $perc2;?>%</b> dos chamados são fechados no 3º Nível." data-placement="top" data-trigger="hover" data-html="true"><?php echo $dashPainels[0]['dash04_qtd_fechado'];?></h1>
                <p>3º Nível/+Subfilas</p>
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
                    $options = CHtml::listData($cmbAgents,'user_id','full_name');
                    $options[''] = '< Todos >';
                    asort($options);
                    echo CHtml::dropDownList('cmbAgents', $model->userId, $options,
                            array('class'=>'styled hasCustomSelect'));
                    ?>
                </div>
            </div>
            <table id="attendeeAgents" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Atendente</th>
                        <th>Criados</th>
                        <th>Encerrados</th>
                        <th>Abertos</th>
                        <th>Pendentes</th>
                        <th>Resolvidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dashAgents as $value){
                        echo "<tr><td>".$value['user_name'] . "</td>";
                        echo "<td>".$value['qtd_criado'] . "</td>";
                        echo "<td>".$value['qtd_encerrado'] . "</td>";
                        echo "<td>".$value['qtd_aberto'] . "</td>";
                        echo "<td>".$value['qtd_pendente'] . "</td>";
                        echo "<td>".$value['qtd_resolvido'] . "</td></tr>";
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
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Encaminhados por Fila</h1>
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
                foreach ($dashForwQueue as $value){
                    echo "<tr><td>".$value['queue_name'] . "</td>";
                    echo "<td>".$value['qtd'] . "</td></tr>";
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
                    <h1>Violação de SLA por Atendente</h1>
                    <p>SLA de até 4 horas (CS+S2+Subfilas)</p>
                </div>
            </div>
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Atendente</th>
                        <th>IN</th>
                        <th>SS</th>
                        <th style="text-decoration: overline">IN</th>
                        <th style="text-decoration: overline">SS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dashSLA as $value){
                        echo "<tr><td>".$value['user_fullname']."</td>";
                        echo "<td>".$value['qtd_in_filfull']."</td>";
                        echo "<td>".$value['qtd_ss_filfull']."</td>";
                        echo "<td>".$value['qtd_in_violate']."</td>";
                        echo "<td>".$value['qtd_ss_violate']."</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-6">
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
                $lst = $model->dashPqsQuestions();
                foreach ($lst as $value) {
                    // retorna respostas
                    $answers = $model->dashPqsAnswer($value['question_id']);
                    $total = 0;
                    $totalAnswered = 0;
                    $totalNotAnswered = 0;
                    $total = 0;
                    foreach ($answers as $item) {
                        $total += $item['amount'];
                        $totalAnswered += $item['amount_answered'];
                        $totalNotAnswered += $item['amount_not_answered'];
                    }

                    echo "<tr><td><p class=\"text-muted\">".$value['question']."</p></td><td>";

                    if ($value['question_id'] != 10) {
                        // Não é TextArea (Comentário)
                        foreach ($answers as $item) {
                            $perc = ($item['amount'] == 0 ? 0 : round($item['amount'] * 100 / $total, 2));
                            echo $item['answer']." ($perc%)<div class=\"progress progress-sm\">";
                            echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$perc\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $perc%\">";
                            echo "<span class=\"sr-only\">$perc% Complete</span>";
                            echo "</div></div>";
                        }
                    } else {
                        // É TextArea (Comentário)
                        $total = $totalAnswered + $totalNotAnswered;
                        $perc = ($item['amount_answered'] == 0 ? 0 : round($item['amount_answered'] * 100 / $total, 2));
                        // Respondido
                        echo "Respondido ($perc%)<div class=\"progress progress-sm\">";
                        echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$perc\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $perc%\">";
                        echo "<span class=\"sr-only\">$perc% Complete</span>";
                        echo "</div></div>";

                        $perc = ($item['amount_not_answered'] == 0 ? 0 : round($item['amount_not_answered'] * 100 / $total, 2));
                        // Não respondido
                        echo "Não Respondido ($perc%)<div class=\"progress progress-sm\">";
                        echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$perc\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $perc%\">";
                        echo "<span class=\"sr-only\">$perc% Complete</span>";
                        echo "</div></div>";
                    }

                    echo "</td></tr>";
                }
                ?>
                </tbody></table>
            </div>
        </section>
    </div>
</div>
