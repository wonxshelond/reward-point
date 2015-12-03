<?php
/* @var $this AddPointController */

$addToListHandler = '
 var id_receipt2     = $("#id_receipt").val().trim();
 var receipt_date2   = $("#receipt_date").val().trim();
 var total_purchase2 = $("#total_purchase").val().trim();
 var payment2        = $("#payment").val().trim();
 var tenant2         = $("#tenant").val().trim();
 var pointearned2    = $("#pointearned").val().trim(); 
 var id_member       = $("#id_member").val().trim(); 
 
 if (id_receipt2 == "" || receipt_date2 == "" || total_purchase2 == "" || payment2 == "" || tenant2 == "" || pointearned2 == "" || id_member == ""){
     errorMsgBox("Form Must Be Filled");
 }else{
 
 var tableList = $("tbody#addtolistbody tr");
 var duplicate = false;
 
 $(tableList).each(function(key,val){
     var tds           = $(this).find("td");
     var td_id_receipt = tds.eq(0).text().trim();
     
     if (id_receipt2 == td_id_receipt) {
       errorMsgBox("ID receipt " + id_receipt2 + " already exists in table");
       duplicate = true;
     }
 });



 if (!duplicate){
 
 var id_receipt     = id_receipt2+" <input name=\'id_receipt_list[]\' type=\'hidden\' value=\'"+id_receipt2+"\' />";
 var receipt_date   = receipt_date2+" <input name=\'receipt_date_list[]\' type=\'hidden\' value=\'"+receipt_date2+"\' />";
 var total_purchase = total_purchase2+" <input name=\'total_purchase_list[]\' type=\'hidden\' value=\'"+total_purchase2.replace(/\./g,\'\')+"\' />";
 var payment        = $("#s2id_payment a").text()+" <input name=\'id_rule_list[]\' type=\'hidden\' value=\'"+payment2+"\' />";
 var tenant         = $("#s2id_tenant a").text()+" <input name=\'id_tenant_list[]\' type=\'hidden\' value=\'"+tenant2+"\' />";
 var point          = pointearned2+" <input name=\'pointearned_list[]\' type=\'hidden\' value=\'"+pointearned2+"\' />";
 
 
 
 
 var tableBuilder = "<tr onclick=\'hapusbaris(this,"+pointearned2+")\'><td>"+id_receipt+"</td><td>"+receipt_date+"</td><td>"+tenant+"</td>";
 tableBuilder += "<td>"+payment+"</td><td>"+total_purchase+"</td><td>"+point+"</td></tr>";
 
 $("#addtolistbody").append(tableBuilder);
 $("#table_length").val(parseInt($("#table_length").val())+1);
 $("#point").val(parseInt($("#point").val()) + parseInt(pointearned2));
 var total = parseInt($("#grandtotal").text()) + parseInt(pointearned2);
 $("#grandtotal").text(total);
 cleanReceipt();
  }
 }
';

$rd = date('Y-m-d');
Yii::app()->clientScript->registerScript('cleanForm', "



// fungsi untuk membersihkan form transaksi add point
function cleanReceipt(){
 $('#id_receipt').val('');
 $('#receipt_date').val('".$rd."');
 $('#total_purchase').val('');
 $('#pointearned').val('');

 if ($('#payment').val().length !== 0  ){

    $('#payment').select2('data',null,false);
   
 }

 if ($('#tenant').val().length !== 0) {
	$('#tenant').select2('data',null,false);
 }
 
}

// Aksi pada saat tombol add to list diklik
$('#addtolist').click(function(e){
  e.preventDefault();
  ".$addToListHandler."
  
});

$('#total_purchase').on('blur',function(){

    var total_purchase = this.value.replace(/\./g,'').trim();

    if (total_purchase.length !== 0) {

        if (total_purchase < 150000) {

            errorMsgBox('Total purchase must be at least Rp 150.000');
            $('#total_purchase').val('');
            $('#pointearned').val('');
            return false;               
            

        }

		if (total_purchase > 10000000) {
			errorMsgBox('Maximum input is Ten Million');
			$(this).val(10000000);
			$(this).maskMoney('mask');
            $('#pointearned').val('');
            return false;  
		}
    }
});

// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
  defaultFormMember();
  cleanReceipt();
  $('#grandtotal').text('0');
  $('tbody#addtolistbody').empty();
  $('#table_length').val('0');
  $('#btncommand').prop('disabled',false);
});");

