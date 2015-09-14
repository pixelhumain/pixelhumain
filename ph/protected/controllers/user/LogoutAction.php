<?php
class LogoutAction extends CAction
{
    public function run()
    {
        Yii::app()->session["userId"] = null;
        Yii::app()->session["userEmail"] = null;
        Yii::app()->session["user"] = null;
	}
}