function bindDynFormEditableTerla(){
	mylog.log("bindDynFormEditableTerla");

	$(".btn-update-info").off().on( "click", function(){
		mylog.log("btn-update-info");
		var form = {
			saveUrl : baseUrl+"/"+moduleId+"/element/updateblock/",
			dynForm : {
				jsonSchema : {
					title : trad["Update general information"],
					icon : "fa-key",
					type: "object",
					onLoads : {
						initUpdateInfo : function(){
							mylog.log("initUpdateInfo");
							$(".emailOptionneltext").slideToggle();
							$("#ajax-modal .modal-header").removeClass("bg-purple bg-red bg-azure bg-green bg-green-poi bg-orange bg-yellow bg-blue bg-turq bg-url")
										  					  .addClass("bg-dark");
						}
					},
					beforeSave : function(){
						mylog.log("beforeSave");
						removeFieldUpdateDynForm(contextData.type);
				    },
					afterSave : function(data){
						mylog.dir(data);
						if(data.result&& data.resultGoods && data.resultGoods.result){

							if(typeof data.resultGoods.values.name != "undefined"){
								contextData.name = data.resultGoods.values.name;
								$("#nameHeader > .name-header").html(contextData.name);
								$("#nameAbout").html(contextData.name);
							}

							if(typeof data.resultGoods.values.email != "undefined"){
								mylog.log("update email");
								contextData.email = data.resultGoods.values.email;
								$("#emailAbout").html(contextData.email);
							}

							if(typeof data.resultGoods.values.url != "undefined"){
								mylog.log("update url");
								contextData.url = data.resultGoods.values.url.trim();
								if(contextData.url != "" ){
									$("#webAbout").html('<a href="'+contextData.url+'" target="_blank" id="urlWebAbout" style="cursor:pointer;">'+contextData.url+'</a>');
								}else{
									$("#webAbout").html("<i>"+trad["notSpecified"]+"</i>");
								}
							}

							if(typeof data.resultGoods.values.fixe != "undefined"){
								mylog.log("update fixe");
								contextData.fixe = parsePhone(data.resultGoods.values.fixe);
								$("#fixeAbout").html(contextData.fixe);
							}

							if(typeof data.resultGoods.values.mobile != "undefined"){
								mylog.log("update mobile");
								contextData.mobile = parsePhone(data.resultGoods.values.mobile);
								$("#mobileAbout").html(contextData.mobile);
							}

							if(typeof data.resultGoods.values.fax != "undefined"){
								mylog.log("update fax");
								contextData.fax = parsePhone(data.resultGoods.values.fax);
								$("#faxAbout").html(contextData.fax);
							}
						}
						dyFObj.closeForm();
						changeHiddenFields();
					},
					properties : {
						block : dyFInputs.inputHidden(),
						name : dyFInputs.name(contextData.type),
						similarLink : dyFInputs.similarLink,
						typeElement : dyFInputs.inputHidden(),
						isUpdate : dyFInputs.inputHidden(true),
						url : dyFInputs.inputUrl(),
						url : dyFInputs.allDay()
					}
				}
			}
		};

		if(contextData.type == typeObj.person.col || contextData.type == typeObj.organization.col ){
			form.dynForm.jsonSchema.properties.email = dyFInputs.text();
			form.dynForm.jsonSchema.properties.fixe= dyFInputs.inputText(tradDynForm["fix"],tradDynForm["enterfixnumber"]);
			form.dynForm.jsonSchema.properties.mobile= dyFInputs.inputText(tradDynForm["mobile"],tradDynForm["entermobilenumber"]);
			form.dynForm.jsonSchema.properties.fax= dyFInputs.inputText(tradDynForm["fax"],tradDynForm["enterfaxnumber"]);
		}

		if(contextData.type == typeObj.service.col){
			form.dynForm.jsonSchema.properties.openingHours =  dyFInputs.openingHours(true);
		}

		var dataUpdate = {
			block : "info",
			id : contextData.id,
			typeElement : contextData.type,
			name : contextData.name,	
		};

		if(contextData.type == typeObj.person.col || contextData.type == typeObj.organization.col ){
			if(notEmpty(contextData.email)) 
				dataUpdate.email = contextData.email;
			if(notEmpty(contextData.fixe))
				dataUpdate.fixe = contextData.fixe;
			if(notEmpty(contextData.mobile))
				dataUpdate.mobile = contextData.mobile;
			if(notEmpty(contextData.fax))
				dataUpdate.fax = contextData.fax;
		}

		if(contextData.type == typeObj.service.col){
			dataUpdate.openingHours =  contextData.openingHours;
		}
		
		mylog.log("dataUpdate", dataUpdate);
		dyFObj.openForm(form, "initUpdateInfo", dataUpdate);
	});

	$(".btn-update-descriptions").off().on( "click", function(){

		var form = {
			saveUrl : baseUrl+"/"+moduleId+"/element/updateblock/",
			dynForm : {
				jsonSchema : {
					title : trad["Update description"],
					icon : "fa-key",
					onLoads : {
						
						markdown : function(){
							dataHelper.activateMarkdown("#ajaxFormModal #description");
							$("#ajax-modal .modal-header").removeClass("bg-dark bg-purple bg-red bg-azure bg-green bg-green-poi bg-orange bg-yellow bg-blue bg-turq bg-url")
										  					  .addClass("bg-dark");
							//bindDesc("#ajaxFormModal");
						}
					},
					afterSave : function(data){
						mylog.dir(data);
						if(data.result&& data.resultGoods && data.resultGoods.result){
							if(data.resultGoods.values.description=="")
								$(".contentInformation #descriptionAbout").html(dataHelper.markdownToHtml('<i>'+trad["notSpecified"]+'</i>'));
							else
								$(".contentInformation #descriptionAbout").html(dataHelper.markdownToHtml(data.resultGoods.values.description));
							$("#descriptionMarkdown").html(data.resultGoods.values.description);
						}
						dyFObj.closeForm();
						changeHiddenFields();
					},
					properties : {
						block : dyFInputs.inputHidden(),
						typeElement : dyFInputs.inputHidden(),
						isUpdate : dyFInputs.inputHidden(true),
						description : dyFInputs.textarea(tradDynForm["longDescription"], "...")
					}
				}
			}
		};

		var dataUpdate = {
			block : "descriptions",
			id : contextData.id,
			typeElement : contextData.type,
			name : contextData.name,
			description : $("#descriptionMarkdown").html()
		};
		dyFObj.openForm(form, "markdown", dataUpdate);
	});

	$(".btn-update-medias").off().on( "click", function(){

		var form = {
			saveUrl : baseUrl+"/"+moduleId+"/element/updateblock/",
			dynForm : {
				jsonSchema : {
					title : trad["Update medias"],
					icon : "fa-key",
					onLoads : {},
					afterSave : function(data){
						mylog.dir(data);
						if(data.result&& data.resultGoods && data.resultGoods.result){
							if(data.resultGoods.values.description=="")
								$(".contentInformation #descriptionAbout").html(dataHelper.markdownToHtml('<i>'+trad["notSpecified"]+'</i>'));
							else
								$(".contentInformation #descriptionAbout").html(dataHelper.markdownToHtml(data.resultGoods.values.description));
							$("#descriptionMarkdown").html(data.resultGoods.values.description);
						}
						dyFObj.closeForm();
						changeHiddenFields();
					},
					properties : {
						block : dyFInputs.inputHidden(),
						typeElement : dyFInputs.inputHidden(),
						medias : dyFInputs.videos
					}
				}
			}
		};

		var dataUpdate = {
			block : "medias",
			id : contextData.id,
			typeElement : contextData.type,
			description : contextData.medias,
		};
		dyFObj.openForm(form, "markdown", dataUpdate);
	});

}

