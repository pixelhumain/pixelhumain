
	
	$('.init-event').off().on("click", function(){
		$.subview({
			content : "#ajaxSV",
			onShow : function() {
				getAjax("#ajaxSV", baseUrl+"/"+moduleId+"/event/eventsv/id/<?php echo $_GET["id"]?>/type/<?php echo Organization::COLLECTION ?>", function(){bindEventSubViewEvents(); $(".new-event").trigger("click");}, "html");
			},
			onSave : function() {
				$('.form-event').submit();
			},
			onHide : function() {
				hideEditEvent();
			}
		});
		
	})

