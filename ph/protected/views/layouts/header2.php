<style>
/* ********************* */
/* Modal Popin Form */
/* ********************* */
#appTitle{background-color:#DFE1E8;width:250px}
</style>
<header>'
    <div class="navbar navbar-inverse navbar-fixed-top">
    			
        <div class="navbar-inner pull-left " style="width:250px">
                <div id="logo" class="pull-left brand title" >
                	<a id="logoLink"  class="ml10 " href="<?php echo Yii::app()->createUrl('')?>" >PH</a>
                </div>
                <div class="  pull-right p15 title fsxl" id="userMenu">
                    <?php if(!isset(Yii::app()->session["userId"])){?>
                    	<a href="#loginForm" class="ml10 w60" role="button" data-toggle="modal" title="connexion" ><span class="entypo-login"></span></a>
                    <?php } else {?>
                    	<a href="<?php echo Yii::app()->createUrl('index.php/citoyens')?>" class="ml10 w60" role="button" data-toggle="modal" title="mon compte" ><img width=30 class="citizenThumb" src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>"/></a>
                    	<a href="#participer" class="ml10 w60" role="button" data-toggle="modal" title="mon compte" ><span class="entypo-cog"></span></a>
                    	<a href="<?php echo Yii::app()->createUrl('index.php/site/logout')?>" class="ml10 w60" role="button" data-toggle="modal" title="deconnexion" ><span class="entypo-logout"></span></a>
                    <?php }?>
            	</div>
            	
        </div>
        <div class="pull-left p15 fsxl h60 b" id="appTitle"><?php echo $this::moduleTitle ?></div>
    </div>
</header>

<script type="text/javascript">
initT['headerInit'] = function(){
	/*$('#logo').mouseenter(
			function(){ $("#logo").animate({width: "250px"}, 500,function (){$('#userMenu').show('slide', {direction: 'left'}, 500);});  }
	).mouseleave(
			function(){ $("#logo").animate({width: "60px"}, 500,function (){$('#userMenu').hide('slide', {direction: 'right'}, 2000)}); }
	);*/
}
</script>
