<?php
$communexion = CO2::getCommunexionCookies(); 
?>
<style>

.main-col-search{
	padding:0px !important;
	background-color: white !important;
}
.home_page h3.subtitle{
	font-weight: 300;
	font-size:20px;
}
.home_page h3.information{
	/*font-weight: 500;*/
	font-size:16px;
}

.home_page #main-logo-home{
	max-height: 290px;
	margin-top:30px;
}

.home_page .imageSectionVideo{
	width:80%;
	margin-left:10%;
}
.home_page .section-video{
	margin-top: 40px;
}

.home_page .btn-top{
	border-radius: 50px;
}

.home_page .btn-discover{
	border-radius: 60px;
	font-size: 50px;
	font-weight: 200;
	border: 1px solid transparent;
	width: 90px;
	height: 90px;
}
.home_page .btn-discover:hover{
	background-color: white !important;
	border-color: #2BB0C6 !important;
	color: #2BB0C6 !important;
}

.home_page .discover-subtitle{
	font-size:13px;
	margin-top: -6px;
	display: block;
}

.home_page .pastille{
	height: 100%;
	width: 100%;
	border-radius: 50px;
	font-size: 45px;
	padding: 13px 32px;
}

.list-action{
	/*width: 100%;*/
	/*padding: 5px 10px;*/
	margin-bottom:40px;
	font-size: 15px;
	font-weight: 300;
}

#img-network-for-all{
	/*max-width: 800px;*/
	padding:25px;
}
.menu-home-btn-ins{
	position: fixed;
	top: 0px;
	padding: 5px;
	right: 2%;
	z-index: 30;
	border-radius: 30px 30px 30px 30px;
}
/*#searchBarPostalCode{
	margin-top: 10px;
	width: 200px;
	margin-left: 0px;
	font-family: "homestead";
	font-size: 22px !important;
	border-radius: 3px !important;
	height: 40px;
}*/
/*input[type="text"].input-search:focus{
	/*border-color: #3C5665 !important;* /
	-moz-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	-webkit-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	-o-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	box-shadow: 0px 0px 5px -1px #CF3838 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}

#dropdown_search{
	margin-top:30px;
	margin-bottom:30px;
}*/

.btn-success.communected{
	width: 50%;
	margin-left: 25%;
	padding: 10px;
	border-radius: 20px;
	background-color:#5cb85c;
	color:white;
}
/*
.searchEntity{
	margin-bottom:10px;
	margin-left:5px;
	display: inline-block;
}
.searchEntity .entityRight{
	text-align: center;
	padding: 6px 16px !important;
	margin-left: -1%;
	border-radius: 30px;
}
.searchEntity .entityRight .entityLocality{
	color:white !important;
	display: inline;
}
.searchEntity .entityRight .entityName{
	color:white !important;
	display: inline;
}*/
.contact-map {	
	background:url(<?php echo $this->module->assetsUrl; ?>/images/people.jpg) bottom center repeat-x; 
	background-size: 60%;
	background-color:#DFE7E9;  
}
.headSection {	
	background:url(<?php echo $this->module->assetsUrl; ?>/images/1+1=3.jpg?c=c) bottom center no-repeat; 
	background-size: 80%;
	background-color:#fff;  
}
.keyword,.keyword1{margin-bottom: 3px;font-size:1.3em;}
.keywordExplain,.usageExplain{font-size:1.3em;}
.fa-caret-down{font-size:56px;line-height: 10px;}
.headerIcon{font-size: 1.6em;}

