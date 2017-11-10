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
	initSelectNetwork = [],
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
				beforeBuild : null,
				onLoad : null,
				onSave: null,
				beforeSave: null,
				savePath : '/ph/common/save'
			}; 
			var settings = $.extend({}, defaults, options);
			$this = this;

			mylog.info("build Form dynamically into form tag : ",settings.formId);
			mylog.dir(settings.formObj);

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
							'<i class="fa fa-remove-sign"></i> Merci de corriger les erreurs ci dessous.'+
						'</div>';
			$(settings.formId).append(errorHTML);

			if(settings.beforeBuild && jQuery.isFunction( settings.beforeBuild ) )
				settings.beforeBuild();

			$.each(settings.formObj.jsonSchema.properties,function(field,fieldObj) { 
				//mylog.log("??????????????????????????",field,fieldObj);
				if(fieldObj.rules)
					form.rules[field] = fieldObj.rules;//{required:true}
				
				var fieldTooltip = null;
				//alert("dyFObj."+dyFObj.activeElem+".dynForm.jsonSchema.tooltips."+field );
				if( jsonHelper.notNull( "dyFObj."+dyFObj.activeElem+".dynForm.jsonSchema.tooltips" ) && 
						dyFObj[dyFObj.activeElem].dynForm.jsonSchema.tooltips[field] ){
					fieldTooltip = dyFObj[dyFObj.activeElem].dynForm.jsonSchema.tooltips[field];
				}
				buildInputField(settings.formId,field, fieldObj, settings.formValues, fieldTooltip);
			});
			
			/* **************************************
			* CONTEXT ELEMENTS, used for saving purposes
			***************************************** */
			fieldHTML = '<input type="hidden" name="key" id="key" value="'+settings.formObj.key+'"/>';
	        fieldHTML += '<input type="hidden" name="collection" id="collection" value="'+settings.formObj.collection+'"/>';
	        fieldHTML += '<input type="hidden" name="id" id="id" value="'+((settings.formValues.id) ? settings.formValues.id : "")+'"/>';
	       
        	fieldHTML += '<div class="form-actions">'+
        				'<hr class="col-md-12">';
        	if( !settings.formObj.jsonSchema.noSubmitBtns )
				fieldHTML += '<button id="btn-submit-form" class="btn btn-default text-azure text-bold pull-right">'+
							tradDynForm.submit+' <i class="fa fa-arrow-circle-right"></i>'+
						'</button> '+

						' <a href="javascript:dyFObj.closeForm(); " class="mainDynFormCloseBtn btn btn-default pull-right text-red" style="margin-right:10px;">'+
							'<i class="fa fa-times "></i> '+tradDynForm.cancel+
						'</a> ';

			fieldHTML += '</div>';

	        $( settings.formId ).append(fieldHTML);

	        $(dyFObj.activeModal+" #btn-submit-form").one(function() { 
				$( settings.formId ).submit();	        	
	        });

			/* **************************************
			* bind any events Post building 
			***************************************** */
			bindDynFormEvents(settings,form.rules);

			if(settings.onLoad && jQuery.isFunction( settings.onLoad ) )
				settings.onLoad();
		    
			return form;
		},

		/*buildForm: function() { 
			mylog.dir($this.formObj);
		},*/

	});
	
	/* **************************************
	*
	*	each input field type has a corresponding HTMl to build
	*
	***************************************** */
	function buildInputField(id, field, fieldObj,formValues, tooltip)
	{
		var fieldHTML = '<div class="form-group '+field+fieldObj.inputType+'">';
		var required = "";
		if(fieldObj.rules && fieldObj.rules.required)
			required = "*";

		tooltip = (tooltip) ? '<i class=" fa fa-question-circle pull-right tooltips text-red" data-toggle="tooltip" data-placement="top" title="'+tooltip+'"></i>' : '';
		if(fieldObj.label)
			fieldHTML += '<label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="'+field+'">'+
			              '<i class="fa fa-chevron-down"></i> ' +  fieldObj.label+required+tooltip+
			            '</label>';

        var iconOpen = (fieldObj.icon) ? '<span class="input-icon">'   : '';
        var iconClose = (fieldObj.icon) ? '<i class="'+fieldObj.icon+'"></i> </span>' : '';
        var placeholder = (fieldObj.placeholder) ? fieldObj.placeholder+required : '';
        var placeholder2 = (fieldObj.placeholder2) ? fieldObj.placeholder2 : '';
        var fieldClass = (fieldObj.class) ? fieldObj.class : '';
        var initField = '';
        var value = "";
        var style = "";
        var mainTag = null;
        if( fieldObj.value ) 
        	value = fieldObj.value;
        else if (formValues && formValues[field]) {
        	value = formValues[field];
        }

        mylog.log("value network", value);
        if(value!="")
        	mylog.warn("--------------- dynform form Values",field,value);

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
        		  fieldObj.inputType == "tags" || 
        		  fieldObj.inputType == "price" ) {
        	if(fieldObj.inputType == "tags")
        	{
        		fieldClass += " select2TagsInput";
        		if(fieldObj.values){
        			if(!initValues[field])
        				initValues[field] = {};
        			initValues[field]["tags"] = fieldObj.values;
        		}
        		if(fieldObj.maximumSelectionLength)
        			initValues[field]["maximumSelectionLength"] =  fieldObj.maximumSelectionLength;
        		mylog.log("fieldObj.data", fieldObj.data, fieldObj);
        		if(typeof fieldObj.data != "undefined"){
        			value = fieldObj.data;
	        		//initSelectNetwork[field]=fieldObj.data;
	        	}
        		if(typeof fieldObj.mainTag != "undefined")
					mainTag=fieldObj.mainTag;
        		style = "style='width:100%;margin-bottom: 10px;border: 1px solid #ccc;'";
        	}
        	//var label = '<label class="pull-left"><i class="fa fa-circle"></i> '+placeholder+'</label><br>';
        	fieldHTML += iconOpen+' <input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'" '+style+'/>'+iconClose;
        
        	if(fieldObj.inputType == "price"){       		
        		fieldHTML += '<select class="'+fieldClass+'" name="devise" id="devise" style="">';
				fieldHTML += 	'<option class="bold" value="€">euro €</option>';
				fieldHTML += 	'<option class="bold" value="$">dollars $</option>';
				fieldHTML += 	'<option class="bold" value="CFP">CFP</option>';
				fieldHTML += '</select>';
        	}
        }
        
        /* **************************************
		* HIDDEN
		***************************************** */
        else if( fieldObj.inputType == "hidden" || fieldObj.inputType == "timestamp" ) {
        	if ( fieldObj.inputType == "timestamp" )
        		value = Date.now();
        	mylog.log("build field "+field+">>>>>> hidden, timestamp");
        	fieldHTML += '<input type="hidden" name="'+field+'" id="'+field+'" value="'+value+'"/>';
        }
        /* **************************************
		* TEXTAREA
		***************************************** */
        else if ( fieldObj.inputType == "textarea" || fieldObj.inputType == "wysiwyg" ){
        	mylog.log("build field "+field+">>>>>> textarea, wysiwyg", fieldObj);
        	if(fieldObj.inputType == "wysiwyg")
        		fieldClass += " wysiwygInput";
        	var maxlength = "";
        	var minlength = 0;
        	if(notNull(fieldObj.rules) && notNull(fieldObj.rules.maxlength) ){
        		fieldClass += " maxlengthTextarea";
        		maxlength = fieldObj.rules.maxlength;
        		minlength = value.length ;
        	}

        	mylog.log("build field "+field+">>>>>> textarea, wysiwyg");
        	fieldHTML += '<textarea id="'+field+'" maxlength="'+maxlength+'"  class="form-control textarea '+fieldClass+'" name="'+field+'" placeholder="'+placeholder+'">'+value+'</textarea>';
        	
        	if(maxlength > 0)
        		fieldHTML += '<span><span id="maxlength'+field+'">'+minlength+'</span> / '+maxlength+' '+trad["character(s)"]+' </span> '


        }else if ( fieldObj.inputType == "markdown"){ 
        	mylog.log("build field "+field+">>>>>> textarea, markdown");
        	fieldClass += " markdownInput";
        	//fieldHTML +='<textarea id="'+field+'" name="'+field+'" class="form-control textarea '+fieldClass+'" placeholder="'+placeholder+'" data-provide="markdown" data-savable="true" rows="10"></textarea>';
        	fieldHTML +='<textarea name="target-editor" id="'+field+'" data-provide="markdown" data-savable="true" class="form-control textarea '+fieldClass+'" placeholder="'+placeholder+'" rows="10"></textarea>';
        }
        /* **************************************
		* CHECKBOX SIMPLE
		***************************************** */
        else if ( fieldObj.inputType == "checkboxSimple" ) {
   			if(value == "") value="25/01/2014";
   			console.log("fieldObj ???",fieldObj, ( fieldObj.checked == "true" ));
	       	var thisValue = ( fieldObj.checked == "true" ) ? "true" : "false";
	       	console.log("fieldObj ??? thisValue", thisValue);
	       	//var onclick = ( fieldObj.onclick ) ? "onclick='"+fieldObj.onclick+"'" : "";
	       	//var switchData = ( fieldObj.switch ) ? "data-on-text='"+fieldObj.params.onText+"' data-off-text='"+fieldObj.params.offText+"' data-label-text='"+fieldObj.switch.labelText+"' " : "";
	       	mylog.log("build field "+field+">>>>>> checkbox");
	       	fieldHTML += '<input type="hidden" class="'+fieldClass+'" name="'+field+'" id="'+field+'" '+
	       						'value="'+thisValue+'"/> ';
	       
	       	fieldHTML += '<div class="col-lg-6 padding-5">'+
	       					'<a href="javascript:" class="btn-dyn-checkbox btn btn-sm bg-white letter-green col-lg-12"'+
	       					' data-checkval="true"' +
	       					'>'+
	       						fieldObj.params.onText+
	       					'</a>'+
	       				 '</div>';
	       	fieldHTML += '<div class="col-lg-6 padding-5">'+
	       					'<a href="javascript:" class="btn-dyn-checkbox btn btn-sm bg-white letter-red col-lg-12"'+
	       					' data-checkval="false"' +
	       					'>'+
	       						fieldObj.params.offText+
	       					'</a>'+
	       				 '</div>';
	       	initField = function(){
	       		//var checked = ( fieldObj.checked ) ? "checked" : "";
	       		//if(checked) 
	       		//if( fieldObj.switch )
	       			//initbootstrapSwitch('#'+field, (fieldObj.switch.onChange) ? fieldObj.switch.onChange : null );
	       	};
       	}

       	/* **************************************
		* CHECKBOX
		***************************************** */
        else if ( fieldObj.inputType == "checkbox" ) {
   			if(value == "") value="25/01/2014";
	       	var checked = ( fieldObj.checked ) ? "checked" : "";
	       	var onclick = ( fieldObj.onclick ) ? "onclick='"+fieldObj.onclick+"'" : "";
	       	var switchData = ( fieldObj.switch ) ? "data-on-text='"+fieldObj.switch.onText+"' data-off-text='"+fieldObj.switch.offText+"' data-label-text='"+fieldObj.switch.labelText+"' " : "";
	       	mylog.log("build field "+field+">>>>>> checkbox");
	       	fieldHTML += '<input type="checkbox" class="'+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" '+checked+' '+onclick+' '+switchData+'/> '+placeholder;
	       	initField = function(){
	       		if( fieldObj.switch )
	       			initbootstrapSwitch('#'+field, (fieldObj.switch.onChange) ? fieldObj.switch.onChange : null );
	       	};
       	}

       	/* **************************************
		* RADIO
		***************************************** */
        else if ( fieldObj.inputType == "radio" ) {
   			
	       	mylog.log("build field "+field+">>>>>> radio");
	       	
	       	fieldHTML += '<div class="btn-group" data-toggle="buttons">';
	       	value = ( (typeof fieldObj.value != "undefined") ? fieldObj.value : value ) ;
	       	if(fieldObj.options)
	       		fieldHTML += buildRadioOptions(fieldObj.options,value, field) ;
	       	fieldHTML += '</div>';
       	}


        /* **************************************
		* SELECT , we use select2
		***************************************** */
        else if ( fieldObj.inputType == "select" || fieldObj.inputType == "selectMultiple" ) 
        {
       		var multiple = (fieldObj.inputType == "selectMultiple") ? 'multiple="multiple"' : '';
       		mylog.log("build field "+field+">>>>>> select selectMultiple");
       		var isSelect2 = (fieldObj.isSelect2) ? "select2Input" : "";
       		fieldHTML += '<select class="'+isSelect2+' '+fieldClass+'" '+multiple+' name="'+field+'" id="'+field+'" style="width: 100%;height:30px;" data-placeholder="'+placeholder+'">';
			if(placeholder)
				fieldHTML += '<option class="text-red" style="font-weight:bold" disabled selected>'+placeholder+'</option>';
			else
				fieldHTML += '<option></option>';

			var selected = "";
			mylog.log("fieldObj select", fieldObj)
			//initialize values
			if(fieldObj.options)
				fieldHTML += buildSelectOptions(fieldObj.options, ((typeof fieldObj.value != "undefined")?fieldObj.value:value));
			
			if( fieldObj.groupOptions ){
				fieldHTML += buildSelectGroupOptions(fieldObj.groupOptions, ((typeof fieldObj.value != "undefined")?fieldObj.value:value));
			} 
			fieldHTML += '</select>';
        }

        /*else if ( fieldObj.inputType == "selectList"  ) {
       		mylog.log("build field "+field+">>>>>> select selectList");
			fieldHTML += '<ul role="menu" class="dropdown-menu scrollable-menu '+fieldClass+'" id="'+field+'" style="width: 100%;height:30px" >'+
	            '<li class="categoryOrgaEvent col-md-12">'+
	                '<ul class="dropOrgaEvent" id="citoyen">'+	                    
	                    '<li class="categoryTitle" style="margin-left:inherit;"><i class="fa fa-question"></i> I dont know</li>'+
	                    '<li><a href="javascript:;" class="btn-drop dropOrg" id="" data-id="" data-name="">I dont know</a></li>'+
	                '</ul>'+
	           '</li>';

			var selected = "";
			
			//initialize values
			$.each(fieldObj.options, function(optKey, optVal) {
				selected = ( fieldObj.value && optKey == fieldObj.value ) ? "selected" : ""; 
				fieldHTML += '<option value="'+optKey+'" '+selected+'>'+optVal+'</option>';
			});
			fieldHTML += '</ul>';
        }*/

        
        
        else if ( fieldObj.inputType == "uploader" ) {
        	if(placeholder == "")
        		placeholder="add Image";
        	mylog.log("build field "+field+">>>>>> uploader");
        	fieldHTML += '<div class="'+fieldClass+' fine-uploader-manual-trigger" data-type="citoyens" data-id="'+userId+'"></div>';
        	if(fieldObj.docType=="image")
			fieldHTML += 	'<script type="text/template" id="qq-template-gallery">';
			else
			fieldHTML += 	'<script type="text/template" id="qq-template-manual-trigger">';
			fieldHTML += 	'<div class="qq-uploader-selector qq-uploader';
			if(fieldObj.docType=="image")
			fieldHTML +=		' qq-gallery';
			fieldHTML +=		'" qq-drop-area-text="'+tradDynForm.dropfileshere+'">'+
							'<div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">'+
							'<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>'+
							'</div>'+
							'<div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>'+
							'<span class="qq-upload-drop-area-text-selector"></span>'+
							'</div>'+
							'<div class="qq-upload-button-selector btn btn-primary">'+
							'<div>'+tradDynForm["add"+fieldObj.docType]+'</div>'+
							'</div>'+
							'<button type="button" id="trigger-upload" class="btn btn-danger hide">'+
			                '<i class="icon-upload icon-white"></i> '+tradDynForm.save+
			                '</button>'+
							'<span class="qq-drop-processing-selector qq-drop-processing">'+
							'<span>En cours de progression...</span>'+
							'<span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>'+
							'</span>';
			if(fieldObj.docType=="image"){
			fieldHTML += 	'<ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">'+
							'<li>'+
							'<span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>'+
							'<div class="qq-progress-bar-container-selector qq-progress-bar-container">'+
							'<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>'+
							'</div>'+
							'<span class="qq-upload-spinner-selector qq-upload-spinner"></span>'+
							'<div class="qq-thumbnail-wrapper">'+
							'<img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>'+
							'</div>'+
							'<button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>'+
							'<button type="button" class="qq-upload-retry-selector qq-upload-retry">'+
							'<span class="qq-btn qq-retry-icon" aria-label="Retry"></span>'+
							'Retry'+
							'</button>'+
							''+
							'<div class="qq-file-info">'+
							'<div class="qq-file-name">'+
							'<span class="qq-upload-file-selector qq-upload-file"></span>'+
							//'<span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>'+
							'</div>'+
							'<input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">'+
							'<span class="qq-upload-size-selector qq-upload-size"></span>'+
							'<button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">'+
							'<span class="qq-btn qq-delete-icon" aria-label="Delete"></span>'+
							'</button>'+
							'<button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">'+
							'<span class="qq-btn qq-pause-icon" aria-label="Pause"></span>'+
							'</button>'+
							'<button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">'+
							'<span class="qq-btn qq-continue-icon" aria-label="Continue"></span>'+
							'</button>'+
							'</div>'+
							'</li>'+
							'</ul>';
			}else{
			fieldHTML += 	'<ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">'+
				                '<li>'+
				                    '<div class="qq-progress-bar-container-selector">'+
				                        '<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>'+
				                    '</div>'+
				                    '<span class="qq-upload-spinner-selector qq-upload-spinner"></span>'+
				                    '<img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>'+
				                    '<span class="qq-upload-file-selector qq-upload-file"></span>'+
				                    //'<span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>'+
				                    '<input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">'+
				                    '<span class="qq-upload-size-selector qq-upload-size"></span>'+
				                    '<button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>'+
				                    '<button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>'+
				                    '<button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>'+
				                    '<span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>'+
				                '</li>'+
				            '</ul>';
			}
			fieldHTML += 				''+
							'<dialog class="qq-alert-dialog-selector">'+
							'<div class="qq-dialog-message-selector"></div>'+
							'<div class="qq-dialog-buttons">'+
							'<button type="button" class="qq-cancel-button-selector">Close</button>'+
							'</div>'+
							'</dialog>'+
							''+
							'<dialog class="qq-confirm-dialog-selector">'+
							'<div class="qq-dialog-message-selector"></div>'+
							'<div class="qq-dialog-buttons">'+
							'<button type="button" class="qq-cancel-button-selector">No</button>'+
							'<button type="button" class="qq-ok-button-selector">Yes</button>'+
							'</div>'+
							'</dialog>'+
							''+
							'<dialog class="qq-prompt-dialog-selector">'+
							'<div class="qq-dialog-message-selector"></div>'+
							'<input type="text">'+
							'<div class="qq-dialog-buttons">'+
							'<button type="button" class="qq-cancel-button-selector">Cancel</button>'+
							'<button type="button" class="qq-ok-button-selector">Ok</button>'+
							'</div>'+
							'</dialog>'+
							'</div>'+
							'</script>';
			if( fieldObj.showUploadBtn )
        		initValues.showUploadBtn = fieldObj.showUploadBtn;
        	if( fieldObj.filetypes )
        		initValues.filetypes = fieldObj.filetypes;
        	if( fieldObj.template )
        		initValues.template = fieldObj.template;
			if( $.isFunction( fieldObj.afterUploadComplete ) )
        		initValues.afterUploadComplete = fieldObj.afterUploadComplete;
        }

        /* **************************************
		* DATE INPUT , we use bootstrap-datepicker
		***************************************** */
        else if ( fieldObj.inputType == "date" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014";
        	mylog.log("build field "+field+">>>>>> date");
        	if(value && (""+value).indexOf("/") < 0){
        		//timestamp use case 
        		value =moment(parseInt(value)*1000).format('DD/MM/YYYY');
        		//alert("switch:"+value);
        	}
        	fieldHTML += iconOpen+'<input type="text" class="form-control dateInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* DATE TIME INPUT , we use bootstrap-datetimepicker
		***************************************** */
        else if ( fieldObj.inputType == "datetime" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014 08:30";
        	mylog.log("build field "+field+">>>>>> datetime");
        	fieldHTML += iconOpen+'<input type="text" class="form-control dateTimeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }
        /* **************************************
		* DATE RANGE INPUT 
		***************************************** */
        else if ( fieldObj.inputType == "daterange" ) {
        	if(placeholder == "")
        		placeholder="25/01/2014";
			mylog.log("build field "+field+">>>>>> daterange");
        	fieldHTML += iconOpen+'<input type="text" class="form-control daterangeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* TIME INPUT , we use 
		***************************************** */
        else if ( fieldObj.inputType == "time" ) {
        	if(placeholder == "")
        		placeholder="20:30";
        	mylog.log("build field "+field+">>>>>> time");
        	fieldHTML += iconOpen+'<input type="text" class="form-control timeInput '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }

        /* **************************************
		* LINK
		***************************************** */
        else if ( fieldObj.inputType == "link" ) {
        	if(fieldObj.url.indexOf("http://") < 0 )
        		fieldObj.url = "http://"+fieldObj.url;
        	mylog.log("build field "+field+">>>>>> link");
        	fieldHTML += '<a class="btn btn-primary '+fieldClass+'" href="'+fieldObj.url+'">Go There</a>';
        } 

         /* **************************************
		* CAPCHAT
		***************************************** */
        else if ( fieldObj.inputType == "captcha" ) {
        	mylog.log("build field "+field+">>>>>> captcha");
        	fieldHTML += '<div class="col-md-8 pull-right text-right">';
				fieldHTML += '<h5 for="message" class="letter-green margin-bottom-25">';
					fieldHTML += '<span class="letter-red"><i class="fa fa-lock fa-2x"></i> sécurité</span><br>'; 
					fieldHTML += 'merci de recopier le code ci-dessous<br>afin de valider votre message <i class="fa fa-chevron-down"></i>';
				fieldHTML += '</h5>';
				fieldHTML += '<input placeholder="taper le code ici" class="col-md-6 txt-captcha text-right pull-right" id="captcha">';
			fieldHTML += '</div>';
        }


        /* **************************************
		* TAG List
		***************************************** */
        else if ( fieldObj.inputType == "tagList" ) {
        	mylog.log("build field "+field+">>>>>> tagList");
        	var action = ( fieldObj.action ) ? fieldObj.action : "javascript:;";
        	$.each(fieldObj.list,function(k,v) { 
        		//mylog.log("build field ",k,v);
        		var lbl = ( fieldObj.trad && fieldObj.trad[v.labelFront] ) ? fieldObj.trad[v.labelFront] : fieldObj.trad[k] ? fieldObj.trad[k] : k;
        		fieldHTML += '<div class="col-md-4 padding-5 '+field+'C '+k+'">'+
        						'<a class="btn tagListEl btn-select-type-anc '+field+' '+k+'Btn '+fieldClass+'"'+
        						' data-tag="'+lbl+'" data-key="'+k+'" href="'+action+'"><i class="fa fa-'+v.icon+'"></i> <br>'+lbl+'</a>'+
        					 '</div>';
        	});
        } 

        /* **************************************
		* LOCATION
		***************************************** */
        else if ( fieldObj.inputType == "location" ) {
        	mylog.log("build field "+field+">>>>>> location");
        	fieldHTML += "<a href='javascript:;' class='w100p "+fieldClass+" locationBtn btn btn-default'><i class='text-azure fa fa-map-marker fa-2x'></i> Localiser </a>";
        	fieldHTML += '<input type="hidden" placeholder="Latitude" name="geo[latitude]" id="geo.latitude]" value="'+( (fieldObj.geo) ? fieldObj.geo.latitude :"" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Longitude" name="geo[longitude]" id="geo[longitude]" value="'+( (fieldObj.geo) ? fieldObj.geo.longitude : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Insee" name="address[codeInsee]" id="address[codeInsee]" value="'+( (fieldObj.address) ? fieldObj.address.codeInsee : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="country" name="address[addressCountry]" id="address[addressCountry]" value="'+( (fieldObj.address) ? fieldObj.address.addressCountry : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="postal Code" name="address[postalCode]" id="address[postalCode]" value="'+( (fieldObj.address) ? fieldObj.address.postalCode : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Locality" name="address[addressLocality]" id="address[addressLocality]" value="'+( (fieldObj.address) ? fieldObj.address.addressLocality : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="address" name="address[streetAddress]" id="address[streetAddress]" value="'+( (fieldObj.address) ? fieldObj.address.streetAddress : "" )+'"/>';
			mylog.log("location formValues", formValues);
			//locations are saved in addresses attribute
			if( formValues.address && formValues.geo && formValues.geoPosition ){
				var initAddress = function(){
					mylog.warn("init Adress location",formValues.address.addressLocality,formValues.address.postalCode);
					dyFInputs.locationObj.copyMapForm2Dynform({address:formValues.address,geo:formValues.geo,geo:formValues.geoPosition});
					dyFInputs.locationObj.addLocationToForm({address:formValues.address,geo:formValues.geo,geo:formValues.geoPosition}, -1);
				};
			}     
			if( formValues.addresses ){
				var initAddresses = function(){
					$.each(formValues.addresses, function(i,locationObj){
						mylog.warn("init extra addresses location ",locationObj.address.addressLocality,locationObj.address.postalCode);
						dyFInputs.locationObj.copyMapForm2Dynform(locationObj);
						dyFInputs.locationObj.addLocationToForm(locationObj, i);
					});
				};
			} 
			initField = function(){
				if(initAddress)
					initAddress();
				if(initAddresses)
					initAddresses();
				dyFInputs.locationObj.init();
			} 

        }else if ( fieldObj.inputType == "postalcode" ) {
        	mylog.log("build field "+field+">>>>>> postalcode");
        	fieldHTML += "<a href='javascript:;' class='w100p "+fieldClass+" postalCodeBtn btn btn-default'><i class='text-azure fa fa-plus fa-2x'></i> Postal Code </a>";
        	fieldHTML += '<input type="hidden" placeholder="Latitude" name="geo[latitude]" id="geo.latitude]" value="'+( (fieldObj.geo) ? fieldObj.geo.latitude :"" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Longitude" name="geo[longitude]" id="geo[longitude]" value="'+( (fieldObj.geo) ? fieldObj.geo.longitude : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="postal Code" name="address[postalCode]" id="address[postalCode]" value="'+( (fieldObj.address) ? fieldObj.address.postalCode : "" )+'"/>';
        	fieldHTML += '<input type="hidden" placeholder="Locality" name="address[addressLocality]" id="address[addressLocality]" value="'+( (fieldObj.address) ? fieldObj.address.addressLocality : "" )+'"/>';
        	
			//locations are saved in addresses attribute
			if( formValues.postalCodes ){
				initField = function(){
					$.each(formValues.postalCodes, function(i,postalCodeObj){
						mylog.warn("init location",postalCodeObj.name,postalCodeObj.postalCode);
						copyPCForm2Dynform(postalCodeObj);
						addPostalCodeToForm(postalCodeObj);
					});
				};
			}       
        } 

        /* **************************************
		* ARRAY , is a list of sequential values
		***************************************** */
        else if ( fieldObj.inputType == "array" ) {
        	mylog.log("build field "+field+">>>>>> array list");
        	fieldHTML +=   '<div class="inputs array">'+
								'<div class="col-sm-10 no-padding">'+
									'<img id="loading_indicator" src="'+assetPath+'/images/news/ajax-loader.gif">'+
									'<input type="text" name="'+field+'[]" class="addmultifield addmultifield0 form-control input-md value="" placeholder="'+placeholder+'"/>'+
									'<div class="resultGetUrl resultGetUrl0 col-sm-12"></div>'+
								'</div>'+
								'<div class="col-sm-2 sectionRemovePropLineBtn">'+
									'<a href="javascript:" data-id="'+field+fieldObj.inputType+'" class="removePropLineBtn col-md-12 btn btn-link letter-red" alt="Remove this line"><i class=" fa fa-minus-circle" ></i></a>'+
								'</div>'+
							'</div>'+
							'<span class="form-group '+field+fieldObj.inputType+'Btn">'+
								'<div class="col-sm-12 no-padding margin-top-5 margin-bottom-15">'+
									'<a href="javascript:" data-container="'+field+fieldObj.inputType+'" data-id="'+field+'" class="addPropBtn btn btn-link w100p letter-green" alt="Add a line"><i class=" fa fa-plus-circle" ></i></a> '+
							        //'<i class=" fa fa-spinner fa-spin fa-2x loading_indicator" ></i>'+
							        
					       		'</div>'+
				       		'</span>';
			
			if( formValues && formValues[field] ){
				mylog.warn("dynForm >> ",field, formValues[field]);
				fieldObj.value = formValues[field];
			}
			
			if( fieldObj.init && $.isFunction(fieldObj.init) )
        		initField = fieldObj.init;
        	
			initField = function(){
				$("#loading_indicator").hide();
				//initialize values
				//value is an array of strings
				$.each(fieldObj.value, function(optKey,optVal) {
					if(optKey == 0)
	                    $(".addmultifield").val(optVal);
	                else 
	                	addfield("."+field+fieldObj.inputType,optVal,field);

	                if( formValues && formValues.medias ){
	                	$.each(formValues.medias, function(i,mediaObj) {
	                		if( mediaObj.content && optVal == mediaObj.content.url ) {
	                			var strHtml = getMediaCommonHtml(mediaObj,"save");//buildMediaHTML(mediaObj);
	                			$(".resultGetUrl"+optKey).html(strHtml);
	                			$("#loading_indicator").hide();
	                		}
	                	});
	                }
				});
				initMultiFields('.'+field+fieldObj.inputType,field);
			}

        }

        /* **************************************
		* PROPERTIES , is a list of pairs key/values
		***************************************** */
        else if ( fieldObj.inputType == "properties" ) {
        	mylog.log("build field "+field+">>>>>> properties list");
        	fieldHTML += '<div class="inputs properties">'+
								'<div class="col-sm-3">'+
									'<img class="loading_indicator" src="'+assetPath+'/images/news/ajax-loader.gif">'+
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
				initMultiFields('.'+field+fieldObj.inputType,field);
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
		* DropDown , searchInvite
		***************************************** */
        else if ( fieldObj.inputType == "searchInvite" ) {
        	mylog.log("build field "+field+">>>>>> searchInvite");

			fieldHTML += '<input class="invite-search '+fieldClass+' form-control text-left" placeholder="Un nom, un e-mail ..." autocomplete = "off" id="inviteSearch" name="inviteSearch" value="">'+
				        		'<ul class="dropdown-menu" id="dropdown_searchInvite" style="">'+
									'<li class="li-dropdown-scope">-</li>'+
								'</ul>'+
							'</input>';
			

			
        }

        /* **************************************
		* CAPTCHA
		***************************************** */
        else if ( fieldObj.inputType == "recaptcha" ) {
        	mylog.log("build field "+field+">>>>>> recaptcah");
        	fieldHTML += '<div class="g-recaptcha" data-sitekey="'+fieldObj.key+'"></div>';
        } 
        

        /* **************************************
		* CUSTOM 
		***************************************** */
        else if ( fieldObj.inputType == "custom" ) {
        	mylog.log("build field "+field+">>>>>> custom");

        	fieldHTML += (typeof fieldObj.html == "function") ? fieldObj.html() : fieldObj.html;
        } 
        /* **************************************
        * CREATE NEWS
        ************************************** */
        else if( fieldObj.inputType == "createNews"){
        	var newsContext=fieldObj.params;
        	if(newsContext.targetType!="citoyens"){
        		if(newsContext.authorImg=="")
        			var authorImg=moduleUrl+'/images/thumb/default_citoyens.png';
        		else
        			var authorImg=baseUrl+newsContext.authorImg;
        		if(newsContext.targetImg=="")
        			var targetImg=moduleUrl+'/images/thumb/default_'+newsContext.targetType+'.png';
        		else
        			var targetImg=baseUrl+newsContext.targetImg;
        		//targetName=newsContext.targetName;
        		//authorName=newsContext.authorName;
        	}
        	fieldHTML='<div id="createNews" class="form-group">'+
        			'<label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="post">'+
			            '<i class="fa fa-chevron-down"></i> '+tradDynForm.writenewshere+
			        '</label>'+
			        '<div id="mentionsText" class="col-md-12 col-sm-12 col-xs-12 no-padding">'+
        				'<textarea name="newsText"></textarea>'+
        			'</div>'+
					'<label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="post">'+
			            '<i class="fa fa-chevron-down"></i> '+tradDynForm.tags+
			        '</label>'+
        			'<div class="no-padding">'+
          				'<input id="tags" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">'+
      				'</div>'+
        			'<label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="post">'+
			            '<i class="fa fa-chevron-down"></i> '+tradDynForm.newsvisibility+
			        '</label>'+
        			'<div class="dropdown no-padding col-md-12 col-sm-12 col-xs-12">'+
          				'<a data-toggle="dropdown" class="btn btn-default col-md-12 col-sm-12 col-xs-12" id="btn-toogle-dropdown-scope" href="javascript:;">'+
          					'<i class="fa fa-connectdevelop"></i> '+tradDynForm.network+' <i class="fa fa-caret-down" style="font-size:inherit;"></i>'+
          				'</a>'+
          				'<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
          					if(newsContext.targetType != "events"){
            fieldHTML+=		'<li>'+
              					'<a href="javascript:;" id="scope-my-network" class="scopeShare" data-value="private">'+
              						'<h4 class="list-group-item-heading"><i class="fa fa-lock"></i> '+tradDynForm.private+'</h4>'+
               						'<p class="list-group-item-text small">'+tradDynForm["explainprivate"+newsContext.targetType]+'</p>'+
              					'</a>'+
            				'</li>';
            				}
            fieldHTML+=		'<li>'+
              					'<a href="javascript:;" id="scope-my-network" class="scopeShare" data-value="restricted">'+
              						'<h4 class="list-group-item-heading"><i class="fa fa-connectdevelop"></i> '+tradDynForm.network+'</h4>'+
                					'<p class="list-group-item-text small"> '+tradDynForm.explainnetwork+'</p>'+
              					'</a>'+
				            '</li>'+
				            '<li>'+
				              	'<a href="javascript:;" id="scope-my-wall" class="scopeShare" data-value="public">'+
				              		'<h4 class="list-group-item-heading"><i class="fa fa-globe"></i> '+tradDynForm.public+'</h4>'+
				                    '<p class="list-group-item-text small">'+tradDynForm.explainpublic+'</p>'+
				              	'</a>'+
				            '</li>'+
			            '</ul>'+
			            '<input type="hidden" name="scope" id="scope" value="restricted"/>'+
	        		'</div>';
	        		if(newsContext.targetType!="citoyens"){
	        fieldHTML+=		'<label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="post">'+
			            '<i class="fa fa-chevron-down"></i> '+tradDynForm.newsauthor+
		            '</label>'+
        			'<div class="dropdown no-padding col-md-12">'+
          				'<a data-toggle="dropdown" class="btn btn-default col-md-12 col-sm-12 col-xs-12 text-left" id="btn-toogle-dropdown-targetIsAuthor" href="javascript:;">'+
           					'<img height=20 width=20 src="'+targetImg+'">'+  
           					' '+newsContext.targetName+
				            ' <i class="fa fa-caret-down" style="font-size:inherit;"></i>'+
				        '</a>'+
				        '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">'+
				            '<li>'+
              					'<a href="javascript:;" class="targetIsAuthor" data-value="1" data-name="'+newsContext.targetName+'">'+
					                '<h4 class="list-group-item-heading">'+
					                  	'<img height=20 width=20 src="'+targetImg+'">'+  
					                	' '+newsContext.targetName+
					                '</h4>'+
					                '<p class="list-group-item-text small">'+tradDynForm.show+' '+newsContext.targetName+' '+tradDynForm.asAuthor+'</p>'+
					            '</a>'+
					        '</li>'+
					        '<li>'+
				              	'<a href="javascript:;" class="targetIsAuthor" data-value="0" data-name="'+tradDynForm.me+'">'+
				              		'<h4 class="list-group-item-heading">'+
				                		'<img height=20 width=20 src="'+authorImg+'">'+  
				                		' '+tradDynForm.me+
				                	'</h4>'+
				                	'<p class="list-group-item-text small"> '+tradDynForm.iamauthor+'</p>'+
				              	'</a>'+
				            '</li>'+
				        '</ul>'+
				        '<input type="hidden" id="authorIsTarget" value="1"/>'+
        			'</div>';
        			}
        	fieldHTML+=	'</div>';  
          
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
				fieldHTML += 							'<h4 class="text-dark"><i class="fa fa-angle-down"></i> ! '+fieldObj.title2+'</h4>';
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
														//mylog.log("data contact +++++++++++ "); mylog.dir(value);
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
        else if ( fieldObj.inputType == "password" ) {
        	mylog.log("build field "+field+">>>>>> password");
        	fieldHTML += '<input id="'+field+'" name="'+field+'" class="form-control" type="password"/>';
       	}
        else {
        	mylog.log("build field "+field+">>>>>> input text");
        	fieldHTML += iconOpen+'<input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        }
        if( fieldObj.custom )
        	fieldHTML += fieldObj.custom ;

		fieldHTML += '</div>';

		$(id).append(fieldHTML);

		//Post creation initialisation
		if( fieldObj.init && $.isFunction(fieldObj.init) )
        	fieldObj.init(field+fieldObj.inputType);
        if(initField && $.isFunction(initField) )
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
		mylog.info("connecting submit btn to $.validate pluggin");
		mylog.dir(formRules);
		var errorHandler = $('.errorHandler', $(params.formId));
//alert(params.formId);
		$(params.formId).validate({

			rules : formRules,

			submitHandler : function(form) {
				//alert(dyFObj.activeModal+" #btn-submit-form");
				$(dyFObj.activeModal+" #btn-submit-form").html( '<i class="fa  fa-spinner fa-spin fa-"></i>' ).prop("disabled",true);
				errorHandler.hide();
				mylog.info("form submitted "+params.formId);
				
				if(params.beforeSave && jQuery.isFunction( params.beforeSave ) )
					params.beforeSave();

				if(params.onSave && jQuery.isFunction( params.onSave ) ){
					//	alert("onSave")
					params.onSave();
					return false;
		        } 
		        else {
		        	//TODO SBAR - Remove notPost form element
		        	/*$.each($(params.formId).serializeArray()).function() {
		        		if ($this.)
		        	}*/
		        	mylog.info("default SaveProcess",params.savePath);
		        	mylog.dir($(params.formId).serializeFormJSON());
		        	$.ajax({
		        	  type: "POST",
		        	  url: params.savePath,
		        	  data: $(params.formId).serializeFormJSON(),
		              dataType: "json"
		        	}).done( function(data){
		                if( afterDynBuildSave && typeof afterDynBuildSave == "function" )
		                    afterDynBuildSave(data.map,data.id);
		                mylog.info('saved successfully !');

		        	});
					return false;
			    }
			    
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
				$("#btn-submit-form").html('Valider <i class="fa fa-arrow-circle-right"></i>').prop("disabled",false).one(function() { 
					$( settings.formId ).submit();	        	
		        });
			}
		});
		
		mylog.info("connecting any specific input event select2, datepicker...");
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
						mylog.error("select2 library is missing");
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
					mylog.log( "id xxxxxxxxxxxxxxxxx " , $(this).attr("id") , initValues[ $(this).attr("id") ] );
					if( initValues[ $(this).attr("id") ] )
					{
						var selectOptions = 
						{
						  "tags": initValues[ $(this).attr("id") ].tags ,
						  "tokenSeparators": [','],
						  "placeholder" : ( $(this).attr("placeholder") ) ? $(this).attr("placeholder") : "",
						};
						if(initValues[ $(this).attr("id") ].maximumSelectionLength)
							selectOptions.maximumSelectionLength = initValues[$(this).attr("id")]["maximumSelectionLength"];
						if(typeof initSelectNetwork != "undefined" && typeof initSelectNetwork[$(this).attr("id")] != "undefined" && initSelectNetwork[$(this).attr("id")].length > 0)
							selectOptions.data=initSelectNetwork[$(this).attr("id")];
						
						$(this).removeClass("form-control").select2(selectOptions);
						if(typeof mainTag != "undefined")
							$(this).val([mainTag]).trigger('change');
					}
				 });
			} else
				mylog.error("select2 library is missing");
		} 

		/* **************************************
		* DATE INPUT , we use http://xdsoft.net/jqplugins/datetimepicker/
		***************************************** */
		function loadDateTimePicker(callback) {
			if( ! jQuery.isFunction(jQuery.datetimepicker) ) {
				lazyLoad( baseUrl+'/plugins/xdan.datetimepicker/jquery.datetimepicker.full.min.js', 
						  baseUrl+'/plugins/xdan.datetimepicker/jquery.datetimepicker.min.css',
						  callback);
		    }
		}

		var initDate = function(){
			mylog.log("init dateInput");
			jQuery.datetimepicker.setLocale('fr');
			$(".dateInput").datetimepicker({ 
		        autoclose: true,
		        lang: "fr",
		        format: "d/m/Y",
		        timepicker:false
		    });
		};

		if(  $(".dateInput").length){
			loadDateTimePicker(initDate);
		}
		/* **************************************
		* DATE INPUT , we use http://xdsoft.net/jqplugins/datetimepicker/
		***************************************** */
	
		var initDateTime = function(){
			mylog.log("init dateTimeInput");
			jQuery.datetimepicker.setLocale('fr');
			$(".dateTimeInput").datetimepicker({
				weekStart: 1,
				step: 15,
				lang: 'fr',
				format: 'd/m/Y H:i'
			   });
		};
		if(  $(".dateTimeInput").length){
			loadDateTimePicker(initDateTime);
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
		        //if(typeof showFormInMap != "undefined"){ showFormInMap(); }
		        if(typeof formInMap.showMarkerNewElement != "undefined"){ formInMap.showMarkerNewElement(); }
		    });
		}

		/* **************************************
		* Postal Code type 
		***************************************** */
		if(  $(".postalCodeBtn").length)
		{
			//todo : for generic dynForm check if map exist 
			$(".postalCodeBtn").off().on( "click", function(){ 
				$("#ajax-modal").modal("hide");
		        showMap(true);
		        //if(typeof showFormInMap != "undefined"){ showFormInMap(); }
		        if(typeof formInMap.showMarkerNewElement != "undefined"){ formInMap.showMarkerNewElement(true); }
		    });
		}
		
		/* **************************************
		* Image uploader , we use https://github.com/FineUploader/fine-uploader
		***************************************** */
		if(  $(".fine-uploader-manual-trigger").length)
		{
			function loadFineUploader(callback,template) {
				if( ! jQuery.isFunction(jQuery.fineUploader) ) {
					if(template=='qq-template-manual-trigger')
						var cssLazy=baseUrl+'/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-new.min.css';
					else
						var cssLazy=baseUrl+'/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-gallery.css';
					lazyLoad( baseUrl+'/plugins/fine-uploader/jquery.fine-uploader/jquery.fine-uploader.js', 
							  cssLazy,
							  callback);
			    }
			}
			var docListIds=[];
			var FineUploader = function(){
				mylog.log("init fineUploader");
				$(".fine-uploader-manual-trigger").fineUploader({
		            template: (initValues.template) ? initValues.template : 'qq-template-manual-trigger',
		            request: {
		                endpoint: uploadObj.path
		            },
		            validation: {
		                allowedExtensions: (initValues.filetypes) ? initValues.filetypes : ['jpeg', 'jpg', 'gif', 'png'],
		                sizeLimit: 2000000
		            },
		            messages: {
				        sizeError : '{file} '+tradDynForm.istooheavy+'! '+tradDynForm.limitmax+' : {sizeLimit}.',
				        typeError : '{file} '+tradDynForm.invalidextension+'. '+tradDynForm.extensionacceptable+': {extensions}.'
				    },
		            callbacks: {
		            	//when a img is selected
					    onSubmit: function(id, fileName) {
					    	$('.fine-uploader-manual-trigger').fineUploader('setEndpoint',uploadObj.path);	
					    	//$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
    					    if( initValues.showUploadBtn  ){
						      	$('#trigger-upload').removeClass("hide").click(function(e) {
				        			$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
						        	urlCtrl.loadByHash(location.hash);
				        			$('#ajax-modal').modal("hide");
						        });

					        }
					    },
					    onCancel: function(id) {
					    	if(($("ul.qq-upload-list > li").length-1)<=0)
					    		$('#trigger-upload').addClass("hide");
	        			},
	        			
					    //launches request endpoint
					    //onUpload: function(id, fileName) {
					      //alert(" > upload : "+id+fileName+contextData.type+contextData.id);
					      //alert(" > request : "+ uploadObj.id +" :: "+ uploadObj.type);
					      //console.log('onUpload uplaodObj',uploadObj);
					      //var ex = $('.fine-uploader-manual-trigger').fineUploader('getEndpoint');
					      //console.log('onUpload getEndpoint',ex);
					    //},
					    //launched on upload
					    //onProgress: function(id, fileName, uploadedBytes,totalBytes) {
					    	/*console.log('onProgress uplaodObj',uploadObj);
					    	var ex = $('.fine-uploader-manual-trigger').fineUploader('getEndpoint');
					    	console.log('onProgress getEndpoint',ex);
					    	console.log('getInProgress',$('.fine-uploader-manual-trigger').fineUploader('getInProgress'));*/
					      //alert("progress > "+" :: "+ uploadObj.id +" :: "+ uploadObj.type);
					    //},
					    //when every img finish upload process whatever the status
					    onComplete: function(id, fileName,responseJSON,xhr) {
					    	
					    	console.log(responseJSON);
					    	
					    	if($("#ajaxFormModal #newsCreation").val()=="true"){
					    		docListIds.push(responseJSON.id.$id);
					    	}
					    	if(!responseJSON.result){
					    		toastr.error(trad["somethingwentwrong"]+" : "+responseJSON.msg );		
					    		console.error(trad["somethingwentwrong"] , responseJSON.msg)
					    	}
					    },
					    //when all upload is complete whatever the result
					    onAllComplete: function(succeeded, failed) {
					     	toastr.info( "Fichiers bien chargés !!");
					      	if($("#ajaxFormModal #newsCreation").val()=="true"){
					      		console.log("docslist",docListIds);
					      		//var mentionsInput=[];
					      		/*$('#ajaxFormModal #createNews textarea').mentionsInput('getMentions', function(data) {
      								mentionsInput=data;
    							});*/
					      		var media=new Object;
					      		if(uploadObj.contentKey=="file"){
					      			media.type="gallery_files";
					      			media.countFiles=docListIds.length;
					      			media.files=docListIds;
					      		}else{
					      			media.type="gallery_images";
					      			media.countImages=docListIds.length;
					      			media.images=docListIds;
					      		}
					    		var addParams = {
	              				  type: "news",
	              				  parentId: uploadObj.id,
	              				  parentType: uploadObj.type,
	              				  scope:$("#ajaxFormModal #createNews #scope").val(),
	              				  text:$("#ajaxFormModal #createNews textarea").val(),
	              				  media: media
	            				};
	            				if ($("#ajaxFormModal #createNews #tags").val() != "")
									addParams.tags = $("#ajaxFormModal #createNews #tags").val().split(",");
								if($('#ajaxFormModal #createNews #authorIsTarget').length && $('#ajaxFormModal #createNews #authorIsTarget').val()==1)
									addParams.targetIsAuthor = true;
								/*if (mentionsResult.mentionsInput.length != 0){
									addParams.mentions=mentionsResult.mentionsInput;
									addParams.text=mentionsResult.text;
								}*/
								addParams=mentionsInit.beforeSave(addParams,'#ajaxFormModal #createNews textarea');
								$.ajax({
							        type: "POST",
							        url: baseUrl+"/"+moduleId+"/news/save?tpl=co2",
							        //dataType: "json",
							        data: addParams,
									type: "POST",
							    })
							    .done(function (data) {
						    		
									return true;
							    }).fail(function(){
								   toastr.error("Something went wrong, contact your admin"); 
								   $("#btn-submit-form i").removeClass("fa-circle-o-notch fa-spin").addClass("fa-arrow-circle-right");
								   $("#btn-submit-form").prop('disabled', false);
							    });
							}
					    if( jQuery.isFunction(initValues.afterUploadComplete) )
					      	initValues.afterUploadComplete();
					     	uploadObj.gotoUrl = null;
					    },
					    onError: function(id) {
					      toastr.info(trad["somethingwentwrong"]);
					    }
					},
		            thumbnails: {
		                placeholders: {
		                    waitingPath: baseUrl+'/plugins/fine-uploader/jquery.fine-uploader/processing.gif',
		                    notAvailablePath: baseUrl+'/plugins/fine-uploader/jquery.fine-uploader/retry.gif'
		                }
		            },
		            autoUpload: false
		        });
			};
			if(  $(".fine-uploader-manual-trigger").length)
				loadFineUploader(FineUploader,initValues.template);
		}

		/* **************************************
		* DATE RANGE INPUT , we use https://github.com/dangrossman/bootstrap-daterangepicker
		***************************************** */
		if( $(".daterangeInput").length){
			var initDateRange = function(){
								$('.daterangeInput').daterangepicker({
						            timePicker: true,
						            timePickerIncrement: 30,
						            format: 'DD/MM/YYYY h:mm A'
						        }, function(start, end, label) {
						            mylog.log(start.toISOString(), end.toISOString(), label);
						        });
							};
			if( jQuery.isFunction(jQuery.fn.daterangepicker) )
				initDateRange();
			else
				lazyLoad( baseUrl+'/plugins/bootstrap-daterangepicker/daterangepicker.js' ,  
						  baseUrl+'/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
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
			//if(  $(".addmultifield1").length )
			//	$('head').append('<style type="text/css">.inputs textarea.addmultifield1{width:90%; height:34px;}</style>');

			//intialise event on the add new row button 
			$('.addPropBtn').unbind("click").click(function()
			{ 
				var field = $(this).data('id');
				if( $('.'+field+' .inputs .addmultifield:visible').length==0 || ( $("."+field+" .addmultifield:last").val() != "" && $( "."+field+" .addmultifield1:last" ).val() != "") )
					addfield('.'+$(this).data('container'),'',field);
				else
					toastr.info("please fill properties first");
			} );
		}

		/* **************************************
		* WYSIWYG 
		***************************************** */
		if(  $(".wysiwygInput").length )
		{
			console.log("wysiwygInput wysiwygInput");
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
			    	lazyLoad( baseUrl+'/plugins/summernote/dist/summernote.min.js', 
							  baseUrl+'/plugins/summernote/dist/summernote.css',
							  initField);
		    	}
			}
		}

	}

	/* **************************************
	* MARKDOWN 
	***************************************** */
	if(  $(".markdownInput").length )
	{
		console.log("markdownInput");
		var initField = function(){
			$(".markdownInput").markdown({
					savable:true,
					onPreview: function(e) {
						var previewContent = "";
					    mylog.log(e);
					    mylog.log(e.isDirty());
					    if (e.isDirty()) {
					    	var converter = new showdown.Converter(),
					    		text      = e.getContent(),
					    		previewContent      = converter.makeHtml(text);
					    } else {
					    	previewContent = "Default content";
					    }
					    return previewContent;
				  	},
				  	onSave: function(e) {
				  		mylog.log(e);
				  	},
				});

			
			lazyLoad( 	baseUrl+'/plugins/showdown/showdown.min.js',
							baseUrl+'/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
							baseUrl+'/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css',
							initField);
	    	
		}
	}


	//if(  $(".maxlengthTextarea").length ){
	//	mylog.log("here .maxlengthTextarea"); 

		/*$(".maxlengthTextarea").off().keyup(function(){
			mylog.log(".maxlengthTextarea", $(this).attr("id"), $(this).html().length)
			$(".maxlength"+$(this).attr("id")).html($(this).html().length );
		});*/
	//}

	

	/* **************************************
	*
	*	specific methods for each type of input
	*
	***************************************** */
	/* **************************************
	* add a new line to the multi line process 
	* val can be a value when type array or {"label":"","value":""} when type property
	***************************************** */
	function addfield( parentContainer,val,name ) 
	{
		mylog.log("addfield",parentContainer+' .inputs',val);
		if(!$.isEmptyObject($(parentContainer+' .inputs')))
	    {
	    	if($(parentContainer+' .properties').length > 0)
	    		$( propertyLineHTML( val,name ) ).fadeIn('slow').appendTo(parentContainer+' .inputs');
	    	else
	    		$( arrayLineHTML( val,name ) ).fadeIn('slow').appendTo(parentContainer+' .inputs');
	    	
	    	$(".loading_indicator").hide();

	    	$(parentContainer+' .addmultifield:last').focus();
	        initMultiFields(parentContainer,name);
	    }else 
	    	mylog.error("container doesn't seem to exist : "+parentContainer+' .inputs');
	}
	
	/* **************************************
	* initiliase events 
	* prevent submitting empty fields 
	* remove a field
	* enter key submition
	***************************************** */
	function initMultiFields(parentContainer,name){
		mylog.log("initMultiFields",parentContainer);
	  //manage using Enter to make easy loop editing
	  $(parentContainer+' .addmultifield').unbind('keydown').keydown(function(event) 
	  {
	  	if ( event.keyCode == 13)
	    {
			event.preventDefault();
	        if( $(this).val() != ""){
	        	if( $( this ).parent().next().children(".addmultifield1").val() != "" )
	        		addfield(parentContainer,'',name);
	        	else 
	        		$( this ).parent().next().children(".addmultifield1").focus();
	        } 
	        else
	        	toastr.warning("La paire (clef/valeure) doit etre remplie.");
	    }
	  });

	  var count = $(".addmultifield").length-1;
	  getMediaFromUrlContent(parentContainer+" .addmultifield"+count, ".resultGetUrl"+count,0);
	  //manage using Enter to make easy loop editing
	  //for 2nd property field
	  $(parentContainer+' .addmultifield1').unbind('keydown').keydown(function(event) 
	  {
	  	if ( event.ctrlKey &&  event.keyCode == 13)
	    {
			event.preventDefault();
	        if( $(this).val() != "" && $( this ).parent().prev().children(".addmultifield").val() != "" )
	        	addfield(parentContainer,'',name);
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
	function propertyLineHTML(propVal,name)
	{
		mylog.log("propertyLineHTML",propVal);
		if( typeof propVal == "undefined" ) 
	    	propVal = {"label":"","value":""};
		var str = '<div class="space5"></div><div class="col-sm-3">'+
					'<img class="loading_indicator" src="'+assetPath+'/images/news/ajax-loader.gif">'+
					'<input type="text" name="'+name+'[]" class="addmultifield addmultifield'+count+' form-control input-md" value="'+propVal.label+'" />'+
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
	function arrayLineHTML(val,name)
	{
		mylog.log("arrayLineHTML : ",val);
		if( typeof val == "undefined" ) 
	    	val = "";
	    var count = $(".addmultifield").length;
		var str = 	'<div class="col-sm-12 no-padding margin-top-10">'+
					'<div class="col-sm-10 no-padding">'+
							'<img class="loading_indicator" src="'+assetPath+'/images/news/ajax-loader.gif">'+
							'<input type="text" name="'+name+'[]" class="addmultifield addmultifield'+count+' form-control input-md" value="'+val+'" placeholder="..."/>'+
							'<div class="resultGetUrl resultGetUrl'+count+' col-sm-12"></div>'+
						'</div>'+
						'<div class="col-sm-2 sectionRemovePropLineBtn">'+
							'<a href="javascript:" class="removePropLineBtn col-md-12 btn btn-link letter-red" alt="Remove this line"><i class=" fa fa-minus-circle" ></i></a>'+
						'</div>'+
					'</div>';

		mylog.log("-------------------------");
		/*'<div class="space5"></div><div class="col-sm-10">'+
					'<img class="loading_indicator" src="'+assetPath+'/images/news/ajax-loader.gif">'+
					'<input type="text" name="'+name+'[]" class="addmultifield addmultifield'+count+' form-control input-md" value="'+val+'"/>'+
					'<div class="resultGetUrl resultGetUrl'+count+' col-sm-12"></div>'+
					'</div>'+
					'<div class="col-sm-2">'+
					'<button class="pull-right removePropLineBtn btn btn-xs btn-blue tooltips pull-left" data- data-original-title="Retirer cette ligne" data-placement="bottom"><i class=" fa fa-minus-circle" ></i></button>'+
				'</div>';*/
		return str;
	}
	function buildMediaHTML(mediaObj){
		mylog.log("buildMediaHTML : ",mediaObj.name);
		var str = '<div class="extracted_url padding-10">'+
				'<div class="extracted_thumb  col-xs-4" id="extracted_thumb">'+
					'<a href="#" class="videoSignal text-white center"><i class="fa fa-3x fa-play-circle-o"></i>'+
					'<input class="videoLink" value="'+mediaObj.content.url+'" type="hidden"></a>'+
					'<img src="'+mediaObj.content.image+'" width="100" height="100">'+
				'</div>'+
				'<div class="extracted_content col-xs-8 padding-5">'+
					'<h4><a href="'+mediaObj.content.url+'" target="_blank" class="lastUrl text-dark">'+mediaObj.name+'</a></h4>'+
					'<p>'+mediaObj.description+'</p>'+
				'</div>'+
			'</div>';
		return str;
	}

	/* **************************************
	* init Boostrap Switch
	***************************************** */
	function initbootstrapSwitch(el,change)
	{
		var initSwitch = function(){
							mylog.log("init bootstrap switch");
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
	    	lazyLoad( baseUrl+'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js', 
					  baseUrl+'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
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
	//mylog.log("getPairs",parentContainer);
    var properties = {};
    $.each($(parentContainer+' .addmultifield'), function(i,el) {
    	if( $(this).val() != "" && $( this ).parent().next().children(".addmultifield1") != "" ){
	        properties[ slugify($(this).val()) ] = { "label" : $(this).val(),
	        										  "value" : $( this ).parent().next().children(".addmultifield1").val()};
	    }
    });
    //mylog.dir("getPairs",properties);
    return properties;
}

function getArray(parentContainer)
{
	//mylog.log("getArray",parentContainer);
    var list = [];
    $.each($(parentContainer+' .addmultifield'), function(i,el) {
    	if( $(this).val() != ""  ){
	        list.push( $(this).val() );
	    }
    });
    //mylog.dir("getArray",list);
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

