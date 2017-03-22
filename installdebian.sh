#!/bin/sh
#Please make this script executable (chmod +x installdebian.sh) and run as root.
#Veuillez rendre ce script executable et l'executer avec l'utilisateur root.

#Ajout du dépôt - Adding repository in apt to /etc/sources.list.d/
apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6
echo "deb http://repo.mongodb.org/apt/debian jessie/mongodb-org/3.4 main" | tee /etc/apt/sources.list.d/mongodb-org-3.4.list

apt-get update
apt-get install apache2 libapache2-mod-php5 php5 php5-common php5-dev php5-intl php5-gd php5-json git unzip mongodb-org php5-mongo curl screen -y

#Création du dossier accueillant communecte et ses modules
#Making folder web who hosting communecte and his modules
mkdir /var/www/web && mkdir /var/www/web/modules && cd /var/www/web

#Clonage des dépôts
#Cloning git repo
git clone https://github.com/pixelhumain/pixelhumain
cd pixelhumain/ph

#Téléchargement de Composer
#Downloading Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

#Mise à jour des composants
#Updating components
php composer.phar update
php composer.phar install
cd ../../

cd /var/www/web/modules
git clone https://github.com/pixelhumain/citizenToolKit
git clone https://github.com/pixelhumain/communecter
git clone https://github.com/pixelhumain/network
git clone https://github.com/pixelhumain/api
git clone https://github.com/pixelhumain/opendata
git clone https://github.com/pixelhumain/cityData
cd ../

#Making all files availables from www-data
#Attribution des droits www-data sur tous les dossiers
chown -R www-data:www-data *

#Rename the dbconfig file
#Renommage du fichier de configuration de la bae de donnée
mv pixelhumain/ph/protected/config/dbconfig.example.php pixelhumain/ph/protected/config/dbconfig.php 

#Création du vhost communecter
#Making communected vhost apache file

echo "<VirtualHost 127.0.0.1:80>

	ServerName communecter.local
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/web/pixelhumain/ph

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

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
RewriteCond \$1\ !^(index\.php|assets|robots\.txt)
RewriteRule ^(.*)$ /ph/index.php/$1 [L]
</IfModule>

</Directory>

</VirtualHost>" > /etc/apache2/sites-available/communecter.conf

#Activation du vhost et rechargement du fichier de conf dans apache
#Vhost activation et apache config file reloading
a2ensite communecter && service apache2 reload

#Lancement de mongod (BDD de communecter sous mongoDB)
#Starting mongod (communecter Database Engine)
mongod --fork --dbpath "/var/www/web/data/db" --logpath /var/log/mongod.log

#Making the Data folder for MongoDB
#Création du dossier accueillant la base de données
mkdir data/
mkdir data/db

#Création du script d'ajout de l'utilisateur pixelhumain
#Making user adding script of pixelhumain user
echo "db.createUser({     user: "pixelhumain",     pwd: "pixelhumain",     roles: [{role:"readWrite", db:"pixelhumain"}]})" > adduserpixelhumaindb.js                                                   
mongo pixelhumain adduserpixelhumaindb.js

#Suppression du script après utilisation
#Deleting script after use
rm adduserpixelhumaindb.js

#Decompression du fichier contenant les villes
#Uncompressing file who contain the town data
cd /var/www/web/modules/communecter/data
unzip cities.json.zip

#Importation des données dans la base pixelhumain
#Importing data in pixelhumain database
mongoimport --db pixelhumain --collection cities cities.json --jsonArray;
mongoimport --db pixelhumain --collection lists lists.json --jsonArray ;
cd ../

#Ajout de la tache cron pour l'envoi des mails
#Adding sent mail job in cron
cron="*/10 * * * * curl http://127.0.0.1/communecter/test/docron"
(crontab -u root -l; echo "$cron" ) | crontab -u root -

#Redemarrage de cron
#Restarting cron
service cron restart

echo "Communecte est maintenant disponible depuis http://127.0.0.1/ph/"
echo "Communecte is now available : http://127.0.0.1/ph/"
echo "N oubliez pas de modifier le fichier ph/protected/config/paramsconfig.php avec vos parametres SMTP et de vous rendre sur http://127.0.0.1/communecter/test/docron pour lancer le processus d envoi de mail"
#echo "don't forget to use this url to start the mail cron http://127.0.0.1/communecter/test/docron"

#fin du script
#The END
