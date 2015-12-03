<?php
/* @var $this UpgradeMembershipController */


Yii::app()->clientScript->registerScript('cleanForm', "

// fungsi untuk membershikan form
function defaultForm(){
  $('#form-upgrade-membership').each(function(){
        this.reset();
  });

  $('.alert-error').text('').hide();
  $('#new_id_member').prop('readonly',false);
  $('#btncommand').prop('disabled',false);
  
}



// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
  defaultForm();
  defaultFormMember();
});");

$handler = "
 var type_member = $('#id_member').val().substring(0,1);
 if (type_member=='2'){
   $('.alert-error').text('Member already upgraded').show();
   $('#new_id_member').prop('readonly',true);
   $('#btncommand').prop('disabled',true);
 }
";
?>
<p class="alert alert-error" style="display:none"></p>
<?php
$this->renderPartial('//common/_member',array('additionalHandler'=>$handler));
echo TbHtml::formTb(TbHtml::FORM_LAYOUT_HORIZONTAL,$this->createUrl('/transaction/UpgradeMembership/save'),'post',array('id'=>'form-upgrade-membership'));?>

<?php echo TbHtml::textFieldControlGroup('new_id_member','',array('span'=>3,'label'=>'New ID Member')); ?>

<div class="form-actions">
<?php echo TbHtml::ajaxSubmitButton('<i class="icon-fa-save icon-fa-large" style="margin-top:7px;"></i> Save','js:$("#form-upgrade-membership").attr("action")',array(

        'type'     => 'POST',
        'data'     => 'js:{id_member:$("#id_member").val(),new_id_member:$("#new_id_member").val()}',
        'dataType' => 'json',
        'success'  =>'function(data){
           
            successMsgBox(data.message);
            $("#btncancel").trigger("click");

        }',

         ),
         array( 
            'color'=> TbHtml::BUTTON_COLOR_INVERSE,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'id'   => 'btncommand')); echo "&nbsp;&nbsp;";

        echo TbHtml::resetButton('<i class="icon-fa-remove-circle icon-fa-large" style="margin-top:7px;"></i> Cancel',array(
            'color' => TbHtml::BUTTON_COLOR_DEFAULT,
            'size'  => TbHtml::BUTTON_SIZE_LARGE,
	        'id'    => 'btncancel',

        ));
?>
</div>
<?php echo TbHtml::endForm(); ?>