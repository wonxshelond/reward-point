<?php

class ViewMemberPointController extends Controller
{
	 
	public function actionIndex()
	{
		$model = new Member('Search');
		$model->unsetAttributes();
        if (!empty($_GET['ajax']) and $_GET['ajax'] === 'member-grid'){

           if (!empty($_GET['category']) and $_GET['category'] === 'id_member'){
				$model->id_member = $_GET['keyword'];
			}elseif (!empty($_GET['category']) and $_GET['category'] === 'member_name') {
				$model->first_name = $_GET['keyword'];
			}	
        }
		$this->render('index',array('model'=>$model));
	}

	public function actionPrint()
	{

		$id_member = !empty($_GET['id_member'])?$_GET['id_member']:'';

		$member = Member::model()->findByPk($id_member);

		if ($member === null) {
			throw new CHttpException(400,'Invalid request');
		}

		$receipt = Receipt::model()->find(array(
			'condition'=>'id_member = :id_member',
			'params'=>array(':id_member'=>$id_member),
			'order'=>'receipt_date DESC',
		));

		$last_update = is_null($receipt)?$member->register_date:$receipt->receipt_date;
		

		$user = User::model()->findByPk(Yii::app()->user->getId());

		if ($user === null) {
			throw new CHttpException(400,'Invalid request');
		}

		$receipt = $this->renderPartial('_receipt',array(
			'id_member'=>$member->id_member,
			'member_name'=>$member->first_name.' '.$member->family_name,
			'point'=> $member->point,
			'last_update'=>date('d F Y',strtotime($last_update)),
			'name'=>$user->name,
		),true,false);

		echo CJSON::encode($receipt);

		

	}

    

	
}