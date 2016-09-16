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
formObj: is the form object containg the form field definition and jsonSchema
formValues: contains the values if needed 
onLoad : (optional) is a function that is launched once the form has been created and written into the DOM 
onSave: (optional) overloads the generic saveProcess

***************************************** */
(function($) {
	"use strict";
	var thisBody = document.body || document.documentElement, 
	thisStyle = thisBody.style, 
	$this,
	initValues = {},
	supportTransition = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
	
	/*$(subviewBackClass).on("click", function(e) {
		$.hideSubview();
		e.preventDefault();
	});*/

	$.extend({

		dynForm: function(options)
		{
			// extend the options from pre-defined values:
			var defaults = {
				formId : "", 
				formObj: {},
				formValues: {},
				onLoad : null,
				onSave: null,
				savePath : '/ph/common/save'
			};

			var settings = $.extend({}, defaults, options);
			$this = this;

			console.info("build Form dynamically into form tag : ",settings.formId);
			console.dir(settings.formObj);

			/* **************************************
			* BUILD FORM based on formObj
			***************************************** */
			var form = {
				rules : {}
			};
			var fieldHTML = '';

			/* **************************************
			* Error Section
			***************************************** */
			var errorHTML = '<div class="errorHandler alert alert-danger no-display">'+
							'<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.'+
						'</div>';
			$(settings.formId).append(errorHTML);

			$.each(settings.formObj.jsonSchema.properties,function(field,fieldObj) { 

				if(fieldObj.rules)
					form.rules[field] = fieldObj.rules;//{required:true}
				
				buildInputField(settings.formId,field, fieldObj, settings.formValues);
			});
			
			/* **************************************
			* CONTEXT ELEMENTS, used for saving purposes
			***************************************** */
			fieldHTML = '<input type="hidden" name="key" value="'+settings.formObj.key+'"/>';
	        fieldHTML += '<input type="hidden" name="collection" value="'+settings.formObj.collection+'"/>';
	        fieldHTML += '<input type="hidden" name="id" value="'+((settings.formObj.id) ? settings.formObj.id : "")+'"/>';
	       
        	fieldHTML += '<div class="form-actions">'+
        				'<div class="space20"></div>'+
						'<button id="btn-submit-form" type="submit" class="btn btn-success pull-right">'+
							'Valider <i class="fa fa-arrow-circle-right"></i>'+
						'</button>'+
					'</div>';

	        $(settings.formId).append(fieldHTML);

			/* **************************************
			* bind any events Post building 
			***************************************** */
			bindDynFormEvents(settings,form.rules);

			if(settings.onLoad && jQuery.isFunction( settings.onLoad ) )
				settings.onLoad();
		    
			return form;
		},

		/*buildForm: function() { 
			console.dir($this.formObj);
		},*/

	});
	
	/* **************************************
	*
	*	each input field type has a corresponding HTMl to build
	*
	***************************************** */
	function buildInputField(id, field, fieldObj,formValues)
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
        else if (formValues && formValues[field]) 
        	value = formValues[field];

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
        else if( !fieldObj.inputType || 
        		  fieldObj.inputType == "text" || 
        		  fieldObj.inputType == "numeric" || 
        		  fieldObj.inputType == "tags" ) {
        	if(fieldObj.inputType == "tags")
        	{
        		fieldClass += " select2TagsInput";
        		if(fieldObj.values){
        			if(!initValues[field])
        				initValues[field] = {};
        			initValues[field]["tags"] = fieldObj.values;
        		}
        		style = "style='width:100%'";
        	}
        	fieldHTML += iconOpen+'<input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'" '+style+'/>'+iconClose;
        }
        
        /* **************************************
		* HIDDEN
		***************************************** */
        else if( fieldObj.inputType == "hidden" || fieldObj.inputType == "timestamp" ) {
        	if ( fieldObj.inputType == "timestamp" )
        		value = Date.now();
        	console.log("build a >>>>>> hidden, timestamp");
        	fieldHTML += '<input type="hidden" name="'+field+'" id="'+field+'" value="'+value+'"/>';
        }
        /* **************************************
		* TEXTAREA
		***************************************** */
        else if ( fieldObj.inputType == "textarea" || fieldObj.inputType == "wysiwyg" ){ 
        	if(fieldObj.inputType == "wysiwyg")
        		fieldClass += " wysiwygInput";
        	console.log("build a >>>>>> textarea, wysiwyg");
        	fieldHTML += '<textarea id="'+field+'" class="form-control textarea '+fieldClass+'" name="'+field+'" placeholder="'+placeholder+'">'+value+'</textarea>';
        }
        /* **************************************
		* CHECKBOX
		***************************************** */
        else if ( fieldObj.inputType == "checkbox" ) {
   			if(value == "") value="25/01/2014";
	       	var checked = ( fieldObj.checked ) ? "checked" : "";
	       	var onclick = ( fieldObj.onclick ) ? "onclick='"+fieldObj.onclick+"'" : "";
	       	var switchData = ( fieldObj.switch ) ? "data-on-text='"+fieldObj.switch.onText+"' data-off-text='"+fieldObj.switch.offText+"' data-label-text='"+fieldObj.switch.labelText+"' " : "";
	       	console.log("build a >>>>>> checkbox");
	       	fieldHTML += '<input type="checkbox" class="'+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" '+checked+' '+onclick+' '+switchData+'/> '+placeholder;
	       	initField = function(){
	       		if( fieldObj.switch )
	       			initbootstrapSwitch('#'+field, (fieldObj.switch.onChange) ? fieldObj.switch.onChange : null );
	       	};
       	}


        /* **************************************
		* SELECT , we use select2
		***************************************** */
        else if ( fieldObj.inputType == "select" || fieldObj.inputType == "selectMultiple" ) {
       		var multiple = (fieldObj.inputType == "selectMultiple") ? 'multiple="multiple"' : '';
       		console.log("build a >>>>>> select selectMultiple");
       		fieldHTML += '<select class="select2Input '+fieldClass+'" '+multiple+' name="'+field+'" id="'+field+'" style="width: 100%;height:30px" data-placeholder="'+placeholder+'">';
			fieldHTML += '<option></option>';

			var selected = "";
			
			//initialize values
			$.each(fieldObj.options, function(optKey, optVal) {
				selected = ( fieldObj.value && optKey == fieldObj.value ) ? "selected" : ""; 
				fieldHTML += '<option value="'+optKey+'" '+selected+'>'+optVal+'</option>';
			});
			fieldHTML += '</select>';
        }

        
        
        else if ( fieldObj.inputType == "image" ) {
        	if(placeholder == "")
        		placeholder="add Image";
        	console.log("build a >>>>>> image");
        	fieldHTML += '<form method="post" id="photoAddForm" enctype="multipart/form-data">'+
							iconOpen+
							'<input type="file" class="form-control newImage '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'" accept=".gif, .jpg, .png" onchange="showMyImage2(this)"/>'+
							iconClose+
					'</form>'+
					'<div id="resultsImage" class="bg-white results"></div>';
				alert(fieldObj.contextType+"//"+fieldObj.contextId);
        	//initFormImages(fieldObj.contextType, fieldObj.contextId);
        }

        /* **************************************
		* DATE INPUT , we use bootstrap-datepicker
		***************************************** */
        else if ( fieldObj.inputType == "date" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014";
        	console.log("build a >>>>>> date");
        	fieldHTML += iconOpen+'<input type="text" class="form-control dateInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* DATE TIME INPUT , we use bootstrap-datetimepicker
		***************************************** */
        else if ( fieldObj.inputType == "datetime" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014 08:30";
        	console.log("build a >>>>>> datetime");
        	fieldHTML += iconOpen+'<input type="text" class="form-control dateTimeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }
        /* **************************************
		* DATE RANGE INPUT 
		***************************************** */
        else if ( fieldObj.inputType == "daterange" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014";
			console.log("build a >>>>>> daterange");
        	fieldHTML += iconOpen+'<input type="text" class="form-control daterangeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* TIME INPUT , we use 
		***************************************** */
        else if ( fieldObj.inputType == "time" ) {
        	if(placeholder == "")
        		placeholder="20:30";
        	console.log("build a >>>>>> time");
        	fieldHTML += iconOpen+'<input type="text" class="form-control timeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* LINK
		***************************************** */
        else if ( fieldObj.inputType == "link" ) {
        	if(fieldObj.url.indexOf("http://") < 0 )
        		fieldObj.url = "http://"+fieldObj.url;
        	console.log("build a >>>>>> link");
        	fieldHTML += '<a class="btn btn-primary '+fieldClass+'" href="'+fieldObj.url+'">Go There</a>';
        } 

        /* **************************************
		* LOCATION
		***************************************** */
        else if ( fieldObj.inputType == "location" ) {
        	console.log("build a >>>>>> location");
        	fieldHTML += "<a href='javascript:;' class='w100p "+fieldClass+" locationBtn btn btn-default'><i class='text-azure fa fa-map-marker fa-2x'></i> Localiser </a>";
        	fieldHTML += '<input type="hidden" placeholder="Latitude" name="geo[latitude]" id="geo.latitude]" value="'+( (fieldObj.geo) ? fieldObj.geo.latitude :"" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Longitude" name="geo[longitude]" id="geo[longitude]" value="'+( (fieldObj.geo) ? fieldObj.geo.longitude : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Insee" name="address[codeInsee]" id="address[codeInsee]" value="'+( (fieldObj.address) ? fieldObj.address.codeInsee : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="country" name="address[addressCountry]" id="address[addressCountry]" value="'+( (fieldObj.address) ? fieldObj.address.addressCountry : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="postal Code" name="address[postalCode]" id="address[postalCode]" value="'+( (fieldObj.address) ? fieldObj.address.postalCode : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Locality" name="address[addressLocality]" id="address[addressLocality]" value="'+( (fieldObj.address) ? fieldObj.address.addressLocality : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="address" name="address[streetAddress]" id="address[streetAddress]" value="'+( (fieldObj.address) ? fieldObj.address.streetAddress : "" )+'"/>';
        } 

        /* **************************************
		* ARRAY , is a list of sequential values
		***************************************** */
        else if ( fieldObj.inputType == "array" ) {
        	console.log("build a >>>>>> array list");
        	fieldHTML += '<div class="space5"></div><div class="inputs array">'+
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
						        '<a href="javascript:;" data-id="'+field+fieldObj.inputType+'" class="addPropBtn btn btn-xs btn-success" alt="Add a line"><i class=" fa fa-plus-circle" ></i></a> '+
				       		'</div></span>'+
				       '<div class="space5"></div><div class="cocotest"></div>';
			

			fieldObj.init = function(){
				//initialize values
				//value is an array of strings
				$.each(fieldObj.value, function(optKey,optVal) {
					if(optKey == 0)
	                    $(".addmultifield").val(optVal);
	                else 
	                	addfield("."+field+fieldObj.inputType,optVal);
				});
				initMultiFields('.'+field+fieldObj.inputType);
			}

        }

        /* **************************************
		* PROPERTIES , is a list of pairs key/values
		***************************************** */
        else if ( fieldObj.inputType == "properties" ) {
        	console.log("build a >>>>>> properties list");
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
			
			

			initField = function(){
				initMultiFields('.'+field+fieldObj.inputType);
				//initialize values
				//value is an array of objects structured like {"label":"","value":""}
				/*$.each(fieldObj.value, function(optKey,optVal) {
					if(optKey == 0)
	                    $(".addmultifield").val(optVal); tweak this for properties
	                else 
						addfield("."+field+fieldObj.inputType,optVal );
				});*/
			}
        }

        /* **************************************
		* CAPTCHA
		***************************************** */
        else if ( fieldObj.inputType == "recaptcha" ) {
        	console.log("build a >>>>>> recaptcah");
        	fieldHTML += '<div class="g-recaptcha" data-sitekey="'+fieldObj.key+'"></div>';
        } 
        

        /* **************************************
		* CUSTOM 
		***************************************** */
        else if ( fieldObj.inputType == "custom" ) {
        	console.log("build a >>>>>> custom");
        	fieldHTML += fieldObj.html;
        } 
        /* 	*************************************
        * SCOPE USER 	
        ************************************** */
        else if( fieldObj.inputType == "scope" ) {
        	
        		fieldClass += " select2TagsInput select2ScopeInput";
        		
        		/*fieldHTML += 	'<span id="lbl-send-to">Send to <i class="fa fa-caret-right"></i>'+ 
	        					'<div class="dropdown">' +
								  '<a data-toggle="dropdown" class="btn btn-sm btn-default" id="btn-toogle-dropdown-scope" href="#"><i class="fa fa-group"></i> Mon mur <i class="fa fa-caret-down"></i></a>' +
								  '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">' +
								   '<li><a href="#" id="scope-my-wall"><i class="fa fa-group"></i> My wall</a></li>' +
								   '<li><a href="#" id="scope-select" data-toggle="modal" data-target="#modal-scope"><i class="fa fa-plus"></i> Selectionner</a></li>' +
								  '</ul>' +
								'</div></span>' ;*/

				
				fieldHTML += '<div class="modal fade" id="modal-scope" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
							  '<div class="modal-dialog">'+
							    '<div class="modal-content">'+
							      '<div class="modal-header">'+
							        //'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
							        '<input type="text" id="search-contact" class="form-control pull-right" placeholder="rechercher ...">' +
									'<h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> '+fieldObj.title1+'</h4>'+
							      '</div>'+
							      '<div class="modal-body">'+
								      '<div class="row no-padding bg-light">'+
								      	'<div class="col-md-4 col-sm-4 no-padding">'+
									        '<div class="panel panel-default">  '+	
												'<div class="panel-body no-padding">'+
													'<div class="list-group" id="menu-type">'+
														'<ul class="col-xs-12 col-sm-12 col-md-12 no-padding">';
				fieldHTML += 							'<h4 class="text-dark"><i class="fa fa-angle-down"></i> '+fieldObj.title2+'</h4>';
														$.each(fieldObj.contactTypes, function(key, type){
				fieldHTML += 								'<li>'+
																'<div id="btn-scroll-type-'+type.name+'" class="btn btn-default btn-scroll-type text-'+type.color+'">' +
																	'<input type="checkbox" name="chk-all-type'+type.name+'" id="chk-all-type'+type.name+'" value="'+type.name+'"> '+
																	'<span style="font-size:16px;"><i class="fa fa-'+type.icon+'"></i> ' + type.label + "</span>" +
																'</div>'+
															'</li>';
														});									
				fieldHTML += 							'</ul>';
				fieldHTML += 							/*'<ul class="col-xs-6 col-sm-12 col-md-12 no-margin no-padding select-population">' + 
															'<h4 class="text-dark"><i class="fa fa-angle-down"></i> Select population</h4>' +
															'<li>'+
																'<div class="btn btn-default btn-scroll-type homestead text-red">' +
																	'<input type="checkbox" name="chk-my-city" id="chk-my-city" value="mycity">' +
																	'<div id="btn-scroll-type-my-city" class="inline" >' +
																		 ' <span style="font-size:16px;"><i class="fa fa-university"></i> My City</span>' +
																	'</div>'+
																'</div>'+
															'</li>' +
															'<li>'+
																'<div id="btn-show-other-cities"  class="btn btn-default btn-scroll-type homestead text-red">' +
																	'<input type="checkbox" name="chk-cities" id="chk-cities" value="cities">'+
																	'<div id="btn-scroll-type-other-cities" class="inline" >' +
																		' <span style="font-size:16px;"><i class="fa fa-university"></i> Other cities</span></br>' +
																	'<input type="text" name="scope-postal-code" id="scope-postal-code" style="width:100%;" class="form-control helvetica margin-top-5" placeholder="code insee">' +
																	'</div>'+
																'</div>'+
															'</li>' +
														'</ul>' +*/
													'</div>'+
												'</div>'+
											'</div>' +
								      	'</div>'+
								      	'<div class="no-padding pull-right col-md-8 col-sm-8 col-xs-12 bg-white" id="list-scroll-type">';
										$.each(fieldObj.contactTypes, function(key, type){
				fieldHTML += 			'<div class="panel panel-default" id="scroll-type-'+type.name+'">  '+	
											'<div class="panel-heading">'+
												'<h4 class="text-'+type.color+'"><i class="fa fa-'+type.icon+'"></i> '+type.label+'</h4>'+			
											'</div>'+
											'<div class="panel-body no-padding">'+
												'<div class="list-group padding-5">'+
													'<ul>';
													$.each(fieldObj.values[type.name], function(key2, value){ 
														var cp = (typeof value.address != "undefined" && typeof value.address.postalCode != "undefined") ? value.address.postalCode : typeof value.cp != "undefined" ? value.cp : "";
														var city = (typeof value.address != "undefined" && typeof value.address.addressLocality != "undefined") ? value.address.addressLocality : "";
														var profilThumbImageUrl = (typeof value.profilThumbImageUrl != "undefined" && value.profilThumbImageUrl != "") ? baseUrl + value.profilThumbImageUrl : assetPath + "/images/news/profile_default_l.png";
														var name =  typeof value.name != "undefined" ? value.name : 
																	typeof value.username != "undefined" ? value.username : "";
														//console.log("data contact +++++++++++ "); console.dir(value);
														var thisKey = key+''+key2;
														var thisValue = notEmpty(value["_id"]['$id']) ? value["_id"]['$id'] : "";
														if(name != "")
				fieldHTML += 							'<li>' +
															'<div class="btn btn-default btn-scroll-type btn-select-contact"  id="contact'+thisKey+'">' +
																'<div class="col-md-1 no-padding"><input type="checkbox" name="scope-'+type.name+'" class="chk-scope-'+type.name+'" id="chk-scope-'+thisKey+'" value="'+thisValue+'" data-type="'+type.name+'"></div> '+
																'<div class="btn-chk-contact col-md-11 no-padding" idcontact="'+thisKey+'">' +
																	'<img src="'+ profilThumbImageUrl+'" class="thumb-send-to" height="35" width="35">'+
																	'<span class="info-contact">' +
																		'<span class="scope-name-contact text-dark text-bold" idcontact="'+thisKey+'">' + value.name + '</span>'+
																		'<br/>'+
																		'<span class="scope-cp-contact text-light" idcontact="'+thisKey+'">' + cp + ' </span>'+
																		'<span class="scope-city-contact text-light" idcontact="'+thisKey+'">' + city + '</span>'+
																	'</span>' +
																'</div>' +
															'</div>' +
														'</li>';
													});									
				fieldHTML += 						'</ul>' +	
												'</div>'+
											'</div>'+
										'</div>';
										});									
				fieldHTML += 			'</div>' +
									'</div>'+
								  '</div>'+
							      '<div class="modal-footer">'+
							      	'<button id="btn-reset-scope" type="button" class="btn btn-default btn-sm pull-left"><i class="fa fa-repeat"></i> '+fieldObj.btnResetTitle+'</button>'+
							      	'<button id="btn-cancel" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '+fieldObj.btnCancelTitle+'</button>'+
							      	'<button id="btn-save" type="button" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-check"></i> '+fieldObj.btnSaveTitle+'</button>'+
							      '</div>'+
							    '</div><!-- /.modal-content -->'+
							  '</div><!-- /.modal-dialog -->'+
							'</div><!-- /.modal -->';
        }
 
        else {
        	console.log("build a >>>>>> input text");
        	fieldHTML += iconOpen+'<input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }
        
		fieldHTML += '</div>';

		$(id).append(fieldHTML);

		//Post creation initialisation
		if( fieldObj.init && $.isFunction(fieldObj.init) )
        	fieldObj.init(field+fieldObj.inputType);
        else if(initField && $.isFunction(initField) )
        	initField ('.'+field+fieldObj.inputType);
	}
	

	/* **************************************
	*
	*	any event to be initiated 
	*
	***************************************** */
	var afterDynBuildSave = null;
	function bindDynFormEvents (params, formRules) {  

		/* **************************************
		* FORM VALIDATION and save process binding
		***************************************** */
		console.info("connecting submit btn to $.validate pluggin");
		console.dir(formRules);
		var errorHandler = $('.errorHandler', $(params.formId));
		$(params.formId).validate({

			rules : formRules,

			submitHandler : function(form) {
				errorHandler.hide();
				console.info("form submitted "+params.formId);
				if(params.onSave && jQuery.isFunction( params.onSave ) ){
					params.onSave();
					return false;
		        } 
		        else 
		        {
		        	console.info("default SaveProcess",params.savePath);
		        	console.dir($(params.formId).serializeFormJSON());
		        	$.ajax({
		        	  type: "POST",
		        	  url: params.savePath,
		        	  data: $(params.formId).serializeFormJSON(),
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
		
		console.info("connecting any specific input event select2, datepicker...");
		/* **************************************
		* SELECTs , we use https://github.com/select2/select2
		***************************************** */
		//is a type select with options
		if( $(".select2Input").length)
		{
			if( jQuery.isFunction(jQuery.fn.select2) )
			{
				/*$(".select2Input").select2(
					{
					  "placeholder" : ( $(this).attr("placeholder") ) ? $(this).attr("placeholder") : ""
					}
				);*/
				
				$.each($(".select2Input"),function () 
				{
					if( jQuery.isFunction(jQuery.fn.select2) )
						$(this).select2({
							  "placeholder" : ( $(this).data("placeholder") ) ? $(this).data("placeholder") : "",
							  allowClear: true
							}
						);
					else
						console.error("select2 library is missing");
				 });
			}
		} 

		//is a type input
		if( $(".select2TagsInput").length)
		{
			if( jQuery.isFunction(jQuery.fn.select2) )
			{
				$.each($(".select2TagsInput"),function () 
				{
					console.log("id xxxxxxxxxxxxxxxxx ",$(this).attr("id"),initValues[$(this).attr("id")]);
					if(initValues[$(this).attr("id")]){
						var selectOptions = {
						  "tags": initValues[ $(this).attr("id") ]["tags"],
						  "tokenSeparators": [',', ' '],
						  "placeholder" : ( $(this).attr("placeholder") ) ? $(this).attr("placeholder") : ""
						};
						$(this).removeClass("form-control").select2(selectOptions);
					}
				 });
			} else
				console.error("select2 library is missing");
		} 

		/* **************************************
		* DATE INPUT , we use https://github.com/eternicode/bootstrap-datepicker
		***************************************** */
		if(  $(".dateInput").length){
			var initDate = function(){
								console.log("init dateInput");
								$(".dateInput").datepicker({ 
							        autoclose: true,
							        language: "fr",
							        format: "dd/mm/yyyy"
							    });
							};
			if( jQuery.isFunction(jQuery.fn.datepicker) )
				initDate();
		    else {
				lazyLoad( baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', 
						  baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-datepicker/css/datepicker.css',
						  initDate);
		    }
		}
		/* **************************************
		* DATE INPUT , we use https://github.com/eternicode/bootstrap-datepicker
		***************************************** */
		if(  $(".dateTimeInput").length){
			var initDate = function(){
								console.log("init dateTimeInput");
								$(".dateTimeInput").datetimepicker();
							};
			if( jQuery.isFunction(jQuery.fn.datetimepicker) )
				initDate();
		    else {
				lazyLoad( baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js', 
						  baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
						  initDate);
		    }
		}
		/* **************************************
		* Location type 
		***************************************** */
		if(  $(".locationBtn").length)
		{
			//todo : for generic dynForm check if map exist 
			$(".locationBtn").off().on( "click", function(){ 
				$("#ajax-modal").modal("hide");
		        showMap(true);
		        if(typeof showFormInMap != "undefined"){ showFormInMap(); }
		    });
		}
		
		/* **************************************
		* Image type 
		***************************************** */
		if(  $("#image").length){
			if( jQuery.isFunction(jQuery.fn.datepicker) )
				$(".dateInput").datepicker({ 
			        autoclose: true,
			        language: "fr",
			        format: "dd/mm/yyyy"
			    });
		    else
				console.error("datepicker library is missing");
		}

		/* **************************************
		* DATE RANGE INPUT , we use https://github.com/dangrossman/bootstrap-daterangepicker
		***************************************** */
		if( $(".daterangeInput").length){
			var initDateRange = function(){
								$('.daterangeInput').daterangepicker({
						            timePicker: true,
						            timePickerIncrement: 30,
						            format: 'MM/DD/YYYY h:mm A'
						        }, function(start, end, label) {
						            console.log(start.toISOString(), end.toISOString(), label);
						        });
							};
			if( jQuery.isFunction(jQuery.fn.daterangepicker) )
				initDateRange();
			else
				lazyLoad( baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-daterangepicker/daterangepicker.js' ,  
						  baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
						  initDateRange);
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

			//intialise event on the add new row button 
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
		if(  $(".dateInput").length){
			var initDate = function(){
								console.log("init dateInput");
								$(".dateInput").datepicker({ 
							        autoclose: true,
							        language: "fr",
							        format: "dd/mm/yyyy"
							    });
							};
			if( jQuery.isFunction(jQuery.fn.datepicker) )
				initDate();
		    else {
				lazyLoad( baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', 
						  baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-datepicker/css/datepicker.css',
						  initDate);
		    }
		}
		if(  $(".wysiwygInput").length )
		{
				var initField = function(){
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
				if( jQuery.isFunction(jQuery.fn.summernote) )
					initField();
			    else {
			    	lazyLoad( baseUrl+'/themes/ph-dori/assets/plugins/summernote/dist/summernote.min.js', 
							  baseUrl+'/themes/ph-dori/assets/plugins/summernote/dist/summernote.css',
							  initDate);
		    	}
			}
		}

	}

	/* **************************************
	*
	*	specific methods for each type of input
	*
	***************************************** */
	/* **************************************
	* add a new line to the multi line process 
	* val can be a value when type array or {"label":"","value":""} when type property
	***************************************** */
	function addfield(parentContainer,val) 
	{
		console.log("addfield",parentContainer+' .inputs',val);
		if(!$.isEmptyObject($(parentContainer+' .inputs')))
	    {
	    	if($(parentContainer+' .properties').length > 0)
	    		$( propertyLineHTML( val ) ).fadeIn('slow').appendTo(parentContainer+' .inputs');
	    	else
	    		$( arrayLineHTML( val ) ).fadeIn('slow').appendTo(parentContainer+' .inputs');
	    	$(parentContainer+' .addmultifield:last').focus();
	        initMultiFields(parentContainer);
	    }else 
	    	console.error("container doesn't seem to exist : "+parentContainer+' .inputs');
	}
	
	/* **************************************
	* initiliase events 
	* prevent submitting empty fields 
	* remove a field
	* enter key submition
	***************************************** */
	function initMultiFields(parentContainer){
		console.log("initMultiFields",parentContainer);
	  //manage using Enter to make easy loop editing
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

	  //manage using Enter to make easy loop editing
	  //for 2nd property field
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

	  //bind remove btn event 
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

	/* **************************************
	* build HTML for each element of a property list 
	***************************************** */
	function propertyLineHTML(propVal)
	{
		console.log("propertyLineHTML",propVal);
		if( typeof propVal == "undefined" ) 
	    	propVal = {"label":"","value":""};
		var str = '<div class="space5"></div><div class="col-sm-3">'+
					'<input type="text" name="properties[]" class="addmultifield form-control input-md" value="'+propVal.label+'" />'+
				'</div>'+
				'<div class="col-sm-7">'+
					'<textarea type="text" name="values[]" class="addmultifield1 form-control input-md pull-left" onkeyup="AutoGrowTextArea(this);" placeholder="valeur"   >'+propVal.value+'</textarea>'+
					'<button class="pull-right removePropLineBtn btn btn-xs btn-blue tooltips pull-right" data- data-original-title="Retirer cette ligne" data-placement="bottom"><i class=" fa fa-minus-circle" ></i></button>'+
				'</div>';
		return str;
	}

	/* **************************************
	* build HTML for each element of array
	***************************************** */
	function arrayLineHTML(val)
	{
		console.log("arrayLineHTML : ",val);
		if( typeof val == "undefined" ) 
	    	val = "";
		var str = '<div class="space5"></div><div class="col-sm-10">'+
					'<input type="text" name="properties[]" class="addmultifield form-control input-md" value="'+val+'"/>'+
					'</div>'+
					'<div class="col-sm-2">'+
					'<button class="pull-right removePropLineBtn btn btn-xs btn-blue tooltips pull-left" data- data-original-title="Retirer cette ligne" data-placement="bottom"><i class=" fa fa-minus-circle" ></i></button>'+
				'</div>';
		return str;
	}

	/* **************************************
	* init Boostrap Switch
	***************************************** */
	function initbootstrapSwitch(el,change)
	{
		var initSwitch = function(){
							console.log("init bootstrap switch");
							$(el).bootstrapSwitch();
							if(typeof change == "function"){
								$(el).on('switchChange.bootstrapSwitch', function(event, state) {
									change();
								});
							}
							$(el).parent().parent().addClass("form-group");
						};
		if( jQuery.isFunction(jQuery.fn.bootstrapSwitch) )
			initSwitch();
	    else {
	    	lazyLoad( baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js', 
					  baseUrl+'/themes/ph-dori/assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
					  initSwitch);
    	}
		
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

function initFormImages(contextType, contextId){
	alert("init good");
}

function showMyImage2(fileInput) {
	if($(".noGoSaveNews").length){
		toastr.info("Wait the end of image loading");
	}
	else if (fileInput.files[0].size > 2097152){
		toastr.info("Please reduce your image before to 2Mo");
	}
	else {
		alert();
		countImg=$("#resultsImage img").length;
		idImg=countImg+1;
		htmlImg="";
		var files = fileInput.files;
		if(countImg==0){
			htmlImg = "<input type='hidden' class='type' value='gallery_images'/>";
			htmlImg += "<input type='hidden' class='count_images' value='"+idImg+"'/>";
			htmlImg += "<input type='hidden' class='algoNbImg' value='"+idImg+"'/>";
			nbId=idImg;
			$("#resultsImage").show();
		}
		else{
			nbId=$(".algoNbImg").val();
			nbId++;
			$(".count_images").val(idImg);
			$(".algoNbImg").val(nbId);
		}
		
		htmlImg+="<div class='newImageAlbum'><i class='fa fa-spin fa-circle-o-notch fa-3x text-green spinner-add-image noGoSaveNews'></i><img src='' id='thumbail"+nbId+"' class='grayscale' style='width:75px; height:75px;'/>"+
		       	"<input type='hidden' class='imagesNews' name='goSaveNews' value=''/></div>";
		$("#resultsImage").append(htmlImg);

	    for (var i = 0; i < files.length; i++) 
	    {
	        var file = files[i];
	        var imageType = /image.*/;     
	        if (!file.type.match(imageType)) {
	            continue;
	        }           
	        var img=document.getElementById("thumbail"+nbId);            
	        img.file = file;    
	        var reader = new FileReader();
	        reader.onload = (function(aImg) { 
	            return function(e) { 
	                aImg.src = e.target.result; 
	            }; 
	        })(img);
	        reader.readAsDataURL(file);
	    }  
	    validationImage = {
		errorElement : "span", // contain the error msg in a span tag
		errorClass : 'help-block',
		errorPlacement : function(error, element) {// render error placement for each input type
			if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
				error.insertAfter($(element).closest('.form-group').children('div').children().last());
			} else if (element.parent().hasClass("input-icon")) {
				error.insertAfter($(element).parent());
			} else {
				error.insertAfter(element);
				// for other inputs, just perform default behavior
			}
		},
		ignore : "",
		rules : {
			goSaveNews : true /*{
				required:{
					depends: function() {
						if($(".noGoSaveNews").length){
							return true;
						}
						else{
							return false;
						}
					}	
				}
			}*/
		},
		messages : {
			goSaveNews: "* Image is still loading"

		},
//		e.preventDefault();
		submitHandler : function(form) {
			$.ajax({
			url : baseUrl+"/"+moduleId+"/document/"+uploadUrl+"dir/"+moduleId+"/folder/room/ownerId/me/input/roomsImage",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false, 
			processData: false,
			dataType: "json",
			success: function(data){
				if(debug)console.log(data);
		  		if(data.success){
			  		console.log("success");
		  			imageName = data.name;
					var doc = { 
						"id":contextParentId,
						"type":contextParentType,
						"folder":"room/me",
						"moduleId":moduleId,
						"author" : userId  , 
						"name" : data.name , 
						"date" : new Date() , 
						"size" : data.size ,
						"doctype" : docType,
						"contentKey" : contentKey
					};
					console.log(doc);
					path = "/"+data.dir+data.name;
					$.ajax({
					  	type: "POST",
					  	url: baseUrl+"/"+moduleId+"/document/save",
					  	data: doc,
				      	dataType: "json"
					}).done( function(data){
				        if(data.result){
						    toastr.success(data.msg);
						    //setTimeout(function(){
						    $(".imagesNews").last().val(data.id.$id);
						    $(".imagesNews").last().attr("name","");
						    $(".newImageAlbum").last().find("img").removeClass("grayscale");
						    $(".newImageAlbum").last().find("i").remove();
						    $(".newImageAlbum").last().append("<a href='javascript:;' onclick='deleteImage(\""+data.id.$id+"\",\""+data.name+"\")'><i class='fa fa-times fa-x padding-5 text-white removeImage' id='deleteImg"+data.id.$id+"'></i></a>");
						    //},200);
				
						} else{
							toastr.error(data.msg);
							if($("#resultsImage img").length>1)
						  		$(".newImageAlbum").last().remove();
						  	else{
						  		$("#resultsImage").empty();
						  		$("#resultsImage").hide();
						  	}
						}
						$("#addImage").off();
					});
		  		}
		  		else{
			  		if($("#resultsImage img").length>1)
				  		$(".newImageAlbum").last().remove();
				  	else{
				  		$("#resultsImage").empty();
				  		$("#resultsImage").hide();
				  	}
				  	$("#addImage").off();
		  			toastr.error(data.msg);
		  		}
			},
		});
		}
	};
	   alert("done here");
	  //  var form = $('#photoAddForm').get(0);
//$.removeData(form, 'validator');
		form.submit(function(e) { e.preventDefault }).validate(validationImage);;	  
	}
}