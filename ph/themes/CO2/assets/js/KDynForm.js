


	var KSpec = {
		"LocalBusiness" : {
			title: "entreprise",
			title2: "de l'entreprise",
			title3: "cette entreprise",
			color: "azure",
			icon: "industry",
		},
		"NGO" : {
			title: "association",
			title2: "de l'association",
			title3: "cette association",
			color: "green",
			icon: "group",

		},
		"Group" : {
			title: "groupe",
			title2: "du groupe",
			title3: "ce groupe",
			color: "turq",
			icon: "circle-o",

		},
		"project" : {
			title: "projet",
			title2: "du projet",
			title3: "ce projet",
			color: "purple",
			icon: "circle-o",

		}
	};


elementLib.buildDynForm = function (elementObj, afterLoad, data) { 
	mylog.warn("--------------- build K DynForm", elementObj, afterLoad,data);
	if(userId)
	{
		var form = $.dynForm({
		      formId : "#ajax-modal-modal-body #ajaxFormModal",
		      formObj : elementObj.dynForm,
		      formValues : data,
		      onLoad : function  () {
		        $("#ajax-modal-modal-title").html("<i class='fa fa-"+elementObj.dynForm.jsonSchema.icon+"'></i> "+elementObj.dynForm.jsonSchema.title);
		        $("#ajax-modal-modal-title").removeClass("text-green").removeClass("text-purple").removeClass("text-orange").removeClass("text-azure");
		        $("#ajax-modal-modal-body").append("<div class='space20'></div>");
		        if(typeof currentKFormType != "undefined")
		        	$("#ajax-modal-modal-title").addClass("text-"+KSpec[currentKFormType].color);
		        
		        $(".locationBtn").on( "click", function(){
					 setTimeout(function(){
					 	$('[name="newElement_country"]').val("NC");
					 	$('[name="newElement_country"]').trigger("change");
					 },1000); 
				});
				$(".locationBtn").html("<i class='fa fa-home'></i> Addresse principale")
		        $(".locationBtn").addClass("letter-red bold");
		        $("#btn-submit-form").removeClass("text-azure").addClass("letter-green");
		        if(typeof currentKFormType != "undefined")
		        	$("#ajaxFormModal #type").val(currentKFormType);

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
	} else 
		alert('Vous devez etre loggué');
}

function initKSpec(){

	if(typeof currentKFormType != "undefined" && typeof KSpec[currentKFormType] != "undefined"){
		var title = KSpec[currentKFormType].title;
		var title2 = KSpec[currentKFormType].title2;
		var title3 = KSpec[currentKFormType].title3;
		var color = KSpec[currentKFormType].color;
		var icon = KSpec[currentKFormType].icon;

		typeObj["organization"].dynForm.jsonSchema.title = "<small>Créer une page</small> "+title;
		typeObj["organization"].dynForm.jsonSchema.properties.info.html = "<p class='text-"+color+"'>Faire connaître votre "+title+" n'a jamais été aussi simple !<br>" +
																	  "Créez votre page en quelques secondes,<br>puis rajoutez des détails,<br>selon vos besoins ...<hr>" +
																	  "</p>";
		typeObj["organization"].dynForm.jsonSchema.properties.name.placeholder = "Nom";
		typeObj["organization"].dynForm.jsonSchema.properties.name.label = "Nom "+title2;
		typeObj["organization"].dynForm.jsonSchema.properties.type.label = "Type d'organisation";
		typeObj["organization"].dynForm.jsonSchema.properties.role.label = "Votre rôle";
		typeObj["organization"].dynForm.jsonSchema.properties.location.label = "Localisation";
		typeObj["organization"].dynForm.jsonSchema.properties.formshowers.label = "En détails";
		typeObj["organization"].dynForm.jsonSchema.properties.role.placeholder = "Quel est votre rôle dans "+title3;
		typeObj["organization"].dynForm.jsonSchema.properties.tags.label = "Quelques mots clés pour définir "+title3;
		typeObj["organization"].dynForm.jsonSchema.properties.tags.placeholder = "Mots clés";
		typeObj["organization"].dynForm.jsonSchema.properties.email.label = "E-mail principal";
		typeObj["organization"].dynForm.jsonSchema.properties.description.label = "Description principale";
		typeObj["organization"].dynForm.jsonSchema.properties.url.label = "URL principale";
		typeObj["organization"].dynForm.jsonSchema.properties.url.icon = icon;
	}

	typeObj["project"].dynForm.jsonSchema.title = "<small>Créer une page</small> projet";
	typeObj["project"].dynForm.jsonSchema.properties.info.html = "<p class='text-purple'>Faire connaître vos projets n'a jamais été aussi simple !<br>" +
																  "Créez votre page en quelques secondes,<br>et complétez les informations plus tard, selon vos besoins<hr>" +
																  "</p>";
	typeObj["project"].dynForm.jsonSchema.properties.name.placeholder = "Nom";
	typeObj["project"].dynForm.jsonSchema.properties.name.label = "Nom du projet";
	typeObj["project"].dynForm.jsonSchema.properties.location.label = "Localisation";
	typeObj["project"].dynForm.jsonSchema.properties.tags.label = "Quelques mots-clés pour définir ce projet ...";
	typeObj["project"].dynForm.jsonSchema.properties.description.label = "Description principale";
	typeObj["project"].dynForm.jsonSchema.properties.url.label = "URL principale";

}