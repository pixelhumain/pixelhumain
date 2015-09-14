<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class NotificationType 
{
    const NOTIFICATION_LOGIN                   = "citizenLogin";
    const NOTIFICATION_REGISTER                = "citizenRegister";
    const NOTIFICATION_COMMUNECTED             = "citizenCommunected";
    const NOTIFICATION_ACTIVATED               = "citizenActivated";
    const NOTIFICATION_INVITATION              = "citizenInvitation";
    const NOTIFICATION_LINK_REQUEST            = "citizenLinkRequest";
    const NOTIFICATION_LINK_CONFIRMATION       = "citizenLinkConfirmation";
    
    const ASSOCIATION_SAVED                    = "associationSaved";
    const ENTREPRISE_SAVED                     = "entrepriseSaved";
    const COLLECTIVITE_SAVED                   = "collectiviteSaved";
    
    const NOTIFICATION_SWE_COACH_REQUEST       = "startUpWeekendCoachRequest";
    const NOTIFICATION_SWE_SAVED_INFOS         = "sweSavedInfos";
    const NOTIFICATION_SWE_SAVED_FEEDBACK      = "sweSavedFeedback";
    
    const LOGIN_FACEBOOK                       = "LoginFaceBook";
    const LOGIN_TWITTER                        = "LoginTwitter";
    const LOGIN_LINKEDIN                       = "LoginLinkedIn";
    const LOGIN_GOOGLE                         = "LoginGoogle";
}