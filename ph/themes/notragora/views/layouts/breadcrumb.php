<!-- start: BREADCRUMB -->
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<?php
			if(isset($this->breadcrumb)){
				foreach ($this->breadcrumb as $bc) {
					$lbl = (isset($bc["url"])) ?  "<a href='".Yii::app()->createUrl($bc["url"])."'>".$bc["lbl"]."</a>": $bc["lbl"];	
					echo "<li>".$lbl."</li>";	
			}}
			?>
		</ol>
	</div>
</div>
<!-- end: BREADCRUMB -->