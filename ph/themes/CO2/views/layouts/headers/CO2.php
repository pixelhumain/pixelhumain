<style>
	.pastille-subdomain {
	    font-size: 20px;
	    float: left;
	    margin-left: 58.3%;
	    margin-top: -37px;
	    cursor:pointer;
	}
	#main-scope-name{
		font-size:50px;
	}
</style>

<?php
    $communexion = CO2::getCommunexionCookies();  
    if($communexion["state"] == false){
?>
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">
	<br>
<?php }else{ ?>
	<h1 class="text-red homestead">
		<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO-link.png" height="30" class="inline no-margin">
		<br><span id="main-scope-name"><?php echo @$communexion["currentName"]; ?></span>
	</h1>
<?php } ?>

<small class="text-dark homestead pastille-subdomain hidden"><?php echo @$subdomainName; ?> 
	<i class="fa fa-<?php echo @$icon; ?>"></i>
</small>
<br>
<small class="text-dark pastille block" style="font-size:20px; margin-top:-30px;">
	<i class="fa fa-<?php echo @$icon; ?>"></i> <?php echo $mainTitle; ?>
</small>
<br>
