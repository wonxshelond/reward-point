<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form TbActiveForm */
?>
<!-- script menangani area form member dan toggle other form -->
<script>
$(document).ready(function(){

$("#Member_income label.inline.radio").addClass("custompadding");
$("#Member_hobby label.inline.checkbox").addClass("custompadding2");
$("#Member_cc label.inline.radio").addClass("custompadding3");
$("#Member_other_hobby").closest("div").prev().closest("div").hide();
$("#Member_other_cc").closest("div").prev().closest("div").hide();

$("#Member_hobby_11").change(function(){

  if (this.checked) {
    $("#Member_other_hobby").closest("div").prev().closest("div").show();
  }else{
    $("#Member_other_hobby").closest("div").prev().closest("div").hide();
  }

})

$("input[name='Member[cc]']").change(function(){

    if(this.id=="Member_cc_8"){
      $("#Member_other_cc").closest("div").prev().closest("div").show();
    }else{
      $("#Member_other_cc").closest("div").prev().closest("div").hide();
    }

});

});
</script>

<!-- style custom area form member -->
<style>
.custompadding{
    width:250px;
    margin-left:8px;
    display:block;
}

.custompadding2{
    width:200px;
    margin-left:8px;
}


.custompadding3{
    width:90px;
    margin-left:8px;
}
</style>
<div class="form" style="overflow: hidden">

<?php
// Register javascript untuk bersih form dan autonumber
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('cleanForm', "

// fungsi untuk membershikan form member
function defaultForm(){
  $('#member-form').each(function(){
      this.reset();
  });
  $('#Member_id_member').prop('disabled',false);
  $('#Member_other_hobby').closest('div').prev().closest('div').hide();
  $('#Member_other_cc').closest('div').prev().closest('div').hide();
  $('#member-form').attr('action','".$this->createUrl('/master/member/create')."');
  $('#btncommand').html('<i class=\"icon-fa-save icon-fa-large\"></i> Save');
  $('#btncommand').prop('disabled',false);

}

// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
  defaultForm();
});");



