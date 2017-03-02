<style>
	.pastille-subdomain {
	    font-size: 20px;
	    float: left;
	    margin-left: 58.3%;
	    margin-top: -37px;
	    cursor:pointer;
	}
	#main-scope-name{
		font-size:40px;
	}

	#btn-my-co{
		border-radius: 50px;
		margin-top: -7px;
		margin-left: 5px;
		margin-right: -20px;
	}

	header .btn-decommunecter{
		border-radius: 50px;
		background-color: white;
		padding: 0px 0px 0px 0px;
		height: 75px;
		width: 75px;
		margin-bottom: 10px;
		box-shadow: 0px 0px 3px -1px grey;
	}
</style>

<?php
    $communexion = CO2::getCommunexionCookies();  
    if($communexion["state"] == false){
?>
	
	<!-- <i class="fa fa-<?php echo @$icon; ?> fa-3x"></i><br> -->
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="80" class="inline margin-bottom-15">
	
	<br>
<?php }else{ ?>
	<h1 class="text-red homestead">
		<button class="btn btn-link tooltips btn-decommunecter"
				data-toggle="tooltip" data-placement="right" title="Quitter la communexion" >
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO.png" height="40" 
			 class="inline no-margin">
		</button>
		<br>
		<!-- <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO-link.png" height="30" class="inline no-margin">
		<br> -->
		<span id="main-scope-name"><?php echo @$communexion["values"]["cityName"]; ?></span> 
	</h1>
<?php } ?>

<small class="text-dark homestead pastille-subdomain hidden"><?php echo @$subdomainName; ?> 
</small>
<br>
<small class="text-dark pastille block" style="font-size:20px; margin-top:-30px;">
	<i class="fa fa-<?php echo @$icon; ?>"></i>
	<?php echo $mainTitle; ?> 
	<?php if($communexion["state"] == false){ ?>
	<button class="btn btn-link bg-white text-red tooltips item-globalscope-checker start-new-communexion"
			data-toggle="tooltip" data-placement="right" title="Communecter avec <?php echo @$communexion["currentName"]; ?>" 
			data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
            data-scope-type='city'
			id="btn-my-co">
			<i class="fa fa-university"></i>
	</button>
	<?php } ?>
</small>
<br>
