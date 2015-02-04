<?php
	class SendMessageVitrineAction extends CAction{
		public function run(){
			if( isset( $_POST['email'] ) && isset( $_POST['msg'] ) && isset( $_POST['cp'] ) )
		        {
		        	$app = (isset($_POST['app'])) ? $_POST['app'] : null;
		            $res = MessageVitrine::createMessage($_POST['email']  , $_POST['msg'], $_POST['cp'], $app );
		        } else
		            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
		        Rest::json($res);
		        Yii::app()->end();
		    }
	}
?>