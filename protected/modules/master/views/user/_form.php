<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>



    <?php

// Register javascript untuk bersih form
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('cleanForm', "

// fungsi untuk membershikan form user
function defaultForm(){
  $('#user-form').each(function(){
      this.reset();
  });
  $('#user-form').attr('action','".$this->createUrl('/master/user/create')."');
  $('#btncommand').html('<i class=\"icon-fa-save icon-fa-large\"></i> Save');
  $('#btncommand').prop('disabled',false);
}

// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
  defaultForm();
});");

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
   'id'=>'user-form',
  'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
  'action'=>$this->createUrl('/master/user/create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
  'htmlOptions'=>array('autocomplete'=>'off'),
)); ?>

<!-- Message dialog info -->
<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->textFieldControlGroup($model,'username',array('span'=>3,'maxlength'=>10)); ?>
<?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>35)); ?>
<?php echo $form->passwordFieldControlGroup($model,'password',array('span'=>3,'maxlength'=>10)); ?>
<?php echo $form->passwordFieldControlGroup($model,'repeat_password',array('span'=>3,'maxlength'=>10)); ?>
<?php echo $form->dropDownListControlGroup($model,'level',array(1=>'Admin',2=>'Operator//CS')); ?>

<?php
    // Meload command button simpan/ubah dan batal di ./view/common/_command.php
    // @formid id dari form rule
    // @gridviewid id pada cgridview untuk keperluan refresh tabel
    // @defaultaction action default pada form rule
    $this->renderPartial('//common/_command',array(
        'formid'        => 'user-form',
        'gridviewid'    => 'user-grid',
        'defaultaction' => $this->createUrl('/master/user/create'),
    )); 
    $this->endWidget(); ?>