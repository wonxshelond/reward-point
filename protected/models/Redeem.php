<?php

/**
 * This is the model class for table "redeem".
 *
 * The followings are the available columns in table 'redeem':
 * @property string $id_redeem
 * @property string $redeem_date
 * @property integer $redeem_point
 * @property string $id_member
 * @property string $username
 */
class Redeem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'redeem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_redeem, redeem_date, redeem_point, id_member, username', 'required'),
			array('redeem_point', 'numerical', 'integerOnly'=>true),
			array('id_redeem', 'length', 'max'=>6),
			array('id_member', 'length', 'max'=>7),
			array('username', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_redeem, redeem_date, redeem_point, id_member, username', 'safe', 'on'=>'search'),
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
			'member'=>array(self::BELONGS_TO,'Member','id_member','joinType'=>'LEFT JOIN'),
			'user'=>array(self::BELONGS_TO,'User','username'),
			'detail_redeem'=>array(self::HAS_MANY,'DetailRedeem','id_redeem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_redeem' => 'Id Redeem',
			'redeem_date' => 'Redeem Date',
			'redeem_point' => 'Redeem Point',
			'id_member' => 'Id Member',
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

		$criteria->compare('id_redeem',$this->id_redeem,true);
		$criteria->compare('redeem_date',$this->redeem_date,true);
		$criteria->compare('redeem_point',$this->redeem_point);
		$criteria->compare('id_member',$this->id_member,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Redeem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function autonumber(){
		$criteria = new CDbCriteria;
		$criteria->select='id_redeem';
		$criteria->order='id_redeem DESC';
		$field= self::model()->find($criteria);
		$getNextValue = (int) substr($field['id_redeem'], 2)+1;
		return sprintf('RD%04s',$getNextValue);

	}

	public function chart($year){
		$annual_months = array();
		$annual_months[0]="SUM(IF(MONTH(redeem_date)=1,1,0)) 'January'";
		$annual_months[1]="SUM(IF(MONTH(redeem_date)=2,1,0)) 'February'";
		$annual_months[2]="SUM(IF(MONTH(redeem_date)=3,1,0)) 'March'";
		$annual_months[3]="SUM(IF(MONTH(redeem_date)=4,1,0)) 'April'";
		$annual_months[4]="SUM(IF(MONTH(redeem_date)=5,1,0)) 'May'";
		$annual_months[5]="SUM(IF(MONTH(redeem_date)=6,1,0)) 'June'";
		$annual_months[6]="SUM(IF(MONTH(redeem_date)=7,1,0)) 'July'";
		$annual_months[7]="SUM(IF(MONTH(redeem_date)=8,1,0)) 'August'";
		$annual_months[8]="SUM(IF(MONTH(redeem_date)=9,1,0)) 'September'";
		$annual_months[9]="SUM(IF(MONTH(redeem_date)=10,1,0)) 'October'";
		$annual_months[10]="SUM(IF(MONTH(redeem_date)=11,1,0)) 'November'";
		$annual_months[11]="SUM(IF(MONTH(redeem_date)=12,1,0)) 'Desember'";



		$final_query = implode(',',$annual_months);

		$raw_query =  'SELECT '.$final_query.' FROM redeem WHERE YEAR(redeem_date)='.$year;
		$db = Yii::app()->db->createCommand($raw_query);
	
		return $db->queryRow();
	}
}
