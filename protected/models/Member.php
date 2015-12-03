<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property string $no_identity
 * @property string $id_member
 * @property string $first_name
 * @property string $family_name
 * @property string $date_birth
 * @property string $place_birth
 * @property string $citizenship
 * @property string $gender
 * @property string $marital_status
 * @property string $children_number
 * @property string $religion
 * @property string $address
 * @property string $phone1
 * @property string $phone2
 * @property string $mobile1
 * @property string $mobile2
 * @property string $email
 * @property string $income
 * @property string $hobby
 * @property string $other_hobby
 * @property string $cc
 * @property string $other_cc
 * @property integer $point
 * @property string $type_card
 * @property string $register_date
 * @property string $username
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member';
	}

	public $fullname;
	public $labelgender;
	public $text;
	public $id;
	

	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_identity, id_member, first_name, family_name, place_birth, date_birth, citizenship, gender, mobile1', 'required'),
            array('id_member, phone1, phone2, mobile1, mobile2, children_number, point', 'numerical', 'integerOnly'=>true),
			array('no_identity', 'length', 'max'=>25),
			array('id_member', 'length', 'max'=>7),
            array('first_name, place_birth, other_hobby, other_cc', 'length', 'max'=>20),
			array('family_name, citizenship, marital_status', 'length', 'max'=>15),
			array('gender, religion, income, cc', 'length', 'max'=>2),
			array('children_number', 'length', 'max'=>2),
			array('address', 'length', 'max'=>50),
			array('phone1, phone2, mobile1, mobile2', 'length', 'max'=>12),
            array('hobby', 'length', 'max'=>26),
			array('type_card', 'length', 'max'=>10),
			array('email', 'length', 'max'=>30),
            array('id_member','idvalidator'),
            array('id_member','unique'),
            //array('email','email'),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_member, first_name, family_name, date_birth, place_birth, citizenship, mobile1', 'safe', 'on'=>'search'),
		);
	}

    public function idvalidator(){

       preg_match('/^(1|2)/',$this->id_member,$matches);
       if (empty($matches) and !$this->hasErrors()) {
          $this->addError('id_member','ID Member is invalid.');
       }

    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        // 1. Member HAS MANY to Receipt foreign key id_member
        // 2. Member HAS MANY to Redeem foreign key id_member
        // 3. Member HAS ONE tp Upgrade Membership foreign key id_member
		return array(
          'receipt'=>array(self::HAS_MANY,'Receipt','id_member'),
          'redeem'=>array(self::HAS_MANY,'Redeem','id_member'),
		  'user'=>array(self::BELONGS_TO,'User','username'),
          'upgrademembership'=>array(self::HAS_ONE,'UpgradeMembership','id_member'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'no_identity' => 'No Identity',
			'id_member' => 'Id Member',
			'first_name' => 'First Name',
			'family_name' => 'Family Name',
			'date_birth' => 'Date Birth',
			'place_birth' => 'Place Birth',
			'citizenship' => 'Citizenship',
			'gender' => 'Gender',
			'marital_status' => 'Marital Status',
			'children_number' => 'Children Number',
			'religion' => 'Religion',
			'address' => 'Address',
			'phone1' => 'Phone1',
			'phone2' => 'Phone2',
			'mobile1' => 'Mobile1',
			'mobile2' => 'Mobile2',
			'email' => 'Email',
			'income' => 'Income',
			'hobby' => 'Hobby',
			'other_hobby' => 'Other Hobby',
			'cc' => 'Cc',
			'other_cc' => 'Other Cc',
			'point' => 'Point',
			'type_card' => 'Type Card',
            'register_date'=>'Register Date',
            'username'=>'Username',
			'fullname'=>'Full Name',
			'labelgender'=>'Gender',
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
		
		$gender = '';

		if (strtolower($this->id_member)==='male') {
			$gender = '0';
		}

		if (strtolower($this->id_member)==='female') {
			$gender = '1';
		}

		$criteria->addSearchCondition('no_identity',$this->id_member,true,'OR');
		$criteria->addSearchCondition('id_member',$this->id_member,true,'OR');
		$criteria->addSearchCondition('first_name',$this->id_member,true,'OR');
		$criteria->addSearchCondition('family_name',$this->id_member,true,'OR');
		$criteria->addSearchCondition('date_birth',$this->id_member,true,'OR');
		$criteria->addSearchCondition('place_birth',$this->id_member,true,'OR');
		$criteria->addSearchCondition('citizenship',$this->id_member,true,'OR');
		$criteria->addSearchCondition('mobile1',$this->id_member,true,'OR');
		$criteria->addSearchCondition('gender',$gender,true,'OR');
		
        $criteria->order = "register_date DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchPoint()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		if (!empty($this->id_member)) $criteria->addSearchCondition('id_member',$this->id_member,true,'OR');
		if (!empty($this->first_name)) {

			$criteria->condition='CONCAT(first_name," ",family_name) LIKE :param1';
			$criteria->params = array(':param1'=>'%'.$this->first_name.'%');
			
		}
		
        $criteria->order = "point DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind()
	{
		$this->fullname = sprintf('%s %s',$this->first_name,$this->family_name);
		$this->labelgender = ($this->gender === '0')?'Male':'Female';
		return parent::afterFind();
	}

	public function beforeSave()
	{
		if ($this->isNewRecord) {

			 // mendapatkan type card reguler / diamond
            $type                 = substr($this->id_member,0,1);
            $this->type_card 	  = $type ==='1'?'Regular':'Diamond';

            // tanggal daftar
            $this->register_date = date('Y-m-d');

            // petugas yang menangani
            $this->username = User::GetDataUser();
		}

		// jika pada cc ada yang pilih (8) maka field other cc diisi
        $this->other_cc      = ($this->cc ==='8')?$this->other_cc:'';

		return parent::beforeSave();
	}
}