.social-list{	padding: 0;}
.social-list li{	list-style-type: none;	display:inline;margin-right:10px;}
.social-list li a{ font-size:20px;}
.social-list .btn{	margin-top: 15px;}
a.btn.btn-social{	color: #FFF;	background-color: #2a3945; }
a.btn.btn-social:hover{	background: none;}
a.btn.btn-facebook:hover{	color: #3b5998;}
a.btn.btn-twitter:hover{	color: #00a0d1;	border-color: #00a0d1;}
a.btn.btn-google:hover{	color: #dd4b39;	border-color: #dd4b39;}
a.btn.btn-github:hover{	color: #4078C0;	border-color: #4078C0;}
.yellowph{color:#F6E201;}
.information{
	font-size:15px;
	color:#8b91a0;
}


.btn-show-video{
	position:absolute;
	bottom:10px;
	right:40%;
}


#img-header{
	display:inline;
	max-height: 540px;
}

/*.videoWrapper {
	position: relative;
	padding-bottom: 56.25%;  16:9 
	padding-top: 25px;
	height: 0;
	/*display: none;* /
}*/
.videoWrapper iframe {
	/*position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;*/
}

.flexContainer {
	display: flex;
	align-items: center;
    justify-content: center;
}

.explainLink {
	color: #e33551;
	text-decoration-line: underline !important;;
	text-decoration-style : dotted !important;;
}

.home_page h1{
	margin-top:5px;
	padding:0 25px;
	text-align:center;
}

.header-nowList{
	display: none;
}
.el-nowList{

	width:23% !important;
	margin-right:1%;
	margin-left:1%;
	margin-bottom: 15px !important;
	float:left!important;
}
.el-nowList:hover{
	width:23% !important;
	float:left!important;
	-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.7);
	-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.7);
	box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.7);
}
/*.col-nowList hr{
	margin-bottom: 50px!important;
}*/

a.link-submenu-header {
    padding: 15px;
    font-size: 20px;
    border: 1px solid #e4e4e4;
    margin-right: 5px !important;
    border-radius: 3px;
}

.previewLocalActivity{
	float: unset;
	position: absolute;
	z-index: 100;
	left: 25%;
	width: 50%;
	min-height:400px;
}

#before-section-result{
	display: none;
}
.peopleTalkComment{
	font-size:11px;
}
.peopleTalkName{
	font-weight: bold;
}
#co-friends .img-thumbnail{
	width: 100%;
}
</style>

