<style type="text/Css">

.trHeaderTable{
	text-align: center; 
	border-top: solid 1px orange; 
	border-bottom: solid 1px orange; 
	height: 20px;
	width :25%;
	color: orange;
	padding: 2px;
}

.backgroudRed{
	background-color: #F3E2A9;
	opacity: 0.1;
}

.tdTableWhite{
	text-align: center;
	height: 20px;
	width :25%;
	padding: 2px;
}

.textColor{
	color: orange;
}


</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> 
	<page_header> 
		<hr style="height: 4mm; background: orange; border: solid 1mm orange"> 
	</page_header> 
	<page_footer> 
		<hr style="background: black;">
		<div style="text-align: center; margin: auto; font-size: 14px">
			Association Cyberun, agréée entreprise solidaire <br/><br/>
			<a href="www.cyberun.org">www.cyberun.org</a>  <br/><br/>
			Participez à sauvegarder l’Histoire de La Réunion avec des vidéo-témoignages sur <a href="www.memoire-numerique.org">www.memoire-numerique.org</a> ! <br/>
		</div>
	</page_footer> 
	<table style="width :100%;">
		<tr>
			<td style="width :20%;">
				<img src="<?php echo $img1 ;?>" alt="Logo" width=150 />
			</td>
			<td style="width :30%;">
				<span style="font-weight: bold;">Association Cyberun</span> <br><br>
				<span style="font-size: 10px;">18 chemins des limites <br>
				97426 Les Trois-Bassins <br>
				Siret : 531 681 179 0028 <br>
				APE : 8559A <br>
				Mail : contact.cyberun@gmail.com <br></span>
			</td>
			<td style="width :50%; border: solid 1mm orange; border-radius: 10px 10px 10px 10px; padding:2px; padding-left:5px">
				<div style="font-weight: bold; text-align: center;"> Destinataire </div> <br>
				<div style="font-size: 10px;"><?php
						echo $person["name"]."<br>";
						echo $person["address"]["streetAddress"]."<br>";
						echo $person["address"]["postalCode"]." ".$person["address"]["addressLocality"]."<br>";
						echo $person["address"]["addressCountry"]."<br>";
					?></div>
			</td>
		</tr>
	</table>
	<br/><br/><br/><br/><br/>
	<div style="text-align: right; margin: auto">A <?php echo $person["address"]["addressLocality"]; ?> le <?php echo date("d/m/Y", strtotime($order["orderDate"])); ?></div><br/>
	<div style="text-align: left; margin: auto; font-weight: bold; font-size: 16px">Facture n° <?php echo (String) $order["_id"]; ?></div><br/>
	<table style="width :100%;">
		<tr>
			<th class="trHeaderTable">Description</th>
			<th class="trHeaderTable">Quantité</th>
			<th class="trHeaderTable">Prix à l'unité</th>
			<th class="trHeaderTable">Coût</th>
		</tr>
		<tr>
			<?php if(!empty($orderItem)){
				foreach ($orderItem as $key => $value) {
					echo '<td class="tdTableWhite backgroudRed">'.$value["description"].'</td>';
					echo '<td class="tdTableWhite backgroudRed">'.$value["quantity"].'</td>';
					echo '<td class="tdTableWhite backgroudRed">'.$value["price"].' '.$order["currency"].'</td>';
					echo '<td class="tdTableWhite backgroudRed">'.$value["totalPrice"].' '.$order["currency"].'</td>';
				}
			} ?>
		</tr>
		<tr>
			<td class="tdTableWhite backgroudRed"></td>
			<td class="tdTableWhite backgroudRed"></td>
			<td class="tdTableWhite backgroudRed"></td>
			<td class="tdTableWhite backgroudRed"></td>
		</tr>
		<tr>
			<td class="tdTableWhite"></td>
			<td class="tdTableWhite"></td>
			<td class="tdTableWhite"></td>
			<td class="tdTableWhite"></td>
		</tr>
	</table>
	<br/><br/><br/>
	<table style="width :500px;">
		<tr>
			<th class="trHeaderTable " style="text-align: left;">Total HT</th>
			<td class="trHeaderTable " style="text-align: left;"></td>
		</tr>
		<tr>
			<th class="tdTableWhite backgroudRed textColor" style="text-align: left;">TVA</th>
			<td class="tdTableWhite backgroudRed textColor" style="text-align: left;"></td>
		</tr>
		<tr>
			<th class="trHeaderTable" style="text-align: left;">Total TTC</th>
			<td class="trHeaderTable" style="text-align: left;"><?php echo $value["totalPrice"].' '.$order["currency"] ?></td>
		</tr>
	</table> 
</page>