$handler = "
 var idmember = $('#id_member').val();
 $.ajax({
	'dataType':'json',
	'url':'?r=/transaction/AddPoint/cekTrans',
	'data':{id_member:idmember},
	'success':function(data){
		if (data) {
			errorMsgBox('Maximum Transaction Reached !');
			$('#btncommand').prop('disabled',true);
		}
	}

 });
 
";
$this->renderPartial('//common/_member',array('additionalHandler'=>$handler));
?>
<script>
function hapusbaris(obj,nominal){
  var that = obj;
  var point = nominal;
  bootbox.confirm('<h4 style=\'text-align:center\'>Are you sure want to delete this row ?</h4>', function(result) {
    if (result){
                          
        $(that).remove();
        $("#table_length").val(parseInt($("#table_length").val())-1);
        $("#point").val(parseInt($("#point").val()) - point);
        $('#grandtotal').text($('#grandtotal').text()-point)
                        
    }
  }).find('.btn-primary').removeClass('btn-primary')
    .addClass('btn-inverse btn-large').css({'margin-right':'265px'}).text('Yes').prev()
    .addClass('btn-large').text('No').css({'margin-right':'-145px'})
    .parent('div').parent('div').css({'margin-top':function(){return ($(this).outerHeight())}});
  
}

</script>

<br/>

