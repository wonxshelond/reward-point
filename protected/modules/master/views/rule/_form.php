<?php
/* @var $this RuleController
 * @var $model Rule 
 * @var $form TbActiveForm 
 * 1. Register javascript untuk membersihkan form dan mendapatkan autonumber
 * 2. Tambah Active Form
 * 3. Tambah message dialog untuk sukses dan gagal
 * 4. Tambah command button simpan / ubah dan batal
 */

// Register javascript untuk bersih form dan autonumber
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('cleanForm', "

// fungsi untuk membershikan form
function defaultForm(){
  $('#rule-form').each(function(){
        this.reset();
  });
  $('#rule-form').attr('action','".$this->createUrl('/master/rule/create')."');
  $('#btncommand').html('<i class=\"icon-fa-save icon-fa-large\"></i> Save');
  $('#btncommand').prop('disabled',false);
}

// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
   // Fungsi untuk mendapatkan autonumber
    $.ajax({
        'type'     : 'GET',
        'dataType' : 'json',
        'url'      : '".$this->createUrl('/master/rule/autonumber')."',
        'success':function(data){
                $('#Rule_id_rule').val('').val(data);
        },
    });
    // Memanggil fungsi membershikan form
    defaultForm();
});");

// Menambahkan Active Form
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
 'id'                     => 'rule-form',
 'layout'                 => TbHtml::FORM_LAYOUT_HORIZONTAL,
 'action'                 => $this->createUrl('/master/rule/create'),
 'enableAjaxValidation'   => false,
 'enableClientValidation' => true,
 'htmlOptions'            => array('autocomplete'=>'off'),
)); ?>

<!-- Message dialog info -->
<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>


 <?php echo $form->textFieldControlGroup($model,'id_rule',array('span'=>1,'maxlength'=>3,'readonly'=>'readonly','value'=>$model->autonumber())); ?>
 <?php echo $form->textFieldControlGroup($model,'rule_name',array('span'=>3,'maxlength'=>20)); ?>
 
<div class="control-group">
    <?php echo TbHtml::label('Point <span class="required">*</span>','Point',array('class'=>'control-label')); ?>
    <div class="controls">
    <?php 
        $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Rule[point]',
                'mask'        => '9',
                'htmlOptions' => array('placeholder' => '')
            )
        );

       ?>
    <?php echo $form->error($model,'point');?>
   </div>
</div>
 <?php
  // Meload command button simpan/ubah dan batal di ./view/common/_command.php
  // @formid id dari form rule
  // @gridviewid id pada cgridview untuk keperluan refresh tabel
  // @defaultaction action default pada form rule
  $this->renderPartial('//common/_command',array(
    'formid'        => 'rule-form',
    'gridviewid'    => 'rule-grid',
    'defaultaction' => $this->createUrl('/master/rule/create'),
  )); 
  $this->endWidget();
?>