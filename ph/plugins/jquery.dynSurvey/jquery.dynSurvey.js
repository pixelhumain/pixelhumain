/* **************************************

- add a form tag to your document
- define your dynForm with a jsonSchema defintion of each field input
- The process will then 
	- first build the specified HTML  for each different field and input according to types
   - bind any needed events according to types 
	- bind the save Process if needed 
   - apply any onLoad process

parameters : 
formId : is the <form> tag in the destination html
surveyObj: is the form object containg the form field definition and jsonSchema
surveyValues: contains the values if needed 
onLoad : (optional) is a function that is launched once the form has been created and written into the DOM 
onSave: (optional) overloads the generic saveProcess

***************************************** */
(function($) {
	"use strict";
	var thisBody = document.body || document.documentElement, 
	thisStyle = thisBody.style, 
	$this,
	survey,
	wizardContent,
	numberOfSteps,
	supportTransition = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
	
	/*$(subviewBackClass).on("click", function(e) {
		$.hideSubview();
		e.preventDefault();
	});*/

	$.extend({

		dynSurvey: function(options)
		{
			// extend the options from pre-defined values:
			var defaults = {
				surveyId : "", 
				surveyObj: {},
				surveyValues: {},
				onLoad : null,
				onSave: null,
				collection : "",
	    		key : "",
				savePath : '/ph/common/save'
			};

			var settings = $.extend({}, defaults, options);
			console.log(settings);
			$this = this;
			survey = settings.surveyObj;
			dySObj.navBtnAction = false;

			console.info("build Form dynamically into form tag : ",settings.surveyId);
			console.dir(settings.surveyObj);
			console.dir(settings.surveyValues);

			/* **************************************
			* BUILD FORM based on surveyObj
			***************************************** */
			var form = {
				rules : {}
			};
			
			/* **************************************
			* Smart Wizard HTMl init
			***************************************** */			
			var wizardHTML = '<div id="wizard" class="swMain">'+
			/* **************************************
			* Wizard Likns
			***************************************** */
				'<ul id="wizardLinks"></ul>'+
			/* **************************************
			* Progress BAr
			***************************************** */
				'<div class="progress progress-xs transparent-black no-radius active">'+
					'<div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar partition-green step-bar">'+
						'<span class="sr-only"> 0% Complete (success)</span>'+
					'</div>'+
				'</div>'+
			/* **************************************
			* Error Section
			***************************************** */
				'<div class="errorHandler alert alert-danger no-display">'+
					'<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.'+
				'</div>'
			'</div>';
			$(settings.surveyId).append(wizardHTML);

			var fieldHTML = '';
			var sectionIndex = 0;
			var lastSection = "";
			$.each(settings.surveyObj,function( sectionId ,sectionObj ) 
			{ 
				console.info("building section : ",sectionIndex ,sectionId);
				var sectionClass = (sectionIndex>0) ? "hide" : ""
				
				$("#wizard").append("<div id='"+sectionId+"' class='section"+sectionIndex+" "+sectionClass+"'></div>");
				
				var name = (sectionObj.dynForm.jsonSchema.title) ? sectionObj.dynForm.jsonSchema.title : "";
				var desc = (sectionObj.dynForm.jsonSchema.desc) ? sectionObj.dynForm.jsonSchema.desc : "";
				var wizardLinkHTML = '<li><a href="#'+sectionId+'"><div class="stepNumber">'+(sectionIndex+1)+'</div>'+
										'<span class="stepDesc"> '+name+
											'<br /><small>'+desc+'</small> </span>'+
									'</a></li>';
				$("#wizardLinks").append(wizardLinkHTML);

				//build each form for each wizard step
				var countProperties = 0;
				for( var key in sectionObj.dynForm.jsonSchema.properties ) {
						++countProperties;
    			}
				var inc=1;
				$.each(sectionObj.dynForm.jsonSchema.properties,function(field,fieldObj) { 
					if(fieldObj.rules)
						form.rules[field] = fieldObj.rules;
					console.log("////////SETTTINGSSSS///////");
					console.log(settings.surveyValues);
					dyFObj.buildInputField("#"+sectionId,field, fieldObj, settings.surveyValues,sectionObj.key);
					//Only the last section carries the submit button
					if( sectionIndex == Object.keys(settings.surveyObj).length-1 && countProperties==inc){
						fieldHTML = '<div class="form-actions">'+
									'<button type="submit" class="btn btn-green pull-right finish-step">'+
										'Enregistrer <i class="fa fa-arrow-circle-right"></i>'+
									'</button> '+
									' <a  href="javascript:;" class="btn-prev btn btn-blue pull-right back-step">'+
										'<i class="fa fa-arrow-circle-left"></i> Precedent'+
									'</a>'+
								'</div> ';
						$("#"+sectionId).append(fieldHTML);
					}
					else if(countProperties==inc)
					{
						fieldHTML = '<div class="form-actions">';
						fieldHTML += '<a href="javascript:;" class="btn-next btn btn-blue pull-right next-step">'+
										'Suivant <i class="fa fa-arrow-circle-right"></i>'+
									'</a> ';
						fieldHTML += (sectionIndex>0) ? ' <a href="javascript:;" class="btn-prev btn btn-blue pull-right back-step">'+
										'<i class="fa fa-arrow-circle-left"></i> Precedent</a> ' : "";
						fieldHTML += '</div> ';
						$("#"+sectionId).append(fieldHTML);
					}
					inc++;
						
				});
				sectionIndex++;
			})
			numberOfSteps = sectionIndex;
			/* **************************************
			* CONTEXT ELEMENTS, used for saving purposes
			***************************************** */
			fieldHTML = '<input type="hidden" name="key" value="'+settings.key+'"/>';
	        fieldHTML += '<input type="hidden" name="collection" value="'+settings.collection+'"/>';
	        fieldHTML += '<input type="hidden" name="id" value="'+((settings.id) ? settings.id : "")+'"/>';
	       	$(settings.surveyId).append(fieldHTML);

        	
	        

			/* **************************************
			* bind any events Post building 
			***************************************** */
			dyFObj.bindDynFormEvents(settings,form.rules);
			if(typeof (settings.onLoad) != "undefined")
				console.dir(settings.onLoad);
			if(settings.onLoad && jQuery.isFunction( settings.onLoad ) )
				settings.onLoad();
		    

			return form;
		}

	});
	
	
     
    
	
	

})(jQuery);

