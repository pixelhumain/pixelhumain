<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/api.css'); 
?>

<div class="containeri apiList">
	<div class="hero-uniti">
		<h2>A.P.I <?php echo $this::moduleTitle?>  : List all URLs</h2>
		<ul>
			<?php foreach ($this->sidebar1 as  $e) { 
				if( !isset( $e["menuOnly"])){
				?>

				<!-- ////////////////////////////////////////////////////////////////////////////// -->

				<li ><h3 class="blockp"><?php echo $e['label']?> <?php if(isset($e['children']))echo "( ".count($e['children'])." )"?>  <a class="<?php echo $e['key']?>Icon fa fa-eye<?php if(isset($e['hide'])) echo '-slash'?>" href="javascript:;" onclick="toggle('<?php echo $e['key']?>');"></a></h3></li>
				<li class="<?php echo $e['key']?> <?php if(isset($e['hide'])) echo 'hide'?>">
					<?php 
					$params = ( isset( $e['blocks']) ) ? array("blocks"=>$e['blocks']) : array();
					$this->renderPartial( 'application.modules.'.$this::$moduleKey.'.views.api.'.$e['key'],$params ); ?>
				</li>

				<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<?php }}?>
			
		</ul>
	</div>
</div>

<script type="text/javascript">
function testitpost(id,url,params){
	console.log(id,url,params);
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    data:params,
	    type:"POST",
	    success:function(data) {
	      $("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      $("#"+id).html(data);
	    } 
	  });
}
function testitget(id,url){
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    type:"GET",
	    success:function(data) {
	      $("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      $("#"+id).html(data);
	    } 
	  });
}
function toggle(id){
	if( !$("."+id).is(":visible") ) {
		$("."+id).removeClass("hide").attr("style","");
		$("."+id+"Icon").removeClass('fa-eye-slash').addClass('fa-eye');
	} else { 
		$("."+id).addClass("hide");
		$("."+id+"Icon").removeClass('fa-eye').addClass('fa-eye-slash');
		$("."+id).hide();
	}
	return false;
}
function scrollTo(id){
 $("html, body").animate({
            scrollTop: $(id).offset().top-70
        }, 700);
}
</script>