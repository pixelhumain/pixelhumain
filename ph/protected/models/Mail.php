<?php
/*
Contains anything generix for the site 
 */
class Mail
{
    
    public static function send( $params, $force = false )
    {
        if( PH::notlocalServer() || $force ){
            $message = new YiiMailMessage;
            $message->view =  $params['tpl'];
            $message->setSubject($params['subject']);
            $message->setBody($params['tplParams'], 'text/html');
            $message->addTo($params['to']);
            $message->from = $params['from'];

            return Yii::app()->mail->send($message);
        } else 
            return false;
    }
    public static function notlocalServer(){
    	return (stripos($_SERVER['SERVER_NAME'], "127.0.0.1") === false && stripos($_SERVER['SERVER_NAME'], "localhost:8080") === false );
    }
}