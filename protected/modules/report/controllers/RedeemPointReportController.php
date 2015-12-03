<?php

class RedeemPointReportController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionViewer()
    {
      $this->renderPartial('_view',array(
		'tgl1'=>$_POST['tglawal'],
		'tgl2'=>$_POST['tglakhir'],
	  ));
    }


   public function actionView($tgl1,$tgl2)
   {
     $this->renderPartial('_report',array(
		'tgl1'=>$tgl1,
		'tgl2'=>$tgl2,
	 ));
   }

	
}