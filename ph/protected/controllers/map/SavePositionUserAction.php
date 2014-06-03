<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class SavePositionUserAction extends CAction
{
    public function run()
    {
      //  $lat = $_POST["lat"];
      //  $lng = $_POST["lng"];
        $email = $_POST["email"];
        
        //$res = Citoyen::register( $email, $_POST["pwd"]);
        $res = "tout va bien";
        if( Yii::app()->request->isAjaxRequest )
        {
            //if exists login else create the new user
            //$res = Citoyen::register( $email, $_POST["pwd"]);
            if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) ))
            {
                //udate the new app specific fields
                $newInfos = array();
               	if( isset($_POST['lat']) )
                    $newInfos['lat'] = $_POST['lat'];
                 if( isset($_POST['lng']) )
                   $newInfos['lng'] = $_POST['lng'];
                    	
                //specific application routines
                if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    //when registration is done for an application it must be registered
                	$newInfos['applications'] = array( $appKey => array( "usertype"=>$_POST['type']  ));

                	$app = Yii::app()->mongodb->applications->findOne( array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                	if( isset( $app["registration"] ) && $app["registration"] == "mustBeConfirmed")
                		$newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                }
				
                Yii::app()->mongodb->citoyens->update( array("email" => $email), 
                                                       array('$set' => $newInfos ) 
                                                      );
                $res .= ", Yii::app()->mongodb->citoyens->update OK ! new position : (".$newInfos['lat'].", ".$newInfos['lng'].")";
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}