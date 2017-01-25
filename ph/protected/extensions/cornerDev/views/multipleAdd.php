<script>
$(document).ready(function(){
 
    var i = $('input').size() + 1;
    
    $('#add').click(function() {
        $('<div><input type="text" class="field" name="dynamic[]" value="' + i + '" /></div>').fadeIn('slow').appendTo('.inputs');
        i++;
    });
 
    $('#remove').click(function() {
    if(i > 1) {
        $('.field:last').remove();
        i--;
    }
    });
 
    $('#reset').click(function() {
    while(i > 2) {
        $('.field:last').remove();
        i--;
    }
    });
 
    // here's our click function for when the forms submitted
    $('.submit').click(function(){
        var entries = [];
        $.each($('.field'), function() {
            entries.push($(this).val());
        });
        
        //alert(caseName+" :::: "+entries);
        saveFrameUseCase($('#setName').val(), entries);
        return false;
    });
    $('.field').live('keydown', function(event) {
        if ( event.keyCode == 9 )
        	$('#add').trigger('click');
        else  if ( event.keyCode == 13 )
        	$('.submit').trigger('click');
    });
    
    $('#setName').focus();
});
</script>
<style> 
input{
	border:1px solid #ccc;
	padding:8px;
	font-size:14px;
	width:300px;
	}
	
.submit{
	width:110px;
	background-color:#FF6;
	padding:3px;
	border:1px solid #FC0;
	margin-top:20px;}	
 
</style> 
<div class="dynamic-form"> 
 
<a href="#" id="add">Add</a> | <a href="#" id="remove">Remove</a>  | <a href="#" id="reset">Reset</a>  
 
<form> 
<label for="action">Give This set an ID</label>
<br/> 
<input type="text" id="setName"/>
<br/> <br/> 
<div class="inputs"> 
<div><input type="text" name="dynamic[]" class="field" value="1"/></div> 
</div> 
<input name="submit" type="button" class="submit" value="Submit" /> 
</form> 
</div>