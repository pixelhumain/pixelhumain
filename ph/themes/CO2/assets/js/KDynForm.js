
function openForm (type, afterLoad,data) { 
    //mylog.clear();
    $.unblockUI();
    console.warn("--------------- Open Form "+type+" ---------------------",data);
    mylog.dir(data);
    elementLocation = null;
    elementLocations = [];
    centerLocation = null;
    updateLocality = false;
    formType = type;
    specs = typeObj[type];
    if(specs.lbh){
    	loadByHash(specs.lbh);
    }
	else if( specs.form && specs.form.url ) {
		//charge le resultat d'une requete en Ajax
		getModal( { title : specs.form.title , icon : "fa-"+specs.icon } , specs.form.url );
	} else if( specs.dynForm )
	{
		mylog.dir(specs);
		// $("#ajax-modal").removeClass("bgEvent bgOrga bgProject bgPerson bgDDA").addClass(specs.bgClass);
		// $("#ajax-modal-modal-title").html("<i class='fa fa-refresh fa-spin'></i> Chargement en cours. Merci de patienter.");
		// $(".modal-header").removeClass("bg-purple bg-green bg-orange bg-yellow bg-lightblue ").addClass(specs.titleClass);
	 //  	$("#ajax-modal-modal-body").html( "<div class='row bg-white'>"+
	 //  										"<div class='col-sm-10 col-sm-offset-1'>"+
		// 					              	"<div class='space20'></div>"+
		// 					              	//"<h1 id='proposerloiFormLabel' >Faire une proposition</h1>"+
		// 					              	"<form id='ajaxFormModal' enctype='multipart/form-data'></form>"+
		// 					              	"</div>"+
		// 					              "</div>");
	  	//$('.modal-footer').hide();
	  	//$('#ajax-modal').modal("show");
	  	afterLoad = ( notNull(afterLoad) ) ? afterLoad : null;
	  	data = ( notNull(data) ) ? data : {};
	  	buildDynForm(specs, afterLoad, data);
	} else 
		toastr.error("Ce type ou ce formulaire n'est pas déclaré");
}



function buildDynForm(elementObj, afterLoad,data) { 
	mylog.warn("--------------- buildDynForm", afterLoad,data);
	//if(userId)
	//{
		var form = $.dynForm({
		      formId : "#dynForm",
		      formObj : elementObj.dynForm,
		      formValues : data,
		      onLoad : function  () {
		        //$("#ajax-modal-modal-title").html("<i class='fa fa-"+elementObj.dynForm.jsonSchema.icon+"'></i> "+elementObj.dynForm.jsonSchema.title);
		        //$("#ajax-modal-modal-body").append("<div class='space20'></div>");
		        //alert(afterLoad+"|"+typeof elementObj.dynForm.jsonSchema.onLoads[afterLoad]);
		        if( notNull(afterLoad) && elementObj.dynForm.jsonSchema.onLoads 
		        	&& elementObj.dynForm.jsonSchema.onLoads[afterLoad] 
		        	&& typeof elementObj.dynForm.jsonSchema.onLoads[afterLoad] == "function" )
		        	elementObj.dynForm.jsonSchema.onLoads[ afterLoad](data);
		        //incase we need a second global post process
		        if( notNull(afterLoad) && elementObj.dynForm.jsonSchema.onLoads 
		        	&& elementObj.dynForm.jsonSchema.onLoads[afterLoad] 
		        	&& typeof elementObj.dynForm.jsonSchema.onLoads.onload == "function" )
		        	elementObj.dynForm.jsonSchema.onLoads.onload();
		        bindLBHLinks();
		      },
		      onSave : function(){

		      	if( elementObj.dynForm.jsonSchema.beforeSave && typeof elementObj.dynForm.jsonSchema.beforeSave == "function")
		        	elementObj.dynForm.jsonSchema.beforeSave();

		        if( elementObj.save )
		        	elementObj.save("#ajaxFormModal");
		        else if(elementObj.saveUrl)
		        	saveElement("#ajaxFormModal",elementObj.col,elementObj.ctrl,elementObj.saveUrl);
		        else
		        	saveElement("#ajaxFormModal",elementObj.col,elementObj.ctrl);

		        return false;
		    }
		});
		mylog.dir(form);
	//} else 
		//toastr.error('Vous devez etre loggué');
}

