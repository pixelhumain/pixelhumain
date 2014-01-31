<style>
/* ********************* */
/* Modal Popin Form */
/* ********************* */
#appTitle{background-color:#DFE1E8;width:250px}
</style>
<header>'
    <div class="navbar navbar-inverse navbar-fixed-top">
    			
        <div class="navbar-inner pull-left ">
                <div id="logo" class="pull-left title cube" >
                	<a id="logoLink"  class="ml10 " href="<?php echo Yii::app()->createUrl('')?>" >PH</a>
                </div>
                
                <?php if(!isset(Yii::app()->session["userId"])){?>
                	<div class="cube pull-left">
                		<a href="#loginForm" class="ml10 w60" role="button" data-toggle="modal" title="connexion" ><span class="icon-login"></span><span class="fsxs menuTitle">Connection</span></a>
                	</div>
                <?php } else {
                    $k_path_url = (isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
                    $path = $k_path_url.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
                    $mode = "style='width:30px'";
                    if ( isset($account) && isset($account['img']) ) {
                        $img = getimagesize( $path.$account['img'] );
                        $width = $img[0]; 
                        $height = $img[1]; 
                        $aspect = $height / $width; 
                        if ($aspect >= 1) 
                            $mode = "style='height:30px'"; 
                    }

                    ?>
                    <div class="cube pull-left">
                		<a href="<?php echo Yii::app()->createUrl('citoyens')?>" class="ml10 w60 " role="button" data-toggle="modal" title="mon compte" ><img <?php echo $mode?> class="citizenThumb" src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>"/><br/><span class="fsxs menuTitle">Citoyen</span></a>
                	</div>
                	
                    <?php if(isset($account["cp"])){?>
                	<div class="cube pull-left">
                		<a href="<?php echo Yii::app()->createUrl('commune')?>" class="ml10 w60 " role="button" data-toggle="modal" title="Commune" ><span class="icon-town-hall"></span><br/><span class="fsxs menuTitle">Commune</span></a>
                	</div>
                	<?php } else { ?>
                	<div class="cube pull-left">
                		<a href="#" class="ml10 w60 pink" onclick="openModal('commune')" title="Commune" ><span class="icon-town-hall"></span><br/><span class="fsxs menuTitle">Commune</span></a>
                	</div>
                	<?php } ?>
                	
                	<?php if(!isset($account["email"])){?>
                	<div class="cube pull-left ">
                		<a href="#" class="ml10 w60 pink" onclick="openModal('email')" title="Email" ><span class="icon-at"></span><br/><span class="fsxs menuTitle">Email</span></a>
                	</div>
                	<?php } ?>
                	
                	<?php if(isset($account["associations"])){?>
                	<div class="cube pull-left">
                		<a href="<?php echo Yii::app()->createUrl('association')?>" class="ml10 w60 " role="button" data-toggle="modal" title="Association" ><span class="icon-users"></span><br/><span class="fsxs menuTitle">Association</span></a>
                	</div>
                	<?php } ?>
                	
                	<?php if(true){?>
                	<div class="cube pull-left">
                		<?php //<span class="badge">2</span>//?>
                		<a href="<?php echo Yii::app()->createUrl('discuter')?>" class="ml10 w60 pink" role="button" data-toggle="modal" title="Discuter" ><span class="icon-chat"></span><br/><span class="fsxs menuTitle">Infos</span></a>
                	</div>
                	<?php } ?>
                	
                	<div class="cube pull-left">
                		<a href="#participer" class="ml10 w60 " role="button" data-toggle="modal" title="mon compte" ><span class="icon-cog-1"></span><br/><span class="fsxs menuTitle">Mon compte</span></a>
                	</div>
                	<div class="cube pull-left">
                		<a href="<?php echo Yii::app()->createUrl('site/logout')?>" class="ml10 w60 " role="button" data-toggle="modal" title="deconnexion" ><span class="icon-logout"></span><span class="fsxs menuTitle">Déconnection</span></a>
                	</div>
                	
                <?php }?>
            	
        </div>
        <div class="pull-left p15 fsxl h60 b" id="appTitle"><?php echo (isset($this->inlinePageTitle)) ? $this->inlinePageTitle : $this::moduleTitle ?></div>
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
