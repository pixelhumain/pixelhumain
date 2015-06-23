<!-- start: TOP NAVIGATION MENU -->
<style>
	#dropdown_searchTop{
		padding: 0px 15px; 
		margin-left:19%; 
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
	ol{ padding-left:0; list-style-position:inside; }
</style>

<header class="top-navbar collapse_list">

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

			<div class="inner collapse_box">
				
				<!--<div class="slider slider-sm slider-green">
					<input type="text" class="slider-element form-control" value="" data-slider-max="70" data-slider-step="1" data-slider-value="30" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="hide">
				</div>

				<label class="slider_label">Zoom géographique</label>-->
				<span class="trigger collapse_trigger">
					<i class="slider-sm-ico"></i>
				</span>
				<!--
				<form class="inner collapse_box">
					<input id="filterCpField" name="filterCpField" placeholder="Zoom géographique" >
						<ul class="dropdown-menu" id="dropdownCp" style="">
							<ol class="li-dropdown-scope">-</ol>
						</ul>
					</input>
				</form>
				-->
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
	<a href="<?php echo Yii::app()->createUrl("/".$this->moduleId."/person/")?>"><img  style="float:right;margin:13px; height:35px;" src="<?php echo ($this->module) ? $this->module->assetsUrl."/images/logoSMclean.png" : Yii::app()->baseUrl."/images/logo/byPH.png" ?>"/></a> 
</header>
<!-- end: TOP NAVIGATION MENU -->

<script type="text/javascript">

	var timeout;
	var mapIconTop = {"citoyen":"fa-smile-o", "event":"fa-calendar", "NGO":" fa-building-o", "LocalBusiness":"fa-group", "GovernmentOrganization":"fa-institution", "Group":"fa-group"};
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
		if(typeof contextMap != 'undefined')
			openSubView('Network Viewer', '/communecter/graph/viewer/id/'+contextMap["_id"]["$id"]+'/type/<?php echo Yii::app()->controller->id ?>', null,null,function(){clearViewer();})
		else
			popinInfo("Network Graph Feature Unavailable", "This context hasn't been prepared to be viewed as a graph.");
	}
	
	function bindTagEvents () { 
		$(".btn-tag").off().on("click",function(){
			if(!$(this).hasClass("active")){
				toastr.error("TODO : add to active tags : "+$(this).data("id"));
				$(this).addClass("active");
			} else {
				toastr.error("TODO : add to active tags : "+$(this).data("id"));
				$(this).removeClass("active");
			}
		});
		// ---------- SCOPES ------------
		$('.addScopeBtn, .addTagBtn').off().on("click",function(e){
			toastr.info('TODO : show add Scope Form!');
		});
	}

	var openSlideBarType = null;
	function  buildTagSlideBar (json) { 
		openSlideBarType = "tags"; 
		if ( debug || ( window.localStorage && typeof localStorage!='undefined' && !localStorage.myTags ) ) 
		{
			if(json.result && json.tags.length )
			{
				strHTML = "";
				localStorage.myTagsCount = json.tags.length;

				$.each(json.tags, function(i,v) { 
					active = (json.activeTags && inArray(v, json.activeTags)) ? "active" : "";
					strHTML += '<li><span class="btn btn-md btn-tag '+active+'" data-id="'+v+'">'+
									'<a href="#" class="del fa fa-times"></a> <i class="fa fa-tag"></i>'+
									v+
								'</span></li>';
				});
				strHTML += "<a href='#'  class='addTagBtn btn btn-light-orange'><i class='fa fa-plus'></i></a> ";
				localStorage.myTags = strHTML;

				$(".slidingbarList").html( localStorage.myTags );
				$(".tags-count").html(localStorage.myTagsCount);
				bindTagEvents ();
			} else {
				$(".slidingbarList").html("you don't have any tags, simply add some <a href='#'  class='addTagBtn btn btn-orange btn-xs'><i class='fa fa-plus'></i></a> ");
			}
		} else{
			console.log("localStorage.myTags exists ");
			$(".slidingbarList").html(localStorage.myTags);
			$(".tags-count").html(localStorage.myTagsCount);
			bindTagEvents ();
		}

	}
	function buildScopeSlideBar (json) {
		openSlideBarType = "scope"; 
		$(".slidingbarTitle").html('<i class="fa fa-circle-o text-azure"></i> Tous vos térritoires : Géographique, Administratif, Organisations');
		if ( ( window.localStorage && typeof localStorage!='undefined' && !localStorage.myScope ) ) 
		{	
			console.log("rebuild localStorage.myScope");
			$(".slidingbarList").html("<i class='fa fa-circle-o-notch fa-spin fa-3x'></i>");
			console.dir( json );
			if(json.result && Object.keys(json.scopes).length  )
			{
				strHTML = "";
				localStorage.myScopeCount = Object.keys(json.scopes).length;
				if( Object.keys(json.scopes).length )
				{
					$.each(json.scopes, function(k,v) 
					{ 
						console.log( k, v );
						active = (json.activeScopes && inArray(v, json.activeScopes)) ? "active" : "";
						strHTML +=  '<li><span class="btn btn-md btn-tag '+active+'" data-val="'+v+'" data-type="'+k+'">'+
										'<a href="#" class="del fa fa-times"></a> <i class="fa fa-tag"></i>'+
										k+" : "+v+
									'</span></li>';
					});
					strHTML += "<a href='#'  class='addTagBtn btn btn-orange'><i class='fa fa-plus'></i></a> ";
					localStorage.myScope = strHTML;
				}

				$(".slidingbarList").html( localStorage.myScope );
				$(".scopes-count").html(localStorage.myScopeCount);
				bindTagEvents ();
			} else {
				$(".slidingbarList").html("you don't have any scopes, simply add some <a href='#' class='addScopeBtn btn btn-orange'> <i class='fa fa-plus '></i> </a> ");
			}
		}
		else{
			console.log("localStorage.myScope exists ");
			$(".slidingbarList").html(localStorage.myScope);
			bindTagEvents ();
		}
	}
	function openSlideBar(type)
	{
		console.log("openSlideBar",type);
		$(".slidingbar").slideDown();
		$(".slidingbarTitle").html('<i class="fa fa-tags text-azure"></i> Tous vos tags');
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
	function toggleTag(val)
	{ 
		toastr.success('success!'+val);
	}
</script>	
