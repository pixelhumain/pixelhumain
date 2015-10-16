<?php

require_once("../../lib/Payplug.php");

$parametersFile = __DIR__ . "/params.json";
$parameters;
 
/* Loads parameters (from PayPlug if needed) */
if ( ! file_exists($parametersFile)) {
    try {
        $parameters = Payplug::loadParameters("azotlivecontact@gmail.com", "MVPU6TXU5M4GSKP3");
        $parameters->saveInFile($parametersFile);
    } catch (Exception $e) {
        die("Fail : \n @" . __LINE__ .$e->getMessage());
    }
}
else {
    try {
        $parameters = Parameters::loadFromFile($parametersFile);
    } catch (Exception $e) {
        die("Fail : \n @" . __LINE__ . $e->getMessage());
    }
}

Payplug::setConfig($parameters);

/* Creates a payment request */
$ipnUrl = "http://azotlive.com/paynplug/tests/real-integration-test/ipn.php";
$params = array();
$paymentUrl;
$payment = new PaymentUrl($amount, "EUR", $ipnUrl);

try {
    $paymentUrl = $payment->generateUrl(array(
        "amount" => (float) $_POST["amount"] * 100,
        "cancelUrl" => "http://azotlive.com/index_confirm.php",
        "currency" => "EUR",
        "customData" => "29",
        "customer" => "2",
        "email" => $_POST["email"],
        "firstName" => $_POST["firstName"],
        "ipnUrl" => $ipnUrl,
        "lastName" => $_POST["lastName"],
        "order" => "42"
    ));

    header("Location: $paymentUrl");
    exit();
} catch (Exception $e) {
    die("Fail : \n @" . __LINE__ .$e->getMessage());
}

