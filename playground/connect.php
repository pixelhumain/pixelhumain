<?php 
try
{
    $connection = new MongoClient($dbconfig['connectionString']);
}
catch(MongoConnectionException $e)
{
    die("Failed to connect to database ".$e->getMessage());
}
?>