<!-- BEGIN SIDEBAR -->
  <!-- BEGIN MENU -->
  <div class="page-sidebar" id="main-menu"> 
      <div class="page-sidebar-wrapper" id="main-menu-wrapper">
    <!-- BEGIN MINI-PROFILE -->
    <div class="user-info-wrapper"> 
      <div class="profile-wrapper">
        <img src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" alt="" data-src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" data-src-retina="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" width="69" height="69" />
      </div>
      <div class="user-info">
        <?php if(!isset(Yii::app()->session["userId"])){?>
          <div class="cube pull-left">
            <a href="#loginForm" class="ml10 w60" role="button" data-toggle="modal" title="connexion" ><span class="icon-login"></span><span class="fsxs menuTitle">Connection</span></a>
          </div>
          <div class="greeting">Bienvenue</div>
          <div class="username"><span class="semi-bold">Citoyen</span></div>
          <div class="status">Status<a href="#"><div class="status-icon green"></div>Se Connecter</a></div>
        <?php } else {
           
              $k_path_url = (isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
              $path = $k_path_url.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
              $mode = "style='width:30px'";
              
              if ( isset($account) && isset($account['img']) && file_exists($path.$account['img']) ) {
                  $img = getimagesize( $path.$account['img'] );
                  $width = $img[0]; 
                  $height = $img[1]; 
                  $aspect = $height / $width; 
                  if ($aspect >= 1) 
                      $mode = "style='height:30px'"; 
              }
           
            ?>
        <div class="greeting">Bienvenue</div>
        <div class="username"><span class="semi-bold"><?php echo $account['email']?></span></div>
        <div class="status">Connecté<a href="#"><div class="status-icon green"></div><?php echo $account['name']?></a></div>
        <?php } ?>
      </div>
    </div>
    <!-- END MINI-PROFILE -->
    <!-- BEGIN SIDEBAR MENU --> 
    <p class="menu-title">BROWSE<span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
    <ul>  
      <?php 
        foreach( $this->sidebar1 as $item )
        {
            $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
            $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' : "";
            $href = (isset($item["href"])) ? $item["href"] : "#";
            $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
            echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' ><i class="'.$item["iconClass"].'"></i><span class="title">'.$item["label"].'</span>';
            //This menu can have 2 levels
            if( isset($item["children"]) )
            {
                echo "<span class='arrow'></span></a><ul class='sub-menu'>";
                foreach( $item["children"] as $item2 )
                {
                    $modal2 = (isset($item2["isModal"])) ? 'role="button" data-toggle="modal"' : "";
                    $onclick2 = (isset($item2["onclick"])) ? 'onclick="'.$item2["onclick"].'"' : "";
                    $href2 = (isset($item2["href"])) ? $item2["href"] : "#";
                    echo '<li><a href="'.$href2.'" '.$modal2.' '.$onclick2.'>'.$item2["label"].'</a></li>';
                }
                echo "</ul>";
            }else
              echo "</a>";
            echo "</li>";
        }
        ?>
      <!-- BEGIN SELECTED LINK -->
      <li class="start active">
        <a href="#">
          <i class="icon-custom-home"></i>
          <span class="title">Link 1</span>
          <span class="selected"></span>
          <span class="badge badge-important pull-right">5</span>
        </a>
      </li>
      <!-- END SELECTED LINK -->
      <!-- BEGIN BADGE LINK -->
      <li class="">
        <a href="#">
          <i class="fa fa-envelope"></i>
          <span class="title">Link 2</span>
          <span class="badge badge-disable pull-right">203</span>
        </a>
      </li>
      <!-- END BADGE LINK -->     
      <!-- BEGIN SINGLE LINK -->
      <li class="">
        <a href="#">
          <i class="fa fa-flag"></i>
          <span class="title">Link 3</span>
        </a>
      </li>
      <!-- END SINGLE LINK -->    
      <!-- BEGIN ONE LEVEL MENU -->
      <li class="">
        <a href="javascript:;">
          <i class="icon-custom-ui"></i>
          <span class="title">Link 4</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li><a href="#">Sub Link 1</a></li>
        </ul>
      </li>
      <!-- END ONE LEVEL MENU -->
      <!-- BEGIN TWO LEVEL MENU -->
      <li class="">
        <a href="javascript:;">
          <i class="fa fa-folder-open"></i>
          <span class="title">Link 5</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li><a href="javascript:;">Sub Link 1</a></li>
          <li>
            <a href="javascript:;"><span class="title">Sub Link 2</span><span class="arrow "></span></a>
            <ul class="sub-menu">
              <li><a href="javascript:;">Sub Link 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <!-- END TWO LEVEL MENU -->     
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- BEGIN SIDEBAR WIDGETS -->
    <div class="side-bar-widgets">
      <!-- BEGIN FOLDER WIDGET -->
      <p class="menu-title">FOLDER<span class="pull-right"><a href="#" class="create-folder"><i class="icon-plus"></i></a></span></p>
      <ul class="folders">
        <li><a href="#"><div class="status-icon green"></div>Task 1</a></li>
        <!-- BEGIN HIDDEN INPUT BOX (FOR ADD FOLDER LINK) -->
        <li class="folder-input" style="display:none">
          <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" id="folder-name">
        </li>
        <!-- END HIDDEN INPUT BOX (FOR ADD FOLDER LINK) -->
      </ul>
      <!-- END FOLDER WIDGET -->
      <!-- BEGIN PROJECTS WIDGET -->
      <p class="menu-title">PROJECTS</p>
      <!-- BEGIN EXAMPLE 1 -->
      <div class="status-widget">
        <div class="status-widget-wrapper">
          <div class="title">Project Title<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>
          <p>Project Description</p>
        </div>
      </div>
      <!-- END EXAMPLE 1 -->
      <!-- END PROJECTS WIDGET -->
    </div>
    <div class="clearfix"></div>
    <!-- END SIDEBAR WIDGETS --> 
  </div>
  </div>
  <!-- BEGIN SCROLL UP HOVER -->
  <a href="#" class="scrollup">Scroll</a>
  <!-- END SCROLL UP HOVER -->
  <!-- END MENU -->
  <!-- BEGIN SIDEBAR FOOTER WIDGET -->
  <div class="footer-widget">   
    <div class="progress transparent progress-small no-radius no-margin">
      <div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>    
    </div>
    <div class="pull-right">
      <div class="details-status">
        <span data-animation-duration="560" data-value="86" class="animate-number"></span>%
      </div>  
      <a href="#"><i class="fa fa-power-off"></i></a>
    </div>
  </div>
  <!-- END SIDEBAR FOOTER WIDGET -->
  <!-- END SIDEBAR --> 