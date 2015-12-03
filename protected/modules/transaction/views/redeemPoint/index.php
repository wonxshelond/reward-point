<?php
/* @var $this AddPointController */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/html5number.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/html5number.js');
 
$addToListHandler = '
 var id_voucher2     = $("#voucher_name").val().trim();
 var voucher_name    = $("#s2id_voucher_name a span").text();
 var point_required2 = $("#point_required").val().trim();
 var number_voucher2 = $("#number_voucher").val().trim();
 var total_redeem2   = $("#total_redeem").val().trim();


 if (id_voucher2 == "" || number_voucher2 == "" || number_voucher2 == "0" || total_redeem2 == "0"){
     errorMsgBox("Form Must Be Filled");
 }else{
 
 var tableList = $("tbody#addtolistbody tr");
 var duplicate = false;
 $(tableList).each(function(key,val){
     var tds = $(this).find("td");
     var td_id_voucher = tds.eq(0).text().trim();
    
     if (id_voucher2 == td_id_voucher) {
      errorMsgBox("Voucher " + voucher_name + " already exists in table");
      duplicate = true;
     }
 });
 
 if (!duplicate){
 
 var id_voucher = voucher_name+" <input name=\'id_voucher_list[]\' type=\'hidden\' value=\'"+id_voucher2+"\' />";
 var point_required = point_required2+" <input name=\'point_required_list[]\' type=\'hidden\' value=\'"+point_required2+"\' />";
 var number_voucher = number_voucher2+" <input name=\'number_voucher_list[]\' type=\'hidden\' value=\'"+number_voucher2+"\' />";
 var total_redeem = total_redeem2+" <input name=\'total_redeem_list[]\' type=\'hidden\' value=\'"+total_redeem2+"\' />";

 
 
 
 var tableBuilder = "<tr onclick=\'hapusbaris(this,"+total_redeem2+")\'><td>"+id_voucher+"</td><td>"+point_required+"</td><td>"+number_voucher+"</td>";
 tableBuilder += "<td>"+total_redeem+"</td></tr>";
 
 $("#addtolistbody").append(tableBuilder);
 $("#table_length").val(parseInt($("#table_length").val())+1);
 var total = parseInt($("#grandtotal").text()) + parseInt(total_redeem);
 $("#grandtotal").text(total);
 cleanRedeem();
  }
 }

';

Yii::app()->clientScript->registerScript('cleanForm', "


// fungsi untuk membersihkan form transaksi redeem point
function cleanRedeem(){
 
 if ($('#voucher_name').val().length !== 0) {
    $('#voucher_name').select2('data',null,false);
 }
 $('#point_required').val('');
 $('#number_voucher').val('');
 $('#total_redeem').val('');
}

// Aksi pada saat tombol add to list diklik
$('#addtolist').click(function(e){
  e.preventDefault();
  ".$addToListHandler."
  
});

$('#number_voucher').on('change',function(){

  

  var val=$(this).val();

  if (val != '' || val != '0') {
    if ($('#id_member').val() == '') {

      errorMsgBox('ID Member Required');
      $(this).val('');

    }else if($('#point_required').val()=='') {

      errorMsgBox('Please Choose Voucher');
      $(this).val('')

    }else{

       var old_point = ($('#total_redeem').val()=='')?0:parseInt($('#total_redeem').val());
       var point_member = parseInt($('#point').val()) + old_point;
       var point_required = parseInt($('#point_required').val()) * val;
       var reduce_point = point_member - point_required;
       
       if(point_member < point_required || reduce_point < 0) {

         errorMsgBox('Member point is not enough!');
         $(this).val(val-1);

       }else{

         $('#point').val(reduce_point);
         $('#total_redeem').val(point_required);

       }
    }
  }
});

// Aksi pada saat tombol cancel diklik
$('#btncancel').click(function(e){
  e.preventDefault();
  defaultFormMember();
  cleanRedeem();
  $('#grandtotal').text('0');
  $('tbody#addtolistbody').empty();
});");



$handler = "
 var point = parseInt($('#point').val());
 if (point < 300){
   $('.alert-error').text('Member\'s point is not enought need at least 300 points').show();
  
   $('#btncommand').prop('disabled',true);
 }
";
?>
<p class="alert alert-error" style="display:none"></p>
<?php
$this->renderPartial('//common/_member',array('additionalHandler'=>$handler));
?>
<script>

function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);


if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;
else if ((('0123456789').indexOf(keychar) > -1))
   return false;
else
   return false;

}

function hapusbaris(obj,nominal){
  var that = obj;
  var point = nominal;
  bootbox.confirm('<h4 style=\'text-align:center\'>Are you sure want to delete this row ?</h4>', function(result) {
    if (result) {
                          
        $(that).remove();
        $("#table_length").val(parseInt($("#table_length").val())-1);
        $("#point").val(parseInt($("#point").val()) + point);
        $('#grandtotal').text($('#grandtotal').text()-point)
    }
  }).find('.btn-primary').removeClass('btn-primary')
    .addClass('btn-inverse btn-large').css({'margin-right':'265px'}).text('Yes').prev()
    .addClass('btn-large').text('No').css({'margin-right':'-145px'}).parent('div')
    .parent('div').css({'margin-top':function(){return ($(this).outerHeight())}});
  
}
</script>

