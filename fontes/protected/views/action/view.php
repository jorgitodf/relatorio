<?php
/* @var $this ActionController */
/* @var $model Action */

$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Action', 'url'=>array('index')),
	array('label'=>'Create Action', 'url'=>array('create')),
	array('label'=>'Update Action', 'url'=>array('update', 'id'=>$model->id_action)),
	array('label'=>'Delete Action', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_action),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Action', 'url'=>array('admin')),
);
?>

<h1>View Action #<?php echo $model->id_action; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_action',
		'name',
		'controller_action',
		'ind_status',
	),
)); ?>