<fieldset>
 <legend></legend>
 <?php echo TbHtml::formTb(TbHtml::FORM_LAYOUT_HORIZONTAL,$this->createUrl('/transaction/AddPoint/save'),'post',array('id'=>'form-addpoint')); ?>
  <div class="span-4" style="margin-left:-2px;width:45%;float:left;">
     <?php echo TbHtml::textFieldControlGroup('id_receipt','',array('label' => 'ID Receipt','maxlength'=>15)); ?>
    <div class="control-group">
        <?php echo TbHtml::label('Total Purchase','Total Purchase',array('class'=>'control-label')); ?>
       <div class="controls">
        <?php $this->widget('yiiwheels.widgets.maskmoney.WhMaskMoney', array(
                'name' => 'total_purchase',
                'pluginOptions'=>array('thousands'=>'.','decimal'=>'','precision'=>0),
    )); ?>
       
      </div></div>
     <div class="control-group">
        <?php echo TbHtml::label('Payment','Payment',array('class'=>'control-label')); ?>
       <div class="controls">
        
        <?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'name'           => 'payment',
                'events'         => array(
                    'change'  => "js:function (element) {
                                
                        var total_purchase = $('#total_purchase').val().replace(/\./g,'').trim();
                           
                        if (total_purchase.length !== 0) {
                               
                                var id=element.val.split('-');
                                $('#payment').val(id[0]);
                                    
                                var point = id[1];

								var max_purchase = 0;
								var tableList = $('tbody#addtolistbody tr');
								$(tableList).each(function(key,val){
									var tds           = $(this).find('td');
									max_purchase += parseInt(tds.eq(4).text().replace(/\./g,'').trim()); 
								});

								if (max_purchase >= 10000000) {

									errorMsgBox('Maximum Total Purchase Reached');
									return false;
								}
								
								var pointearned = 0;
								var cek_max = parseInt(total_purchase) + max_purchase;
								if (cek_max >= 10000000) {
									
									var reduce = cek_max % 10000000;
									var reduce_total_purchase = total_purchase - reduce;

									pointearned = (reduce_total_purchase / 50000) * point;
									$('#total_purchase').val(reduce_total_purchase);
									$('#total_purchase').maskMoney('mask');

								}else{
									pointearned = (total_purchase / 50000) * point;
								}

                                
                                $('#pointearned').val(Math.floor(pointearned)); 

                        }
                                
                    }",
                ),
                'pluginOptions'     => array(
                    'width'         => '90%',
                    'initSelection' => 'js:function(element,callback){}',
                        'ajax' => array(
                            'url'      => $this->createUrl('/transaction/AddPoint/GetRule'),
                            'dataType' => 'json',
                            'data'     => "js: function(term,page) {
                            return {q: term};
                         }",
                        'results'  => "js: function(data,page){
                            return {results: data};
                        }",
                     ),
                )
              )
            ); ?>
       
      </div></div>
   </div>

    <div class="span-4" style="margin-left:-2px;width:45%;float:right;">
      <!--<div class="control-group">
            <?php //echo TbHtml::label('Receipt Date','Receipt_Date',array('class'=>'control-label')); ?>
        <div class="controls">
            <?php //$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    /*'name'        => 'receipt_date',
                    'htmlOptions' => array('readonly'=>'readonly','style'=>'width:180px'),
                    'options'     => array(
                        'dateFormat'      => 'yy-mm-dd',
                        'yearRange'       => '-2',
                        'changeYear'      => true,
                        'changeMonth'     => true,
                        'buttonImage'     => './images/calendar.png',
                        'buttonImageOnly' => true,
                        'showOn'          => 'button',
                        'showButtonPane'  => true,
						//'maxDate'		  => '0',
                    ),
                                            
                  ));*/?>
        
        </div>
        </div>-->
		 <?php echo TbHtml::textFieldControlGroup('receipt_date',date('Y-m-d'),array('label' => 'Receipt Date','readonly'=>true)); ?>
      
      <div class="control-group">
        <?php echo TbHtml::label('Tenant','Tenant',array('class'=>'control-label')); ?>
       <div class="controls">
       
        <?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'name'           => 'tenant',
                'pluginOptions'  => array(
                    'width'         => '90%',
                    'initSelection' => 'js:function(element,callback){}',
                    'ajax'          => array(
                         'url'       => $this->createUrl('/transaction/AddPoint/GetTenant'),
                          'dataType' => 'json',
                          'data'     => "js:function(term,page) {
                             return {q: term};
                           }",
                          'results' => "js:function(data,page) {
                             return {results: data};
                           }",
                    ),
                )
              )
            ); ?>
       
      </div></div>

       <?php echo TbHtml::textFieldControlGroup('pointearned','',array('label' => 'Point','readonly'=>true)); ?>
       
    </div>

    <div class="span-8" style="margin-left:-2px">
       <?php echo TbHtml::button('Add To List',array('style'=>'width:930px','id'=>'addtolist')); ?>
    </div>

    <div class="span-8" style="margin-left:-2px;margin-top:15px;">
      <input type="hidden" id="table_length" name="table_length" value="0"/>
      <table class="items table table-striped table-bordered" style="width:930px">
       <thead>
        <tr><th>ID Receipt</th><th>Receipt Date</th><th>Tenant</th><th>Payment</th><th>Total Purchase</th><th>Point Earned</th></tr>
      </thead>
      <tbody id="addtolistbody">
        
      </tbody>
      </table>
     <h5 style="text-align:right;margin-right:120px">Grand Total Point Earned : <span id="grandtotal">0</span></h5>
    </div>

  <div class="span-8" style="margin-left:-2px;margin-top:15px;">
   <div class="form-actions" style="width:730px;">
     <?php echo TbHtml::ajaxSubmitButton('<i class="icon-fa-save icon-fa-large" style="margin-top:7px;"></i> Save','js:$("#form-addpoint").attr("action")',array(

        'type'      => 'POST',
        'data'      => 'js:$("#form-addpoint").serialize()+"&"+$.param({"id_member":$("#id_member").val().trim()})',
        'dataType'  => 'json',
        'success'   => 'function(data){
            
           confirmMsgBox(data);
            

            $("#btncancel").trigger("click");
			$("html, body").animate({ scrollTop: 0 }, "slow");

         }',
        'error'     => 'function(data){
			
           errorMsgBox("Transaction add point failed, please try again!");
			$("html, body").animate({ scrollTop: 0 }, "slow");
         }',

         ),
         array( 
            'color' => TbHtml::BUTTON_COLOR_INVERSE,
            'size'  => TbHtml::BUTTON_SIZE_LARGE,
            'id'    => 'btncommand'));  

        echo "&nbsp;&nbsp;";

       // Tombol untuk batal
       echo TbHtml::resetButton('<i class="icon-fa-remove-circle icon-fa-large" style="margin-top:7px;"></i> Cancel',array(
            'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
            'size'=>TbHtml::BUTTON_SIZE_LARGE,
            'id'=>'btncancel',

        )); ?>
   </div>
 </div>
<?php echo TbHtml::endForm(); ?>
</fieldset>

 
 
 