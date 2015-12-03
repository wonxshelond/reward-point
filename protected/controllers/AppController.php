<?php

class AppController extends Controller{
	
	


	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('login','error'),
				'users'=>array('*'),
			),
			array('allow', 
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

    public function actionIndex()
    {

		$receipt = new Receipt();
		$redeem  = new Redeem();
        $this->render('index',array(
			'receipt'=>$receipt,
			'redeem'=>$redeem,
		));
    }

    

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
    {
        $model = new User('login');

        if (isset($_POST['User'])){
            $model->attributes = $_POST['User'];

            if ($model->validate() && $model->login())
               $this->redirect("?r=app/index");   
        }
        
        $this->layout="//layouts/login";
        $this->render('login',array('model'=>$model));
	}

	public function actionLogout(){
		$model = User::model()->findByAttributes(array('username'=>Yii::app()->user->id));

		if ($model !== null){
            $model->password ='';
			$model->last_login = date('Y-m-d');
			$model->save();
		}
		Yii::app()->user->logout();
		$this->redirect('?r=app/login');
	}
}