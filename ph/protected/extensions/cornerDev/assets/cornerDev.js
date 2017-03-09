var cornerDebug = false;

/* ------------------------------- */

$(document).ready(function() { 
	getJSONSitemap(getJsonCallback);
	$('.cornerEditDetails').click( function(event){
		event.preventDefault();
		cornerDialog.openAjax('popupEditDetails',$(this).attr('href'),'editDetails','EDIT PAGE DETAILS',prepareDetailForm);
		return false;
	});
	$('#cornerComment').click( function(event){
		event.preventDefault();
		cornerDialog.openAjax('popupComment',$(this).attr('href'),'Comments','READ - WRITE COMMENTS',null);
		return false;
	});
	$('.cornerAddmultiple').click( function(event){
		event.preventDefault();
		cornerDialog.openAjax('popupAddMultiple',$(this).attr('href'),'Muliptle Adds','ADD MULTIPLE ENTRIES',null);
		return false;
	});
	$('.jqDnR').draggable().resizable();
});

function prepareDetailForm(){
	if($('#title').val() == ''){
		pageTitle = document.title;
		$('#title').val(pageTitle.toUpperCase()); 
		$('#link').val(pathKey);
	}
}
function closeAll(){
	w = ['#cornerToBeTested','#cornerInProgress','#cornerActions','#cornerUseCase','#cornerZones'];
	$.each(w, function(i){
		$(w[i]).slideUp();
	});
}

function getJsonCallback(){
	if(activeSectionId)
		loadSectionFrame();
}

function saveCallback(){
	log("saveJSONSitemap > saved Frame to Sitemap");
	cornerDialog.close();
	//TODO : reload Corner Dev Only
	window.location.reload();
}

function toggleOpenClose(){
	log($('#cornerDev').css("height"));
	$('#cornerDev').animate({
	    'height': ($('#cornerDev').css("height")=="400px")?"16px":"400px"
	  },700, function() {
	    log('animation done');
	  });
}

