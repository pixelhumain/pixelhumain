<?php foreach ($blocks as  $b) 
{ 
	if( !in_array( $b["key"] , array("scenario","modules") )) {
	?>
	
	<h4  class="blocky"><?php if(isset($b["iconClass"])) { ?><i class="<?php  echo $b["iconClass"]?>"></i> <?php }?><?php echo $b["label"]?></h4>
	
	<ul class="blocki">
		<?php foreach ($b["children"] as  $bl) { ?>
		<li><?php 
		echo $bl["label"];
		if(isset($bl["desc"])){
			echo " : : ".$bl["desc"];
		}
		?></li>
		<?php }?>
	</ul>

<?php }
}?>
