<?php
/* @var $this ReportController */
/* @var $form CActiveForm */
/* @var $model KpiCvm */

$this->pageTitle = Yii::app()->name . '::Report';
$baseUrl = Yii::app()->theme->baseUrl;
$this->breadcrumbs = array(
    'Relatórios' => array('cvm'),
    'CVM',
);
?>

<section class="panel">
    <header class="panel-heading">
        Filtro - Relatório Geral de Atividades - Estatísticas
        <span class="tools pull-right">
            <a class="fa fa-chevron-down" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block;" class="panel-body profile-activity">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'report-form',
            'enableClientValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),
            'method' => 'post',
            'htmlOptions' => array('class' => 'role'),
        ));
        ?>

        <div class="alert alert-block alert-danger fade in <?php echo (!$model->hasErrors()?'hide':''); ?>">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <?php echo $form->errorSummary($model); ?>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                        <?php echo $form->labelEx($model, 'dtInicio'); ?>
                        <?php echo $form->textField($model, 'dtInicio', array('class' => 'form-control form-control-inline input-medium default-date-picker')); ?>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'dtTermino'); ?>
                    <?php echo $form->textField($model, 'dtTermino', array('class' => 'form-control form-control-inline input-medium default-date-picker')); ?>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">

                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <?php
                    echo $form->dropDownList($model, 'ilha', array(
                        1 => '7.1 Ilha Suporte Soluções Comeciais',
                        2 => '7.2 Ilha Suporte Soluções Corporativas',
                        3 => '7.3 Ilha Suporte Local(RJ,SP,DF)',
                        4 => '7.4 Ilha Administração de Redes Locais',
                        5 => '7.5 Ilha Monitoramento & Gestão Telessuporte',
                        6 => '7.6 Ilha Monitoramento & Gestão Suporte Local e Redes Locais',
                        7 => '7.7 Ilha Monitoramento & Gestão ITSM',
                        8 => '7.8 Ilha Monitoramento & Gestão Service Desk'), array(
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('report/ajaxCheckboxService'),
                            'update' => '#lista_service',
                            'data' => array('form'=> $form ,'ilha' => 'js:this.value'),
                        )));
                    $form->error($model, 'ilha');
                    ?>
                </div>
                <div class="form-group">

                </div>
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-2">
                <div id="lista_service">
                    <?php
                    if ($model->ilha == 4) {
                        $data = $model->listaOtrsServico();
                        $data = CHtml::listData($data, 'service_id', 'service_name');
                        echo $form->dropDownList($model, 'servicesIds', $data, array('multiple' => true));
                    }
                    $form->error($model, 'servicesIds');
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</section>
<?php
    if ($model->validate()){
        echo '<script>window.open("' . $uri . '","_blank");</script>';
    }
?>