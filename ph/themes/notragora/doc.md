# Notragora 

description de de l'archi et spécificité Notragora
- Listing de productio video
- Listing de groupe de travail 
- ajouter des nouvelles productions (POI)
- ajouter des organisations 
- design personnalisé
- partage le code source avec CO

## Priorité

## Bugs

[ ] Souci avec le bouton d'édition des vidéos : mouline mais ne s'ouvre pas : http://pix.toile-libre.org/upload/original/1485883309.png
[ ] Par défaut en arrivant, la cartographie n'affiche aucunes vidéos
[ ] Dans un groupe de travail, la page "production" affiche une production sans image et avec une erreur si l'on clique dessus : http://pix.toile-libre.org/upload/original/1485940143.png
[ ] Pas possible d'éditer les données des groupes de travail et des productions
[ ] Le bouton plein écran ne fonctionne pas sur certaines vidéos
[ ] ajouter la gestion du sourcekey pour mettre notragora sur CO.DB

## Amélioration

## Techniquement 

## Theme Personnalisé

- pixelhumain/ph/theme/notragora
- architecture classique CO en mode one page
- mainSearch contient tous les elements spécifiques 
- themeObj contient un init spécifique au theme et des variable utilisable sous condition dans les view de CO
- 1er appel vers default.home personnalisé theme/views/default/home.php
- default.apropos est aussi personnalisé theme/views/default/apropos.php

## Process spécification
### Architesture 
	- menuLeft 
		- collections and genres are generated in mainSearch

### Urls
* [home page /default/home](http://127.0.0.1/ph/communecter/default/home)
	* co / controllers/ DefaultController
	* theme/views/default/home.php
		* uses jqcloud.min.js
		* uses var poiListTags = <?php echo json_encode($tagsPoiList) ?>;
* [directory groupe de travail : /default/directoryjs](http://127.0.0.1/ph/communecter/default/directoryjs?type=projects)
* [directory des productions : /default/directoryjs](http://127.0.0.1/ph/communecter/default/directoryjs?type=poi)
* [detail : /element/detail/type/citoyens](http://127.0.0.1/ph/communecter/element/detail/type/citoyens/id/585bdfdaf6ca47b6118b4583)
	* est CO/views/element/notragora/detail.php
* [creating a production]() as POIs
	- genres and collections are definied specificaly and added to the poi dynform in the themeObj.init 
	- added to the tags attribute in elementLib.formData and removed

