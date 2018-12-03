<!-- start: PAGESLIDE RIGHT -->
<?php 
/*$cssAnsScriptFilesModule = array(
	'/js/default/notifications.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->getParentAssetsUrl());*/
$cssAnsScriptFilesModule = array(
 	'/css/notifications.css'
 );
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl. '/assets');
?>
<div id="notificationPanelSearch" class="arrow_box">
		<div class="notifications">
			<a href="javascript:;" data-element="" data-id="<?php echo Yii::app()->session["userId"]?>" data-type="<?php echo Person::COLLECTION ?>" class="btn-notification-action pull-left btn-reload-notif">
				<i class="fa fa-refresh"></i>
			</a>
			<div class="pageslide-title pull-left">
				<i class="fa fa-angle-down"></i> <i class="fa fa-bell"></i> <span class="hidden-xs">Notifications</span> 
			</div> 
			<a href="javascript:;" onclick='removeAllNotifications("")' class="btn-notification-action btn-danger pull-right" style="font-size:12px;">
				<?php echo Yii::t("common","All") ?> <i class="fa fa-trash"></i>
			</a>	
			<a href="javascript:;" onclick='markAllAsRead("");' class="btn-notification-action pull-right hidden-xs" style="font-size:12px;">
				<?php echo Yii::t("common","Marked all as read") ?> 
				<i class="fa fa-check-square-o"></i>
			</a>	
			<a href="javascript:;" onclick='markAllAsRead("");' class="btn-notification-action pull-right visible-xs" style="font-size:12px;">
				<?php echo Yii::t("common","Ok") ?> 
				<i class="fa fa-check-square-o"></i>
			</a>	
			
			<ul class="pageslide-list notifList col-md-12 col-sm-12 col-xs-12">
				<li class="col-xs-12"><i class='fa fa-spin fa-circle-o-notch'></i> <?php echo Yii::t("common","Currently loading") ?></li>
			</ul>
			<div class="bottomNotifs col-xs-12 pull-left text-center">
				<a href="#settings" class="lbh" style="font-size:12px;">
					<i class="fa fa-cogs"></i> <?php echo Yii::t("common","Set your notifications") ?> 
				</a>
			</div> 
			
		</div>
</div>
<script type="text/javascript">
	resetNotifTimestamp();
</script>
<!-- end: PAGESLIDE RIGHT -->
