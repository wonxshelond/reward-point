<?php
/* @var $this RuleController */
/* @var $dataProvider CActiveDataProvider */

// mengambil isi dari entry user
ob_start();
  $this->actionCreate();
  $create = ob_get_contents();
ob_get_clean();

// mengambil isi dari list user
ob_start();
$this->actionAdmin();
$admin = ob_get_contents();
ob_get_clean();

// membuat tab entry user dan list user
$icon = '<i class="icon-fa-folder-close"></i> ';
  $this->widget('zii.widgets.jui.CJuiTabs', array(
    'id'=>'tabs',
    'tabs'=>array(
        $icon.'Entry User'=>array('id'=>'tab1','content'=>$create),
        $icon.'List User'=>array('id'=>'tab2','content'=>$admin),
    ),
  ));

 ?>
