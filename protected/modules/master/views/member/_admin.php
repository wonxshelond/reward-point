<?php
/* @var $this MemberController 
 * @var $model Member
 * 1. Tambah form untuk pencarian data rule
 * 2. Tambah modal dialog untuk menampilkan detail data rule
 * 3. Tambah javascript handler untuk klik icon update pada tabel gridview data rule
 * 4. Tambah CGridView data rule dengan text header ditengah dan custom view & delete handler
 */
?>
<div style="overflow: hidden">
<h4>Search Member</h4>
<?php
// meload form pencarian data rule di ./views/common/_search.php
$this->renderPartial('//common/_search',array(
 'model'     => $model,
 'gridid'    => 'member-grid',
 'attribute' => 'id_member',
));

// meload modal dialog di ./views/common/_modal.php
$this->renderPartial('//common/_modal');

// Javascript handler pada saat icon update ditable gridview diklik
$updateHandler='
 defaultForm();
 $.each(data,function(key,val){
   $("#Member_"+key).val(val);
 });
 $("#Member_gender_"+data.gender).prop("checked",true);
 $("#Member_income_"+data.income).prop("checked",true);
 $("#Member_cc_"+data.cc).prop("checked",true);
 if (data.cc=="8"){
    $("#Member_other_cc").closest("div").prev().closest("div").show();
 }

 if (data.hobby.length > 0){

   $.each(data.hobby.split(";"),function(key,val){
   
    $("#Member_hobby_"+val).prop("checked",true);
     if (val=="11"){
         $("#Member_other_hobby").closest("div").prev().closest("div").show();
     }
   });

 }

 

 $("#Member_id_member").prop("disabled",true);
 $("#member-form").attr("action","'.$this->createUrl('/master/member/update&id=').'"+$("#Member_id_member").val());';

// Table gridview untuk menampilkan data rule
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'          => 'member-grid',
    'type'        => 'striped bordered',
    'dataProvider'=> $model->search(),
    'columns'     => array(
        CAdditional::numberColumn(),
        'id_member',
        'fullname',
		'labelgender',
		'place_birth',
        'date_birth',
        'citizenship',
		'mobile1',
         array(
            'header'            => 'Action',
            'headerHtmlOptions' => CAdditional::$center,
            'htmlOptions'       => CAdditional::$center,
            'class'             => 'bootstrap.widgets.TbButtonColumn',
            'buttons'=> array(
               'update' => CAdditional::updateHandlerColumn($updateHandler),
               'view'   => CAdditional::viewHandlerColumn(),
               'delete' => CAdditional::deleteHandlerColumn('member-grid'),
            )
        ),
    ),
)); ?>
</div>
<br/>