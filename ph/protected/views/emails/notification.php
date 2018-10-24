<?php
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header');
//Yii::app()->language = $language;
?>


<table class="row" style="margin-top : 10px ; border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
			<th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">
				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<!--http://localhost:8888/ph/images/betatest.png-->
							<b>
								<h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;">
									<?php echo Yii::t("mail","Reviens sur COmmunecter, il y a du nouveau") ?>
								</h5>
							</b>
							<br/>
							<?php 
							foreach ($data as $type => $elt) {
								foreach ($elt as $key => $value) {

									//if(!empty($value["post"])){

									$name = $value["name"];

									if( !empty($value["url"]) ){
										$color = Element::getColorIcon($type);
										$name = "<a href='".$value["url"]."' target='_blank' style='color:".$color.";font-weight:800;font-variant:small-caps;'>".$value["name"]."</a>";
									}

									echo "Dans ".$name." : <br/><br/>";
									foreach ($value["data"] as $keyD => $valD) {
										// if(!empty($value["post"])){
										echo "<div style='padding-left:10px;'><p>".Mail::translateLabel($valD)." </p>";
										if(!empty($valD["value"]))
											echo "<p style='padding:10px 20px;margin:1%;border:1px solid lightgray; font-style:italic; border-radius:10px; width:90%;white-space: pre-line;'>".$valD["value"]." </p></br>";

										echo "</div>";
										//}

										// <p>Raphael RIVIERE a envoyé un message sur votre projet communecterdddddddddddddddddddddddddddddddddddddddddddddddddd :</p><br/><br/>xsqxsqxqxq</p><br/><br/><div style='text-align:center'><a href='http://127.0.0.1/ph/survey/co/index/id/cte' target='_blank' style='padding:7px 10px; border-radius:5px; background-color:#00b795;color:white;font-weight:800;font-variant:small-caps;'>Répondre</a></div>
									}

									// if(!empty($value["add"])){

									// 	foreach ($value["add"] as $keyAdd => $valueAdd) {
									// 		echo '<a href="'.$valueAdd["url"].'" style="color: #728289;font-family: Helvetica, Arial, sans-serif;font-weight: bold;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;">';
									// 		echo "<p>".Mail::translateLabel($valueAdd)." </p></a><br/>";
									// 	}
										
									// }

								}
							}


							?>
						</th>
					</tr>
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<br/><br/>
							<p style="margin: 0;margin-bottom: 10px;color: #3c5665 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;"><?php echo Yii::t("mail","See you soon on") ?> <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>" style="color: #728289;font-family: Helvetica, Arial, sans-serif;font-weight: bold;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::app()->getRequest()->getBaseUrl(true) ?></a></p>
							<p style="margin: 0;margin-bottom: 10px;color: #3c5665 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;"><?php echo Yii::t("mail","The Human Pixels") ?></p>

							<br/>
							<p style="margin: 0;margin-bottom: 10px;color: #3c5665 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 12px;">
							<?php echo Yii::t("mail","Vous pouvez modifier vos préfèrences ici") ; ?>
							<div style="word-break: break-all;font-size: 12px;"><?php echo Yii::t("mail","si vous souhaité supprimer votre comptes c'est par ici") ; ?></div></p>
						</th>
					</tr>
				</table>
	        </th>
		</tr>
	</tbody>
</table>
</td></tr></tbody></table> <!-- End main email content -->
    
<table class="container text-center" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: center;background: #fefefe;width: 580px;margin: 0 auto;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;">
			<td style="word-wrap: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 15px;border-collapse: collapse !important;"> <!-- Footer -->
				<table class="row grey" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: #f0f0f0;width: 100%;position: relative;display: table;">
					<tbody>
						<tr style="padding: 0;vertical-align: top;text-align: left;">
							<th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
								<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
									<tr style="padding: 0;vertical-align: top;text-align: left;">
										<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
											<p class="text-center footercopy" style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 20px 0px;text-align: center;line-height: 19px;font-size: 12px;"><?php echo Yii::t("mail","Mail sent from") ?> <?php echo Yii::app()->getRequest()->getBaseUrl(true) ?></p>
										</th>
										<th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
									</tr>
								</table>
							</th>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>


  </center></td></tr></table>
</body></html>