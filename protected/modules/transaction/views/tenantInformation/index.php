<style>
 #searchclear {
     
    
      cursor: pointer;
      
    }
</style>

<script>
 $(document).ready(function() {
     
      $('#btncancel').click(function(e) {
		e.preventDefault();
        $('#tenant').val('');
		$('#tenant_name').text('-');
		$('#pic').text('-');
	    $('#phone').text('-');
		$('#location').text('-');
        
      });
    });
</script>

<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_SEARCH); ?>
   <?php echo TbHtml::label('Search Tenant','search_tenant'); ?> &nbsp;&nbsp;
    <?php //echo TbHtml::textField('','',array('class'=>'search-query','span'=>6)); ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name'    => 'tenant',
        'source'  => $this->createUrl('/transaction/TenantInformation/SearchDataTenant'),
        'options' => array(
            'minLength' => '1',
            'select'    => 'js:function(event, ui) { 

            $.ajax({
              "url"      : "?r=/transaction/TenantInformation/SearchDataTenant",
              "data"     : {term:ui.item.id},
              "dataType" : "json",
              "type"     : "GET",
              "success"  : function(data){
               
                  $("#tenant_name").text(data[0].value);
                  $("#pic").text(data[0].pic);
                  $("#phone").text(data[0].phone);
                  $("#location").text(data[0].location);
                  
               }
            });
       }'
        ),
        'htmlOptions'=>array(
			'style'=>'width:60%',
            'class'=>'search-query clearable',
        ),
    ));

     
    echo "&nbsp;&nbsp;"; 
  echo TbHtml::resetButton('<i class="icon-fa-remove-circle icon-fa-large" style="margin-top:5px;"></i> Cancel',array(
            'color'=>TbHtml::BUTTON_COLOR_INVERSE,
            'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
            'id'=>'btncancel',

        ));?> 
<?php echo TbHtml::endForm(); ?>

<fieldset>
  <legend>Data Tenant</legend>
  <?php echo TbHtml::formTb(TbHtml::FORM_LAYOUT_HORIZONTAL,$this->createUrl('master/member/carimember')); ?>
  
  <div class="control-group">
   <?php echo TbHtml::label('Tenant Name','lbltenant_name',array('class'=>'control-label')); ?>
   <div clas="controls">
   <?php echo TbHtml::label('-','tenant_name',array('class'=>'control-label','id'=>'tenant_name'));?>
   </div>
  </div>

  <div class="control-group">
   <?php echo TbHtml::label('PIC','lblpic',array('class'=>'control-label')); ?>
   <div clas="controls">
   <?php echo TbHtml::label('-','pic',array('class'=>'control-label','id'=>'pic'));?>
   </div>
  </div>

<div class="control-group">
   <?php echo TbHtml::label('Telephone','lbltelephone',array('class'=>'control-label')); ?>
   <div clas="controls">
   <?php echo TbHtml::label('-','telephone',array('class'=>'control-label','id'=>'phone'));?>
   </div>
  </div>

<div class="control-group">
   <?php echo TbHtml::label('Location','lbllocation',array('class'=>'control-label')); ?>
   <div clas="controls">
   <?php echo TbHtml::label('-','location',array('class'=>'control-label','id'=>'location'));?>
   </div>
  </div>


  <?php echo TbHtml::endForm(); ?>
</fieldset>