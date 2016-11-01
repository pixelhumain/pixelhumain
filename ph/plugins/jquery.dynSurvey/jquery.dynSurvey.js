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
	initValues = {},
	activeSection = 0,
	wizardContent,numberOfSteps,navBtnAction,
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
			$this = this;
			survey = settings.surveyObj;
			navBtnAction = false;

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
					buildInputField("#"+sectionId,field, fieldObj, settings.surveyValues,sectionObj.key);
					//Only the last section carries the submit button
					if( sectionIndex == Object.keys(settings.surveyObj).length-1 && countProperties==inc){
						fieldHTML = '<div class="form-actions">'+
									'<button type="submit" class="btn btn-green pull-right finish-step">'+
										'Submit <i class="fa fa-arrow-circle-right"></i>'+
									'</button> '+
									' <a  href="javascript:;" class="btn-prev btn btn-blue pull-right back-step">'+
										'<i class="fa fa-arrow-circle-left"></i> Prev'+
									'</a>'+
								'</div> ';
						$("#"+sectionId).append(fieldHTML);
					}
					else if(countProperties==inc)
					{
						fieldHTML = '<div class="form-actions">';
						fieldHTML += '<a href="javascript:;" class="btn-next btn btn-blue pull-right next-step">'+
										'Next <i class="fa fa-arrow-circle-right"></i>'+
									'</a> ';
						fieldHTML += (sectionIndex>0) ? ' <a href="javascript:;" class="btn-prev btn btn-blue pull-right back-step">'+
										'<i class="fa fa-arrow-circle-left"></i> Prev</a> ' : "";
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
			bindDynFormEvents(settings,form.rules);

			if(settings.onLoad && jQuery.isFunction( settings.onLoad ) )
				settings.onLoad();
		    

			return form;
		}

	});
	
	/* **************************************
	*
	*	each input field type has a corresponding HTMl to build
	*
	***************************************** */
	function buildInputField(id, field, fieldObj,surveyValues,key)
	{
		var fieldHTML = '<div class="form-group '+field+fieldObj.inputType+'">';
		var required = "";
		if(fieldObj.rules && fieldObj.rules.required)
			required = "*";

		if(fieldObj.label)
			fieldHTML += '<label class=" control-label" for="'+field+'">'+
                fieldObj.label+required+
            '</label>';

        var iconOpen = (fieldObj.icon) ? '<span class="input-icon">'   : '';
        var iconClose = (fieldObj.icon) ? '<i class="'+fieldObj.icon+'"></i> </span>' : '';
        var placeholder = (fieldObj.placeholder) ? fieldObj.placeholder+required : '';
        var placeholder2 = (fieldObj.placeholder2) ? fieldObj.placeholder2 : '';
        var fieldClass = (fieldObj.class) ? fieldObj.class : '';
        var initField = '';
        var value = "";
        var style = "";
        if( fieldObj.value ) 
        	value = fieldObj.value;
        else if (surveyValues && surveyValues[key][field]) 
        	value = surveyValues[key][field];

        /* **************************************
		* 
		***************************************** */
        if( field.indexOf("separator")>=0 ) {
        	if(fieldClass == '' ) 
        		fieldClass = "panel-blue";
        	fieldHTML += '<div class="text-large text-bold '+fieldClass+' text-white center padding-10 ">'+iconOpen+iconClose+fieldObj.title+'</div>';
        }
        
        /* **************************************
		* STANDARD TEXT INPUT
		***************************************** */
        else if( !fieldObj.inputType || fieldObj.inputType == "text" || fieldObj.inputType == "numeric" || fieldObj.inputType == "tags" ) {
        	
        	if(fieldObj.inputType == "tags"){
        		fieldClass += " select2TagsInput";
        		initValues[field] = fieldObj.values;
        		style = "style='width:100%'"
        	}
        	fieldHTML += iconOpen+'<input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'" '+style+'/>'+iconClose;
        }
        /* **************************************
		* HIDDEN
		***************************************** */
        else if( fieldObj.inputType == "hidden" || fieldObj.inputType == "timestamp" ) {
        	if ( fieldObj.inputType == "timestamp" )
        		value = Date.now();
        	fieldHTML += '<input type="hidden" name="'+field+'" id="'+field+'" value="'+value+'"/>';
        }
        /* **************************************
		* TEXTAREA
		***************************************** */
        else if ( fieldObj.inputType == "textarea" || fieldObj.inputType == "wysiwyg" ){ 
        	if(fieldObj.inputType == "wysiwyg")
        		fieldClass += " wysiwygInput";
        	fieldHTML += '<textarea id="'+field+'" class="form-control '+fieldClass+'" name="'+field+'" placeholder="'+placeholder+'">'+value+'</textarea>';
        }
        /* **************************************
		* CHECKBOX
		***************************************** */
        else if ( fieldObj.inputType == "checkbox" ) {
        	if(value == "")
        		value="25/01/2014";
        	fieldHTML += '<input type="checkbox" class="'+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'"/> '+placeholder;
        }

        /* **************************************
		* SELECT , we use select2
		***************************************** */
        else if ( fieldObj.inputType == "select" || fieldObj.inputType == "selectMultiple" ) {
	        console.log(value);
        	var multiple = (fieldObj.inputType == "selectMultiple") ? 'multiple="multiple"' : '';
        	fieldHTML += '<select class="select2Input '+fieldClass+'" '+multiple+' name="'+field+'" id="'+field+'" style="width: 100%;height:30px">';
        			if(value=="")
        				fieldHTML += '<option value="" selected="selected">'+placeholder+'</option>';
        			//else
        			//	fieldHTML += '<option value="'+value+'" selected="selected">'+fieldObj.options[value]+'</option>';
			$.each(fieldObj.options, function(optKey, optVal) { 
				if(value != "" && optKey == value)
					fieldHTML += '<option value="'+value+'" selected="selected">'+fieldObj.options[value]+'</option>';
				else
					fieldHTML += '<option value="'+optKey+'">'+optVal+'</option>';
			});	
			fieldHTML += '</select>';
        }

        /* **************************************
		* DATE INPUT , we use bootstrap-datepicker
		***************************************** */
        else if ( fieldObj.inputType == "date" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014";
        	fieldHTML += iconOpen+'<input type="text" class="form-control dateInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* DATE RANGE INPUT 
		***************************************** */
        else if ( fieldObj.inputType == "daterange" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014";
        	fieldHTML += iconOpen+'<input type="text" class="form-control daterangeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* TIME INPUT , we use 
		***************************************** */
        else if ( fieldObj.inputType == "time" ) {
        	if(placeholder == "")
        		placeholder="20:30";
        	fieldHTML += iconOpen+'<input type="text" class="form-control timeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* LINK
		***************************************** */
        else if ( fieldObj.inputType == "link" ) {
        	if(fieldObj.url.indexOf("http://") < 0 )
        		fieldObj.url = "http://"+fieldObj.url;
        	fieldHTML += '<a class="btn btn-primary '+fieldClass+'" href="'+fieldObj.url+'">Go There</a>';
        } 

        /* **************************************
		* ARRAY , is a list of sequential values
		***************************************** */
        else if ( fieldObj.inputType == "array" ) {
        	fieldHTML += '<div class="inputs array">'+
								'<div class="col-sm-10">'+
									'<input type="text" name="properties[]" class="addmultifield form-control input-md" value="" placeholder="'+placeholder+'"/>'+
								'</div>'+
								'<div class="col-sm-2">'+
									'<button data-id="'+field+fieldObj.inputType+'" class="removePropLineBtn btn btn-xs btn-blue" alt="Remove this line"><i class=" fa fa-minus-circle" ></i></button>'+
								'</div>'+
							'</div>'+
							'<span class="form-group '+field+fieldObj.inputType+'Btn">'+
							'<div class="col-sm-12">'+
								'<div class="space10"></div>'+
						        '<a href="javascript:;" data-id="'+field+fieldObj.inputType+'" class="addPropBtn btn btn-xs btn-blue" alt="Add a line"><i class=" fa fa-plus-circle" ></i></button> '+
				       		'</div></span>'+
				       '<div class="space5"></div>';
			initField = initMultiFields;
        }

        /* **************************************
		* PROPERTIES , is a list of pairs key/values
		***************************************** */
        else if ( fieldObj.inputType == "properties" ) {
        	fieldHTML += '<div class="inputs properties">'+
								'<div class="col-sm-3">'+
									'<input type="text" name="properties[]" class="addmultifield form-control input-md" value="" placeholder="'+placeholder+'"/>'+
								'</div>'+
								'<div class="col-sm-7">'+
									'<textarea type="text" name="values[]" class="addmultifield1 form-control input-md pull-left" onkeyup="AutoGrowTextArea(this);"  placeholder="'+placeholder2+'"></textarea>'+
									'<button data-id="'+field+fieldObj.inputType+'" class="pull-right removePropLineBtn btn btn-xs btn-blue" alt="Remove this line"><i class=" fa fa-minus-circle" ></i></button>'+
								'</div>'+
							'</div>'+
							'<span class="form-group '+field+fieldObj.inputType+'Btn">'+
							'<div class="col-sm-12">'+
								'<div class="space10"></div>'+
						        '<a href="javascript:;" data-id="'+field+fieldObj.inputType+'" class="addPropBtn btn btn-xs btn-blue" alt="Add a line"><i class=" fa fa-plus-circle" ></i></button> '+
				       		'</div></span>'+
				       '<div class="space5"></div>';
			initField = initMultiFields;
        }

        /* **************************************
		* CUSTOM 
		***************************************** */
        else if ( fieldObj.inputType == "custom" ) {
        	fieldHTML += fieldObj.html;
        } 
 

        else 
        	fieldHTML += iconOpen+'<input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        
		fieldHTML += '</div>';

		$(id).append(fieldHTML);

		if( fieldObj.init && $.isFunction(fieldObj.init) )
        	fieldObj.init(field+fieldObj.inputType);
        else if(initField && $.isFunction(initField) )
        	initField ('.'+field+fieldObj.inputType);
	}
	

	/* **************************************
	*	any event to be initiated 
	***************************************** */
	var afterDynBuildSave = null;
	function bindDynFormEvents (params, formRules) {  

		/* **************************************
		* FORM VALIDATION and save process binding
		***************************************** */
		console.info("connecting submit btn to $.validate pluggin");
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
            	console.log("test onShowStep",navBtnAction,context.toStep,context.fromStep,Math.abs( context.toStep - context.fromStep));
            	if( !navBtnAction ){
	            	$(".section"+activeSection).addClass("hide");
	            	activeSection =  context.toStep -1 ;
					console.log("top wisard direct link",activeSection);
					$(".section"+activeSection).removeClass("hide");	
				}
				activeSection =  context.toStep -1 ;
				animateBar(activeSection+1);
            },
        });
        animateBar();

        /* **************************************
		* NEXT and BACK BUTTONS
		***************************************** */
		$('.btn-next').unbind("click").click(function()
		{
			if( validateForm( activeSection ) )
			{
				$( ".section"+activeSection ).addClass("hide");
				activeSection++;
				console.log("btn-next",activeSection);
				$( ".section"+activeSection ).removeClass("hide");
				navBtnAction = true;
				wizardContent.smartWizard("goForward");
				navBtnAction = false;
				animateBar(activeSection+1);
				if( survey["section"+activeSection].onNext && jQuery.isFunction( survey["section"+activeSection].onNext ) )
					survey["section"+activeSection].onNext();
			}
		});

		$('.btn-prev').unbind("click").click(function()
		{
			$(".section"+activeSection).addClass("hide");
			activeSection--;
			console.log("btn-prev",activeSection);
			$(".section"+activeSection).removeClass("hide");	
			navBtnAction = true;
			wizardContent.smartWizard("goBackward");
			navBtnAction = false;
			animateBar(activeSection+1);
			if( survey["section"+activeSection].onPrev && jQuery.isFunction( survey["section"+activeSection].onPrev ) )
				survey["section"+activeSection].onPrev();
		});

		console.info("connecting any specific input event select2, datepicker...");
		/* **************************************
		* SELECTs , we use https://github.com/select2/select2
		***************************************** */
		if( $(".select2Input").length)
		{
			if( jQuery.isFunction(jQuery.fn.select2) )
				$(".select2Input").select2();
			else
				console.error("select2 library is missing");
		} 
		if( $(".select2TagsInput").length){
			if( jQuery.isFunction(jQuery.fn.select2) )
				$.each($(".select2TagsInput"),function () { 

					//console.log("id xxxxxxxxxxxxxxxxx ",$(this).attr("id"),initValues[$(this).attr("id")]);
					$(this).removeClass("form-control").select2({
					  "tags": initValues[$(this).attr("id")],
					  "tokenSeparators": [',', ' ']
					});
				 });
				
			else
				console.error("select2 library is missing");
		} 
		/* **************************************
		* DATE INPUT , we use https://github.com/eternicode/bootstrap-datepicker
		***************************************** */
		if(  $(".dateInput").length){
			if( jQuery.isFunction(jQuery.fn.datepicker) )
				$(".dateInput").datepicker({ 
			        autoclose: true,
			        language: "fr",
			        format: "dd/mm/yy"
			    });
		    else
				console.error("datepicker library is missing");
		}

		/* **************************************
		* DATE RANGE INPUT , we use https://github.com/dangrossman/bootstrap-daterangepicker
		***************************************** */
		if( $(".daterangeInput").length){
			if( jQuery.isFunction(jQuery.fn.daterangepicker) )
				$('#reservationtime').daterangepicker({
		            timePicker: true,
		            timePickerIncrement: 30,
		            format: 'MM/DD/YYYY h:mm A'
		          }, function(start, end, label) {
		            console.log(start.toISOString(), end.toISOString(), label);
		          });
			else
				console.error("daterangepicker library is missing")
		    /*$('.daterangeInput').val(moment().format('DD/MM/YYYY h:mm A') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY h:mm A'))
			.daterangepicker({  
				startDate: moment(),
				endDate: moment().add('days', 1),
				timePicker: true, 
				timePickerIncrement: 30, 
				format: 'DD/MM/YYYY h:mm A' 
			});*/
		}

		
		/* **************************************
		* PROPERTIES 
		***************************************** */
		if(  $(".addmultifield").length )
		{
			if(  $(".addmultifield1").length )
				$('head').append('<style type="text/css">.inputs textarea.addmultifield1{width:90%; height:34px;}</style>');
			$('.addPropBtn').unbind("click").click(function()
			{ 
				var field = $(this).data('id');
				if( $('.'+field+' .inputs .addmultifield:visible').length==0 || ( $("."+field+" .addmultifield:last").val() != "" && $( "."+field+" .addmultifield1:last" ).val() != "") )
					addfield('.'+field);
				else
					toastr.info("please fill properties first");
			} );
		}

		/* **************************************
		* WYSIWYG 
		***************************************** */
		if(  $(".wysiwygInput").length )
		{
			$(".wysiwygInput").summernote({

				oninit: function() {
					/*if ($(this).code() == "" || $(this).code().replace(/(<([^>]+)>)/ig, "") == "") {
						$(this).code($(this).attr("placeholder"));
					}*/
				}, onfocus: function(e) {
					/*if ($(this).code() == $(this).attr("placeholder")) {
						$(this).code("");
					}*/
				}, onblur: function(e) {
					/*if ($(this).code() == "" || $(this).code().replace(/(<([^>]+)>)/ig, "") == "") {
						$(this).code($(this).attr("placeholder"));
					}*/
				}, onkeyup: function(e) {},
				toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				]
			});
		}
	}

    var animateBar = function (val) {
    	console.log("animateBar");
        if ((typeof val == 'undefined') || val == "") {
            val = 1;
        };
        var valueNow = Math.floor(100 / $(".stepNumber").length * val);
        $('.step-bar').css('width', valueNow + '%');
    };  
    
	/* **************************************
	*	complete Form secion validations
	***************************************** */
	function validateForm ( sectionIndex ) 
	{ 
		console.log( "validateForm", sectionIndex, survey );
		var counter = 0;
		var result = true;
		$.each( survey , function( sectionId ,sectionObj ) 
		{ 
			console.log( "validateForm",sectionId, counter, sectionIndex );
			if( counter == sectionIndex )
			{
				console.dir(sectionObj.dynForm);
				$.each(sectionObj.dynForm.jsonSchema.properties , function(field,fieldObj) 
				{ 
					if( fieldObj.rules ){
						var res = $("#opendata").validate().element("#"+field);
						if(!res)
							result = false;
					}
				});
			}
			counter++;
		});
		return result;
	}

	/* **************************************
	*
	*	specific methods for each type of input
	*
	***************************************** */
	/* **************************************
	* PROPERTIES , is a list of pairs key/values
	***************************************** */
	function addfield(parentContainer) 
	{
		console.log("addfield",parentContainer);
		if(!$.isEmptyObject($(parentContainer+' .inputs')))
	    {
	    	if($(parentContainer+' .properties').length > 0)
	    		$(propertyLineHTML( {"label":"","value":""} ) ).fadeIn('slow').appendTo(parentContainer+' .inputs');
	    	else
	    		$(arrayLineHTML("") ).fadeIn('slow').appendTo(parentContainer+' .inputs');
	        $(parentContainer+' .addmultifield:last').focus();
	        initMultiFields(parentContainer);
	    }else 
	    	console.error("container doesn't seem to exist : "+parentContainer+' .inputs');
	}
	

	function initMultiFields(parentContainer){
		console.log("initMultiFields",parentContainer);
	  $(parentContainer+' .addmultifield').unbind('keydown').keydown(function(event) 
	  {
	  	if ( event.keyCode == 13)
	    {
			event.preventDefault();
	        if( $(this).val() != ""){
	        	if( $( this ).parent().next().children(".addmultifield1").val() != "" )
	        		addfield(parentContainer);
	        	else 
	        		$( this ).parent().next().children(".addmultifield1").focus();
	        } 
	        else
	        	toastr.warning("La paire (clef/valeure) doit etre remplie.");
	    }
	  });

	  $(parentContainer+' .addmultifield1').unbind('keydown').keydown(function(event) 
	  {
	  	if ( event.ctrlKey &&  event.keyCode == 13)
	    {
			event.preventDefault();
	        if( $(this).val() != "" && $( this ).parent().prev().children(".addmultifield").val() != "" )
	        	addfield(parentContainer);
	        else
	        	toastr.warning("La paire (clef/valeure) doit etre remplie.");
	    }
	  }); 

	  $(parentContainer+' .removePropLineBtn').click(function(){
	  	$(this).parent().prev().remove();
	  	$(this).parent().remove();
	  });

	}

	function clearProperties(where)
	{
		$("#ajaxSV "+where+" .inputs").html("");
		propertyLineHTML( {"label":"","value":""} );
	}

	function propertyLineHTML(propVal)
	{
		var str = '<div class="space5"></div><div class="col-sm-3">'+
					'<input type="text" name="properties[]" class="addmultifield form-control input-md" value="'+propVal.label+'" />'+
				'</div>'+
				'<div class="col-sm-7">'+
					'<textarea type="text" name="values[]" class="addmultifield1 form-control input-md pull-left" onkeyup="AutoGrowTextArea(this);" placeholder="valeur"   >'+propVal.value+'</textarea>'+
					'<button class="pull-right removePropLineBtn btn btn-xs btn-blue tooltips pull-right" data- data-original-title="Retirer cette ligne" data-placement="bottom"><i class=" fa fa-minus-circle" ></i></button>'+
				'</div>';
		return str;
	}
	function arrayLineHTML(val)
	{
		var str = '<div class="space5"></div><div class="col-sm-10">'+
					'<input type="text" name="properties[]" class="addmultifield form-control input-md" value="'+val+'"/>'+
					'</div>'+
					'<div class="col-sm-2">'+
					'<button class="pull-right removePropLineBtn btn btn-xs btn-blue tooltips pull-left" data- data-original-title="Retirer cette ligne" data-placement="bottom"><i class=" fa fa-minus-circle" ></i></button>'+
				'</div>';
		return str;
	}
	
	function drawPropertiesForm(list,where)
	{
		propHTML = "";
		$.each( list , function(propKey,propVal){
			propHTML += propertyLineHTML(propVal);
		});
		//console.info("editPerimeter",propHTML);
		if(propHTML != "")
			$("#ajaxSV "+where+" .inputs").html(propHTML);
	}

	

})(jQuery);

