<div class="form-actions">
    <?php
    // Tombol untuk simpan/ubah dengan tipe ajax

    echo TbHtml::ajaxSubmitButton('<i class="icon-fa-save icon-fa-large"></i> Save',
        'js:$("#'.$formid.'").attr("action")',
        array('beforeSend'=>'js:function() {

                // tampilkan loader progress
                $("#loader").show();

                }',
              'dataType'  =>'json',
              'success'   =>'js:function(data) {

                // sembunyikan loader progress
                $("#loader").hide();
                    
                    if (data.status=="success") {

                        //tampilkan pesan sukses
                        successMsgBox(data.message);

                        // klik tombol cancel
                        $("#btncancel").trigger("click");

                        // refresh table grid view
                        $.fn.yiiGridView.update("'.$gridviewid.'");

                        // set default action form
                        $("#'.$formid.'").attr("action","'.$defaultaction.'");

                        // set default icon save
                        $("#btncommand").html("<i class=\'icon-fa-save icon-fa-large\'></i> Save");

                    }else if(data.status=="fail"){
						errorMsgBox(data.message);
					}else{

                        $.each(data,function(key,val){

                        // buang class success pada input dan tambahkan class error pada input
                        $("#"+key+"_em_").closest("div").prev().closest("div").removeClass("success").addClass("error");

                        // tampilkan pesan error
                        $("#"+key+"_em_").text(val);
                        $("#"+key+"_em_").show();

                        });
						

                    }
					$("html, body").animate({ scrollTop: 0 }, "slow");   

                 }',
             'error'   =>'js:function(data) {

                // sembunyikan loader progress
                $("#loader").hide();
				 
                // tampilkan jika status server error
                errorMsgBox("An Error Ocurred Please Try Again");
				$("html, body").animate({ scrollTop: 0 }, "slow");

                }',
       ),array(
            'color'=>TbHtml::BUTTON_COLOR_INVERSE,
            'size'=>TbHtml::BUTTON_SIZE_LARGE,
            'id'=>'btncommand',
            )); 
         
       echo "&nbsp;&nbsp;";

       // Tombol untuk batal
       echo TbHtml::resetButton('<i class="icon-fa-remove-circle icon-fa-large"></i> Cancel',array(
            'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
            'size'=>TbHtml::BUTTON_SIZE_LARGE,
            'id'=>'btncancel',

        ));

        ?>
        &nbsp;&nbsp;
        <img id="loader" style="display:none" src="<?php echo Yii::app()->baseurl; ?>/images/25.GIF"/>
    </div>