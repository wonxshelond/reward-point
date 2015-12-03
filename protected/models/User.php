<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $level
 * @Property date   $last_login
 * @Property string $active
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}
  
  public $repeat_password;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, name, level', 'required','on'=>'register'),
      array('username','unique','on'=>'register'),
      array('password','login','on'=>'login'),
      array('password, repeat_password','required','on'=>'register'),
      array('username, password','required','on'=>'login'),
			array('username', 'length', 'max'=>10),
      array('name', 'length', 'max'=>35),
			array('password, repeat_password', 'length', 'max'=>10,'on'=>'register'),
      array('repeat_password','safe'),
      array('repeat_password','compare','compareAttribute'=>'password','on'=>'register'),
			array('level', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('username, name, level, active, last_login', 'safe', 'on'=>'search'),
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
            'member'=>array(self::HAS_MANY,'Member','username'),
            'redeem'=>array(self::HAS_MANY,'Redeem','username'),
            'receipt'=>array(self::HAS_MANY,'Receipt','username'),
            'upgrademembership'=>array(self::HAS_MANY,'UpgradeMembership','username')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'name' => 'Name',
			'password' => 'Password',
			'level' => 'Level',
			'last_login'=>'Last Login',
			'active'=>'Active',
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
        $translate = strtolower($this->name);
        $level = strtolower($this->name);
		if ($translate === 'active'){
			$translate = '1';
		}

		if ($translate === 'non-active'){
			$translate = '0';
		}

		

		
		
		
		
		$criteria->addSearchCondition('username',$this->name,true,'OR');
		$criteria->addSearchCondition('name',$this->name,true,'OR');
		$criteria->addSearchCondition('level',$this->name,true,'OR');
		$criteria->addSearchCondition('active',$translate,true,'OR');
		$criteria->addSearchCondition('last_login',$this->name,true,'OR');
		//$criteria->addCondition("username <> 'root'");
        $criteria->order="active DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public function beforeSave(){
     
     if ($this->isNewRecord){
        $this->password = md5($this->password);
        $this->active = '1';
        $this->last_login = date('Y-m-d');
     }else{
        if (!empty($this->password)){
          $this->password = md5($this->password);
        }else{
          $oldPassword = self::model()->findByPk($this->username);
          $this->password = $oldPassword->password;
        }
     }  
     return parent::beforeSave();
     
  }

  public function login(){

     if (!$this->hasErrors()){

     	$login = new UserIdentity($this->username,$this->password);
  	    $login->authenticate();
  	    switch ($login->errorCode) {
  	 	case UserIdentity::ERROR_NONE:
  	 		$duration = 3600*24;
  	 		Yii::app()->user->login($login,$duration);
  	 		return true;
  	 		break;
  	 	case UserIdentity::ERROR_USERNAME_INVALID or UserIdentity::ERROR_PASSWORD_INVALID:
  	 	     $this->addError('username','Username is incorrect.');
			 $this->addError('password','Password is incorrect.');
  	 	     break;
  	 	default:
  	 		$this->addError('password','Password is incorrect.');
			 $this->addError('password','Password is incorrect.');
  	 		break;
  	    }
     }

  	 
  }

  public static function GetDataUser()
  {
	 $username = Yii::app()->user->getId();
	 $user = self::model()->findByPk($username);
	 if (is_null($user))
		throw new CHttpException(400,'invalid request');
	 else
		return $username;
  }
}
