debug = true;

$(document).ready(function() { 
	initSequence();
});
function toggleSpinner(){
	if($("#logoLink").length){
		$("#logo").html('');
		var spinner = new Spinner(spinner_opts).spin($("#logo")[0]);
	} else 
		$("#logo").html('<a id="logoLink" href="index.php">Pixel Humain</a>');
}

var spinner_opts = {
  lines: 9, // The number of lines to draw
  length: 6, // The length of each line
  width: 5, // The line thickness
  radius: 8, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 47, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#F7E400', // #rgb or #rrggbb
  speed: 0.7, // Rounds per second
  trail: 32, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '-7px', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};

/* *************************** */
/* global JS tools */
/* *************************** */
function log(msg,type){
	if(debug){
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
/* ------------------------------- */

function initSequence(){
    $.each(initT, function(k,v){
        log(k,'info');
        v();
    });
    initT = null;
}