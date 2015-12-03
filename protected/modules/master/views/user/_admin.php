<?php
/* @var $this UserController */
/* @var $model User */
?>

<h4>Search User</h4>

<?php
// meload form pencarian data rule di ./views/common/_search.php
$this->renderPartial('//common/_search',array(
    'model'     => $model,
    'gridid'    => 'user-grid',
    'attribute' => 'name',
));

// meload modal dialog di ./views/common/_modal.php
$this->renderPartial('//common/_modal');


// Javascript handler pada saat icon update ditable gridview diklik
$updateHandler='
 defaultForm();
 
 $("#User_username").val(data.username);
 $("#User_name").val(data.name);
 $("#User_level").val(data.level);
 $("#user-form").attr("action","'.$this->createUrl('/master/user/update&id=').'"+$("#User_username").val());';

// Table gridview untuk menampilkan data tenant
 $this->widget('bootstrap.widgets.TbGridView',array(
    'id'           => 'user-grid',
    'dataProvider' => $model->search(),
    'type'         =>'striped bordered',
    'columns'      => array(
       CAdditional::numberColumn(),
       'username',
       'name',
       array(
          'header'            => 'Level',
          'value'             => '$data->level==1?\'Admin\':\'Operator\\CS\'',
         
          'htmlOptions'       => CAdditional::$center,
       ),
       array(
          'header'            => 'Active',
          'value'             => '$data->active==1?\'Active\':\'Non-Active\'',
          
          'htmlOptions'       => CAdditional::$center,
       ),
       array(
          'class'             => 'bootstrap.widgets.TbButtonColumn',
          'header'            => 'Action',
          'headerHtmlOptions' => CAdditional::$center,
          'htmlOptions'       => CAdditional::$center,
          'buttons'           => array(
            'update' => CAdditional::updateHandlerColumn($updateHandler),
            'view'   => CAdditional::viewHandlerColumn(),
            'delete' => CAdditional::deleteHandlerColumn('user-grid'),
            ),
       ),
    ),
)); ?>