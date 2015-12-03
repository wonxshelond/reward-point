<?php

/**
 * This is the model class for table "detail_redeem".
 *
 * The followings are the available columns in table 'detail_redeem':
 * @property string $id_voucher
 * @property string $id_redeem
 * @property integer $voucher_number
 */
class DetailRedeem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detail_redeem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_voucher, id_redeem, voucher_number', 'required'),
			array('voucher_number', 'numerical', 'integerOnly'=>true),
			array('id_voucher', 'length', 'max'=>3),
			array('id_redeem', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_voucher, id_redeem, voucher_number', 'safe', 'on'=>'search'),
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
			'redeem'=>array(self::BELONGS_TO,'Redeem','id_redeem'),
			'voucher'=>array(self::BELONGS_TO,'Voucher','id_voucher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_voucher' => 'Id Voucher',
			'id_redeem' => 'Id Redeem',
			'voucher_number' => 'Voucher Number',
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

		$criteria->compare('id_voucher',$this->id_voucher,true);
		$criteria->compare('id_redeem',$this->id_redeem,true);
		$criteria->compare('voucher_number',$this->voucher_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetailRedeem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
