<?php

/**
 * This is the model class for table "upgrade_membership".
 *
 * The followings are the available columns in table 'upgrade_membership':
 * @property string $old_idmember
 * @property string $new_idmember
 * @property string $username
 * @property string $upgrade_date
 * @property integer $old_point
 */
class UpgradeMembership extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'upgrade_membership';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('old_idmember, new_idmember, username, upgrade_date, old_point', 'required'),
			array('old_point', 'numerical', 'integerOnly'=>true),
			array('old_idmember, new_idmember', 'length', 'max'=>7),
			array('username', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('old_idmember, new_idmember, username, upgrade_date, old_point', 'safe', 'on'=>'search'),
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
          'member'=>array(self::BELONGS_TO,'Member','new_idmember'),
          'user'=>array(self::BELONGS_TO,'User','username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'old_idmember' => 'Old Idmember',
			'new_idmember' => 'New Idmember',
			'username' => 'Username',
			'upgrade_date' => 'Upgrade Date',
			'old_point' => 'Old Point',
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

		$criteria->compare('old_idmember',$this->old_idmember,true);
		$criteria->compare('new_idmember',$this->new_idmember,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('upgrade_date',$this->upgrade_date,true);
		$criteria->compare('old_point',$this->old_point);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UpgradeMembership the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function GetOldIdMember($new_idmember)
	{
		$model = self::model()->findByAttributes(array('new_idmember'=>$new_idmember));
		return $model;
	}

	public function GetNewIdMember($old_idmember)
	{
		$model = self::model()->findByAttributes(array('old_idmember'=>$old_idmember));
		return $model;
	}
}
