<?php
/*

 */
class CitoyenType
{    
    const GAME_REZOTAGE    = 10;
    const GAME_ACTION_NIV1    = 1;
    const GAME_ACTION_NIV2    = 2;
    const GAME_ACTION_NIV3    = 3;
    const GAME_ACTION_NIV4    = 5;
    const GAME_ACTION_NIV5    = 3;

    const NODE_ASSOCIATIONS     = 'associations';
    const NODE_APPLICATIONS     = 'applications';
    const NODE_EVENTS           = 'events';
    const NODE_POSITIONS        = 'positions';
    const NODE_FRIENDS          = 'friends';
    const NODE_NOTIFICATIONS    = "notifications";

    const NODE_TOBEACTIVATED    = "tobeactivated";
    const NODE_ISADMIN    = "isAdmin";

    public static $types2Nodes = array( Group::TYPE_ASSOCIATION  => self::NODE_ASSOCIATIONS,
                                        Group::TYPE_ENTREPRISE   => "employees",
                                        Group::TYPE_EVENT        => "participants",
                                        Group::TYPE_PROJECT      => "participants");
}
?>