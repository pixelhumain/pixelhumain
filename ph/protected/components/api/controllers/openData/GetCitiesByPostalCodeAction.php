<?php
/**
 * Retrieve all the Countries 
 * @return [json] {value : "codeinsee", text : "the Text"}
 */
class GetCitiesByPostalCodeAction extends CAction
{
    public function run()
    {
        //TODO SBAR - Limited to the reunion department
        $defaultDepartment = "974";

        $cities = array();
        $postalCode = isset($_POST["postalCode"]) ? $_POST["postalCode"] : null;
        if ($postalCode && isset(OpenData::$communeMap[$defaultDepartment][$postalCode])) {
            foreach (OpenData::$communeMap[$defaultDepartment][$postalCode] as $value) {
                array_push($cities, array("value" => $value["codeinsee"], "text" => $value["name"]));
            }
        } else {
            $cities = array(array("value" => "00000", "text" => "Unknown Postal Code"));
        }
        Rest::json($cities); 
        Yii::app()->end();
    }
}