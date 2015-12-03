<?php

/**
 * This is the model class for table "rule".
 *
 * The followings are the available columns in table 'rule':
 * @property string $id_rule
 * @property string $rule_name
 * @property integer $point
 */
class Rule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_rule, rule_name, point', 'required'),
			array('point', 'numerical', 'integerOnly'=>true),
			array('id_rule', 'length', 'max'=>3),
			array('rule_name', 'length', 'max'=>20),
            array('point','length','max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rule_name, point', 'safe', 'on'=>'search'),
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
          'receipt'=>array(self::HAS_MANY,'Receipt','id_rule'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_rule' => 'Id Rule',
			'rule_name' => 'Rule Name',
			'point' => 'Point',
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

		
		$criteria->addSearchCondition('rule_name',$this->rule_name,true,'OR');
		$criteria->addSearchCondition('point',$this->rule_name,true,'OR');
		$criteria->order='id_rule DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function autonumber(){
		$criteria = new CDbCriteria;
		$criteria->select='id_rule';
		$criteria->order='id_rule DESC';
		$field= self::model()->find($criteria);
		$getNextValue = (int) substr($field['id_rule'], 1)+1;
		return sprintf('R%02s',$getNextValue);

	}
}