$.fn.serializeFormJSON = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/* **************************************
* PROPERTIES functions called externally
***************************************** */
// here's our click function for when the forms submitted
function getPairs(parentContainer)
{
	//console.log("getPairs",parentContainer);
    var properties = {};
    $.each($(parentContainer+' .addmultifield'), function(i,el) {
    	if( $(this).val() != "" && $( this ).parent().next().children(".addmultifield1") != "" ){
	        properties[ slugify($(this).val()) ] = { "label" : $(this).val(),
	        										  "value" : $( this ).parent().next().children(".addmultifield1").val()};
	    }
    });
    //console.dir("getPairs",properties);
    return properties;
}

function getArray(parentContainer)
{
	//console.log("getArray",parentContainer);
    var list = [];
    $.each($(parentContainer+' .addmultifield'), function(i,el) {
    	if( $(this).val() != ""  ){
	        list.push( $(this).val() );
	    }
    });
    //console.dir("getArray",list);
    return list;
}

function AutoGrowTextArea(textField)
{
  if (textField.clientHeight < textField.scrollHeight)
  {
    textField.style.height = textField.scrollHeight + "px";
    if (textField.clientHeight < textField.scrollHeight)
    {
      textField.style.height = 
        (textField.scrollHeight * 2 - textField.clientHeight) + "px";
    }
  }
}

