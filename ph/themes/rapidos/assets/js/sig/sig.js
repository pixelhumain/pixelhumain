
var Sig = function() {
	
	"use strict";
	
	//set variables	
	var _MAP;
	
	
	var loadLeafletLibraries = function() {
	
		$.getScript( "/ph/themes/rapidos/assets/js/sig/leaflet.js", 						function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/leaflet.draw-src.js", 				function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/leaflet.draw.js", 					function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/leaflet.markercluster-src.js", 		function( data, textStatus, jqxhr ) { });
	
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/copyright.js", 					function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.utils.js", 			function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.linearfunctions.js", function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.palettes.js", 		function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.regularpolygon.js", 	function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.markers.js", 		function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.chartmarkers.js", 	function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.datalayer.js", 		function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.lines.js", 			function( data, textStatus, jqxhr ) { });
		$.getScript( "/ph/themes/rapidos/assets/js/sig/dvf/leaflet.dvf.controls.js", 		function( data, textStatus, jqxhr ) { });
		
		//alert("load ok");
	}
	
	
	
	/**
	***		CREATE NEW MAP WITH OPTIONS
	***/ 			
	var startNewMap = function(options){
		_MAP = L.map(options.canvasId, { 	"zoomControl" : true, 
											"scrollWheelZoom" : true,
											"doubleClickZoom" : true,
											"minZoom":options.zoomMin,
											"maxZoom":options.zoomMax,
							  } ).setView(options.startCenter, options.zoomStart);
				
		L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			subdomains: 'abcd'
		}).setOpacity(0.4).addTo(_MAP);
	
		return _MAP; 		
	};
	
	
		

	
	return {
		init : function() 
		{
			loadLeafletLibraries();
		},
		
		loadMapTeeo : function(options)
		{
			startNewMap(options);
			return _MAP;
		},
		
		getChartMarker : function(chartType, latlng, options){
            if(chartType == "BarChartMarker")  			  	return new L.BarChartMarker(latlng, options);
            if(chartType == "RadialBarChartMarker")  		return new L.RadialBarChartMarker(latlng, options);
            if(chartType == "PieChartMarker")  			  	return new L.PieChartMarker(latlng, options);    
            if(chartType == "CoxcombChartMarker")  		  	return new L.CoxcombChartMarker(latlng, options);
            if(chartType == "StackedRegularPolygonMarker")  return new L.StackedRegularPolygonMarker(latlng, options);
            if(chartType == "RadialMeterMarker")  		  	return new L.RadialMeterMarker(latlng, options);
        }
	};
	console.log("Sig");
}();
