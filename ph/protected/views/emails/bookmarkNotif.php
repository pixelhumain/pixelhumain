<?php
$logoHeader=(@$logoHeader) ? $logoHeader : "";
$baseUrl=Yii::app()->getRequest()->getBaseUrl(true);
if(@$url)
    $baseUrl=Yii::app()->getRequest()->getBaseUrl(true).$url;
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header', array("logo"=>@$logoHeader, "url"=> $baseUrl)); ?>
<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
			<th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">
				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<!--http://localhost:8888/ph/images/betatest.png-->
							<!-- <a href="http://www.communecter.org" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><img align="right" width="200" src="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/images/bdb.png"?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;border: none;" alt="Intelligence collective"></a> -->
							<br/><br/>
							<b>
								<h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;">
									<!-- Aussi connecté que Facebook et aussi ouvert que Wikipédia, rejoignez le mouvement ! -->
									<?php echo Yii::t("mail","Du nouveau sur vos alertes") ?>
								</h5>
							</b><br/>
							<?php
								foreach ($params as $key => $value) {
									$c = count($value["results"]);
									if($c > 0){

										$i = 1 ;
										echo Yii::t("mail","Pour l'alerte") ;
										echo ' : <a href="'.$baseUrl.$value["url"].'" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;">'.$value["name"]."</a></br></br>" ;
										echo "<span style='padding : 15px'>" ;
										foreach ($value["results"] as $keyR => $valueR) {
											echo "<span style='color: #2bb0c6; font-weight:bold;'><a href='".$baseUrl."#page.type.classifieds.id.".$keyR."' style='color: #2bb0c6; font-weight:bold;' target='_blank' >".$valueR["name"]."</a></span> : ";
											echo "<span style='font-style: italic;'>".@$valueR["description"]."</span></br></br>";
											$i++;
											if($i >= 1)
												break;
										}

										echo "</span>" ;

										if($c > 1){
											echo "<span style='padding : 15px'> Il y a encore <span style='color: #2bb0c6; font-weight:bold;'> ".($c - 1)." </span> annonces a découvrir sur Communecter</span>";
										}
									}
								}
							?>


				
							   <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer', array("name"=>@$title, "url"=>@$baseUrl)); ?>
						