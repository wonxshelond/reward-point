<?php
/**
 * Controller untuk enrty voucher
 * @author Nico & Efram
 * @version 1.0
 */
class VoucherController extends AdminController
{

    /**
     * first sequence 
     * Method untuk menampikan halaman awal menu entry voucher
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * second sequence 
     *  Method untuk menyimpan data voucher dan menampilkan form voucher
     */
    public function actionCreate()
    {
        $model=new Voucher;

        if (isset($_POST['Voucher'])) {

            $model->attributes=$_POST['Voucher'];
            $error = CActiveForm::validate($model);

            if($error != '[]'){
                echo $error;
            }else{

                $model->image = CUploadedFile::getInstance($model,'image');

                if (is_object($model->image)) {

                    $fileName = $model->id_voucher.'.'.$model->image->extensionName;
                    $model->image->saveAs('./uploads/'.$fileName);
                    $model->image = $fileName;
                }
        

                if ($model->validate() && $model->save()) {

                    echo CJSON::encode(array(
                    'status'=>'success',
                    'message'=>'Data voucher has been saved successfully !',
                    ));

                }
            }
      
            Yii::app()->end();
        }

        $this->renderPartial('_form',array(
            'model'=>$model,false,true
        ));
    }

    /**
     * third sequence 
     * Method untuk menampilkan manage data voucher
     */
    public function actionAdmin()
    {
        $model=new Voucher('search');
        $model->unsetAttributes();  
        if (isset($_GET['Voucher'])) {
            $model->attributes=$_GET['Voucher'];
        }

        $this->renderPartial('_admin',array(
            'model'=>$model,false,true
        ));
    }

    /**
     * fourth sequence 
     * Method untuk meload data voucher berdasarkan primary key
     */
    public function loadModel($id)
    {
        $model=Voucher::model()->findByPk($id);
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
        $model = new Voucher();
        echo CJSON::encode(array(
            $model->autonumber(), 
        ));
    }


    /**
     * Sixth sequence
     * Method untuk menampilkan detail view dari data voucher
     */
    public function actionView($id)
    {
        $this->renderPartial('_view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Seventh sequence
     * method untuk mengubah data voucher dan menampilkan form edit data voucher
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if (isset($_POST['Voucher'])) {

            $model->attributes=$_POST['Voucher'];
            $error = CActiveForm::validate($model);

            if ($error != '[]') {
                echo $error;
            }else{

                $model->image = CUploadedFile::getInstance($model,'image');

                if (is_object($model->image)) {

                    $fileName = $model->id_voucher.'.'.$model->image->extensionName;
                    $model->image->saveAs('./uploads/'.$fileName);
                    $model->image = $fileName;
                }

                if ($model->validate() && $model->save()) {
                    echo CJSON::encode(array(
                     'status'=>'success',
                     'message'=>'Data voucher has been updated successfully !',
                    
                    ));
                }
            }

            Yii::app()->end();
        }

        echo CJSON::encode($model);
    }

    /**
     * Eighth sequence
     * Method untuk menghapus data voucher
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