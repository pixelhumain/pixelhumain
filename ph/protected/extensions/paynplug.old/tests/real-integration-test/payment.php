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
        die("Fail : \n" . $e->getMessage());
    }
}
else {
    try {
        $parameters = Parameters::loadFromFile($parametersFile);
    } catch (Exception $e) {
        die("Fail : \n" . $e->getMessage());
    }
}

Payplug::setConfig($parameters);




/* Creates a payment request */
$params = array();
$paymentUrl;
$payment = new PaymentUrl($amount, "USD", $ipnUrl);

try {
    $paymentUrl = $payment->generateUrl(array(
        "amount" => (float) $_POST["amount"] * 100,
        "cancelUrl" => "http://www.monsite.com/cancel-url",
        "currency" => "USD",
        "email" => $_POST["email"],
        "firstName" => $_POST["firstName"],
        "ipnUrl" => $_POST["ipnUrl"],
        "lastName" => $_POST["lastName"],
	  "returnUrl"=> "http://www.azotlive.com/paynplug/tests/real-integration-test/return.php"
    ));

    header("Location: $paymentUrl");
    exit();
} catch (Exception $e) {
    die("Fail : \n" . $e->getMessage());
}

