<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDCY_bGEVpPVOO7WjN9DOewl8vlRDeI5tE&sensor=false' , CClientScript::POS_END);
?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
#map-canvas { height: 100% }
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    <div class='pull-left' style="width:70%">
        <h2>Geolocaliser tout, </h2>
        <p>Aggreger toute les sources d'information locales interressantes pour une commune </p>
        <iframe width="100%" height="700" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=reunion&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=61.065158,135.263672&amp;ie=UTF8&amp;hq=&amp;hnear=Reunion&amp;ll=-21.115141,55.536384&amp;spn=0.572004,1.056747&amp;t=m&amp;z=10&amp;output=embed"></iframe>
    </div>
    
    <div class='pull-right' style="width:30%">
<?php 
	$this->widget('application.extensions.YiiTagCloud.YiiTagCloud', 
            array(
                'beginColor' => '00089A',
                'endColor' => 'A3AEFF',
                'minFontSize' => 8,
                'maxFontSize' => 20,
                'arrTags' => array (
            			'Petites Annonces'      => array('weight'=> 6),
                		'Emploi'      => array('weight'=> 9),
                        'Culture'     => array('weight'=> 5),
                        'Évennement'     => array('weight'=> 9),
                        'Action'   => array('weight'=> 8),
                        'Projet'  => array('weight'=> 6),
                        'Surf'     => array('weight'=> 3),
                        'Aménagement'     => array('weight'=> 4),
                        'Marmaille'     => array('weight'=> 9),
                        'Creche'     => array('weight'=> 3),
                        'Handicap'     => array('weight'=> 2),
                        'Guitar'     => array('weight'=> 6),
                        'Tennis'     => array('weight'=> 4),
                        'Football'     => array('weight'=> 9),
                        'Auto'     => array('weight'=> 5),
                        'Moto'     => array('weight'=> 4),
                        'Médecin'     => array('weight'=> 7),
                        'Garagiste'     => array('weight'=> 5),
                        'Restaurant'     => array('weight'=> 9),
                        'Recette'      => array('weight'=> 2),
                        'Artisan'      => array('weight'=> 6),
                        'Epicerie'      => array('weight'=> 2),
                    	'Monnaie Locale'      => array('weight'=> 8),
                        'Actualité'      => array('weight'=> 9),
                        'Arts'      => array('weight'=> 9),
                        'Arts'      => array('weight'=> 5),
                        'Donne Fruit'      => array('weight'=> 6),
                        'Instrument'      => array('weight'=> 4),
                        'Plante'      => array('weight'=> 9),
                        'Jardin Communal'      => array('weight'=> 9),
                        'Femme de ménage'      => array('weight'=> 9),
                        'Jardinage'      => array('weight'=> 5),
                        'Nounou'      => array('weight'=> 4),
                        'Administration'      => array('weight'=> 6),
            			'Assistante Maternelle'      => array('weight'=> 9),
            			'Aide a domicile'      => array('weight'=> 4),
                        'Pharmacie de Garde'      => array('weight'=> 7),
                        'Accident'      => array('weight'=> 9)
                ),
          )
    );
	?>
	
	</div>
	<div class="clear"></div>
</div></div>
<script type="text/javascript"		>
var map;
initT['animInit'] = function(){
	
};
</script>			