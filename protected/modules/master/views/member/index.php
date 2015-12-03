<?php
/* @var $this RuleController */
/* @var $dataProvider CActiveDataProvider */

// mengambil isi dari entry member
ob_start();
  $this->actionCreate();
  $create = ob_get_contents();
ob_get_clean();

// mengambil isi dari list member
ob_start();
$this->actionAdmin();
$admin = ob_get_contents();
ob_get_clean();

// membuat tab entry member dan list member
$icon = '<i class="icon-fa-folder-close"></i> ';
  $this->widget('zii.widgets.jui.CJuiTabs', array(
    'id'=>'tabs',
    'tabs'=>array(
        $icon.'Entry Member'=>array('id'=>'tab1','content'=>$create),
        $icon.'List Member'=>array('id'=>'tab2','content'=>$admin),
    ),
    
  ));

 ?>
