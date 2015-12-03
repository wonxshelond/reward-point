<?php

class ChangePasswordController extends AdminController{

	public function actionIndex(){

		$user = User::model()->findByPk(Yii::app()->user->getId());

		$this->render('index',array(
			'model'=>$user
		));

	}

	public function actionSave(){

		$model =  User::model()->findByPk(Yii::app()->user->getId());

		$old_password = md5($_POST['old_password']);
		$password = trim($_POST['User']['password']);
		$repeat_password = trim($_POST['User']['repeat_password']);

		if ($model !== null) {

			if (($model->password == $old_password) ) {


			   if (($password == $repeat_password)) {
					$model->password = $password;
					if ($model->save()){
						echo CJSON::encode(array(
						'status'=>'success',
						'message'=>'Password Change Successfully !',
						));
					}
			   }else{
					echo CJSON::encode(array(
						'status'=>'fail',
						'message'=>'Wrong Repeat Password !',
						));
				}

			}else{
				echo CJSON::encode(array(
                 'status'=>'fail',
                 'message'=>'Wrong Old Password !',
                ));
			}
			
		}

	}


}