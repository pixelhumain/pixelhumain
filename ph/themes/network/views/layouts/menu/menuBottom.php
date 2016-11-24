<div class="col-xs-12 main-bottom-menu no-padding"  data-tpl="default.menu.menuBottom">
	
	<?php if(@Yii::app()->session["userId"] && @$params['add']){ ?>
		<div class="showElementAdd">
		<div id="btn-menu-add-sub">
		<?php if(@$params['add']["organization"] && $params['add']["organization"]){ ?>
			<a href="javascript:;" class="btn no-padding twodivone"> <?php echo Yii::t("common","Organizations"); ?></a>
			<a href="javascript:;" class="btn no-padding twodivtwo"> <?php echo Yii::t("common","Organizations"); ?></a>
		</div>
		<?php } ?>
		<a class="pull-left text-white"  id="btn-menu-add">
			<i class="fa fa-plus firstIcon"></i>	
		</a>
		</div>
	<?php } ?>
	
</div>
<script>
 // var timeoutGS = setTimeout(function(){ }, 100);
  //var timeoutDropdownGS = setTimeout(function(){ }, 100);
  jQuery(document).ready(function() {
	  $(".showElementAdd").mouseenter(function(){
		  $("#btn-menu-add").addClass("active");
		  $("#btn-menu-add-sub").show(700);
	  }).mouseleave(function(){
		  $("#btn-menu-add").removeClass("active");
		  $("#btn-menu-add-sub").hide(700);		  
	  });
  });
</script>