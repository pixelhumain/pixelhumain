<!-- start: TOOLBAR -->
<div class="toolbar row">
	<div class="col-md-7 hidden-xs">
		<div class="page-header">
			<h1><?php echo (isset($this->title)) ? $this->title : "Page Title"; ?></h1> 
			<?php echo (isset($this->subTitle)) ? "<small class='hidden-xs'>".$this->subTitle."</small>" : "Page subTitle";?>
		</div>
	</div>
	<div class="col-md-5 col-xs-12">
		<a href="#" class="back-subviews">
			<i class="fa fa-chevron-left"></i> BACK
		</a>
		<a href="#" class="close-subviews">
			<i class="fa fa-times"></i> CLOSE
		</a>
		
		<a href="#" class="save-subviews">
			<i class="fa fa-save"></i> SAVE
		</a>
		

		<div class="toolbar-tools pull-right">
			<ul class="nav navbar-right">
				<?php 
				if(isset($this->toolbarMBZ)){
					foreach ($this->toolbarMBZ as $value) {
						if( stripos( $value, "</li>" ) != "")
							echo $value;
						else
							echo "<li>".$value."</li>";
					}
				} ?>
				<?php 
				if(isset($this->toolbarMenuAdd)){
					?>
				<!-- start: TO-DO DROPDOWN -->
				<li class="dropdown">
					<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<i class="fa fa-plus  fa-2x icon-big"></i> AJOUTER
						<div class="tooltip-notification hide">
							<div class="tooltip-notification-arrow"></div>
							<div class="tooltip-notification-inner">
								<div>
									<div class="semi-bold">
										PARTICIPATE HERE!
									</div>
									<div class="message">
										Try the Subview Live Experience
									</div>
								</div>
							</div>
						</div>
					</a>
					<ul class="dropdown-menu dropdown-light dropdown-subview">
						<?php 
				          foreach( $this->toolbarMenuAdd as $item )
				          {
				              $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
				              $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' : "";
				              $href = null;
				              if( isset($item["href"]) )
				              {
				              	if(stripos($item["href"], "http") >= 0 || stripos($item["href"], "#") >=0 )
				              		$href = $item["href"];
				              	else
				              		$href = Yii::app()->createUrl($item["href"]) ;
				              }
				              $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
				              $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].'"></i>' : '';
				              echo ($href) ? '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.$icon.'<span class="title">'.$item["label"].'</span></li>' : '<li class="dropdown-header '.$class.'">'.$icon.' '.$item["label"].'</li>';
				              //This menu can have 2 levels 
				              if( isset($item["children"]) )
				              {
				                  foreach( $item["children"] as $item2 )
				                  {
				                      $onclick2 = (isset($item2["onclick"])) ? 'onclick="'.$item2["onclick"].'"' : ""; 
				                      $class = (isset($item2["class"])) ? 'class="'.$item2["class"].'"' : "";
				                      $href2 = "javascript:;";
						              if( isset($item2["href"]) )
						              {
						              	if(stripos($item2["href"], "http") >= 0 || stripos($item2["href"], "#") >=0 )
						              		$href2 = $item2["href"];
						              	else
						              		$href2 = Yii::app()->createUrl($item2["href"]); 
						              	}
				                      $icon = (isset($item2["iconClass"])) ? '<i class="'.$item2["iconClass"].'"></i>' : '';
				                      $iconStack = "";
				                      if((isset($item2["iconStack"]))){
				                      	$iconStack .= '<span class="fa-stack">';
				                      	foreach( $item2["iconStack"] as $i )
						                {
						                	$iconStack .= '<i class="'.$i.'"></i>';
						                }
				                      	$iconStack .= '</span>';
				                      }
				                      echo '<li><a href="'.$href2.'" '.$class.' '.$onclick2.'>'.$icon.''.$iconStack.' '.$item2["label"].'</a></li>';
				                  }
				              }else
				                echo ($href) ? "</a>" : "";
				          }
				       ?>
						
					</ul>
				</li>
				<?php } ?>
				
				<?php 
				if(isset($this->toolbarMenuMaps)){
					?>
				<li class="dropdown hide">
					
					<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<span class="messages-count badge badge-default ">3</span> <i class="fa fa-map-marker"></i> CARTO
					</a>
					
					<ul class="dropdown-menu dropdown-light dropdown-messages">
						<li>
							<div class="drop-down-wrapper ps-container">
								<ul>
									<?php 
							          foreach( $this->toolbarMenuMaps as $item )
							          {
							          	  $onclick = (isset($item["onclick"])) ? ' onclick="'.$item["onclick"].'"' : "";
							              $href = "javascript:;";
							              if( isset($item["href"]) )
							              {
							              	if(stripos($item["href"], "http") >= 0 || stripos($item["href"], "#") >=0 )
							              		$href = $item["href"];
							              	else
							              		$href = Yii::app()->createUrl($item["href"]) ;
							              	}
							             $icon = (isset($item["iconClass"])) ? $item["iconClass"] : '';
							       ?>
							       <li>
										<a href="<?php echo $href ?>" <?php echo $onclick ?> >
											<div class="clearfix">
												<div class="thread-image">
													<i class="fa fa-3x icon-big <?php echo $icon ?>"></i>
												</div>
												<div class="thread-content">
													<span class="author"><?php echo $item["label"] ?></span>
													<span class="preview"><?php echo $item["desc"] ?> </span>
													<span class="time"><?php echo $item["extra"] ?></span>
												</div>
											</div>
										</a>
									</li>
							       <?php       
							          }
							       ?>

																	
								</ul>
							</div>
						</li>
						<li class="view-all">
							<a href="pages_messages.html">
								See All
							</a>
						</li>
					</ul>
				</li>
				<?php 
				}
					?>
				<li class="menu-search">
					
					<span class="loader-subviews">
						<i class="fa fa-spinner fa-spin"></i> LOADING
					</span>
					
					<!-- start: SEARCH POPOVER -->
					<div class="popover bottom search-box transition-all">
						<div class="arrow"></div>
						<div class="popover-content">
							<!-- start: SEARCH FORM -->
							<form class="" id="searchform" action="#">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search">
									<span class="input-group-btn">
										<button class="btn btn-main-color btn-squared" type="button">
											<i class="fa fa-search"></i>
										</button> </span>
								</div>
							</form>
							<!-- end: SEARCH FORM -->
						</div>
					</div>
					<!-- end: SEARCH POPOVER -->
				</li>
			</ul>
			<!-- end: TOP NAVIGATION MENU -->
		</div>
	</div>
</div>
<!-- end: TOOLBAR -->