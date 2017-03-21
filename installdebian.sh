#!/bin/sh
#Please make this script executable (chmod +x installdebian.sh) and run as root.
#Veuillez rendre ce script executable et l'executer avec l'utilisateur root.


#Ajout du dépôt - Adding repository in apt to /etc/sources.list.d/
apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6
echo "deb http://repo.mongodb.com/apt/debian jessie/mongodb-enterprise/3.4 main" | tee /etc/apt/sources.list.d/mongodb-enterprise.list

apt-get update
apt-get install mongodb-org php5-mongo -y

#Création du dossier accueillant communecte et ses modules
#Making folder web who hosting communecte and his modules
mkdir /var/www/web && mkdir /var/www/web/modules && cd /var/www/web

#Clonage des dépôts
#Cloning git repo
git clone https://github.com/pixelhumain/pixelhumain
cd pixelhumain/ph

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer.phar update
php composer.phar install
cd ../../

cd modules
git clone https://github.com/pixelhumain/citizenToolKit
git clone https://github.com/pixelhumain/communecter
git clone https://github.com/pixelhumain/network
git clone https://github.com/pixelhumain/api
git clone https://github.com/pixelhumain/cityData
cd ../

#Making all files availables from www-data
#Attribution des droits www-data sur tous les dossiers
chown -R www-data:www-data *

#Rename the dbconfig file
#Renommage du fichier de configuration de la bae de donnée
mv pixelhumain/ph/protected/config/dbconfig.example.php pixelhumain/ph/protected/config/dbconfig.php 

echo "<VirtualHost 127.0.0.1:80>

	# The ServerName directive sets the request scheme, hostname and port that

	# the server uses to identify itself. This is used when creating

	# redirection URLs. In the context of virtual hosts, the ServerName

	# specifies what hostname must appear in the request's Host: header to

	# match this virtual host. For the default virtual host (this file) this

	# value is not decisive as it is used as a last resort host regardless.

	# However, you must set it for any further virtual host explicitly.

	#ServerName www.example.com

	ServerName communecter.local

	ServerAdmin webmaster@localhost

	DocumentRoot /var/www/web/pixelhumain/ph



	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn,

	# error, crit, alert, emerg.

	# It is also possible to configure the loglevel for particular

	# modules, e.g.

	#LogLevel info ssl:warn



	ErrorLog ${APACHE_LOG_DIR}/error.log

	CustomLog ${APACHE_LOG_DIR}/access.log combined



	# For most configuration files from conf-available/, which are

	# enabled or disabled at a global level, it is possible to

	# include a line for only one particular virtual host. For example the

	# following line enables the CGI configuration for this host only

	# after it has been globally disabled with "a2disconf".

	#Include conf-available/serve-cgi-bin.conf





Alias "/ph" "/var/www/web/pixelhumain/ph"

<Directory "/var/www/web/pixelhumain/ph">

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



Alias "/src" "/usr/share/squirrelmail"

<Directory "/usr/share/squirrelmail">

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







</VirtualHost>" > /etc/apache2/sites-available/communecter.conf

a2ensite communecter && service apache2 reload

echo "ne pas oublier de lancer mongod !"
echo "Communecte est maintenant disponible depuis http://127.0.0.1/ph/"
echo "Communecte is now available : http://127.0.0.1/ph"
echo "N oubliez pas de modifier le fichier ph/protected/config/paramsconfig.php avec vos parametres SMTP et de vous rendre sur http://127.0.0.1/communecter/test/docron pour lancer le processus d envoi de mail"
echo "don't forget to use this url to start the mail cron http://127.0.0.1/communecter/test/docron"

mongod --dbpath "~/communecte/data/db"

#Making the Data folder for MongoDB
#Création du dossier accueillant la base de données
mkdir data/
mkdir data/db

echo "db.createUser({     user: "pixelhumain",     pwd: "pixelhumain",     roles: [{role:"readWrite", db:"pixelhumain"}]})" > adduserpixelhumaindb.js                                                   
mongo pixelhumain adduserpixelhumaindb.js
rm adduserpixelhumaindb.js

cd modules/communecter/data
mongoimport --db pixelhumain --collection cities cities.json --jsonArray;
mongoimport --db pixelhumain --collection lists lists.json --jsonArray ;
cd ../
