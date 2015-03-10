<!-- start: PAGESLIDE RIGHT -->
<div id="pageslide-right" class="pageslide slide-fixed inner">
	<div class="right-wrapper">
		<div class="notifications">
			
			<div class="pageslide-title">
				<?php echo Yii::t("common","You have <span class='notifCount'></span> notifications ") ?>
			</div>
			<ul class="pageslide-list header">
				<li>
					<a href="javascript:;" onclick='refreshNotifications()' class="btn btn-primary"><i class="fa fa-refresh"></i></a>
				</li>
			</ul>
			<ul class="pageslide-list notifList">
				<?php
					$maxTimestamp = 0;
					if(isset($this->notifications))
					{
						foreach( $this->notifications as $item )
				        {
				        	if(isset($item["notify"]))
				        	{
					            echo "<li class='notifLi notif_".(string)$item["_id"]."'>";
					            echo "<a class='notif' data-id='".(string)$item["_id"]."' href='".$item["notify"]["url"]."'><span class='label label-primary'>";
					            echo '<i class="fa '.$item["notify"]["icon"].'"></i></span> <span class="message">';
					            echo $item["notify"]["displayName"];
						            
								$a = $item["timestamp"];
								$b = time();
								$difference = $b-$a;

								$second = 1;
								$minute = 60*$second;
								$hour   = 60*$minute;
								$day    = 24*$hour;

								$d    = (floor($difference/$day) > 0) ? floor($difference/$day)."j" : "";
								$h   = (floor(($difference%$day)/$hour)> 0) ? floor(($difference%$day)/$hour)."h" : "" ; 
								$m = (floor((($difference%$day)%$hour)/$minute)> 0) ? floor((($difference%$day)%$hour)/$minute)."min" : "" ;
								 echo "</span><span class='time'>".$d.$h.$m."</span></a>";
					            echo "</li>";
					            if($item["timestamp"] > $maxTimestamp)
					            	$maxTimestamp = $item["timestamp"];
					        }
				        } 
				    }
				?>
			</ul>
			<ul  class="pageslide-list footer"> 
				<li class='markAllAsRead'>
					<a href="#" onclick='markAllAsRead()' class="btn btn-primary "><?php echo Yii::t("common","Mark all as Read") ?> <i class="fa fa-check-square-o"></i></a>
				</li>
			</ul>

			<?php /*
			<div class="view-all">
				<a href="javascript:void(0)">
					See all notifications <i class="fa fa-arrow-circle-o-right"></i>
				</a>
			</div>
			*/?>
		</div>
	</div>
</div>
<!-- end: PAGESLIDE RIGHT -->
<script type="text/javascript">

var notifications = null;
var maxNotifTimstamp = <?php echo $maxTimestamp ?>;

jQuery(document).ready(function() 
{
	bindNotifEvents();
});

function bindNotifEvents(){
	$(".notifList a.notif").off().on("click",function () 
	{
		markAsRead( $(this).data("id") );
		elem = $(this).parent();
		elem.removeClass('animated bounceInRight').addClass("animated bounceOutRight");
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
        url: baseUrl+"/"+moduleId+"/api/marknotificationasread",
        data: { "id" : id },
        dataType : 'json'
    })
    .done( function (data) {
    	console.dir(data);
        if ( data && data.result ) {               
        	$(".notifList li.notif_"+id).remove();
        	console.log("notification cleared ",data);
        } else {
            toastr.error('<?php echo Yii::t("common","No notifications found") ?>');
        }
        notifCount();
    });
}

function markAllAsRead()
{
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/api/markallnotificationasread",
        dataType : 'json'
    })
    .done( function (data) {
    	console.dir(data);
        if ( data && data.result ) {               
        	$(".notifList li.notifLi").remove();
        	console.log("notifications cleared ",data);
        } else {
            toastr.error('<?php echo Yii::t("common","No notifications found") ?>');
        }
        notifCount();
    });
	
}

function refreshNotifications()
{
	//ajax get Notifications
	console.log("refreshNotifications",maxNotifTimstamp);
	$.ajax({
        type: "GET",
        url: baseUrl+"/"+moduleId+"/api/getnotifications?ts="+maxNotifTimstamp
    })
    .done(function (data) {
        if (data) {               
        	buildNotifications(data);
        } else {
            toastr.error('<?php echo Yii::t("common","No notifications found") ?>');
        }
        notifCount();
    });
}

function buildNotifications(list)
{
	console.info("buildNotifications()");
	$(".notifList").html("");

	$.each( list , function( notifKey , notifObj )
	{
		str = "<li class='notifLi notif_"+notifKey+" hide'>"+
				"<a class='notif' data-id='"+notifKey+"' href='"+notifObj.notify.url+"'><span class='label label-primary'>"+
				'<i class="fa '+notifObj.notify.icon+'"></i></span> <span class="message">'+
				notifObj.notify.displayName+
				"</span><span class='time'> 1 min</span></a>"+
			"</li>";
		$(".notifList").append(str);
		$(".notif_"+notifKey).removeClass('hide').addClass("animated bounceInRight");
		if( notifObj.timestamp > maxNotifTimstamp )
			maxNotifTimstamp = notifObj.timestamp;
	});
	setTimeout( function(){
    	notifCount();
    }, 200);
	
	bindNotifEvents();
}

function notifCount()
{
	var countNotif = $(".notifList li:visible").length;
	$(".notifCount").html( countNotif );
	if( countNotif > 0 )
	{
	    $(".notifications-count").html(countNotif);
		$('.notifications-count').removeClass('hide');
		$('.notifications-count').addClass('animated bounceIn');
		$(".markAllAsRead").show();
	} else {
		$('.notifications-count').addClass('hide');
		$(".markAllAsRead").hide();
	}
}
</script>