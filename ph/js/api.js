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
    		$("#ajax-modal-modal-title").html("<i class='fa fa-pencil'></i> "+what);
            $("#ajax-modal-modal-body").html(data); 
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

