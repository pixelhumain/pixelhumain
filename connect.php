<?php 
try
{
    $connection = new Mongoclient($dbconfig['connectionString']);
}
catch(MongoConnectionException $e)
{
    die("Failed to connect to database ".$e->getMessage());
}
?>