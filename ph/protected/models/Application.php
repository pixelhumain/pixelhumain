<?php
/*

 */
class Application
{ 
	const DEFAULT_NAME = "Pixel Humain";
	const ICON = "fa-th";
	public $name;
	public $logoUrl;

	public function __construct($appId) {
		$this->populateDefaultAppSetting();
		
		// Search in the database for the application $appId
		if (isset($appId)) 
			$app = PHDB::findOne(PHType::TYPE_APPLICATIONS,array( "key" => $appId ));
			
		if (!$app) {
			Yii::log("No application is set on Application collection", "info");
		} 

		if (isset($app["name"]))
			$this->name = $app["name"]; 	

		if (isset($app["logo"])) 
			$this->logoUrl = Yii::app()->getModule($app["key"])->assetsUrl.$app["logo"];	
	}

	//Default application
	private function populateDefaultAppSetting() {
		$this->logoUrl = Yii::app()->getRequest()->getBaseUrl(true).'/images/logo/logo144.png';
		$this->name = self::DEFAULT_NAME;
	}
}
