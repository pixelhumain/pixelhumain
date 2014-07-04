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
            if($user = PHDB::findOne( PHType::TYPE_CITOYEN, array( "email" => $email ) )) 
            {
                //udate the new app specific fields
                $newInfos = array();
                if( isset($_POST['email']) )
                    $newInfos['email'] = $_POST['email'];
                if( isset($_POST['email']) && $_POST['email'] != Yii::app()->session["userEmail"] )
                    $newInfos['createdByEmail'] = Yii::app()->session["userEmail"];
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
                if( isset($_POST['when']) )
                    $newInfos['date'] = $_POST['when'];
                if( isset($_POST['where']) )
                    $newInfos['where'] = $_POST['where'];
                if( isset($_POST['group']) )
                    $newInfos['group'] = $_POST['group'];

                if( isset( $_POST["app"] ) )
                {
                	$appKey = $_POST["app"];
                	$newInfos['applications'] = array( $appKey => array( "usertype"=>$_POST['type'] ));
                	$app = PHDB::findOne( PHType::TYPE_APPLICATIONS, array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                	if( isset( $app["registration"] ) && $app["registration"] == "mustBeConfirmed")
                		$newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                }
                
                //check if group exists else create the new group
                if(!PHDB::findOne( PHType::TYPE_GROUPS, array( "type"=>$_POST['type'],"name"=>$_POST['name'] ) ))
                {
                    PHDB::insert( PHType::TYPE_GROUPS,$newInfos);
                    $res = array("result" => true, 
                                 "msg"    => $_POST['type']." has been created");
                } else {
                    //if there's an email change 
                    PHDB::update( PHType::TYPE_GROUPS,array("name" => $_POST['name']), 
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