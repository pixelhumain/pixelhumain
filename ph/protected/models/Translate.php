<?php 

class Translate {
	const FORMAT_SCHEMA = "schema";
	const FORMAT_PLP = "plp";
	const FORMAT_AS = "activityStream";

/*

	----------------- SCHEMA ----------------- 

https://schema.org/Person

	{
  "@context": "http://schema.org",
  "@type": "Person",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Seattle",
    "addressRegion": "WA",
    "postalCode": "98052",
    "streetAddress": "20341 Whitworth Institute 405 N. Whitworth"
  },
  "colleague": [
    "http://www.xyz.edu/students/alicejones.html",
    "http://www.xyz.edu/students/bobsmith.html"
  ],
  "email": "mailto:jane-doe@xyz.edu",
  "image": "janedoe.jpg",
  "jobTitle": "Professor",
  "name": "Jane Doe",
  "telephone": "(425) 123-4567",
  "url": "http://www.janedoe.com"
}*/
	public static $dataBinding_person_schema = array(
		"@context"  => "http://schema.org",
		"@type"		=> "Person",
		"@id" 		=> array("valueOf"  	=> '_id.$id', 
							 "type" 	=> "url", 
							 "prefix"   => "/data/persons/id/",
							 "suffix"   => "/format/schema" ),
	    "name" 		=> array("valueOf" => "name"),
	    "address" 	=> array("parentKey"=>"address", 
	    					 "valueOf" => array(
								"@type" 			=> "PostalAddress", 
								"@id" 				=> array("valueOf"  	=> 'codeInsee', 
															 "type" 	=> "url", 
															 "prefix"   => "/data/city/insee/",
															 "suffix"   => "/format/schema" ),
								"addressLocality"   => array("valueOf" => "addressLocality"),
								"addressRegion" 	=> array("valueOf" => "region"),
								"postalCode" 		=> array("valueOf" => "postalCode"),
				 				"streetAddress" 	=> array("valueOf" => "streetAddress")) ),
	    "email"		=> array("valueOf" => "email"),
		"image"		=> array("valueOf" => "img","type" 	=> "url", 
							 "prefix"   => "/communecter/"),
		"jobTitle"	=> array("valueOf" => "positions"),
		"telephone"	=> array("valueOf" => "phoneNumber"),
		"url"		=> array("valueOf" => "url")
	);

	public static $dataBinding_organization_schema = array(
		"@context"  => "http://schema.org",
		"@type"		=> "Organization",
		"id" 		=> array("valueOf"  	=> '_id.$id', 
							 "type" 	=> "url", 
							 "prefix"   => "/data/persons/id/",
							 "suffix"   => "/format/schema" ),
	    "name" 		=> array("valueOf" => "name"),
	    "address" 	=> array("parentKey"=>"address", 
	    					 "valueOf" => array(
								"@type" 			=> "PostalAddress", 
								"@id" 				=> array("valueOf"  	=> 'codeInsee', 
															 "type" 	=> "url", 
															 "prefix"   => "/data/city/insee/",
															 "suffix"   => "/format/schema" ),
								"addressLocality"   => array("valueOf" => "addressLocality"),
								"addressRegion" 	=> array("valueOf" => "region"),
								"postalCode" 		=> array("valueOf" => "postalCode"),
				 				"streetAddress" 	=> array("valueOf" => "streetAddress")) ),
	    "email"		=> array("valueOf" => "email"),
		"image"		=> array("valueOf" => "img","type" 	=> "url", 
							 "prefix"   => "/communecter/"),
		"telephone"	=> array("valueOf" => "phoneNumber"),
		"url"		=> array("valueOf" => "url")
	);
	public static $dataBinding_project_schema = array(
		"@context"  => "http://schema.org",
		"@type"		=> "Organization",
		"@id" 		=> array("valueOf"  	=> '_id.$id', 
							 "type" 	=> "url", 
							 "prefix"   => "/data/persons/id/",
							 "suffix"   => "/format/schema" ),
	    "name" 		=> array("valueOf" => "name"),
	    "address" 	=> array("parentKey"=>"address", 
	    					 "valueOf" => array(
								"@type" 			=> "PostalAddress", 
								"@id" 				=> array("valueOf"  	=> 'codeInsee', 
															 "type" 	=> "url", 
															 "prefix"   => "/data/city/insee/",
															 "suffix"   => "/format/schema" ),
								"addressLocality"   => array("valueOf" => "addressLocality"),
								"addressRegion" 	=> array("valueOf" => "region"),
								"postalCode" 		=> array("valueOf" => "postalCode"),
				 				"streetAddress" 	=> array("valueOf" => "streetAddress")) ),
	    "email"		=> array("valueOf" => "email"),
		"image"		=> array("valueOf" => "img","type" 	=> "url", 
							 "prefix"   => "/communecter/"),
		"telephone"	=> array("valueOf" => "phoneNumber"),
		"url"		=> array("valueOf" => "url")
	);
	public static $dataBinding_event_schema = array(
		"@context"  => "http://schema.org",
		"@type"		=> "Organization",
		"@id" 		=> array("valueOf"  	=> '_id.$id', 
							 "type" 	=> "url", 
							 "prefix"   => "/data/persons/id/",
							 "suffix"   => "/format/schema" ),
	    "name" 		=> array("valueOf" => "name"),
	    "address" 	=> array("parentKey"=>"address", 
	    					 "valueOf" => array(
								"@type" 			=> "PostalAddress", 
								"@id" 				=> array("valueOf"  	=> 'codeInsee', 
															 "type" 	=> "url", 
															 "prefix"   => "/data/city/insee/",
															 "suffix"   => "/format/schema" ),
								"addressLocality"   => array("valueOf" => "addressLocality"),
								"addressRegion" 	=> array("valueOf" => "region"),
								"postalCode" 		=> array("valueOf" => "postalCode"),
				 				"streetAddress" 	=> array("valueOf" => "streetAddress")) ),
	    "email"		=> array("valueOf" => "email"),
		"image"		=> array("valueOf" => "img","type" 	=> "url", 
							 "prefix"   => "/communecter/"),
		"telephone"	=> array("valueOf" => "phoneNumber"),
		"url"		=> array("valueOf" => "url")
	);

