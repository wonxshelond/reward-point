<?php
/**
 * Controller untuk enrty user
 * @author Nico & Efram
 * @version 1.0
 */
class UserController extends AdminController
{
    /**
     * first sequence 
     * Method untuk menampikan halaman awal menu entry user
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * second sequence 
     * Method untuk menyimpan data tenant dan menampilkan form tenant
     */
    public function actionCreate()
    {
        $model=new User('register');

        if (isset($_POST['User'])) {

            $model->attributes=$_POST['User'];
            if ($model->validate() && $model->save()) {
                echo CJSON::encode(array(
                'status'    =>'success',
                'message'   =>'Data user has been saved successfully',
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
     * Method untuk menampilkan manage data user
     */
    public function actionAdmin()
    {
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $model->attributes=$_GET['User'];
        }

        $this->renderPartial('_admin',array(
            'model'=>$model,false,true
        ));
    }

    /**
     * fourth sequence 
     * Method untuk meload data tenant berdasarkan primary key
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if ($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * fifth sequence
     * Method untuk menampilkan detail view dari data user
     */
    public function actionView($id)
    {
        $this->renderPartial('_view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Sixth sequence
     * method untuk mengubah data user dan menampilkan form edit data user
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        
        if (isset($_POST['User'])) {

            $model->attributes=$_POST['User'];
            $model->password = $_POST['User']['password'];
      
            if ($model->validate() && $model->save()) {

                echo CJSON::encode(array(
                 'status'=>'success',
                 'message'=>'Data user has been saved successfully',
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
     * seventh sequence
     * Method untuk menghapus data user
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
        
            $model = $this->loadModel($id);
            $model->password='';
            $model->active = '0';
            $model->save();
        
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

    
    

    
    

    
}