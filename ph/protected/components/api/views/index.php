<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/api.css'); 
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);

$this->pageTitle=$this::moduleTitle;
?>


<div class="containeri apiList">
	<div class="hero-uniti">
		<?php 
		$user = PHDB::findOne(PHType::TYPE_CITOYEN, array("_id"=>new MongoId(Yii::app()->session["userId"])));
		if( (isset( Yii::app()->session["userId"]) && isset($user[CitoyenType::NODE_ISADMIN]) ) //PH admin have direct access
			|| ( isset( $this->module ) && isset( $user[PHType::TYPE_APPLICATIONS]) //modulae admins have access to the api
										&& isset( $user[PHType::TYPE_APPLICATIONS][$this->module->id])
										&& isset( $user[PHType::TYPE_APPLICATIONS][$this->module->id][CitoyenType::NODE_ISADMIN])  ) )
		{?>
		<h2>A.P.I <?php echo $this::moduleTitle?>  : List all URLs</h2>
		<ul>
			
			<?php foreach ($this->sidebar1 as  $e) { 
				if( !isset( $e["menuOnly"])){
				?>

				<!-- ////////////////////////////////////////////////////////////////////////////// -->

				<li ><i class="sectionIcon fa <?php echo $e['iconClass']?>"></i><h3 class="blockp"><?php echo $e['label']?> <?php if(isset($e['children']))echo "( ".count($e['children'])." )"?>  <a class="<?php echo $e['key']?>Icon fa fa-eye<?php if(isset($e['hide'])) echo '-slash'?>" href="javascript:;" onclick="toggle('<?php echo $e['key']?>');"></a></h3></li>
				<li class="<?php echo $e['key']?> <?php if(isset($e['hide'])) echo 'hide'?>">
					<?php 
					$params = ( isset( $e['blocks']) ) ? array("blocks"=>$e['blocks']) : (( isset( $e['generate'] ) ) ? array("blocks"=>$this->sidebar1) : array());
					if( isset( $e['generate'] ) && isset($e["children"]))
					{
						foreach ($e["children"] as $key => $child) 
						{
							//tpl attribute specifies a specific location as a path 
							if( isset($child["tpl"]) )
							{
								$pathTpl = $child['tpl'];
								if(is_file(Yii::getPathOfAlias($pathTpl).".php") )
								{
									echo "<li class='block' id='block".$child['key']."'>";
									$this->renderPartial( $pathTpl,$params ); 
									echo "</li>";
								}else
									echo "<span style='color:red'>This template ".$child['key']." doesn't exist yet : ".Yii::getPathOfAlias($child['tpl']).".php</span>";
							} else 
							{
								//otherwise fetch the tpl from the generic api views folder

								$pathTpl = (isset($child["key"])) ? "application.components.api.views.".$e["key"].".".$child["key"] : null;
								if($pathTpl && is_file(Yii::getPathOfAlias($pathTpl).".php") )
								{
									echo "<li class='block' id='block".$child['key']."'>";
									$this->renderPartial( $pathTpl,$params ); 
									echo "</li>";
								}else
									echo "<span style='color:red'>This template ".$child['label']." has no tpl specified </span>";
							}
						}
					} else {
						//in this case the whole api section is fetched from a given path 
						if( isset($e['key']) && is_file(Yii::getPathOfAlias($path.$e['key']).".php") )
							$this->renderPartial( $path.$e['key'],$params ); 
						else
							echo "<span style='color:red'>This template ".$e['key']." doesn't exist yet : ".Yii::getPathOfAlias($path.$e['key']).".php</span>";
					}
					?>
				</li>

				<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<?php }} ?>
			
		</ul>
		<?php } else { ?>
			<h2>Restricted Area</h2>
			you can contact an admin <a href="mail:contact@pixelhumain.com"><i class="fa fa-mail"></i></a>
		<?php } ?>
	</div>
</div>