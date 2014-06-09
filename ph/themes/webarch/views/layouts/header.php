<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse"> 
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <!-- BEGIN NAVIGATION HEADER -->
        <div class="header-seperation"> 
            <!-- BEGIN MOBILE HEADER -->
            <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">    
                <li class="dropdown">
                    <a id="main-menu-toggle" href="#main-menu" class="">
                        <div class="iconset top-menu-toggle-white"></div>
                    </a>
                </li>        
            </ul>
            <!-- END MOBILE HEADER -->
            <!-- BEGIN LOGO --> 
            <a href="<?php echo Yii::app()->baseUrl;?>">
                <img src="<?php echo Yii::app()->theme->baseUrl;?>/assets/img/logo.png" class="logo" alt="" data-src="<?php echo Yii::app()->theme->baseUrl;?>/assets/img/logo.png" data-src-retina="<?php echo Yii::app()->theme->baseUrl;?>/assets/img/logo2x.png" width="106" height="21"/>
            </a>
            <!-- END LOGO --> 
            <!-- BEGIN LOGO NAV BUTTONS -->
            <ul class="nav pull-right notifcation-center">  
                <li class="dropdown" id="header_task_bar">
                    <a href="<?php echo Yii::app()->createUrl("/citoyens/moi");?>" class="dropdown-toggle active" data-toggle="">
                        <div class="iconset top-home"></div>
                    </a>
                </li>
                <li class="dropdown" id="header_inbox_bar">
                    <a href="#" class="dropdown-toggle">
                        <div class="iconset top-messages"></div>
                        <span class="badge" id="msgs-badge">2</span>
                        </a>
                </li>
                <!-- BEGIN MOBILE CHAT TOGGLER -->
                <li class="dropdown" id="portrait-chat-toggler" style="display:none">
                    <a href="#sidr" class="chat-menu-toggle">
                        <div class="iconset top-chat-white"></div>
                    </a>
                </li>
                <!-- END MOBILE CHAT TOGGLER -->                        
            </ul>
            <!-- END LOGO NAV BUTTONS -->
        </div>
        <!-- END NAVIGATION HEADER -->
        <!-- BEGIN CONTENT HEADER -->
        <div class="header-quick-nav"> 
            <!-- BEGIN HEADER LEFT SIDE SECTION -->
            <div class="pull-left"> 
                <!-- BEGIN SLIM NAVIGATION TOGGLE -->
                <ul class="nav quick-section">
                    <li class="quicklinks">
                        <a href="#" class="" id="layout-condensed-toggle">
                            <div class="iconset top-menu-toggle-dark"></div>
                        </a>
                    </li>
                </ul>
                <!-- END SLIM NAVIGATION TOGGLE -->             
                <!-- BEGIN HEADER QUICK LINKS -->
                <ul class="nav quick-section">
                    <li class="quicklinks"><a href="#" class=""><div class="iconset top-reload"></div></a></li>
                    <li class="quicklinks"><span class="h-seperate"></span></li>
                    <li class="quicklinks"><a href="#" class=""><div class="iconset top-tiles"></div></a></li>
                    <!-- BEGIN SEARCH BOX -->
                    <li class="m-r-10 input-prepend inside search-form no-boarder">
                        <span class="add-on"><span class="iconset top-search"></span></span>
                        <input name="" type="text" class="no-boarder" placeholder="Search Dashboard" style="width:250px;">
                    </li>
                    <!-- END SEARCH BOX -->
                </ul>
                <!-- BEGIN HEADER QUICK LINKS -->               
            </div>
            <!-- END HEADER LEFT SIDE SECTION -->
            <!-- BEGIN HEADER RIGHT SIDE SECTION -->
            <div class="pull-right"> 
                <?php if(!isset(Yii::app()->session["userId"])){?>
                 <ul class="nav quick-section">
                    <li class="quicklinks"> 
                        <a href="#loginForm" class="btn " role="button" data-toggle="modal" title="connexion" ><i class="icon-logout"></i>Se Connecter</a>
                    </li>
                   
                </ul>
                <?php } else { ?>
                <div class="chat-toggler">  
                    <!-- BEGIN NOTIFICATION CENTER -->
                    <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">
                        <div class="user-details"> 
                            <div class="username">
                                <span class="badge badge-important">3</span>&nbsp;<?php echo Yii::app()->session["userEmail"]?><span class="bold">&nbsp;<?php if(isset($account['name']))echo $account['name']?></span>                                 
                            </div>                      
                        </div> 
                        <div class="iconset top-down-arrow"></div>
                    </a>    
                    <div id="notification-list" style="display:none">
                        <div style="width:300px">
                            <!-- BEGIN NOTIFICATION MESSAGE -->
                            <div class="notification-messages info">
                                <div class="user-profile">
                                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/assets/img/profiles/d.jpg" alt="" data-src="<?php echo Yii::app()->theme->baseUrl;?>/assets/img/profiles/d.jpg" data-src-retina="<?php echo Yii::app()->theme->baseUrl;?>/assets/img/profiles/d2x.jpg" width="35" height="35">
                                </div>
                                <div class="message-wrapper">
                                    <div class="heading">Title of Notification</div>
                                    <div class="description">Description...</div>
                                    <div class="date pull-left">A min ago</div>                                     
                                </div>
                                <div class="clearfix"></div>                                    
                            </div>
                            <!-- END NOTIFICATION MESSAGE -->   
                        </div>              
                    </div>
                    <!-- END NOTIFICATION CENTER -->
                    <!-- BEGIN PROFILE PICTURE -->
                    <div class="profile-pic"> 
                        <img src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" alt="" data-src="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" data-src-retina="<?php echo ( isset($account) && isset($account['img']) ) ? Yii::app()->createUrl($account['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" width="69" height="69" />
                    </div>  
                    <!-- END PROFILE PICTURE -->                
                </div>
                <!-- BEGIN HEADER NAV BUTTONS -->
                <ul class="nav quick-section">
                    <!-- BEGIN SETTINGS -->
                    <li class="quicklinks"> 
                        
                        <a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">                        
                            <div class="iconset top-settings-dark"></div>   
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
                            <li><a href="#">Normal Link</a></li>
                            <li><a href="#">Badge Link&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a></li>
                            
                            
                                <?php if(isset($account["cp"])){?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('commune')?>" role="button" data-toggle="modal" title="Commune" ><i class="icon-town-hall"></i>Commune</a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="#" class="ml10 w60 pink" onclick="openModal('cp','citoyens','<?php echo Yii::app()->session["userId"]?>','nameForm')" title="Commune" ><i class="icon-town-hall"></i>Commune</a>
                                    </li>
                                <?php } ?>
                                
                                <?php if(!isset($account["email"])){?>
                                <li>
                                    <a href="#" class="ml10 w60 pink" onclick="openModal('email','citoyens','<?php echo Yii::app()->session["userId"]?>','nameForm')" title="Email" ><i class="icon-at"></i>Email</a>
                                </li>
                                <?php } ?>
                                
                                <?php if(isset($account["associations"])){?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('association')?>" role="button" data-toggle="modal" title="Association" ><i class="icon-users"></i>Association</a>
                                </li>
                                <?php } ?>
                                
                                <?php if(true){?>
                                <li>
                                    <?php //<span class="badge">2</span>//?>
                                    <a href="<?php echo Yii::app()->createUrl('discuter')?>"  role="button" data-toggle="modal" title="Discuter" ><i class="icon-chat"></i>Infos</a>
                                </li>
                                <?php } ?>
                                
                                <li>
                                    <a href="#participer" role="button" data-toggle="modal" title="mon compte" ><i class="icon-cog-1"></i>Mon compte</a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('site/logout')?>" role="button" data-toggle="modal" title="deconnexion" ><i class="icon-logout"></i>Déconnection</a>
                                </li>
                           
                            <li class="divider"></li>                
                            <li><a href="#"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Separated Link</a></li>
                        </ul>
                         
                    </li>
                    <!-- END SETTINGS -->
                    <li class="quicklinks"><span class="h-seperate"></span></li> 
                    <!-- BEGIN CHAT SIDEBAR TOGGLE -->
                    <li class="quicklinks">     
                        <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle">
                            <div class="iconset top-chat-dark"><span class="badge badge-important hide" id="chat-message-count">1</span></div>
                        </a> 
                        <!-- BEGIN OPTIONAL RECENT CHAT POP UP NOTIFICATION -->
                        <div class="simple-chat-popup chat-menu-toggle hide">
                            <div class="simple-chat-popup-arrow"></div>
                            <div class="simple-chat-popup-inner">
                                <div style="width:100px">
                                    <div class="semi-bold">Name</div>
                                    <div class="message">Message...</div>
                                </div>
                            </div>
                        </div>
                        <!-- END OPTIONAL RECENT CHAT POP UP NOTIFICATION -->
                    </li>
                    <!-- END CHAT SIDEBAR TOGGLE --> 
                </ul>
                <!-- END HEADER NAV BUTTONS -->
                <?php } ?>
            </div>
            <!-- END HEADER RIGHT SIDE SECTION -->
        </div> 
        <!-- END CONTENT HEADER --> 
    </div>
    <!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->