function testitpost(id,url,params,callback){
	console.log(id,url,params);
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    data:params,
	    type:"POST",
	    dataType:"json",
	    success:function(data) {
	    	if( typeof callback === "function")
	    		callback(data,id);
	    	else if(typeof data.msg === "string" )
	    		toastr.success(data);
	    	else
	      		$("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      toastr.error(thrownError);
	    } 
	  });
}
/*
what can be a simple string which will go into the title bar 
or an aboject with properties like title, icon, desc
 */
function getModal(what, url,id)
{
	
	loaded = {};
	$('#ajax-modal').modal("hide");
	if(id)
		url = url+id;
	console.log("getModal",what,"url",url,"event",id);
	//var params = $(form).serialize();
	//$("#ajax-modal-modal-body").html("<i class='fa fa-cog fa-spin fa-2x icon-big'></i> Loading");
	$('body').modalmanager('loading'); 
	$.ajax({
        type: "GET",
        url: baseUrl+url
        //dataType : "json"
        //data: params
    })
    .done(function (data) 
    {
        if (data) {               
        	/*if(!selectContent)
        		selectContent = data.selectContent;*/
        	title = (typeof what === "object" && what.title ) ? what.title : what;
        	icon = (typeof what === "object" && what.icon ) ? what.icon : "fa-pencil";
        	desc = (typeof what === "object" && what.desc ) ? what.desc+'<div class="space20"></div>' : "";

    		$("#ajax-modal-modal-title").html("<i class='fa "+icon+"'></i> "+title);
            $("#ajax-modal-modal-body").html(desc+data); 
            $('#ajax-modal').modal("show");
        } else {
            toastr.error("bug get "+id);
        }
    });
}

function openSubView(what, url,id)
{
	$.subview({
		content: "#ajaxSV",
		onShow: function() {
			$("#ajaxSV").html("<div class='cblock'><div class='centered'><i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading</div></div>");
			$.ajax({
		        type: "GET",
		        url: baseUrl+url
		    })
		    .done(function (data) 
		    {
		        if (data) {               
		            $("#ajaxSV").html(data); 
		        } else {
		        	bootbox.error("bug happened : "+id);
		        }
		    });
		},
		onHide : function() {
			loaded = {};
		}
	});
}

function openSubViewHTML(html,callback)
{
	$.subview({
		content: "#ajaxSV",
		onShow: function() {
			$("#ajaxSV").html("<div class='cblock'><div class='centered'><i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading</div></div>");
			$("#ajaxSV").html(html); 
			if( typeof callback === "function")
	    		callback();
		}
	});
}

function testitget(id,url,callback,datatype)
{
	if(datatype != "html" )
		$("#"+id).html("");
	$.ajax({
	    url:url,
	    type:"GET",
	    //dataType:"json",
	    success:function(data) {
	    	if( typeof callback === "function")
	    		callback(data,id);
	    	else if(datatype === "html" )
	    		$(id).html(data);
	    	else if(typeof data === "string" )
	    		toastr.success(data);
	    	else
	      		$("#"+id).html(JSON.stringify(data, null, 4));
	    	
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	       toastr.error(thrownError);
	    } 
	  });
}

function toggle(id)
{
	log(id);
	if( !$("."+id).is(":visible") ) 
	{
		$("."+id).removeClass("hide").attr("style","");
		$("."+id+"Icon").removeClass('fa-eye-slash').addClass('fa-eye');
	} 
	else 
	{ 
		$("."+id).addClass("hide");
		$("."+id+"Icon").removeClass('fa-eye').addClass('fa-eye-slash');
		$("."+id).hide();
	}
	return false;
}
function scrollTo(id)
{
	if( $(id).length )
	{
		console.log("initscrollTo ", id);
	 	$("html, body").animate({ scrollTop: $(id).offset().top-70 }, 700);
	}
}
function Object2Array(obj)
{
	jsonAr =[];
	$.each(obj,function(k,v)
	{
		v.id = k;
		delete v._id;
		jsonAr.push(v);
	});
	console.dir(jsonAr);
	return jsonAr;
}
function showAsColumn(resp,id)
{
	//log(resp,"dir");
	if($("#"+id).hasClass("columns"))
	{
		log("rebuild");
		$("#"+id).columns('setMaster', Object2Array(resp) );
		$("#"+id).columns('create');
	} else {
		$("#"+id).columns({
	      data:Object2Array(resp),
	      schema:[
		      {"header":"Name","key":"name"},
		      {"header":"Edit","key":"id", "template":"<a class='openModal' href='{{id}}' data-id='{{id}}' data-name='{{name}}'>{{id}}</a>"}
		  ]
	    });
	    
	    $(".openModal").click(function(e){
	    	e.preventDefault();
	    	openModal($("#getbyMicroformat").val(),$("#getbyCollection").val(),this.dataset.id,"dynamicallyBuild");
	    })
	}
}

function slugify (value) {    
	var rExps=[
	{re:/[\xC0-\xC6]/g, ch:'A'},
	{re:/[\xE0-\xE6]/g, ch:'a'},
	{re:/[\xC8-\xCB]/g, ch:'E'},
	{re:/[\xE8-\xEB]/g, ch:'e'},
	{re:/[\xCC-\xCF]/g, ch:'I'},
	{re:/[\xEC-\xEF]/g, ch:'i'},
	{re:/[\xD2-\xD6]/g, ch:'O'},
	{re:/[\xF2-\xF6]/g, ch:'o'},
	{re:/[\xD9-\xDC]/g, ch:'U'},
	{re:/[\xF9-\xFC]/g, ch:'u'},
	{re:/[\xC7-\xE7]/g, ch:'c'},
	{re:/[\xD1]/g, ch:'N'},
	{re:/[\xF1]/g, ch:'n'} ];

	// converti les caractères accentués en leurs équivalent alpha
	for(var i=0, len=rExps.length; i<len; i++)
	value=value.replace(rExps[i].re, rExps[i].ch);

	// 1) met en bas de casse
	// 2) remplace les espace par des tirets
	// 3) enleve tout les caratères non alphanumeriques
	// 4) enlève les doubles tirets
	return value.toLowerCase()
	.replace(/\s+/g, '-')
	.replace(/[^a-z0-9-]/g, '')
	.replace(/\-{2,}/g,'-');
};
