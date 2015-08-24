<!-- start: TOP NAVIGATION MENU -->
<style>
	#dropdown_searchTop{
		padding: 0px 15px; 
		margin-left:375px; 
		width:250px;
	}

	#dropdownTags{
		padding: 0px 15px; 
		margin-left:3%; 
		width:275px;
	}
	.li-dropdown-scope{
		padding: 8px 3px;
		color: black;
		float:none;
		line-height: 20px;
	}
	.li-dropdown-scope:hover{
		/*background-color: #ccc;*/
	}

	#searchBar{
		max-width: 250px;
	}
	.searchList:hover{
		background-color: #ccc;
	}
	
	ol{ 
		padding-left:0; 
		list-style-position:inside; 
	}
	
	<?php if( Yii::app()->session[ "userIsAdmin"] && Yii::app()->controller->id == "admin" ){?>
	.top-navbar { background-color: #E33551; }
	<?php }?>
</style>

<header class="top-navbar collapse_list " >

	<div class="navbar-logo collapse_wrap">
		<?php 
			$platform = "";
			$logoColor = "";
			if( $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == "localhost" ){
				$logoColor = "#04b8ec";
				$platform = "LOCAL DEV";
			}
			else if( $_SERVER['SERVER_NAME'] == "test.pixelhumain.com" ){
				$logoColor = "#e4334b";
				$platform = "TEST";
			}
			else if( $_SERVER['SERVER_NAME'] == "dev.pixelhumain.com" ){
				$logoColor = "#92be1f";
				$platform = "ONLINE DEV";
			}
			else if( $_SERVER['SERVER_NAME'] == "pixelhumain.com" ){
				$logoColor = "white";
				$platform = "PROD";
			}
			$contextInfo = (isset($this->version)) ? $platform." : ".$this->version : $platform;
		 ?>
		<h1 class="trigger collapse_trigger hide_on_active">
			<i class="fa fa-bars mainModuleMenu  " style="color:<?php echo $logoColor ?>;font-size: 32px;" title="<?php echo $contextInfo ?>"></i>
			<span class="fulltitle">full page title</span>
			<span class="menu-count badge badge-danger animated bounceIn"></span>
		</h1>

		<div class="inner collapse_box">
			<span class="trigger collapse_trigger">
				<i class="fa fa-bars mainModuleMenu " style="color:<?php echo $logoColor ?>;font-size: 32px;" title="<?php echo $contextInfo ?>"></i>
			</span>
			<?php if(isset(Yii::app()->session["userId"])){ ?>
	 			<a href="<?php echo Yii::app()->createUrl("/".$this->moduleId."/person/")?>" class="userlink">
					<i class="fa fa-user_circled"></i>
					<span class="username"><?php echo (isset(Yii::app()->session["user"]["name"])) ? Yii::app()->session["user"]["name"] : Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?></span>
				</a>

				<a href="#" onclick="popinInfo('TODO : Compteur Notfication de discussion','Ce compteur de gamification permettra de suivre')">
					<i class="fa fa-comment"></i>
					<span class="notifications-count badge badge-danger animated bounceIn"></span>
				</a>
				<?php //<a href="<?php echo Yii::app()->createUrl("/".$this->moduleId."/person/activities") ?>
				<a href="#" onclick="popinInfo('TODO : Compteur de Gamifation','Ce compteur de gamification permettra de suivre les points cumulés par l`activité sur la plateforme')"  >
					<i class="fa fa-bookmark-o"></i>
				</a>
				<a href="#" class="sb_toggle" id="sbToogle">
					<i class="fa fa-cog"></i>
				</a>
			<?php } else { ?>
				<a style="padding-right:30px;padding-left:30px;" href="<?php echo Yii::app()->createUrl("/".$this->moduleId."/person/login"); ?>" >
					<i class="fa fa-power-off"></i>
					<span > Se connecter   </span>
				</a>
			<?php }; ?>
		</div>
	</div>
		
	<ul class="navbar-menu">

		<li class="collapse_wrap topBtn">
			<div class="trigger collapse_trigger" title="TAGS" onclick='openSlideBar("tags")'>
				<i class="fa fa-tags"></i>
				<span class="tags-count notifcation-counter badge badge-warning animated bounceIn"></span>
			</div>
		</li>

		<li class="collapse_wrap topBtn">
			<div class="trigger collapse_trigger" title="TERRITORIES"  onclick='openSlideBar("scope")'>
				<i class="fa fa-circle-o"></i>
				<span class="scopes-count notifcation-counter badge badge-warning animated bounceIn"></span>
			</div>
		</li>

		<li class="collapse_wrap">
			<div class="trigger collapse_trigger">
				<a href="javascript:;" onclick="openSubView('Your Network', '/communecter/sig/network', null)">
					<i class="fa fa-map-marker"></i>
				</a>
			</div>
			<!--
			<form class="inner collapse_box" onSubmit="return(false);">
				<input class="wide" id="sigNetwork" name="sigNetwork" type="text" placeholder="Pseudo, passez votre interface en mode cartographie">
			</form>
			-->
		</li>
		
		<li class="collapse_wrap">
			<div class="trigger collapse_trigger">
				<a href="javascript:;" onclick="openViewer()">
					<i class="fa fa-share-alt"></i>
				</a>
			</div>
		</li>

		<li class="collapse_wrap">
			<div class="trigger collapse_trigger">
				<a href="javascript:;" onclick="openSubView('Directory View', '/communecter/default/directory<?php echo (isset(Yii::app()->controller->id)) ? "/type/".Yii::app()->controller->id : ""; ?><?php echo (isset($_GET['id'])) ? "/id/".$_GET['id'] : ""; ?>', null)">
					<i class="fa fa-align-justify"></i>
				</a>
			</div>
		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger" id="searchForm">
				<i class="fa fa-search"></i>
			</div>

			<form class="inner collapse_box">
				<input class='hide' id="searchId" name="searchId"/>
				<input class='hide' id="searchType" name="searchType"/>
				<input id="searchBar" name="searchBar" type="text" placeholder="Que recherchez-vous ?">
					<ul class="dropdown-menu" id="dropdown_searchTop" style="">
						<ol class="li-dropdown-scope">-</ol>
					</ul>
				</input>
			</form>

		</li>

		<li class="collapse_wrap">
			<a href="#" class="sb-toggle-right trigger">
				<i class="fa fa-globe toggle-icon"></i>
				<?php if( !empty( $this->notifications )  ){?>
				<span class="notifications-count badge badge-danger animated bounceIn"><?php count($this->notifications); ?></span>
				<?php } ?>
			</a>
		</li>
	</ul>
	<li class="dropdown pull-right">
		<a href="#" data-close-others="true" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
			<img  style="float:right;margin:13px; height:35px;" src="<?php echo ($this->module) ? $this->module->assetsUrl."/images/logoSMclean.png" : Yii::app()->baseUrl."/images/logo/byPH.png" ?>"/>
		</a>
		<ul class="dropdown-menu">
			 <?php 
			 	if(isset(Menu::$infoMenu))
	          	{
	          		foreach( Menu::$infoMenu as $item )
			        {
			            Menu::buildLi2( $item );
			        }
			    }
	          ?>
		</ul>
	</li>
</header>
<!-- end: TOP NAVIGATION MENU -->

<script type="text/javascript">

	var timeout;
	var mapIconTop = {
		"citoyen":"fa-user", 
		"NGO":"fa-users",
		"LocalBusiness" :"fa-industry",
		"Group" : "fa-circle-o",
		"GovernmentOrganization" : "fa-university",
		"event":"fa-calendar",
		"project":"fa-lightbulb-o"
	};

	jQuery(document).ready(function() 
	{

		$("#filterField").keyup(function(e){
			var str = $("#filterField").val();
			getFieldFilter(str, 2);
		});

		$("#filterCpField").keyup(function(e){
			var str = $("#filterCpField").val();
			getFieldFilter(str, 3);
		})

		$('#searchBar').keyup(function(e){
		    var name = $('#searchBar').val();
		    if(name.length>=3){
		    	clearTimeout(timeout);
		    	timeout = setTimeout('autoCompleteSearch("'+name+'")', 500);
		    }else{
		    	$("#dropdown_searchTop").css("display", "none");
		    }		
		});

		$("#searchForm").on("click", function(){
			$("dropdown_searchTop").css("display", "none");
		});

		$("#sbToogle").on("click", function(){
			getInfo();
		})
		// ---------- TAGS ------------
		if( window.localStorage && typeof localStorage!='undefined' && localStorage.myTagsCount )
			$(".tags-count").html(localStorage.myTagsCount);
		
		
		
		//-----Pluger Map ici-----

		$('#sigNetwork').keypress(function(e){
			if(e.keyCode == 13){
				var searchValue = $('#sigNetwork').val();
				checkListElementMap(map1)
			}
		});
		$('#searchBar').keypress(function(e){
			if(e.keyCode == 13){
				var type = $("#searchType").val();
				var id = $("#searchId").val();
				if(id != ""){
					window.location.href = baseUrl+"/" + moduleId + "/"+type+"/dashboard/id/"+id;
				}
				
			}
		});
		if($(".tooltips").length) {
	 		$('.tooltips').tooltip();
	 	}
	});

	
	function setSearchInput(id, name, type){
		if(type=="citoyen"){
			type = "person";
		}
		window.location.href=baseUrl+"/" + moduleId + "/"+type+"/dashboard/id/"+id;
		/*
		$("#searchBar").val(name);
		$("#searchId").val(id);
		$("#searchType").val(type);
		$("#dropdown_searchTop").css({"display" : "none" });*/	
	}

	function autoCompleteSearch(name){
		var data = {"name" : name};
		$.ajax({
			type: "POST",
	        url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
					str = "";
		 			$.each(data, function(i, v) {
		 				console.log(v, v.length, v.size);
		 				var typeIco = i;
		 				if(v.length!=0){
		 					$.each(v, function(k, o){
		 						if(o.type){
			 						typeIco = o.type;
			 					}
			 					str += "<div class='searchList li-dropdown-scope' ><ol><a href='javascript:setSearchInput(\""+ o._id["$id"] +"\", \""+o.name+"\", \""+i+"\")'><span><i class='fa "+mapIconTop[typeIco]+"'></i></span>  " + o.name + "</a></ol></div>";
			 				})
		 				}	
		  			}); 
		  			if(str == "") str = "<ol class='li-dropdown-scope'>Aucun résultat</ol>";
		  			$("#dropdown_searchTop").html(str);
		  			$("#dropdown_searchTop").css({"display" : "inline" });
	  			}
			}	
		})
	}


	function getFieldFilter(str, col){
		if(str.length>=3){
			setDropdown(str, col);
			if(typeof(oTableOrganization)!= "undefined"){
				oTableOrganization.DataTable().column( col ).search( str , true , true ).draw();
			}
			if(typeof(oTableEvent)!= "undefined"){
				oTableEvent.DataTable().column( col ).search( str , true , true ).draw();
			}
			if(typeof(oTablePeople)!= "undefined"){
				oTablePeople.DataTable().column( col ).search( str , true , true ).draw();
			}
			if(typeof(oTableProject)!= "undefined"){
				oTableProject.DataTable().column( col ).search( str , true , true ).draw();
			}
		}
		else{
			closeDropdown(str, col);
			if(typeof(oTableOrganization)!= "undefined"){
				oTableOrganization.DataTable().column( col ).search( "" , true , true ).draw();
			}
			if(typeof(oTableEvent)!= "undefined"){
				oTableEvent.DataTable().column( col ).search( "" , true , true ).draw();
			}
			if(typeof(oTablePeople)!= "undefined"){
				oTablePeople.DataTable().column( col ).search( "" , true , true ).draw();
			}
			if(typeof(oTableProject)!= "undefined"){
				oTableProject.DataTable().column( col ).search( "" , true , true ).draw();
			}
		}
	}

	function setDropdown(str, location){
		var htmlres="";
		var arrayFilter;
		if(location == 2 && typeof(contextTags)!="undefined"){
			arrayFilter = contextTags;
		}else if(typeof(contextCp)!="undefined"){
			arrayFilter = contextCp;
		}
		if(typeof(arrayFilter)!="undefined"){
			for(var i = 0; i<arrayFilter.length; i++){
				if(arrayFilter[i].toLowerCase().indexOf(str.toLowerCase())>=0)
					htmlres += "<div class='searchList li-dropdown-scope' ><ol><a href='javascript:setTagsInput(\""+arrayFilter[i]+"\")'>" + arrayFilter[i] + "</a></ol></div>";
			}
			if(htmlres == "") htmlres = "<ol class='li-dropdown-scope'>Aucun résultat</ol>";
			if(location == 2){
				$("#dropdownTags").html(htmlres);
				$("#dropdownTags").css({"display" : "inline" });
			}
			else{
				$("#dropdownCp").html(htmlres);
				$("#dropdownCp").css({"display" : "inline" });
			}
			
		}
		
	}

	function setTagsInput(tags){
		$("#dropdownTags").css({"display" : "none" });
		$("#filterField").val(tags);
		if(typeof(oTableOrganization)!= "undefined"){
			oTableOrganization.DataTable().column( 2 ).search( tags , true , true ).draw();
		}
		if(typeof(oTableEvent)!= "undefined"){
			oTableEvent.DataTable().column( 2 ).search( tags , true , true ).draw();
		}
		if(typeof(oTablePeople)!= "undefined"){
			oTablePeople.DataTable().column( 2 ).search( tags , true , true ).draw();
		}
		if(typeof(oTableProject)!= "undefined"){
			oTableProject.DataTable().column( 2 ).search( tags , true , true ).draw();
		}
	}

	function closeDropdown(str, location){
		if(location == 2){
			$("#dropdownTags").css({"display" : "none" });
		}else{
			$("#dropdownCp").css({"display" : "none" });
		}
		
	}

	function popinInfo (title,message) {
		title = (title != "") ? title : "Popin info";
	    message = (message != "") ? message : "This feature isn't available yet";
		bootbox.dialog({
	            title: "<b class='text-bold text-red'>"+title+"</b>",
	            message: message,
	        }
	    );

	}

	function openViewer () { 
		var pathtab = window.location.href.split("#");
		console.log("openViewer",pathtab[0]);
		var idToSend = "<?php if(isset($_GET['id'])) echo $_GET['id']; else if(isset(Yii::app()->session["userId"])) echo Yii::app()->session["userId"];?>"
		if(typeof idToSend != 'undefined' && idToSend!='')
			openSubView('Network Viewer', '/communecter/graph/viewer/id/'+idToSend+'/type/<?php echo Yii::app()->controller->id ?>', null,null,function(){clearViewer();})
		else
			popinInfo("Network Graph Feature Unavailable", "This context hasn't been prepared to be viewed as a graph.");
	}
	
	var activeFilters = [];
	function bindTagEvents () { 
		$(".btn-my-tag, .btn-context-tag").off().on("click",function(){
			if(!$(this).hasClass("active"))
				$(this).addClass("active");
			else 
				$(this).removeClass("active");

			if(applyTagFilter && $.isFunction(applyTagFilter) ){
				count = applyTagFilter();
				$('.slidingbarTitle2Count').html('( '+count+' items found )');
			}
		});
		$(".btn-my-scope,.btn-context-scope").off().on("click",function(){
			if(!$(this).hasClass("active"))
				$(this).addClass("active");
			else 
				$(this).removeClass("active");

			if(applyScopeFilter && $.isFunction(applyScopeFilter) ){
				count = applyScopeFilter();
				$('.slidingbarTitleScopeCount').html('( '+count+' items found )');
			}
		});
		
		// ---------- SCOPES ------------
		$('.addScopeBtn, .addTagBtn').off().on("click",function(e){
			toastr.info('TODO : show add Scope Form!');
		});
	}

	var openSlideBarType = null;
	function  buildTagSlideBar (json) 
	{ 
		openSlideBarType = "tags"; 
		btnHTML = " <a href='#' class='addTagBtn btn btn-light-orange btn-xs'><i class='fa fa-plus'></i></a> ";
		$(".slidingbarTitle").html('<i class="fa fa-tags text-azure"></i> All your tags '+btnHTML);

		//Gather and activate personnal tags
		if ( debug || ( window.localStorage && typeof localStorage!='undefined' && !localStorage.myTags ) ) 
		{
			if(json.result && json.tags.length )
			{
				localStorage.myTagsCount = json.tags.length;
				var strHTML = buildTagListHTML (json.tags, json.activeTags, "btn-my-tag" );
				localStorage.myTags = strHTML;

				$(".slidingbarList").html( localStorage.myTags );
				$(".tags-count").html(localStorage.myTagsCount);
			} else {
				$(".slidingbarList").html("you don't have any tags, simply add some <a href='#'  class='addTagBtn btn btn-orange btn-xs'><i class='fa fa-plus'></i></a> ");
			}
		} else {
			console.log("localStorage.myTags exists ");
			$(".slidingbarList").html(localStorage.myTags);
			$(".tags-count").html(localStorage.myTagsCount);
		}

		//ADD context Tags
		if( contextMap.tags && contextMap.tags.length )
		{
			$(".slidingbarList").append( '<div class="space1"><li><h1 class="h1 slidingbarTitle2"><i class="fa fa-tags text-azure"></i> Context tags <span class="slidingbarTitle2Count"></span></h1></li><div class="space1">' );
			strHTML = buildTagListHTML ( contextMap.tags, null,"btn-context-tag");
			$(".slidingbarList").append( strHTML );
		}

		bindTagEvents ();
	}

	function buildTagListHTML (tagsArray,activeTags,classBtn,type) 
	{ 
		var strHTML = "";
		var classBtn = (classBtn) ? classBtn : "" ;
		$.each( tagsArray , function( k , v ) { 
			var active = (activeTags && inArray(v, activeTags)) ? "active" : "";
			if(!type)
				type = k;
			var metas = (openSlideBarType == "scope" ) ? ' data-val="'+v+'" data-type="'+type+'" ' : ' data-id="'+v+'" ';
			var lbl = (openSlideBarType == "scope" ) ? type+":"+v : v;
			strHTML += '<li><span class="btn btn-xs btn-tag '+classBtn+' '+active+'" '+metas+'><a href="#" class="del fa fa-times"></a> <i class="fa fa-tag"></i> '+lbl+'</span></li>';
		});
		return strHTML;
	}

	function buildScopeSlideBar (json) {
		openSlideBarType = "scope"; 
		btnHTML = "<a href='#'  class='addTagBtn btn btn-xs btn-orange'><i class='fa fa-plus'></i></a> ";
		$(".slidingbarTitle").html('<i class="fa fa-circle-o text-azure"></i> Tous vos térritoires : Géographique, Administratif, Organisations '+btnHTML);
		if ( ( window.localStorage && typeof localStorage!='undefined' && !localStorage.myScope ) ) 
		{	
			console.log("rebuild localStorage.myScope");
			$(".slidingbarList").html("<i class='fa fa-circle-o-notch fa-spin fa-3x'></i>");
			console.dir( json );
			if(json.result && Object.keys(json.scopes).length  )
			{
				var strHTML = "";
				localStorage.myScopeCount = Object.keys(json.scopes).length;
				if( Object.keys(json.scopes).length )
				{
					var strHTML = buildTagListHTML ( json.scopes , json.activeScopes, "btn-my-scope" );
					localStorage.myScope = strHTML;
				}

				$(".slidingbarList").html( localStorage.myScope );
				$(".scopes-count").html(localStorage.myScopeCount);
			} else {
				$(".slidingbarList").html("you don't have any scopes, simply add some <a href='#' class='addScopeBtn btn btn-orange'> <i class='fa fa-plus '></i> </a> ");
			}
		}
		else{
			console.log("localStorage.myScope exists ");
			$(".slidingbarList").html(localStorage.myScope);
		}

		//ADD context Tags
		if( contextMap.scopes && ( contextMap.scopes.codeInsee.length ||contextMap.scopes.codePostal.length ||contextMap.scopes.region.length) )
		{
			strHTML = "";
			if(contextMap.scopes.codeInsee.length)
				strHTML += buildTagListHTML ( contextMap.scopes.codeInsee , null,"btn-context-scope","codeInsee");
			
			if(contextMap.scopes.codePostal.length)
				strHTML += buildTagListHTML ( contextMap.scopes.codePostal , null,"btn-context-scope","codePostal");
			
			if(contextMap.scopes.region.length)
				strHTML += buildTagListHTML ( contextMap.scopes.region , null,"btn-context-scope","region");
			
			if(strHTML != "")
				$(".slidingbarList").append( '<div class="space1"><li><h1 class="h1 slidingbarTitleScope"><i class="fa fa-circle-o text-azure"></i> Context Scopes <span class="slidingbarTitleScopeCount"></span></h1></li><div class="space1">' );
			$(".slidingbarList").append( strHTML );
		}
		bindTagEvents ();
	}
	function openSlideBar(type)
	{
		console.log("openSlideBar",type);
		$(".slidingbar").slideDown();
		if ( debug || ( window.localStorage && typeof localStorage!='undefined' && !localStorage.myData ) ) 
		{	
			$(".slidingbarList").html("<i class='fa fa-circle-o-notch fa-spin fa-3x'></i>");
			$.ajax({
				url : baseUrl+"/" + moduleId +'/person/data',
				dataType : 'json',
				success : function(json) 
				{
					if( type == "tags")
						buildTagSlideBar (json);
					else if( type == "scope")
						buildScopeSlideBar (json);
				}
			});
		}
		else{
			if( type == "tags")
				buildTagSlideBar (json);
			else if( type == "scope")
				buildScopeSlideBar (json);
		}
	}

	function closeSlideBar() {  
		console.log("closeSlideBar",openSlideBarType);
		$(".topBtn").removeClass("open active");
		openSlideBarType = null;
	}

</script>	
