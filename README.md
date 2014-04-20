Pixel Humain
===========

##Installation
####Configure your php
Verify your php configuration is right done lauching the command line
```
php --ini
```
The php.ini specified in the "Loaded Configuration File" option should be the right one.
Check in this php.ini file the openssl extension is activated.
####must install a Php webserver
- On Windows OS : 
Get the dll from here https://s3.amazonaws.com/drivers.mongodb.org/php/index.html
The right version driver depends on the version of php you're running with.
In the php.ini add (depends on your php install version) : 
```
extension=extension=php_mongo-1.4.5-5.5-vc11.dll
```
- On Unix like OS : 
Same as windows but choose a .so driver instead of a dll one.
[Here's a good doc](http://tech.enekochan.com/2013/10/22/install-mongodb-in-ubuntu-12-04/)


####install a mongo Database instance and admin tool
- [Mongo installation](http://docs.mongodb.org/manual/installation/)
- [Mongo administration-interfaces](http://docs.mongodb.org/ecosystem/tools/administration-interfaces/)
- launch Mongo localy : 
```
mongod --dbpath data\db
```
- create a database called pixelhumain : use pixelhumain

####Composer installation
PixelHumain is set with composer in order to manage dependencies and libraries.
- Clone the repository in order to recover the files
- If you don't have it get the composer (https://getcomposer.org/)
- Modify the file /ph/protected/config/dbconfig.php with your database name and URL
```
$dbconfig = array(
    'class' => 'mongoYii.EMongoClient',
    'server' => 'mongodb://127.0.0.1:27017/',
    'db' => 'pixelhumain',    
);
```
- Launch following commands to initiate the application : 
```
composer update
...
composer install
```

####Launch the application
- Launch you http webserver
- depending on how you webservers alias is configured here the alias is called ''ph'' and pointing to the folder you cloned test this url : 
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
