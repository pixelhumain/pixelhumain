Install Pixel Humain under Mac Os
=================================

This readme file is instended to explain to mac user how to clone pixelhumain git repo and install required packages

<br/>

##Installation of required packages

<br/>
### 1- Be sur to have "brew" installed
Brew will let you install easylly component and packages such as mongodb in one command line ;)

#### 1.1- Try "brew" on terminal. 
If not recognized, install it. If it's recognized, move to step 1.4

	brew

#### 1.2-Install brew running this command line from terminal


	ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"


#### 1.3- check brew is correctly installed on your system. 
To check if there is missing package run and if there is warning, read the warning and apply given related command line. Quite explicit and well written.

	brew doctor

#### 1.4- Be sure to be up to date

	brew update


<br/>

---

<br/>


### 2- Be sure to have composer installed. 
It will let you check package and lib dependencies for pixelhumain git repository

#### 2.1- Try "composer" or "composer.phar" on terminal. 
If not recognized, install it. If it's recognized, move to step 2.3

	composer.phar

#### 2.2- Run this command line to install composer

	curl -sS https://getcomposer.org/installer | php

#### 2.3- Now, "composer.phar" should be recognized as a valid command on terminal. Run update to be sure you have the last version

	composer.phar update
	composer.phar self-update



<br/>

---

<br/>


### 3- Be sure to have mongodb installed 
pixelhumain is using mongodb database system


	brew install mongodb --with-openssl


#### 3.1- Install a mongodb GUI to make life easier

