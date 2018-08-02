<?php 
HtmlHelper::registerCssAndScriptsFiles(array( '/assets/css/menus/short_info_profil.css'), Yii::app()->theme->baseUrl ); ?>

  <?php // BTN PROFIL || BTN SUBSCRIBE-LOGIN // ?>
  <div class="topMenuButtons pull-right" style="margin-top: 7px;"> 
    <?php 
    if( isset( Yii::app()->session['userId']) ){
      //echo $this->renderPartial('./menu/menuProfil',array( "me"=> $me)); 
     // IMAGE PROFIL // 
      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
    ?>    
        <button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown" onclick="javascript:smallMenu.open();">
          <img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
        </button>

    <?php }
    else { ?>
        <?php // BTN MENU LAUNCH // ?>

        <button class="btn-top btn btn-default btn-menu-register" onclick="showPanel('box-register');">
          <i class="fa fa-plus-circle"></i> 
          <span class="hidden-sm hidden-md hidden-xs">S'inscrire</span>
        </button>

        <button class="btn-top btn btn-success btn-menu-connect" style="margin-right:10px;" onclick="showPanel('box-login');">
          <i class="fa fa-sign-in"></i> 
          <span class="hidden-sm hidden-md hidden-xs">Se connecter</span>
        </button> 
    <?php } ?>
  
  <?php // MULTITAG / MULTISCOPE // ?>
  <?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.'; ?>
  <?php $this->renderPartial($layoutPath.'.menu.multi_tag_scope', array("me"=>$me)); ?>
</div>


<div class="menu-info-profil <?php echo isset($type) ? $type : ''; ?> " 
     data-tpl="default.menu.short_info_profil">
    
  <?php // BTN MAP // ?>
  

  <?php // INPUT TEXT GLOBAL SEARCH // ?>
  <div class="input-group group-globalsearch inline hidden-xs margin-right-10">
    
    <input type="text" class="text-dark input-global-search" 
           placeholder="<?php echo Yii::t("common","Search") ?> ..."/>

    <span class="input-group-addon" id="basic-addon1">
      <i class="fa fa-search text-dark searchIcon tooltips" 
         data-toggle="tooltip" data-placement="bottom" title="Recherche Globale"></i>
    </span>
    
  </div>
  
  <div class="dropdown-result-global-search"></div>

</div>  


<style>
ul.notifList {
    max-height: unset !important;
}
</style>
<script>

  /* global search code is in assets/js/default/globalsearch.js */
  var timeoutGS = setTimeout(function(){ }, 100);
  var timeoutDropdownGS = setTimeout(function(){ }, 100);
  var searchPage = false;

  var ICON_MAP_MENU_TOP = "map";

  jQuery(document).ready(function() {
    //hide burger menu if loggued user
    if (typeof userId != undefined && userId != "") {
      $("#btn-menu-launch").hide();
    }

    $('.dropdown-toggle').dropdown();
    $(".menu-name-profil").click(function(){
      showNotif(false);
    });

    $('.input-global-search').keyup(function(e){
        clearTimeout(timeoutGS);
        /*if($(".newsTL")){
          $(".newsTL").html("");
          $("#nowListevents,#nowListDDA,#nowListprojects,#nowListorga").html("");
        }
        if($('*[data-searchPage]').length > 0 && searchPage ){
          console.log("startSearch");
          $('#searchBarText').val( $('.input-global-search').val() );
          timeoutGS = setTimeout(function(){startSearch(false); }, 800);
        }
        else {*/
          timeoutGS = setTimeout(function(){ startGlobalSearch(0, indexStepGS); }, 800);
        //}
    });

    /*$('.searchIcon').click(function(e){
       if($('*[data-searchPage]').length > 0 && $('.searchIcon').hasClass('fa-search')){
          $(".dropdown-result-global-search").html('<span class="padding-10 text-bold">Cette recherche ne concerne que cette page.</span>');
          showDropDownGS(true);
          searchPage = true;
          $(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
          $(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");
          $('.tooltips').tooltip();
          if( $("input-global-search").val() != "")
            timeoutGS = setTimeout(function(){startSearch(false); }, 800);
       }else{
          $(".searchIcon").removeClass("fa-file-text-o").addClass("fa-search");
          $(".dropdown-result-global-search").html('<span class="padding-10 text-bold">Cette recherche sera globale.</span>');
          $(".searchIcon").attr("title","Mode Recherche Globale");
          $('.tooltips').tooltip();
          showDropDownGS(true);
          searchPage = false;
          if( $("input-global-search").val() != "")
            timeoutGS = setTimeout(function(){ startGlobalSearch(0, indexStepGS); }, 800);
       }

    });*/

    $('.input-global-search').click(function(e){
        if($(".dropdown-result-global-search").html() != ""){
          showDropDownGS(true);
        }
    });

    $('.dropdown-result-global-search').mouseenter(function(e){
        clearTimeout(timeoutDropdownGS);
    });
    $('.main-col-search, .mapCanvas, .main-menu-top').mouseenter(function(e){
        clearTimeout(timeoutDropdownGS);
        timeoutDropdownGS = setTimeout(function(){ 
            showDropDownGS(false);
        }, 300);
    });

    $('.moduleLabel').click(function(e){
        clearTimeout(timeoutDropdownGS);
        timeoutDropdownGS = setTimeout(function(){ 
            showDropDownGS(false);
        }, 300);
    });

    showDropDownGS(false);
  });

  </script>

