<?php
/* @var $this TenantController */
/* @var $model Tenant */
?>

<h4>View Tenant <?php echo $model->tenant_name; ?></h4>

<?php 
$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$model->search(),
    'itemView'=>'_detailView',
)); ?>
