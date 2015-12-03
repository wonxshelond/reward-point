<?php
   $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
   'id'=>'user-form',
  'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
  'action'=>$this->createUrl('/transaction/changePassword/save'),
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

<div class="control-group">
     
        <div class="controls">
       
			<input type="hidden" name="username" value="<?php echo $model->username; ?>" />
        </div>
    </div>
<div class="control-group">
         <?php echo TbHtml::label('Old Password','Old Password',array('class'=>'control-label')); ?>
        <div class="controls">
       
			<input type="password" name="old_password" value="" class="span3"/>
        </div>
    </div>
<?php echo $form->passwordFieldControlGroup($model,'password',array('span'=>3,'maxlength'=>10,'value'=>'')); ?>
<?php echo $form->passwordFieldControlGroup($model,'repeat_password',array('span'=>3,'maxlength'=>10)); ?>


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