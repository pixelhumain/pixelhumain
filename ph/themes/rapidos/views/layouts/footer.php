<!-- start: FOOTER -->
<footer class="inner">
	<div class="footer-inner">
		<div class="pull-left">
			<?php echo $this->footerText; echo (isset($this->projectImage)) ? '<img height="30" style="margin-right:20px;" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'>/i>";
			if(isset($this->footerImages)){
				foreach ($this->footerImages as $k=>$v) {
					?>
					<a href="<?php echo $v['url']?>" target="_blank"><img height="30" style="margin-right:20px;" src="<?php echo $this->module->assetsUrl.$v['img']?>"/></a>
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