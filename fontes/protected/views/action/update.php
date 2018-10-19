<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->name=>array('view','id'=>$model->id_action),
	'Update',
);

$this->menu=array(
	array('label'=>'List Action', 'url'=>array('index')),
	array('label'=>'Create Action', 'url'=>array('create')),
	array('label'=>'View Action', 'url'=>array('view', 'id'=>$model->id_action)),
	array('label'=>'Manage Action', 'url'=>array('admin')),
);
?>

<h1>Update Action <?php echo $model->id_action; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>