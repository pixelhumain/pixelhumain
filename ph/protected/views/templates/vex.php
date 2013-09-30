<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/vex/vex.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/vex/vex-theme-os.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/vex/vex.combined.min.js' , CClientScript::POS_END);
?>

</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
		<p><a class="demo-alert hs-brand-button">Open an alert</a></p>
		
		<p><a class="demo-confirm hs-brand-button">Open a confirm</a></p>
		<div class="demo-result-confirm hs-doc-callout hs-doc-callout-info" style="display: none"></div>
		
		<p><a class="demo-prompt hs-brand-button">Open a prompt</a></p>
		<div class="demo-result-prompt hs-doc-callout hs-doc-callout-info" style="">Callback value: <b>false</b></div>
</div></div>
<script type="text/javascript">
initT['uploadInit'] = function(){
	vex.defaultOptions.className = 'vex-theme-os';

	$('.demo-alert').click(function(){
	    vex.dialog.alert('Thanks for checking out Vex!');
	});

	$('.demo-confirm').click(function(){
	    vex.dialog.confirm({
	        message: 'Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>Are you absolutely sure you want to destroy the alien planet?<br/>',
	        callback: function(value) {
	            $('.demo-result-confirm').html('Callback value: <b>' + value + '</b>').show();
	        }
	    });
	});

	$('.demo-prompt').click(function(){
	    vex.dialog.prompt({
	        message: 'What planet did the aliens come from?',
	        placeholder: 'Planet name',
	        callback: function(value) {
	            $('.demo-result-prompt').html('Callback value: <b>' + value + '</b>').show();
	        }
	    });
	});
	
};
</script>