<script>
function clickCommentImg(type){
	$('#newCommentType').val(type);
	$('.commentTypeImg').css('border','none');
	$('.'+type).css('border','1px solid red');
}
</script>
<div id="addComment">
	<label for="action">Type</label>
	<br/> 
	<?php echo CHtml::dropDownList('newCommentType', 'comment', array('comment'=>'comment',
															'bug'=>'bug',
															'wish'=>'wish',
															'log'=>'log',
															'idea'=>'idea',
															'question'=>'question'),array('onchange'=>'clickCommentImg(this.value)'));?>
	<?php $iconSize = 35;
	$icons = array( 'comment'=>array('icon'=>'comment2.png','alt'=>'LEAVE A COMMENT'),
            		'bug'=>array('alt'=>'DECLARE A BUG'),
            		'wish'=>array('alt'=>'FEATURE REQUEST'),
            		'log'=>array('alt'=>'ADD A LOG'),
            		'idea'=>array('alt'=>'YOU HAVE AN IDEA'),
        			'question'=>array('icon'=>'question3.png','alt'=>'ASK A QUESTION'));
	foreach($icons as $i=>$val)
	    echo '<a href="#" onclick="clickCommentImg(\''.$i.'\')"><img class="commentTypeImg '.$i.'" src="'.$this->assetsBase.'/images/'.$i.'.png" width="'.$iconSize.'" alt="'.$val['alt'].'" /></a>';    
	?>														
	
    <br/><br/>
        <label for="newComment"></label>
        <textarea id="newComment" name="newComment" maxlength="256" style="width:300px;height:100px;"></textarea>
    <br/><br/>
    	<label for="htmlID">htmlID</label>
    	 <input type="text" id="htmlID" name="htmlID"/>    
    <br/><br/>
    	<label for="newCommentSign">your trigram </label>
    	 <input type="text" id="newCommentSign" name="newCommentSign" size="3" />
    	 
</div>

<br/><br/>
<a id="savebutton" href="javascript:saveFrameComment();"><img src="<?php echo $this->assetsBase?>/images/save.png" width=40/> SAVE </a>