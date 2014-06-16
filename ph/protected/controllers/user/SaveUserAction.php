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
            if(PHDB::findOne(PHType::TYPE_CITOYEN,array( "email" => $email ) ))
            {
                //udate the new app specific fields
                $newInfos = array();
                if( isset($_POST['cp']) )
                    $newInfos['cp'] = $_POST['cp'];
                if( isset($_POST['name']) )
                    $newInfos['name'] = $_POST['name'];
               if( isset($_POST['tags']) )
                    $newInfos['tags'] = explode(",",$_POST['tags']);

                //specific application routines
                if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    //when registration is done for an application it must be registered
                	$newInfos['applications'] = array( $appKey => array( "usertype"=> (isset($_POST['type']) ) ? $_POST['type']:$_POST['app']  ));

                	$app = PHDB::findOne(PHType::TYPE_APPLICATIONS,array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                	if( isset( $app["registration"] ) && ( $app["registration"] == "mustBeConfirmed" ))
                		$newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                }

                PHDB::update(PHType::TYPE_CITOYEN,
                            array("email" => $email), 
                            array('$set' => $newInfos ) 
                            );
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}