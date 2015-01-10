<!-- start: PAGESLIDE RIGHT -->
<div id="pageslide-right" class="pageslide slide-fixed inner">
	<div class="right-wrapper">
		<div class="notifications">
			
			<div class="pageslide-title">
				You have 11 notifications 
			</div>
			<ul class="pageslide-list">
				<li>
					<a href="" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
				</li>
				<?php
					foreach( $this->notifications as $item )
			        {
			            echo "<li>";
			            echo "<a href='".$item["notify"]["url"]."'><span class='label label-primary'>";
			            echo '<i class="fa '.$item["notify"]["icon"].'"></i></span> <span class="message">';
			            echo $item["notify"]["displayName"];
			            echo "</span></a>";
			            echo "<a href=''><i class='fa fa-times'></i></a>";
			            echo "</li>";
			        } 
				?>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-primary"><i class="fa fa-user"></i></span> <span class="message"> New user in Group</span> <span class="time"> 1 min</span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-success"><i class="fa fa-comment"></i></span> <span class="message"> New comment</span> <span class="time"> 7 min</span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-success"><i class="fa fa-comment"></i></span> <span class="message"> New comment</span> <span class="time"> 8 min</span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-success"><i class="fa fa-comment"></i></span> <span class="message"> New comment</span> <span class="time"> 16 min</span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-primary"><i class="fa fa-gear"></i></span> <span class="message"> New Task</span> <span class="time"> 36 min</span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-warning"><i class="fa fa-file"></i></span> <span class="message"> Project updated</span> <span class="time"> 1 hour</span>
					</a>
				</li>
				<li class="warning">
					<a href="javascript:void(0)">
						<span class="label label-danger"><i class="fa fa-gear"></i></span> <span class="message"> Task deleted account</span> <span class="time"> 2 hour</span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="label label-warning"><i class="fa fa-gear"></i></span> <span class="message"> Task status updated</span> <span class="time"> 1 hour</span>
					</a>
				</li>
				<li>
					<a href="" class="btn btn-primary">Mark all as Read <i class="fa fa-check-square-o"></i></a>
				</li>
			</ul>

			<div class="view-all">
				<a href="javascript:void(0)">
					See all notifications <i class="fa fa-arrow-circle-o-right"></i>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGESLIDE RIGHT -->