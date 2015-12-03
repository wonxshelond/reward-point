<?php
/* @var $this MemberController */
/* @var $model Member */
?>


<h4>View Member  <?php echo $model->id_member; ?></h4>

<?php 
$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$model->search(),
    'itemView'=>'_detailView',
)); ?>