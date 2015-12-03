<?php

$this->widget('ext.QPdfJs.QPdfJs',array(
  'url'=>$this->createUrl('/report/UpgradeMembershipReport/view',array('tgl1'=>$tgl1,'tgl2'=>$tgl2))));