<br/>

<fieldset>
 <legend></legend>
 <?php echo TbHtml::formTb(TbHtml::FORM_LAYOUT_HORIZONTAL,$this->createUrl('/transaction/RedeemPoint/save'),'post',array('id'=>'form-redeem-point')); ?>
  <div class="span-4" style="margin-left:-2px;width:45%;float:left;">
   
     <div class="control-group">
       <?php echo TbHtml::label('Voucher Name','Voucher Name',array('class'=>'control-label')); ?>
       <div class="controls">
        
       <?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'name'           => 'voucher_name',
                'events'         => array(
                'change'         => "js:function (element) {
                    
                    if (element.val != '') {

                        var id=element.val.split('-');
                        $('#voucher_name').val(id[0]);
                        $('#point_required').val(id[1]); 
                                    
                    }
 
                 }",
                ),
                'pluginOptions' => array(
                     'width'        =>'90%',
                     'initSelection'=> 'js:function(element,callback){}',
                     'ajax'         =>  array(
                        'url'       => $this->createUrl('/transaction/RedeemPoint/SearchDataVoucher'),
                        'dataType'  =>'json',
                        'data'      => "js: function(term,page) {
                            return {q: term};
                         }",
                        'results' => "js: function(data,page) {
                             return {results: data};
                         }",
                       ),
                )
              )
            ); ?>
       
      </div></div>
     <?php echo TbHtml::textFieldControlGroup('point_required','',array('label' => 'Point Required','readonly'=>'readonly')); ?>
   </div>

    <div class="span-4" style="margin-left:-2px;width:45%;float:right;">
     

      <div class="control-group">
        <?php echo TbHtml::label('Number Voucher','Number Voucher',array('class'=>'control-label')); ?>
       <div class="controls">
        
       <input type="number" min="0" max="999" step="1" name="number_voucher" id="number_voucher"  onKeyPress="return numbersonly(this, event)"/>
       
      </div></div>
       <?php echo TbHtml::textFieldControlGroup('total_redeem','',array('label' => 'Total Redeem','readonly'=>'readonly')); ?>
       
    </div>

    <div class="span-8" style="margin-left:-2px">
       <?php echo TbHtml::button('Add To List',array('style'=>'width:930px','id'=>'addtolist')); ?>
    </div>

    <div class="span-8" style="margin-left:-2px;margin-top:15px;">
      <input type="hidden" id="table_length" name="table_length" value="0"/>
      <table class="items table table-striped table-bordered" style="width:930px">
       <thead>
        <tr><th>Voucher</th><th>Point Required</th><th>Number Voucher</th><th>Total Redeem</th></tr>
      </thead>
      <tbody id="addtolistbody">
        
      </tbody>
      </table>
       <h5 style="text-align:right;margin-right:120px">Grand Total Redeem : <span id="grandtotal">0</span></h5>
    </div>

  <div class="span-8" style="margin-left:-2px;margin-top:15px;">
   <div class="form-actions" style="width:730px;">
    <?php 
    echo TbHtml::ajaxSubmitButton('<i class="icon-fa-save icon-fa-large" style="margin-top:7px;"></i> Save','js:$("#form-redeem-point").attr("action")',array(

        'type'     => 'POST',
        'data'     => 'js:$("#form-redeem-point").serialize()+"&"+$.param({"id_member":$("#id_member").val().trim(),"redeem_point":$("#grandtotal").text().trim()})',
        'dataType' => 'json',
        'success'  => 'function(data){
           
            confirmMsgBox(data);
            $("#btncancel").trigger("click");
			 $("html, body").animate({ scrollTop: 0 }, "slow");

        }',
        'error'   => 'function(data){
           errorMsgBox("Transaction redeem point failed, please try again!");
		    $("html, body").animate({ scrollTop: 0 }, "slow");
        }',
         ),
         array( 
            'color' => TbHtml::BUTTON_COLOR_INVERSE,
            'size'  => TbHtml::BUTTON_SIZE_LARGE,
            'id'    => 'btncommand'));  echo "&nbsp;&nbsp;";
       // Tombol untuk batal
       echo TbHtml::resetButton('<i class="icon-fa-remove-circle icon-fa-large" style="margin-top:7px;"></i> Cancel',array(
            'color' => TbHtml::BUTTON_COLOR_DEFAULT,
            'size'  => TbHtml::BUTTON_SIZE_LARGE,
            'id'   => 'btncancel',

        ));
       ?>
   </div>
 </div>
</fieldset>

 
 
 