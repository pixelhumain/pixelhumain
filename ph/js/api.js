function testitpost(id,url,params,callback){
	console.log(id,url,params);
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    data:params,
	    type:"POST",
	    success:function(data) {
	    	if(callback)
	    		callback(data);
	    	else
	      		$("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      $("#"+id).html(data);
	    } 
	  });
}
function testitget(id,url,callback){
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    type:"GET",
	    success:function(data) {
	    	if(callback)
	    		callback(data);
	    	else
	      		$("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      $("#"+id).html(data);
	    } 
	  });
}
function toggle(id){
	if( !$("."+id).is(":visible") ) {
		$("."+id).removeClass("hide").attr("style","");
		$("."+id+"Icon").removeClass('fa-eye-slash').addClass('fa-eye');
	} else { 
		$("."+id).addClass("hide");
		$("."+id+"Icon").removeClass('fa-eye').addClass('fa-eye-slash');
		$("."+id).hide();
	}
	return false;
}
function scrollTo(id){
 $("html, body").animate({
            scrollTop: $(id).offset().top-70
        }, 700);
}