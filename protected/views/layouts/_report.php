<?php
/**
 * File ini berisi yii widget TbNav untuk menampilkan menu Report
 * yang terdiri dari :
 * - View Member Point
 * - View Member Trasaction
 * - Redeem Point Report
 * - Data Member Report
 * - Upgrade Membership
 *
 * @version 1.0
 * @author Nico & Efram
 */
$controller = strtolower(Yii::app()->controller->id);
$icon = "<i class='icon-fa-forward'></i> ";
$this->widget(
    'bootstrap.widgets.TbNav',
    array(
        'type'       => TbHtml::NAV_TYPE_TABS,
        'encodeLabel'=> false,
        'stacked'    => true,
        'htmlOptions'=> array('class'=>'custom-stacked'),
        'items'      => array(
            array('label' => $icon.'View Member Point',
                  'url'   => '?r=report/ViewMemberPoint',
                  'active'=> $controller=='viewmemberpoint'?true:false),
            array('label' => $icon.'View Member Transaction', 
                  'url'   => '?r=report/ViewMemberTransaction',
                  'active'=> $controller=='viewmembertransaction'?true:false),
            array('label' => $icon.'Redeem Point Report', 
                  'url'   => '?r=report/RedeemPointReport',
                  'active'=> $controller=='redeempointreport'?true:false),
            array('label' => $icon.'Data Member Report', 
                  'url'   => '?r=report/DataMemberReport',
                  'active'=> $controller=='datamemberreport'?true:false),
            array('label' => $icon.'Upgrade Membership Report', 
                  'url'   => '?r=report/UpgradeMembershipReport',
                  'active'=> $controller=='upgrademembershipreport'?true:false),
        )
    )
);
?>

