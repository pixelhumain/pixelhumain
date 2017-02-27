
function  processingBlockUi() { 
	$.blockUI({
	 	message : '<img src="'+themeUrl+'/assets/img/logocagou-loader.png" class="nc_map pull-" height=80>'+
	 			  '<i class="fa fa-spin fa-circle-o-notch"></i>'+
	 			   '<span class="col-md-12 text-center font-blackoutM text-left">'+
	 			    '<span class="letter letter-blue font-ZILAP">K</span>'+
                    '<span class="letter letter-yellow">G</span>'+
                    '<span class="letter letter-yellow font-ZILAP">O</span>'+
                    '<span class="letter letter-yellow">U</span>'+
                    '<span class="letter letter-green">G</span>'+
                    '<span class="letter letter-green">L</span>'+
                    '<span class="letter letter-green">E</span>'+
                   '</span>'+

	 			  '<h4 style="font-weight:300" class=" text-dark padding-10">'+
	 				'Chargement en cours...'+
	 			  '</h4>'+
	 			  '<span style="font-weight:300" class=" text-dark">'+
	 				'Merci de patienter quelques instants'+
	 			  '</span>'+
	 			  '<br><br><br>'+
	 			  '<a href="#k" class="btn btn-default btn-sm lbh">'+
	 			  	"c'est trop long !"+
	 			  '</a>'
	 });
	bindLBHLinks();
}


function getAjax(id,url,callback,datatype,blockUI)
{
  $.ajaxSetup({ cache: true});
  mylog.log("getAjax",id,url,callback,datatype,blockUI)
    if(blockUI)
        $.blockUI({
            message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
                '<blockquote>'+
                  '<p>Art is the heart of our culture.</p>'+
                '</blockquote> '
        });
  
    if(datatype != "html" )
        $(id).html( "<div class='cblock'><div class='centered'><i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading</div></div>" );
  
    $.ajax({
        url:url,
        type:"GET",
        cache: true,
        success:function(data) {
          if (data.error) {
            mylog.warn(data.error);
            toastr.error(data.error.msg);
          } else if(datatype === "html" )
            $(id).html(data);
          else if(datatype === "norender" )
            mylog.log("no render",url)
          else if( typeof data === "string" )
            toastr.success(data);
          else
              $(id).html( JSON.stringify(data, null, 4) );
  
          if( typeof callback === "function")
            callback(data,id);
          if(blockUI)
            $.unblockUI();
        },
        error:function (xhr, ajaxOptions, thrownError){
          //mylog.error(thrownError);
          $.blockUI({
              message : '<img src="'+themeUrl+'/assets/img/logocagou-loader.png" class="nc_map pull-" height=80>'+
			 			  '<i class="fa fa-times"></i>'+
			 			   '<span class="col-md-12 text-center font-blackoutM text-left">'+
			 			    '<span class="letter letter-blue font-ZILAP">K</span>'+
		                    '<span class="letter letter-yellow">G</span>'+
		                    '<span class="letter letter-yellow font-ZILAP">O</span>'+
		                    '<span class="letter letter-yellow">U</span>'+
		                    '<span class="letter letter-green">G</span>'+
		                    '<span class="letter letter-green">L</span>'+
		                    '<span class="letter letter-green">E</span><br>'+
		                    '<span class="letter letter-red font-blackoutT" style="font-size:40px;">404</span>'+
		                   '</span>'+

			 			  '<h4 style="font-weight:300" class=" text-dark padding-10">'+
			 				'Oups ! Une erreur s\'est produite'+
			 			  '</h4>'+
			 			  '<span style="font-weight:300" class=" text-dark">'+
			 				'Vous allez être redirigé vers la page d\'accueil'+
			 			  '</span>',
              timeout: 3000 
          });
          setTimeout(function(){url.loadByHash('#')},3000);
          if(blockUI)
            $.unblockUI();
        } 
    });
}
