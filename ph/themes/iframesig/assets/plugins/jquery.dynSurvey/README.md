jquery.dynSurvey
------

light json based , schema oriented Survey generator based on jquery.dynForm
- jquery pluggin
- 100% javascript
- desciption based using json-schema.org
- Form validation
- bootstrap designed 
- 2 way dataBinding for Editing Forms (set form values)
- can write into any Json structure

Sample 
------
this is a first use case 
I'll come back with a more detailed  presentation 

```
var form1 = {
	    "jsonSchema" : {
	        "title" : "Open Data Form",
	        "type" : "object",
	        "properties" : {
	        	"separator1":{
	        		"title":"Form 1"
	        	},
	            "temp" : {
	                "inputType" : "text",
	                "placeholder" : "Température",
	                "rules" : {
						"required" : true
					}
	            },
	            "tempo" : {
	                "inputType" : "text",
	                "placeholder" : "Tempo",
	                "rules" : {
						"required" : true
					}
	            }
	            
	        }
	    },
	    "collection" : "smartcitizen",
	    "key" : "SCForm"
	};

var form2 = {
	    "jsonSchema" : {
	        "title" : "Open Data Form",
	        "type" : "object",
	        "properties" : {
	        	"separator1":{
	        		"title":"Form2"
	        	},
	            "hum" :{
	            	"inputType" : "text",
	            	"placeholder" : "Humidity"
	            }
	        }
	    },
	    
	};

var form3 = {
	    "jsonSchema" : {
	        "title" : "Open Data Form",
	        "type" : "object",
	        "properties" : {
	        	"separator1":{
	        		"title":"Form3"
	        	},
	            "toto" :{
	            	"inputType" : "text",
	            	"placeholder" : "TOto"
	            }
	        }
	    },
	    
	};


jQuery(document).ready(function() {
	
	/* **************************************
	*	Using the dynForm
	- declare a destination point
	- a formDefinition
	- the onLoad method
	- the onSave method
	***************************************** */
	var form = $.dynSurvey({
		surveyId : "#opendata",
		surveyObj : { 
			"section1":form1,
			"section2":form2,
			"section3":form3
		},
		collection : "smartcitizen",
	    key : "SCSurvey"
		//"savePath":"/ph/common/opendata"
	});

});
```

Stuff we used , and are thankfull to
- jquery 
- bootstrap 
- https://github.com/oceatoon/jquery.dynForm
- toastr
- blockui
- jquery-validation/dist/jquery.validate.min.js
- bootstrap-datepicker.js
- https://github.com/oceatoon/jsonHelpers