	/*

	----------------- PLP ----------------- 

	https://github.com/hackers4peace/plp-test-data/blob/master/graph.jsonld
	*/
	public static $dataBinding_person_plp = array(
	    "@context"  => "https://w3id.org/plp/v1",
		"@type"		=> "Person",
		"id" 		=> array("valueOf"  	=> '_id.$id', 
							 "type" 	=> "url", 
							 "prefix"   => "/data/persons/id/",
							 "suffix"   => "/format/schema" ),
	    "name" 		=> array("valueOf" => "name"),
	    "image"		=> array("valueOf" => "img",
							 "type" 	=> "url", 
							 "prefix"  => "/communecter/"),
	    "birthDate" => array("valueOf" => "bitrh"),
	    "currentLocation" 	=> array(
	    					 "valueOf" => array(
								"@type" => "Place", 
								"name" => "CURRENT",
								"address" 	=> array("parentKey"=>"address", 
							    					 "valueOf" => array(
														"@type" 			=> "PostalAddress", 
														"@id" 				=> array("valueOf"  	=> 'codeInsee', 
																					 "type" 	=> "url", 
																					 "prefix"   => "/data/city/insee/",
																					 "suffix"   => "/format/schema" ),
														"addressLocality"   => array("valueOf" => "addressLocality"),
														"addressRegion" 	=> array("valueOf" => "region"),
														"postalCode" 		=> array("valueOf" => "postalCode"),
										 				"streetAddress" 	=> array("valueOf" => "streetAddress")) ),
								 ) ),
	    "homeLocation" 	=> array(
	    					 "valueOf" => array(
								"@type" => "Place", 
								"name" => "HOME",
								"address" 	=> array("parentKey"=>"address", 
							    					 "valueOf" => array(
														"@type" 			=> "PostalAddress", 
														"@id" 				=> array("valueOf"  	=> 'codeInsee', 
																					 "type" 	=> "url", 
																					 "prefix"   => "/data/city/insee/",
																					 "suffix"   => "/format/schema" ),
														"addressLocality"   => array("valueOf" => "addressLocality"),
														"addressRegion" 	=> array("valueOf" => "region"),
														"postalCode" 		=> array("valueOf" => "postalCode"),
										 				"streetAddress" 	=> array("valueOf" => "streetAddress")) ),
								 ) ),
	    "description"		=> array("valueOf" => "description"),
	    "contactPoint" => array(
	    		array(
	    			"name" => "email",
	    			"@type" => "ContactPoint", 
		    		"id" => array("valueOf" => "email",
		    					  "prefix"  => "mailto:")),
	    		array(
	    			"name" => "phoneNumber",
	    			"@type" => "ContactPoint", 
		    		"id" => array("valueOf" => "telephone")), ///????
	    		array(
	    			"name" => "jabber",
	    			"@type" => "ContactPoint", 
		    		"id" => array("valueOf" => "jabber")),
	    		array(
	    			"name" => "irc",
	    			"@type" => "ContactPoint", 
		    		"id" => array("valueOf" => "jabber")),
	    		array(
	    			"name" => "jabber",
	    			"@type" => "ContactPoint", 
		    		"id" => array("valueOf" => "jabber")),

	    ), 
	    "sameAs" => array(
	    	array(
	    		"name" => "Website",
		    	"id" => array("valueOf" => "url")),
	    	array(
	    	 	"name" => "Github",
		    	"id" => array("valueOf" => "socialNetwork.gitHubAccount")),
	    	array(
	    		"name" => "Twitter",
		    	"id" => array("valueOf" => "socialNetwork.twitterAccount")),
	    	array(
	    		"name" => "Facebook",
		    	"id" => array("valueOf" => "socialNetwork.facebookAccount")),
	    	array(
	    		"name" => "Google+",
		    	"id" => array("valueOf" => "socialNetwork.gplusAccount")),
	    	array(
	    		"name" => "LinkedIn",
		    	"id" => array("valueOf" => "socialNetwork.linkedInAccount")),
	    	array(
	    		"name" => "Skype",
		    	"id" => array("valueOf" => "socialNetwork.skypeAccount"))
	    ),
	    "cco:skill" => array("valueOf" => "positions"),
	    //"cco:habit" => array(),
	    "foaf:currentProject" => array( 
	    								"object" => "links.projects",
	    								"collection" => "projects" , 
	    								"valueOf" => array (
	    							   		"type" => "doap:Project",
	    							   		"id" => array(
	    							   			"valueOf" => '_id.$id',
	    							   			"type" 	=> "url", 
												"prefix"   => "/data/project/id/",
												"suffix"   => "/format/schema"
	    							   					),
	    							   		"name" => array("valueOf" => "name")
	    							   	) ),
	    "member" => array( 
							"object" => "links.memberOf",
							"collection" => "organizations" , 
							"valueOf" => array (
						   		"type" => "Organization",
						   		"id" => array(
						   			"valueOf" => '_id.$id',
						   			"type" 	=> "url", 
									"prefix"   => "/data/organization/id/",
									"suffix"   => "/format/schema"
						   					),
						   		"name" => array("valueOf" => "name")
						   	) ),
	    "attendeeIn" => array( 
							"object" => "links.events",
							"collection" => "events" , 
							"valueOf" => array (
						   		"type" => "Event",
						   		"id" => array(
						   			"valueOf" => '_id.$id',
						   			"type" 	=> "url", 
									"prefix"   => "/data/event/id/",
									"suffix"   => "/format/schema"
						   					),
						   		"name" => array("valueOf" => "name")
						   	) ),
	    //"visited" => array(),
	    //"seeks" => array(),
	    //"owns" => array(),
	    //"sec:publicKey" => array(),
	    //"subjectOf" => array()
	
	);

