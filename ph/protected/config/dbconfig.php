<?php
$dbconfig = array(
    'class' => 'mongoYii.EMongoClient',
    'server' => 'mongodb://127.0.0.1:27017/',
    'db' => 'pixelhumain',
    
);
$mysqldbconfig = array(
    //Mysql
    'db.name' => 'phyii',
    'db.connectionString' => 'mysql:host=localhost;dbname=phyii',
    'db.username' => 'root',
    'db.password' => '',
);
// DB connection configurations
/*'db.name' => 'phyii',
'db.connectionString' => 'mysql:host=localhost;dbname=phyii',
'db.username' => 'root',
'db.password' => '',*/

//
//	// test database {
//	'testdb.name' => '',
//	'testdb.connectionString' => 'mysql:host={DATABASE-HOST};dbname={DATABASE-NAME}_test',
//	'testdb.username' => '{DATABASE-USERNAME}',
//	'testdb.password' => '{DATABASE-PASSWORD}',