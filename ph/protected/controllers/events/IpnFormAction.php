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
		$db = $m->selectDB ( "azotliveDev" );
		require_once("/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/paynplug/lib/Payplug.php");

		$parametersFile = "/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/paynplug/azotlive/params.json";
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
		$body = '{"first_name": "Tib", "email": "anil.gupta@techinflo.com", "last_name": "Kat", "order": "555448a7e9ce27da7cdb2d14", "customer": "53e8b9645894c088d2177ab1", "state": "paid", "id_transaction": 837578, "status": 0, "origin": " payplug-php 0.9 PHP 5.3.27", "custom_data": null, "custom_datas": null, "amount": 100}';
		$data = json_decode($body);

		$pbkey = $parameters->payplugPublicKey;
		/* $pbkey = PayPlug public key that you saved from the setup page */
		$publicKey = openssl_pkey_get_public($pbkey);
		$isSignatureValid = openssl_verify($body , $signature, $pbkey, OPENSSL_ALGO_SHA1);

		/* Take into account the IPN and send an email with the confirmation*/
		/* if($isSignatureValid){
			$message = "IPN received for ".$data->first_name." ".$data->last_name." for an amount of ".(float)($data->amount / 100)." USD<br/>".$body;
			//echo $message."<br/>";
			mail("anil.gupta@techinflo.com","IPN Received",$message);
		} else {
			mail("anil.gupta@techinflo.com","IPN Failed","The signature was invalid");
			//echo "The signature was invalid"."<br/>";
		} */

		
		//if($isSignatureValid){

				require_once("/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/barcodegen/html/include/function.php");
				require_once("/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/fpdf.php");
				
				
				$offerID = $data->order;
				
				
				$tickets = new MongoCollection($db, 'tickets');
				$ts = $tickets->findOne(array("_id"=>new MongoId($offerID)));
				
				//if( !$ts["payed"]["token"] ){

					/* if( isset($data->id_transaction) ) {
						$payed = array("token"=>$data->id_transaction);
					} 

					$tickets->update( array("_id"=>new MongoId($offerID)), 
										 array( '$set' => array( "payed"=>$payed,"datePrint"=>time() ),
												'$inc' => array("printed"=>1 ) 
											) 
					); */
				
				$image1 = "http://dev.azotlive.com/barcodegen/html/include/logo.png";   
				$now = new DateTime();
				$now->setTimezone(new DateTimeZone('Indian/Reunion'));
				$date = $now->format("d/m/Y G:i");

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

				//$pdf = new FPDF('P','mm',array(150,101));
				
				
				foreach( $ts["tickets"]["@list"] as $t )
				{
					
					$events = new MongoCollection($db, 'events');
					$event_data = $events->findOne(array("_id"=>new MongoId( $t['@id'] )));
					
					$tkt_cnt = $t['quantity'];
					$tkt_new_id = $t['@id'];
					if( $tkt_new_id != $tkt_id){
						$r = 1;
						
						$pdf->AddPage("L");
						$pdf->SetAutoPageBreak(TRUE, 0);
						$pdf->SetFont('Arial','',12);
						if($event_data["image"]){
							$event_image = '/home/humanpixel/qa.pixelhumain.com/'.$event_data["image"];
							$pdf->Image($event_image, 50,32,50,30);
						}
						else{
							$pdf->Image($image1, 50,32,50,30);
						}
					}
					
					foreach( $t["ticketNumbers"] as $tn )
					{
						$tkt_id = $t['@id'];
					
						
						$person_email = $ts["person"]["email"]; 
						$citoyens = new MongoCollection($db, 'citoyens');
						$buyer = $citoyens->findOne(array("email" => $person_email ));
						$buyer_name = $buyer['firstname']." ".$buyer['lastname'];
						
						$organizer_name = $event_data["organizer"]["@Type"] . ' presente';
						$organizer_name = iconv('UTF-8', 'windows-1252', $organizer_name);
						$event_title = iconv('UTF-8', 'windows-1252', $event_data['name']);
						$event_desc = iconv('UTF-8', 'windows-1252', $event_data['description']);
						$event_loc = $event_data['location']['name'] . ', ';
						$event_loc = iconv('UTF-8', 'windows-1252', $event_loc);
						$EVENT_DATE = $event_data["doorTime"];
								
								$eventstart = explode(" ", $EVENT_DATE);
								
									$expl_start_1 = $eventstart[0];
									$ett = explode('/',$expl_start_1);
									$result3 = implode("",$ett);
									
									$expl_start_2 = $eventstart[1];
									
									setlocale(LC_TIME, 'fr_FR.UTF-8');                                              
									$monthName = strftime('%B', mktime(0, 0, 0, $ett[0]));
									
									$weekday = strftime("%A",strtotime($EVENT_DATE));	
										
						$event_time = iconv('UTF-8', 'windows-1252', $weekday ." ". $ett[1] ." ". $monthName ." ". $ett[2] ." - ". $expl_start_2);
						$event_location = iconv('UTF-8', 'windows-1252', $event_data['location']['name']);
						$evn_loc_time = $event_data["startDate"] ." - ". $event_loc = iconv('UTF-8', 'windows-1252', $event_data['location']['name']);
						$ticket_categoty = iconv('UTF-8', 'windows-1252', $t['type']);
						$price = $t['price'];
						$paid_price = "**"."$price"."Euros"."**";
						$org_licence = '12ycytdtyttgq24';
						$event_org_li = "Event Organizer Licence Number : "."$org_licence";
						$ticket_Number = $tn["ticketNumber"];
						
						
							$formatted_value = str_pad($r, 5, "0", STR_PAD_LEFT); 
							$ticket_Number_New = $ticket_Number."-".$formatted_value;
						
						
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
						file_put_contents('/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/BarCodeImages/barcode-'.$ticket_Number.'.png', $content);
					
						
						
						
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
						$pdf->SetXY(70,25);
						$pdf->Cell (70,43,$event_time, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',11);
						$pdf->SetXY(70,30);
						$pdf->Cell (70,44,$event_location, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',11);
						$pdf->SetXY(10,30);
						$pdf->Cell (0,46,$buyer_name, 0,1, 'L');
						$pdf->SetFillColor(92,143,203);
						$pdf->Rect(0, 57, 300, 4, 'F');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',9);
						$pdf->SetXY(10,59.2);
						$pdf->Cell (10,0,$ticket_Number_New, 0,1, 'L');
						$pdf->Image('/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/BarCodeImages/barcode-'.$ticket_Number.'.png',80,66,30,30);
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',8);
						$pdf->SetXY(0,94);
						$pdf->Cell (10,0,$organizer_info, 0,1, 'L');
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('Arial','',7);
						$pdf->SetXY(10,98);
						$chunks = str_split(strip_tags($event_desc), 100);
						foreach($chunks as $chunk_content) {
							$pdf->Cell (10,$Y+3,$chunk_content, 0,1, 'L');
						}
						$r++;
					}
					
				}
				$pdf->Output('/home/humanpixel/qa.pixelhumain.com/ph/protected/extensions/EventTicketPDFs/'.$offerID.'.pdf', 'F');
				
				
				// email stuff (change data below)
				$to = $ts["person"]["email"]; 
				//$CC = "azotlivecontact@gmail.com"; 
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
				$filename = $offerID.".pdf";

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
			
			
				// updating inventory level
				foreach( $ts["tickets"]["@list"] as $t )
				{
					foreach( $t["ticketNumbers"] as $tn )
					{
						
						$events = new MongoCollection($db, 'events');
						$event_data = $events->findOne(array("_id"=>new MongoId( $t['@id'] )));
						
						$d = $event_data['startDate'];
						$d = explode("/",$event_data['startDate']);
						setlocale(LC_TIME, "fr_FR");
						$d = ucfirst(strftime("%A %d %B %Y",@mktime(0, 0, 0, $d[1], $d[0], $d[2])));
						$h = $event_data['doorTime'];
						
						
						
						$currentInventoryValue = $event_data["offers"]["inventoryLevel"]["value"];
							
						if( isset($ts) && isset($ts["tickets"]) && isset($ts["tickets"]["@list"])){
							$now = date("d/m/Y h:i");
							foreach( $ts["tickets"]["@list"] as $key1=>$t )
							{
								foreach( $t["ticketNumbers"] as $key2=>$tn )
								{
									$currentInventoryValue++;
										
									$ts["tickets"]["@list"][$key1]["ticketNumbers"][$key2]["ticketNumber"] = str_pad($currentInventoryValue, 5, '0', STR_PAD_LEFT);
									$ts["tickets"]["@list"][$key1]["ticketNumbers"][$key2]["ticketToken"] = md5( $tn["time"]."azotlive".$ts["tickets"]["@list"][$key1]["ticketNumbers"][$key2]["ticketNumber"]);
										
									 $events->update( array("_id"=>new MongoId($t['@id'])), 
														 array( '$inc' => array("offers.inventoryLevel.value"=>1 ) ),
														 array('multiple'=>true, 'safe'=>true)
												); 
								}
							}
							$tickets->update( array("_id"=>new MongoId($offerID)), 
												  array( '$set' => array( "tickets.@list"=>$ts["tickets"]["@list"] ))  
											);
						} 
					}
				}

			//}	
		/* } 
		else 
		{
			mail("anil.gupta@techinflo.com","IPN Failed","The signature was invalid");
		} */

	}
}