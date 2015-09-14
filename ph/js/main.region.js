
/* 
*	We would normally recommend that all JavaScript is kept in a seperate .js file,
* 	but we have included it in the document head for convenience.
*/

// NICE IMAGE LOADING

/* 
*	Not part of MixItUp, but this is a great lightweight way 
* 	to gracefully fade-in images with CSS3 after they have loaded
*/

function imgLoaded(img){	
	$(img).parent().addClass('loaded');
};

// ON DOCUMENT READY:

$(function(){
	/* *************
	 * ADd commune Form 
	 */
	//$("#activities,#natures,#geoPosition").select2(); 
	$("#wikipage").blur(function(){
		var searchTerm=$("#wikipage").val();
		var url="http://fr.wikipedia.org/w/api.php?action=parse&format=json&page=" + searchTerm+"&redirects&prop=text&callback=?";
		
		$.ajax({
		    url: url,
		    dataType: 'json',
		    success: function( data ) {
		    	if(data.error)
		    		$("#wikipage").css("border","1px solid red");
		    	else {
			    	wikiHTML = data.parse.text["*"];
					$wikiDOM = $("<document>"+wikiHTML+"</document>");
			    	if($wikiDOM.find('.infobox'))
			    		$("#wikipage").css("border","1px solid green");
				    else
				    	$("#wikipage").css("border","1px solid red");
		    	}
		    },
		    error: function( data ) {
		    	$("#wikipage").css("border","1px solid red");
		    }
		  });
		
	});
	$("#imgGeo,#imgLogo,#imgValo").blur(function(){
		var url = $(this).val();
		
		var _self = this;
		$.ajax({
		    url: url,
		    success: function( ) {
		    	$(_self).css("border","1px solid green");   
		    },
		    error: function( data ) {
		    	$(_self).css("border","1px solid red");
		    }
		  });
		
	});
	$("#submitCommune").click(function(){
		var formData = "";
		var inputs = $("#communeForm :input");
		inputs.each(function(){
			if(formData!="")formData += "&";
			formData += this.id+"="+this.value;
		});
		
		alert("submitCommune : " +formData );
		 $.ajax({
		  type: "POST",
		  url: "saveCommune.php",
		  data: formData,
		  success: function(data){
			if(data.result==true)
				alert("SUCCESS");//window.location.reload();
			else
				alert("ERROR");
		  },
		  dataType: 'json'
		});
	});	
	/* ************* */ 
	
	/*var searchTerm="Bras-Panon";
	var url="http://en.wikipedia.org/w/api.php?action=parse&format=json&page=" + searchTerm+"&redirects&prop=text&callback=?";
	$.getJSON(url,function(data){
	  console.dir(data);
	  wikiHTML = data.parse.text["*"];
	  $wikiDOM = $("<document>"+wikiHTML+"</document>");
	  $("#result").append($wikiDOM.find('.infobox').html());
	});*/
	// INSTANTIATE MIXITUP
	
	$('#Parks').mixitup({
		layoutMode: 'list', // Start in list mode (display: block) by default
		listClass: 'list', // Container class for when in list mode
		gridClass: 'grid', // Container class for when in grid mode
		effects: ['fade','blur'], // List of effects 
		listEffects: ['fade','rotateX'] // List of effects ONLY for list mode
	});
	
	// HANDLE LAYOUT CHANGES
	
	// Bind layout buttons to toList and toGrid methods:
	
	$('#ToList').on('click',function(){
		$('.button').removeClass('active');
		$(this).addClass('active');
		$('#Parks').mixitup('toList');
	});

	$('#ToGrid').on('click',function(){
		$('.button').removeClass('active');
		$(this).addClass('active');
		$('#Parks').mixitup('toGrid');
	});
	
	$('#ToMap').on('click',function(){
		$('.button').removeClass('active');
		$(this).addClass('active');
		window.location.href="./decouvrir/map";
	});
	
	// HANDLE MULTI-DIMENSIONAL CHECKBOX FILTERING
	
	/* 	
	*	The desired behaviour of multi-dimensional filtering can differ greatly 
	*	from project to project. MixItUp's built in filter button handlers are best
	*	suited to simple filter operations, so we will need to build our own handlers
	*	for this demo to achieve the precise behaviour we need.
	*/
	
	var $filters = $('#Filters').find('li'),
		dimensions = {
			region: 'all', // Create string for first dimension
			recreation: 'all', // Create string for second dimension
			nature: 'all',
			administration: 'all'
		};
		
	// Bind checkbox click handlers:
	
	$filters.on('click',function(){
		var $t = $(this),
			dimension = $t.attr('data-dimension'),
			filter = $t.attr('data-filter'),
			filterString = dimensions[dimension];
			
		if(filter == 'all'){
			// If "all"
			if(!$t.hasClass('active')){
				// if unchecked, check "all" and uncheck all other active filters
				$t.addClass('active').siblings().removeClass('active');
				// Replace entire string with "all"
				filterString = 'all';	
			} else {
				// Uncheck
				$t.removeClass('active');
				// Emtpy string
				filterString = '';
			}
		} else {
			// Else, uncheck "all"
			$t.siblings('[data-filter="all"]').removeClass('active');
			// Remove "all" from string
			filterString = filterString.replace('all','');
			if(!$t.hasClass('active')){
				// Check checkbox
				$t.addClass('active');
				// Append filter to string
				filterString = filterString == '' ? filter : filterString+' '+filter;
			} else {
				// Uncheck
				$t.removeClass('active');
				// Remove filter and preceeding space from string with RegEx
				var re = new RegExp('(\\s|^)'+filter);
				filterString = filterString.replace(re,'');
			};
		};
		
		// Set demension with filterString
		dimensions[dimension] = filterString;
		
		// We now have two strings containing the filter arguments for each dimension:	
		console.info('dimension 1: '+dimensions.region);
		console.info('dimension 2: '+dimensions.recreation);
		console.info('dimension 3: '+dimensions.nature);
		console.info('dimension 4: '+dimensions.administration);
		
		/*
		*	We then send these strings to MixItUp using the filter method. We can send as
		*	many dimensions to MixitUp as we need using an array as the second argument
		*	of the "filter" method. Each dimension must be a space seperated string.
		*
		*	In this case, MixItUp will show elements using OR logic within each dimension and
		*	AND logic between dimensions. At least one dimension must pass for the element to show.
		*/
		
		$('#Parks').mixitup('filter',[dimensions.region, dimensions.recreation,dimensions.nature,dimensions.administration])			
	});

});