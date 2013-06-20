<?php 
try
{
    $connection = new Mongo($dbconfig['connectionString']);
}
catch(MongoConnectionException $e)
{
    die("Failed to connect to database ".$e->getMessage());
}
?>