<?php 
$this->renderPartial('application.views.layouts.modals.loginPwdForm');
$this->renderPartial('application.views.layouts.modals.participer',array( "account" => $account));
$this->renderPartial('application.views.layouts.modals.entreprise');
$this->renderPartial('application.views.layouts.modals.invitation');
$this->renderPartial('application.views.layouts.modals.boiteIdee');
$this->renderPartial('application.views.layouts.modals.flashInfo');?>

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