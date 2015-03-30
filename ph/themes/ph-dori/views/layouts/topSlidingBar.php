<!-- start: SLIDING BAR (SB) -->
<div id="slidingbar-area">
	<div id="slidingbar">
		<div class="row">
			<!-- start: SLIDING BAR FIRST COLUMN -->
			<div class="col-md-4 col-sm-4">
				<h2>My Options</h2>
				<div class="row">
					<div class="col-xs-6 col-lg-3">
						<button class="btn btn-icon btn-block optionTopButton space10" data-type="people">
							<i class="fa fa-smile-o"></i>
							Person <span class="badge badge-info partition-red"> 4 </span>
						</button>
					</div>
					<div class="col-xs-6 col-lg-3">
						<button class="btn btn-icon btn-block optionTopButton space10" data-type="organisations">
							<i class="fa fa-group "></i>
							Organization <span class="badge badge-info partition-red"> 23 </span>
						</button>
					</div>
					<div class="col-xs-6 col-lg-3">
						<button class="btn btn-icon btn-block optionTopButton space10" data-type="events">
							<i class="fa fa-calendar-o"></i>
							Calendar <span class="badge badge-info partition-blue"> 5 </span>
						</button>
					</div>
					<div class="col-xs-6 col-lg-3">
						<button class="btn btn-icon btn-block optionTopButton space10" data-type="projects">
							<i class="fa fa-folder-open-o"></i>
							Project <span class="badge badge-info partition-red"> 9 </span>
						</button>
					</div>
				</div>
			</div>
			<!-- end: SLIDING BAR FIRST COLUMN -->
			<!-- start: SLIDING BAR SECOND COLUMN -->
			<div class="col-md-4 col-sm-4">
				<h2>My Recent Activities</h2>
				<div class="blog-photo-stream margin-bottom-30">
					<ul class="list-unstyled">
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image01_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image02_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image03_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image04_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image05_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image06_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image07_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image08_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image09_th.jpg"></a>
						</li>
						<li>
							<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image10_th.jpg"></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- end: SLIDING BAR SECOND COLUMN -->
			<!-- start: SLIDING BAR THIRD COLUMN -->
			<div class="col-md-4 col-sm-4">
				<h2>My Info</h2>
				<address class="margin-bottom-40" id="infoTopSliding">
				</address>
				<a class="btn btn-transparent-white optionTopButton" data-type="edit_account">
					<i class="fa fa-pencil"></i> Edit
				</a>
				<a class="btn btn-transparent-white" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/logout"); ?>">
					<i class="fa fa-power-off "></i> Logout
				</a>
			</div>
			<!-- end: SLIDING BAR THIRD COLUMN -->
		</div>
		<div class="row">
			<!-- start: SLIDING BAR TOGGLE BUTTON -->
			<div class="col-md-12 text-center">
				<a href="#" class="sb_toggle"><i class="fa fa-chevron-up"></i></a>
			</div>
			<!-- end: SLIDING BAR TOGGLE BUTTON -->
		</div>
	</div>
</div>
<script>
	$(".optionTopButton").on("click", function(){
		var pathtab = window.location.href.split("#");
		if(typeof(force)!= "undefined"){
			force.stop();
		}
		if($('.close-subviews').css("display") == "block"){
			$('.close-subviews').trigger("click");
		}
		$.hideSubview();
		console.log(pathtab[0]);
		if(pathtab[0] == baseUrl+"/"+moduleId+"/person"){
			window.location.hash = "#panel_"+this.getAttribute('data-type');
			pageLoad();
		}else{
			window.location.replace(baseUrl+"/"+moduleId+"/person#panel_"+this.getAttribute('data-type'));
		}
	})

	jQuery(document).ready(function() {
		getNotificationSlidingBar();
		getInfo();
	})

	function getNotificationSlidingBar(){
		var data = {"id" : '<?php echo Yii::app()->session["userId"] ?>'};
		$.ajax({
			type: "POST",
	        url: baseUrl+"/communecter/person/GetNotification",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
					
	  			}
			}	
		})
	}

	function getInfo(){
		var data = {"id" : '<?php echo Yii::app()->session["userId"] ?>'};
		$.ajax({
			type: "POST",
			url: baseUrl+"/"+moduleId+"/person/getbyid/id/<?php echo Yii::app()->session['userId'] ?>",
			data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
	        		var tel = "";
	        		if(typeof(data.tel) != "undefined"){
	        			tel = data.tel;
	        		}
	        		var str=""+data.name+"<br>"+ data.address.addressLocality+"<br>"+tel+"<br>Email:<a href='#'>"+data.email+"</a>";
	        		$("#infoTopSliding").html(str);
	        	}
	        }
		})
	}
</script>
<!-- end: SLIDING BAR -->