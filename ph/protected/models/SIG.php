<?php
/*
Contains anything generix for the site 
 */
class SIG
{
    
    public static function clientScripts()
    {
        $cs = Yii::app()->getClientScript();
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/sig.css');
		$cs->registerCssFile("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.draw.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.draw.ie.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/MarkerCluster.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/MarkerCluster.Default.css');

		$cs->registerScriptFile('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/leaflet.draw-src.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/leaflet.draw.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/leaflet.markercluster-src.js' , CClientScript::POS_END);
		return $cs;
    }
    
    
}