<?php
/*
Contains anything generix for the site 
 */
class PH
{
    
    public static function buildMenuChildren( $collection )
    {
        $menu = array();
        $cols = PHDB::find( $collection);
        foreach ($cols as$e) {
            array_push( $menu , array( "label"=>$e["name"],"href"=>Yii::app()->createUrl("/".$e["key"] ) ) );
        }
        return $menu;
    }
    public static function notlocalServer(){
    	return (stripos($_SERVER['SERVER_NAME'], "127.0.0.1") === false && stripos($_SERVER['SERVER_NAME'], "localhost:8080") === false );
    }
}