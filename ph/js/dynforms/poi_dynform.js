var dynForm = { 
		col:"poi",
		ctrl:"poi",
		color:"azure",
		icon:"info-circle",

		dynForm : {
		    jsonSchema : {
			    title : "Formulaire Point d'interet",
			    icon : "map-marker",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	subPoi : function(){
			    		if(contextData.type && contextData.id )
			    		{
		    				$('#ajaxFormModal #parentId').val(contextData.id);
			    			$("#ajaxFormModal #parentType").val( contextData.type ); 
			    		}
			    	}
			    },
			    beforeSave : function(){
			    	
			    	if( typeof $("#ajaxFormModal #description").code === 'function' )  
			    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
			    	if($('#ajaxFormModal #parentId').val() == "" && $('#ajaxFormModal #parentType').val() ){
				    	$('#ajaxFormModal #parentId').val(userId);
				    	$("#ajaxFormModal #parentType").val( "citoyens" ); 
				    }
			    },
			    beforeBuild : function(){
			    	elementLib.setMongoId('poi');
			    },
				afterSave : function(){
					if( $('.fine-uploader-manual-trigger').fineUploader('getUploads').length > 0 )
				    	$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
				    else {
				    	elementLib.closeForm();
				    	loadByHash( location.hash );	
				    }
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Un Point d'interet est un élément assez libre qui peut etre géolocalisé ou pas, qui peut etre rataché à une organisation, un projet ou un évènement.</p>",
		            },
		            type :{
		            	inputType : "select",
		            	placeholder : "Type du point d'intérêt",
		            	options : poiTypes
		            },
			        name : {
			        	placeholder : "Nom",
			            inputType : "text",
			            rules : { required : true }
			        },
			        image :{
		            	inputType : "image",
		            	afterUploadComplete : function(){
					    	elementLib.closeForm();
			                loadByHash( location.hash );	
					    },
		            },
		            description : {
		                inputType : "wysiwyg",
	            		placeholder : "Décrire c'est partager",
	            		init:function(){
				      		activateSummernote("#ajaxFormModal #description");
			            }
		            },
		            location : {
		               inputType : "location"
		            },
		            tags :{
		                inputType : "tags",
		                placeholder : "Tags ou Types de point d'interet",
		                values : tagsList
		            },
		            formshowers : {
		                inputType : "custom",
		                html: "<a class='btn btn-default text-dark w100p' href='javascript:;' onclick='$(\".urlsarray\").slideToggle()'><i class='fa fa-plus'></i> options (urls)</a>",
		            },
		            urls : {
			        	placeholder : "url",
			            inputType : "array",
			            value : [],
			            init:function(){
				            getMediaFromUrlContent(".addmultifield0", ".resultGetUrl0",0);
			            	$(".urlsarray").css("display","none");	
			            }
			        },
		            parentId :{
		            	inputType : "hidden"
		            },
		            parentType : {
			            inputType : "hidden"
			        },
			    }
			}
		}}