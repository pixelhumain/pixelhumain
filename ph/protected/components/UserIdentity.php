<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
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
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}

	private function authenticateHeader()
	{
	    // Check if we have the USERNAME and PASSWORD HTTP headers set?
	    if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
	        // Error: Unauthorized
	        $this->_sendResponse(401);
	    }
	    $username = $_SERVER['HTTP_X_USERNAME'];
	    $password = $_SERVER['HTTP_X_PASSWORD'];
	    // Find the user
	    $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
	    if($user===null) {
	        // Error: Unauthorized
	        $this->_sendResponse(401, 'Error: User Name is invalid');
	    } else if(!$user->validatePassword($password)) {
	        // Error: Unauthorized
	        $this->_sendResponse(401, 'Error: User Password is invalid');
	    }
	}
}