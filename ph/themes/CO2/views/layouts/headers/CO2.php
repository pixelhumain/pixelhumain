<style>
	.pastille-subdomain {
	    font-size: 20px;
	    float: left;
	    margin-left: 58.3%;
	    margin-top: -37px;
	    cursor:pointer;
	}
	#main-scope-name{
		font-size:30px;
		margin-left:6%;
	}

	#btn-my-co{
		border-radius: 50px;
		/*margin-top: 21px;*/
		margin-left: 5px;
		border: 1px solid #e6344d !important;
		padding: 7px 9px;
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

	.moduleTitle #bgTitle{
		border-radius:40px;
		background-color: rgba(255, 255, 255, 0.5);
		padding: 5px 15px;
	}

	#main-scope-name a{
	    
	}


	@media (max-width: 768px) {
		.link-submenu-header span{
			display: none;
		}
	}

</style>
<h1 class="text-red homestead text-left hidden">
	<span id="main-scope-name">
	<a href="#" class="menu-btn-back-category" data-target="#modalMainMenu-block" data-toggle="modal">
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo-min.png"
	 	 height="30" class="inline no-margin">
	</a>
	</span>
</h1>


<!--<div class="text-dark moduleTitle" style="font-size:20px; margin-bottom:10px;">
<span id="bgTitle">
	<i class="fa fa-<?php echo @$icon; ?>"></i>
	<?php echo Yii::t("common",@$mainTitle); ?> 
</span>
	
</div>-->

