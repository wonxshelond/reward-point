<?php

class AddPointController extends AdminController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionGetTenant(){
        $keyword = $_GET['q'];
        $models=Tenant::model()->findAll(array(
         'select'=>'id_tenant, tenant_name',
         'condition'=>'tenant_name LIKE :keyword',
         'params'=>array(':keyword'=>'%'.$keyword.'%'),
         'order'=>'tenant_name',
         'limit'=>5,
         ));
         $suggest=array();
         foreach($models as $model)
         {
           $suggest[] = array(
              'id'=>$model->id_tenant,
              'text'=>$model->tenant_name,
          );
         }
      echo CJSON::encode($suggest);
    }

    public function actionGetRule(){
        $keyword = $_GET['q'];

        $models=Rule::model()->findAll(array(
         'condition'=>'rule_name LIKE :keyword',
         'params'=>array(':keyword'=>'%'.$keyword.'%'),
         'order'=>'rule_name',
         'limit'=>5,
         ));

         $suggest=array();
         foreach($models as $model)
         {
           $suggest[] = array(
              'id'=>$model->id_rule.'-'.$model->point,
              'text'=>$model->rule_name,

          );
         }

        echo CJSON::encode($suggest);
    }


    public function actionSave(){

      if (isset($_POST)) {

         $trans = Yii::app()->db->beginTransaction();
		 $member_name = '';
		 $total = 0;
		 $point = 0;
         try{

           $table_length = $_POST['table_length'];
          
           if ($table_length < 1 ){
              throw new Exception('Rollback Input');
           }

           if (empty($_POST['id_member'])){
              throw new Exception('Rollback Input');
           }
           for($i=0;$i<$table_length;$i++){


              $receipt = new Receipt();
              $receipt->id_receipt     = $_POST['id_receipt_list'][$i];
              $receipt->receipt_date   = $_POST['receipt_date_list'][$i];
              $receipt->total_purchase = $_POST['total_purchase_list'][$i];
              $receipt->nominal_point  = $_POST['pointearned_list'][$i];
              $receipt->id_member      = $_POST['id_member'];
              $receipt->id_rule        = $_POST['id_rule_list'][$i];
              $receipt->id_tenant      = $_POST['id_tenant_list'][$i];
              $receipt->username       =  Yii::app()->user->getId();
             
              if ($receipt->validate() and $receipt->save()){
                  
                  $member = Member::model()->findByPk($_POST['id_member']);
				  $member_name = $member->first_name.' '.$member->family_name;
                  $member->point += $receipt->nominal_point;

                  if(!$member->update()){
                    throw new Exception('Rollback on Update Point Member');
                  }

				  $total += $receipt->nominal_point;
                  $point = $member->point;
              }else{
                 throw new Exception('Rollback on Receipt');
              }
              

           }
           $trans->commit();

		   $get_name = User::model()->findByPk(Yii::app()->user->getId());

		   $dataReceipt = $this->renderPartial('_receipt',array(
			'id_member'   => $_POST['id_member'],
			'member_name' => $member_name,
			'new_point'	  => $total,
			'old_point'	  => $point - $total,
			'total_point' => $point,
			'name'		  => $get_name->name,
		   ),true,false);

           echo CJSON::encode(array('message'=>'Transaction add point has been saved Successfully!','receipt'=>$dataReceipt));
           

         }catch(CDbException $e){
            $trans->rollback();
        }

      }

    }

	public function actionCekTrans()
	{
		$date = date('Y-m-d');
		$sql = "select SUM(total_purchase) as jumlah FROM receipt WHERE id_member='".$_GET['id_member']."' AND receipt_date = '$date'";
		$db = Yii::app()->db->createCommand($sql);
		
		$result = $db->queryRow();
		
		if (!empty($result['jumlah'])) {

			if ((int) $result['jumlah'] >= 10000000) {
				echo CJSON::encode(array('max'));
			}

		}
		
	}

}