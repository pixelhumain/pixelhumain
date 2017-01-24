<?php 
class MailHelper  {
	
	const KEY_ERROR_500_IPERFONY  = 'criticalErrorIperfony500'; // sent to techAdmin
	const KEY_NEW_MONTHLY_INVOICE = 'newInvoice'; // new invoice sent to all admin iPerfony
	const KEY_PASSWORD_CHANGED_CONFIRMATION    = 'pwdChange';
	const KEY_PASSWORD_REGENERATED = 'pwdAdminRegenerate';
	const KEY_PASSWORD_RECOVERY_ACTIVATIONEMAIL = 'restoredPwd'; // email sent when user request a password recovery. Will contains activation link
	const KEY_NEW_REGISTERED_USER_BY_PILOT_ALERT_SENT_TO_ADMIN = 'pilotAddedNewUser';
	const KEY_NEW_REGISTERED_USER = 'newUserRegistered'; // sent to freshly registered user
	const KEY_PREF_MEETING_COMMENT = 'pref_meeting_comment';
     /**
      * 
      * Generic Mail sender method send the generic perfony html mail  
      * @param array $params
      * contains any param passed on to the generic view file
      *
      *  basePath : absolute server path
      *  imgPath : absolute path to images folder
      *  subject : ovious
      *  email : message mail will be send to
      *  sectionTitle : message Section tilte
      *  title : message title
      *  genericText : information text at the top 
      *  view : defaults to 'contact' but could be different 
      *  body : is the main body of the message 
      *  link : appended to the message for direct access to the subject
      *  placeholders : key/value array to use to find/replace in body
      *  
      * @param string $view : name of the view to be used a base
      */
    public static function mail($params){
        $k_path_url = (isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
        $params['basePath'] = $k_path_url.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
        $params['imgPath'] = $params['basePath'].'images/email';
        $yiimail = New YiiMailMessage;
        
        if (!isset($params['subject'])) 
            $params['subject'] = Yii::t('mail', 'subject'.$params['key']);
		$yiimail->setSubject($params['subject']);
		
        $yiimail->setTo(array($params['email']));
        
        $yiimail->setFrom(array(Yii::app()->params['adminEmail']));
        
        if(!isset($params['sectionTitle'])) 
            $params['sectionTitle'] = Yii::t('mail', 'sectionTitle'.$params['key']);
            
        if(!isset($params['title'])) 
            $params['title'] = Yii::t('mail', 'title'.$params['key']);
            
        if(!isset($params['genericText'])) 
            $params['genericText'] = Yii::t('mail', 'genericText'.$params['key']);
            
        $yiimail->view = (isset($params['view'])) ? $params['view'] : 'contact';
            
        if (!isset($params['body'])) 
            $params['body'] = Yii::t('mail', 'body'.$params['key']);
        if (isset($params['link'])) 
            $params['body'] .= "<br/><a href='".Yii::app()->createAbsoluteUrl("/".$params['link'])."'>".Yii::t(PTranslate::CAT_MAILS, 'Direct Link to access')."</a>";
        
		if (isset($params['placeholders'])){
			foreach($params['placeholders'] as $key=>$val){
				//throw new CHttpException('pouet avant : '.$params['placeholders'].' après : '.str_replace($key, $val, $params['placeholders']));
				$params['body'] = str_replace($key, $val, $params['body']);
			}
		}             
            
        $yiimail->setBody($params, 'text/html');
        
        if(Yii::app()->params['sendMails'])
           Yii::app()->mail->send($yiimail); 
    }
     
}
?>