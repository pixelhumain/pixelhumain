<!DOCTYPE html>

<!-- ****************************** THEME CO2 ******************************-->
<?php 

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';
    $parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;
    $modulePath = ( @Yii::app()->params["module"]["parent"] ) ?  "../../../".$parentModuleId."/views"  : "..";

    $cs = Yii::app()->getClientScript();

    $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";

    $params = CO2::getThemeParams();
    $metaTitle = @$params["metaTitle"];
    $metaDesc = @$params["metaDesc"]; 
    $metaImg = Yii::app()->getRequest()->getBaseUrl(true)."/themes/CO2".@$params["metaImg"];
    phpinfo();
?>
