<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class SaveSessionAction extends CAction
{
    public function run()
    {
        $res = array();
        if( Yii::app()->session["userId"] )
        {
            $email = $_POST["email"];
            //if exists login else create the new user
            if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) ))
            {
                //udate the new app specific fields
                $newInfos = array();
                $newInfos['email'] = $email;
                $newInfos['name'] = $_POST['name'];
                if( isset($_POST['tags']) )
                    $newInfos['tags'] = explode(",",$_POST['tags']);

                //specific application routines
                if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    if($app = Yii::app()->mongodb->applications->findOne( array( "key"=> $appKey ) ))
                    {
                        //when registration is done for an application it must be registered
                    	$newInfos['applications'] = array( $appKey => array( "usertype"=> (isset($_POST['type']) ) ? $_POST['type']:$_POST['app']  ));

                    	
                        //check for application specifics defined in DBs application entry
                    	if( isset( $app["registration"] ) && ( $app["registration"] == "mustBeConfirmed" ))
                    		$newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                        $res['applicationExist'] = true;
                    }else
                        $res['applicationExist'] = false;
                }   

                Yii::app()->mongodb->survey->update( array( "email" => $email ), 
                                                       array('$set' => $newInfos ) 
                                                      );
                $res['result'] = true;
                $res["id"] = $newInfos["_id"];
            }else
                $res = array('result' => false , 'msg'=>"user doen't exist");
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}