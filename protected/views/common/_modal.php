<?php
// Widget yii berupa modal dialog
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
   'id'=>'iddialog',
   'options'=>array(
        'title'=>'Detail view',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));
$this->endWidget();
?>