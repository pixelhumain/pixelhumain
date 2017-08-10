<?php 
$I = new ApiTester($scenario);
$I->wantTo('Create, get and delete an organization');
$I->login("sylvain.barbot@gmail.com", "cobolisbad");
$name = 'Une organization en test final';
//Save new organization
$I->sendPOST('/element/save', ['name' => $name, 'type' => 'LocalBusiness', 'role' => 'member', "collection" => "organizations" ]);
//preferences[isOpenData]:true
//preferences[isOpenEdition]:true
$I->seeResponseCodeIs("200");
$I->seeResponseContains('"result":true');
$id = $I->grabDataFromResponseByJsonPath("$.id");

//Get the element
$I->sendGET('/element/get', ['type' => 'organizations', 'id' => $id[0]]);
$I->seeResponseContains('"result":true');
$I->seeResponseContains('"name":"'.$name.'"');

//Delete the organization
$I->sendGET('/element/delete', ['type' => 'organizations', 'id' => $id[0]]);
$I->seeResponseContains('"result":true');

//Get should return false
$I->sendGET('/element/get', ['type' => 'organizations', 'id' => $id[0]]);
$I->seeResponseContains('"result":false');
