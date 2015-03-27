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
				onSave: null
			};

			var settings = $.extend({}, defaults, options);
			$this = this;
			console.log("build dyn Form",settings.formId);
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
				
				fieldHTML = buildInputField(field, fieldObj, settings.formValues);
				$(settings.formId).append(fieldHTML);
			});
			
			/* **************************************
			* CONTEXT ELEMENTS, used for saving purposes
			***************************************** */
			fieldHTML = '<input type="hidden" name="key" value="'+settings.formObj.key+'"/>';
	        fieldHTML += '<input type="hidden" name="collection" value="'+settings.formObj.collection+'"/>';
	        fieldHTML += '<input type="hidden" name="id" value="'+((settings.formObj.id) ? settings.formObj.id : "")+'"/>';
	       
        	fieldHTML += '<div class="form-actions">'+
						'<button type="submit" class="btn btn-green pull-right">'+
							'Submit <i class="fa fa-arrow-circle-right"></i>'+
						'</button>'+
					'</div>';

	        $(settings.formId).append(fieldHTML);

			/* **************************************
			* bind any events Post building 
			***************************************** */
			var path = (settings.savePath) ? settings.savePath : '/common/save/';
			bindDynFormEvents(settings.formId,path,settings.onSave,form.rules);

			if(settings.onLoad && jQuery.isFunction( settings.onLoad ) )
				settings.onLoad();
		    

			return form;
		},

		/*buildForm: function() { 
			console.dir($this.formObj);
		},*/

	});
		
	function buildInputField(field, fieldObj,formValues)
	{
		var fieldHTML = '<div class="form-group">';
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
        var fieldClass = (fieldObj.class) ? fieldObj.class : '';
        var value = "";
        if( fieldObj.value ) 
        	value = fieldObj.value;
        else if (formValues && formValues[field]) 
        	value = formValues[field];

        /* **************************************
		* 
		***************************************** */
        if( field.indexOf("separator")>=0 ) 
        	fieldHTML += '<div class="text-large text-bold panel-blue text-white center padding-10'+fieldClass+'">'+iconOpen+iconClose+fieldObj.title+'</div>';
        
        /* **************************************
		* STANDARD TEXT INPUT
		***************************************** */
        else if( !fieldObj.inputType || fieldObj.inputType == "text" || fieldObj.inputType == "numeric" ) 
        	fieldHTML += iconOpen+'<input type="text" class="form-control '+fieldClass+'" name="'+field+'" id="'+field+'" value="'+value+'" placeholder="'+placeholder+'"/>'+iconClose;
        
        /* **************************************
		* HIDDEN
		***************************************** */
        else if( fieldObj.inputType == "hidden" ) 
        	fieldHTML += '<input type="hidden" name="'+field+'" id="'+field+'" value="'+value+'"/>';
        
        /* **************************************
		* TEXTAREA
		***************************************** */
        else if ( fieldObj.inputType == "textarea" ) 
        	fieldHTML += '<textarea id="'+field+'" class="form-control '+fieldClass+'" name="'+field+'" placeholder="'+placeholder+'">'+value+'</textarea>';
        
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
        else if ( fieldObj.inputType == "select" ) {
        	if(value == "")
        		value="25/01/2014";
        	fieldHTML += '<select class="select2Input '+fieldClass+'" name="'+field+'" id="'+field+'" style="width: 100%;height:30px">'+
        					 '<option value="">'+placeholder+'</option>';
			$.each(fieldObj.options, function(optKey, optVal) { 
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
        
		fieldHTML += '</div>';
		return fieldHTML;
	}

	var afterDynBuildSave = null;
	function bindDynFormEvents (id, path, onSave, formRules) {  

		var errorHandler = $('.errorHandler', $(id));
		$(id).validate({

			rules : formRules,

			submitHandler : function(form) {
				errorHandler.hide();

				 $.blockUI({
                    message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
                    '<blockquote>'+
                      "<p>Je désapprouve ce que vous dites, mais je me battrai jusqu'à la mort pour que vous ayez le droit de le dire..</p>"+
                      '<cite title="Hegel">Voltaire</cite>'+
                    '</blockquote> '
                });

				if(onSave && jQuery.isFunction( onSave ) ){
					onSave();
		        } else {
		        	$.ajax({
		        	  type: "POST",
		        	  url: baseUrl+path,
		        	  data: $(id).serializeFormJSON(),
		              dataType: "json",
		        	  success: function(data)
		              {
		                if( afterDynBuildSave && typeof afterDynBuildSave == "function" )
		                    afterDynBuildSave(data.map,data.id);
		                $.unblockUI();
		                toastr.success('saved successfully !');
		        	  }
		        	});
			    }
			    return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});
		
		/* **************************************
		* SELECTs , we use select2 lib
		***************************************** */
		$(".select2Input").select2();

		/* **************************************
		* DATE INPUT , we use bootstrap-datepicker lib
		***************************************** */
		$(".dateInput").datepicker({ 
	        autoclose: true,
	        language: "fr",
	        format: "dd/mm/yy"
	    });
	}

})(jQuery);

