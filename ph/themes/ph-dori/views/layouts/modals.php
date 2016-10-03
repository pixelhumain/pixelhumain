<style type="text/css">
	#ajaxFormModal input ,#ajaxFormModal .form-group #name ,#ajaxFormModal.form-group {margin:0px; padding-left: 0px; width: 100%;}
	#ajaxFormModal .bootstrap-switch, .locationBtn {width:100%;}
	#ajaxFormModal .bootstrap-switch-container {height:30px;}
	#ajax-modal{
		background-size:100%;
		background-repeat: no-repeat;
		}
	.bgEvent{
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-orange.png");
		background-color: #ffc694 !important;
	}
	.bgOrga{
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-green.png");
		background-color: #DAFFC6 !important;
	}
	.bgPerson{
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-yellow.png");
		background-color: #FFFFB5 !important;
	}
	.bgProject{
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-purple.png");
		background-color: #D4CDF0 !important;
	}
	.bgDDA{
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-blue.png");
		background-color: #A0C3E7 !important;
	}
	.bg-lightblue{
		background-color: #7db9e8 !important;
	}
	.bg-lightblue2{
		color:white;
		background-color: #2973C0 !important;
	}
</style>
<div id="ajax-modal" class="modal fade no-display" tabindex="-1" role="dialog" data-replace="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			
			<div class="modal-header text-dark">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="text-white fa-2x fa fa-times"></i></span></button>
		        <h2 class="modal-title text-left" id="ajax-modal-modal-title">
		        	<i class="fa fa-angle-down"></i> <i class="fa " id="ajax-modal-icon"></i> 
		        </h2>
		    </div>
			
			<div id="ajax-modal-modal-body" class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			</div>
		</div>
	</div>
</div>