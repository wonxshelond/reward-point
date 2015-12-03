<?php
/**
* class untuk custom handler view, update delete 
* pada gridview 
*/
class CAdditional{
    
    /**
    * membuat penomoran otomatis pada gridview
    * 
    * @return array
    */
    public static function numberColumn(){
        return array(
            'header'      => 'No.',
            'value'       => '$row+($this->grid->dataProvider->pagination->currentPage*
                $this->grid->dataProvider->pagination->pageSize)+1',
            'htmlOptions' => self::$center,
        );
    }

    // membuat tulisan rata tengah
    public static $center = array('style'=>'text-align:center;');
    
    /**
    * 
    * @param string $updateHandler
    * 
    * @return array
    */
    public static function updateHandlerColumn($updateHandler)
    {
        return array(
            'options' => array(
                'ajax' => array(
                    'type'     => 'GET',
                    'dataType' => 'json',
                    'url'      => "js:$(this).attr('href')",
                    'success'  => 'js:function(data){
                        '.$updateHandler.'
                        $("#btncommand").html("<i class=\'icon-fa-edit icon-fa-large\' ></i> Update");
                        $("#tabs").tabs("option","active",0);
                    }',
                    'error'    => 'js:function() {
                        errorMsgBox("An error occured, please try again");
                    }',
                ), // akhir dari array ajax options
            ), // akhir dari array options
        ); // akhir dari return array
    }

    /**
    * 
    * @return array
    */
    public static function viewHandlerColumn(){
        return  array(
            'options' => array(
                'ajax' => array(
                    'type'     => 'GET',
                    'dataType' => 'html',
                    'url'      => "js:$(this).attr('href')",
                    'success'  => 'function(data) {
                        $("#iddialog").html(data).dialog("open"); return false;
                     }',
                    'error'   => 'js:function() {
                        errorMsgBox("An error occured, please try again");
                     }',
                ),
            ),
        );
    }

    /**
    * 
    * @param string $idgridview
    * 
    * @return array
    */
    public static function deleteHandlerColumn($idgridview){
        return array(
        'click' => "js:function(e) {
                var that = this;
                bootbox.confirm('<h4 style=\'text-align:center\'>Are you sure want to delete ?</h4>', function(result) {
                  if (result){ 
                  
                    $.fn.yiiGridView.update('$idgridview', {
                        type : 'POST',
                        url : $(that).attr('href'),
                        success : function() {
                            $.fn.yiiGridView.update('$idgridview');
                        },
                        error : function() {
                            errorMsgBox('An error occured, please try again');
                        }
                    });
                    
                  }
                }).find('.btn-primary').removeClass('btn-primary')
                  .addClass('btn-inverse btn-large').css({'margin-right':'265px'}).text('Yes').prev()
                  .addClass('btn-large').text('No').css({'margin-right':'-145px'}).parent('div')
                  .parent('div').css({'margin-top':function(){return ($(this).outerHeight())}});
        
                return false;
            }",
        );
    }
}