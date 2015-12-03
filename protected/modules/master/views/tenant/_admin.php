<?php
/* @var $this TenantController 
/* @var $model Tenant 
 * 1. Tambah form untuk pencarian data tenant
 * 2. Tambah modal dialog untuk menampilkan detail data tenant
 * 3. Tambah javascript handler untuk klik icon update pada tabel gridview data tenant
 * 4. Tambah CGridView data tenant dengan text header ditengah dan custom view & delete handler
 */
?>

<h4>Search Tenant</h4>

<?php
// meload form pencarian data rule di ./views/common/_search.php
$this->renderPartial('//common/_search',array(
    'model'    => $model,
    'gridid'   => 'tenant-grid',
    'attribute'=> 'tenant_name',
));

// meload modal dialog di ./views/common/_modal.php
$this->renderPartial('//common/_modal');

// Javascript handler pada saat icon update ditable gridview diklik
$updateHandler='
 defaultForm();
 $.each(data,function(key,val){
   $("#Tenant_"+key).val(val);
 });
 $("#tenant-form").attr("action","'.$this->createUrl('/master/tenant/update&id=').'"+$("#Tenant_id_tenant").val());';

// Table gridview untuk menampilkan data tenant
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'           => 'tenant-grid',
    'type'         => 'striped bordered',
    'dataProvider' => $model->search(),
    'columns'      => array(
        CAdditional::numberColumn(),
        'tenant_name',
        'location',
        'pic',
        'phone',
        array(
            'header'            => 'Action',
            'headerHtmlOptions' => CAdditional::$center,
            'htmlOptions'       => CAdditional::$center,
            'class'             => 'bootstrap.widgets.TbButtonColumn',
			'template'		    => '{update} {delete}',
            'buttons'           => array(
                'update' => CAdditional::updateHandlerColumn($updateHandler),
                'view'   => CAdditional::viewHandlerColumn(),
                'delete' => CAdditional::deleteHandlerColumn('tenant-grid'),
            ),
        ),
    ),
)); ?>