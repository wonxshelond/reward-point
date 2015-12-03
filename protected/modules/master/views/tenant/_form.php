<?php
/* @var $this TenantController 
 * @var $model Tenant 
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
  $('#tenant-form').each(function(){
      this.reset();
  });
  $('#tenant-form').attr('action','".$this->createUrl('/master/tenant/create')."');
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
        'url'      : '".$this->createUrl('/master/tenant/autonumber')."',
        'success'  : function(data){
            $('#Tenant_id_tenant').val('').val(data);
        },
    });
    defaultForm();
});");

// Menambahkan Active Form
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
  'id'                     => 'tenant-form',
  'layout'                 => TbHtml::FORM_LAYOUT_HORIZONTAL,
  'action'                 => $this->createUrl('/master/tenant/create'),
  'enableAjaxValidation'   => false,
  'enableClientValidation' => true,
  'htmlOptions'            => array('autocomplete'=>'off')
)); ?>

<!-- Message dialog info -->
<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

  <?php echo $form->textFieldControlGroup($model,'id_tenant',array('span'=>2,'maxlength'=>4,'readonly'=>'readonly','value'=>$model->autonumber())); ?>
  <?php echo $form->textFieldControlGroup($model,'tenant_name',array('span'=>3,'maxlength'=>25)); ?>
  <?php echo $form->textFieldControlGroup($model,'pic',array('span'=>3,'maxlength'=>45)); ?>
  
<div class="control-group">
        <?php echo TbHtml::label('Phone <span class="required">*</span>','Phone',array('class'=>'control-label')); ?>
    <div class="controls">
    <?php 
        $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Tenant[phone]',
                'mask'        => '999999999999',
                'htmlOptions' => array('placeholder' => '')
            )
        );

     ?>
    <?php echo $form->error($model,'phone');?>
    </div>
</div>

  <?php echo $form->textAreaControlGroup($model,'location',array('span'=>5,'maxlength'=>30,'rows'=>5)); ?>
    
  <?php
   // Meload command button simpan/ubah dan batal di ./view/common/_command.php
   // @formid id dari form tenant
   // @gridviewid id pada cgridview untuk keperluan refresh tabel
   // @defaultaction action default pada form rule
   $this->renderPartial('//common/_command',array(
      'formid'        => 'tenant-form',
      'gridviewid'    => 'tenant-grid',
      'defaultaction' => $this->createUrl('/master/tenant/create'),
    )); 
    $this->endWidget();
?>
