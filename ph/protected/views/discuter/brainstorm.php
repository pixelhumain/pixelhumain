<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
ol.slats li {
	margin: 0 0 10px 0;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
	}
ol.slats li:last-child {
	margin: 0;
	padding: 0;
	border-bottom: none;
	}
ol.slats li h3 {
	font-size: 18px;
	font-weight: bold;
	line-height: 1.1;
	}
ol.slats li h3 a img {
	float: left;
	margin: 0 10px 0 0;
	padding: 4px;
	border: 1px solid #eee;
	}
ol.slats li h3 a:hover img {
	background: #eee;
	}
ol.slats li p {
	margin: 0 0 0 76px;
	font-size: 14px;
	line-height: 1.4;
	}
ol.slats li p span.meta {
	display: block;
	font-size: 12px;
	color: #999;
	}		
		
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Brainstormons</h2>
    <p> Un brainstom s'effectue en 3 étapes : Contribution, Vote , Résultat  </p>
<ol class="slats">
	<?php 
    $pa = Yii::app()->mongodb->group->find(array("type"=>PixelHumain::TYPE_ASSOCIATION));
    foreach ($pa as $e){
    ?>
    <li class="group"><h3><a href="<?php echo Yii::app()->createUrl('index.php/association/view/id/'.$e["_id"])?>"><?php echo $e["name"]?></a>
    <?php 
    	echo ((Citoyen::isAdminUser()) ? '<a href="#'.$e["_id"].'" class="updateBtn btn btn-primary pull-right"><span class="entypo-pencil"></span></a>' : "");
    	echo ((Citoyen::isAdminUser()) ? '<a href="#'.$e["_id"].'" class="delBtn btn btn-primary pull-right"><span class="entypo-cancel"></span></a>' : "");
    	?>
    </h3></li>
    <?php }?>
    
</ol>   	
</div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
<?php 
	    if(Citoyen::isAdminUser()){
	    ?>
	  $(document).on('touchstart click', '.delBtn', function(event){
		  //console.log(this.hash.substr(1));
		  if(confirm("t'es sur de ton copup ?")){
		  event.preventDefault();
		  toggleSpinner();
		  $( "."+this.hash.substr(1) ).remove();
		  $.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/index.php/association/delete",
	    	  data: {"id":this.hash.substr(1)},
	    	  success: function(data){
	    			  $("#flashInfo .modal-body").html(data.msg);
	    			  toggleSpinner();
	    		  	  $("#flashInfo").modal('show');
	    		  	  window.location.reload();
	    	  },
	    	  dataType: "json"
	    	});
		  }
	  });
	  <?php } ?>
};
</script>			