<?php
class LinkUser2GroupAction extends CAction
{
    public function run()
    {
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest && isset( $_POST['email'] ) && isset( $_POST['name'] ) )
        {
            $emails = explode(",",$_POST['email'] );
            $res = array(); 
            foreach ($emails as $email) {
            	if(isset($_POST['unlink']))
            		$res = array_merge($res, Group::removeMember($email  , $_POST['name'], $_POST['type'] ));
            	else
                	$res = array_merge($res, Group::addMember($email  , $_POST['name'], $_POST['type'] ));
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }
}