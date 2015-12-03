<?php
/* @var $this ViewMemberTransactionController */
$additionalHandler = "
enableMember();
$('#receipt-grid').yiiGridView('update', {
		data: {ajax:'receipt-grid',id_member:$('#id_member').val()},
		
	});

";
$this->renderPartial('//common/_member',array('additionalHandler'=>$additionalHandler));
?>
<h6>List Of Transaction</h6>
<hr/>
<?php
// Table gridview untuk menampilkan data member transaction
 $this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'receipt-grid',
	'type'=>'striped bordered',
    
	'dataProvider'=>$model->search(),
	'columns'=>array(
      CAdditional::numberColumn(),
	  'receipt_date',
      'tenant.tenant_name',
      'rule.rule_name',
      'total_purchase',
      'nominal_point',
      'user.name',
		
	),
));
?>