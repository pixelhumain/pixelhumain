<!-- start: PAGESLIDE RIGHT -->
<div id="pageslide-right" class="pageslide slide-fixed inner">
	<div class="right-wrapper">
		<div class="notifications">
			
			<div class="pageslide-title">
				You have 11 notifications 
			</div>
			<ul class="pageslide-list">
				<li>
					<a href="javascript:;" onclick='refreshNotifications()' class="btn btn-primary"><i class="fa fa-refresh"></i></a>
				</li>
				<?php
					foreach( $this->notifications as $item )
			        {
			            echo "<li class='notifLi'>";
			            echo "<a class='notif' data-id='".(string)$item["_id"]."' href='".$item["notify"]["url"]."'><span class='label label-primary'>";
			            echo '<i class="fa '.$item["notify"]["icon"].'"></i></span> <span class="message">';
			            echo $item["notify"]["displayName"];
			            echo "</span><span class='time'> 1 min</span></a>";
			            echo "</li>";
			        } 
				?>
				<li class='markAllAsRead'>
					<a href="javascript:;" onclick='markAllAsRead()' class="btn btn-primary ">Mark all as Read <i class="fa fa-check-square-o"></i></a>
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
jQuery(document).ready(function() {
	
	$(".notifications a.notif").off().on("click",function () {
		console.log("notif read",$(this).data("id"));
		$(this).parent().remove();
		markAsRead($(this).data("id"));
	});

});
function markAllAsRead(){
	$(".notifications ul li.notifLi").remove();
	toastr.info("TODO : apply ajax remove to DB data");
	//ajax remove Notifications by AS Id
	//TODO : ActivityStream::removeNotifications($id)
	$(".markAllAsRead").hide();
	notifCount();
}
function markAsRead(){
	toastr.info("TODO : apply ajax remove to DB data");
	//ajax remove Notifications by AS Id
	//TODO : ActivityStream::removeNotifications($id)
	if( $(".notifications ul li").length == 2)
		$(".markAllAsRead").hide();
	notifCount();
}
function refreshNotifications(){
	toastr.info("TODO : refresh notification list");
	//ajax get Notifications
	//TODO : ActivityStream::getNotifications(array("notify.id"=>Yii::app()->session["userId"]));

	if( $(".notifications ul li").length > 2 )
		$(".markAllAsRead").show();
	notifCount();
}
function buildNotifications(){

}
function notifCount(){
	var countNotif = $(".notifications a.notif").length;
	if(countNotif){
	    $(".notifications-count").html(countNotif);
		$('.notifications-count').removeClass('hide');
		$('.notifications-count').addClass('animated bounceIn');
	} else {
		$('.notifications-count').addClass('hide');
	}
}
</script>