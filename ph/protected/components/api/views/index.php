<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/api.css'); 
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/clean.css'); 
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.columns.min.js' , CClientScript::POS_END);

$this->pageTitle="API ".$this::moduleTitle;
function blockHTML($pathTpl,$entry,$params,$parent){
	//echo $entry["key"];
	$str = "<li class='block' id='block".$entry['key']."'>";
	$str .= "<h4>".$entry['label']."</h4>";
	$actions = "";
	foreach ($entry["actions"] as $ak => $av) {
		$actions .= $ak." > ".$av."<br/>";
	}
	$formInfo = ( isset( $entry["microformat"] ) ) ? "microformat : ".$entry["microformat"]  : "file > api/views/".$parent['key']."/".$entry['key'].".php";
	$str .= "<div class='fss fr txtright'>".
				$entry['desc']."<br/>".
				$formInfo."<br/>".
				$actions."<br/>".
			"</div>";
	
	if( isset( $entry["microformat"] ) ) {
		$microformat = PHDB::findOne(PHType::TYPE_MICROFORMATS, array("key"=>$entry["microformat"]));
		$str .= "<a href='javascript:;' onclick='openModal(\"".$entry["microformat"]."\",\"".$microformat["collection"]."\",null,\"".$microformat["template"]."\")'  class='btn'>".$entry['microformat']."</a><br/>";
	} else
		$str .= Yii::app()->controller->renderPartial( $pathTpl,$params,true );
		
	$str .= "<div class='clear'>&nbsp;</div></li>";
	return $str;
}
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
			<li><i class="sectionIcon fa fa fa-list"></i><h3 class="blockp">Scenario  <a class="scenarioIcon fa fa-eye-slash" href="javascript:;" onclick="toggle('scenario');"></a></h3></li>
			<li class="scenario hide">
		<?php 

			foreach ( $this->sidebar1 as  $e ) 
			{ 
				if( !in_array( $e["key"] , array("modules") ) && isset( $e["children"] ) && isset( $e["generate"] ) )
				{
					$icon = ( isset( $e["iconClass"] ) ) ? '<i class="'.$e["iconClass"].'"></i>' : '';
					echo '<h4  class="blocky">'.$icon.$e["label"].'</h4>';
					echo '<ul class="blocki">';
					foreach ($e["children"] as $key => $child) 
					{
						if( isset($child["desc"]) && isset($child["key"]) )
						{
							echo '<li><a class="btn btn-small btn-primary" href="javascript:;" onclick="scrollTo(\'#block'.$child["key"].'\')">'.strtoupper($child["label"])." </a> ".$child["desc"].'</li>';
						}
					}
					echo '</ul>';
				}
			}

			echo '</li>';
			
			foreach ( $this->sidebar1 as  $e ) 
			{ 
				if( !isset( $e["menuOnly"]))
				{
				?>
					<li ><i class="sectionIcon fa <?php echo $e['iconClass']?>"></i><h3 class="blockp"><?php echo $e['label']?> <?php if(isset($e['children']))echo "( ".count($e['children'])." )"?>  <a class="<?php echo $e['key']?>Icon fa fa-eye<?php if(isset($e['hide'])) echo '-slash'?>" href="javascript:;" onclick="toggle('<?php echo $e['key']?>');"></a></h3></li>
					<li class="<?php echo $e['key']; if(isset($e['hide'])) echo 'hide'?>">
						<?php 
						$params = ( isset( $e['blocks']) ) ? array("blocks"=>$e['blocks']) : (( isset( $e['generate'] ) ) ? array("blocks"=>$this->sidebar1) : array());
						if( isset( $e['generate'] ) && isset($e["children"]))
						{
							echo "<ul>";
							foreach ($e["children"] as $key => $child) 
							{
								//tpl attribute specifies a specific location as a path 
								if( isset($child["tpl"]) )
								{
									$pathTpl = $child['tpl'];
									if(is_file(Yii::getPathOfAlias($pathTpl).".php") )
									{
										echo blockHTML($pathTpl,$child,$params,$e);
									}else
										echo "<span style='color:red'>This template ".$child['key']." doesn't exist yet : ".Yii::getPathOfAlias($child['tpl']).".php</span>";
								} 
								else 
								{
									//otherwise fetch the tpl from the generic api views folder
									$pathTpl = null;
									if (isset($child["key"])) {
										if (isset($child["parent"])) 
											$pathTpl = "application.components.api.views.".$child["parent"].".".$child["key"];
										else 
											$pathTpl = "application.components.api.views.".$e["key"].".".$child["key"];
									}
									if(($pathTpl && is_file(Yii::getPathOfAlias($pathTpl).".php")) || $child["microformat"] )
									{
										echo blockHTML($pathTpl,$child,$params,$e);
									}else
										echo "<span style='color:red'>This template ".$child['label']." has no tpl specified </span>";
								}
							}
							echo "</ul>";
						} else {
							//in this case the whole api section is fetched from a given path 
							if( isset($e['key']) && is_file(Yii::getPathOfAlias($path.$e['key']).".php") )
								$this->renderPartial( $path.$e['key'],$params ); 
							else
								echo "<span style='color:red'>This template ".$e['key']." doesn't exist yet : ".Yii::getPathOfAlias($path.$e['key']).".php</span>";
						}
					echo "</li>";
			}
		} ?>
			
		</ul>
		<?php } else { ?>
		<h2>Restricted Area</h2>
		<?php
			if(!PH::notlocalServer())
			{
				$admins = PHDB::noAdminExist($this->module->id);
				if(count($admins) > 0){
					echo "Below is your list of admin users :<br/>";
					foreach ($admins as $key => $value) {
						echo $value["email"]."<br/>";
					}
				} else {
					echo "Your instance has no admin user, first initialise your data below :<br/>";
					$this->renderPartial("application.components.api.views.adminPH.initData" ); 
				}
			}
			?>
			<br/>you can contact an admin <a class="btn" href="mail:contact@pixelhumain.com"><i class="fa fa-mail"></i></a>
		<?php } ?>
	</div>
</div>
