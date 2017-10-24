Pixel Humain
===========

## Requierement
Php version : 5.4.X (minimum)
MongoDB : 2.6.X (tested version - minimum)
Mongo Driver : 1.4.5 (tested version - minimum)


##Installation
####Configure your php
Verify your php configuration is right done lauching the command line
```
php --ini
```
The php.ini specified in the "Loaded Configuration File" option should be the right one.
Check in this php.ini file the openssl extension is activated.

####must install a Php webserver
Choose your favorite webserver (apache) or package (easyPhp, Wamp...)
Edit the httpd.conf file and activate the line
```
LoadModule rewrite_module modules/mod_rewrite.so
```

# On Unix like OS : Linux Ubuntu, Debian  :
* [Step by step install CO2 on Ubuntu 16.04](https://wiki.communecter.org/en/installing-communect-on-ubuntu-16.04.html)
* [special for Debian Automated install script (not updated for CO2)](https://github.com/tech62/pixelhumain/blob/e574fa0a533d3d994960b2abc5ebfb38a7292ab4/installdebian.sh)

## Otherwise 
 * Same rules as windows but choose a .so driver instead of a dll one.
 * [Here's a good doc](http://tech.enekochan.com/2013/10/22/install-mongodb-in-ubuntu-12-04/)
 * [manuel d'installation officiel PHP](http://www.php.net/manual/fr/mongo.installation.php)

# On Windows OS :
* Get the dll from here https://s3.amazonaws.com/drivers.mongodb.org/php/index.html
* Download the 1.4.5 mongo driver version (php_mongo-1.4.5.zip)
* Extract the zip file.
* The right version driver depends on the version of php you're running with.
Saying 5.X is your php version, choose the file :
```
if (X<5)
 php_mongo-1.4.5-5.X-vc9.dll
else
 php_mongo-1.4.5-5.X-vc11.dll
```
 * Important : if you'are running with a 64bits platform choose the file with 'x86_64' in it.
 * Copy the dll file in your directory : %php_dir%/ext
 * In the php.ini add (the name of the dll file depends on your php install version) :
```
for php 5.5
extension=php_mongo-1.4.5-5.5-vc11.dll
or
for php 5.3
extension=php_mongo-1.4.1-5.3-vc9.dll
```

# On Mac
If you are on mac OSX, read this readme first :
[Specific readme_macOS.md for Mac OSX](https://github.com/pixelhumain/pixelhumain/blob/master/README_macOs.md/)

####install a mongo Database instance and admin tool
- [Mongo installation](http://docs.mongodb.org/manual/installation/)
- [Mongo administration-interfaces](http://docs.mongodb.org/ecosystem/tools/administration-interfaces/)
- [many of us use ROBOMONGO](http://robomongo.org/)
- launch Mongo localy :
```
mongod --dbpath data/db
```
- inside your favorite mongo administration tool :
- create a database called pixelhumain
- create a user for the db : pixelhumain
- you can do this the simple mongo
 - use pixelhumain
 - db.addUser( "pixelhumain","pixelhumain" )

####Composer installation
PixelHumain is set with composer in order to manage dependencies and libraries.
- [Clone](https://github.com/pixelhumain/pixelhumain) the repository in order to recover the files
- If you don't have it get the composer (https://getcomposer.org/)
- Create the file /ph/protected/config/dbconfig.php with your database name and URL. 
```
$dbconfig = array(
    'class' => 'mongoYii.EMongoClient',
    'server' => 'mongodb://127.0.0.1:27017/',
    'db' => 'pixelhumain',
);
```
You can find an example of dbconfig in the file /ph/protected/config/dbconfig.example.php
- Launch following commands to initiate the application :
in
cd path/to/pixelhumain/ph
where you'll find composer.json
```
composer update
...
composer install
```

####Add the module citizenToolKit

To launch the application, you need to install the module citizenToolKit. See below to see how to install modules.

####Launch the application
- Launch you http webserver
- depending on how you webservers alias is configured here the alias is called ''ph'' and pointing to the folder you cloned test this url :
http://localhost:8080/ph/index.php/test

- All the first line should be green.

right now you can access the application like 127.0.0.1/ph/index.php/anyModule
to remove the index.php you'll need to configure your http.conf like this
```
Alias "/ph" "pathToProjectFolder/pixelhumain/ph"
<Directory "pathToProjectFolder/pixelhumain/ph">
Options FollowSymLinks Indexes
AllowOverride none
Order deny,allow
Allow from 127.0.0.1
deny from all
<IfModule mod_rewrite.c>
Options +FollowSymLinks
IndexIgnore */*
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond $1 !^(index\.php|assets|robots\.txt)
RewriteRule ^(.*)$ /ph/index.php/$1 [L]
</IfModule>
</Directory>
```

####Adding a Module
- at the same level of the /pixelhumain folder , create a folder called /modules
```
/pixelhumain
 /ph
 /doc ...
/modules
```
- cd modules
- git clone "any of the modules". Currently maintained modules are:
  *  https://github.com/pixelhumain/communecter
  *  https://github.com/pixelhumain/citizenToolKit
  *  https://github.com/pixelhumain/opendata
  *  https://github.com/pixelhumain/api
  
- front end URL : 127.0.0.1/ph/communecter
- api URL : 127.0.0.1/ph/communecter/api
- if any there's any initData to be installed you'll see the prompt
- sometimes you'll need to initData to install test Data sets

## Init Data Base

Change to the folder modules/communecter/data is run the following commands:
 - mongoimport --db pixelhumain --collection cities cities.json --jsonArray;
 - mongoimport --db pixelhumain --collection lists lists.json --jsonArray ;


YOU SUCCEED ! READY TO CODE NOW !

####Understanding the structure and Yii
Now you can follow urls to understand and dive into the code, which is a fairly standard and simple MVC
ex : 127.0.0.1/ph/communecter/person/profile
- "communecter" is the module
- "person" is the controller file called PersonController.php
- "profile" is the action foun called actionProfile found in the above controller file


### Valuing States Structure
* page region  : List all Counties with minimal descritption
* city page : List local actors(directory), local Places
* people page :

##Roadmap short term
* add a person/citizen
* add and Association, Company
* add a State entity (city, county...)

##Document before coding
Make a good habit of writing a doc or a doc corrected before embarking in the code.
This avoids a tedious task of writing a doc after hit.

##More info
* [Specific readme.md for Mac OSX](https://github.com/pixelhumain/pixelhumain/blob/master/README_macOs.md/)
* [le site](http://www.pixelhumain.com/)
* [le blog](http://blog.pixelhumain.com/)
* [group Facebook](https://www.facebook.com/groups/pixelhumain/)


<br/>
<br/>

---

<br/>
<br/>


Help keep this project alive
===========
contribute or Join the NGO on [Hello Asso](https://www.helloasso.com/associations/open-atlas/adhesions/soutenez-et-adherez-a-open-atlas)

##Version 0.002
    L'homme qui déplace une montagne commence par déplacer les petites pierres.- Confucius
    Man who wants to move a mountain starts by moving pebbles
