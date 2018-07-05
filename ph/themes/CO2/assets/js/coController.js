function  bindLBHLinks() { 
	$(".lbh").unbind("click").on("click",function(e) {  	
		e.preventDefault();
		$("#openModal").modal("hide");
		mylog.warn("***************************************");
		mylog.warn("bindLBHLinks",$(this).attr("href"));
		mylog.warn("***************************************");
		var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href");
	    urlCtrl.loadByHash( h );
	});
	$(".lbh-menu-app").unbind("click").on("click",function(e){
		e.preventDefault();
		resetSearchObject();
		historyReplace=true;
		urlCtrl.loadByHash($(this).data("hash"));
	})
	//open any url in a modal window
	$(".lbhp").unbind("click").on("click",function(e) {
		e.preventDefault();
		$("#openModal").modal("hide");
		mylog.warn("***************************************");
		mylog.warn("bindLBHLinks Preview", $(this).attr("href"),$(this).data("modalshow"));
		//alert("bindLBHLinks Preview"+$(this).data("modalshow"));
		mylog.warn("***************************************");
		var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href");
		if( $(this).data("modalshow") ){
			url = (h.indexOf("#") == 0 ) ? urlCtrl.convertToPath(h) : h;
			if(h.indexOf("#page") >= 0)
				url="app/"+url
	    	smallMenu.openAjaxHTML( baseUrl+'/'+moduleId+"/"+url);
			//smallMenu.open ( getAjax(directory.preview( mapElements[ $(this).data("modalshow") ],h ) );
			
		}
		else {
			url = (h.indexOf("#") == 0 ) ? urlCtrl.convertToPath(h) : h;
	    	smallMenu.openAjaxHTML( baseUrl+'/'+moduleId+"/"+url);
	    	//smallMenu.openAjaxHTML( baseUrl+'/'+moduleId+"/"+url ,"","blockUI",h);
		}
	});


	//open any url in a preview window
	$(".lbh-preview-element").unbind("click").on("click",function(e) {
		e.preventDefault();
		$("#openModal").modal("hide");
		mylog.warn("***************************************");
		mylog.warn("bindLBHLinks Preview ELEMENT", $(this).attr("href"),$(this).data("modalshow"));
		mylog.warn("***************************************");
		var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href");
		var url = (h.indexOf("#") == 0 ) ? "app/"+ urlCtrl.convertToPath(h) : "app/"+ h;
		openPreviewElement( baseUrl+'/'+moduleId+"/"+url);
			//smallMenu.open ( getAjax(directory.preview( mapElements[ $(this).data("modalshow") ],h ) );
	});
}


