<?php
/**
 * Controller untuk entry rule
 * @author Nico & Efram
 * @version 1.0
 */
class RuleController extends AdminController
{

    /**
     * first sequence 
     * Method untuk menampikan halaman awal menu entry rule
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * second sequence 
     * Method untuk menyimpan data rule dan menampilkan form rule
     */
    public function actionCreate()
    {
        $model=new Rule;

        if (isset($_POST['Rule'])) {

			$model->attributes=$_POST['Rule'];

			if ($model->validate() && $model->save()) {

				   echo CJSON::encode(array(
					'status'  =>'success',
					'message' =>'Data rule has been saved successfully',
					));

			}else{
					
					$error = CActiveForm::validate($model);
					if($error != '[]')
						echo $error;

			}

				Yii::app()->end();
        }
       
        $this->renderPartial('_form',array(
            'model'=>$model,false,true
        ));
    }

    /**
     * third sequence 
     * Method untuk menampilkan manage data rule
     */
    public function actionAdmin()
    {
        $model=new Rule('search');
        $model->unsetAttributes();

        if (isset($_GET['Rule'])) {
            $model->attributes=$_GET['Rule'];
        }
    
        $this->renderPartial('_admin',array(
            'model'=>$model,false,true,
        ));
    }

    /**
     * fourth sequence 
     * Method untuk meload data rule berdasarkan primary key
     */
    private function loadModel($id)
    {
        $model=Rule::model()->findByPk($id);
        if ($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Fifth sequence
     * Method untuk membuat autonumber
     */
    public function actionAutonumber(){
        $model = new Rule();
        echo CJSON::encode(array(
         $model->autonumber(),
        ));
    }


    /**
     * Sixth sequence
     * Method untuk menampilkan detail view dari data rule
     */
    public function actionView($id)
    {
        $this->renderPartial('_view',array(
            'model'=>$this->loadModel($id)
        ));
    }


    /**
     * Seventh sequence
     * method untuk mengubah data rule dan menampilkan form edit data rule
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if (isset($_POST['Rule'])) {

            $model->attributes=$_POST['Rule'];

            if ($model->validate() && $model->save()) {

                echo CJSON::encode(array(
                 'status'=>'success',
                 'message'=>'Data rule has been updated successfully !',
                ));
                
            }else{

                $error = CActiveForm::validate($model);
                if($error != '[]')
                    echo $error;
                
            }

            Yii::app()->end();
        }

        echo CJSON::encode($model);
        
    }


    /**
     * Eighth sequence
     * Method untuk menghapus data rule
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }

        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }


}