<div class="home_page">

	<!-- <div class="col-md-12 col-lg-12 col-sm-12">
		<?php 	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
	  			//$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.login'); 
	  	?>
	</div> -->
	<div class="col-md-12 col-lg-12 col-sm-12 imageSection" 
		 style="margin-top: 30px; position:relative;">

		<div class="col-md-12 no-padding">
			
			<?php if(!isset(Yii::app()->session['userId'])) { ?>
			<div class="col-md-7 col-sm-7 text-center">
				<div id="homeImg">
					<img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/1+1=3empty.jpg"/>
				</div>
			</div>

			<div class="col-md-4 col-sm-5 margin-top-25 padding-bottom-15 margin-right-50" 
				 style="border:1px solid #DDD; background-color: #F9F9F9; border-radius:4px;">
				<?php 	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
			  			$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.register'); 
			  	?>
			</div>
			<?php } else { ?>
			<div class="col-md-12 text-center">
				<div id="homeImg">
					<img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/1+1=3empty.jpg"/>
				</div>
			</div>
			<?php } ?>
		</div>


		<!-- <div class="col-md-12 no-padding margin-top-25"><hr></div> -->


		<!-- <div class="col-md-12">
			<h3 class="text-red text-center"><i class="fa fa-hand-up"></i><br>parcourir les applications</h3>
			<hr class="angle-down">
		</div> -->
		<div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 shadow2 padding-15 margin-top-25">
			<div class="mainmenu"></div>
		</div>


		<div class="col-md-12 margin-top-50">
			<h3 class="text-red text-center">
				<i class="fa fa-home fa-2x"></i><br>
				Communexion<br>
				<small>
					<i class="fa fa-cross"></i> Vous n'êtes pas <span class="text-dark">communecté</span><br>
					<small class="text-dark inline-block margin-top-5" style="line-height: 15px;">
					<i class="fa fa-signal"></i> 
					Être communecté vous permet de capter en direct les informations pertinentes<br>
					qui se trouvent autour de vous.</small>
				</small>
			</h3>
			<hr class="angle-down">
			<h5 class="text-center">communectez-vous !</h5>
			<select class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 form-input margin-bottom-5">
				<option>France</option>
			</select>
			<input class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 form-input text-center" 
				   id="main-search-bar" type="text" 
				   style="border-radius:50px; height:40px; border: 2px solid red; color:red; margin-bottom:15px;"
				   placeholder="communectez-vous : Nantes, Strasbourg, Avignon ?"></div>

			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" style="font-family: 11px;" id="info_co">
	            <i class="fa fa-signal"></i> Pour utiliser le réseau à pleine puissance, nous vous conseillons de vous 
	            <i><b>communecter</b></i>.<br><br>
	            <i class="fa fa-magic"></i> Indiquez de préférence votre <b>commune de résidence</b>, 
	            pour garder un œil sur ce qui se passe près de chez vous, de façon automatique.<br>
	        </div>
	        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" style="font-family: 11px;" id="dropdown_search">
	        </div>
		</div>

		
		<div class="col-md-12 col-sm-12 col-xs-12 no-padding margin-top-25"><hr></div>
		
		<div class="col-md-12">
			<h3 class="text-red text-center"><i class="fa fa-clock-o fa-2x"></i><br><br>En ce moment sur le réseau</h3>
			<div class="text-left" id="nowList"></div>
		</div>

		<div class="col-md-12 margin-top-50">
			<h3 class="text-red text-center">En savoir plus</h3>
			<hr class="angle-down">
		</div>

		<div class="videoWrapper col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
			<!-- <a href="javascript:;" onclick="" class="btn-show-video"><i class="fa fa-youtube-play fa-5x"></i></a> -->
			<iframe class="col-md-12 col-xs-12 no-padding" height="480" 
					src="https://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" 
					frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="video" 
					aria-hidden="true" tabindex="-1" style="border:10px solid black;">
			</iframe>
		</div>


		<!-- <div class="col-md-6 text-left margin-top-25" style="background-color:#fffff;color:#293A46;padding-bottom:40px; float:left;">
			
			<h4 class="text-dark homestead">Un réseau sociétal, territorial, citoyen, libre, gratuit et ouvert</h4>
			<!-- En s'appuyant sur un <a href="javascript:;" data-id="explainSocietyNetwork" class="explainLink">réseau sociétal</a> (au service de la société) regroupant les acteurs d'un territoire, - ->
			<a href="javascript:;" data-id="explainCommunecter" class="explainLink">"Communecter"</a> propose des outils numériques innovants et accessibles à tous, afin de créer ensemble
			un <a href="javascript:;" data-id="explainConnectedTerritory" class="explainLink">territoire connecté</a> qui nous ressemble.
			<br/><br/>Tout cela gratuitement, dans le respect des données de chacun, car Communecter est un <a href="javascript:;" data-id="explainCommuns" class="explainLink">bien commun</a>
			fait pour et par chacun d’entre nous, porté par une association à but non lucratif.
			<br/><br/>
			Plus qu'une simple application, <span class="text-red">Communecter</span> c'est aussi :
			<ul class="information" style="font-weight: normal;">
			<li>Une projet <a href="javascript:;" data-id="explainOpenSource" class="explainLink">open source</a></li>
			<li>Une communauté riche et diversifiée</li>
			<li>Un site web qui vous tend les bras</li>
			<li>Une application mobile (en cours de développement) </li>
			<li>Des interfaces tierces contribuant à une base de donnée commune</li>
			<!-- <li>Des instances indépendantes mais inter-opérantes par leurs <a href="javascript:;" data-id="explainOpenSource" class="explainLink">sémantiques</a> communes </li> *termes trop techniques pour user lambda => complique - ->
			</ul>
			
		</div> -->


	</div>
	

	<!-- <div class="col-md-3 col-lg-3 col-sm-3 pull-right" style="margin-top: 100px;padding-right: 4%;"> -->

		<!-- <img class="img-responsive inline-block" src="<?php echo $this->module->assetsUrl; ?>/images/screens.png"/ style="max-height:100px;"> -->
		
	<!-- </div> -->

	<div class="col-sm-12 no-padding margin-top-50" style="background-color:#fff; max-width:100%; float:left;">
		<div class="col-md-12" style="background-color:#E33551;width:100%;padding:8px 0px 8px 0%;">
			<h1 class="homestead text-center text-white">
				<i class="fa fa-user-circle"></i><br>Les amis de communecter
			</h1>
		</div>
		<center>
			<i class="fa fa-caret-down text-red"></i><br/>
		</center>

		<div id="co-friends" class="padding-15"></div>
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 ">
			<img class="img-responsive img-thumbnail peopleTalkImg">
			<span class="peopleTalkName text-extra-large"></span>
			<br/>
			<span class="peopleTalkProject text-extra-large"></span>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 ">
			<img class="img-responsive img-thumbnail peopleTalkImg">
			<span class="peopleTalkName text-extra-large"></span>
			<br/>
			<span class="peopleTalkProject text-extra-large"></span>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 ">
			<img class="img-responsive img-thumbnail peopleTalkImg">
			<span class="peopleTalkName text-extra-large"></span>
			<br/>
			<span class="peopleTalkProject text-extra-large"></span>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 ">
			<img class="img-responsive img-thumbnail peopleTalkImg">
			<span class="peopleTalkName text-extra-large"></span>
			<br/>
			<span class="peopleTalkProject text-extra-large"></span>
		</div>
	</div>

	<div class="col-sm-12 no-padding margin-top-50" style="background-color:#E33551; max-width:100%; float:left;" id="teamSection">
		<!-- <div class="col-md-12" style="background-color:#293A46;width:100%;padding:8px 0px 8px 0%;">
			<h1 class="homestead center text-white"><a href="#default.view.page.partners" class="lbh">Partenaires & Contributeurs</a> <i class="fa fa-share-alt fa-2x"></i></h1>
		</div>
		<!-- <center>
			<i class="fa fa-caret-down" style="color:#293A46;"></i><br/>
		</center> -->
		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i><br/>
			<h1 class="homestead" style="color:#fff">
				<!-- <i class="fa fa-line-chart headerIcon"></i>  -->
				EN AMÉLIORATION CONTINUE
			</h1>
			
			<div class="col-sm-12 text-white padding-bottom-15">
				Communecter est une plateforme open source, construite de façon collaborative.
				<!-- <i>"EN AMÉLIORATION CONTINUE"</i> -->
				<h3 class="">Rejoignez nous : </h3>

				<a href="#showTagOnMap.tag.developpeur" data-id="explainDeveloper"  class="lbh btn btn-default text-bold">Développeurs</a>
				<a href="javascript:showTagOnMap ('#communecteur')" data-id="explainCommunecteur" class=" btn btn-default text-bold">Communecteurs</a>
				<a href="javascript:showTagOnMap ('#editeur')" data-id="explainEditor" class=" btn btn-default text-bold">Editeurs </a>
				<a href="javascript:showTagOnMap ('#designeur')" data-id="explainDesigner" class=" btn btn-default text-bold">Designeur </a><br>
				<a href="javascript:showTagOnMap ('#contributeur')" data-id="explainContributor" class="margin-top-10  btn btn-default text-bold">Contributeurs</a>
				<a href="#organization.detail.id.<?php echo Yii::app()->params['openatlasId'] ?>" class="margin-top-10 lbh btn btn-default text-bold">Association Open Atlas</a>
				<a href="#project.detail.id.<?php echo Yii::app()->params['communecterId'] ?>"  class="margin-top-10 lbh btn btn-default text-bold">Projet Communecter</a>
			</div>
		</center>
		<div class="space20"></div>
	</div>

	<div class="col-md-12 contact-map padding-bottom-50" style="color:#293A46; float:left; width:100%;" id="contactSection">
		<center>
			<i class="fa fa-caret-down" style="color:#E33551"></i><br/>
			<h1 class="homestead">
			<i class="fa fa-envelope headerIcon"></i><br/>
			CONTACT
			</h1>
			+ 262 262 34 36 86<br><a href="#">contact@pixelhumain.com</a>

			<ul class="social-list">
				<li><a target="_blank" href="https://www.facebook.com/communecter" class="btn btn-facebook btn-social"><span class="fa fa-facebook"></span></a></li>
				<li><a target="_blank" href="https://twitter.com/communecter" class="btn btn-twitter btn-social"><span class="fa fa-twitter"></span></a></li>
				<li><a target="_blank" href="https://plus.google.com/communities/111483652487023091469" class="btn btn-google btn-social"><span class="fa fa-google-plus"></span> </a></li>
				<li><a target="_blank" href="https://github.com/pixelhumain/communecter" class="btn btn-github btn-social"><span class="fa fa-github"></span> </a></li>
			</ul>

			<a href="javascript:;" data-id="explainOpenAtlas" class="explainLink">L'association Open Atlas</a>
			<br/><a href="#default.view.page.mention" class="lbh" >Mentions Légales</a>
			<br/><a href="#default.view.page.partners" class="lbh">Partenaires</a>
		<center>
	</div>
