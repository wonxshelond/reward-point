<?php
/* @var $this RuleController */
/* @var $dataProvider CActiveDataProvider */

// mengambil isi entry rule
ob_start();
  $this->actionCreate();
  $create = ob_get_contents();
ob_get_clean();

// mengambil isi list rule
ob_start();
$this->actionAdmin();
$admin = ob_get_contents();
ob_get_clean();


// membuat tab menu enyty rule dan list rule
$icon = '<i class="icon-fa-folder-close"></i> ';
  $this->widget('zii.widgets.jui.CJuiTabs', array(
    'id'=>'tabs',
    'tabs'=>array(
        $icon.'Entry Rule'=>array('id'=>'tab1','content'=>$create),
        $icon.'List Rule'=>array('id'=>'tab2','content'=>$admin),
    ),
  ));
 ?>
