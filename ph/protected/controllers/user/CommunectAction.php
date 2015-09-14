<?php
class CommunectAction extends CAction
{
    public function run()
    {
        $res = Citoyen::communect( $_POST["email"] , $_POST["cp"] ); 
        Rest::json($res);
        Yii::app()->end();
    }
}