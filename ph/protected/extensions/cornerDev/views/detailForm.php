<script>
function clickActionImg(type){
	$('#action').val(type);
	$('.typeImg').css('border','none');
	$('.'+type).css('border','1px solid red');
}
function clickStateImg(type){
	$('#state').val(type);
	$('.typeImg2').css('border','none');
	$('.'+type).css('border','1px solid red');
}
</script>
<div id="login_form">
    <?php if(isset($sections)){?>	
	<label for="login_name">Section</label>
	<br/>
	<?php echo CHtml::dropDownList('sectionId', 'main', $sections);
	 }?>
<br/><br/>	
	<label for="title">Title</label>
	<br/>
	<input type="text" id="title" name="title" size="20" value="<?php echo $title?>"/>
<br/><br/>
	<label for="id">id</label>
	<br/>
	<input type="text" id="id" name="id" size="20" value="<?php echo $id?>" />
<br/><br/>
	<label for="link">Link</label>
	<br/> 
	<input type="text" id="link" name="link" size="20" value="<?php echo $link?>"/>
<br/><br/>
	<label for="action">Action</label>
	<br/> 
	<?php echo CHtml::dropDownList('action', (isset($action))?$action:'dev' , array('dev'=>'dev',
															'mockups'=>'mockups',
															'graphics'=>'graphics',
															'integration'=>'integration(CSS JS)',
															'mobile'=>'mobile',
															'test'=>'test'));?>
    <?php $iconSize = 35;
	$icons = array( 'dev'=>array('icon'=>'log','alt'=>'IN DEVELOPEMNT'),
            		'mockups'=>array('icon'=>'design','alt'=>'PREPARING MOCKUPS'),
            		'graphics'=>array('icon'=>'graphist','alt'=>'BUILDING GRAPHICS'),
            		'integration'=>array('alt'=>'INTEGRATING'),
            		'mobile'=>array('alt'=>'TURNING MOBILE'),
        			'test'=>array('icon'=>'experiment','alt'=>'BUILD TEST'));
	echo '<br/>';
	foreach($icons as $i=>$val)
	    echo '<a href="#" onclick="clickActionImg(\''.$i.'\')"><img class="typeImg '.$i.'" src="'.$this->assetsBase.'/images/'.((isset($val['icon'])) ? $val['icon']: $i).'.png" width="'.$iconSize.'" alt="'.$val['alt'].'" /></a>';    
	?>	
<br/><br/>
	<label for="login_name">State: </label>
	<br/>
	<?php echo CHtml::dropDownList('state', $state, array("pending"=>"pending",
														  "inprogress"=>"inprogress",
														  "done"=>"done",
														  "validated"=>"validated"))?>
<?php 
	$icons = array( 'pending'=>array('alt'=>'STILL PENDING'),
            		'inprogress'=>array('alt'=>'IN PROGRESS'),
            		'done'=>array('icon'=>'yes3','alt'=>'DONE'),
            		'validated'=>array('icon'=>'yes','alt'=>'VALIDATED'));
	echo '<br/>';
	foreach($icons as $i=>$val)
	    echo '<a href="#" onclick="clickStateImg(\''.$i.'\')"><img class="typeImg2 '.$i.'" src="'.$this->assetsBase.'/images/'.((isset($val['icon'])) ? $val['icon']: $i).'.png" width="'.$iconSize.'" alt="'.$val['alt'].'" /></a>';    
	?>	
<br/><br/>
	<label for="login_name">Progress </label>
	<br/> 
	<input type="text" id="progress" name="progress" size="6"  value="<?php echo $progress?>"/> %
	<br/>
	<br/> 
	<a id="savebutton" href="javascript:<?php if(!isset($sections)){?>saveFrameInfo();<?php } else {  ?>addNewFrame();<?php }?>"><img src="<?php echo $this->assetsBase?>/images/save.png" width=40/> SAVE </a>
	
</div>