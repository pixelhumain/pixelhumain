<?php
/**
 * Retrieve all the Countries 
 * @return [json] {value : "theValue", text : "the Text"}
 */
class GetCountriesAction extends CAction
{
    public function run()
    {
        
        $countries = OpenData::getCountriesList();
        Rest::json($countries); 
        Yii::app()->end();
    }
}