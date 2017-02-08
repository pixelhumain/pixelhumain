* Notragora 

description de de l'archi et spécificité Notragora
- Listing de productio video
- Listing de groupe de travail 
- ajouter des nouvelles productions (POI)
- ajouter des organisations 
- design personnalisé
- partage le code source avec CO

** Priorité

** Bugs

[ ] Souci avec le bouton d'édition des vidéos : mouline mais ne s'ouvre pas : http://pix.toile-libre.org/upload/original/1485883309.png
[ ] Par défaut en arrivant, la cartographie n'affiche aucunes vidéos
[ ] Dans un groupe de travail, la page "production" affiche une production sans image et avec une erreur si l'on clique dessus : http://pix.toile-libre.org/upload/original/1485940143.png
[ ] Pas possible d'éditer les données des groupes de travail et des productions
[ ] Le bouton plein écran ne fonctionne pas sur certaines vidéos
[ ] ajouter la gestion du sourcekey pour mettre notragora sur CO.DB

** Amélioration

** Techniquement 

** Theme Personnalisé

- pixelhumain/ph/theme/notragora
- architecture classique CO en mode one page
- mainSearch contient tous les elements spécifiques 
- 1er appel vers #default.home personnalisé theme/views/default/home.php
- #default.apropos est aussi personnalisé theme/views/default/apropos.php

** Process spécification
*** Architesture 
	- menuLeft 
		- collections and genres are generated in mainSearch
*** Urls
- [home page](http://127.0.0.1/ph/communecter/default/home)
	co / controllers/ DefaultController
	theme/views/default/home.php
		uses jqcloud.min.js
		uses var poiListTags = <?php echo json_encode($tagsPoiList) ?>;
- [directory groupe de travail](http://127.0.0.1/ph/communecter/default/directoryjs?type=projects)
- [directory des productions ](http://127.0.0.1/ph/communecter/default/directoryjs?type=poi)