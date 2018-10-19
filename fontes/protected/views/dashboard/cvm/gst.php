<?php
/* @var $this DashboardController */
/* @var $form CActiveForm */
/* @var $model DashboardGst */

$this->pageTitle = Yii::app()->name . '::Dashboard';

$this->breadcrumbs = array(
    'Dashboard' => array('CVM/gst'),
    'GST',
);
?>

<section class="panel">
    <header class="panel-heading">
        Filtro
        <?php
        if ($model->validate())
            echo ' (' . $model->dtInicial . ' - ' . $model->dtFinal . ')';
        ?>
        <span class="tools pull-right">
            <a class="fa fa-chevron-<?php echo ($model->hasErrors() ? 'down' : 'up'); ?>" href="javascript:;"></a>
            <a class="fa fa-times" href="javascript:;"></a>
        </span>
    </header>
    <div style="display: <?php echo ($model->hasErrors() ? 'block' : 'none'); ?>;" class="panel-body profile-activity">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'filtro-form',
            'method' => 'post',
            'enableClientValidation' => false,
            'htmlOptions' => array('class' => 'role'),
        ));
        ?>

        <div class="alert alert-block alert-danger fade in <?php echo (!$model->hasErrors() ? 'hide' : ''); ?>">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <?php echo $form->errorSummary($model); ?>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'dtInicial'); ?>
                    <?php echo $form->textField($model, 'dtInicial', array('class' => 'form-control form-control-inline input-medium default-date-picker')); ?>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'dtFinal'); ?>
                    <?php echo $form->textField($model, 'dtFinal', array('class' => 'form-control form-control-inline input-medium default-date-picker')); ?>
                </div>
            </div>
            <?php echo $form->hiddenField($model, 'userId'); ?>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</section>
<?php
if ($model->validate()) {
    $this->renderPartial('CVM/_gst', array('model' => $model));
}
?>
