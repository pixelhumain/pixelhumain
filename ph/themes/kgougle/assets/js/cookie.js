
function updateCookieValues(user_geo_latitude, user_geo_longitude, insee, cityName){
	$.cookiesDirective(
		{	explicitConsent: false, // false allows implied consent
			privacyPolicyUri: 'my-privacy-policy.html',
            //fontFamily: 'helvetica', // font style for disclosure panel
            position: 'bottom', // top or bottom of viewport
			duration: 20, // display time in seconds
			limit: 2, // limit disclosure appearances, 0 is forever  
			message: "<i class='fa fa-2x fa-thumb-tack'></i></br>Nous avons placé des cookies sur votre machine.</br>"+
					 "Les cookies servent à personnaliser votre navigation.</br>" + 
					 "Vous pouvez supprimer et bloquer tout les cookies de ce site, mais certaines parties du site ne fonctionneront pas.</br>", // customise the disclosure message              

			fontColor: '#FFFFFF', // font color for disclosure panel
			fontSize: '13px', // font size for disclosure panel
			backgroundColor: '#315C6E', // background color of disclosure panel
			backgroundOpacity: '90', // opacity of disclosure panel
			linkColor: '#32D8DE', // link color in disclosure panel
            scriptWrapper: 
            	function (){
            		var path = "/";
            		//mylog.log(location.hostname.indexOf("localhost") );
            		//mylog.dir(location);
            		if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";
				    mylog.log("mise à jour des cookies", path);
					$.cookie('user_geo_latitude',   user_geo_latitude,  { expires: 365, path: path });
					$.cookie('user_geo_longitude',  user_geo_longitude, { expires: 365, path: path });
					$.cookie('insee', 	  			insee, 	 			{ expires: 365, path: path });
					$.cookie('cityName',  			cityName,  			{ expires: 365, path: path });
				}
		});
}