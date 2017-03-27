<?php 
$I = new ApiTester($scenario);
$I->wantTo('Create an organization');
$I->login("sylvain.barbot@gmail.com", "cobolisbad");
$I->sendPOST('/element/save', ['name' => 'Une organization en test5', 'type' => 'LocalBusiness', 'role' => 'member', "collection" => "organizations", "key" => "organization" ]);
//preferences[isOpenData]:true
//preferences[isOpenEdition]:true
$I->seeResponseCodeIs("200");
$I->seeResponseContains('"result":false');