<h1>TODO : Jolie GED TEEO</h1>
<h2>Contenu du dossier teeo/<?php echo $folder?></h2>
<?php foreach(CFileHelper::findFiles(Yii::getPathOfAlias("webroot.upload.teeo.".$folder),array("exclude"=>array("index.php"),"level"=>0)) as $f){?>
	<li class="group">
		<h3>
		    <?php $name = pathinfo($f, PATHINFO_FILENAME)?>
			<?php echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction(".$_GET['CKEditorFuncNum'] .", '".Yii::app()->createUrl('/templates?name='.$name)."', '$name')</script>"; ?>
			
		</h3>
	</li>
	<?php }?>