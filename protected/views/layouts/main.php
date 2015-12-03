<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<title><?php echo Yii::app()->name; ?></title>
		<link rel="shortcut icon" href="./images/favicon.ico" />
        <!-- style dan script aplikasi css bootstrap, icon awesome dan jquery library -->
        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->fontawesome->init(); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.cookie.js');?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootbox.min.js');?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/message.js');?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/myapp.js');?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().
                '/jui/css/base/jquery-ui.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/black-tie/jquery-ui-1.10.4.custom.min.css');?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/appstyle.css');?>
       
    </head>
    <body>
    
    <!-- bagian banner aplikasi -->
    <div class="row fullrow header"><img style="position:absolute;left:30%" src="./images/banner.png" /></div>
    <!-- akhir bagian banner aplikasi -->
    
    <div class="row fullrow" style="background:#fffff3">
    
        <!-- sidebar sebelah kiri -->
        <div class="span-4 sidebar" >
            <div class="row" style="margin-left:2%">
                <?php // untuk menu accordion di sidebar sebelah kiri
                     $this->widget('zii.widgets.jui.CJuiAccordion', array(
                        'id'       => 'accordion',
                        'panels'  => array(
                           '<i class="icon-fa-home iconic"></i> Home'=>false,
                           '<i class="icon-fa-book iconic"></i> Master'=>$this->renderPartial('//layouts/_master',null,true),
                           '<i class="icon-fa-briefcase iconic"></i> Transaction'=>
                            $this->renderPartial('//layouts/_transaction',null,true),
                            '<i class="icon-fa-bar-chart iconic"></i> Report'=>$this->renderPartial('//layouts/_report',null,true),
                        ),
                        'options' => array('animated'=>'bounceslide','navigation'=>true),
                     ));
                ?>
            </div>
        </div>
        <!-- akhir sidebar sebelah kiri -->
        
        <!-- content utama aplikasi -->
        <div class="span-8 content">
        
            <!-- info bar sebelah kanan menampilkan username dan terakhir username login -->
            <div class="span-8 well welly2 iconicwell" style="margin-top:1%;">
                <strong style="font-size:16px;">
                    Welcome <?php echo Yii::app()->user->getState('realName'); ?>, 
                    Last Login <?php echo Yii::app()->user->getState('lastLogin'); ?></strong>
                    
                    <div style="float:right;margin-top:-5px;">
                        <div class="btn-group">
                           
                           <!-- menampilkan nama username -->
                            <a class="btn  dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i> <?php echo Yii::app()->user->getId();?>
                                <span class="caret"></span>
                            </a>
                            
                            <!-- menu logout -->
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $this->createUrl('/app/logout'); ?>"> Logout</a></li>
                            </ul>
                            <!-- akhir menu logout -->
                            
                        </div>
                    </div>
            </div>
            <!-- akhir dari info bar -->
            
            <!-- letak isi dari setiap menu accordion -->
            <div class="span-8 well welly "><?php echo $content; ?></div>
            <!-- akhir dari letak isi menu accordion -->
            
        </div>
        <!-- akhir dari content utama aplikasi -->
        
     </div>	
     
     <!-- footer aplikasi -->
    <div class="row fullrow" id="footer" style="background:#363636;max-height:43px;height:43px;text-align:center;color:#fff">
         <div style="font-family:verdana;line-height:3em;text-align:center;font-size:12px;"> 
         Copyright &copy <?php echo date('Y'); ?> Lippo Mall Kemang All Rights Reserved
         <p id="server-time" style="color:#fff;display:inline"></p>
         </div>
         
     </div>
     <!-- akhir dari footer aplikasi-->

 </body>
</html>