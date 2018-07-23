<style>
    @media (max-width: 767px) {
        .portfolio-modal#dash-create-modal .modal-content h4{
            font-size:13px;
        }
        .portfolio-modal#dash-create-modal .modal-content h5{
            font-size:10px;
        }

        .portfolio-modal#dash-create-modal .modal-content .links-create-element a.btn-create-elem{
            min-height: 185px;
        }
        .portfolio-modal#dash-create-modal .modal-content .links-create-element a.btn-create-elem button{
            /*bottom:5px;*/
        }
    }
</style>
<div class="portfolio-modal modal fade" id="dash-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="20" class="inline margin-top-25 margin-bottom-5"><br>
                    
                    <h3 class="letter-red no-margin">
                        <small class="text-dark"><?php echo Yii::t("docs", "A <span class='letter-red'>citizen</span> social network, serving <span class=letter-red'>commons</span>") ?></small>
                    </h3><br>
                    <h3 class="letter-red no-margin">
                        <i class="fa fa-plus-circle"></i> <?php echo Yii::t("common","Create a page") ?><br>
                    </h3>
                </div>               
            </div>
            <div class="row links-create-element">
                <div class="col-lg-12">
                    <div class="col-md-12 margin-top-15 text-dark">
                        <label class="label label-lg bg-green-k padding-5 inline-block">
                            <i class="fa fa-check"></i> <?php echo Yii::t("docs","Communicate the news") ?>
                        </label> 
                        <label class="label label-lg bg-green-k padding-5 inline-block">
                            <i class="fa fa-check"></i> <?php echo Yii::t("docs","Share events") ?>
                        </label> 
                        <label class="label label-lg bg-green-k padding-5 inline-block">
                            <i class="fa fa-check"></i> <?php echo Yii::t("docs","Collective space") ?>
                        </label>  
                        <label class="label label-lg bg-green-k padding-5 inline-block">
                            <i class="fa fa-check"></i> <?php echo Yii::t("docs","Private messaging") ?>
                        </label>  
                        <label class="label label-lg bg-green-k padding-5 inline-block">
                            <i class="fa fa-check"></i> <?php echo Yii::t("common","Notifications") ?>
                        </label> 
                       <hr>
                    </div>

                    <div class="col-md-12 margin-top-15 text-dark">
                        <button class="btn btn-default text-yellow inline-block margin-bottom-10 btn-open-form"><i class="fa fa-plus-circle"></i> 
                            <span class="hidden-xs"><?php echo Yii::t("common","Invite someone") ?></span>
                        </button>
                            <button class="btn btn-default text-green inline-block margin-bottom-10 btn-open-form" data-form-subtype="NGO" data-form-type="organization"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create a NGO") ?></span>
                            </button>
                            <button class="btn btn-default text-azure inline-block margin-bottom-10 btn-open-form" data-form-subtype="LocalBusiness" data-form-type="organization"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create an enterprise") ?></span>
                            </button>
                            <button class="btn btn-default text-turq inline-block margin-bottom-10 btn-open-form" data-form-subtype="Group" data-form-type="organization"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create a group") ?></span>
                            </button>
                            <button class="btn btn-default text-orange inline-block margin-bottom-10 btn-open-form" data-form-type="event"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create an event") ?></span>
                            </button>
                            <button class="btn btn-default text-purple inline-block margin-bottom-10 btn-open-form" data-form-type="project"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create a project") ?></span>
                            </button>
                            <button class="btn btn-default text-red inline-block margin-bottom-10btn-open-form" data-form-subtype="GovernmentOrganization" data-form-type="organization"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Add a governemental organization") ?></span>
                            </button>
                            <button class="btn btn-default text-azure inline-block margin-bottom-10 btn-open-form" data-form-type="classifieds"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create a classified ad") ?></span>
                            </button>
                            <button class="btn btn-default text-vine inline-block margin-bottom-10 btn-open-form" data-form-type="ressources"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create a ressource") ?></span>
                            </button>
                            <button class="btn btn-default text-brown inline-block margin-bottom-10 btn-open-form" data-form-type="poi"><i class="fa fa-plus-circle"></i> 
                                <span class="hidden-xs"><?php echo Yii::t("common","Create a point of interest") ?></span>
                            </button>
                       <hr>
                    </div>
                    
                    <div id="" class="modal-body hidden-xs">
                        
                        <h4 class="modal-title text-center hidden">
                            <?php echo Yii::t("docs","Choose which kind of page you want to create") ?>
                            <hr>
                        </h4>
                        
                        <a href="#element.invite" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6 lbhp"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-yellow"><i class="fa fa-user padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","People") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Create your community and make it bigger") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Invite people you know to invite them in this local world<br/>Numeric informations to real meeting") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-yellow margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Invite someone") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="NGO" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-green"><i class="fa fa-group padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","NGO") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Strengthen links of associations network") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Civil society organizations is based on cooperation and solidarity.<br>More than ever, NGOs should be linked,<br>in order to work better and smarter.") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-green margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a NGO") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="LocalBusiness" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-azure"><i class="fa fa-industry padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","Local Business") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Boost the world of business") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Keep connection with your contacts, your customers, your employees, your providers...<br>The network will give you a visibility<br>fo the community living around you") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-azure margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create an enterprise") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="Group" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-turq"><i class="fa fa-circle-o padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","Group") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Highlight human relations") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Life is full of meetings, frienships, and links that bind us together<br>through our activities, our interests, our hobbies.<br>Live them is great, share them is greater!") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-turq margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a group") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" 
                            data-ktype="event" data-type="event"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-orange"><i class="fa fa-calendar padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Event") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","A day, a moment, a share, a discovery") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Share your events<br>And communicate them massively!") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-orange margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create an event") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" 
                            data-ktype="project" data-type="project"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-purple"><i class="fa fa-lightbulb-o padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Project") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","It's the little things<br>that one day change the world") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Share your wishes, your ideas, your dreams<br>This is the way to make them grow !") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-purple margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a project") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>

                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="GovernmentOrganization" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-red"><i class="fa fa-university padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","Government Organization") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","The link between the government and people") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Public services are the pillars of our democracy.<br>It is important to map them and make them readily available<br>at the local level as well as national") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-red margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Add a governemental organization") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-type="classifieds"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-azure"><i class="fa fa-bullhorn padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Classified") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","There is none sens to keep it for you<br/> Economy is capital") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","The market of classifieds is the creation of value.<br/> Exchange, hire, buy and sell localy faster and faster to produce value and develop a real economy.") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-azure margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a classified ad") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-type="ressources"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-vine"><i class="fa fa-cubes padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","Ressource") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Material, Conpetences, Services<br/>Together we are stronger") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Call ressources you need or purpose it.<br/> Sharing our knowledge to built it better") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-vine margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a ressource") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-type="poi"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-green-poi"><i class="fa fa-home padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Point of interest") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Every point hides creativity and life") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Points of interests are centers of meeting, collective creation and are full of energy") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-green-poi margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a point of interest") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <hr>
                            <a href="javascript:" style="font-size: 13px;" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?></a>
                        </div>

                    </div>

                    <div id="" class="modal-body visible-xs">
                        
                        <h4 class="modal-title text-center hidden">
                            <?php echo Yii::t("docs","Choose which kind of page you want to create") ?>
                            <hr>
                        </h4>
                        
                        <a href="#element.invite" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6 lbhp"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-yellow"><i class="fa fa-user padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","People") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Create your community and make it bigger") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Invite people you know to invite them in this local world<br/>Numeric informations to real meeting") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-yellow margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Invite someone") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="NGO" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-green"><i class="fa fa-group padding-bottom-10"></i>
                                    <span class="font-light"> <?php echo Yii::t("category","NGO") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Strengthen links of associations network") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Civil society organizations is based on cooperation and solidarity.<br>More than ever, NGOs should be linked,<br>in order to work better and smarter.") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-green margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a NGO") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="LocalBusiness" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-azure"><i class="fa fa-industry padding-bottom-10"></i>
                                    <span class="font-light"> <?php echo Yii::t("category","Local Business") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Boost the world of business") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Keep connection with your contacts, your customers, your employees, your providers...<br>The network will give you a visibility<br>fo the community living around you") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-azure margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create an enterprise") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="Group" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-turq"><i class="fa fa-circle-o padding-bottom-10"></i>
                                    <span class="font-light"> <?php echo Yii::t("category","Group") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Highlight human relations") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Life is full of meetings, frienships, and links that bind us together<br>through our activities, our interests, our hobbies.<br>Live them is great, share them is greater!") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-turq margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a group") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" 
                            data-ktype="event" data-type="event"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-orange"><i class="fa fa-calendar padding-bottom-10"></i>
                                    <span class="font-light"> <?php echo Yii::t("common","Event") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","A day, a moment, a share, a discovery") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Share your events<br>And communicate them massively!") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-orange margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create an event") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" 
                            data-ktype="project" data-type="project"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-purple"><i class="fa fa-lightbulb-o padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Project") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","It's the little things<br>that one day change the world") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Share your wishes, your ideas, your dreams<br>This is the way to make them grow !") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-purple margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a project") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>

                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-ktype="GovernmentOrganization" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-red"><i class="fa fa-university padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","Government Organization") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","The link between the government and people") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Public services are the pillars of our democracy.<br>It is important to map them and make them readily available<br>at the local level as well as national") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-red margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Add a governemental organization") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-type="classifieds"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-azure"><i class="fa fa-bullhorn padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Classified") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","There is none sens to keep it for you<br/> Economy is capital") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","The market of classifieds is the creation of value.<br/> Exchange, hire, buy and sell localy faster and faster to produce value and develop a real economy.") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-azure margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a classified ad") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-type="ressources"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-vine"><i class="fa fa-cubes padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("category","Ressource") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Material, Conpetences, Services<br/>Together we are stronger") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Call ressources you need or purpose it.<br/> Sharing our knowledge to built it better") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-vine margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a ressource") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                        
                        <a href="javascript:" class="btn-create-elem col-lg-4 col-md-6 col-sm-6 col-xs-6" data-type="places"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h4 class="text-brown"><i class="fa fa-home padding-bottom-10"></i><br>
                                    <span class="font-light"> <?php echo Yii::t("common","Place") ?></span>
                                </h4>
                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5><?php echo Yii::t("docs","Every place hides creativity and life") ?>
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            <?php echo Yii::t("docs","Places are centers of meeting, collective creation and are full of energy") ?>
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-brown margin-bottom-15"><i class="fa fa-plus-circle"></i> 
                                        <span class="hidden-xs"><?php echo Yii::t("common","Create a place") ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <hr>
                            <a href="javascript:" style="font-size: 13px;" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>