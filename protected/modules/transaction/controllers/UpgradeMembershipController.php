<?php

class UpgradeMembershipController extends AdminController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSave()
    {

        if ($_POST) {
            $trans = Yii::app()->db->beginTransaction();
            try{
                
                $id_member = $_POST['id_member'];
                $new_id_member = $_POST['new_id_member'];
                $member = Member::model()->findByPk($id_member);
                $member->id_member = $new_id_member;
                $member->type_card = 'Diamond';
				
                if ($member->validate() && $member->update()){
                   
                    $upgrade = new UpgradeMembership();
                    $upgrade->old_idmember = $_POST['id_member'];
                    $upgrade->new_idmember = $_POST['new_id_member'];
                    $upgrade->username = Yii::app()->user->getId();
                    $upgrade->upgrade_date =date('Y-m-d');
                    $upgrade->old_point = $member->point;

                    if ($upgrade->validate() && $upgrade->save()) {
                         $trans->commit();  
                         echo CJSON::encode(array('message'=>'Membership has been upgrade successfully to Diamond'));
                    }else{
                        throw new Exception('Rollback on Upgrade Table');
                    }

                }else{
                    throw new Exception('Rollback on Member Table');
                }    

            }catch(CDbException $e){
                $trans->rollback();
            }

        }
       
    }


}