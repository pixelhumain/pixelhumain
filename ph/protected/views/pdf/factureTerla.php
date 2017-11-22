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
	background-color: red;
	opacity: 0.1;
	bg_opac: 0.1; 
}

.tdTableWhite{
	text-align: center;
	height: 20px;
	width :25%;
	padding: 2px;
}


</style>
<page style="font-size: 14px">
	<hr style="height: 4mm; background: orange; border: solid 1mm orange">
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
        		<span style="text-align: center;"> Destinataire </span><br><br>
        		<span style="font-size: 10px; text-align: left;"><?php
	        			echo $person["name"]."<br>";
	        			echo $person["address"]["streetAddress"]."<br>";
	        			echo $person["address"]["postalCode"]." ".$person["address"]["addressLocality"]."<br>";
	        			echo $person["address"]["addressCountry"]."<br>";
					?></span>
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
           	<td class="tdTableWhite backgroudRed">A2</td>
            <td class="tdTableWhite backgroudRed">A2</td>
            <td class="tdTableWhite backgroudRed">A2</td>
            <td class="tdTableWhite backgroudRed">A2</td>
        </tr>
        <tr>
            <td class="tdTableWhite">A2</td>
            <td class="tdTableWhite">A2</td>
            <td class="tdTableWhite">A2</td>
            <td class="tdTableWhite">A2</td>
        </tr>
    </table>
    <br/><br/><br/>
	<table style="width :500px;">
        <tr>
        	<th class="trHeaderTable backgroudRed" style="text-align: left;">Total HT</th>
        	<td class="trHeaderTable backgroudRed" style="text-align: left;">A2</td>
        </tr>
        <tr>
            <th class="tdTableWhite" style="text-align: left;">TVA</th>
            <td class="tdTableWhite" style="text-align: left;">A2</td>
        </tr>
        <tr>
            <th class="trHeaderTable backgroudRed" style="text-align: left;">Total TTC</th>
            <td class="trHeaderTable backgroudRed" style="text-align: left;">A2</td>
       	</tr>
    </table>




    <!-- <span style="font-weight: bold; font-size: 18pt; color: #FF0000; font-family: Times">Bonjour, voici quelques exemples<br></span>
    <br>
    Retours à la ligne autorisés : &lt;br&gt;, &lt;br &gt;, &lt;br/&gt;, &lt;br /&gt; <br />
    <br>
    Exemple de lien : <a href="http://html2pdf.fr/" >le site Html2Pdf</a><br>
    <br>
    Image : <br>
    <br>
    Alignement horizontal des DIVs et TABLEs<br />
    <table style="text-align: center; border: solid 2px red; background: #FFEEEE;width: 40%" align="center"><tr><td style="width: 100%">Test 1</td></tr></table><br />
    <table style="text-align: center; border: solid 2px red; background: #FFEEEE;width: 40%; margin: auto"><tr><td style="width: 100%">Test 2</td></tr></table><br />
    <div style="text-align: center; border: solid 2px red; background: #FFEEEE;width: 40%; margin: auto">Test 3</div><br />
    test de tableau imbriqué :<br>
    <table border="1" bordercolor="#007" bgcolor="#AAAAAA" align="center">
        <tr>
            <td border="1">
                <table style="border: solid 1px #FF0000; background: #FFFFFF; width: 100%; text-align: center">
                    <tr>
                        <th style="border: solid 1px #007700;width: 50%">C1 € «</th>
                        <td style="border: solid 1px #007700;width: 50%">C2 € «</td>
                    </tr>
                    <tr>
                        <td style="border: solid 1px #007700;width: 50%">D1 &euro; &laquo;</td>
                        <th style="border: solid 1px #007700;width: 50%">D2 &euro; &laquo;</th>
                    </tr>
                </table>
            </td>
            <td border="1">A2</td>
            <td border="1">AAAAAAAA</td>
        </tr>
        <tr>
            <td border="1">B1</td>
            <td border="1" rowspan="2">
                <table class="test1">
                    <tr>
                        <td style="border: solid 2px #007700">E1</td>
                        <td style="border: solid 2px #000077; padding: 2mm">
                            <table style="border: solid 1px #445500">
                                <tr>
                                    <td>
                                        <img src="<?php echo $img1 ;?>" alt="Logo" width=100 />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: solid 2px #770000">F1</td>
                        <td style="border: solid 2px #007777">F2</td>
                    </tr>
                </table>
            </td>
            <td border="1"><barcode type="EAN13" value="45" style="width: 30mm; height: 6mm; font-size: 4mm"></barcode></td>
        </tr>
        <tr>
            <td border="1"><barcode type="C39" value="Html2Pdf" label="none" style="width: 35mm; height: 8mm"></barcode></td>
            <td border="1">A2</td>
        </tr>
    </table>
    <br>
    Exemple avec border et padding : <br>
    <table style="border: solid 5mm #770000; padding: 5mm;" cellspacing="0" >
        <tr>
            <td style="border: solid 3mm #007700; padding: 2mm;"><img src="https://raw.githubusercontent.com/spipu/html2pdf/master/examples/res/off.png" alt="" style="width: 20mm"></td>
        </tr>
    </table>
    <img src="https://raw.githubusercontent.com/spipu/html2pdf/master/examples/res/off.png" style="width: 10mm;"><img src="https://raw.githubusercontent.com/spipu/html2pdf/master/examples/res/off.png" style="width: 10mm;"><img src="https://raw.githubusercontent.com/spipu/html2pdf/master/examples/res/off.png" style="width: 10mm;"><img src="https://raw.githubusercontent.com/spipu/html2pdf/master/examples/res/off.png" style="width: 10mm;"><img src="https://raw.githubusercontent.com/spipu/html2pdf/master/examples/res/off.png" style="width: 10mm;"><br>
    <br>
    <table style="border: solid 1px #440000; width: 150px"  cellspacing="0"><tr><td style="width: 100%">Largeur : 150px</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 150pt"  cellspacing="0"><tr><td style="width: 100%">Largeur : 150pt</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 100mm"  cellspacing="0"><tr><td style="width: 100%">Largeur : 100mm</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 5in"    cellspacing="0"><tr><td style="width: 100%">Largeur : 5in</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 80%"    cellspacing="0"><tr><td style="width: 100%">Largeur : 80% </td></tr></table><br> -->
</page>