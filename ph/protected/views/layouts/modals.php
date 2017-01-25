<?php 
if($this->secure)
	if($this->hasSocial)
		$this->renderPartial('application.views.layouts.modals.loginPwdFormNoSocial');
	else
    	$this->renderPartial('application.views.layouts.modals.loginPwdForm');
else
    $this->renderPartial('application.views.layouts.modals.loginForm');
$this->renderPartial('application.views.layouts.modals.participer',array( "account" => $account));
//$this->renderPartial('application.views.layouts.modals.association',array( "account" => $account) );
$this->renderPartial('application.views.layouts.modals.entreprise');
$this->renderPartial('application.views.layouts.modals.invitation');
$this->renderPartial('application.views.layouts.modals.boiteIdee');
$this->renderPartial('application.views.layouts.modals.flashInfo');
?>



<script type="text/javascript">
initT['modalsInit'] = function(){
    
    
};

</script>