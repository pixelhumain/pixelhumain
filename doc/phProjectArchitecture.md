Stantard Pixel Humain Project Architecture

this document desccribes the architecture 
and setup of dev.pixelhumain.com
for the project egpc


you can access the project front end using 
http://dev.pixelhumain.com/egpc

you can also access as Restricted Area
http://dev.pixelhumain.com/egpc/api

CITIZEN TOOLKIT 
===========
the egpc project uses the pixelhumain as the core code
it's a standard Yii project Architecture 
installed here 
/dev.pixelhumain.com 
	/ph
		/protected 
			/images
			/css
			/js
			/controllers
			/models
			/views
		/tests
		/themes
anything in here is shared by all projects
and must be edited / modifer with care 
knowing it can have impact on many projects 
TODO : Continuous Integration and Unit Tests

CITIZEN PROJECTS
===========
we use the citizen toolkit to build all sorts of citizen projects
projects is externalised , ex for egpc
/qa.modules/egpc 

PROJECT STRUCTURE (file system)
===========
all pixelhumain projects have the same structure 
/controllers
	Manage all URLs
	The Front End Urls are defined in the controller Defaultcontroller.php
	The Back End Urls are defined in the controller Apicontroller.php
/views 
	Manage all views  
/data
	Contains init DAta for this project to run properly
	can be accessed as admin from the API interface
/assets
	/img
	/css
	/js
	Contains any assets specific to this project 

THEMES , DESIGN or LOOK & FEEL (file system)
===========
some projects will have their own look & feel & design 
in Yii these are called themes and are available under 
/ph
	/themes
		/ph-dori (default)
		/onePageApp
			/assets
			/views
				/layouts
					main.php
					nav.php
			Contains anything shared globaly when using this theme