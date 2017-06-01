<?php 

    if(isset(Yii::app()->session['userId']))
    	$me = Person::getById(Yii::app()->session['userId']);
    
    $newsToModerate = count(News::getNewsToModerate());

    $cssAnsScriptFilesModule = array(
		'/assets/css/default/menu.css',
		'/assets/css/menus/menuLeft.css'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

    $cssAnsScriptFilesModule = array(
		'/js/default/menu.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
	.footer-menu-left{
		/*background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/footer_menu_left.png");*/
		/*background-image: url("<?php echo $this->module->assetsUrl; ?>/images/people.jpg");*/
	}

	.title-menu-left{
		color:grey;
		font-weight:800;
	}
	.menu-left-container a{
		color: #b4b4b4;
		font-weight: 700;
	}
	.menu-left-container a:hover{
		color:grey;
	}
	.carousel-indicators{
		bottom:-10px;
	}
</style>
<div class="hover-info col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20" >
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>

<div class="hover-info2 col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20"></div>

<?php $projects = PHDB::findAndSortAndLimitAndIndex( Organization::COLLECTION, array("name"=>array('$exists'=>1),"profilMediumImageUrl"=>array('$exists'=>1)), array("updated" => -1), 3, 0); ?>
<div class="hidden-xs main-menu-left col-md-2 col-sm-2 padding-10"  data-tpl="menuLeft" <?php if (@$emptyTop && $emptyTop==true) { ?> style="top:50px !important;" <?php } ?>>
	
	<div class="menu-left-container">
	<?php if (@$projects && !empty($projects)){ ?>
		<div class="col-md-12">
			<span class="title-menu-left text-brown">
				FOCUS
				<i class="fa fa-angle-down pull-right"></i><br>
				<hr>
			</span>
		</div>
		<div class="col-md-12">
			<div id="docCarousel" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
			  <ol class="carousel-indicators">
				<?php
					$i=0; 
					foreach ($projects as $data){ 
						if(@$data["profilMediumImageUrl"] && !empty($data["profilMediumImageUrl"])){ ?>
						<li data-target="#docCarousel" data-slide-to="0" class=" <?php if($i==0) echo "active" ?>"></li>
						<?php $i++;
						}
					} ?>
			  </ol>
	
	  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				<?php
					$inc=0; 
					foreach ($projects as $data){
						if(@$data["profilMediumImageUrl"] && !empty($data["profilMediumImageUrl"])){ ?>
						<div class="item <?php if($inc==0) echo "active" ?>">
							<a href="#organization.detail.id.<?php echo (string)$data["_id"] ?>" class="lbh">
								<img src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/150x150'.@$data["profilMediumImageUrl"]) ?>" class="col-sm-12 img-responsive no-padding">
							</a>
						</div>
				<?php $inc++; 
					} }?>
			  </div>
			  <!-- Left and right controls -->
			</div>
		</div>
	<?php } ?>
		<div class="col-md-12" id="poiParent">
			<!--<img src="<?php echo $this->module->assetsUrl?>/images/velo.png" class="img-responsive">-->
		</div>
		<div class="col-md-12 margin-top-15">
			<span class="title-menu-left text-brown">
				LES COLLECTIONS
				<i class="fa fa-angle-down pull-right"></i><br>
				<hr>
			</span>
			<div class="collectionsList"> </div>
		</div>

		<div class="col-md-12 margin-top-15">
			<span class="title-menu-left text-brown">
				LES GENRES
				<i class="fa fa-angle-down pull-right"></i><br>
				<hr>
			</span>
			<div class="genresList"> </div>
		</div>		
	</div>
	
</div>

<?php 
	if(!isset($me)) $me = "";
	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.'; 
 	$this->renderPartial($layoutPath.".menu.menuSmall", 
 					array(  "me"=>$me,
 			 				"myCity" => $myCity)); 
?> 

<?php // ?>
<div class="visible-xs" id="menu-bottom">
	<input type="text" class="text-dark input-global-search visible-xs" id="input-global-search-xs" placeholder="rechercher ..."/>
	<?php 
	if(isset(Yii::app()->session['userId']) && false){ ?>
		<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
		</button>
	<?php } ?>
</div>


<script type="text/javascript">

var timeoutCommunexion = setTimeout(function(){}, 0);
var showMenuExplanation = <?php echo (@$me["preferences"]["seeExplanations"] || !@Yii::app()->session["userId"]) ? "true" : "false"; ?>;
var urlLogout = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";

var menuExtend = ["organization", "project", "people", "vote", "action"];
jQuery(document).ready(function() {
	/*genresHtml="";
	console.log("gennnnnres",genresType);
	$.each(genresType, function(i, v) {
		genresHtml+='<a href="javascript:directory.toggleEmptyParentSection(\'.favSection\',\'.'+slugify(v)+'\',\'.searchPoiContainer\',1)" class="favElBtn '+slugify(v)+'Btn" data-tag="'+slugify(v)+'">'+v+'</a><br>';
		$(".genresList").append(genresHtml);
	});
	collectionsHtml="";
	$.each(collectionsType, function(i, v) {
		collectionsHtml+='<a href="javascript:directory.toggleEmptyParentSection(\'.favSection\',\'.'+slugify(v)+'\',\'.searchPoiContainer\',1)" class="favElBtn '+slugify(v)+'Btn" data-tag="'+slugify(v)+'">'+v+'</a><br>';
		$(".collectionsList").append(collectionsHtml);
	});*/

	$(".carousel-control").click(function(){
    var top = $("#docCarousel").position().top-30;
    $(".my-main-container").animate({ scrollTop: top, }, 300 );
  });

  $(".btn-carousel-previous").click(function(){ //toastr.success('success!'); console.log("CAROUSEL CLICK");
      var top = $("#docCarousel").position().top-30;
      $(".my-main-container").animate({ scrollTop: top, }, 100 );
      setTimeout(function(){ $(".carousel-control.left").click(); }, 500);
    });
   $(".btn-carousel-next").click(function(){ //toastr.success('success!'); console.log("CAROUSEL CLICK");
      var top = $("#docCarousel").position().top-30;
      $(".my-main-container").animate({ scrollTop: top, }, 100 );
      setTimeout(function(){ $(".carousel-control.right").click(); }, 500);
    });
	showMenuExplanation = false;
	
	bindEventMenu();
	
	$(".menu-button-left").mouseenter(function(){
		$(this).addClass("active");
	});
	$(".menu-button-left").mouseout(function(){
		$(this).removeClass("active");
	});
	$(".menu-button-left").click(function(){
		$(".menu-button-left").removeClass("selected");
		$(this).addClass("selected");
	});

	<?php if($myCity == null){ ?>
		$(".visible-communected").hide(400);
		$(".hide-communected").show(400);
	<?php } ?>

	extendMenu(true);
});

function extendMenu(open){
	if(!notEmpty(open)) open = $("#menu-extend").hasClass("hidden");
	if(open){
		$("#menu-extend").removeClass("hidden", 300);
		$(".lbl-extends-menu i").removeClass("fa-angle-down").addClass("fa-angle-up");
		
	}else{
		$("#menu-extend").addClass("hidden", 300);
		$(".lbl-extends-menu i").addClass("fa-angle-down").removeClass("fa-angle-up");
	}
}
</script>