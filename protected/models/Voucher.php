<?php

/**
 * This is the model class for table "voucher".
 *
 * The followings are the available columns in table 'voucher':
 * @property string $id_voucher
 * @property string $voucher_name
 * @property string $start_date
 * @property string $end_date
 * @property string $image
 * @property integer $point_required
 */
class Voucher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'voucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_voucher, voucher_name, start_date, end_date,  point_required', 'required'),
			array('point_required', 'numerical', 'integerOnly'=>true,'min'=>300),
			array('voucher_name', 'length', 'max'=>35),
			array('point_required','length','max'=>5),
			 array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, gif, png','maxSize'=>780000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('voucher_name, start_date, end_date, point_required', 'safe', 'on'=>'search'),
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
			'detail_redeem'=>array(self::HAS_MANY,'DetailRedeem','id_voucher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_voucher' => 'Id Voucher',
			'voucher_name' => 'Voucher Name',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'image' => 'Image',
			'point_required' => 'Point Required',
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

		
		$criteria->addSearchCondition('voucher_name',$this->voucher_name,true,'OR');
		$criteria->addSearchCondition('start_date',$this->voucher_name,true,'OR');
		$criteria->addSearchCondition('end_date',$this->voucher_name,true,'OR');
		$criteria->addSearchCondition('point_required',$this->voucher_name,true,'OR');
		
        $criteria->order = 'DATEDIFF(end_date,now()) DESC,id_voucher DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Voucher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
    * membuat autonumber untuk tabel voucher
    * 
    * @return String
    */
	public function autonumber(){
		$criteria = new CDbCriteria;
		$criteria->select='id_voucher';
		$criteria->order='id_voucher DESC';
		$field= self::model()->find($criteria);
		$getNextValue = (int) substr($field['id_voucher'], 1)+1;
		return sprintf('V%02s',$getNextValue);
	}

  
}
