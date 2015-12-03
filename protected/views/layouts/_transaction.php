<?php
/**
 * File ini berisi yii widget TbNav untuk menampilkan menu Transaction
 * yang terdiri dari :
 * - Upgrade Membership
 * - Add Point
 * - Redeem Point 
 * - Tenant Information
 * @version 1.0
 * @author Nico & Efram
 */
$controller = strtolower(Yii::app()->controller->id);
$icon = "<i class='icon-fa-forward'></i> ";
$this->widget(
    'bootstrap.widgets.TbNav',
    array(
        'type'        => TbHtml::NAV_TYPE_TABS,
        'encodeLabel' => false,
        'stacked'     => true,
        'htmlOptions' => array('class'=>'custom-stacked'),
        'items'       => array(
            array('label' => $icon.'Upgrade Membership','url'  => '?r=transaction/UpgradeMembership',
                  'active'=> $controller=='upgrademembership'?true:false),
            array('label' => $icon.'Add point', 'url'          => '?r=transaction/AddPoint',
                  'active'=> $controller=='addpoint'?true:false),
            array('label' => $icon.'Redeem Point', 'url'       => '?r=transaction/RedeemPoint',
                  'active'=> $controller=='redeempoint'?true:false),
            array('label' => $icon.'Tenant Information', 'url' => '?r=transaction/TenantInformation',
                  'active'=> $controller=='tenantinformation'?true:false),
			 array('label' => $icon.'Change Password', 'url' => '?r=transaction/changePassword',
                  'active'=> $controller=='changepassword'?true:false),
        )
    )
);
?>

