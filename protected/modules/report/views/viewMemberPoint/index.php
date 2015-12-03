<?php
/* @var $this ViewMemberPointController */
// Javascipt untuk fungsi pencarian ditable gridview
// @parameter1 ID Script
// @paramerer2 Javascript snippet
Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(e){
   e.preventDefault();
   var strcategory = '';
  var nilai = $('#member').val();

if ($('#id_member').is(':checked')) {

  strcategory = 'id_member';

}else if ($('#member_name').is(':checked')) {

  strcategory = 'member_name';

}else{

  errorMsgBox('Please select criteria');
  return false;
}

$('#member-grid').yiiGridView('update', {
		  data: {keyword:nilai,category:strcategory,ajax:'member-grid'},
	});

});
");
?>

<div class="search-form">
<legend>Search Data Member</legend>
<?php
 echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_SEARCH,Yii::app()->createUrl($this->route),'get',array('autocomplete'=>'off'));
 echo TbHtml::textField('member','',array('style'=>'width:50%','class'=>'search-query'));

 echo "&nbsp;&nbsp;&nbsp;";
 echo TbHtml::submitButton('<i class="icon-fa-search icon-fa-large" style="margin-top:5px;"></i> Search',  array('color' => TbHtml::BUTTON_COLOR_INVERSE,));
 echo "<br/><br/>"; 
 echo TbHtml::radioButton('criteria', '',array('label' => 'By ID Member','id'=>'id_member'));
 echo "&nbsp;&nbsp;&nbsp;";
 echo TbHtml::radioButton('criteria', '',array('label' => 'By Name','id'=>'member_name'));
 echo TbHtml::endForm();
?>
</div>
<hr/>

<script>

function cetakStruk(paramurl){
  var xurl = paramurl;
  
  bootbox.confirm('<h4 style=\'text-align:center\'>Are you sure want to print ?</h4>', function(result) {
    if (result){
                          
        $.ajax({
			type:"GET",
			dataType:"json",
			url:xurl,
			success:function(data){
					var x = screen.width/2 - 290/2;
					var y = screen.height/2 - 400/2;
					var printWindow = window.open("", "", "height=400,width=290,left="+x+",top="+y);
					printWindow.document.write(data);
					printWindow.document.close();		
			},
			error:function(data){
				errorMsgBox('An error occured please try again');
			}
		});
                        
    }
  }).find('.btn-primary').removeClass('btn-primary')
    .addClass('btn-inverse btn-large').css({'margin-right':'265px'}).text('Yes').prev()
    .addClass('btn-large').text('No').css({'margin-right':'-145px'})
    .parent('div').parent('div').css({'margin-top':function(){return ($(this).outerHeight())}});
  
}

</script>
<?php
// Table gridview untuk menampilkan data member transaction
 $this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'member-grid',
	'type'=>'striped bordered',
    
	'dataProvider'=>$model->searchPoint(),
	'columns'=>array(
      CAdditional::numberColumn(),
	  'id_member',
      'type_card',
      'first_name',
      'email',
       'point',
		array(
		 'header'=>'Action',
		 'headerHtmlOptions'=>CAdditional::$center,
		 'htmlOptions'=>CAdditional::$center,
		 'class'=>'bootstrap.widgets.TbButtonColumn',
		 'template'=>'{print}',
		 'buttons'=>array(
			 'print' => array(
				'label'=>'Print',
				'icon'=>'icon-print',
				'url'=>'Yii::app()->createUrl("/report/ViewMemberPoint/print",array("id_member"=>$data->id_member))',
				'click'=>'function(e){
					e.preventDefault();
					cetakStruk($(this).attr(\'href\'));
					
				 }',
				
		      ),
		  )
		),
	),
));
?>