var urlCtrl = {
	afterLoad : null,
	loadableUrls : {
		"#modal." : {title:'OPEN in Modal'},
		"#event.calendarview" : {title:"EVENT CALENDAR ", icon : "calendar"},
		"#city.opendata" : {title:'STATISTICS ', icon : 'line-chart' },
	    "#person.telegram" : {title:'CONTACT PERSON VIA TELEGRAM ', icon : 'send' },
	    "#event.detail" : {aliasParam: "#page.type.events.id.$id", params: ["id"],title:'EVENT DETAIL ', icon : 'calendar' },
	    "#poi.detail" : {aliasParam: "#page.type.poi.id.$id", params: ["id"],title:'POI DETAIL ', icon : 'calendar' },
	    "#organization.detail" : {aliasParam: "#page.type.organizations.id.$id", params: ["id"],title:'ORGANIZATION DETAIL ', icon : 'users' },
	    "#project.detail" : {aliasParam: "#page.type.projects.id.$id", params: ["id"], title:'PROJECT DETAIL ', icon : 'lightbulb-o' },
	    "#project.addchartsv" : {title:'EDIT CHART ', icon : 'puzzle-piece' },
	    "#event.directory" : {aliasParam: "#page.type.events.id.$id.view.directory.dir.attendees", params: ["id"],title:'EVENT DETAIL ', icon : 'calendar' },
	    "#organization.directory" : {aliasParam: "#page.type.organizations.id.$id.view.directory.dir.members", params: ["id"],title:'ORGANIZATION DETAIL ', icon : 'users' },
	    "#project.directory" : {aliasParam: "#page.type.projects.id.$id.view.directory.dir.contributors", params: ["id"], title:'PROJECT DETAIL ', icon : 'lightbulb-o' },
	    "#news.detail" : {aliasParam: "#page.type.news.id.$id", params: ["id"], title:'NEWS', icon : 'rss' },
	    "#news.index" : {aliasParam: "#page.type.$type.id.$id", params: ["type","id"], title:'NEWS', icon : 'rss' },
	    "#project.addchartsv" : {title:'EDIT CHART ', icon : 'puzzle-piece' },
	    "#chart.addchartsv" : {title:'EDIT CHART ', icon : 'puzzle-piece' },
	    "#gantt.addtimesheetsv" : {title:'EDIT TIMELINE ', icon : 'tasks' },
	    "#graph.viewer" : {title:'GRAPE VIEW', icon : 'share-alt', useHeader: true },
	    //"#news.detail" : {title:'NEWS DETAIL ', icon : 'rss' },
	    //"#news.index.type" : {title:'NEWS INDEX ', icon : 'rss', menuId:"menu-btn-news-network","urlExtraParam":"isFirst=1" },
	    "#need.detail" : {title:'NEED DETAIL ', icon : 'cubes' },
	    "#need.addneedsv" : {title:'NEED DETAIL ', icon : 'cubes' },
	    "#city.creategraph" : {title:'CITY ', icon : 'university', menuId:"btn-geoloc-auto-menu" },
	    "#city.graphcity" : {title:'CITY ', icon : 'university', menuId:"btn-geoloc-auto-menu" },
	    "#city.statisticPopulation" : {title:'CITY ', icon : 'university' },
	    "#rooms.index.type.cities" : {title:'ACTION ROOMS ', icon : 'cubes', menuId:"btn-citizen-council-commun"},
	    "#rooms.editroom" : {title:'ADD A ROOM ', icon : 'plus', action:function(){ editRoomSV ();	}},
		"#element.aroundme" : {title:"Around me" , icon : 'crosshairs', menuId:"menu-btn-around-me"},
	    "#element.notifications" : {title:'DETAIL ENTITY', icon : 'legal'},
	    "#person.invite" : {title:'DETAIL ENTITY', icon : 'legal'},
		"#element" : {title:'DETAIL ENTITY', icon : 'legal'},
	    "#gallery" : {title:'ACTION ROOMS ', icon : 'photo'},
	    "#comment." : {title:'DISCUSSION ROOMS ', icon : 'comments'},
	    //"#admin" : {title:'CHECKGEOCODAGE ', icon : 'download', useHeader: true},
	    //"#admin.checkgeocodage" : {title:'CHECKGEOCODAGE ', icon : 'download', useHeader: true},
	    //"#admin.openagenda" : {title:'OPENAGENDA ', icon : 'download', useHeader: true},
	    //"#admin.adddata" : {title:'ADDDATA ', icon : 'download', useHeader: true},
	    //"#admin.importdata" : {title:'IMPORT DATA ', icon : 'download', useHeader: true},
	    //"#admin.index" : {title:'IMPORT DATA ', icon : 'download', useHeader: true},
	    //"#admin.cities" : {title:'CITIES ', icon : 'university', useHeader: true},
	    //"#admin.sourceadmin" : {title:'SOURCE ADMIN', icon : 'download', useHeader: true},
	    //"#admin.checkcities" : {title:'SOURCE ADMIN', icon : 'download', useHeader: true},
	    //"#admin.directory" : {title:'IMPORT DATA ', icon : 'download', useHeader: true},
	    //"#admin.mailerrordashboard" : {title:'MAIL ERROR ', icon : 'download', useHeader: true},
	    //"#admin.moderate" : {title:'MODERATE ', icon : 'download', useHeader: true},
	    //"#admin.createfile" : {title:'IMPORT DATA', icon : 'download', useHeader: true},
		//"#log.monitoring" : {title:'LOG MONITORING ', icon : 'plus', useHeader: true},
	    //"#adminpublic.view.index" : {title:'SOURCE ADMIN', icon : 'download', useHeader: true},
	    //"#adminpublic.view.createfile" : {title:'IMPORT DATA', icon : 'download', useHeader : true},
	    //"#adminpublic.view.adddata" : {title:'ADDDATA ', icon : 'download', useHeader : true},
	   	//"#adminpublic.view.interopproposed" : {title : 'INTEROP PROPOSED', icon : 'download', useHeader : true},
	   // "#person.settings" : {title:'COMMUNECTED DIRECTORY', icon : 'connectdevelop', menuId:"menu-btn-directory"},
	    "#admin.cleantags" : {title : 'CLEAN TAGS', icon : 'download'},
	    "#default.directory" : {title:'COMMUNECTED DIRECTORY', icon : 'connectdevelop', menuId:"menu-btn-directory"},
	    "#default.news" : {title:'COMMUNECTED NEWS ', icon : 'rss', menuId:"menu-btn-news" },
	    "#default.agenda" : {title:'COMMUNECTED AGENDA ', icon : 'calendar', menuId:"menu-btn-agenda"},
		"#default.home" : {title:'COMMUNECTED HOME ', icon : 'home',"menu":"homeShortcuts"},
		"#default.apropos" : {title:'COMMUNECTED HOME ', icon : 'star',"menu":"homeShortcuts"},
		"#default.twostepregister" : {title:'TWO STEP REGISTER', icon : 'home', "menu":"homeShortcuts"},
		"#default.view.page" : {title:'Découvrir', icon : 'file-o'},
		"#home" : {"alias":"#default.home"},
	    "#stat.chartglobal" : {title:'STATISTICS ', icon : 'bar-chart'},
	    "#stat.chartlogs" : {title:'STATISTICS ', icon : 'bar-chart'},
	    "#default.live" : {title:"FLUX'Direct" , icon : 'heartbeat', menuId:"menu-btn-live"},
		"#default.login" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
		"#showTagOnMap.tag" : {title:'TAG MAP ', icon : 'map-marker', action:function( hash ){ showTagOnMap(hash.split('.')[2])	} },
		"#define." : {title:'TAG MAP ', icon : 'map-marker', action:function( hash ){ showDefinition("explain"+hash.split('.')[1])	} },
		"#data.index" : {title:'OPEN DATA FOR ALL', icon : 'fa-folder-open-o'},
		"#opendata" : {"alias":"#data.index"},
		"#interoperability.copedia" : {title:'COPEDIA', icon : 'fa-folder-open-o',useHeader : true},
		"#interoperability.co-osm" : {title:'COSM', icon : 'fa-folder-open-o',useHeader : true},
		"#chatAction" : {title:'CHAT', icon : 'comments', action:function(){ rcObj.loadChat("","citoyens", true, true) }, removeAfterLoad : true },
	},
	shortVal : ["p","poi","s","o","e","pr","c","cl"/* "s","v","a", "r",*/],
	shortKey : [ "citoyens","poi" ,"siteurl","organizations","events","projects" ,"cities" ,"classifieds"/*"entry","vote" ,"action" ,"rooms" */],
	map : function (hash) {
		if(typeof hash == "undefined") return { hash : "#",
												type : "",
												id : ""
											};
		hashT = hash.split('.');
		return {
			hash : hash,
			type : hashT[2],
			id : hashT[4]
		};
	},
	convertToPath : function(hash) { 
		return hash.substring(1).replace( "#","" ).replace( /\./g,"/" );
	},
	//manages url short cuts like eve_xxxxx
	//warning : works with only 1 underscore 
	//can contain more variables eve_xxxxx.viewer.dsdsd
	checkAndConvert : function (hash) {
		hashT = hash.split('_');
		mylog.log("-------checkAndConvert : ",hash,hashT);
		pos = $.inArray( hashT[0].substring(1) , urlCtrl.shortVal );
		if( pos >= 0 ){
			type = urlCtrl.shortKey[pos];
			hash =  "#page.type."+type+".id."+hashT[1];
			mylog.log("converted hash : ",hash);
		} 
		return hash;
	},
	jsController : function (hash){
		mylog.log("jsController", hash);
		hash = urlCtrl.checkAndConvert(hash);
		//alert("jsController"+hash);
		mylog.log("jsController",hash);
		res = false;
		$(".menuShortcuts").addClass("hide");
		//mylog.log("urlCtrl.loadableUrls", urlCtrl.loadableUrls);
		$.each( urlCtrl.loadableUrls, function(urlIndex,urlObj)
		{
			//mylog.log("replaceAndShow2",urlIndex);
			if( hash.indexOf(urlIndex) >= 0 )
			{
				if(urlObj.goto){
					window.location.href = urlObj.goto;
					return false;
				}
				checkMenu(urlObj, hash);
			
				endPoint = urlCtrl.loadableUrls[urlIndex];
				mylog.log("jsController 2",endPoint,"login",endPoint.login,endPoint.hash );
				if( typeof endPoint.login == undefined || !endPoint.login || ( endPoint.login && userId ) )
				{
					//alises are renaming of urls example default.home could be #home
					if( endPoint.alias ){
						endPoint = urlCtrl.jsController(endPoint.alias);
						return false;
					} 
					if( endPoint.aliasParam ){
						hashT=hash.split(".");
						alias=endPoint.aliasParam;
						$.each(endPoint.params, function(i, v){
							$.each(hashT, function(ui, e){
								if (v == e){
									paramId=hashT[ui+1];
									alias = alias.replace("$"+v, paramId);
								}
							});
						});
						endPoint = urlCtrl.jsController(alias);	
						return false;
					} 
					// an action can be connected to a url, and executed
					if( endPoint.action && typeof endPoint.action == "function"){
						endPoint.action(hash);
					} else {
						//classic url management : converts urls by replacing dots to slashes and ajax retreiving and showing the content 
						extraParams = (endPoint.urlExtraParam) ? "?"+endPoint.urlExtraParam : "";
						urlExtra = (endPoint.urlExtra) ? endPoint.urlExtra : "";
						//execute actions before teh ajax request
						res = false;
						if( endPoint.preaction && typeof endPoint.preaction == "function")
							res = endPoint.preaction(hash);
						//hash can be iliased
						if (endPoint.hash) 
							hash = hash.replace(urlIndex, endPoint.hash);
						if(hash.indexOf("?") >= 0){
							hashT=hash.split("?");
							mylog.log(hashT);
							hash=hashT[0];
							extraParams = "?"+hashT[1];
						}
						if(extraParams.indexOf("#") >= 0){
							extraParams=extraParams.replace( "#","%hash%" );
						}
						path = urlCtrl.convertToPath(hash);
						pathT = path.split('/');
						//open path in a modal (#openModal)
						if(pathT[0] == "modal"){
							path = path.substring(5);
							alert(baseUrl+'/'+moduleId+path);
							smallMenu.openAjaxHTML(baseUrl+'/'+moduleId+path);
						} else {
							//console.log(">>>>>>>>>>>>>>>>>>> endPoint:",endPoint);
							mod = moduleId+ '/';
							if(moduleId != activeModuleId || endPoint.module){
								mod = '';
								//go get the path , module is given in the hash
								//console.log(">>>>>>>>>>>>>>>>>>> module path",path);
							}

							showAjaxPanel( baseUrl+'/'+ mod +path+urlExtra+extraParams, endPoint.title,endPoint.icon, res,endPoint );
						}
						
						if(endPoint.menu)
							$("."+endPoint.menu).removeClass("hide");

						if(endPoint.removeAfterLoad){
							//alert("removeAfterLoad 1");
							history.pushState('', document.title, window.location.pathname);
						}
					} 
					res = true;
					return false;
				} else {
					mylog.warn("PRIVATE SECTION LOGIN FIRST",hash);
					Login.openLogin();
					resetUnlogguedTopBar();
					res = true;
				}
			} /*else 
				alert("hash not found");*/
		});
		return res;
	},

	//back sert juste a differencier un load avec le back btn
	//ne sert plus, juste a savoir d'ou vient drait l'appel
	loadByHash : function ( hash , back ) {
		// mylog.log("IS DIRECTORY ? ", 
		// 			hash.indexOf("#default.directory"), 
		// 			location.hash.indexOf("#default.directory"), CoAllReadyLoad);
		onchangeClick=false;
		navInSlug=false;
		mylog.log("loadByHash", hash, back );
		if(typeof globalTheme != "undefined" && globalTheme=="network"){
			mylog.log("globalTheme", globalTheme);
			if( /*hash.indexOf("#network") < 0 &&
				location.hash.indexOf("#network") >= 0 &&*/ hash!="#" && hash!=""){ 
				mylog.log("network");
			//}
			//else{
				mylog.log("network2");
				count=$(".breadcrumAnchor").length;
				//case on reload view
				if(count==0)
					count=1;
				breadcrumGuide(count, hash);
			}
			
			return ;
		}

		if( hash.indexOf("#default.directory") >= 0 &&
			location.hash.indexOf("#default.directory") >= 0 && CoAllReadyLoad==true){ 
			var n = hash.indexOf("type=")+5;
			var type = hash.substr(n);
			mylog.log("CHANGE directory", type);
			searchType = [type];
			setHeaderDirectory(type);
			loadingData = false;
			startSearch(0, indexStepInit, ( notNull(searchCallback) ) ? searchCallback : null );
			mylog.log("testnetwork hash 2", hash);
			location.hash = hash;
			return;
		}
		currentUrl = hash;
		allReadyLoad = true;
		CoAllReadyLoad = true;
		if( typeof urlCtrl.loadableUrls[hash] == "undefined" || 
			typeof urlCtrl.loadableUrls[hash].emptyContextData == "undefined" || 
			urlCtrl.loadableUrls[hash].emptyContextData == true )
			contextData = null;

		$(".my-main-container").off()
							   .bind("scroll", function () {shadowOnHeader()})
							   .scrollTop(0);

		$(".searchIcon").removeClass("fa-file-text-o").addClass("fa-search");
		searchPage = false;
		
		//alert("urlCtrl.loadByHash"+hash);

	    mylog.warn("urlCtrl.loadByHash",hash,back);
	    if( urlCtrl.jsController(hash) ){
	    	mylog.log("urlCtrl.loadByHash >>> hash found",hash);
	    }
	    else if( hash.indexOf("#panel") >= 0 ){

	    	panelName = hash.substr(7);
	    	mylog.log("panelName",panelName);
	    	if( (panelName == "box-login" || panelName == "box-register") && userId != "" && userId != null ){
	    		urlCtrl.loadByHash("#default.home");
	    		return false;
	    	} else if(panelName == "box-add")
	            title = 'ADD SOMETHING TO MY NETWORK';
	        else
	            title = "WELCOM MUNECT HEY !!!";
	        if(panelName == "box-login"){
				Login.openLogin();
				$.unblockUI();
	        }
			else if(panelName == "box-register"){
				$('#modalRegister').modal("show");
				$.unblockUI();
			}
			else
	       		showPanel(panelName,null,title);
	       	
	    }  else if( hash.indexOf("#gallery.index.id") >= 0 ){
	        hashT = hash.split(".");
	        showAjaxPanel( baseUrl+'/'+ moduleId + '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'ACTIONS in this '+typesLabels[hashT[3]],'rss' );
	    }

	    else if( hash.indexOf("#city.directory") >= 0 ){
	        hashT = hash.split(".");
	        showAjaxPanel( baseUrl+'/'+ moduleId + '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );
	    } 

		else if(hash.length>2  || hash.indexOf("#@") >= 0){
			splitHref=(hash.indexOf("?") >= 0) ? hash.split("?") : [hash];
			if(splitHref[0] > 2 || splitHref[0].indexOf("#@") >= 0){
				hashT = (splitHref[0].indexOf("#@") >= 0) ? splitHref[0].replace( "#@","" ) : splitHref[0].replace( "#","" );
				hashT=hashT.split(".");
				if(typeof hashT == "string")
					slug=hashT;
				else
					slug=hashT[0];
				$.ajax({
		  			type: "POST",
		  			url: baseUrl+"/"+moduleId+"/slug/getinfo/key/"+slug,
		  			dataType: "json",
		  			success: function(data){
				  		if(data.result){
				  			viewPage="";			  			
				  			if(hashT.length > 1){
				  				hashT.shift();
				  				viewPage="/"+hashT.join("/");
				  			}

				  			var key = hashT[0];
				  			var get = "";
				  			//console.log("load key indexOf", key, key.indexOf("?"));
							if(key.indexOf("?")>-1){
								get = key.substr(key.indexOf("?"), key.length);
								key = key.substr(0, key.indexOf("?"), key.length);
								//console.log("load key", key);
							}
				  			//console.log("HASH:", key, get, CO2params["onepageKey"], ($.inArray(key, CO2params["onepageKey"])));
				  			if($.inArray(key, CO2params["onepageKey"])>-1) viewPage = "/view/"+key;
				  			showAjaxPanel(baseUrl+'/'+ moduleId + '/app/page/type/'+data.contextType+'/id/'+data.contextId+viewPage+get);
				  		}else
				  			showAjaxPanel( baseUrl+'/'+ moduleId + '/app/index', 'Home','home' );
		 			}
				});
			}else
				showAjaxPanel( baseUrl+'/'+ moduleId + '/app/index', 'Home','home' );
		}
	    else if ( moduleId != activeModuleId) {
	    	//alert( ctrlId +"/"+ actionId );
	    	showAjaxPanel( baseUrl+'/'+ activeModuleId + '/'+ctrlId +"/"+ actionId, 'Home','home' );
	    } 
	    else
	        showAjaxPanel( baseUrl+'/'+ moduleId + '/app/index', 'Home','home' );
	    mylog.log("END loadByHash hash:", hash);
	    location.hash = hash;

	    

	    /*if(typeof back == "function"){
	    	alert("back");
	    	back();
		}*/
	}
}

function showAjaxPanel (url,title,icon, mapEnd , urlObj) { 
	//alert("showAjaxPanel"+url);
	$(".progressTop").show().val(20);
	var dest = ( typeof urlObj == "undefined" || typeof urlObj.useHeader != "undefined" ) ? themeObj.mainContainer : ".pageContent" ;
	mylog.log("showAjaxPanel", url, urlObj,dest,urlCtrl.afterLoad );	
	//var dest = themeObj.mainContainer;
	hideScrollTop = false;
	//alert("showAjaxPanel"+dest);
	showNotif(false);
			
	$(".hover-info,.hover-info2").hide();
	showMap(false);

	$(".box").hide(200);
	//showPanel('box-ajax');
	icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
	$(".panelTitle").html(icon+title).fadeIn();
	mylog.log("GETAJAX",icon+title);
	//showTopMenu(true);
	userIdBefore = userId;
	setTimeout(function(){
		if( $(dest).length )
		{
			setTimeout(function(){ $('.progressTop').val(40)}, 1000);
			setTimeout(function(){ $('.progressTop').val(60)}, 3000);
			getAjax(dest, url, function(data){ 
				
				if( dest != themeObj.mainContainer )
					$(".subModuleTitle").html("");

				$(".modal-backdrop").hide();
				bindExplainLinks();
				bindTags();
				bindLBHLinks();
				$(".progressTop").val(90);
				setTimeout(function(){ $(".progressTop").val(100)}, 10);
				$(".progressTop").fadeOut(200);
				$.unblockUI();

				if(mapEnd)
					showMap(true);

				
					addBtnSwitch();
				

	    		if(typeof contextData != "undefined" && contextData != null && contextData.type && contextData.id ){
	        		uploadObj.set(contextData.type,contextData.id);
	        	}
	        	
	        	if( typeof urlCtrl.afterLoad == "function") {
	        		urlCtrl.afterLoad();
	        		urlCtrl.afterLoad = null;
	        	}

	        	if( custom && custom.logo )
	    			$(".logo-menutop").attr( {'src':custom.logo} ); 	


	        	/*if(debug){
	        		getAjax(null, baseUrl+'/'+moduleId+"/log/dbaccess", function(data){ 
	        			if(prevDbAccessCount == 0){
	        				dbAccessCount = parseInt(data);
	        				prevDbAccessCount = dbAccessCount;
	        			} else {
	        				dbAccessCount = parseInt(data)-prevDbAccessCount;
	        				prevDbAccessCount = parseInt(data);
	        			}
	        			//console.error('dbaccess:'+prevDbAccessCount);
	        			
	        			//$(".dbAccessBtn").remove();
	        			//$(".menu-info-profil").prepend('<span class="text-red dbAccessBtn" ><i class="fa fa-database text-red text-bold fa-2x"></i> '+dbAccessCount+' <a href="javascript:clearDbAccess();"><i class="fa fa-times text-red text-bold"></i></a></span>');
	        		},null);
	        	}*/
	        },"html");
		} else 
			console.error( 'showAjaxPanel', dest, "doesn't exist" );
	}, 100);
}


var smallMenu = {
	destination : ".menuSmallBlockUI",
	inBlockUI : true,
	//smallMenu.openAjax(\''+baseUrl+'/'+moduleId+'/collections/list/col/'+obj.label+'\',\''+obj.label+'\',\'fa-folder-open\',\'yellow\')
	//the url must return a list like userConnected.list
	openAjax : function  (url,title,icon,color,title1,params,callback) 
	{ 
		/*if( typeof directory == "undefined" )
		    lazyLoad( moduleUrl+'/js/default/directory.js', null, null );
	    */
	    //processingBlockUi();
	    //$(smallMenu.destination).html("<i class='fa fa-spin fa-refresh fa-4x'></i>");

		ajaxPost( null , url, params , function(data)
		{
			if(!title1 && notNull(title1) && data.context && data.context.name)
				title1 = data.context.name;
			var content = smallMenu.buildHeader( title,icon,color,title1 );
			smallMenu.open( content );
			if( data.count == 0 )
				$(".titleSmallMenu").html("<a class='text-white' href='javascript:smallMenu.open();'> <i class='fa fa-th'></i></a> "+	
						' <i class="fa fa-angle-right"></i> '+
						title+" vide <i class='fa "+icon+" text-"+color+"'></i>");
			else 
				directory.buildList(data.list);
			
		   	$('.searchSmallMenu').off().on("keyup",function() { 
				directory.search ( ".favSection", $(this).val() );
		   	});
		   	//else collection.buildCollectionList( "linkList" ,"#listCollections",function(){ $("#listCollections").html("<h4 class=''>Collections</h4>"); });

		   	if (typeof callback == "function") 
				callback(data);
	    } );
	},
	build : function  (params,build_func,callback) { 
		//processingBlockUi();
	   	if (typeof build_func == "function") 
			content = build_func(params);
		smallMenu.open( content );
		if (typeof callback == "function") 
			callback();
	},
	//ex : smallMenu.openSmall("Recherche","fa-search","green",function(){
	openSmall : function  (title,icon,color,callback,title1) { 
		if( typeof directory == "undefined" )
		    lazyLoad( moduleUrl+'/js/default/directory.js', null, null );
	    	
		var content = smallMenu.buildHeader(title,icon,color,title1);
		smallMenu.open( content );

		if (typeof callback == "function") 
			callback();
	},
	buildHeader : function (title,icon,color,title1) { 
		title1 = (typeof title1 != "undefined" && notNull(title1)) ? title1 : "<a class='text-white' href='javascript:smallMenu.open();'> <i class='fa fa-th'></i></a> ";
		content = 
				"<div class='col-xs-12 padding-5'>"+

					"<h3 class='titleSmallMenu'> "+
						title1+"<i class='fa "+icon+" text-"+color+"'></i> "+title+
					"</h3><hr>"+
					"<div class='col-md-12 bold sectionFilters'>"+
						"<a class='text-black bg-white btn btn-link favSectionBtn btn-default' "+
							"href='javascript:directory.toggleEmptyParentSection(\".favSection\",null,\".searchEntityContainer\",1)'>"+
							"<i class='fa fa-asterisk fa-2x'></i><br>Tout voir</a></span> </span>"+
					"</div>"+

					"<div class='col-md-12'><hr></div>"+

				"</div>"+

				"<div id='listDirectory' class='col-md-10 no-padding'></div>"+
				"<div class='hidden-xs col-sm-2 text-left'>"+
					"<input name='searchSmallMenu' style='border:1px solid red' class='form-control searchSmallMenu text-black' placeholder='rechercher' style=''><br/>"+
					"<h4 class=''><i class='fa fa-angle-down'></i> Filtres</h4>"+
					"<a class='btn btn-dark-blue btn-anc-color-blue btn-xs favElBtn favAllBtn text-left' href='javascript:directory.toggleEmptyParentSection(\".favSection\",null,\".searchEntityContainer\",1)'> <i class='fa fa-tags'></i> Tout voir </a><br/>"+

					"<div id='listTags'></div>"+
					"<div id='listScopes'><h4><i class='fa fa-angle-down'></i> Où</h4></div>"+
					"<div id='listCollections'></div>"+
				"</div> "+
				"<div class='col-xs-12 col-sm-10 center no-padding'>"+
					//"<a class='pull-right btn btn-xs btn-default' href='javascript:collection.newChild(\""+title+"\");'> <i class='fa fa-sitemap'></i></a> "+
					"<a class='pull-right btn btn-xs menuSmallTools hide text-red' href='javascript:collection.crud(\"del\",\""+title+"\");'> <i class='fa fa-times'></i></a> "+
					"<a class='pull-right btn btn-xs menuSmallTools hide'  href='javascript:collection.crud(\"update\",\""+title+"\");'> <i class='fa fa-pencil'></i></a> "+
					
					// "<h3 class='titleSmallMenu'> "+
					// 	title1+' <i class="fa fa-angle-right"></i> '+title+" <i class='fa "+icon+" text-"+color+"'></i>"+
					// "</h3>"+
					// "<input name='searchSmallMenu' class='searchSmallMenu text-black' placeholder='rechercher' style='margin-bottom:8px;width: 300px;font-size: x-large;'><br/>"+
					
				"</div>";
		return content;
	},
	ajaxHTML : function (url,title,type,nextPrev) { 
		var dest = (type == "blockUI") ? ".blockContent" : "#openModal .modal-content .container" ;
		getAjax( dest , url , function () { 
			
			//next and previous btn to nav from preview to preview
			if(nextPrev){
				var p = 0;
				var n = 0;
				var found = false;
				var l = $( '.searchEntityContainer .container-img-profil' ).length;
				$.each( $( '.searchEntityContainer .container-img-profil' ), function(i,val){
					if(found){
						n = (i == l-1 ) ? $( $('.searchEntityContainer .container-img-profil' )[0] ).attr('href') : $(this).attr('href');
						return false;
					}
					if( $(this).attr('href') == nextPrev )
						found = true;
					else 
						p = (i == 0 ) ? $( $('.searchEntityContainer .container-img-profil' )[ $('.searchEntityContainer .container-img-profil' ).length ] ).attr('href') : $(this).attr('href');
				});
				html = "<div style='margin-bottom:50px'><a href='"+p+"' class='lbhp text-dark'><i class='fa fa-2x fa-arrow-circle-left'></i> PREV </a> "+
						" <a href='"+n+"' class='lbhp text-dark'> NEXT <i class='fa fa-2x fa-arrow-circle-right'></i></a></div>";
				$(dest).prepend(html);
				
			}
			bindLBHLinks();
		 },"html" );
	},
	//openSmallMenuAjaxBuild("",baseUrl+"/"+moduleId+"/favorites/list/tpl/directory2","FAvoris")
	//opens any html without post processing
	openAjaxHTML : function  (url,title,type,nextPrev) { 
		smallMenu.open("",type );
		smallMenu.ajaxHTML(url,title,type,nextPrev);
	},
	//content Loader can go into a block
	//smallMenu.open("Recherche","blockUI")
	//smallMenu.open("Recherche","bootbox")
	open : function (content,type,color,callback) { 
		//alert("small menu open");
		//add somewhere in page
		if(!smallMenu.inBlockUI){
			$(smallMenu.destination).html( content );
			$.unblockUI();
		}
		else {
			//this uses blockUI
			if(type == "blockUI"){
				colorCSS = (color == "black") ? 'rgba(0,0,0,0.70)' : 'rgba(256,256,256,0.85)';
				colorCSS = (color == "black") ? '#fff' : '#000';
				$.blockUI({ 
					//title : 'Welcome to your page', 
					message : (content) ? content : "<div class='blockContent'></div>",
					onOverlayClick: $.unblockUI(),
			        css: { 
			         //border: '10px solid black', 
			         //margin : "50px",
			         //width:"80%",
			         //    padding: '15px', 
			         backgroundColor: colorCSS,  
			         //    '-webkit-border-radius': '10px', 
			         //    '-moz-border-radius': '10px', 
			             color: colorText ,
			        	// "cursor": "pointer"
			        }//,overlayCSS: { backgroundColor: '#fff'}
				});
			}else if(type == "bootbox"){
				bootbox.dialog({
				  message: content
				});
			} else{//open inside a boostrap modal 
				if(!$("#openModal").hasClass('in'))
					$("#openModal").modal("show");
				if(content)
					smallMenu.content(content);
				else 
					smallMenu.content("<i class='fa fa-spin fa-refresh fa-4x'></i>");
			}

			$(".blockPage").addClass(smallMenu.destination.slice(1));
			// If network, check width of menu small
			if( typeof globalTheme != "undefined" && globalTheme == "network" ) {
				if($("#ficheInfoDetail").is(":visible"))
					$(smallMenu.destination).css("cssText", "width: 100% !important;left: 0% !important;");
				else
					$(smallMenu.destination).css("cssText", "width: 83.5% !important;left: 16.5% !important;");
			}
			bindLBHLinks();
			if (typeof callback == "function") 
				callback();
		}
	},
	content : function(content) { 
		el = $("#openModal div.modal-content div.container");
		if(content == null)
			return el;
		else
			el.html(content);
	}
};

function inMyContacts (type,id) { 
	var res = false ;
	var type= (type=="citoyens") ? "people" : type;
	if(typeof myContacts != "undefined" && myContacts != null && myContacts[type]){
		$.each( myContacts[type], function( key,val ){
			//mylog.log("val", val);
			if( ( typeof val["_id"] != "undefined" && id == val["_id"]["$id"] ) || 
				(typeof val["id"] != "undefined" && id == val["id"] ) ) {
				res = true;
				return ;
			}
		});
	}
	return res;
}





/// ce trouve dans co/assets/default/index.js

function showNotif(show){
	if(typeof show == "undefined"){
		if($("#notificationPanelSearch").css("display") == "none") show = true; 
    	else show = false;
    }

    if(show){
    	$('#notificationPanelSearch').show("fast");
    	markAllAsSeen(false,"");
    	refreshNotifications(userId,"citoyens","","menuTop");

    }
	else 	 $('#notificationPanelSearch').hide("fast");

	
	$("#dropdown-user, #dropdown-dda, .dropdownApps-menuTop").removeClass("open");
    showFloopDrawer(false);
}