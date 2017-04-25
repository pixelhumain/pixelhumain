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
		margin-top: 21px;
		margin-left: 5px;
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


	@media (max-width: 768px) {
		.link-submenu-header span{
			display: none;
		}
	}

</style>
<h1 class="text-red homestead">
	<span id="main-scope-name">
<?php
    $communexion = CO2::getCommunexionCookies();  
    if($communexion["state"] == false){
?>
	<!-- <i class="fa fa-<?php echo @$icon; ?> fa-3x"></i><br> -->
	<a href="#web" class="menu-btn-back-category" data-target="#modalMainMenu" data-toggle="modal">
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="60" class="inline margin-bottom-15">
	</a>
	<br>
<?php }else{ ?>
		<?php echo @$communexion["values"]["cityName"]; ?> 
<?php } ?>
	</span>
</h1>

<!-- 
<small class="text-dark homestead pastille-subdomain hidden"><?php echo @$subdomainName; ?> 
</small>
<br>-->

<div class="text-dark moduleTitle" style="font-size:20px; margin-bottom:10px;">
	<i class="fa fa-<?php echo @$icon; ?>"></i>
	<?php echo @$mainTitle; ?> 
	
	
</div>

