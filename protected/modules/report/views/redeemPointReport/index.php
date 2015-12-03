<?php
/* @var $this RedeemPointReportController */
?>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'data-member-report',
   'layout' => TbHtml::FORM_LAYOUT_VERTICAL,
   'action'=>$this->createUrl('/report/RedeemPointReport/viewer'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
  'htmlOptions'=>array('autocomplete'=>'off','target'=>'_blank'),
));
?>
<div class="span-4" style="width:49%;margin-left:2px">
  <div class="control-group" style="margin-left:40%">
		  <?php echo TbHtml::label('Start','Start',array('class'=>'control-label')); ?>
		<div class="controls">
		  <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    
            'htmlOptions'=>array('readonly'=>'readonly','style'=>'width:180px;float:left','name'=>'tglawal'),
		    'options'=>array(
			'dateFormat'=>'yy-mm-dd',	
            'yearRange'=>'-2',
            'changeYear'=>true,
            'changeMonth'=>true,
            'buttonImage'=>'./images/calendar.png',
            'buttonImageOnly'=>true,
            'showOn'=>'button',
            'showButtonPane'=>true,		   
		     ),
										      
		   ));?>
		
		</div>
	  </div>
</div>
<div class="span-4" style="width:49%;margin-left:2px;">
<div class="control-group">
		  <?php echo TbHtml::label('End','End',array('class'=>'control-label')); ?>
		<div class="controls">
		  <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    
            'htmlOptions'=>array('readonly'=>'readonly','style'=>'width:180px;float:left','name'=>'tglakhir'),
		    'options'=>array(
			'dateFormat'=>'yy-mm-dd',	
            'yearRange'=>'-2',
            'changeYear'=>true,
            'changeMonth'=>true,
            'buttonImage'=>'./images/calendar.png',
            'buttonImageOnly'=>true,
            'showOn'=>'button',
            'showButtonPane'=>true,		   
		     ),
										      
		   ));?>
		
		</div>
	  </div>
</div>
<div style="clear:both"></div>
<div class="form-actions">
  <div style="margin-left:35%">
  <?php 
echo TbHtml::submitButton('<i class="icon-fa-print icon-fa-large" style="margin-top:7px;"></i> Print',
         array( 'color'=>TbHtml::BUTTON_COLOR_INVERSE,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
        'id'=>'btncommand'));  echo "&nbsp;&nbsp;";
       // Tombol untuk batal
       echo TbHtml::resetButton('<i class="icon-fa-remove-circle icon-fa-large" style="margin-top:7px;"></i> Cancel',array(
            'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
            'size'=>TbHtml::BUTTON_SIZE_LARGE,
	           'id'=>'btncancel',

        ));
?>
</div>
</div>
<?php $this->endWidget(); ?>