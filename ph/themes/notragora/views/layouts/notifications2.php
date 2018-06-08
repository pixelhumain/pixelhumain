<!-- start: PAGESLIDE RIGHT -->
<style type="text/css">
	.notifications li {
		min-height:50px;
		padding: 10px;
		background-color: rgba(197, 225, 197, 0.3);
		border-bottom: 1px dashed #bed1be;
	}
	.notifications{
		/*background-color: white;*/
		color: #528195;
		padding: 2px 0px !important;
	}
	.notifications .pageslide-title{
		padding-left: 10px;
		text-align: inherit; 
		color:#67B04C;
		font-size: 14px !important;
		text-transform: none !important;
	}
	#notificationPanelSearch{
	position: fixed;
	top: 190px !important;
	border-top:1px solid rgba(128, 128, 128, 0.54);
	right: 0%;
	width: 430px;
	bottom: 0px;
	overflow-y: auto;
	background-color: white;
	padding-top: 10px;
	padding-bottom: 10px;
	border-radius: 0px;
    box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 9px 12px 3px rgba(66, 66, 66, 0.37) !important;
    overflow-x: hidden;
    z-index: 13000;
    
		display:none;
		/*background-color: white;
		/*box-shadow: 0px 0px !important;
		left:unset !important;
		right:25px;
		width: 300px !important;
		-moz-box-shadow: 0px 0px 3px 0px #656565;
		-webkit-box-shadow: 0px 0px 3px 0px #656565;
		-o-box-shadow: 0px 0px 3px 0px #656565;
		box-shadow: 0px 0px 3px 0px #656565;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=3);*/
	}
	.notifications a.notif{
		padding-top: 0px !important;
		background-color: transparent;
		color: #354535;
		font-size: 13px;
	}
	ul.notifList{
		position: absolute;
		bottom: 0px !important;
		overflow-y: auto;
		padding-right: 10px;
		top: 30px;
		padding: 0px;
		-moz-box-shadow: 0px 0px 3px -1px #656565;
		-webkit-box-shadow: 0px 0px 3px -1px #656565;
		-o-box-shadow: 0px 0px 3px -1px #656565;
		box-shadow: 0px 0px 3px -1px #656565;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=3);
	}

	

	.notifications .pageslide-list a .label{
		opacity: 0.7;
		position: absolute;
		font-size: 20px !important;
		border-radius: 30px !important;
		height: 40px;
		padding-top: 7px !important;
		padding-left: 8px !important;
		margin-top: 0px;
		height: 35px;
		width: 35px;
		margin-left: -10px;
		background-color: #56c557 !important;
	}

	.notifications .message,.notifications .time {
	    padding-left: 40px;
	    display:block;
	}
	.notifications .time {
	   color: #4d654d;
	}
	.btn-notification-action{
		background-color: #71CE4E !important;
		color: white;
		margin: 0px !important;
		margin-top: -4px !important;
		padding: 4px 8px !important;
		margin-right: 10px !important;
	}
	.footer-notif{
		position: absolute;
		bottom:10px;
		width:100%;
	}
	.btn-reload-notif{
		border-radius: 50%!important;
	    margin-left: 14px !important;
	    margin-right: 5px !important;
	}
	#notificationPanelSearch{
		width:415px !important
	}
</style>
<div id="notificationPanelSearch" class="">
		<div class="notifications">
			<a href="javascript:;" onclick='refreshNotifications()' class="btn-notification-action pull-left btn-reload-notif">
				<i class="fa fa-refresh"></i>
			</a>
			<div class="pageslide-title pull-left">
				<i class="fa fa-angle-down"></i> <i class="fa fa-bell"></i> Notifications 5464654
			</div> 
			<a href="javascript:;" onclick='markAllAsRead()' class="btn-notification-action pull-right" style="font-size:12px;">
				<?php echo Yii::t("common","All marked all as read") ?> <i class="fa fa-check-square-o"></i>
			</a>	
			
			
			<ul class="pageslide-list notifList">
				<?php
					$maxTimestamp = 0;
					if(isset($this->notifications))
					{
						//for($i=0; $i<10; $i++)
						foreach( $this->notifications as $item )
				        {
				        	if(isset($item["notify"]))
				        	{
				        		$url = str_replace("/", ".", $item["notify"]["url"]);
				        		var_dump($url);
				        		if(strrpos($url, "organization.directory") != false){
				        			$url = "#element.detail.type.organizations.id.".$item["target"]["id"];
				        		}

				        		$href = $url;
					            echo "<li class='notifLi notif_".(string)$item["_id"]."'>";
					            echo "<a class='lbh notif' data-id='".(string)$item["_id"]."' href='".$href."'><span class='label label-primary'>";
					            echo '<i class="fa '.$item["notify"]["icon"].'"></i></span> <span class="message text-dark">';
					            echo $item["notify"]["displayName"];
					            
					            echo ", <span class='time pull-left'>".round(abs(time() - @$item["timestamp"]->sec) / 60)."min</span></span></a>";
					            echo "</li>";
					            if(@$item["timestamp"]->sec > $maxTimestamp)
					            	$maxTimestamp = @$item["timestamp"]->sec;
					        }
				        } 
				    } 
				?>
			</ul>
			<!-- <div class="footer-notif">
			 <ul class="pageslide-list header col-xs-6 col-sm-6 col-md-6 padding-10 no-margin" style="height:50px;">
				<li class="center">
					<a href="javascript:;" onclick='refreshNotifications()' class="btn-notification-action"><i class="fa fa-refresh"></i></a>
				</li>
			</ul> 
			<ul  class="pageslide-list footer col-xs-6 col-sm-6 col-md-6 padding-10 no-margin" style="height:50px;"> 
				<li class='markAllAsRead center'>
					<a href="javascript:;" onclick='markAllAsRead()' class="btn-notification-action" style="font-size:11px;"><?php echo Yii::t("common","All as Read") ?> <i class="fa fa-check-square-o"></i></a>	
				</li>
			</ul>
			</div> -->

			<?php /*
			<div class="view-all">
				<a href="javascript:void(0)">
					See all notifications <i class="fa fa-arrow-circle-o-right"></i>
				</a>
			</div>
			*/?>
		</div>
