var activeSection = null;
var activeFrame = null;


function addNewFrame()
{
	//TODO id unicity check 
	sectionFrames = sitemapObj['sections'][$('#sectionId').val()]['frames'];
	
	if( sectionFrames[$('#id').val()] == null )
	{
		sectionFrames[$('#id').val()] = {};
		activeFrame = sectionFrames[$('#id').val()];
		
		activeFrame['id'] = $('#id').val();
		activeFrame['title'] = $('#title').val();
		activeFrame['link'] = $('#link').val();
		
		activeFrame['top'] = '200px';
		activeFrame['left'] = '200px';
		activeFrame['width'] = '200px';
		activeFrame['height'] = '200px';
		activeFrame['comment'] = [];
		activeFrame['action'] = $('#action').val();
		activeFrame['progress'] = $('#progress').val();
		activeFrame['state'] = $('#state').val();
		
		saveJSONSitemap(saveCallback);
	}else
		alert("this ID or pathKey allready exists in this section!");
}
function saveFrameComment(){
	if( $('#newComment').val() != '' )
	{
		log(activeFrame,'dir');
		if(activeFrame.comment == null)
			activeFrame['comment'] = [];
		commentT = activeFrame.comment;
		commentT.push( {
		  	"txt": $('#newComment').val(),
		  	"type": $('#newCommentType').val(),
		  	"user": $('#newCommentSign').val(),
		  	"htmlID": $('#htmlID').val(),
		  	"date": cornerDate()
		});	
		saveJSONSitemap(saveCallback);
	} else
		alert("you must add a comment at least.");
}
function saveFrameUseCase(caseName,entries){
	if( caseName != '' && entries.length > 0 )
	{
		if(activeFrame.useCase == null)
			activeFrame['useCase'] = {};
		
		activeFrame['useCase'][caseName]=entries;
		saveJSONSitemap(saveCallback);
	} else
		alert("you must give a name and add at least one content");
}
function saveFrameInfo()
{
	log(activeFrame,'dir');
	$('#savebutton').html('<img src="'+imgUrl+'/images/ajax-loader.gif"/>');
	activeFrame.id=$('#id').val();
	activeFrame.title = $('#title').val();
	activeFrame.link = $('#link').val();
	activeFrame.action = $('#action').val();
	activeFrame.state = $('#state').val();
	activeFrame.progress = $('#progress').val();
	saveJSONSitemap(saveCallback);
}
// Writes the modifed activeSection to sitemap.json file
function saveJSONSitemap(callback){
	log(activeFrame,'dir');
	$.ajax({
		global: false,
		type: "POST",
		cache: false,
		dataType: "json",
		data: ({ sitemap: sitemapObj }),
		url: saveScript,
		complete: function(){
			if(callback!= null && typeof(callback) == "function" )
	        	callback();
		}
	});
}
//Gets the definition file of a sitemap from scripts/sitemap.json
function getJSONSitemap(callback){
	log("getJSONSitemap");
	// Reading
	$.ajax({
		dataType: "script",
		url: jsonPath,
		complete: function(data){
			if(callback!= null && typeof(callback) == "function" )
	        	callback();
		}
	});
}
function loadSectionFrame(){
	activeSection = sitemapObj.sections[activeSectionId];
	var sectionF = activeSection.frames;
	activeFrame = sectionF[activeFrameId];
	log(activeFrame,'dir');
}
/******************************************************************************/
		//JSON TOOLS
function getLength(obj) {
    var count = 0,key;
    for (key in obj) 
        if (obj.hasOwnProperty(key)) 
            count++;
        
    return count;
}
		//DATE TOOLS
function cornerDate(){
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	return month + "/" + day + "/" + year;
}
/********************************************************************************/
		//Dialog Popin
var cornerDialog = {
	open : null,
	id : 'cornerDialogContainer',
	options : {
        'modal':true,
        'autoOpen' : false,
        'width':'auto',
        'height':'auto'
        /*'buttons':{ 'Save' : function() { comment.save(function(){alert("coment saved")}); },
                    'Cancel' : function() { $(this).dialog("close") } }*/
    },
  /* ------------ */  
  openAjaxGet : function (paramsObj){
  	log('openAjaxDialogGet');
	//console.dir(paramsObj);
    $.ajax({
      url: paramsObj.url,
      success: function(data) {
  		// Start dialog
    	$('#'+cornerDialog.id).html(data);
    	cornerDialog.options.title = paramsObj.title;
        var $dialog = $('#'+cornerDialog.id).dialog(cornerDialog.options);
        $dialog.dialog('open'); 	
        cornerDialog.open = $dialog; 
        if(paramsObj.callback!= null && typeof(paramsObj.callback) == "function" )
        	paramsObj.callback();
  	  }
  	});
  	return false;
  },
  close : function(){
	  cornerDialog.open.dialog('close'); 	
	  $('#'+cornerDialog.id).html('');
  },
 /* ------------ */  
  openAjax : function (id,url,prefix,title,callback){
	  cornerDialog.openAjaxGet({'id':id,'url':url,'prefix':prefix,'title':title,'callback':callback});
  }
  
};

/********************************************************************************/

function initSequence(){
    $.each(initT, function(k,v){
        log(k,'info');
        v();
    });
    initT = null;
}

/********************************************************************************/

function log(msg,type){
	if(cornerDebug){
	   try {
	    if(type){
	      switch(type){
	        case 'info': console.info(msg); break;
	        case 'warn': console.warn(msg); break;
	        case 'debug': console.debug(msg); break;
	        case 'error': console.error(msg); break;
	        case 'dir': console.dir(msg); break;
	        default : console.log(msg);
	      }
	    } else
	          console.log(msg);
	  } catch (e) { 
	     //alert(msg);
	  }
	}
}

/********************************* Jquery pluggins ***********************************************/

