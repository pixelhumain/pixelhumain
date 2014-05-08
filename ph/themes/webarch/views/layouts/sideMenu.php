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
          
          <div class="greeting">Bienvenue</div>
          <div class="username"><span class="semi-bold">Citoyen</span></div>
          <div class="status"><a href="#loginForm" role="button" data-toggle="modal" title="connexion"><i class="icon-login green"></i>Se Connecter</a></div>
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
        <div class="username"><span class="semi-bold"><?php echo $account['name']?></span></div>
        <div class="status">Connecté<a href="<?php Yii::app()->createUrl("citoyens/moi")?>"><div class="status-icon green"></div><?php echo (isset($account['cp'])) ? "<a href='".Yii::app()->createUrl("commune/view/cp/".$account['cp'])."'>".$account['cp'].'</a>' : $account['name']?></a></div>
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
            $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].'"></i>' : '';
            echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.$icon.'<span class="title">'.$item["label"].'</span>';
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
      
      <!-- END TWO LEVEL MENU -->     
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- BEGIN SIDEBAR WIDGETS -->
    
      
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