var dySObj = {
	navBtnAction : false,
	activeSection : 0,
	//contains the structured survey by sections
	survey : null,
	surveys : {},
	surveyId : null,
	/*
	use ajax to load the definition files
	name : unique key of the survey
	DSPath : can be null, or a url 
	type : script is needed if dynForm = {} 
	        otherwise json is enough json is directly at the root 
	*/
	getSurveyJson : function (name,DSPath,type,callback) {

	    console.log("getSurveyJson",name,DSPath,type);
	    dynForm = null;
	    dType = ( type ) ? type : "json";
	    if( jsonHelper.notNull( "dySObj.surveys."+name) ){
	    	dySObj.buildSurveySections(dySObj.surveys.json[name]);
	        dySObj.buildSurvey()    
	    }
	    else 
	    {
	        console.log( "getSurveyJson ajax", dType );
	        
	        $.ajax({
	          type: "GET",
	          url: DSPath,
	          dataType: dType
	        }).done( function(data){
	            if(dynForm) {
	            	console.log("getSurveyJson dynForm",name,dynForm);
	                // tmpO = {};
	                // tmpO[name] = dynForm;
	                dySObj.surveys[name] = dynForm;
	            }
	            else if (typeof data.json != "undefined"){
	            	console.log("getSurveyJson data.json",name,data.json);
	                dySObj.surveys[name] = data.json;
	            }
	            else {
	                console.log("getSurveyJson data["+name+"] ",data[name]);
	                dySObj.surveys[name] = data[name];
	            }
	            
	            if(typeof callback == "function")
	                callback(data[name]);
	            else {    
	            	dySObj.buildSurveySections(dySObj.surveys.json[name]); 
	                dySObj.buildSurvey();
	            }
	        });
	    }
	},
	//	binding validation events to the survey instance 
	bindSurvey : function (params, formRules) {
		/* **************************************
		* FORM VALIDATION and save process binding
		***************************************** */
		console.info("bindSurvey :: connecting submit btn to $.validate pluggin");
		console.dir(formRules);
		var errorHandler = $('.errorHandler', $(params.surveyId));
		$(params.surveyId).validate({

			rules : formRules,

			submitHandler : function(form) {
				errorHandler.hide();
				console.info("form submitted "+params.surveyId);
				if(params.onSave && jQuery.isFunction( params.onSave ) ){
					console.log(params.onSave);
					params.onSave(params);
					return false;
		        } 
		        else 
		        {
		        	toastr.info("default SaveProcess : "+params.savePath);
		        	console.info("default SaveProcess",params.savePath);
		        	console.dir($(params.surveyId).serializeFormJSON());
		        	$.ajax({
		        	  type: "POST",
		        	  url: params.savePath,
		        	  data: $(params.surveyId).serializeFormJSON(),
		              dataType: "json"
		        	}).done( function(data){
		                
		                if( afterDynBuildSave && typeof afterDynBuildSave == "function" )
		                    afterDynBuildSave(data.map,data.id);
		                console.info('saved successfully !');

		        	});
					return false;
			    }
			    
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});

		/* **************************************
		* WIZARD INIT
		***************************************** */
		wizardContent = $('#wizard');
		wizardContent.smartWizard({
            selected: 0,
            keyNavigation: false,
            //onLeaveStep: function(){ console.log("leaveAStepCallback");},
            onShowStep: function(obj, context)
            {
            	console.log("test onShowStep",dySObj.navBtnAction,context.toStep,context.fromStep,Math.abs( context.toStep - context.fromStep));
            	if( !dySObj.navBtnAction ){
	            	$(".section"+dySObj.activeSection).addClass("hide");
	            	dySObj.activeSection =  context.toStep -1 ;
					console.log("top wisard direct link",dySObj.activeSection);
					$(".section"+dySObj.activeSection).removeClass("hide");	
				}
				dySObj.activeSection =  context.toStep -1 ;
				dySObj.animateBar(dySObj.activeSection+1);
            },
        });
        dySObj.animateBar();

        /* **************************************
		* NEXT and BACK BUTTONS
		***************************************** */
		$('.btn-next').unbind("click").click(function()
		{
			if( dySObj.validateForm( dySObj.activeSection ) )
			{
				if(dySObj.surveys.sections["section"+(dySObj.activeSection+1)].type == "dynForm")
					alert("might have to save somehting here");
				$( ".section"+dySObj.activeSection ).addClass("hide");
				dySObj.activeSection++;
				console.log("btn-next",dySObj.activeSection);
				$( ".section"+dySObj.activeSection ).removeClass("hide");
				dySObj.navBtnAction = true;
				wizardContent.smartWizard("goForward");
				dySObj.navBtnAction = false;
				dySObj.animateBar(dySObj.activeSection+1);
				if( dySObj.surveys.sections["section"+dySObj.activeSection].onNext && jQuery.isFunction( dySObj.surveys.sections["section"+dySObj.activeSection].onNext ) )
					dySObj.surveys.sections["section"+dySObj.activeSection].onNext();
			}
		});

		$('.btn-prev').unbind("click").click(function()
		{
			$(".section"+dySObj.activeSection).addClass("hide");
			dySObj.activeSection--;
			console.log("btn-prev",dySObj.activeSection);
			$(".section"+dySObj.activeSection).removeClass("hide");	
			dySObj.navBtnAction = true;
			wizardContent.smartWizard("goBackward");
			dySObj.navBtnAction = false;
			dySObj.animateBar(dySObj.activeSection+1);
			if( dySObj.surveys.sections["section"+dySObj.activeSection].onPrev && jQuery.isFunction( dySObj.surveys.sections["section"+dySObj.activeSection].onPrev ) )
				dySObj.surveys.sections["section"+dySObj.activeSection].onPrev();
		});
	},
	// init the dynSurvey instance 
	buildSurvey : function () {  
		$("#surveyDesc").hide();
	    //alert("buildSurvey : "+surveyJson);
	    dySObj.survey = dySObj.surveys.sections;
	    var form = $.dynSurvey({
	        surveyId : dySObj.surveyId,
	        surveyObj : dySObj.surveys.sections,
	        surveyValues : {},
	        onLoad : function(){
	            //$(".description1, .description2, .description3, .description4, .description5, .description6").focus().autogrow({vertical: true, horizontal: false});
	        },
	        onSave : function(params) {
	            //console.dir( $(params.surveyId).serializeFormJSON() );
	            var result = {};
	            result[str]={};
	            console.log(params.surveyObj);
	            $.each( params.surveyObj,function(section,sectionObj) { 
	                result[str][sectionObj.key] = {};
	                console.log(sectionObj.dynForm.jsonSchema.properties);
	                $.each( sectionObj.dynForm.jsonSchema.properties,function(field,fieldObj) { 
	                    console.log(sectionObj.key+"."+field, $("#"+section+" #"+field).val() );
	                    if( fieldObj.inputType ){
	                        result[str][sectionObj.key][field] = {};
	                        result[str][sectionObj.key][field] = $("#"+section+" #"+field).val();
	                    }
	                });
	            });
	            console.dir( result );
	            $.ajax({
	              type: "POST",
	              url: params.savePath,
	              data: {},
	              dataType: "json"
	            }).done( function(data){
	                toastr.success("values well updated') ?>");
	            });
	        },
	        collection : "commonsChart",
	        key : "SCSurvey",
	        savePath : baseUrl+"/"+moduleId+"/co/edit"
	    });
	},
	// transfroms a list of dynform definitions into the needed survey structure
	buildSurveySections : function (){
	    console.log( "buildSurveySections" );
	    dySObj.surveys.sections={};
	    var i=1;
	    $.each(dySObj.surveys.json, function(e,form){
	    	var type = (dySObj.surveys.json[e].dynType) ? dySObj.surveys.json[e].dynType : "dynForm";
	        dySObj.surveys.sections["section"+i] = {dynForm : form, key : e,type : type};
	        i++;
	    });
	    return dySObj.surveys.sections;
	},
	//takes a full scenario defnition and :
	// builds & returns a survey Json
	buildOneSurveyFromScenario : function (scenario){
	    dySObj.surveys.json={};
	    var i=1;
	    //structure the survey json like a given survey
	    $.each( scenario, function(s,step){
	    	console.log( "buildOneSurveySectionsFromScenario step",s,step );
	    	if( step.json ){
	    		//this step allready has a survey definition 
	    		dynType = (step.dynType) ? step.dynType : "dynForm" ;
	    		$.each(step.json, function(e,form){
	    			dySObj.surveys.json[e] = form;
			        dySObj.surveys.json[e].dynType = dynType;
			    });
	    	} else if( step.path ){
	    		//ajax get form or survey
	    		dySObj.surveys.json[s]=null;
	    		dType = (step.type) ? step.type : "json" ;
                dynType = (step.dynType) ? step.dynType : "dynForm" ;

                path = moduleUrl+step.path;
		        //passing through survey/co/form controller
		        if(step.where == "db")
		            path = baseUrl+step.path;
		        //existing surveys in co2 module like co2/assets/js/dynform/dynsurvey.js
		        else if(step.where == "parentModuleUrl")
		            path = parentModuleUrl+step.path;

	    		dySObj.getSurveyJson ( s , path, dType, function() { 
	    			dySObj.surveys.json[s] = dySObj.surveys[s];
	    			dynType = (dySObj.surveys.scenario[s].dynType) ? dySObj.surveys.scenario[s].dynType : "dynForm" ;
	    			dySObj.surveys.json[s].dynType = dynType;
	    			if( dySObj.asyncSurveyLoadedCheck() )
	    				$("#startSurvey").removeClass("hidden");
	            } );

	    	} 
	    });
	    console.log( "buildOneSurveySectionsFromScenario",dySObj.surveys.json );
	    return dySObj.surveys.json;
	},
	// checks no empty dynforms in dySObj.surveys.json
	asyncSurveyLoadedCheck : function() {
		console.log( "asyncSurveyLoadedCheck",dySObj.surveys.json );
		res = true;
		$.each( dySObj.surveys.json, function(s,step) {
			if(step == null)
				res = false;
		});
		return res; 
	},
	openSurvey : function (key,type,dynType) { 
	    //$(".card-text,.card .btn").hide();
	    //alert(dynType);
	    console.log("openSurvey",key,type,dynType);
	    if(dynType == "oneSurvey"){
	    	dySObj.buildSurveySections(); 
	        dySObj.buildSurvey();
	    } else if(typeof dySObj.surveys.scenario[key].json == "object"){
	        console.warn("openSurvey :: get survey json exist");

	        if(dynType == "dynSurvey"){
	        	dySObj.buildSurveySections( dySObj.surveys.scenario[key].json );
	          	dySObj.buildSurvey();
	        }
	        else 
	            dyFObj.openForm( dySObj.surveys.scenario[key].json );

	    }
	    else if( dySObj.surveys.scenario[ key ].path ){

	        path = moduleUrl+dySObj.surveys.scenario[key].path;

	        //passing through survey/co/form controller
	        if(dySObj.surveys.scenario[ key ].where == "db")
	            path = baseUrl+dySObj.surveys.scenario[key].path;
	        //existing surveys in co2 module like co2/assets/js/dynform/dynsurvey.js
	        else if(dySObj.surveys.scenario[ key ].where == "parentModuleUrl")
	            path = parentModuleUrl+dySObj.surveys.scenario[key].path;
	        
	        if( dynType == "dynSurvey" ){
	            //surveys like surveys/assets/js/surveys/dynsurvey.js
	            console.warn("openSurvey :: get survey json by path", path);
	            dySObj.getSurveyJson ( key , path,type, function() { 
	            	dySObj.buildSurveySections( surveys[key] );
	                dySObj.buildSurvey();
	            } );
	            
	        }
	        else {
	            //existing forms connected to co2 
	            if( jsonHelper.notNull( "typeObj."+key) ){
	                console.warn("openSurvey:: get form by key",key);
	                dyFObj.openForm( key ); 
	            }
	            else 
	            { 
	                //forms defined elsewhere like surveys/assets/js/surveys/login.js
	                console.warn("openSurvey :: get form json by path",key,path);
	                dySObj.getSurveyJson ( key , path,type,function() {
	                    dyFObj.openForm( surveys[key] );
	                } );
	            }
	        }
	        
	    }
	},

	animateBar : function (val) {
    	console.log("animateBar");
        if ((typeof val == 'undefined') || val == "") {
            val = 1;
        };
        var valueNow = Math.floor(100 / $(".stepNumber").length * val);
        $('.step-bar').css('width', valueNow + '%');
    },

    // complete Form secion validations  
	validateForm : function  ( sectionIndex, surveyId ) { 
		console.log( "validateForm", sectionIndex, dySObj.surveyId );
		var counter = 0;
		var result = true;
		$.each( dySObj.survey , function( sectionId ,sectionObj ) 
		{ 
			console.log( "validateForm",sectionId, counter, sectionIndex );
			if( counter == sectionIndex )
			{
				console.dir(sectionObj.dynForm);
				$.each(sectionObj.dynForm.jsonSchema.properties , function(field,fieldObj) 
				{ 
					if( fieldObj.rules ){
						var res = $(dySObj.surveyId).validate().element("#"+field);
						if(!res)
							result = false;
					}
				});
			}
			counter++;
		});
		return result;
	}
}