<script type="text/javascript">
var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
var domainName = "<?php echo Yii::app()->params["CO2DomainName"];?>";
var userId = "<?php echo Yii::app()->session['userId']?>";
var uploadUrl = "<?php echo Yii::app()->params['uploadUrl'] ?>";
var mainLanguage = "<?php echo Yii::app()->language ?>";
var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
var currentUrl = "<?php echo "#".Yii::app()->controller->id.".".Yii::app()->controller->action->id ?>";
var debugMap = [
    <?php if(YII_DEBUG) { ?>
       { "userId":"<?php echo Yii::app()->session['userId']?>"},
       { "userEmail":"<?php echo Yii::app()->session['userEmail']?>"}
    <?php } ?>
    ];

var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
var ctrlId = "<?php echo Yii::app()->controller->id;?>";
var actionId = "<?php echo Yii::app()->controller->action->id ;?>";
var moduleId = "<?php echo $parentModuleId?>";
var activeModuleId = "<?php echo $this->module->id?>";
</script>