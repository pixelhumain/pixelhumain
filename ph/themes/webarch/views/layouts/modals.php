<?php 
if($this->secure)
    $this->renderPartial('application.views.layouts.modals.loginPwdForm');
?>
<?php $this->renderPartial('application.views.layouts.modals.participer',array( "account" => $account));?>
<?php //$this->renderPartial('application.views.layouts.modals.association',array( "account" => $account) );?>
<?php $this->renderPartial('application.views.layouts.modals.entreprise');?>
<?php $this->renderPartial('application.views.layouts.modals.invitation');?>
<?php $this->renderPartial('application.views.layouts.modals.boiteIdee');?>
<?php $this->renderPartial('application.views.layouts.modals.flashInfo');?>



<script type="text/javascript">
initT['modalsInit'] = function(){
    
    
};
function showEvent(id){
	$("#"+id).click(function(){
    	if($("#"+id).prop("checked"))
    		$("#"+id+"What").removeClass("hidden");
    	else
    		$("#"+id+"What").addClass("hidden");
    });
}
</script>