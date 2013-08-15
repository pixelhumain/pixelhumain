<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name.", démocratie participative Réunion, discussion , actions et réseau local";
?>

 <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
<div class="container" id="accueil">
    <br/>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit">
        
        <div id="myCarousel" class="carousel slide">
            
              <div class="space20px;"></div>
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <!-- Carousel nav -->
              <div class="carousel-controls">
                  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
              <!-- Carousel items -->
              <div class="carousel-inner" style="height:460px;width:85%;margin-left:60px">
              
                <div class="active item p40">
                    <h1 class="pull-right">Le Pixel Humain!</h1> 
                    <div style="width:500px; text-align:right;" class="pull-right">
                   
                        <p>Un projet citoyen de démocratie participative qui prend racine à la Réunion portée par l'association Open Atlas <br/><small class="fsxs">(loi 19101, but non lucratif)</small>. </p>
                        <p>Une plateforme de discussions et actions citoyennes sur un réseau local <br/>(en cours construction, Recherche de financement). </p>
                    </div>
                    <img class="pull-left" id="logoBanner" src="<?php echo Yii::app()->createUrl('images/logo/logo320.png')?>" alt="Logo Pixel Humain"/>
                </div>
                
                <div class="item p40">
                    <div style="width:500px; text-align:left;" class="pull-left">
                        <p> "ça ne changera jamais" et "on n'a pas notre mot à dire de toute façon" ? <br/>
                        La démocratie actuelle n'est-elle pas à bout de souffle ? <br/>
                        Il est temps de s'organiser et de se regrouper pour trouver de nouvelle solution. <br/><br/>
                        A l'heure d'internet, de la simplification de la communication et du partage de l'information,
                        tout est réunit pour que tout un chacun s'organise pour faire changer les choses.<br/><br/>
                        Et si un outil proposait une interface web pour que citoyens, associations, collectivités et entreprises 
                        travaillent pour construire une société à l'image de tous?<br/><br/>
                        Un outil dans lequel le citoyen dialoguerait avec sa ville pour participer aux décisions qui le 
                        concernent le plus. Si cet outil permettait à ce même citoyen de connaître ses voisins qui a les mêmes 
                        intérêts sur lui, les associations qui proposent des initiatives sociales et solidaires à coté de chez 
                        lui, les artisans/entreprises qui fabriquent localement les produits qu'il achète... <br/><br/>
                        Bref reconnecter le virtuel et le réél, le Pixel et l'Humain.
                        </p>
                    </div>
                    <img class="pull-right" src="<?php echo Yii::app()->createUrl('images/logo/logo320.png')?>" alt="Logo Pixel Humain"/>
                    <script type="text/javascript">
                    initT['imgZoom'] = function(){
                    	TweenMax.staggerFromTo("#logoBanner", 3, {scaleX:0, scaleY:0}, {scaleX:1, scaleY:1},1);
                    };
                    </script>
                </div>
                
                <div class="item p40">
                    <h2>Sur les épaules des géants!</h2> 
                    <div id="gallery" class="pull-right" data-toggle="modal-gallery" data-target="#modal-gallery" data-selector="a.gallery-item">
                        <div style="margin-bottom:10px;">
                        <a class="gallery-item " href="images/AFF_TYPO.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO2.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO2.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO3.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO3.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO4.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO4.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO5.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO5.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO6.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO6.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO7.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO7.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO8.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO8.jpg')?>" width="100"/></a>
                        </div>
                        <a class="gallery-item " href="images/AFF_TYPO9.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO9.jpg')?>" width="100"/></a>
                        <a class="gallery-item " href="images/AFF_TYPO10.jpg" ><img src="<?php echo Yii::app()->createUrl('images/AFF_TYPO10.jpg')?>" width="100"/></a>
                    </div>
                </div>
              </div>
              
    		  <div class="pull-left">
                  <a class="btn btn-primary btn-large homestead" href="http://blog.pixelhumain.com/" target="_blank"> BLOG </a>
                  <a class="btn btn-primary btn-large homestead " href="http://groups.diigo.com/group/pixelhumain" target="_blank">Recherche & Developpement</a>
                  <a  href="https://www.facebook.com/groups/pixelhumain/" target="_blank"><img src="<?php echo Yii::app()->createUrl('images/fb.jpg')?>" style="vertical-align:middle" /></a>  
                  <a class="btn btn-primary btn-large homestead" href="https://trello.com/board/pixel-humain-echolocal/50a3e15a175358d65a0089ef" target="_blank">Plan d'action </a>
              </div>
                
    		<div id="dd" class="wrapper-dropdown-3 pull-right" tabindex="1">
    		    <span>Répondez au questionnaire</span>
    		    <ul class="dropdown">
    		        <li><a href="https://docs.google.com/forms/d/1XVClEfW-GzL1jRL1NL85Rd_ivdI-ZQtjkDQVp9og5NU/viewform" target="_blank">Pour les Citoyens</a></li>
    		        <li><a href="https://docs.google.com/forms/d/1lMTk80WAbv-AHtx5ZmEY1USAawzmJa87IEDvLIo-S0M/viewform" target="_blank">Pour les Collectivités</a></li>
    		        <li><a href="https://docs.google.com/forms/d/1DML6pRB5sialnkQwd_uxqW52efEhP1uJwdpk6bNCvEM/viewform" target="_blank">Pour les Associations</a></li>
    				<li><a href="https://docs.google.com/forms/d/1HWrloARNDlIfiI0XpdoogYDBxZwZm3O2FtTbc-Sfx0s/viewform" target="_blank">Pour les Entreprises</a></li>
    		    </ul>
    		</div>
    		<div class="clear"></div>
        </div>
        
        
        
    </div>
    
    <div class="hero-unit">
        <div class="accordion" id="accordion2">
            
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle fsxl fb" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Le pixel Humain, c'est quoi ? 1 min pour tout savoir ! 
              </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse ">
              <div class="accordion-inner">
                <p>
                Une plateforme de communication entre citoyens qui appartient aux citoyens, 
                avec une approche serieuse, ouverte, collaborative avec les pouvoirs publiques.<br/>
                Parce qu'on aimerait participer un peu plus dans notre ville, et que tous ensemble, nous ne faisons qu'un.<br/>
                <br/>
                Concrètement :<br/> 
                Nous aimerions améliorer l'image de la ville, lui donner un visage humain<br/>
                En appliquant le système des réseaux sociaux du web à la collectivité<br/>
                Pour une ville aussi connectée que Facebook et aussi ouverte que Wikipedia<br/>
                Pour une réflexion publique et une intelligence collective<br/>
                <br/>
                Repenser la ville via la participation citoyenne et la transparence<br/>
                Offrir une Boite à idée : un Système décisionnel ouvert, participatif et démocratique <br/>
                Proposer un Annuaire interactif des compétences locales pour particuliers et professionnels<br/>
                </p>
                <blockquote >
                <h3 class="text-info">Le Pixel Humain</h3>
                <p>La société au pixel prêt sur Une Terre Net</p>
                <p>Une intelligence collective & collaborative </p>
                <p>L’Innovation au service de la société.</p>
                <p class="text-info">“Venez mettre votre grain d’Xel ! ”</p>
                </blockquote>
                <a class="btn btn-primary btn-large pull-right">En Savoir Plus <i class="icon-forward icon-white"></i></a>
              </div>
            </div>
          </div>
          
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle fsxl fb" data-toggle="collapse" data-parent="#accordion2" href="#objectif">
                Les Objectifs de la version 0.1
              </a>
              
            </div>
            <div id="objectif" class="accordion-body collapse">
              <div class="accordion-inner">
                <p>La Version 0.1 comportera :</p>
                <ul>
                    <li><span class="text-info">V0.1 du réseau citoyen par ville représentée </span>
                    <ul>
                        <li>Inscription ouverte au réseau</li>
                        <li>Inscription par parrainage + système de validation </li>
                    </ul>
                    </li>
                    
                    <li><span  class="text-info">V0.1 du système de feedback Citoyen : action, discussion, boite à idée</span>
                    <ul>
                        <li>Un design élégant, sobre, ergonomique et Ludique</li>
                        <li>Démarrer une discussion locale = partager une idée = appeler à agir</li>
                        <li>Commenter une idée</li>
                        <li>Voter "Pour", Rester "neutre", Voter "Contre"</li>
                        <li>Forker = Cloner et modifier une idée</li>
                        <li>Optimisation du fil de discussion pour faciliter l'entrée dans les discussions et valoriser le contenu important</li>
                    </ul>
                    </li>
                    
                    <li><span  class="text-info" >V0.1 Portail Global du Pixel Humain</span>
                    <ul>
                        <li>Interface publique et interactive citoyenne</li>
                        <li>Interface par commune + vue départementale</li>
                    </ul>
                    </li>
                    
                    <li><span  class="text-info" >V0.1 mon Pixel Humain</span>
                    <ul>
                        <li>Le citoyen a son réseau à lui (réseau, discussion...) </li>
                        <li>Inscription par parrainage + system de validation </li>
                    </ul>
                    </li>
                    
                    <li><span  class="text-info" >V0.1 Admin / Gestion Mairie</span>
                    <ul>
                        <li>Outils simple et standard pour toutes les mairies : possibilité de remplir de remplir les informations concernant leur hiérarchie, les interlocuteurs, le listing des contacts par domaine, les actions disponibles...  </li>
                        <li>Inscription par parrainage + système de validation </li>
                        <li>Outil de communication : Entrant (incident, demande de travaux ...), Sortant (évènements, travaux, coupures d'électricité, élections...) </li>
                    </ul>
                    </li>
                    
                    <li><span  class="text-info" >V0.1 Admin/Gestion Pixel Humain</span>
                    <ul>
                        <li>Modération</li>
                        <li>Gestion des fonctionalités, retour de bug</li>
                        <li>Statistiques</li>
                        <li>Politique pour choisir les modérateurs ???</li>
                    </ul>
                    </li>
                </ul>
                
                <p class="text-info">Boite à idée et "Wishlist"  :</p>
                <ul>
                    <li>Annuaire</li>
                    <li>Activité</li>
                    <li>Proposition de projet</li>
                    <li>Boite a outil citoyen(covoiturage, petites annonces)</li>
                    <li>Standardiser la structure d'une mairie, dupliquer les infos si elles existent</li>
                    <li>Boite a outil mairie(Back Office)</li>
                    <li>Interface thématique</li>
                    <li>Gamification ou Score Citoyen</li>
                    <li>PH privé interne pour Entreprise par exmeple</li>
                    <li>Base de connaissance et transmission Permaculture et AgroECologie</li>
        
                </ul>
              </div>
            </div>
          </div>
          
          <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle fsxl fb" data-toggle="collapse" data-parent="#accordion2" href="#reseauTab">
                    Le Réseau a déja commencé ! <font class="fsxs">(L'application réseau arrive très prochainement !)</font>
                  </a>
                </div>
                <div id="reseauTab" class="accordion-body collapse">
                  <div class="accordion-inner">
                    <p>On <span class="text-info">construit cette plateforme de façon participative</span>. 
                    <br/>Comment construire ? Sans les citoyens ca ne marchera pas : Plus on est à réfléchir, mieux ce sera.
                    <br/>Le Pixel Humain ne se fera pas tout seul, Vous pouvez contribuer à toutes les etapes du projet !</p>
                    
                    <script type="text/template" id="users-collection-template">
                                <ul  class="unstyled">
                                  <% _.each(users, function(user) { %>
                                    <li class="pull-left"><img src="<?php echo Yii::app()->createUrl('<%= user.avatar %>')?>"  width="70px" height="70px"  title="<%= user.name %> - <%= user.email %>" alt=""/> </li>
                                  <% }); %>
                                </ul>
                            </script>
                    <div id='users-collection-container'></div>
                    
                    <div class="space20">&nbsp;</div>
                    </div>
                </div>
            </div>
            
          
          
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle fsxl fb" data-toggle="collapse" data-parent="#accordion2" href="#financement">
                Le Financement Citoyen 
              </a>
              
            </div>
            <div id="financement" class="accordion-body collapse">
              <div class="accordion-inner">
                <p>Nous avons plusieurs pistes pour rendre ce projet viable et pérenne : </p>
                
                <p>1. C'est un projet d'intérêt général, public et social, donc les collectivités auraient tout intérêt à participer financièrement. 
                <br/>C'est pour cela que nous avons déjà rencontré la mairie de la capitale de la Région Réunion (Saint-Denis) qui est emballé mais ne peut pas faire de mécénat. 
                <br/>Donc ils attendent de nous un prototype.</p>
                
                <p>2. Nous avons rencontré et présenté le projet à la Région (Vincent Payet) qui a parfaitement cerné le potentiel communiquant et collaboratif du projet. 
                <br/>Nous attendons un retour de leur part</p>
                
                <p>3. Le Financement Citoyen : c'est là qu'on peut tous participer et au moindre coût, car toute donation à un projet associatif, non lucratif et d'intérêt général
                est <span  class="text-info">directement déductible des impôts à hauteur de 66% du montant des sommes versées</span> dans la limite de 20 % du revenu imposable. 
                C'est quand même plus agréable de choisir où l'on applique nos impôts, non ? 
                <br/>Par exemple : avec un revenu imposable de 20 000 € vous pouvez verser au maximum  4 000 € ( soit 20% de 20000 ) et vous pouvez déduire de vos impôts la somme de 2 640 € ( soit 66% de 4000).
                <br/>Pour bénéficier de cette réduction d'impôt, l'association Open Atlas (Association à but non lucratif et d'intérêt général) fournira un reçu, indiquant le montant du don effectué. C'est ce reçu qu'il vous faudra joindre à votre déclaration de revenus.
                 <a href="http://www.legifrance.gouv.fr/affichCode.do?idSectionTA=LEGISCTA000006191957&cidTexte=LEGITEXT000006069577&dateTexte=vig" target="_blank">Texte de loi officiel<i class="icon-forward icon-white"></i></a></p>
                <div class="center">
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="XXL3LLR353Q4L">
                    <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>
              </div>
            </div>
          </div>
          
          
          
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle fsxl fb" data-toggle="collapse" data-parent="#accordion2" href="#partenaire">
                Partenariats & Soutiens 
              </a>
              
            </div>
            <div id="partenaire" class="accordion-body collapse">
              <div class="accordion-inner">
                <p>Nous attendons des réponses de soutien de certains Pouvoirs publics. 
                Pour le moment on part sur un auto-financement et du bénévolat, mais on compte sur la lucidité générale pour 
                pérenniser et viabiliser le projet. 
                </p>
                
                <h2>Bénévoles Actifs</h2>
                <a href="http://oceatoon.org" target="_blank"><img src="<?php echo Yii::app()->createUrl('images/oceatoon.png')?>" /></a>
                <a href="oceatoon.org" target="_blank"><img src="<?php echo Yii::app()->createUrl('images/StephLorente.jpg')?>" width="90" ></a>
                <a href="oceatoon.org" target="_blank"><img src="<?php echo Yii::app()->createUrl('images/JeremyLoreau.jpg')?>" width="110"></a>
                <a href="http://www.dittongraph.com/#showreel.html" target="_blank"><img src="<?php echo Yii::app()->createUrl('images/dittongraph.jpg')?>" width="110"></a>
                
                <div class="pull-left">
                    Sylvain Barbot
                    <br/>Jerome Gonthier
                    <br/>Kevin Lainé
                    <br/>Pierre Yves Fonteix
                </div>
                
                <div class="pull-left p10">
                    Tibor Katelbach
                    <br/>Stéphanie Lorent
                    <br/>Jermy Loreau
                </div>
                
                <div class="clear"></div>
                <h2>Bénévoles Mentors</h2>
                <div class="pull-left p10">
                    Pierre Magnin
                    <br/>Jerome Malet
                    <br/>Loic Damey
                    <br/>Remi Palard
                    <br/>Luc Bonnin
                </div>
                
                <div class="clear"></div>
                <h2>Partenaire et Soutien</h2>
                <div class="pull-left p10">
                    Démocratie Ouverte
                    <br/>Parlement et Citoyen
                    <br/>Association Unit & Métis (représente 70 associations Réunionaises)
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <blockquote>
            <p>Vous avez des idées ? Vous avez des envies ? N'hésitez plus : Partagez-les ! ... ou elles seront perdues (--Gandhi). 
            <br/>Vous voulez participez ? Rien de plus facile : vous êtes déjà un Pixel Humain ! 
            <br/>Pour devenir un Pixel Humain, il suffit en effet de vous faire connaître, <a href="mailto:contact@pixelhumain.com">en nous envoyant un email</a> !
            <br/>Parce que plus nous serons nombreux, plus nous irons vite !</p>
        </blockquote>
        
        
        <div class="center" id="infographic"> 
            <img src="<?php echo Yii::app()->createUrl('images/infographicPH.jpg')?>"/>
        </div>
    </div>
    
    <div class="hero-unit center">
        <img src="<?php echo Yii::app()->createUrl('images/gandhi.jpg')?>" class="img-rounded" alt="Soyez le changement que vous voulez voir dans le monde. (--Mahatma Gandhi)"/>
        </div>
    
</div> <!-- /container -->

