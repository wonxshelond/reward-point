<?php

class TenantInformationController extends AdminController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSearchDataTenant()
    {

        $keyword = $_GET['term'];
        $model = new Tenant();
        $dataTenant = $model->GetDataTenant($keyword);

        $result = array();
        
        foreach($dataTenant as $tenant)
         {
           $result[] = array(
              'id'=>$tenant->id_tenant,
              'value'=>$tenant->tenant_name,
              'pic'=>$tenant->pic,
              'location'=>$tenant->location,
              'phone'=>$tenant->phone,

          );
         }
        echo CJSON::encode($result);
    }

}