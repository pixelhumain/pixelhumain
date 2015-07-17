<!-- start: TOOLBAR -->
<div class="toolbar row">
	<div class="col-sm-6 hidden-xs">
		<div class="page-header">
			<h1><?php echo (isset($this->title)) ? $this->title : "Page Title"; ?><small><?php echo (isset($this->subTitle)) ? $this->subTitle : "Page subTitle";?></small></h1>
		</div>
	</div>
	<div class="col-sm-6 col-xs-12">
		<a href="#" class="back-subviews">
			<i class="fa fa-chevron-left"></i> BACK
		</a>
		<a href="#" class="close-subviews">
			<i class="fa fa-times"></i> CLOSE
		</a>
		<div class="toolbar-tools pull-right">
			<ul class="nav navbar-right">
				<!-- start: TO-DO DROPDOWN -->
				<li class="dropdown">
					<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<i class="fa fa-plus  fa-2x icon-big"></i> ADD
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
				              $href = (isset($item["href"])) ? (stripos($item["href"], "http") === false) ? Yii::app()->createUrl($item["href"]) : $item["href"] : null;
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
				                      $href2 = (isset($item2["href"])) ? (stripos($item2["href"], "http") === false) ? $item2["href"] : $item2["href"] : "javascript:;";
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
				
				<?php 
				if(isset($this->toolbarMenuMaps)){
					?>
				<li class="dropdown">
					<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<span class="messages-count badge badge-default ">3</span> <i class="fa fa-map-marker"></i> MAPS
					</a>
					<ul class="dropdown-menu dropdown-light dropdown-messages">
						<li>
							<div class="drop-down-wrapper ps-container">
								<ul>
									<?php 
							          foreach( $this->toolbarMenuMaps as $item )
							          {
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
												<a href="<?php echo $href ?>">
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
			</ul>
			<!-- end: TOP NAVIGATION MENU -->
		</div>
	</div>
</div>
<!-- end: TOOLBAR -->