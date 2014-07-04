CTOK : Citizen ToolKit 
===
	The modular (H)API driven architecture also called CTK : Citizen ToolKit 
	allows developpers to build efficiently citzen oriented application 
	starting with function point definitions, then building the corresponding API 
	and finally building the Front end on any device. 

	The project grows in time, by building all sorts of citizen oriented applications 
	based on a common code base : CTK 

	it is intended to be generic , semanticly standardised by ontologies of schema.org 
	linked by referenced data 

Api architecture 
===
	toutes les definitions de block mutualisés sont listés dans la classe Api.php
	dans une map unique : Api::$apis
	on peut faire des bouquets de fonction ou regroupements grace a des constructeur comme Api::getUserMap()
	chaque application qui a son ApiController peut alors utiliser une map generique, l'augmenter, ou en creer une specifique 
	les actions ou controller sont chargé dynamiquement basé sur ces definitions

Application Developpement Best practise
===
	when building apps in test mode use application specific information like email:myapp@myapp.com
	this it'll be easy to extract 
	if your data is part of a common table simple add a applications.myapp node 
	this node can contain any application specific information

Admin users 
===
	The api interface is retricted just like a back office for admin credentials
	there are 2 types of admin credentials 
		application level admin 
			these users carry a applications.myapp.isAdmin:true node on their account's json
			are considered as admin user only for the applications called myapp
		full phAdmin 
			these users carry an isAdmin:true node on their account's json
			they have access to all applications 

Application specifications
===
	creating a new applications 
		there must be an entry in the applications collections
		it will carry all details and specifications for the app to run 
		the system will and can get attributes from this entry 
		declare the module in the protected/config/moduleconfig.php 

InitData process and architecture
===
	any application might need bootstrap datasets to be able to run properly 
	simply create a /data folder 
	inside add all your datasets like this 
		filenames must be the destination collections name : ex : citoyens.json
		inside they must contain an array list of json entries 
	in the applications api you'll find an adminPH section listing all the files available for initialisation 
	click "initialize data" 

