<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class SaveUserAction extends CAction
{
    public function run()
    {
       	$email = $_POST["email"];
        if( Yii::app()->request->isAjaxRequest )
        {
        	//if exists login else create the new user
            $res = Citoyen::register( $email, $_POST["pwd"]);
         //   if($res['result'])
            if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) ))
            {
            	$res .=  "email found, ";
           		$newInfos = array();
                if( isset($_POST['cp']) )
                    $newInfos['cp'] = $_POST['cp'];
                if( isset($_POST['name']) )
                    $newInfos['name'] = $_POST['name'];
                if( isset($_POST['tags']) )
                    $newInfos['tags'] = explode(",",$_POST['tags']);
				if( isset($_POST['geo']) )
                    $newInfos['geo'] = $_POST['geo'];
                
                //specific application routines
                if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    //when registration is done for an application it must be registered
                	$newInfos['applications'] = array( $appKey => array( "usertype"=> (isset($_POST['type']) ) ? $_POST['type']:$_POST['app']  ));

                	$app = Yii::app()->mongodb->applications->findOne( array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                	if( isset( $app["registration"] ) && ( $app["registration"] == "mustBeConfirmed" ))
                		$newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                }
				Yii::app()->mongodb->citoyens->update( array("email" => $email), 
                                                       array('$set' => $newInfos ));
               	$res .=  "proc end";
            }
            
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}