<!-- start: FOOTER -->
<footer class="inner">
	<div class="footer-inner">
		
		<div class="pull-right">
			<span class="go-top"><i class="fa fa-chevron-up"></i></span>
		</div>
		<div class="pull-right" style="max-width: 80%;">

			<?php echo (isset($this->projectImage)) ? '<img height="30" style="margin-right:20px;" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'></i>";
			 
			$platform = "";
			$logoColor = "";
			if( $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == "localhost" ){
				$logoColor = "text-red";
				$platform = "LOCAL DEV";
			}
			else if( $_SERVER['SERVER_NAME'] == "text.pixelhumain.com" ){
				$logoColor = "text-azure";
				$platform = "TEST";
			}
			else if( $_SERVER['SERVER_NAME'] == "dev.pixelhumain.com" ){
				$logoColor = "text-orange";
				$platform = "ONLINE DEV";
			}
			else if( $_SERVER['SERVER_NAME'] == "pixelhumain.com" ){
				$logoColor = "";
				$platform = "PROD";
			}
			echo "<span class='label label-inverse '>".$platform."</span> <span class='label label-inverse '>".( (isset($this->versionDate)) ? $this->versionDate : "" )."</span> <span class='label label-inverse ' style='margin-right:20px'>".((isset($this->version)) ? $this->version : "")."</span>";
		 	
			if(isset($this->footerImages)){
				foreach ($this->footerImages as $k=>$v) {
					?>
					<a href="<?php echo $v['url']?>" target="_blank"><img height="30" style="margin-right:20px;" src="<?php echo $this->module->assetsUrl.$v['img']?>"/></a>
					<?php
				}
			}
			?>
			<?php /* ?><a href="#"><i class="fa fa-bars fa-2x" title="Partners Map"></i></a> */?>
		</div>
	</div>
</footer>
<!-- end: FOOTER -->