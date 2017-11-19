
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); ?>

<?php  HtmlHelper::registerCssAndScriptsFiles(array('/js/menus/multi_tags_scopes.js'), $this->module->assetsUrl); ?>

<span class="" data-tpl="default.scopes.multi_tag_scope">
<?php 
	$this->renderPartial($layoutPath.'scopes/multi_tag', array("me"=>$me)); 
	$this->renderPartial($layoutPath.'scopes/multi_scope', array("me"=>$me));
?>
</span>

<script>
jQuery(document).ready(function() {
	
	showEmptyMsg();

});

</script>