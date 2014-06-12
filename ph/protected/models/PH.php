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
    
}