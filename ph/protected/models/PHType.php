<?php

class PHType
{
    const TYPE_CITOYEN	       = "citoyens";
    const TYPE_GROUPS          = "groups";
    const TYPE_ASSOCIATION	   = "association";
    const TYPE_ENTREPRISE	   = "entreprise";
    const TYPE_COLLECTIVITE	   = "collectivite";
    const TYPE_EVENTS          = "events";
    const TYPE_PROJECTS	       = "projects";
    const TYPE_DISCUSSION	   = "discussion";
    const TYPE_APPLICATIONS    = "applications";
    const TYPE_SURVEYS         = "surveys";
    const TYPE_ACTION_HISTORY  = "actionHistory";
    const TYPE_MICROFORMATS    = "microformats";
    const TYPE_LISTS           = "lists";
    const TYPE_MESSAGES        = "messages";
    const TYPE_JOBTYPES        = "jobTypes"; 
    
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