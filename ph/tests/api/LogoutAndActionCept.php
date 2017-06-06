<?php 
$I = new ApiTester($scenario);
$I->wantTo('Login + Logout + make a creation => control the error');
$I->login("sylvain.barbot@gmail.com", "cobolisbad");
//Logout
$I->sendPOST('/person/logout');
$I->seeResponseCodeIs("200");
//Try to create an element
$I->sendPOST('/element/save', ['name' => 'Une organization en test', 'type' => 'LocalBusiness', 'role' => 'member', "collection" => "organizations" ]);
$I->seeResponseCodeIs("200");
//Not possible
$I->seeResponseContains('"msg":"Login First"');