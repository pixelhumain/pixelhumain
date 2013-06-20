debug = true;

$(document).ready(function() {  
	
		
});

function scrollTo(id){
	$('html, body').animate({
		scrollTop: $(id).offset().top-50
	 }, 1000);
}
function log(msg,type){
	if(debug){
	   try {
	    /*if(type){
	      switch(type){
	        case 'info': console.info(msg); break;
	        case 'warn': console.warn(msg); break;
	        case 'debug': console.debug(msg); break;
	        case 'error': console.error(msg); break;
	        case 'dir': console.dir(msg); break;
	        default : console.log(msg);
	      }
	    } else
	          console.log(msg);*/
	  } catch (e) { 
	     //alert(msg);
	  }
	}
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
/*
function IsNumeric(input)
{
    return (input - 0) == input && (input+'').replace(/^\s+|\s+$/g, "").length > 0;
} */