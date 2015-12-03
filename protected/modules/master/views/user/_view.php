<?php
/* @var $this UserController */
/* @var $model User */
?>

<h4>View User <?php echo $model->username; ?></h4>

<?php 
$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$model->search(),
    'itemView'=>'_detailView',
)); ?>