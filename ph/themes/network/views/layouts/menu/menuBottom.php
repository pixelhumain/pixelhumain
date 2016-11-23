<div class="col-xs-12 main-bottom-menu no-padding"  data-tpl="default.menu.menuBottom">
	
	<?php if(@Yii::app()->session["userId"] && @$params['add']){ ?>
		<?php if(@$params['add']["organization"] && $params['add']["organization"]){ ?>
			<a href="javascript:;" class="showElementAdd btn bg-green" style="display:none;"> + Organisations</a>
		<?php } ?>
		<a class="pull-left text-white"  id="btn-menu-add">
			<i class="fa fa-plus firstIcon"></i>	
		</a>
	<?php } ?>
	
</div>
<script>
 // var timeoutGS = setTimeout(function(){ }, 100);
  //var timeoutDropdownGS = setTimeout(function(){ }, 100);
  jQuery(document).ready(function() {
	  $("#btn-menu-add").click(function(){
		  $(".showElementAdd").show(700);
	  });
	  /*.mouseleave(function(){
		  $(".showElementAdd").hide(700);		  
	  })*/
  });
</script>