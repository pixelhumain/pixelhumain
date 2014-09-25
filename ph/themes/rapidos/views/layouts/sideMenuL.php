<!-- start: PAGESLIDE LEFT -->
<a class="closedbar inner hidden-sm hidden-xs" href="#">
</a>
<nav id="pageslide-left" class="pageslide inner">
  <div class="navbar-content">
    <!-- start: SIDEBAR -->
    <div class="main-navigation left-wrapper transition-left">
      <div class="navigation-toggler hidden-sm hidden-xs">
        <a href="#main-navbar" class="sb-toggle-left">
        </a>
      </div>
      <div class="user-profile border-top padding-horizontal-10 block">
        <div class="inline-block">
          <img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1.jpg" alt="">
        </div>
        <div class="inline-block">
          <h5 class="no-margin"> <?php echo Yii::t('login','Welcome');?> </h5>
          <h4 class="no-margin"> <?php echo (isset(Yii::app()->session["user"]["name"])) ? Yii::app()->session["user"]["name"] : Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?> </h4>
          <a class="btn user-options sb_toggle">
            <i class="fa fa-cog"></i>
          </a>
        </div>
      </div>
      <!-- start: MAIN NAVIGATION MENU -->
      <ul class="main-navigation-menu">  
        <?php 
          foreach( $this->sidebar1 as $item )
          {
              $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
              $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' : "";
              $href = (isset($item["href"])) ? (stripos($item["href"], "http") === false) ? Yii::app()->createUrl($item["href"]) : $item["href"] : "#";
              $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
              $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].'"></i>' : '';
              echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.$icon.'<span class="title">'.$item["label"].'</span>';
              //This menu can have 2 levels
              if( isset($item["children"]) )
              {
                  echo "<i class='icon-arrow'></i></a><ul class='sub-menu'>";
                  foreach( $item["children"] as $item2 )
                  {
                      $modal2 = (isset($item2["isModal"])) ? 'role="button" data-toggle="modal"' : "";
                      $onclick2 = (isset($item2["onclick"])) ? 'onclick="'.$item2["onclick"].'"' 
                                                             : ( (isset($item2["key"])) ? 'onclick="scrollTo(\'#block'.$item2["key"].'\')"' 
                                                                                        : "" );
                      $href2 = (isset($item2["href"])) ? (stripos($item2["href"], "http") === false) ? Yii::app()->createUrl($item2["href"]) : $item2["href"] : "javascript:;";
                      $icon = (isset($item2["iconClass"])) ? '<i class="'.$item2["iconClass"].'"></i>' : '';
                      echo '<li><a href="'.$href2.'" '.$modal2.' '.$onclick2.'>'.$icon.' '.$item2["label"].'</a></li>';
                  }
                  echo "</ul>";
              }else
                echo "</a>";
              echo "</li>";
          }
          ?>
        
        <!-- END TWO LEVEL MENU -->     
      </ul>
      <div class="clearfix"></div>
      <!-- end: MAIN NAVIGATION MENU -->
    </div>
    <!-- end: SIDEBAR -->
  </div>
  <div class="slide-tools">
    <div class="col-xs-6 text-left no-padding">
      <a class="btn btn-sm status" href="#">
        Status <i class="fa fa-dot-circle-o text-green"></i> <span>Online</span>
      </a>
    </div>
    <div class="col-xs-6 text-right no-padding">
      <a class="btn btn-sm log-out text-right" href="login_login.html">
        <i class="fa fa-power-off"></i> Log Out
      </a>
    </div>
  </div>
</nav>
<!-- end: PAGESLIDE LEFT -->