<?php 
class Rest
{

	public static function json($res, $param = null, $checkLoggued = true){
		header('Content-Type: application/json');
		/*if($checkLoggued){
			$res["sessionUserId"] = Person::logguedAndValid();
		}*/

		//Log the result of the action which is logging
		if(isset(Yii::app()->session["logsInProcess"][Yii::app()->controller->id.'/'.Yii::app()->controller->action->id])){
			$logsInProcess = Yii::app()->session["logsInProcess"];
			Log::setLogAfterAction($logsInProcess[Yii::app()->controller->id.'/'.Yii::app()->controller->action->id], @$res);
			unset($logsInProcess[Yii::app()->controller->id.'/'.Yii::app()->controller->action->id]);
			Yii::app()->session["logsInProcess"] = $logsInProcess;
		}

		if(empty($param))
			echo json_encode( $res );
		else
			echo json_encode( $res, $param );  
	}
	
	public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
	    // set the status
	    $status_header = 'HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage($status);
	    header($status_header);
	    // and the content type
	    header('Content-type: ' . $content_type);
	 
	    // pages with body are easy
	    if($body != '')
	    {
	        // send the body
	        echo $body;
	    }
	    // we need to create the body if none is passed
	    else
	    {
	        // create some body messages
	        $message = '';
	 
	        // this is purely optional, but makes the pages a little nicer to read
	        // for your users.  Since you won't likely send a lot of different status codes,
	        // this also shouldn't be too ponderous to maintain
	        switch($status)
	        {
	            case 401:
	                $message = 'You must be authorized to view this page.';
	                break;
	            case 404:
	                $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
	                break;
	            case 500:
	                $message = 'The server encountered an error processing your request.';
	                break;
	            case 501:
	                $message = 'The requested method is not implemented.';
	                break;
	        }
	 
	        // servers don't always have a signature turned on 
	        // (this is an apache directive "ServerSignature On")
	        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
	 
	        // this should be templated in a real-world solution
	        $body = '
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	    <title>' . $status . ' ' . self::getStatusCodeMessage($status) . '</title>
	</head>
	<body>
	    <h1>' . self::getStatusCodeMessage($status) . '</h1>
	    <p>' . $message . '</p>
	    <hr />
	    <address>' . $signature . '</address>
	</body>
	</html>';
	 
	        echo $body;
	    }
	    Yii::app()->end();
	}

	public static function getStatusCodeMessage($status)
	{
	    // these could be stored in a .ini file and loaded
	    // via parse_ini_file()... however, this will suffice
	    // for an example
	    $codes = Array(
	        200 => 'OK',
	        400 => 'Bad Request',
	        401 => 'Unauthorized',
	        402 => 'Payment Required',
	        403 => 'Forbidden',
	        404 => 'Not Found',
	        500 => 'Internal Server Error',
	        501 => 'Not Implemented',
	    );
	    return (isset($codes[$status])) ? $codes[$status] : '';
	}

	public static function checkAuth()
	{
	    // Check if we have the USERNAME and PASSWORD HTTP headers set?
	    if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
	        // Error: Unauthorized
	        self::_sendResponse(401);
	    }
	    $username = $_SERVER['HTTP_X_USERNAME'];
	    $password = $_SERVER['HTTP_X_PASSWORD'];
	    // Find the user
	    $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
	    if($user===null) {
	        // Error: Unauthorized
	        self::_sendResponse(401, 'Error: User Name is invalid');
	    } else if(!$user->validatePassword($password)) {
	        // Error: Unauthorized
	        self::_sendResponse(401, 'Error: User Password is invalid');
	    }
	}
}