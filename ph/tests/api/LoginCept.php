<?php 
$I = new ApiTester($scenario);
$I->wantTo('Login and check Auth');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/person/authenticate', ['email' => 'sylvain.barbot@gmail.com', 'pwd' => 'cobolisbad']);
$I->seeResponseCodeIs("200"); // 200
$I->seeResponseIsJson();
$I->seeResponseContains('"result":true');
$I->amHttpAuthenticated('sylvain.barbot@gmail.com', 'cobolisbad');

?>