<?php
/* @var $this ReportController */
/* @var $form CActiveForm */
/* @var $model KpiIncra */

$this->pageTitle = Yii::app()->name . '::Report';

$this->breadcrumbs = array(
    'Relatórios' => array('incra'),
    'INCRA',
);
?>

<section class="panel">
    <header class="panel-heading">
        Filtro
        <span class="tools pull-right">
            <a class="fa fa-chevron-down" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: block;" class="panel-body profile-activity">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'filtro-form',
            'method' => 'post',
            'enableClientValidation' => false,
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
            <br/>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</section>
<?php
if ($model->validate()){
    //echo window.open(data, '_self');
    echo '<script>window.open("' . $uri . '","_blank");</script>';
}
?>
