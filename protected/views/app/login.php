<?php
// Widget yii berupa modal dialog
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
   'id'      => 'iddialog',
   'options' => array(
        'title'         => 'Please Login First',
        'autoOpen'      => true,
        'modal'         => true,
        'width'         => 500,
        'height'        => 320,
        'draggable'     => false,
        'resizable'     => false,
		'closeOnEscape' => false,
		'beforeclose'   => 'function (event, ui) { return false; }',
		'dialogClass'   => "noclose"
    ),
));

// Menambahkan Active Form
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
 'id'=>'login-form',
 'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
 'action'=>$this->createUrl('/app/login'),
  
 'htmlOptions'=>array('autocomplete'=>'off'),
)); 

echo $form->textFieldControlGroup($model,'username',array('span'=>3,'maxlength'=>20)); 
echo $form->passwordFieldControlGroup($model,'password',array('span'=>3,'maxlength'=>10)); ?>

 <div class="form-actions">
 
<?php

echo TbHtml::submitButton('Login');
// end widget active form
$this->endWidget();

// end widger cjuidialog
$this->endWidget();
?>

</div>