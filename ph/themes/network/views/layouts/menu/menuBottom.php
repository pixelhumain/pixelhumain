<div class="col-xs-12 main-bottom-menu no-padding"  data-tpl="default.menu.menuBottom">
	
	<?php if(@Yii::app()->session["userId"] && @$params['add']){ ?>
		<div class="showElementAdd">
		<div id="btn-menu-add-sub">
			
		<?php 
			$convertArray=array("one","two","three");
			$countAdd = count($params['add'])-1;
			$i=0;
			foreach($params['add'] as $key => $data){ 
				if($key=="organization")
					$bgClass="bg-green";
				else if($key=="project")
					$bgClass="bg-purple";
				else if($key=="event")
					$bgClass="bg-orange";
				else if($key=="person")
					$bgClass="bg-yellow";
			?>
				<a href="javascript:openForm('<?php echo $key ?>')" class="btn no-padding <?php echo $convertArray[$countAdd]; ?>div<?php echo $convertArray[$i] ?> <?php echo $bgClass ?>"> <span><?php echo Yii::t("common",$key); ?></span></a>
			<?php $i++; } ?>
			
			<!--<a href="javascript:;" class="btn no-padding threedivone bg-green"> <span><?php echo Yii::t("common","Organizations"); ?></span></a>
			<a href="javascript:;" class="btn no-padding threedivtwo bg-orange"> <span><?php echo Yii::t("common","Organizations"); ?></span></a>
		<a href="javascript:;" class="btn no-padding threedivthree bg-purple"> <span><?php echo Yii::t("common","Organizations"); ?></span></a>-->

		</div>
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