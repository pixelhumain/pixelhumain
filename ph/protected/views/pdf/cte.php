<style type="text/css">
	
h1 {
	font-size: 16px;
	
}

</style>

<span style="text-align: center;">
	<img src="http://www.tco.re/wp-content/uploads/2018/07/slide-ppt_contrats-de-transition-ecologique-768x74.jpg">
	<h1> CONTRAT DE TRANSITION ECOLOGIQUE </h1>
	<span>FICHE ACTION :</span><br/>
	<span><?php 
		if( @$answers["cte2"]["answers"]["project"]  ) { 
			echo $answers["cte2"]["answers"]["project"]["name"];
		} ?>
	</span>

</span>


<div class='col-xs-12'>

	<h4 class="padding-20" style=""> Orientation stratégique</h4>
	<span> Name : <?php echo $user["name"]; ?> </span> <br/>
	<span> Email : <?php echo @$answers["cte1"]["answers"]["email"]; ?> </span><br/>
	<span> Organisations :
		<?php if( @$answers["cte1"]["answers"]["organization"]  ){ ?>
			<a href="<?php echo Yii::app()->createUrl( "#page.type.organizations.id.".$answers["cte1"]["answers"]["organization"]["id"]); ?>" target="_blank"><?php echo $answers["cte1"]["answers"]["organization"]["name"]; ?></a>
		<?php } ?>
	</span><br/>
	<span> Projet :
		<?php if( @$answers["cte2"]["answers"]["project"]  ) { ?>
			<a href="<?php echo Yii::app()->createUrl( "#page.type.projects.id.".$answers["cte2"]["answers"]["project"]["id"]); ?>" target="_blank"><?php echo $answers["cte2"]["answers"]["project"]["name"]; ?></a>
		<?php } ?>
	</span><br/>		
</div>

<div class='col-xs-12'>
	<?php
		foreach ($form["scenario"] as $k => $v) {
			echo '<h4 class="padding-20" style="">'.$v["title"].'</h4>';
			if(@$answers[$k]){
				//echo '<span class="text-dark">'.date("d/m/Y h:i", $answers[$k]["created"]).'</span>';
				?>
				<div class='col-xs-12'>
					<?php 
						foreach ( $answers[$k]["answers"] as $key => $value) {
							$editBtn = "";
							
							echo "<div class='col-xs-12'>";
							echo 	"<h5> [ étape ] ".@$v["form"]["scenario"][$key]["title"]."</h5>";

							if( @$v["form"]["scenario"][$key]["json"] ){
								$formQ = @$v["form"]["scenario"][$key]["json"]["jsonSchema"]["properties"];
								foreach ($value as $q => $a){
									if(is_string($a)){
										echo '<span><i>'.@$formQ[ $q ]["placeholder"]."</i></span><br/>";
										$markdown = (strpos(@$formQ[ $q ]["class"], 'markdown') !== false) ? 'markdown' : "";
										echo "<span style='' class='".$markdown."'>".$a."</span><br/>";
									}else if(@$a["type"] && $a["type"]==Document::COLLECTION){
										$document=Document::getById($a["id"]);
										$document["docId"]=$a["id"];
										$answers[$k]["answers"][$key]["files"]=array($document);
										$path=Yii::app()->getRequest()->getBaseUrl(true)."/upload/communecter/".$document["folder"]."/".$document["name"];
										echo '<span><i>'.@$formQ[ $q ]["placeholder"]."</i></span><br/>";
										echo "<span>";
											echo "<a href='".$path."' target='_blank'><i class='fa fa-file-pdf-o text-red'></i> ".$document["name"]."</a>";
										echo '</span>';
									}
								}
							//todo search dynamically if key exists
							}else if(@$v["form"]["scenario"]["survey"]["json"][$key]){
								$formQ = $v["form"]["scenario"]["survey"]["json"][$key]["jsonSchema"]["properties"];
								foreach ($value as $q => $a) {
									if(is_string($a)){
										echo '<span><i>'.@$formQ[ $q ]["placeholder"]."</i></span><br/>";
										echo "<span>".$a."</span><br/>";
									}else if(@$a["type"] && $a["type"]==Document::COLLECTION){
										echo '<span><i>'.@$formQ[ $q ]["placeholder"]."</i></span><br/>";
										echo "<span>".$a["type"]."</span><br/>";
									}
								}
							}else if (@$v["form"]["scenario"][$key]["saveElement"]){
								$el = Element::getByTypeAndId( $value["type"] , $value["id"] );
								echo '<span><i>'.Yii::t("common","Name")."</i></span><br/>";
								echo "<span><a target='_blank' class='btn btn-default' href='".Yii::app()->createUrl("#@".$el["slug"]).".view.detail'>".$el["name"]."</a>";
								echo "</span><br/>";
								if(@$el["type"]){
									echo '<span><i>'.Yii::t("common","Type")."</i></span><br/>";
									echo "<span>".$el["type"]."</span><br/>";
								}
								if(@$el["description"]){
									echo '<span><i>'.Yii::t("common", "Description")."</i></span><br/>";
									echo "<span>".$el["description"]."</span><br/>";
								}
								if(@$el["tags"]){
									echo '<span><i>'.Yii::t("common","Tags")."</i></span><br/>";
									echo "<span>".
										$it=0;
										foreach($el["tags"] as $tags){
											if($it>0)
												echo ", ";
											echo "<span class='text-red'>#".$tags."</span>";
											$it++;
										}
										echo "</span><br/>";
								}
								if(@$el["shortDescription"]){
									echo '<span><i>'.Yii::t("common","Short description")."</i></span><br/>";
									echo "<span>".$el["shortDescription"]."</span><br/>";
								}
								if(@$el["email"]){
									echo '<span><i>'.Yii::t("common","Email")."</i></span><br/>";
									echo "<span>".$el["email"]."</span><br/>";
								}
								
								if(@$el["profilImageUrl"]){
									echo '<span><i>'.Yii::t("common","Profil image")."</i></span><br/>";
									echo "<span><img src='".Yii::app()->createUrl($el["profilImageUrl"])."' class='img-responsive'/>";
									echo "</span><br/>";
								}
								if(@$el["url"]){
									echo '<span><i>'.Yii::t("common","Website URL")."</i></span><br/>";
									echo "<span><a href='".$el["url"]."'>".$el["url"]."</a></span><br/>";
								}
							}


							echo "</div>";

						} ?>

				</div>

			<?php
			}else{
				echo '<span class="padding-20" style="">Pas encore renseigné</h4>';
			}
		}

	?>	
</div>