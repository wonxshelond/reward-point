<?php
/* @var $this VoucherController
 * @var $model Voucher
 * @var $form TbActiveForm
 * 1. Register javascript untuk membersihkan form dan mendapatkan autonumber
 * 2. Tambah Active Form
 * 3. Tambah message dialog untuk sukses dan gagal
 * 4. Tambah command button simpan / ubah dan batal
*/
// Javascript snippet untuk preview gambar voucher sebelum diupload
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('previewImage','$(function(){
    Preview = {
        previewImage: function(obj){
         
          if(!window.FileReader){
            
          } else {
             var reader = new FileReader();
             var target = null;

             reader.onload = function(e) {
              target =  e.target || e.srcElement;
               $("img#preview").prop("src", target.result);
             };
              reader.readAsDataURL(obj.files[0]);
          }
        }
    };
});');

// Register javascript untuk bersih form dan autonumber
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('cleanForm', "

// fungsi untuk membershikan form voucher
function defaultForm(){
  $('#voucher-form').each(function(){
      this.reset();
  });
  $('#voucher-form').attr('action','".$this->createUrl('/master/voucher/create')."');
  $('#btncommand').html('<i class=\"icon-fa-save icon-fa-large\"></i> Save');
  $('#btncommand').prop('disabled',false);
  $('#preview').attr('src','');
}

// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
    // Fungsi untuk mendapatkan autonumber
    $.ajax({
        'type'     : 'GET',
        'dataType' : 'json',
        'url'      : '".$this->createUrl('/master/voucher/autonumber')."',
        'success'  : function(data){
            $('#Voucher_id_voucher').val('').val(data);
        },
    });
    defaultForm();
});");

// Menambahkan Active Form
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'voucher-form',
  'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'action'=>$this->createUrl('/master/voucher/create'),
  'htmlOptions'=>array('autocomplete'=>'off','enctype' => 'multipart/form-data') // penting untuk upload file
)); ?>

<!-- Message dialog info -->
<p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>
   
    <?php echo $form->textFieldControlGroup($model,'id_voucher',array('span'=>1,'readonly'=>'readonly','value'=>$model->autonumber())); ?>
    <?php echo $form->textFieldControlGroup($model,'voucher_name',array('span'=>5,'maxlength'=>35)); ?>
    <div class="control-group">
        <?php echo TbHtml::label('Start Date <span class="required">*</span>','Start_Date',array('class'=>'control-label')); ?>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'       => $model,
            'value'       => $model->start_date,
            'attribute'   => 'start_date',
            'htmlOptions' => array('readonly'=>'readonly'),
            'options'     => array(
                  'dateFormat'      => 'yy-mm-dd',
                  'showOn'          => 'button',
                  'showButtonPane'  => true,
                  'buttonImage'     => './images/calendar.png',
                  'buttonImageOnly' => true,
                  'showAnim'        => 'slideDown',
                  'changeYear'      => true,
                  'changeMonth'     => true,
                  'onSelect'        => 'js:function(dateText,inst){
                      var end_date = $("#Voucher_end_date").val();
                      if (end_date != ""){
                        if (end_date < dateText){
                           errorMsgBox("End date must be greater than start date");
                           $("#Voucher_end_date").val("");
                        }
                      }
                   }',
            ),

            ));?>
        <?php echo $form->error($model,'start_date');?>
        </div>
    </div>
    
    <div class="control-group">
        <?php echo TbHtml::label('End Date <span class="required">*</span>','End_Date',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'       => $model,
            'value'       => $model->end_date,
            'attribute'   =>    'end_date',
            'htmlOptions' => array('readonly'=>'readonly'),
            'options'     => array(
                  'dateFormat'      =>'yy-mm-dd',
                  'showOn'          =>'button',
                  'showButtonPane'  =>true,
                  'buttonImage'     =>'./images/calendar.png',
                  'buttonImageOnly' => true,
                  'showAnim'        =>'slideDown',
                  'changeYear'      => true,
                  'changeMonth'     => true,
                  'onSelect'        => 'js:function(dateText,inst){
                    var start_date = $("#Voucher_start_date").val();
                    if (dateText < start_date){
                        errorMsgBox("End date must be greater than start date");
                        $(this).val("");
                    }
                }',
            ),
                                            
        ));?>
        <?php echo $form->error($model,'end_date');?>
        </div>
    </div>

    <div class="control-group">
        <?php echo TbHtml::label('Point Required <span class="required">*</span>','Point Required',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php 
        $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Voucher[point_required]',
                'mask'        => '11111',
                'htmlOptions' => array('placeholder' => '')
            )
        );

        //echo $form->textFieldControlGroup($model,'point_required',array('span'=>2)); ?>
        <?php echo $form->error($model,'point_required');?>
        </div>
    </div>

    <?php echo $form->fileFieldControlGroup($model,'image',array('span'=>5,'onchange'=>'Preview.previewImage(this)')); ?>
    <div class="control-group">
      <img src="" id="preview" style="width:600px;height:120px;"/>
    </div>

    <?php
        // Meload command button simpan/ubah dan batal di ./view/common/_commandUploadAjax.php
        // @formid id dari form tenant
        // @gridviewid id pada cgridview untuk keperluan refresh tabel
        // @defaultaction action default pada form rule
        $this->renderPartial('//common/_commandUploadAjax',array(
            'formid'        => 'voucher-form',
            'gridviewid'    => 'voucher-grid',
            'defaultaction' => $this->createUrl('/master/voucher/create'),
            ));
        $this->endWidget();
?>

