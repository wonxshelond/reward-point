<?php
/**
 * Controller untuk entry tenant
 * @author Nico & Efram
 * @version 1.0
 */
class TenantController extends AdminController
{
 
    /**
     * first sequence 
     * Method untuk menampikan halaman awal menu entry tenant
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
        $model=new Tenant;

        if (isset($_POST['Tenant'])) {

            $model->attributes=$_POST['Tenant'];

            if ($model->validate() && $model->save()) {

                echo CJSON::encode(array(
                    'status'=>'success',
                    'message'=>'Data tenant has been saved successfully !',
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
     * Method untuk menampilkan manage data tenant
     */
    public function actionAdmin()
    {
        $model=new Tenant('search');
        $model->unsetAttributes();  
        if (isset($_GET['Tenant'])) {
            $model->attributes=$_GET['Tenant'];
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
        $model=Tenant::model()->findByPk($id);
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
        $model = new Tenant();
        echo CJSON::encode(array(
         $model->autonumber(),
        ));
    }


    /**
     * Sixth sequence
     * Method untuk menampilkan detail view dari data tenant
     */
    public function actionView($id)
    {
        $this->renderPartial('_view',array(
            'model'=>$this->loadModel($id),
        ));
    }


    /**
     * Seventh sequence
     * method untuk mengubah data tenant dan menampilkan form edit data tenant
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);


        if (isset($_POST['Tenant'])) {

            $model->attributes=$_POST['Tenant'];

            if ($model->validate() && $model->save()) {

                echo CJSON::encode(array(
                    'status'=>'success',
                    'message'=>'Data tenant has been updated successfully !',
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
     * Method untuk menghapus data tenant
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