function slugify (value) {    
	var rExps=[
	{re:/[\xC0-\xC6]/g, ch:'A'},
	{re:/[\xE0-\xE6]/g, ch:'a'},
	{re:/[\xC8-\xCB]/g, ch:'E'},
	{re:/[\xE8-\xEB]/g, ch:'e'},
	{re:/[\xCC-\xCF]/g, ch:'I'},
	{re:/[\xEC-\xEF]/g, ch:'i'},
	{re:/[\xD2-\xD6]/g, ch:'O'},
	{re:/[\xF2-\xF6]/g, ch:'o'},
	{re:/[\xD9-\xDC]/g, ch:'U'},
	{re:/[\xF9-\xFC]/g, ch:'u'},
	{re:/[\xC7-\xE7]/g, ch:'c'},
	{re:/[\xD1]/g, ch:'N'},
	{re:/[\xF1]/g, ch:'n'} ];

	// converti les caractères accentués en leurs équivalent alpha
	for(var i=0, len=rExps.length; i<len; i++)
	value=value.replace(rExps[i].re, rExps[i].ch);

	// 1) met en bas de casse
	// 2) remplace les espace par des tirets
	// 3) enleve tout les caratères non alphanumeriques
	// 4) enlève les doubles tirets
	return value.toLowerCase()
	.replace(/\s+/g, '-')
	.replace(/[^a-z0-9-]/g, '')
	.replace(/\-{2,}/g,'-');
};
