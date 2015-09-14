<?php
class GetNodeByAction extends CAction
{
    public function run($type, $count=null)
    {
        if(isset(Yii::app()->session["userId"]))
        {
	        $user = Yii::app()->mongodb->citoyens->findOne( array("_id" => new MongoId( Yii::app()->session["userId"] ) ));
	        if(isset($user[$type]))
	        {
		        if(!$count)
		            $res = array($type => $user[$type]);
		        else
		            $res = array('count' => count ( $user[$type] ));
		    } else
		    	$res = array('result' => false,"msg"=>"ThisTypeDoesntExistFortheUser");
	    } else 
	    	$res = array('result' => false,"msg"=>"noUserLogguedIn");
        Rest::json( $res );
        Yii::app()->end();
    }
}