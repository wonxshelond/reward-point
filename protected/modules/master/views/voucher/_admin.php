<?php
/* @var $this VoucherController 
 * @var $model Voucher 
 * 1. Tambah form untuk pencarian data 
 * 2. Tambah modal dialog untuk menampilkan detail data voucher
 * 3. Tambah javascript handler untuk klik icon update pada tabel gridview data voucher
 * 4. Tambah CGridView data voucher dengan text header ditengah dan custom view & delete handler
 */
?>

<h4>Search Voucher</h4>

<?php
// meload form pencarian data rule di ./views/common/_search.php
$this->renderPartial('//common/_search',array(
    'model'     => $model,
    'gridid'    => 'voucher-grid',
    'attribute' => 'voucher_name',
));

// meload modal dialog di ./views/common/_modal.php
$this->renderPartial('//common/_modal');


// Javascript handler pada saat icon update ditable gridview diklik
$updateHandler='
 defaultForm();
 
 $("#Voucher_id_voucher").val(data.id_voucher);
 $("#Voucher_voucher_name").val(data.voucher_name);
 $("#Voucher_start_date").val(data.start_date);
 $("#Voucher_end_date").val(data.end_date);
 $("#Voucher_point_required").val(data.point_required);
 if(data.image){
   $("#preview").prop("src","'.Yii::app()->baseUrl.'/uploads/"+data.image);
 }
 

 $("#voucher-form").attr("action","'.$this->createUrl('/master/voucher/update&id=').'"+$("#Voucher_id_voucher").val());';

// Table gridview untuk menampilkan data voucher
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'voucher-grid',
    'dataProvider'=>$model->search(),
    'type'=>'striped bordered',
    'columns'=>array(
    CAdditional::numberColumn(),
    'voucher_name',
    array(
      'header'            => 'Start Date',
      'value'             => 'date(\'d F Y\',strtotime($data->start_date))',
      'headerHtmlOptions' => CAdditional::$center,
    ),
    array(
      'header'            => 'End Date',
      'value'             => 'date(\'d F Y\',strtotime($data->end_date))',
      'headerHtmlOptions' => CAdditional::$center,
    ),
    array(
      'header'            => 'Point Required',
      'value'             => '$data->point_required',
      'headerHtmlOptions' => CAdditional::$center,
      'htmlOptions'       => CAdditional::$center,
    ),
    array(
      'class'             => 'bootstrap.widgets.TbButtonColumn',
      'header'            => 'Action',
      'headerHtmlOptions' => CAdditional::$center,
      'htmlOptions'       => CAdditional::$center,
      'buttons'           => array(
        'update' => CAdditional::updateHandlerColumn($updateHandler),
        'view'   => CAdditional::viewHandlerColumn(),
        'delete' => CAdditional::deleteHandlerColumn('voucher-grid'),
            ),
        ),
    ),
)); ?>