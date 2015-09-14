<?php
class SendMessageAction extends CAction
{
    public function run()
    {
        if( isset( $_POST['email'] ) && isset( $_POST['msg'] ) )
        {
        	$app = (isset($_POST['app'])) ? $_POST['app'] : null;
            $res = Message::createMessage($_POST['email']  , $_POST['msg'], $app );
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }
}