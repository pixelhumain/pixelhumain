<?php
include_once('barcodegen/html/include/function.php');
require_once('fpdf/fpdf.php');
class PDF extends FPDF {
 
    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    // tweak these values (in pixels)
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;
 
    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }
 
    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);
 
        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;
 
        $scale = min($widthScale, $heightScale);
 
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }
 
    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);
 
        // you will probably want to swap the width/height
        // around depending on the page's orientation
        $this->Image(
            $img, (self::A4_HEIGHT - 200),
            (self::A4_WIDTH - 100),
            200,
            150
        );
    }
}
$image1 = "http://dev.azotlive.com/barcodegen/html/include/logo.png";   
$date = date("d/m/Y h:i");


$organizer_name = $o["name"] . ' presente';
$event_title = 'le BIG UP BLOCK PARTY';
$event_loc = 'Event Location, ';
$event_time = '11:30:10 AM';    
$evn_loc_time =  "samedi 18 octobre a 19h00-parc des expositions NORDEV";
$ticket_categoty = 'MOINS DE 25 ANS';
$price = '18';
$paid_price = "**"."$price"."Euros"."**";
$org_licence = '12ycytdtyttgq24';
$event_org_li = "Event Organizer Licence Number : "."$org_licence";
$ticket_Number = 10000011423;
$info = "organisateur ocsesionel";
$organizer_info = "N LIC :"."$info";
$barcode = "50000000000";
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
registerImageKey('thickness','5');

$pdf = new FPDF('P','mm',array(150,101));
foreach( $ts["tickets"]["@list"] as $t )
{
	foreach( $t["ticketNumbers"] as $tn )
	{
		$organizer_name = $o["name"] . ' presente';
		$organizer_name = iconv('UTF-8', 'windows-1252', $organizer_name);
		$event_title = iconv('UTF-8', 'windows-1252', $e['name']);
		$event_loc = $e['location']['name'] . ', ';
		$event_loc = iconv('UTF-8', 'windows-1252', $event_loc);
		$event_time = $d." a ".$h;    
		$evn_loc_time =  $d." a ".$h." - ". $event_loc = iconv('UTF-8', 'windows-1252', $e['location']['name']);
		$ticket_categoty = iconv('UTF-8', 'windows-1252', $t['type']);
		$price = $t['price'];
		$paid_price = "**"."$price"."Euros"."**";
		$org_licence = '12ycytdtyttgq24';
		$event_org_li = "Event Organizer Licence Number : "."$org_licence";
		$ticket_Number = $tn["ticketNumber"];
		$info = "organisateur ocsesionel";
		$organizer_info = "N LIC :". $o["licenceID"];
		$barcode = time()."azotlive".$tn["ticketNumber"];
		
		registerImageKey('text', $ticket_Number);
		// Text in form is different than text sent to the image
		$text = convertText($text);
		$finalRequest = '';
		foreach (getImageKeys() as $key => $value) {
			$finalRequest .= '&' . $key . '=' . urlencode($value);
		}
	
		if (strlen($finalRequest) > 0) {
			$finalRequest[0] = '?';
		}
		$content = file_get_contents("http://dev.azotlive.com/barcodegen/html/image.php" .$finalRequest);
		file_put_contents('BarCodeImages/barcode-'.$x.'.png', $content);
	
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
		$pdf->SetFont('Arial','',12);
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
		$pdf->SetXY(45,30);
		$pdf->Cell (0,46,$evn_loc_time, 0,1, 'L');
		$pdf->SetFillColor(92,143,203);
		$pdf->Rect(0, 57, 300, 4, 'F');
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',11);
		$pdf->SetXY(10,59.2);
		$pdf->Cell (10,0,$ticket_Number, 0,1, 'L');
		$pdf->Image('BarCodeImages/barcode-'.$x.'.png',64,66,84);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->SetXY(0,94);
		$pdf->Cell (10,0,$organizer_info, 0,1, 'L');
	}
}
$pdf->Output("EventTicketPDFs/ticket.pdf", 'F');

// email stuff (change data below)
$to = $p["email"]; 
$CC = "azotlivecontact@gmail.com,oceatoon@gmail.com,gopi@techinflo.com"; 
$from = "azotlivecontact@gmail.com"; 
$subject = "AzotLive : Billet URBAN BLOCK PARTY"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "ticket.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
//$headers  = "CC: ".$CC.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
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