<?php

class PixelHumain
{
    const TYPE_CITOYEN	       = "citoyen";
    const TYPE_ASSOCIATION	   = "association";
    const TYPE_ENTREPRISE	   = "entreprise";
    const TYPE_COLLECTIVITE	   = "collectivite";
    const TYPE_EVENT	       = "event";
    const TYPE_PROJET	       = "projet";
    const TYPE_DISCUSSION	   = "discussion";
    
    /* Standard connection types, the user can then create his own groupings*/
    const CONNECT_TYPE_FRIEND	   = "friend";
    const CONNECT_TYPE_WORK	       = "work";
    const CONNECT_TYPE_CONTACT	   = "contact";
    
    public static function buildMenuChildren( $collection )
    {
        $menu = array();
       $cols = iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find());
        foreach ($cols as$e) {
            array_push( $menu , array( "label"=>$e["name"],"href"=>Yii::app()->createUrl("/".$e["key"] ) ) );
        }
        return $menu;
    }
}