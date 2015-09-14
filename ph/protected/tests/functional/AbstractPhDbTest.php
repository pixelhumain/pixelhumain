<?php
require_once 'Phactory/lib/PhactoryMongo.php';

abstract class PixelHumain_Tests_DatabaseTestCase extends PHPUnit_Framework_TestCase
{
     public static function setUpBeforeClass()
    {
        // create a db connection and tell Phactory to use it
        $mongo = new Mongo();
        Phactory::setConnection($mongo->test_db);
 
        // reset any existing blueprints and empty any tables Phactory has used
        Phactory::reset();
    }

    public function tearDown()
    {
        Phactory::recall();
    }

}
?>