[Many of us use ROBOMONGO](http://robomongo.org/)

#### 3.2- Install a mongodb pref pan GUI
To make life easier, install macos version of prefpane to let you easilly start/stop mongodb manually and/or on startup using a simple GUI.

[download github prefpane for macos](https://github.com/remysaissy/mongodb-macosx-prefspane)

The "app" will be reachable using macos>system prefences>mongoDB
Once prefpane is installed, be sure to start mongoDB

<br/>

---

<br/>

### 4- Be sure to have git command line installed on your mac

#### 4.1- Try "git" on terminal. 
If not recognized, install it. If it's recognized, skip this step 4

	git	


#### 4.2- Install github GUI for mac 
Install app and install commandline tools during installation process

[https://mac.github.com/](https://mac.github.com/)

<br/>

---

<br/>


### 5- Be sure to have a Php webserver well set up

#### 5.1- MAMP is a good choice

On mac, the must easiest way is to use MAMP (free version or pro version).
You will have a complete control over your php/apache/cache/lib/mysql database elements.
Some of us use the pro version to simplify alias and virtual host config.
Anyway, feel free to choose the apache/php/mysql version of your choice.

#### 5.2- Don't forget to map mongo with your apache

It could be the tricky part. mongo is not always easy to set up with apache as an extension (mongo.so). It depends on your php version, if you are using mamp or not,...
Some helpfull link on the net :

###### If you are lucky, cross your fingers and try

* Run this command in a terminal

```
sudo pecl install mongo
```

* Modify `php.ini` and add

```
extension=mongo.so
```	

* Restart apache

* Check your phpinfo(). `mongo` should be loaded


###### If you are using MAMP / MAMP PRO and you was not lucky


* Be sure to correctly set up php/pecl/pear
When using MAMP on OSX, you need to be sure php,pecl and pear used in terminal are those of MAMP, not those of the OSX system.

```
which pecl
which pear
which php
```
	
If it is not matching those of MAMP, modify your `.bash_profile` and add this line

	export PATH=/Applications/MAMP/bin/php/php5.4.34/bin:/Applications/MAMP/bin/php/php5.4.34/lib:$PATH

* Run this command line on your terminal

```
	sudo pecl install mongo
```
	
* `php.ini` modification on MAMP

If you are using MAMP PRO, use the Mamp Pro GUI, menu "File">"Modify template">"PHP">"PHP5.4.34" and add it to the template. Mamp Pro will override his php.ini at each apache restart.
If you are using MAMP or anything else, check where is the relevant php.ini loaded during apache restart.
	

###### If you're still unlucky, try manual lucky n°2 attempt : 

* [Download mongo.so already compiled](https://github.com/downloads/stennie/mongo-php-driver/mongo.so)

* Save it on your extension php folder. For MAMP it is something like 

	/Applications/MAMP/bin/php/php5.4.34/lib/php/extensions/no-debug-non-zts-20100525/ 



###### Else, try one of the link below (because each os system config is sometime tricky and specific) :

* [official installation guide from PHP if you get lucky](http://php.net/manual/fr/mongo.installation.php#mongo.installation.osx)

* [setting-up-mongodb-with-php-and-mamp](http://lukepeters.me/blog/setting-up-mongodb-with-php-and-mamp)

* [os-x-installing-mongodb-and-php-mongo-driver](http://technosophos.com/2010/01/30/os-x-installing-mongodb-and-php-mongo-driver.html)

If your apache is not running mongo extension, you will have mongodb connexion error on steps bellow (during composer stuff and/or yii app launch).
If so, you will need to be strong and find yourself how to install properly mongo on your damned osx system.



#### 5.4- Apache/php common config

These config must be set up :
* `.htaccess` has to be accepted by your apache config
* `mod_rewrite` has to be activated as apache extension (to be able to run with yiiframework and url rewriting)

<br/>
<br/>

---

<br/>
<br/>


## Retrieve pixelhumain repository locally
<br/>

#### 6.1- Go to a local folder of your choice where pixelhumain repo will be cloned. 

Use a folder reachable by your local apache server

	mkdir /YOUR_LOCAL_FOLDER_REACHABLE_BY_APACHE/pixelhumain


#### 6.2- Clone repository locally

Go to this webpage and click on `clone in desktop` button. it will open your github.app on mac and clone repository


[https://github.com/pixelhumain/pixelhumain](https://github.com/pixelhumain/pixelhumain/)


<br/>
<br/>

---

<br/>
<br/>


## Install database instance

Inside your favorite mongo administration tool (robomongo ?) : 

* connect to your localhost mongodb
* create a new databased called `pixelhumain` (from robomongo gui, right click on "new connection", then create tabase)
* create a user for the db : `pixelhumain` (from robomongo gui, under pixelhumain>users, right click, then "add user", then create `pixelhumainuser` )


<br/>
<br/>

---

<br/>
<br/>


## Modify specific localhost config

PixelHumain is using yii as based PHP framework.
To be able to run local instance of pixelhumain you need to create local folders (to not commit. Don't be afraid, it is already in ignore list) and customized config files

<br/>

### 1- Modify config file for database access
Create the file `.../ph/protected/config/dbconfig.php` with your database name and URL (if you customized database name and/or database system mongo/mysql...)


	$dbconfig = array(
   		'class' => 'mongoYii.EMongoClient',
   		'server' => 'mongodb://127.0.0.1:27017/',
    	'db' => 'pixelhumain',    
	);
You can find an example of dbconfig in the file /ph/protected/config/dbconfig.example.php

### 2- Create local cache folders

PixelHumain is using yii as based PHP framework.
To be able to run local instance of pixelhumain you need to create local folders.

* Create a new folder called `runtime` in the directory `.../pixelhumain/ph/protected/`
* Create a new folder called `assets` in the directory `.../pixelhumain/ph`

### 3- Initiate dependencies using composer

(use `composer` or `composer.phar` depending on the recognized command)
Step 2- (create local cache folders) HAS TO be completed before this step 3.
Launch following commands to initiate the application :
 
	cd path/to/pixelhumain/ph
	composer.phar update
	composer.phar install



<br/>
<br/>

---

<br/>
<br/>


## Launch the application ph

If you follow previous steps successfully you will be able soon to run ph web app.
Try to call 

[http://localhost/pixelhumain/ph](http://localhost/pixelhumain/ph)

To make your life easier, feel free to do like most of us : create a virtual host to be able to call `http://localhost/ph` or `http://local.ph.com`.

If it works, try to run this url. All lights should be green
[http://localhost/ph/test]([http://localhost/ph/test])



<br/>
<br/>

---

<br/>
<br/>


##Adding a Module
- at the same level of the `/pixelhumain` folder , create a folder called `/modules`

```
	/pixelhumain
		/ph		
		/doc ...		
	/modules
```	

- cd modules 
- git clone "any of the module" ex : https://github.com/pixelhumain/communecter
- front end URL : `localhost/pixelhumain/ph/communecter`
- api URL : `localhost/pixelhumain/ph/communecter/api`
- if any there's any initData to be installed you'll see the prompt 
- sometimes you'll need to initData to install test Data sets
YOU SUCCEED ! READY TO CODE NOW !




<br/>
<br/>

---

<br/>
<br/>


## More info

Read the readme.md master file to know details on required apache modules + other details on yii, modules...

[Master readme.md](https://github.com/pixelhumain/pixelhumain/blob/master/README.md/)




<br/>
<br/>

---

<br/>
<br/>



## Version 0.002 


    L'homme qui déplace une montagne commence par déplacer les petites pierres.- Confucius
    
    Man who wants to move a mountain starts by moving pebbles - Confucius
