<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : confirmation email / notification
 */
class SaveGroupAction extends CAction
{
    public function run()
    {
        $email = $_POST["email"];
		$res = null;
        if( Yii::app()->request->isAjaxRequest)
        {
            //creating user must exist
            if($user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) )) 
            {
                //udate the new app specific fields
                $newInfos = array();
                if( isset($_POST['email']) )
                    $newInfos['email'] = $_POST['email'];
                if( isset($_POST['cp']) )
                    $newInfos['cp'] = $_POST['cp'];
                if( isset($_POST['name']) )
                    $newInfos['name'] = $_POST['name'];
                if( isset($_POST['phoneNumber']) )
                    $newInfos['phoneNumber'] = $_POST['phoneNumber'];
                if( isset($_POST['type']) )
                    $newInfos['type'] = $_POST['type'];
                if( isset($_POST['tags']) )
                    $newInfos['tags'] = explode(",",$_POST['tags']);

                if( isset( $_POST["app"] ) )
                {
                	$appKey = $_POST["app"];
                	$newInfos['applications'] = array( $appKey => array( "usertype"=>$_POST['type'] ));
                	$app = Yii::app()->mongodb->applications->findOne( array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                	if( isset( $app["registration"] ) && $app["registration"] == "mustBeConfirmed")
                		$newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                }
                
                //check if group exists else create the new group
                if(!Yii::app()->mongodb->groups->findOne( array( "type"=>$_POST['type'],"name"=>$_POST['name'] ) ))
                {
                    Yii::app()->mongodb->groups->insert( $newInfos);
                    $res = array("result" => true, 
                                 "msg"    => $_POST['type']." has been created");
                } else {
                    //if there's an email change 
                    Yii::app()->mongodb->groups->update( array("name" => $_POST['name']), 
                                                        array('$set' => $newInfos ) 
                                                      );
                    $res = array("result" => true, 
                                 "msg"    => $_POST['type']." has been updated");
                }
                //TODO : confirmation email on create
                //TODO : notification on update
            } else 
                $res = array('result' => false, "msg"=>"Connected user must exist");
         } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');

        Rest::json($res);  
        Yii::app()->end();
    }
}