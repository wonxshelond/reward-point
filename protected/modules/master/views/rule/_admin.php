<?php
/* @var $this RuleController 
 * @var $model Rule 
 * 1. Tambah form untuk pencarian data rule
 * 2. Tambah modal dialog untuk menampilkan detail data rule
 * 3. Tambah javascript handler untuk klik icon update pada tabel gridview data rule
 * 4. Tambah CGridView data rule dengan text header ditengah dan custom view & delete handler
 */
?>

<h4>Search Rule</h4>

<?php
// meload form pencarian data rule di ./views/common/_search.php
$this->renderPartial('//common/_search',array(
 'model'     => $model,
 'gridid'    => 'rule-grid',
 'attribute' => 'rule_name',
));

// meload modal dialog di ./views/common/_modal.php
$this->renderPartial('//common/_modal');

// Javascript handler pada saat icon update ditable gridview diklik
$updateHandler='
 defaultForm();
 $.each(data,function(key,val){
   $("#Rule_"+key).val(val);
 });
 $("#rule-form").attr("action","'.$this->createUrl('/master/rule/update&id=').'"+$("#Rule_id_rule").val());';

// Table gridview untuk menampilkan data rule
 $this->widget('yiiwheels.widgets.grid.WhGridView',array(
    'id'           => 'rule-grid',
    'type'         => 'striped bordered',
    'dataProvider' => $model->search(),
    'columns'      => array(
      CAdditional::numberColumn(),
     'rule_name',
      array(
        'header'      => 'Point',
        'value'       => '$data->point',
        'htmlOptions' => CAdditional::$center,
      ),
      array(
        'header'           => 'Action',
        'headerHtmlOptions'=> CAdditional::$center,
        'htmlOptions'      => CAdditional::$center,
        'class'            => 'bootstrap.widgets.TbButtonColumn',
		'template'		   => '{update} {delete}',
        'buttons'          => array(
            'update' => CAdditional::updateHandlerColumn($updateHandler),
            'view'   => CAdditional::viewHandlerColumn(),
            'delete' => CAdditional::deleteHandlerColumn('rule-grid'),
         )
      ),
    ),
));
?>