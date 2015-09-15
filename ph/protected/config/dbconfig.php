<?php
$dbconfig = array(
    'class' => 'mongoYii.EMongoClient',
    'server' => 'mongodb://127.0.0.1:27017/',
    'db' => 'azotliveDev', 
);

$dbconfigtest = array(
		'class' => 'mongoYii.EMongoClient',
		'server' => 'mongodb://127.0.0.1:27017/',
		'db' => 'pixelhumaintest',
);
$mysqldbconfig = array(
    //Mysql
    'db.name' => 'phyii',
    'db.connectionString' => 'mysql:host=localhost;dbname=phyii',
    'db.username' => 'root',
    'db.password' => '',
);
