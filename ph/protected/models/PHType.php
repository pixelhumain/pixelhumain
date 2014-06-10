<?php

class PHType
{
    const TYPE_CITOYEN	       = "citoyen";
    const TYPE_ASSOCIATION	   = "association";
    const TYPE_ENTREPRISE	   = "entreprise";
    const TYPE_COLLECTIVITE	   = "collectivite";
    const TYPE_EVENT	       = "event";
    const TYPE_PROJET	       = "projet";
    const TYPE_DISCUSSION	   = "discussion";
    const TYPE_APPLICATIONS    = "applications";
    const TYPE_SURVEYS         = "surveys";
    
    /* Standard connection types, the user can then create his own groupings*/
    const CONNECT_TYPE_FRIEND	   = "friend";
    const CONNECT_TYPE_WORK	       = "work";
    const CONNECT_TYPE_CONTACT	   = "contact";

    const COLLECTION_GROUPS     = "groups";    

    public static $types2Collection = array( Group::TYPE_ASSOCIATION  => self::COLLECTION_GROUPS,
                                            Group::TYPE_EVENT  => self::COLLECTION_GROUPS,
                                            Group::TYPE_ENTREPRISE  => self::COLLECTION_GROUPS,
                                        );
    
    
}