<style>
/* ********************* */
/* Modal Popin Form */
/* ********************* */
#appTitle{background-color:#DFE1E8;width:250px}
</style>
<header>'
    <div class="navbar navbar-inverse navbar-fixed-top">
    			
        <div class="navbar-inner " style="width:250px">
                <div id="logo" class="pull-left brand title" >
                	<a id="logoLink"  class="ml10 " href="<?php echo Yii::app()->createUrl('')?>" >PH</a>
                </div>
                <div class="  pull-right p15 title fsxl" id="userMenu">
                    <?php if(!isset(Yii::app()->session["userId"])){?>
                    	<a href="#loginForm" class="ml10 w60" role="button" data-toggle="modal" title="connexion" ><span class="icon-login"></span></a>
                    <?php } else {
                        $k_path_url = (isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
                        $path = $k_path_url.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
                        $mode = "style='width:30px'";
                        if ( isset($account) && isset($account['img']) && file_exists($path.$account['img']) ) {
                            $img = getimagesize( $path.$account['img'] );
                            $width = $img[0]; 
                            $height = $img[1]; 
                            $aspect = $height / $width; 
                            if ($aspect >= 1) 
                                $mode = "style='height:30px'"; 
                        }

                        ?>
                    	<a href="<?php echo Yii::app()->createUrl('index.php/citoyens')?>" class="ml10 w60" role="button" data-toggle="modal" title="mon compte" ><img <?php echo $mode?> class="citizenThumb" src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>"/></a>
                    	<a href="#participer" class="ml10 w60" role="button" data-toggle="modal" title="mon compte" ><span class="icon-cog"></span></a>
                    	<a href="<?php echo Yii::app()->createUrl('index.php/site/logout')?>" class="ml10 w60" role="button" data-toggle="modal" title="deconnexion" ><span class="icon-logout"></span></a>
                    <?php }?>
            	</div>
            	
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
