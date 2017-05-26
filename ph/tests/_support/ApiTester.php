<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

   /**
    * Define custom actions here
    */
    public function login($email, $password)
    {
        $I = $this;
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
		$I->sendPOST('/person/authenticate', ['email' => $email, 'pwd' => $password]);
		$I->seeResponseCodeIs("200");
    }
}
