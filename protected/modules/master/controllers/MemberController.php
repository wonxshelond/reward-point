<?php
/**
 * Controller untuk entry member
 * @author Nico & Efram
 * @version 1.0
 */
class MemberController extends AdminController
{

    /**
     * first sequence 
     * Method untuk menampikan halaman awal menu entry member
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * second sequence 
     * Method untuk menyimpan data member dan menampilkan form member
     */
    public function actionCreate()
    {
        $model=new Member;

        if (isset($_POST['Member'])) {

            $model->attributes=$_POST['Member'];

            $this->mergeHobby($model);

           
            if ($model->validate() && $model->save()) {

                // Kirim response dalam bentuk json
                echo CJSON::encode(array(
                'status'    =>'success',
                'message'   =>'Data member has been saved successfully!',
                ));

            }else{

                $error = CActiveForm::validate($model);
               
                if($error != '[]')
                    echo str_replace('Member_hobby','',$error);
            }

            Yii::app()->end();
        }

        $this->renderPartial('_form',array(
            'model'=>$model,false,true
        ));

    }

    /**
     * third sequence 
     * Method untuk menampilkan manage data member
     */
    public function actionAdmin()
    {
        $model=new Member('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Member'])) {
            $model->id_member=$_GET['Member']['id_member'];
        }

        $this->renderPartial('_admin',array(
            'model'=>$model,false,true
        ));
    }

    /**
     * fourth sequence 
     * Method untuk meload data member berdasarkan primary key
     */
    private function loadModel($id)
    {
        $model=Member::model()->findByPk($id);
        if ($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Fifth sequence
     * Method mencari data member berdasarkan id member
     */
    public function actionSearchMember(){
        $id_member = $_POST['id_member'];

        $criteria = new CDbCriteria();

        $criteria->condition='id_member=:id_member';
        $criteria->params = array(':id_member'=>$id_member);

        $model = Member::model()->find($criteria);
        echo CJSON::encode($model);
    }

    /**
     * Sixth sequence
     * Method untuk menampilkan detail view dari data member
     */
    public function actionView($id)
    {
        $this->renderPartial('_view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Seventh sequence
     * method untuk mengubah data member dan menampilkan form edit data member
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
    
        if (isset($_POST['Member'])) {

            $model->attributes=$_POST['Member'];

            $this->mergeHobby($model);

         
            if ($model->validate() && $model->save()) {

                echo CJSON::encode(array(
                 'status'=>'success',
                 'message'=>'Data member has been updated successfully!',
                ));

            }else{

                $error = CActiveForm::validate($model);
                if($error != '[]')
                    echo str_replace('Member_hobby','',$error);

            }

            Yii::app()->end();
        }

        echo CJSON::encode($model);
    }

    /**
     * Eighth sequence
     * Method untuk menghapus data member
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

	private function mergeHobby($model)
	{
		// menggabungkan array hobby dengan ;
        $model->hobby = (!empty($_POST['Member']['hobby']))?implode(';',$_POST['Member']['hobby']):'';
            
        // jika pada hobby ada other_hobby(11) maka field other hobby diisi
        if (is_array($_POST['Member']['hobby'])) {

            $model->other_hobby = (in_array('11',$_POST['Member']['hobby']))?$model->other_hobby:'';

        }

		return $model;
	}

}