	/*

	----------------- ACTIVITY STREAM ----------------- 

	https://evanprodromou.example/profile

	{
	  "@context": "http://www.w3.org/ns/activitystreams",
	  "@type": "Person",
	  "@id": "https://evanprodromou.example/profile.html#me",
	  "displayName": "Evan Prodromou",
	  "alias": "eprodrom",
	  "summary": "Founder of Fuzzy.io. Past founder of Wikitravel and StatusNet. Founding CTO of Breather.",
	  "icon": {
	    "@type": "Image",
	    "url": "https://evanprodromou.example/avatar.png",
	    "width": 128,
	    "height": 128
	  },
	  "url": {
	      "@type": "Link",
	      "href": "https://evanprodromou.example/profile.html",
	      "mediaType": "text/html"
	  },
	  "location": {
	       "@type": "Place",
	       "displayName": "Montreal, Quebec, Canada"
	  }
	}*/
	public static $dataBinding_person_activityStream = array(
	    "name" => array("name" => "name"),
	);
	public static function convert($data,$bindMap)
	{
		$newData = array();
		foreach ($data as $keyID => $data) {
			if ( isset($data) ) {
				$newData[$keyID] = self::bindData($data,$bindMap);
			}
		}
		return $newData;
	}

	private static function bindData ( $data, $bindMap )
	{
		$newData = array();
		foreach ( $bindMap as $key => $bindPath ) 
		{
			if ( is_array( $bindPath ) && isset( $bindPath["valueOf"] ) ) 
			{
				/*if( $key == "@id")
					$newData["debug"] = strpos( $bindPath["valueOf"], ".");*/
				if( is_array( $bindPath["valueOf"] ))
				{
					
					//parse recursively for objects value types , ex links.projects
					if( isset($bindPath["object"]) )
					{
						$currentValue = ( strpos( $bindPath["object"], ".") > 0 ) ? self::getValueByPath( $bindPath["object"] ,$data ) : $data;
						$newData[$key] = array();
						//parse each entry of the list 
						foreach ( $currentValue as $dataKey => $dataValue) {
							$refData = $dataValue;
							//if a collection is set , we'll be fetching the data source of a reference object
							//we consider the key as the id
							if(isset($bindPath["collection"]))
								$refData = PHDB::findOne( $bindPath["collection"], array( "_id" => new MongoId( $dataKey ) ) );
							array_push($newData[$key], self::bindData( $refData, $bindPath["valueOf"] ) );
						}
					}
					//parse recursively for array value types, ex : address
					else if( isset($bindPath["parentKey"]) && isset( $data[ $bindPath["parentKey"] ] ) )
						$newData[$key] = self::bindData( $data[ $bindPath["parentKey"] ], $bindPath["valueOf"] );
					//resulting array has more than one level 
					else
						$newData[$key] = self::bindData( $data, $bindPath["valueOf"] );
				} 
				else if( strpos( $bindPath["valueOf"], ".") > 0 )
				{
					//the value is fetched deeply in the source data map
					$newData[$key] = self::getValueByPath( $bindPath["valueOf"] ,$data );
				}
				else if( isset( $data[ $bindPath[ "valueOf" ] ] )  )
				{
					//otherwise simply get the value of the requested element
					$newData[$key] = $data[ $bindPath["valueOf"] ];
				} 

			}  else if( is_array( $bindPath ))
				// there can be a first level with a simple key value
				// but can have following more than a single level 
				$newData[$key] = self::bindData( $data, $bindPath ) ;
			else
				// otherwise it's just a simple label element 
				$newData[$key] = $bindPath;

			//post processing once the data has been fetched
			if( isset($newData[$key]) && ( isset( $bindPath["type"] ) || isset( $bindPath["prefix"] ) || isset( $bindPath["suffix"] ) ) ) 
				$newData[$key] = self::formatValueByType( $newData[$key] , $bindPath );			
		}
		return $newData;
	}
	private static function bindDataRef( $key, $bindMap , $collection ){
		
		return self::bindData( $ref, $bindMap );
	}
	private static function getValueByPath( $path , $currentValue ){
		//The value is somewhere in an array position is definied in a json syntax
		//explode dot seperators
		$path = explode(".", $path);
		//follow path until the leaf value
		foreach ($path as $pathKey) 
		{	
			if( is_object($currentValue[ $pathKey ]) && get_class( $currentValue[ $pathKey ] ) == "MongoId" ){
				$currentValue = (string)$currentValue[ $pathKey ];
				break;
			} 
			else
				$currentValue = $currentValue[ $pathKey ];
		}
		return $currentValue;
	}

	private static function formatValueByType($val, $bindPath )
	{	
		//prefix and suffix can be added to anything
		$prefix = ( isset( $bindPath["prefix"] ) ) ? $bindPath["prefix"] : "";
		$suffix = ( isset( $bindPath["suffix"] ) ) ? $bindPath["suffix"] : "";
		
		if( isset( $bindPath["type"] ) && $bindPath["type"] == "url" )
		{
			$server = ((isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://').$_SERVER['HTTP_HOST'];
			$val = $server.Yii::app()->createUrl($prefix.$val.$suffix);
		} 
		else if( isset( $bindPath["prefix"] ) || isset( $bindPath["suffix"] ) )
		{
			$val = $prefix.$val.$suffix;
		}
		return $val;
	}

}