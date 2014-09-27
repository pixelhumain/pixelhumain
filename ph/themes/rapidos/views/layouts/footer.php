<!-- start: FOOTER -->
<footer class="inner">
	<div class="footer-inner">
		<div class="pull-left">
			2014 <?php echo (isset($this->projectImage)) ? '<img height="30" style="margin-right:30px;" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'>/i>";
			if(isset($this->footerImages)){
				foreach ($this->footerImages as $img) {
					?>
					<img height="30" style="margin-right:30px;" src="<?php echo $this->module->assetsUrl.$img?>"/>
					<?php
				}
			}
			?>
			
		</div>
		<div class="pull-right">
			<span class="go-top"><i class="fa fa-chevron-up"></i></span>
		</div>
	</div>
</footer>
<!-- end: FOOTER -->