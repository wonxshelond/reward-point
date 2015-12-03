<?php

class ViewMemberTransactionController extends Controller
{
	
	public function actionIndex()
	{
		$model = new Receipt('Search');

        if (!empty($_GET['ajax']) and $_GET['ajax'] === 'receipt-grid'){

			// cari apakah id_member yang dikirim ada ditabel member
			$member = Member::model()->findByPk($_GET['id_member']);
			
			
			// Jika tidak ada di table member coba cari di table upgrade membership
			if ( $member !== null ) {

				// cari old_idmember ditabel upgrade_membership apakah ada, jika
				// ada ambil old_idmember tersebut dan ambil data transactionnya ditabel receipt berdasarkan old_idmember
				$upgrade_membership = new UpgradeMembership();
				$model->id_member = $member->id_member;
				$upgrade_idmember = $upgrade_membership->GetOldIdMember($member->id_member);

				if ( $upgrade_idmember !== null ) {
					 $model->old_idmember = $upgrade_idmember->old_idmember;
				}

			}

        }
		$this->render('index',array('model'=>$model));
	}


   
}