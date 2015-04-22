<?php
/**
 * Retrieve all the Countries 
 * @return [json] {value : "theValue", text : "the Text"}
 */
class GetCountriesAction extends CAction
{
    public function run()
    {
        $countries = array();
        foreach (OpenData::$phCountries as $key => $value) {
            array_push($countries, array("value" => $key, "text" => $value));
        }
            
        Rest::json($countries); 
        Yii::app()->end();
    }
}