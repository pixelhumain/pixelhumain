<?php
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header');
//Yii::app()->language = $language;
?>


<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
			<th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">

				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<b>
								<h5 style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin-top: 15px;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;">
									<?php echo Yii::t("mail","There's something new in your network") ?>
								</h5>
							</b>
							<br/>
							<?php 
							foreach ($data["data"] as $key => $value) {
								echo "<div style='color: #3c5665; padding-left:10px;'><p>".Mail::translateLabel($value)." </p>";
								if(!empty($value["value"]))
									echo "<p style='padding:10px 20px;margin:1%;border:1px solid lightgray; font-style:italic; border-radius:10px; width:90%;white-space: pre-line;'>".$value["value"]." </p></br>";
								echo "</div><br/>";
							}

							$nbN = $data["countData"] - count($data["data"]) ;
							if( $nbN == 1 ){
								echo "<div style='padding-left:10px;'><p>".Yii::t("mail","Only one notification left to discover") ." </p></div>";

							}else if( $nbN > 0 ){

								$strNB = "<span style='color : #ea0040'>".$nbN."</span>";
								echo "<div style='padding-left:10px;'><p>".Yii::t("mail","More than {count} notification(s) to discover", array("{count}" => $strNB)) ." </p></div>";
							} 
								


							?>
						</th>
					</tr>					
				</table>

	        </th>
		</tr>

		<tr style="padding: 0;vertical-align: top;text-align: left;">
			<td style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
				
				<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer'); ?>

			</td>

		</tr>

	</tbody>
</table>

<!-- </td></tr></tbody></table> End main email content -->
    
<!-- <table class="container text-center" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: center;background: #fefefe;width: 580px;margin: 0 auto;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;">
			<td style="word-wrap: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 15px;border-collapse: collapse !important;"> 
				<table class="row grey" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: #f0f0f0;width: 100%;position: relative;display: table;">
					<tbody>
						<tr style="padding: 0;vertical-align: top;text-align: left;">
							<th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
								<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
									<tr style="padding: 0;vertical-align: top;text-align: left;">
										<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
											<p class="text-center footercopy" style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 20px 0px;text-align: center;line-height: 19px;font-size: 12px;"><?php //echo Yii::t("mail","Mail sent from") ?> <?php //echo Yii::app()->getRequest()->getBaseUrl(true) ?></p>
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
</table> -->



  </center></td></tr></table>
</body></html>