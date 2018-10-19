<?php
/* @var $this ActionController */
/* @var $data Action */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_action')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_action), array('view', 'id'=>$data->id_action)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('controller_action')); ?>:</b>
	<?php echo CHtml::encode($data->controller_action); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ind_status')); ?>:</b>
	<?php echo CHtml::encode($data->ind_status); ?>
	<br />


</div>