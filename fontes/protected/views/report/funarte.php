<?php
/* @var $this ReportController */
/* @var $form CActiveForm */
/* @var $model KpiFunarte */

$this->pageTitle = Yii::app()->name . '::Report';
$baseUrl = Yii::app()->theme->baseUrl;
$this->breadcrumbs = array(
    'Relatórios' => array('funarte'),
    'FUNARTE',
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
            <div class="col-lg-1">
                <div class="form-group">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'Indicador'); ?><br>
                    <?php
                        echo $form->dropDownList($model, 'ilha', array(
                            2 => 'INS 02',
                            3 => 'INS 02',
                            5 => 'INS 04/05',
                            6 => 'INS 06',
                            7 => 'INS 07',
                            //9 => 'INS 09',
                            10 => 'INS 10',
                            //11 => 'INS 11',
                            12 => 'INS 12',
                            13 => 'INS 13',
                            //14 => 'INS 14',
                            15 => 'INS 15',
                            16 => 'INS 16',
                            17 => 'INS 17',
                            //18 => 'INS 18',
                            23 => 'INS 23',
                            26 => 'INS 26',
                            27 => 'INS 27',
                            28 => 'Geral'),
                            array('class' => 'form-control'), array(
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('report/ajaxCheckboxService'),
                                'data' => array('form'=> $form ,'ilha' => 'js:this.value'),
                            )));
                        $form->error($model, 'ilha');
                    ?>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo $form->labelEx($model, ''); ?><br>
                    <button type="submit" id="btn-filtrar-report-funarte" class="btn btn-primary">Filtrar</button>
                </div>
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
