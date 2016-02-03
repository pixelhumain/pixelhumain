<!-- start: PAGESLIDE RIGHT -->
<style type="text/css">
	
	.notifications{
		/*background-color: white;*/
		color: #528195;
	}
	#notificationPanel{
		background-color: transparent;
		box-shadow: 0px 0px !important;
		left:unset !important;
		right:25px;
		width: 300px !important;
	}
	.notifications a.notif{
		background-color: white;
	}
	ul.notifList{
		margin-top:-15px !important;
		max-height: 400px !important;
		overflow-y:auto;
		padding-right:10px; 
		border-radius: 50px;
		padding: 7px 14px;
		-moz-box-shadow: 0px 0px 3px 0px #656565;
		-webkit-box-shadow: 0px 0px 3px 0px #656565;
		-o-box-shadow: 0px 0px 3px 0px #656565;
		box-shadow: 0px 0px 3px 0px #656565;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=3);
	}

	.notifications .pageslide-list a .label{
		opacity: 0.7;
		position: absolute;
		font-size: 24px !important;
		border-radius: 30px !important;
		height: 40px;
		padding-top: 12px !important;
		margin-top: -15px;
		height: 50px;
		width: 50px;
		margin-left: -17px;
	}

	.notifications .message {
	    padding-left: 40px;
	}

</style>
<div id="notificationPanel" class=" ">
		<div class="notifications">
			
			<!-- <div class="pageslide-title">
				You have <span class="notifCount"></span> notifications 
			</div> -->
			
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
				        		$href = 'loadByHash( "'.$url.'" )';
					            echo "<li class='notifLi notif_".(string)$item["_id"]."'>";
					            echo "<a class='notif' data-id='".(string)$item["_id"]."' href='".$href."'><span class='label label-primary'>";
					            echo '<i class="fa '.$item["notify"]["icon"].'"></i></span> <span class="message">';
					            echo $item["notify"]["displayName"];
					            
					            echo "</span><span class='time'>".round(abs(time() - $item["timestamp"]->sec) / 60)."min</span></a>";
					            echo "</li>";
					            if($item["timestamp"]->sec > $maxTimestamp)
					            	$maxTimestamp = $item["timestamp"]->sec;
					        }
				        } 
				    } 
				?>
			</ul>
			<!-- <ul class="pageslide-list header col-xs-6 col-sm-6 col-md-6 padding-10 no-margin">
				<li>
					<a href="javascript:;" onclick='refreshNotifications()' class="btn btn-primary"><i class="fa fa-refresh"></i></a>
				</li>
			</ul> 
			<ul  class="pageslide-list footer col-xs-6 col-sm-6 col-md-6 padding-10 no-margin"> 
				<li class='markAllAsRead'>
					<a href="javascript:;" onclick='markAllAsRead()' class="btn btn-primary">Mark all as Read <i class="fa fa-check-square-o"></i></a>	
				</li>
			</ul>
			-->
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
	bindNotifEvents();
	refreshNotifications();
});

function bindNotifEvents(){
	$(".notifList a.notif").off().on("click",function () 
	{
		markAsRead( $(this).data("id") );
		elem = $(this).parent();
		elem.removeClass('animated bounceInRight').addClass("animated bounceOutRight");
		elem.removeClass("enable");
		setTimeout(function(){
            elem.addClass('hide');
            elem.removeClass('animated bounceOutRight');
            notifCount();
        }, 200);
	});
}

function markAsRead(id)
{
	console.log("markAsRead",id);
	//ajax remove Notifications by AS Id
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/notification/marknotificationasread",
        data: { "id" : id },
        dataType : 'json'
    })
    .done( function (data) {
    	console.dir(data);
        if ( data && data.result ) {               
        	$(".notifList li.notif_"+id).remove();
        	console.log("notification cleared ",data);
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
    	console.dir(data);
        if ( data && data.result ) {               
        	$(".notifList li.notifLi").remove();
        	console.log("notifications cleared ",data);
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
	console.log("refreshNotifications", maxNotifTimstamp);
	$.ajax({
        type: "GET",
        url: baseUrl+"/"+moduleId+"/notification/getnotifications?ts="+maxNotifTimstamp
    })
    .done(function (data) { //console.log("REFRESH NOTIF : "); console.dir(data);
        if (data) {               
        	buildNotifications(data);
        } else {
            toastr.error("no notifications found ");
        }
        notifCount();
        $(".pageslide-list.header .btn-primary i.fa-refresh").removeClass("fa-spin");
    }).fail(function(){
    	toastr.error("error notifications");
        $(".pageslide-list.header .btn-primary i.fa-refresh").removeClass("fa-spin");
    });
}

function buildNotifications(list)
{
	console.info("buildNotifications()");
	$(".notifList").html("");
	if(typeof list != "undefined"){
		$.each( list , function( notifKey , notifObj )
		{
			var url = (typeof notifObj.notify != "undefined") ? notifObj.notify.url.substring( "<?php echo substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1) ?>communecter/".length,notifObj.notify.url.length ) : "#";
			//convert url to hash for loadByHash
			url = "#"+url.replace(/\//g, ".");

			var icon = (typeof notifObj.notify != "undefined") ? notifObj.notify.icon : "fa-bell";
			var displayName = (typeof notifObj.notify != "undefined") ? notifObj.notify.displayName : "Undefined notification";

			str = "<li class='notifLi notif_"+notifKey+" hide'>"+
					"<a class='notif' data-id='"+notifKey+"' href='javascript:;' onclick='loadByHash(\""+ url +"\")'>"+
						"<span class='label bg-dark'>"+
							'<i class="fa '+icon+'"></i>'+
						"</span>" + 
						
						'<span class="message">'+
							displayName+
						"</span>" + 
						
						"<span class='time'> 1 min</span>"+
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
	console.log(" !!!! notifCount", countNotif);
	$(".notifCount").html( countNotif );
	if( countNotif > 0 )
	{
	    $(".notifications-count").html(countNotif);
		$('.notifications-count').removeClass('hide');
		$('.notifications-count').addClass('animated bounceIn');
		$('.notifications-count').addClass('badge-danger');
		$('.notifications-count').removeClass('badge-info');
		$(".markAllAsRead").show();
	} else {
		//$('.notifications-count').addClass('hide');
		$(".notifications-count").html("0");
		$('.notifications-count').removeClass('badge-danger');
		$('.notifications-count').addClass('badge-info');
		$(".markAllAsRead").hide();
	}
}
</script>