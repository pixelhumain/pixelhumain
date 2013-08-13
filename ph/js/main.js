debug = true;

$(document).ready(function() { 
	/*$('#particpateTabs a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});*/
	
	/* *************************** */
	/* Toile de delaunay en bg */
	/* *************************** */
	var w = 1000,
    h = 1000;

	var vertices = d3.range(2000).map(function(d) {
	  return [Math.random() * w, Math.random() * h];
	});
	
	var delaunay = d3.geom.delaunay(vertices);
	
	var svg = d3.select("body")
	  .append("svg")
	      //.attr("width", "100%")
	      //.attr("height", "100%")
	      .attr("preserveAspectRatio", "xMidYMid slice")
			//.attr("width", w)
			//.attr("height", h)
	    .attr("viewBox", [0, 0, w, h].join(' '))
	
	    svg.append("g")
	  .selectAll("path")
	    .data(delaunay)
	  .enter().append("path")
	    .attr("class", function(d, i) { return "q" + (i % 9) + "-9"; })
	    .attr("d", function(d) { return "M" + d.join("L") + "Z"; });
	/* *************************** */
	
	/* *************************** */
	/* instance du menu questionnaire*/
	/* *************************** */
	var dd = new DropDown( $('#dd') );
	var ddinvité = new DropDown( $('#ddinvité') );
	
	$(document).click(function() {
		// all dropdowns
		$('.wrapper-dropdown-3').removeClass('active');
	});
	/* *************************** */
	/* resgistration Ajax Call*/
	/* *************************** */
	$("#registerForm").submit( function(event){
		log($(this).serialize());
		event.preventDefault();
		toggleSpinner();
		$.ajax({
		  type: "POST",
		  url: "index.php?r=pixelsactifs/register",
		  data: "registerEmail="+$("#registerEmail").val(),
		  success: function(data){
			  if(data.result){
				  $("#register").html('<a href="#participer"  target="_blank" role="button" data-toggle="modal">Bienvenue - Suite</a>');
				  $("#participer").modal('show');
			  }
			  else {
				  $("#flashInfo .modal-body").html(data.msg);
				  $("#flashInfo").modal('show');
			  }
			  toggleSpinner();
		  },
		  dataType: "json"
		});

	});
	$("#register2").submit( function(event){
		event.preventDefault();
		$("#participer").modal('hide');
		var params = "";
		if($("#registerName").val())
			params += "registerName="+$("#registerName").val()+"&";
		if($("#registerCP").val())
			params += "registerCP="+$("#registerCP").val()+"&";
		if($("#registerHelpout").prop("checked"))
			params += "registerHelpout="+$("#registerHelpout").prop("checked")+"&";
		if($("#helpJob").val())
			params += "helpJob="+$("#helpJob").val();
		toggleSpinner();
		$.ajax({
		  type: "POST",
		  url: "index.php?r=pixelsactifs/register2",
		  data: params,
		  success: function(data){
			  	  
				  $("#flashInfo .modal-body").html(data.msg);
				  $("#flashInfo").modal('show');
			  	  
			  	  toggleSpinner();
		  },
		  dataType: "json"
		});
	});
	
	$("#registerHelpout").click(function(){
		if($("#registerHelpout").prop("checked"))
			$("#registerHelpoutWhat").removeClass("hidden");
		else
			$("#registerHelpoutWhat").addClass("hidden");
	});
	
	
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
/* instance du menu questionnaire*/
/* *************************** */
function DropDown(el) {
	this.dd = el;
	this.placeholder = this.dd.children('span');
	this.opts = this.dd.find('ul.dropdown > li');
	this.val = '';
	this.index = -1;
	this.initEvents();
}
DropDown.prototype = {
	initEvents : function() {
		var obj = this;

		obj.dd.on('click', function(event){
			$(this).toggleClass('active');
			return false;
		});

		obj.opts.on('click',function(){
			var opt = $(this);
			obj.val = opt.text();
			obj.index = opt.index();
			obj.placeholder.text(obj.val);
			window.open($(this).find('a').slice(0,1).attr('href'));
		});
	},
	getValue : function() {
		return this.val;
	},
	getIndex : function() {
		return this.index;
	}
}



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