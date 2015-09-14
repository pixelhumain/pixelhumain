<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : add event to cart
 */
class IpnFormAction extends CAction
{
   public function run() {
   
		$m = new MongoClient("mongodb://oceatoon:6ognom9_$@open-atlas.org:27017/");
		$db = $m->selectDB ( "pixelhumainQA" );
		require_once("../ph/protected/extensions/paynplug/lib/Payplug.php");

		$parametersFile = "../ph/protected/extensions/paynplug/azotlive/params.json";
		$headers = getallheaders();
		$parameters = Parameters::loadFromFile($parametersFile);

		/* For more security, put the keys in uppercase and retrieve
		 * the signature using the key in uppercase
		 */
		$headers = array_change_key_case($headers, CASE_UPPER);
		$signature = base64_decode($headers['PAYPLUG-SIGNATURE']);

		/* The data is sent in the body of the POST request in JSON format
		 * (MIME type = application / json).
		 * Example : {"state": "paid", "customer", "2", "transaction_id": 4121, "custom_data": "29", "order": "42"}
		 */
		$body = file_get_contents('php://input');

		// test body string
		//$body = '{"first_name": "Tib", "email": "oceatoon@gmail.com", "last_name": "Kat", "order": "53fef2c2e9ce27d845788b5d", "customer": "53e8b9645894c088d2177ab1", "state": "paid", "id_transaction": 563699, "status": 0, "origin": " payplug-php 0.9 PHP 5.3.27", "custom_data": null, "custom_datas": null, "amount": 100}';
		$data = json_decode($body);

		$pbkey = $parameters->payplugPublicKey;
		/* $pbkey = PayPlug public key that you saved from the setup page */
		$publicKey = openssl_pkey_get_public($pbkey);
		$isSignatureValid = openssl_verify($body , $signature, $pbkey, OPENSSL_ALGO_SHA1);

		/* Take into account the IPN and send an email with the confirmation*/
		if($isSignatureValid){
			$message = "IPN received for ".$data->first_name." ".$data->last_name." for an amount of ".(float)($data->amount / 100)." EUR<br/>".$body;
			//echo $message."<br/>";
			//mail("oceatoon@gmail.com","IPN Received",$message);
		} else {
			//mail("oceatoon@gmail.com","IPN Failed","The signature was invalid");
			echo "The signature was invalid"."<br/>";
		}

		
		//include("config.php");
		//echo $data->customer."<br>";
		//echo $data->order."<br>";
		//echo $data->email."<br>";

		//Tickets
		$tickets = new MongoCollection($db, 'tickets');
		$ts = $tickets->findOne(array("_id"=>new MongoId($data->order)));

		$persons = new MongoCollection($db, 'persons');
		$p = $persons->findOne(array("email"=>$ts["person"]["email"]));

		//Event
		$events = new MongoCollection($db, 'events');
		$e = $events->findOne(array("_id"=>new MongoId($data->customer)));

		$d = $e['startDate'];
		$d = explode("/",$e['startDate']);
		setlocale(LC_TIME, "fr_FR");
		$d = ucfirst(strftime("%A %d %B %Y",@mktime(0, 0, 0, $d[1], $d[0], $d[2])));
		$h = $e['doorTime'];

		//Organiser 
		$organizations = new MongoCollection($db, 'organizations');
		$o = $organizations->findOne(array("_id"=>new MongoId($e["organizer"]["@id"])));

		//if($isSignatureValid){
		    if(1){

		 
			//update payment status 
			$tickets = new MongoCollection($db, 'tickets');
			$t = $tickets->findOne(array("_id"=>new MongoId($data->order)));

			if( isset($t) && !$t["payed"] ){

				if( isset($data->id_transaction) ) {
				$payed = array("token"=>$data->id_transaction);
				} 

				$tickets->update( array("_id"=>new MongoId($data->order)), 
								  array( '$set' => array( "payed"=>$payed,"datePrint"=>time() ),
										 '$inc' => array("printed"=>1 ) ) 
								);
			
				$currentInventoryValue = $e["offers"]["inventoryLevel"]["value"];
				//generate pdf and save to folder
				if( isset($ts) && isset($ts["tickets"]) && isset($ts["tickets"]["@list"])){
					$now = date("d/m/Y h:i");
					foreach( $ts["tickets"]["@list"] as $key1=>$t )
					{
						foreach( $t["ticketNumbers"] as $key2=>$tn )
						{
							//echo "-----------------------------<br/>";
							/*echo $now."<br/>";
							echo $o["name"]." presente"."<br/>";
							echo $t['type']."<br/>";
							echo $e['name']."<br/>";
							echo "**".$t['price']." Euros**<br/>";
							echo $d." a ".$h." ".$e['location']['name']."<br/>";*/
							$currentInventoryValue++;
							//update ticket number sequence
							$ts["tickets"]["@list"][$key1]["ticketNumbers"][$key2]["ticketNumber"] = str_pad($currentInventoryValue, 5, '0', STR_PAD_LEFT);
							$ts["tickets"]["@list"][$key1]["ticketNumbers"][$key2]["ticketToken"] = md5( $tn["time"]."azotlive".$ts["tickets"]["@list"][$key1]["ticketNumbers"][$key2]["ticketNumber"]);
							//echo "ticketNumber : ".$ts["tickets"]["@list"][$key]["ticketNumber"]."<br/>";
							//echo "N° LIC : ".$o["licenceID"]."<br/>";
							//echo "genBarcode num : ".$tn["time"]."azotlive".$ts["tickets"]["@list"][$key]["ticketNumber"]."<br/>";
							//echo "below barcode num : ".$ts["tickets"]["@list"][$key]["ticketToken"]."<br/>";
							//echo "<br/><br/>";
							//update Event inventory
							$events->update( array("_id"=>new MongoId($data->customer)), 
											 array( '$inc' => array("offers.inventoryLevel.value"=>1 ) ) 
											);
						}
					}
					$tickets->update( array("_id"=>new MongoId($data->order)), 
									  array( '$set' => array( "tickets.@list"=>$ts["tickets"]["@list"] ))  
									);
				}
				//send email with pdf attached
				//include("http://".Yii::app()->createUrl("/azotlive/api/generateTicket"));
				
				
				require_once("../ph/protected/extensions/barcodegen/html/include/function.php");
				require_once("../ph/protected/extensions/fpdf.php");
				
				$offerID = Yii::app()->session['offer'];
				//$offerID = $data->order;
				//$ts = PHDB::findOne( PHType::TYPE_EVENTS, array( "_id" => new MongoId( $offerID ) ) );
				
				$tickets = new MongoCollection($db, 'tickets');
				$ts = $tickets->findOne(array("_id"=>new MongoId($offerID)));
				
				$image1 = "http://dev.azotlive.com/barcodegen/html/include/logo.png";   
				$now = new DateTime();
				$now->setTimezone(new DateTimeZone('Indian/Reunion'));
				$date = $now->format("d/m/Y G:i");

				/* $organizer_name = $ts["organizer"]["@Type"] . ' presente';
				$organizer_name = iconv('UTF-8', 'windows-1252', $organizer_name);
				$event_title = iconv('UTF-8', 'windows-1252', $ts['name']);
				$event_loc = $ts['location']['name'] . ', ';
				$event_loc = iconv('UTF-8', 'windows-1252', $event_loc);
				$event_time = $ts["startDate"];    
				$evn_loc_time =  $ts["startDate"] ." - ". $event_loc = iconv('UTF-8', 'windows-1252', $ts['location']['name']);
				$ticket_categoty = iconv('UTF-8', 'windows-1252', $t['type']);
				$price = $t['price'];
				$paid_price = "**"."$price"."Euros"."**";
				$org_licence = '12ycytdtyttgq24';
				$event_org_li = "Event Organizer Licence Number : "."$org_licence";
				$ticket_Number = $tn["ticketNumber"];
				$info = "organisateur ocsesionel";
				$organizer_info = "N LIC :". $ts["organizer"]["@id"];
				$barcode = time()."azotlive".$tn["ticketNumber"]; */
				// usage:
				$num_of_tickets = 4;
				$pdf = new FPDF('P','mm',array(150,101));


				$default_value = array();
				$default_value['filetype'] = 'PNG';
				$default_value['dpi'] = 30;
				$default_value['scale'] = isset($defaultScale) ? $defaultScale : 3;
				$default_value['rotation'] = 0;
				$default_value['font_family'] = 'Arial.ttf';
				$default_value['font_size'] = 28;

				$default_value['a1'] = '';
				$default_value['a2'] = '';
				$default_value['a3'] = '';

				$filetype = isset($_POST['filetype']) ? $_POST['filetype'] : $default_value['filetype'];
				$dpi = isset($_POST['dpi']) ? $_POST['dpi'] : $default_value['dpi'];
				$scale = intval(isset($_POST['scale']) ? $_POST['scale'] : $default_value['scale']);
				$rotation = intval(isset($_POST['rotation']) ? $_POST['rotation'] : $default_value['rotation']);
				$font_family = isset($_POST['font_family']) ? $_POST['font_family'] : $default_value['font_family'];
				$font_size = intval(isset($_POST['font_size']) ? $_POST['font_size'] : $default_value['font_size']);
				registerImageKey('filetype', $filetype);
				registerImageKey('dpi', $dpi);
				registerImageKey('scale', $scale);
				registerImageKey('rotation', $rotation);
				registerImageKey('font_family', $font_family);
				registerImageKey('font_size', $font_size);
				registerImageKey('code', 'BCGcode39');
				registerImageKey('thickness','90');

				$pdf = new FPDF('P','mm',array(150,101));
				
				foreach( $ts["tickets"]["@list"] as $t )
				{
					foreach( $t["ticketNumbers"] as $tn )
					{
						$event_data = PHDB::findOne( PHType::TYPE_EVENTS, array( "_id" => new MongoId( $t['@id'] ) ) );
						echo "<pre>";
						print_r($event_data);
						$organizer_name = $event_data["organizer"]["@Type"] . ' presente';
						$organizer_name = iconv('UTF-8', 'windows-1252', $organizer_name);
						$event_title = iconv('UTF-8', 'windows-1252', $event_data['name']);
						$event_loc = $event_data['location']['name'] . ', ';
						$event_loc = iconv('UTF-8', 'windows-1252', $event_loc);
						$event_time = $event_data["startDate"];    
						$evn_loc_time =  $event_data["startDate"] ." - ". $event_loc = iconv('UTF-8', 'windows-1252', $event_data['location']['name']);
						$ticket_categoty = iconv('UTF-8', 'windows-1252', $t['type']);
						$price = $t['price'];
						$paid_price = "**"."$price"."Euros"."**";
						$org_licence = '12ycytdtyttgq24';
						$event_org_li = "Event Organizer Licence Number : "."$org_licence";
						$ticket_Number = $tn["ticketNumber"];
						$info = "organisateur ocsesionel";
						$organizer_info = "N LIC :". $event_data["organizer"]["@id"];
						$barcode = time()."azotlive".$tn["ticketNumber"];
						
						registerImageKey('text', $ticket_Number);
						// Text in form is different than text sent to the image
						$text = convertText('Ticket Generation dummy text');
						$finalRequest = '';
						foreach (getImageKeys() as $key => $value) {
							$finalRequest .= '&' . $key . '=' . urlencode($value);
						}
					
						if (strlen($finalRequest) > 0) {
							$finalRequest[0] = '?';
						}
						$content = file_get_contents("http://dev.azotlive.com/barcodegen/html/image.php" .$finalRequest);
						file_put_contents('../ph/protected/extensions/BarCodeImages/barcode-'.$ticket_Number.'.png', $content);
					
						$pdf->AddPage("L");
						$pdf->SetAutoPageBreak(TRUE, 0);
						$pdf->SetFont('Arial','',12);
						$pdf->SetXY(0,4);
						$pdf->SetFillColor(92,143,203);
						$pdf->Rect(0, 18, 300, 4, 'F');
						$pdf->Image($image1, 4, $pdf->GetY(), 38.78);
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',11);
						$pdf->SetXY(110,5);
						$pdf->Cell (0,0,$date, 0,1, 'L');
						$pdf->SetFont('Arial','',8);
						$pdf->SetTextColor(0,0,0);
						$pdf->SetXY(42,16);
						$pdf->Cell (0,0,$organizer_name, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',12);
						$pdf->SetXY(10,20);
						$pdf->Cell (10,32,$ticket_categoty, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','B',13);
						$pdf->SetXY(10,20);
						$pdf->Cell (10,50,$paid_price, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','B',14);
						$pdf->SetXY(70,20);
						$pdf->Cell (70,42,$event_title, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',11);
						$pdf->SetXY(10,30);
						$pdf->Cell (0,46,$evn_loc_time, 0,1, 'L');
						$pdf->SetFillColor(92,143,203);
						$pdf->Rect(0, 57, 300, 4, 'F');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',9);
						$pdf->SetXY(10,59.2);
						$pdf->Cell (10,0,$ticket_Number, 0,1, 'L');
						$pdf->Image('../ph/protected/extensions/BarCodeImages/barcode-'.$ticket_Number.'.png',80,66,30,30);
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',8);
						$pdf->SetXY(0,94);
						$pdf->Cell (10,0,$organizer_info, 0,1, 'L');
					}
				}
				$pdf->Output('../ph/protected/extensions/EventTicketPDFs/'.$ticket_Number.'.pdf', 'F');
				
				
				// email stuff (change data below)
				$to = $ts["person"]["email"]; 
				$CC = "azotlivecontact@gmail.com"; 
				$from = "azotlive@gmail.com"; 
				$subject = "AzotLive : Billet URBAN BLOCK PARTY"; 
				$message = "<p><img src='http://dev.azotlive.com/barcodegen/html/include/logo.png' style='width:130px;float:left;padding:20px;'/>".
				"L'équipe d'azotlive.com vous souhaite de profiter de votre spectacle.<br/>".
				"Vous trouverez ci-joint le(s) billet(s) correspondant a votre commande.<br/>".
				"<br/>".
				"Informations spécifiques:<br/>".
				"Contrôle et fouille à l’entrée.<br/>".
				"Nourriture et boissons (autres que bouteille d’eau) interdites dans l’enceinte de la NORDEV.<br/>".
				"Appareil photo et caméra interdits.<br/>".
				"L’annulation d’un artiste ne donne pas lieu à un remboursement du billet.<br/><br/>".
				"Les places à retirer dans les Mac Donald's, achetées avant le 30 septembre 2014, seront disponibles à partir du 1er octobre 2014.<br/>
				Les places à retirer dans les Mac Donald's, achetées à partir du 30 septembre 2014, seront disponibles à partir du 10 octobre 2014.<br/>";
				 
				// a random hash will be necessary to send mixed content
				$separator = md5(time());

				// carriage return type (we use a PHP end of line constant)
				$eol = PHP_EOL;

				// attachment name
				$filename = $ticket_Number.".pdf";

				// encode data (puts attachment in proper format)
				$pdfdoc = $pdf->Output("", "S");
				$attachment = chunk_split(base64_encode($pdfdoc));

				// main header
				$headers  = "From: ".$from.$eol;
				$headers  = "CC: ".$CC.$eol;
				$headers .= "MIME-Version: 1.0".$eol; 
				$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

				// no more headers after this, we start the body! //

				$body = "--".$separator.$eol;
				$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;

				// message
				$body .= "--".$separator.$eol;
				$body .= "Content-Type: text/html; charset=\"utf-8\"".$eol;
				$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
				$body .= $message.$eol;

				// attachment
				$body .= "--".$separator.$eol;
				$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
				$body .= "Content-Transfer-Encoding: base64".$eol;
				$body .= "Content-Disposition: attachment".$eol.$eol;
				$body .= $attachment.$eol;
				$body .= "--".$separator."--";

				// send message
				mail($to, $subject, $body, $headers);

				
			} 
		} 
		 else 
		{
		mail("oceatoon@gmail.com","IPN Failed","The signature was invalid");
		//echo "The signature was invalid 2";
		}

	}
}