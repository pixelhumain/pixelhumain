<?php
/*

 */
class ActionType
{
    const NODE_ACTIONS          = "actions";

    const ACTION_VOTE_UP        = "voteUp";
    const ACTION_VOTE_ABSTAIN   = "voteAbstain";
    const ACTION_VOTE_UNCLEAR   = "voteUnclear";
    const ACTION_VOTE_MOREINFO  = "voteMoreInfo";
    const ACTION_VOTE_DOWN      = "voteDown";
   
    //const ACTION_VOTE_BLOCK   = "voteBlock";
    const ACTION_PURCHASE       = "purchase";
    /*const ACTION_INFORM       = "inform";
    const ACTION_ASK_EXPERTISE  = "expertiseRequest";*/
    const ACTION_COMMENT        = "comment";
    const ACTION_FOLLOW         = "follow";

    /*public static $action2Nodes = array( self::ACTION_VOTE_UP        => array("value"=>1),
                                         self::ACTION_VOTE_DOWN      => array("value"=>-1),
                                         self::ACTION_VOTE_ABSTAIN   => array("value"=>0),
                                         //self::ACTION_VOTE_BLOCK     => array("node"=>"voted","value"=>-2),
                                         self::ACTION_PURCHASE       => array("value"=>1),
                                         self::ACTION_INFORM         => "informed",
                                         self::ACTION_REQUEST_EXPERTISE  => "request",
                                         self::ACTION_COMMENT  => array("value"=>1),
                                         self::ACTION_FOLLOW  => array("value"=>1),
                                        );*/
}
?>