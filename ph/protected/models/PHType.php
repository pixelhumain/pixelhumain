<?php

class PHType
{
    /*
    convert to Json Ld 
    const TYPE_CITOYEN         = "persons";
    const TYPE_GROUPS          = "organizations";
    const TYPE_ASSOCIATION     = "NGO";
    const TYPE_ENTREPRISE      = "LocalBusiness";
    const TYPE_COLLECTIVITE    = "GovernmentOrganization";

     */
    const TYPE_CITOYEN	       = "citoyens";
    const TYPE_ORGANIZATIONS   = "organizations";
    
    const TYPE_GROUPS          = "groups";
    const TYPE_ASSOCIATION	   = "association";
    const TYPE_ENTREPRISE	   = "entreprise";
    const TYPE_COLLECTIVITE	   = "collectivite";
    const TYPE_EVENTS          = "events";
    const TYPE_PROJECTS	       = "projects";
    const TYPE_DISCUSSION	   = "discussion";
    const TYPE_APPLICATIONS    = "applications";
    const TYPE_SURVEYS         = "surveys";
    const TYPE_ACTIVITYSTREAM  = "activityStream";
    const TYPE_MICROFORMATS    = "microformats";
    const TYPE_LISTS           = "lists";
    const TYPE_MESSAGES        = "messages";
    const TYPE_JOBTYPES        = "jobTypes"; 
    const TYPE_NEWS        	   = "news";
    const TYPE_LAYOUT          = "layout";
    
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