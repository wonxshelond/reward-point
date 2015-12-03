<?php
/**
 * File ini berisi yii widget TbNav untuk menampilkan menu Master
 * yang terdiri dari :
 * - Entry Member
 * - Entry Tenant
 * - Entry Rules
 * - Entry Voucher
 * - Entry Rule
 *
 * @version 1.0
 * @author Nico & Efram
 */
$controller = strtolower(Yii::app()->controller->id);
$icon = "<i class='icon-fa-forward'></i> Entry ";
$menu = array();
if (Yii::app()->user->getState("level") === "1"){
	$menu = array(
            array('label' => $icon.'Member','url'  => '?r=master/member','active'  => $controller=='member'?true:false),
            array('label' => $icon.'Tenant', 'url' => '?r=master/tenant','active'  => $controller=='tenant'?true:false),
            array('label' => $icon.'Rule', 'url'  => '?r=master/rule','active'    => $controller=='rule'?true:false),
            array('label' => $icon.'Voucher', 'url'=> '?r=master/voucher','active' => $controller=='voucher'?true:false),
            array('label' => $icon.'User', 'url'   => '?r=master/user','active'    => $controller=='user'?true:false),
        );
}else{

	$menu = array(
            array('label' => $icon.'Member','url'  => '?r=master/member','active'  => $controller=='member'?true:false),
        );

}

$this->widget(
    'bootstrap.widgets.TbNav',
    array(
        'type' => TbHtml::NAV_TYPE_TABS,
        'encodeLabel'=>false,
        'stacked'=>true,
        'htmlOptions'=>array('class'=>'custom-stacked'),
        'items' => $menu,
    )
);
?>


