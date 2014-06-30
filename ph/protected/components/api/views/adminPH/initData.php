<div class="fss">
	- check if init data is installed
<br/>
- list all files to import for initialisation
<?php 
if(file_exists(Yii::getPathOfAlias(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.".data" )))
{
	foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.".data" )) as $f)
	{?>
			
		<br/><a href="<?php echo Yii::app()->createUrl( $f)?>">
			<?php echo pathinfo($f, PATHINFO_FILENAME)?>
		</a>
<?php }
} else 
	echo "Nothing to import";
?>
									
<br/><br/>
	<a href="javascript:initData()">initialise data</a><br/>
	<div id="initDataResult" class="result fss"></div>
	<script>
		function initData(){
			params = {}; 
			testitpost("initDataResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/initdata',params);
		}
	</script>
</div>
