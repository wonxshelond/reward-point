<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<title><?php echo Yii::app()->name; ?></title>
        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->fontawesome->init(); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.cookie.js');?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().
                '/jui/css/base/jquery-ui.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/black-tie/jquery-ui-1.10.4.custom.min.css');?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/login.css');?>
     </head>
     <body>
   
        <div class="row fullrow header"></div>

            <div class="span-8 content">
             <?php echo $content; ?>
            </div>
        
         <div class="footer" style="background:#363636;height:43px;text-align:center;color:#fff">
             <div style="font-family:verdana;line-height:3em;text-align:center;font-size:12px;"> 
             Copyright &copy <?php echo date('Y'); ?> Lippo Mall Kemang All Rights Reserved
             </div>
         </div>
      
     </body>
</html>