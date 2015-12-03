<?php

class RedeemPointController extends AdminController
{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSearchDataVoucher()
    {
        $keyword = $_GET['q'];

        $models=Voucher::model()->findAll(array(
         'condition'=>'voucher_name LIKE :keyword AND DATEDIFF(end_date,now()) > 0',
         'params'=>array(':keyword'=>'%'.$keyword.'%'),
         'order'=>'voucher_name',
         'limit'=>5,
         ));

         $suggest=array();
         foreach($models as $model)
         {
           $suggest[] = array(
              'id'=>$model->id_voucher.'-'.$model->point_required,
              'text'=>$model->voucher_name,

          );
         }

        echo CJSON::encode($suggest);
	}
        
    public function actionSave()
    {
       if ($_POST){

         
        $trans = Yii::app()->db->beginTransaction();
         try{
           $redeem = new Redeem();
           $autonumber = $redeem->autonumber();
           $table_length = $_POST['table_length'];
           $point = 0;
           $member_name = '';
		   $voucher_list = array();
           if ($table_length < 1 ){
              throw new Exception('Rollback Table Length');
           }

           if (empty($_POST['id_member'])){
              throw new Exception('Rollback ID Member');
           }
           $redeem->id_redeem = $autonumber;
           $redeem->redeem_point = $_POST['redeem_point'];
           $redeem->username = Yii::app()->user->getId();
           $redeem->redeem_date = date('Y-m-d');
           $redeem->id_member = $_POST['id_member'];
           
           if (!$redeem->validate() or !$redeem->save()){
              throw new Exception('Rollback Redeem');
           }
           for($i=0;$i<$table_length;$i++){


              $detail_redeem = new DetailRedeem();
              $detail_redeem->id_redeem = $autonumber;
              $detail_redeem->id_voucher = $_POST['id_voucher_list'][$i];
              $detail_redeem->voucher_number = $_POST['number_voucher_list'][$i];

			  // mendapatkan nama voucher dan jumlah voucher yang diredeem untuk dicetak distruk
			  $voucher = Voucher::model()->findByPk($_POST['id_voucher_list'][$i]);
			  $voucher_list[] = array($voucher->voucher_name,$_POST['number_voucher_list'][$i]);

              if ($detail_redeem->validate() and $detail_redeem->save()){
                  
                  $member = Member::model()->findByPk($_POST['id_member']);
				  $member_name = $member->first_name.' '.$member->family_name;
                  $member->point -= $_POST['total_redeem_list'][$i];;
                  if(!$member->update()){
                    throw new Exception('Rollback Update Point Member');
                  }
				  $point = $member->point;
                  
              }else{
                 throw new Exception('Rollback Detail Redeem');
              }
              

           }

           $trans->commit();

		   $get_name = User::model()->findByPk(Yii::app()->user->getId());
           $dataRedeem = $this->renderPartial('_receipt',array(
				'id_member'=>$_POST['id_member'],
				'member_name'=>$member_name,
				'point'=>$point + $redeem->redeem_point,
				'redeem_point'=> $redeem->redeem_point,
				'remaining'=> $point,
				'vouchers'=> $voucher_list,
				'name'=>$get_name->name,
		   ),true,false);

           echo CJSON::encode(array('message'=>'Transaction redeem point has been saved Successfully!','receipt'=>$dataRedeem));
           

         }catch(CDbException $e){
            $trans->rollback();
        }

       }     
    }

}