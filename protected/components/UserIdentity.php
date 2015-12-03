<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $username;
	public $password;
	
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$model = User::model()->findByAttributes(array('username'=>$this->username,'password'=>md5($this->password)));
	
		if($model === null) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else{
		    $this->setState('realName',$model->name);
            $this->setState('lastLogin',date('d M Y',strtotime($model->last_login)));
			$this->setState("level",$model->level);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	
}