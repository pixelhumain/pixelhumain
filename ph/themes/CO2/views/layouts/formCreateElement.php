<?php 
$cssAnsScriptFilesModule = array(
  '/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
  '/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
  '/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
  '/plugins/select2/select2.css',
  //X-editable...
// 	'/plugins/x-editable/js/bootstrap-editable.js' , 
  //	'/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
  //'/plugins/wysihtml5/wysihtml5.js',
  '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
  '/plugins/jquery.appear/jquery.appear.js',
  //'/plugins/jquery.elastic/elastic.js',
  
);
//error_log("BasURL : ".Yii::app()->request->baseUrl);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);

$CO2DomainName = Yii::app()->params["CO2DomainName"];
?>

<style>
	#ajax-modal .form-group,
	#ajax-modal .form-actions{
		width:70%;
		min-width:300px;
		margin-left:15%;
	}

	#ajax-modal .form-group.infocustom{
		width:100%!important;
		margin-left:0%;
	}	
	#ajax-modal .form-group .btn.w100p{
		width:100%!important;
		margin-left:0%;
	}	

	#ajax-modal .form-group.infocustom p{
		text-align: center;
		font-size:13px;
		font-weight: bold;
		color:grey;
	}
	#ajax-modal .select2-container-multi{
		border:0px!important;
	}
	#ajax-modal .control-label{
		float: left;
		margin-top:10px;
	}
	#ajax-modal .descriptionwysiwyg .control-label{
		padding-left:15px !important;
	}

	#ajax-modal .modal-header{
		width: 70%;
		margin-left: 15%;
		border-radius: 100px;
		margin-top: 10px;
		color: white !important;
	}

</style>


<div class="portfolio-modal modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                	<?php if($CO2DomainName == "kgougle"){ ?>
                    	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" 
                    			height="50" class="inline margin-top-25 margin-bottom-5">
                    <?php } ?>
                    <?php if($CO2DomainName == "CO2"){ ?>
                    	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" 
                    			height="50" class="inline margin-top-25 margin-bottom-5">
                    <?php } ?>
                    <br>
                </div>
               
            </div>

	        <div class="row">
	            <div class="col-lg-12">
					<div class="modal-header text-dark">
				        <h3 class="modal-title text-center" id="ajax-modal-modal-title">
				        	<i class="fa fa-angle-down"></i> <i class="fa " id="ajax-modal-icon"></i> 
				        </h3>
				    </div>
					
					<div id="ajax-modal-modal-body" class="modal-body">
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
			</div>
		</div>
	</div>
</div>
