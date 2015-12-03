<?php
/* @var $this RuleController */
/* @var $model Rule */

?>
<h4>View Rule <?php echo $model->rule_name; ?></h4>

<?php 
$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$model->search(),
    'itemView'=>'_detailView',
)); ?>
