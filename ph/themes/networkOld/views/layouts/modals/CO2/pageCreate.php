
<div class="portfolio-modal modal fade" id="dash-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="50" class="inline margin-top-25 margin-bottom-5"><br>
                    
                    <h3 class="letter-red no-margin hidden-xs">
                        <small class="text-dark">Un réseau social <span class="letter-red">citoyen</span>, au service du <span class="letter-red">bien commun</span></small>
                    </h3><br>
                    <h3 class="letter-red no-margin hidden-xs">
                        <i class="fa fa-plus-circle"></i> Créer une page<br>
                    </h3>
                </div>               
            </div>
            <div class="row links-create-element">
                <div class="col-lg-12">
                    <div class="col-md-12 margin-top-15 text-dark">
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Partage de messages</label> 
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Partage d'événements</label> 
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Gestion de contacts</label>  
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Messagerie privée</label>  
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Notifications</label> 
                       <hr>
                    </div>
                    
                    <div id="" class="modal-body">
                        <div class="col-md-12 hidden">
                            
                        </div>
                         <h4 class="modal-title text-center hidden">
                            Choisissez le type de page qui vous correspond le mieux
                            <hr>
                        </h4>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="NGO" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h2 class="text-green"><i class="fa fa-group padding-bottom-10"></i><br>
                                    <span class="font-light"> Association</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Resserrer les liens du tissu associatif
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            Le monde associatif est basé sur l'entraide et la solidarité.<br>
                                            Plus que jamais, les associations ont besoin de se relier entre elles,<br> 
                                            pour faire plus et mieux, ensemble.
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-green margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer une page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="LocalBusiness" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h2 class="text-azure"><i class="fa fa-industry padding-bottom-10"></i><br>
                                    <span class="font-light"> Entreprise</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Dynamiser le monde de l'entreprise
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            Restez connecté à vos contacts, vos clients, vos employés, vos fournisseurs...<br>
                                            Le réseau vous apportera une visibilité incomparable<br>
                                            auprès de ceux qui vivent près de vous.
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-azure margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer une page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="Group" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h2 class="text-turq"><i class="fa fa-circle-o padding-bottom-10"></i><br>
                                    <span class="font-light"> Groupe</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Mettre en valeur les liens humains
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            La vie c'est des rencontres, des amitiés, des liens qui nous unissent<br> 
                                            à travers nos activités, nos centres d'intérêts, nos plaisirs.<br>
                                            Les vivre c'est bien, les partager c'est encore mieux!
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-turq margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer une page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" 
                            data-ktype="event" data-type="event"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h2 class="text-orange"><i class="fa fa-calendar padding-bottom-10"></i><br>
                                    <span class="font-light"> Évènement</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Ce sont les petites initiatives<br>qui donnent naissance aux projets hors du commun
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            N'hésitez jamais à faire connaître vos évènements.<br>
                                            Communiquez-les massivement!
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-orange margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer une page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" 
                            data-ktype="project" data-type="project"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h2 class="text-purple"><i class="fa fa-lightbulb-o padding-bottom-10"></i><br>
                                    <span class="font-light"> Projet</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Ce sont les petites initiatives<br>qui donnent naissance aux projets hors du commun
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            N'hésitez jamais à faire connaître vos envies, vos projets, vos rêves.<br>
                                            C'est comme ça qu'ils grandissent !
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-purple margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer une page</button>
                                </div>
                            </div>
                        </a>

                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="GovernmentOrganization" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-center">
                                <h2 class="text-red"><i class="fa fa-university padding-bottom-10"></i><br>
                                    <span class="font-light"> Service public</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Le lien entre l'Etat et les citoyens
                                        <small class="hidden-xs" style="text-transform: none;"><br>
                                            Les services publics sont les piliers de notre démocratie<br>
                                            Il est important de les cartographier, et de les rendre accessibles facilement<br>
                                            au niveau local comme national
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-red margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer une page</button>
                                </div>
                            </div>
                        </a>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <hr>
                            <a href="javascript:" style="font-size: 13px;" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>