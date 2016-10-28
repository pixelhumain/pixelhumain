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
</style>
<div class="hover-info col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20" >
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>

<div class="hover-info2 col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20"></div>


<div class="hidden-xs main-menu-left col-md-2 col-sm-2 padding-10"  data-tpl="menuLeft">
	
	<div class="menu-left-container">

		<div class="col-md-12">
			<span class="title-menu-left">
				FOCUS
			</span>
		</div>
		<div class="col-md-12" id="poiParent">
			<!--<img src="<?php echo $this->module->assetsUrl?>/images/velo.png" class="img-responsive">-->
		</div>
		<div class="col-md-12 margin-top-15">
			<span class="title-menu-left">
				LES COLLECTIONS
				<i class="fa fa-angle-down pull-right"></i><br>
				<hr>
			</span>
			<a href="javascript:" class="">Où sont les femmes</a><br>
			<a href="javascript:" class="">Passeur d'images</a><br>
			<a href="javascript:" class="">MHQM</a><br>
			<a href="javascript:" class="">MIAA</a><br>
			<a href="javascript:" class="">Portrait citoyens</a><br>
			<a href="javascript:" class="">Parcours d'engagement</a>
		</div>

		<div class="col-md-12 margin-top-15">
			<span class="title-menu-left">
				LES GENRES
				<i class="fa fa-angle-up pull-right"></i><br>
				<hr>
			</span>
			<a href="javascript:" class="">Documentaire</a><br>
			<a href="javascript:" class="">Fiction</a><br>
			<a href="javascript:" class="">Docu-fiction</a><br>
			<a href="javascript:" class="">Films outils</a><br>
			<a href="javascript:" class="">Films de commande</a><br>
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