</div>


<div class="portfolio-modal modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content form-email box-email padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else { ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">
                        <?php } ?>
                    </span>
                    <h4 class="letter-red no-margin" style="margin-top:-5px!important;">Mot de passe oublié ?</h4><br>
                    <hr>
                    <p><small>Indiquez votre addresse e-mail, vous recevrez un e-mail contenant votre mot de passe.</small></p>
                    <hr>
                    
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                
                <label class="letter-black"><i class="fa fa-envelope"></i> E-mail</label><br>
                <input class="form-control" id="email2" name="email2" type="text" placeholder="E-mail"><br/>
                
                <hr>

                <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
                    <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                        <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
                    </div>
                </div>

                <!-- <div class="form-actions">
                     <button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
                        <span class="ladda-label">XXXXXXXX</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                    </button>
                </div> -->

                <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                <button class="btn btn-success text-white pull-right forgotBtn"><i class="fa fa-sign-in"></i> Envoyer</button>
                
                
                <div class="col-md-12 margin-top-50 margin-bottom-50"></div>
            </div>      
        </div>
    </form>
</div>


<script type="text/javascript">

<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
	  $this->renderPartial($layoutPath.'home.peopleTalk'); ?>
var peopleTalkCt = 0;
var communexion=<?php echo json_encode($communexion) ?>;
jQuery(document).ready(function() {

	topMenuActivated = false;
	hideScrollTop = true;
	checkScroll();

	loadLiveNow();
	openVideo();

	peopleTalkCt = getRandomInt(0,peopleTalk.length);
	showPeopleTalk();

	$(".mainmenu").html($("#modalMainMenu .links-main-menu").html());
	//$("#modalMainMenu .links-main-menu").html("");

	//setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	var timerCo = false;
			
	$("#main-search-bar").keyup(function(){
		if(timerCo != false) clearTimeout(timerCo);
		timerCo = setTimeout(function(){ 
			$("#info_co").html("");
			searchType = ["cities"];
			loadingData=false;
			scrollEnd=false;
			startSearch(0, 20);
		}, 500);
	});
	$("#res-co").html();

	setTitle("Bienvenue sur <span class='text-red'>commune</span>cter","home","Bienvenue sur Communecter");
	$('.tooltips').tooltip();

	$("#btn-param-postal-code").click(function(){
		$("#div-param-postal-code").show(400);
	});

	// $('#searchBarPostalCode').keyup(function(e){
 //        clearTimeout(timeoutSearchHome);
 //        timeoutSearchHome = setTimeout(function(){ startSearch(); }, 800);
 //    });


    $(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});
    $(".keyword").click(function() {
    	$(".keysUsages").hide();
    	link = "<br/><a href='javascript:;' class='showUsage homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Usages</a>";
    	$(".keywordExplain").html( $("."+$(this).data("id")).html()+link ).fadeIn(400);
    	 $(".showUsage").off().on("click",function() { $(".keywordExplain").slideUp(); $(".keysUsages").slideDown();});
    });

    $(".keyword1").click(function() {
    	$(".keysKeyWords").hide();
    	link = "<br/><a href='javascript:;' class='showKeywords homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Mots Clefs</a>";
    	$(".usageExplain").html( $("."+$(this).data("id")).html()+link ).slideDown();
    	 $(".showKeywords").off().on("click",function() { $(".usageExplain").slideUp(); $(".keysKeyWords").slideDown();});
    });


    $(".btn-main-menu").mouseenter(function(){ 
        $(".menuSection2").addClass("hidden"); 
        if( $(this).data("type") ) 
            $("."+$(this).data("type")+"Section2").removeClass("hidden");
    }).click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn("***************************************"); 
        mylog.warn("bindLBHLinks",$(this).attr("href")); 
        mylog.warn("***************************************"); 
        var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href"); 
        urlCtrl.loadByHash( h ); 
    }); 

    $(".tagSearchBtn").click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn( ".tagSearchBtn",$(this).data("type"),$(this).data("stype"),$(this).data("tags") ); 

        searchObj.types = $(this).data("type").split(",");
        
        if( $(this).data("stype") )
            searchObj.stype = $(this).data("stype");
        else
            searchObj.tags = $(this).data("tags");
        
        urlCtrl.loadByHash($(this).data("app"));
        urlCtrl.afterLoad = function () {     
            //we have to pass by a variable to set the values         
            searchType = searchObj.types;
        
            if( $(this).data("stype") )
                $('#searchSType').val(searchObj.stype);
            else
                $('#searchTags').val(searchObj.tags);
            startSearch();
            searchObj = {};
        }
    }); 
});
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function showPeopleTalk(step)
{
	// if(!step)
	// 	step = 1;
	// peopleTalkCt = peopleTalkCt+step;
	// if( undefined == peopleTalk[ peopleTalkCt ]  )
	// 	peopleTalkCt = 0;
	// person = peopleTalk[ peopleTalkCt ];

	var html = "";
	$.each(peopleTalk, function(key, person){
	html += '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 padding-5" style="min-height:430px;max-height:430px;">' +
				'<div class="" style="max-height:240px; overflow:hidden; max-width:100%;">' +
				'<img class="img-responsive img-thumbnail peopleTalkImg" src="'+person.image+'"><br>' +
				'</div>' +
				'<span class="peopleTalkName">'+person.name+'</span><br>' +
				'<span class="peopleTalkProject">'+person.project+'</span><br>' +
				'<span class="peopleTalkComment inline-block">'+person.comment+'</span>' +
			'</div>';
	});

	$("#co-friends").html( html );
	// $(".peopleTalkName").html( person.name );
	// $(".peopleTalkImg").attr("src",person.image);
	// $(".peopleTalkComment").html("<i class='fa fa-quote-left'></i> "+person.comment+"<i class='fa fa-quote-right'></i> ");
	// $(".peopleTalkProject").html( "<a target='_blank' href='"+person.url+"'>"+person.project+"</a>" );

}

