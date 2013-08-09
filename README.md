Pixel Humain
===========

##Installation

####must install a Php webserver
in the php.ini add 
on windows
depends on your php install version
```
extension=php_mongo-1.4.1-5.3-vc9.dll
get the dll from here https://github.com/mongodb/mongo-php-driver/downloads
```
on mac  you'll have to simply get the .so that corresponds to your php install

####install a mongo Database instance and admin tool
- [Mongo installation](http://docs.mongodb.org/manual/installation/)
- [Mongo administration-interfaces](http://docs.mongodb.org/ecosystem/tools/administration-interfaces/)
- launch Mongo localy : mongod --dbpath data\db
- create a database called pixelhumain : use pixelhumain
- either mongorestore : mongorestore --dbpath /data/pixelhumain (path to the bson files)
- or mongoimport all the json files in the /data folder : mongoimport --db pixelhumain --collection pixelsactifs --file data/pixelsactifs.json --journal

####Git clone the repo 
depending on how you webservers alias is configured 
here the alias is called ''ph'' and pointing to the folder you cloned
test this url : 
http://127.0.0.1/ph/yii/frontend/www/index.php/decouvrir


##Version 0.001 

    L'homme qui déplace une montagne commence par déplacer les petites pierres.- Confucius

###Valorisation de la Collectivité
* page region : liste toutes les communes avec quelques details
* page commune : liste toutes les activités locales, les elements naturels, propose un annuaire local
* création Commune : définie par les infos wikipedia, des images, des activités, la natures 
* creation Pixel Actif : défini par son type, son contact, son action locale

##Roadmap court terme 
* Ajouter un Pixel Actif 
**Association, Entreprise, Collectivité, Citoyens
* Pouvoir ajouter une commune 
**Il ya un (ou plusieurs,plus tard) représentant de Commune (citoyen ou collectivité)

##Documenter avant de Coder
Prendre pour habitude d'écrire une doc ou corrigé une doc avant de se lancer dans le code.
Ce qui permet d'éviter a se taper la fastidieuse tache d'ecriture d'une doc aprés coup.
Ca permet aussi de tourner 7 fois autour de l'idée avant de perdre son temps a le coder.

##Proof of concept First
Une bonne facon de procéder pour proposer un nouveau module ou feature au PH, sans perdre de temps et aller droit au but 
c'est de commencer par une version la plus light possible, pure front end, basé sur une structure JSON. 
on peut ainsi en discuter, la modifier avant de l'intégrer dans le coeur applicatif.

##En savoir plus
* [documentation technique](https://github.com/pixelhumain/pixelhumain/blob/master/doc/presentation.md)
* [Gestin de projet : Trello](https://trello.com/board/pixel-humain-echolocal/50a3e15a175358d65a0089ef)
* [le site](http://www.pixelhumain.com/)
* [le blog](http://blog.pixelhumain.com/)
* [group Facebook](https://www.facebook.com/groups/pixelhumain/)
