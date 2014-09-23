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
          <h4 class="no-margin"> <?php echo Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?> </h4>
          <a class="btn user-options sb_toggle">
            <i class="fa fa-cog"></i>
          </a>
        </div>
      </div>
      <!-- start: MAIN NAVIGATION MENU -->
      <ul class="main-navigation-menu">
        <li>
          <a href="javascript:void(0)"><i class="fa fa-home"></i> <span class="title"> Management </span><i class="icon-arrow"></i> </a>
          <ul class="sub-menu">
            <li>
              <a href="<?php echo Yii::app()->createUrl("/teeo/event")?>">
                <span class="title"> Evenement </span>
              </a>
            </li>
            <li>
              <a href="">
                <span class="title"> RPEE </span>
              </a>
            </li>
            <li>
              <a href="">
                <span class="title"> Audit </span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)"><i class="fa fa-cog"></i> <span class="title"> Configuration </span><i class="icon-arrow"></i> </a>
          <ul class="sub-menu">
            <li>
              <a href="">
                <span class="title"> Management de l'Energie </span>
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript:void(0)"><i class="fa fa-life-bouy "></i> <span class="title"> Temporaire </span><i class="icon-arrow"></i> </a>
          <ul class="sub-menu">
            <li>
                <a href="<?php echo Yii::app()->createUrl("/teeo/person/login")?>">
                  <span class="title"> Login </span>
                </a>
              </li>
              <li>
                <a href="<?php echo Yii::app()->createUrl("/teeo/person/login?box=register")?>">
                  <span class="title"> Register </span>
                </a>
              </li>
              <li>
                <a href="<?php echo Yii::app()->createUrl("/teeo/person/profile")?>">
                  <span class="title"> Profile </span>
                </a>
              </li>
              <li>
                <a href="<?php echo Yii::app()->createUrl("/teeo/default/tree")?>">
                  <span class="title"> Tree </span>
                </a>
              </li>
              <li>
                <a href="<?php echo Yii::app()->createUrl("/teeo/default/lists")?>">
                  <span class="title"> Lists </span>
                </a>
              </li>
            </ul>
        </li>
      </ul>
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