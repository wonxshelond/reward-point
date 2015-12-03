<?php
Yii::app()->clientScript->registerScript('cleanFormMember', "

// fungsi untuk membershikan form
function defaultFormMember(){
  $('#form-search-member').each(function(){
        this.reset();
  });
 
  enableMember();
}

function disableMember(){
  $('#id_member').prop('readonly',true);
  $('#btn-search-member').prop('disabled',true);
}

function enableMember(){
  $('#id_member').prop('readonly',false);
  $('#btn-search-member').prop('disabled',false);
}

");



?>
<fieldset>
    <legend>Data Member</legend>
    <?php echo TbHtml::formTb(TbHtml::FORM_LAYOUT_HORIZONTAL,$this->createUrl('/master/member/searchmember'),'post',array('id'=>'form-search-member','autocomplete'=>'off')); ?>

    <div class="control-group">
        <?php echo Tbhtml::label('ID Member','id_member',array('class'=>'control-label','maxlength'=>'7')); ?>
    <div class="controls">
        <?php 
            $this->widget('yiiwheels.widgets.maskinput.WhMaskInput',
                array(
                    'name'        => 'id_member',
                    'mask'        => '9999999',
                    'htmlOptions' => array('placeholder' => '')
            )
        );
       ?>
        &nbsp;&nbsp;
        <?php echo TbHtml::ajaxSubmitButton('<i class="icon-fa-search icon-fa-large" style="margin-top:5px;"></i> Search','js:$("#form-search-member").attr("action")',array(
        'type'      =>'POST',
        'data'      =>'js:{id_member:$("#id_member").val()}',
        'dataType'  =>'json',
        'success'   =>'function(data) {

            if(data){

                $("#member_name").val(data.first_name + " " + data.family_name);
                $("#point").val(data.point);
                disableMember();
                '.$additionalHandler.'

            }else{

                errorMsgBox("ID Member Not Found");

            }

        }',
     ),array('id'=>'btn-search-member','color' => TbHtml::BUTTON_COLOR_INVERSE)); ?>
    </div>
</div>

<?php echo TbHtml::textFieldControlGroup('member_name','',array('span'=>5,'label'=>'Member Name','readonly'=>'readonly')); ?>

<?php echo TbHtml::textFieldControlGroup('point','',array('span'=>1,'label'=>'Point','readonly'=>'readonly'));?>
</fieldset>
<?php echo TbHtml::endForm(); ?>

