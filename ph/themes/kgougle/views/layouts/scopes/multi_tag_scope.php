
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); ?>

<?php  HtmlHelper::registerCssAndScriptsFiles(array('/js/menus/multi_tags_scopes.js'), $this->module->assetsUrl); ?>

<span data-tpl="default.scopes.multi_tag_scope">
<?php 
$this->renderPartial($layoutPath.'scopes/multi_tag', array("me"=>$me)); 
$this->renderPartial($layoutPath.'scopes/multi_scope', array("me"=>$me));
?>

<?php  if( isset( Yii::app()->session['userId']) ){ ?>
<button class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
      data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
  <i class="fa fa-bell"></i>
  <span class="notifications-count topbar-badge badge badge-success animated bounceIn">
  	<?php count($this->notifications); ?>
  </span>
</button>
<?php } ?>

</span>

<script>
jQuery(document).ready(function() {
	
	showEmptyMsg();

});

</script>