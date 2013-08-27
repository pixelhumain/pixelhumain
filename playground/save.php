<?php
require_once('./config/configDB.php');
// Get this at your MongoLab.com user page
$url = "https://api.mongolab.com/api/1/databases/".$dbconfig['db']."/collections/citoyens?apiKey=".$dbconfig['MONGOLAB_API_KEY'];

$data = json_encode(
  array(
	"name"=> $_POST["name"],
    "manager"=> $_POST["pilot"],
    "type"=> $_POST["genreType"],
	//"logo"=> $_POST["logo"],
    "description"=> $_POST["objet"],
    "actions"=> array(
					array(        
						"name"=> $_POST["actionName"],
						"tags"=> array($_POST["actionType"]),
						"description"=> $_POST["actionDesc"],
						"area"=>$_POST["area"],
						//"images"=> $_POST["images"],
						"origine"=> $_POST["origineActionCheckbox"],
						"website"=> $_POST["website"]
					)
				),
    "email"=> $_POST["email"],
    "adress"=> $_POST["adress"],
    "cp"=> $_POST["cp"],
    "city"=> $_POST["city"],
    "phone"=> $_POST["tel"],
	"country"=> $_POST["country"]
  )
);


 
try { 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data),
      )
  );
 
  $response = curl_exec($ch);
  $error = curl_error($ch);
  $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
 
  echo json_encode(array("result"=>true));
} catch (Exception $e) {
  echo json_encode(array("result"=>false));
}