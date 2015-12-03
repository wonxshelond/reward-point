<?php
/* @var $this RuleController */
/* @var $dataProvider CActiveDataProvider */

// mengambil isi entry tenant
ob_start();
  $this->actionCreate();
  $create = ob_get_contents();
ob_get_clean();

// mengambil isi list tenant
ob_start();
$this->actionAdmin();
$admin = ob_get_contents();
ob_get_clean();

// membuat tab entry tenant dan list tenant
$icon = '<i class="icon-fa-folder-close"></i> ';
  $this->widget('zii.widgets.jui.CJuiTabs', array(
    'id'=>'tabs',
    'tabs'=>array(
        $icon.'Entry Tenant'=>array('id'=>'tab1','content'=>$create),
        $icon.'List Tenant'=>array('id'=>'tab2','content'=>$admin),
    ),
  ));

 ?>
