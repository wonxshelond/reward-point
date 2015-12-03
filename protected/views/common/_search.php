<?php
// Javascipt untuk fungsi pencarian ditable gridview
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#".$gridid."').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>
<div class="search-form">
<?php
 echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_SEARCH,Yii::app()->createUrl($this->route),'get',array('autocomplete'=>'off'));
 echo TbHtml::activeSearchQueryField($model,$attribute,array('style'=>'width:50%'));
 echo "&nbsp;&nbsp;&nbsp;";
 echo TbHtml::submitButton('<i class="icon-fa-search icon-fa-large" style="margin-top:5px;"></i> Search',  array('color' => TbHtml::BUTTON_COLOR_INVERSE,));
 echo TbHtml::endForm();
?>
</div>