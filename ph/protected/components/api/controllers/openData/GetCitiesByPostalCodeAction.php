<?php
/**
 * Retrieve all the Countries 
 * @return [json] {value : "codeinsee", text : "the Text"}
 */
class GetCitiesByPostalCodeAction extends CAction
{
    public function run()
    {
        $errorMessage = array(array("value" => "", "text" => "Unknown Postal Code"));
        $cities = array();
        $postalCode = isset($_POST["postalCode"]) ? $_POST["postalCode"] : null;
        try {
            $cities = SIG::getCitiesByPostalCode($postalCode);
        } catch (CTKException $e) {
            $cities = array("unknownId" => array("name" => "Unknown Postal Code", "insee" => ""));
        }

        Rest::json($cities); 
        Yii::app()->end();
    }
}