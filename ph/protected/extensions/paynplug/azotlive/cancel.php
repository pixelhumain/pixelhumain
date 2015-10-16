<?php
require_once("../lib/Payplug.php");
$parametersFile = __DIR__ . "/params.json";
$headers = getallheaders();
$parameters = Parameters::loadFromFile($parametersFile);
echo "in cancel";

