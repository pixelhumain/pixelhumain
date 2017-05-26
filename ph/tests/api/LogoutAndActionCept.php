<?php 
$I = new ApiTester($scenario);
$I->wantTo('Login + Logout + make a creation => control the error');
$I->login("sylvain.barbot@gmail.com", "cobolisbad");
$I->amHttpAuthenticated('sylvain.barbot@gmail.com', 'cobolisbad');
$I->sendPOST('/person/logout');
$I->seeResponseCodeIs("200");
$I->sendPOST('/element/save', ['name' => 'Une organization en test', 'type' => 'LocalBusiness', 'role' => 'member', "collection" => "organizations" ]);
//preferences[isOpenData]:true
//preferences[isOpenEdition]:true
$I->seeResponseCodeIs("200");
$I->seeResponseContains('"result":false,"msg":"Login First"');