function openVideo(){
	//$("#homeImg").fadeOut("slow",function() {
		$(".videoWrapper").fadeIn('slow');
	//});
}

var timeoutSearchHome = null;

function showTagOnMap (tag) {

	mylog.log("showTagOnMap",tag);

	var data = { 	 "name" : tag,
		 			 "locality" : "",
		 			 "searchType" : [ "persons" ],
		 			 //"searchBy" : "INSEE",
            		 "indexMin" : 0,
            		 "indexMax" : 500
            		};

        //setTitle("","");$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");

		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherches des collaborateurs ...</h1>"
		});

		showMap(true);

		$.ajax({
	      type: "POST",
	          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
	          data: data,
	          dataType: "json",
	          error: function (data){
	             mylog.log("error"); mylog.dir(data);
	          },
	          success: function(data){
	            if(!data){ toastr.error(data.content); }
	            else{
	            	mylog.dir(data);
	            	Sig.showMapElements(Sig.map, data);
	            	//$(".moduleLabel").html("<i class='fa fa-connect-develop'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
					//$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
					//toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
					$.unblockUI();
	            }
	          }
	 	});

	//loadByHash('#project.detail.id.56c1a474f6ca47a8378b45ef',null,true);
	//Sig.showFilterOnMap(tag);
}



function loadLiveNow () {
	mylog.log("loadLiveNow");
	/*var dep = ( ( notNull(contextData["address"])  && notNull(contextData["address"]["depName"]) ) ? 
				contextData["address"]["depName"] : "");
	*/
    var searchParams = {
      "tpl":"/pod/nowList",//"json", //
      //"latest" : true,
      //"searchType" : [typeObj["event"]["col"],typeObj["project"]["col"],
      //					typeObj["organization"]["col"],"classified",
      //				 /*typeObj["organization"]["col"]*//*,typeObj["action"]["col"]*/], 
      //"searchTag" : $('#searchTags').val().split(','), //is an array
      //"searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
      //"searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
      "searchLocalityDEPARTEMENT" : new Array(""), //$('#searchLocalityDEPARTEMENT').val().split(','),
      //"searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 30 
    };

    ajaxPost( "#nowList", baseUrl+'/'+moduleId+'/element/getdatadetail/type/0/id/0/dataName/liveNow?tpl=nowList',
					searchParams, function(data) {
					//var html = directory.showResultsDirectoryHtml(data);
					//$("#nowList").html(html);
			        bindLBHLinks();
     } , "html" );
}


</script>
