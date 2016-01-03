<?php
/**
 * [actionAddWatcher 
 * create or update position of user connected (logged)
 * if user not logged : exit
 * @return [string] 
 */
class SavePositionUserAction extends CAction
{
    public function run()
    {
      //  $lat = $_POST["lat"];
      //  $lng = $_POST["lng"];
      if(!isset(Yii::app()->session["userEmail"])) 
      {
      	Rest::json("Vous devez être connecté pour modifier votre position");  
        Yii::app()->end();
      }
      
        $email =  Yii::app()->session["userEmail"]; //$_POST["email"];
        
        if( Yii::app()->request->isAjaxRequest )
        {
            if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) ))
            {
                //udate the new app specific fields
                $newPos = array();
               	if( isset($_POST['lat']) )
                    $newPos['latitude'] = $_POST['lat'];
                 if( isset($_POST['lng']) )
                   $newPos['longitude'] = $_POST['lng'];
            	
            	$newInfos = array('geo' => $newPos);
            	
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
                $msg = "Ok ! La position de " . $email . " a bien été modifiée : (".$newInfos['geo']['lat'].", ".$newInfos['geo']['lng'].")";
                $res = array('result' => true , 'msg'=>$msg);
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}