</div>
<!-- end: PAGESLIDE RIGHT -->
<script type="text/javascript">

var notifications = null;
var maxNotifTimstamp = <?php echo $maxTimestamp ?>;

jQuery(document).ready(function() 
{

	//initNotifications();
	//bindLBHLinks();
	bindNotifEvents();
	refreshNotifications();
});

function bindNotifEvents(){
	$(".notifList a.notif").off().on("click",function () 
	{
		//markAsRead( $(this).data("id") );
		// elem = $(this).parent();
		// elem.removeClass('animated bounceInRight').addClass("animated bounceOutRight");
		// elem.removeClass("enable");
		// setTimeout(function(){
  //           elem.addClass('hide');
  //           elem.removeClass('animated bounceOutRight');
  //           notifCount();
  //       }, 200);

	    bindLBHLinks();
	});
}

function markAsRead(id)
{
	//ajax remove Notifications by AS Id
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/notification/marknotificationasread",
        data: { "id" : id },
        dataType : 'json'
    })
    .done( function (data) {
        if ( data && data.result ) {               
        	$(".notifList li.notif_"+id).remove();
        } else {
            toastr.error("no notifications found ");
        }
        notifCount();
    });
}

function markAllAsRead()
{
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/notification/markallnotificationasread",
        dataType : 'json'
    })
    .done( function (data) {
        if ( data && data.result ) {               
        	$(".notifList li.notifLi").remove();
        	$(".sb-toggle-right").trigger("click");
        } else {
            toastr.error("no notifications found ");
        }
        notifCount();
    });
	
}

function refreshNotifications()
{
	//ajax get Notifications
	$(".pageslide-list.header .btn-primary i.fa-refresh").addClass("fa-spin");
	$.ajax({
        type: "GET",
        url: baseUrl+"/"+moduleId+"/notification/getnotifications?ts="+maxNotifTimstamp
    })
    .done(function (data) { 
        if (data) {       
        	buildNotifications(data);
        } else {
            toastr.error("no notifications found ");
        }
        $(".pageslide-list.header .btn-primary i.fa-refresh").removeClass("fa-spin");
    }).fail(function(){
    	toastr.error("error notifications");
        $(".pageslide-list.header .btn-primary i.fa-refresh").removeClass("fa-spin");
    });
}

function buildNotifications(list)
{		$(".notifList").html("");
	if(typeof list != "undefined" && typeof list == "object"){
		$.each( list , function( notifKey , notifObj )
		{
			var url = (typeof notifObj.notify != "undefined") ? notifObj.notify.url.substring( "<?php echo substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1) ?>communecter/".length,notifObj.notify.url.length ) : "#";
			//convert url to hash for loadByHash
			url = "#"+url.replace(/\//g, ".");
			if(url.indexOf("organization.directory")>-1){
				url = "#element.detail.type.organizations.id."+notifObj.target.id;
			}

			//var moment = require('moment');
			moment.lang('fr');
			momentNotif=moment(new Date( parseInt(notifObj.timestamp.sec)*1000 )).fromNow();
			var icon = (typeof notifObj.notify != "undefined") ? notifObj.notify.icon : "fa-bell";
			var displayName = (typeof notifObj.notify != "undefined") ? notifObj.notify.displayName : "Undefined notification";

			str = "<li class='notifLi notif_"+notifKey+" hide'>"+
					"<a class='notif lbh' data-id='"+notifKey+"' href='"+ url +"'>"+
						"<span class='label bg-dark'>"+
							'<i class="fa '+icon+'"></i>'+
						"</span>" + 
						
						'<span class="message">'+
							displayName+
						"</span>" + 
						
						"<span class='time pull-left'>"+momentNotif+"</span>"+
					"</a>"+
				  "</li>";

			$(".notifList").append(str);
			$(".notif_"+notifKey).removeClass('hide').addClass("animated bounceInRight enable");
			if( notifObj.timestamp > maxNotifTimstamp )
				maxNotifTimstamp = notifObj.timestamp;
		});
		setTimeout( function(){
	    	notifCount();
	    }, 800);
		bindNotifEvents();
	}
}

function notifCount()
{ 	var countNotif = $(".notifList li.enable").length;
	$(".notifCount").html( countNotif );
	if( countNotif > 0 )
	{
	    $(".notifications-count").html(countNotif);
		$('.notifications-count').removeClass('hide');
		$('.notifications-count').addClass('animated bounceIn');
		$('.notifications-count').addClass('badge-success');
		$('.notifications-count').removeClass('badge-info');
		$(".markAllAsRead").show();
	} else {
		$(".notifList").append("<li><i class='fa fa-ban'></i> <?php echo Yii::t("common","No more notifications for the moment") ?></li>");
		//$('.notifications-count').addClass('hide');
		$(".notifications-count").html("0");
		$('.notifications-count').removeClass('badge-success');
		$('.notifications-count').addClass('badge-info');
		$(".markAllAsRead").hide();
	}
}
</script>