$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
   'id'                     => 'member-form',
   'layout'                 => TbHtml::FORM_LAYOUT_HORIZONTAL,
   'action'                 => $this->createUrl('/master/member/create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'  => false,
    'enableClientValidation'=> true,
    'htmlOptions'           => array('autocomplete'=>'off'),
)); ?>

   <!-- Message dialog info -->
  <p class="alert alert-info">Fields with <span class="required">*</span> are required.</p>

   <!-- area kiri atas -->
   <div class="span-4" style="width:45%;margin-left:2px;">
    
    <div class="control-group">
        <?php echo TbHtml::label('ID Member <span class="required">*</span>','ID Member',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php 
            $this->widget('yiiwheels.widgets.maskinput.WhMaskInput',
                array(
                    'name'        => 'Member[id_member]',
                    'mask'        => '9999999',
                    'htmlOptions' => array('placeholder' => '')
            )
        );
       ?>
        <?php echo $form->error($model,'id_member');?>
        </div>
    </div>
    
     <?php echo $form->textFieldControlGroup($model,'no_identity',array('span'=>25,'maxlength'=>25)); ?>
     <?php echo $form->textFieldControlGroup($model,'place_birth',array('span'=>25,'maxlength'=>20)); ?>
     <?php echo $form->textFieldControlGroup($model,'citizenship',array('span'=>25,'maxlength'=>15)); ?>
     <?php echo $form->inlineRadioButtonListControlGroup($model,'gender',array('Male','Female')); ?>
     <?php echo $form->dropDownListControlGroup($model,'religion',array('Moslem','Christian','Catholic','Hindu','Budhist')); ?>
     
   </div>
   <!-- akhir area kiri atas -->
   
   <!-- area kanan atas -->
   <div class="span-4" style="width:45%;">

      <?php echo $form->textFieldControlGroup($model,'first_name',array('span'=>25,'maxlength'=>20)); ?>
      <?php echo $form->textFieldControlGroup($model,'family_name',array('span'=>25,'maxlength'=>15)); ?>
      <div class="control-group">
           <?php echo TbHtml::label('Date Birth <span class="required">*</span>','Date_birth',array('class'=>'control-label')); ?>
           <div class="controls">
           <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'       => $model,
            'value'       => $model->date_birth,
            'attribute'   => 'date_birth',
            'htmlOptions' => array('readonly'=>'readonly','style'=>'width:180px;'),
            'options'     => array(
                'dateFormat'     => 'yy-mm-dd',
                'yearRange'      => '-40',
                'changeYear'     => true,
                'changeMonth'    => true,
                'buttonImage'    => './images/calendar.png',
                'buttonImageOnly'=> true,
                'showOn'         => 'button',
                'showButtonPane' => true,
             ),

           ));?>
        <?php echo $form->error($model,'date_birth');?>
        </div>
      </div>
      
      <?php echo $form->textFieldControlGroup($model,'email',array('span'=>25,'maxlength'=>30)); ?>
	 <?php echo $form->textFieldControlGroup($model,'marital_status',array('span'=>25,'maxlength'=>15)); ?>
     <div class="control-group">
         <?php echo TbHtml::label('Children Number','Children Number',array('class'=>'control-label')); ?>
         <div class="controls">
          <?php 
            $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
             array(
                'name'        => 'Member[children_number]',
                'mask'        => '99',
                'htmlOptions' => array('placeholder' => '','class'=>'span1')
             )
           );
          ?>
       <?php echo $form->error($model,'children_number');?>
       </div>
     </div>
     
      
   </div>
   <!-- akhir area kanan atas -->
  
   <!-- area tengah -->
   <div class="span-8" style="width:85%;margin-left:2px;">
        <?php echo $form->textAreaControlGroup($model,'address',array('span'=>7,'maxlength'=>50,'rows'=>3)); ?>
   </div>
   <!-- akhir area tengah -->
   
   <!-- area phone -->
   <div class="span-4" style="width:45%;margin-left:2px">

     <div class="control-group">
     <?php echo TbHtml::label('Phone 1','Phone 1',array('class'=>'control-label')); ?>
     <div class="controls">
        <?php 
        $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Member[phone1]',
                'mask'        => '999999999999',
                'htmlOptions' => array('placeholder' => '','class'=>'span25')
            )
        );
       ?>
        <?php echo $form->error($model,'phone1');?>
        </div>
    </div>

     <div class="control-group">
        <?php echo TbHtml::label('Mobile 1 <span class="required">*</span>','Mobile 1',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php 
        $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Member[mobile1]',
                'mask'        => '999999999999',
                'htmlOptions' => array('placeholder' => '','class'=>'span25')
            )
        );

       ?>
       <?php echo $form->error($model,'mobile1');?>
      </div>
    </div>

   </div>
   <!-- akhir area phone1 -->

   <!-- area phone2 -->
   <div class="span-4" style="width:45%;">

        <div class="control-group">
            <?php echo TbHtml::label('Phone 2','Phone 2',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php 
            $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Member[phone2]',
                'mask'        => '999999999999',
                'htmlOptions' => array('placeholder' => '','class'=>'span25')
            )
        );
       ?>
      <?php echo $form->error($model,'phone2');?>
        </div>
       </div>

        <div class="control-group">
        <?php echo TbHtml::label('Mobile 2','Mobile 2',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php 
          $this->widget(
            'yiiwheels.widgets.maskinput.WhMaskInput',
            array(
                'name'        => 'Member[mobile2]',
                'mask'        => '999999999999',
                'htmlOptions' => array('placeholder' => '','class'=>'span25')
            )
           );
          ?>
        <?php echo $form->error($model,'mobile2');?>
        </div>
    </div>
   </div>
   <!-- akhir area phone2 -->

   <!-- area income -->        
   <div class="span-8" style="width:85%;margin-left:2px;">
       
         <div class="span-2" style="width:800px;margin-left:1px;">
          <?php echo $form->inlineRadioButtonListControlGroup($model,'income',array(
              '<= Rp 2.500.000',
              'Rp 10.000.000 - Rp 25.000.000 ',
              'Rp 2.500.000 - Rp 5.000.000',
              'Rp 25.000.000 - Rp 50.000.000',
              'Rp 5.000.000 - Rp 10.000.000',
              '>= Rp 50.000.000'));?>
         </div>
     
   </div>
    <!-- akhir area income -->
   
   <!-- area hobby -->  
   <div class="span-8" style="width:85%;margin-left:2px;">

      <div class="span-2" style="width:650px;margin-left:1px;">
          <?php echo $form->inlineCheckBoxListControlGroup($model,'hobby',array(
              'Fashion & Accessories', 'Electronic & Gadgets',
              'Salon & beauty','Music & Movie',
              'Sport & Sports wear', 'Book & Stationary',
              'Kids & Toys','Late Night Entertainment',
              'Food & Beverage(restaurant)','Home Furnishing',
              'Food & Beverage (cafe/coffee shop)',
              'Others'));?>
         </div>
      
   </div>
   <!-- akhir area hobby -->  
   
   <!-- area other hobby dan credit card-->  
   <div class="span-8" style="width:85%;margin-left:2px;">

        <?php echo $form->textFieldControlGroup($model,'other_hobby',array('span'=>5,'maxlength'=>20)); ?>
        <div class="span-2" style="width:550px;margin-left:1px;">
        <?php echo $form->inlineRadioButtonListControlGroup($model,'cc',array(
          'BCA','Citibank', 'ANZ',
          'HSBC', 'BII ', 'Mandiri',
          'BNI', 'UOB', 'Other', 'CIMB Niaga', 'AMEX',
        )); ?>
        </div>    
 
   </div>  
   <!-- akhir area other hobby dan credit card -->  
       
    <!-- area other credit card -->
    <div class="span-8" style="width:85%;margin-left:2px;">       
       <?php echo $form->textFieldControlGroup($model,'other_cc',array('span'=>5,'maxlength'=>20)); ?>
    </div>
    <!-- akhir area other credit card -->
           
    <!-- area form action -->  
    <div class="span-8" style="width:100%;margin-left:2px;">

    <?php
        // Meload command button simpan/ubah dan batal di ./view/common/_commandUploadAjax.php
        // @formid id dari form tenant
        // @gridviewid id pada cgridview untuk keperluan refresh tabel
        // @defaultaction action default pada form rule
        $this->renderPartial('//common/_command',array(
            'formid'=>'member-form',
            'gridviewid'=>'member-grid',
            'defaultaction'=>$this->createUrl('/master/member/create'),
            ));

    $this->endWidget(); ?>

    </div>
    <!-- akhir area form action -->

</div><!-- form -->