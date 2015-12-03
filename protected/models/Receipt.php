<?php

/**
 * This is the model class for table "receipt".
 *
 * The followings are the available columns in table 'receipt':
 * @property string $id_receipt
 * @property string $receipt_date
 * @property string $total_purchase
 * @property integer $nominal_point
 * @property string $id_member
 * @property string $id_rule
 * @property string $id_tenant
 * @property string $username
 */
class Receipt extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'receipt';
	}

    public $old_idmember = '';

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_receipt, receipt_date, total_purchase, nominal_point, id_member, id_rule, id_tenant', 'required'),
			array('nominal_point', 'numerical', 'integerOnly'=>true),
			array('id_receipt', 'length', 'max'=>15),
			array('total_purchase', 'length', 'max'=>8),
			array('id_member', 'length', 'max'=>7),
			array('id_rule', 'length', 'max'=>3),
			array('id_tenant', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_receipt, receipt_date, total_purchase, nominal_point, id_member, id_rule, id_tenant', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'member'=>array(self::BELONGS_TO,'Member','id_member'),
            'tenant'=>array(self::BELONGS_TO,'Tenant','id_tenant'),
            'rule'=>array(self::BELONGS_TO,'Rule','id_rule'),
            'user'=>array(self::BELONGS_TO,'User','username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_receipt' => 'Id Receipt',
			'receipt_date' => 'Receipt Date',
			'total_purchase' => 'Total Purchase',
			'nominal_point' => 'Nominal Point',
			'id_member' => 'Id Member',
			'id_rule' => 'Id Rule',
			'id_tenant' => 'Id Tenant',
            'username' => 'Username',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->condition='id_member=:param_id_member1 or id_member=:param_id_member2';
        $criteria->params = array(':param_id_member1'=>$this->id_member,':param_id_member2'=>$this->old_idmember);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Receipt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function chart($year){
		$annual_months = array();
		$annual_months[0]="SUM(IF(MONTH(receipt_date)=1,1,0)) 'January'";
		$annual_months[1]="SUM(IF(MONTH(receipt_date)=2,1,0)) 'February'";
		$annual_months[2]="SUM(IF(MONTH(receipt_date)=3,1,0)) 'March'";
		$annual_months[3]="SUM(IF(MONTH(receipt_date)=4,1,0)) 'April'";
		$annual_months[4]="SUM(IF(MONTH(receipt_date)=5,1,0)) 'May'";
		$annual_months[5]="SUM(IF(MONTH(receipt_date)=6,1,0)) 'June'";
		$annual_months[6]="SUM(IF(MONTH(receipt_date)=7,1,0)) 'July'";
		$annual_months[7]="SUM(IF(MONTH(receipt_date)=8,1,0)) 'August'";
		$annual_months[8]="SUM(IF(MONTH(receipt_date)=9,1,0)) 'September'";
		$annual_months[9]="SUM(IF(MONTH(receipt_date)=10,1,0)) 'October'";
		$annual_months[10]="SUM(IF(MONTH(receipt_date)=11,1,0)) 'November'";
		$annual_months[11]="SUM(IF(MONTH(receipt_date)=12,1,0)) 'Desember'";



		$final_query = implode(',',$annual_months);

		$raw_query =  'SELECT '.$final_query.' FROM receipt WHERE YEAR(receipt_date)='.$year;
		$db = Yii::app()->db->createCommand($raw_query);
		return $db->queryRow();
	}

	
}
