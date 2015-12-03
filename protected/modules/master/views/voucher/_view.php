<?php
/* @var $this VoucherController */
/* @var $model Voucher */
?>

<h4>View Voucher <?php echo $model->voucher_name; ?></h4>

<?php 
$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$model->search(),
    'itemView'=>'_detailView',
)); ?>