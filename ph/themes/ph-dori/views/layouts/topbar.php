<!-- start: TOP NAVIGATION MENU -->
<style>
	#dropdown_search{
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
	.searchList:hover{
		background-color: #ccc;
	}
	ol{ padding-left:0; list-style-position:inside; }
</style>

<header class="top-navbar collapse_list">

	<div class="navbar-logo collapse_wrap">

		<h1 class="trigger collapse_trigger hide_on_active">
			<i class="fa fa-logo"></i>
			<span class="fulltitle">full page title</span>
			<span class="notifications-count badge badge-danger animated bounceIn">97</span>
		</h1>

		<div class="inner collapse_box">

			<span class="trigger collapse_trigger">
				<i class="fa fa-logo"></i>
			</span>

			<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person")?>" class="userlink">
				<i class="fa fa-user_circled"></i>
				<span class="username"><?php echo (isset(Yii::app()->session["user"]["name"])) ? Yii::app()->session["user"]["name"] : Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?></span>
			</a>

			<a href="#">
				<i class="fa fa-comment"></i>
				<span class="notifications-count badge badge-danger animated bounceIn">97</span>
			</a>

			<a href="#" class="sb_toggle">
				<i class="fa fa-cog"></i>
			</a>
		</div>
	</div>
		
	<ul class="navbar-menu">

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger hide_on_active">
				<i class="fa fa-tags"></i>
				<span class="notifications-count badge badge-warning animated bounceIn">3</span>
			</div>

			<div class="inner collapse_box">
				<span class="trigger collapse_trigger">
					<i class="fa fa-tags"></i>
				</span>
				<form class="inner collapse_box">
					<input id="filterField" name="filterField" placeholder="Pseudo, saisissez ou modifiez ici vos tags !" >
						<ul class="dropdown-menu" id="dropdownTags" style="">
							<ol class="li-dropdown-scope">-</ol>
						</ul>
					</input>
				</form> 
				<!--<a href="#" class="sb_custom_toggle" data-target="#tags_slidingbar">
					Pseudo, saisissez ou modifiez ici vos tags !
				</a>-->
			</div>

		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger hide_on_active">
				<i class="slider-sm-ico"></i>
			</div>

			<div class="inner collapse_box">
				
				<!--<div class="slider slider-sm slider-green">
					<input type="text" class="slider-element form-control" value="" data-slider-max="70" data-slider-step="1" data-slider-value="30" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="hide">
				</div>

				<label class="slider_label">Zoom géographique</label>-->
				<span class="trigger collapse_trigger">
					<i class="slider-sm-ico"></i>
				</span>
				<form class="inner collapse_box">
					<input id="filterCpField" name="filterCpField" placeholder="Zoom géographique" >
						<ul class="dropdown-menu" id="dropdownCp" style="">
							<ol class="li-dropdown-scope">-</ol>
						</ul>
					</input>
				</form>

			</div>

		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger">
				<a href="javascript:;" onclick="openSubView('Your Network', '/communecter/sig/network', null)">
					<i class="fa fa-map-marker"></i>
				</a>
			</div>

			<form class="inner collapse_box" onSubmit="return(false);">
				<input class="wide" id="sigNetwork" name="sigNetwork" type="text" placeholder="Pseudo, passez votre interface en mode cartographie">
			</form>

		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger" id="searchForm">
				<i class="fa fa-search"></i>
			</div>

			<form class="inner collapse_box">
				<input class='hide' id="searchId" name="searchId"/>
				<input class='hide' id="searchType" name="searchType"/>
				<input id="searchBar" name="searchBar" type="text" placeholder="Que recherchez-vous ?">
					<ul class="dropdown-menu" id="dropdown_search" style="">
						<ol class="li-dropdown-scope">-</ol>
					</ul>
				</input>
			</form>

		</li>

		<li class="collapse_wrap">
			<a href="#" class="sb-toggle-right trigger">
				<i class="fa fa-globe toggle-icon"></i>
			</a>
		</li>

	</ul>

<script type="text/javascript">

	var timeout;
	jQuery(document).ready(function() {

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
		    	$("#dropdown_search").css("display", "none");
		    }		
		});

		$("#searchForm").on("click", function(){
			$("dropdown_search").css("display", "none");
		});

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
					window.location.href=baseUrl+"/" + moduleId + "/"+type+"/public/id/"+id;
				}
				
			}
		})
	});

	var mapIcon = {"citoyen":"fa-smile-o", "event":"fa-calendar", "NGO":" fa-building-o", "LocalBusiness":"fa-group", "GovernmentOrganization":"fa-institution", "Group":"fa-group"};
	function setSearchInput(id, name, type){
		if(type=="citoyen"){
			type = "person";
		}
		window.location.href=baseUrl+"/" + moduleId + "/"+type+"/public/id/"+id;
		/*
		$("#searchBar").val(name);
		$("#searchId").val(id);
		$("#searchType").val(type);
		$("#dropdown_search").css({"display" : "none" });*/	
	}

	function autoCompleteSearch(name){
		var data = {"name" : name};
		$.ajax({
			type: "POST",
	        url: baseUrl+"/" + moduleId + "/search/getmemberautocomplete",
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
			 					str += "<div class='searchList li-dropdown-scope' ><ol><a href='javascript:setSearchInput(\""+ o._id["$id"] +"\", \""+o.name+"\", \""+i+"\")'><span><i class='fa "+mapIcon[typeIco]+"'></i></span>  " + o.name + "</a></ol></div>";
			 				})
		 				}	
		  			}); 
		  			if(str == "") str = "<ol class='li-dropdown-scope'>Aucun résultat</ol>";
		  			$("#dropdown_search").html(str);
		  			$("#dropdown_search").css({"display" : "inline" });
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


</script>	
</header>

<!-- end: TOP NAVIGATION MENU -->