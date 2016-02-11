
<?php if(@Yii::app()->session["userId"] && Yii::app()->params['rocketchatEnabled'] )
{
    //sets all the global params for the usage of the chat
    Yii::app()->session["adminLoginToken"] = Yii::app()->params["adminLoginToken"];
    Yii::app()->session["adminRocketUserId"] = Yii::app()->params["adminRocketUserId"];
    if(!@Yii::app()->session["loginToken"] && !@Yii::app()->session["rocketUserId"])
    {
        $rocket = RocketChat::getToken(Yii::app()->session["userEmail"],Yii::app()->session["pwd"]);
        Yii::app()->session["loginToken"] = $rocket["loginToken"];
        Yii::app()->session["rocketUserId"] = $rocket["rocketUserId"];
    }
?>
<script>
var rcObj = {

    lastOpenChat : null,
    debugChat : false,
    loginToken : '<?php echo @Yii::app()->session["loginToken"]; ?>',
    rocketUserId : '<?php echo @Yii::app()->session["rocketUserId"]; ?>',
    list : null,

    login : function () 
    { 
        if(rcObj.debugChat)alert("rcObj.login");
        document.querySelector('iframe').contentWindow.postMessage({
              externalCommand: 'login-with-token',
              token: '<?php echo @Yii::app()->session["loginToken"]; ?>' }, '*');
    },

    loadChat : function (name,type,isOpen,hasRC){ 
        
        rcObj.loadedIframe (name) ;
        //if iframe deosn't exist
        //element has an RC channel 
        //not a citizen
        if( contextData && typeof contextData.slug == "undefined" )
            contextData.slug = slugify(contextData.name);
        
        var checkGroupMember = ( contextData ) ? $.inArray( contextData.slug , rcObj.list ) : true ; 
        
        if(rcObj.debugChat)alert( "name:"+name+", type:"+type+", isOpen : "+isOpen+", hasRC : "+hasRC+",checkGroupMember:"+checkGroupMember );

        if( $('.RCcontainer').html() == "" || 
            ( hasRC && type != "citoyens" && rcObj.lastOpenChat != name && checkGroupMember < 0 ) ||
            (!hasRC && type != "citoyens" && rcObj.lastOpenChat != name) )
        {  
            rcObj.lastOpenChat = name;
            var extra = (isOpen) ? "/roomType/channel" : "/roomType/group";

            iframeUrl = (name!="") ? baseUrl+'/'+moduleId+'/rocketchat/chat/name/'+contextData.slug+'/type/'+contextData.type+'/id/'+contextData.id+extra
                                   : baseUrl+'/'+moduleId+'/rocketchat';
            
            if(rcObj.debugChat)alert( iframeUrl );

            getAjax(null, iframeUrl, function(data){ 
                        $('.btnChatColor').addClass("text-red");
                        rcObj.goto(name,isOpen);
                    } ,"json");
            
        }  else {

            //todo : pb sur les nouvelles creations en passant par ici
            if(rcObj.debugChat)alert( rcObj.lastOpenChat+" | "+name );
            
            rcObj.goto(name,isOpen);
        }

        rcObj.lastOpenChat = name;
    },
    goto : function (name,isOpen) { 
        pathChannel = "/";
        if( name != "" ){
            if( contextData.type == "citoyens" ) 
                pathChannel = "/direct/"+contextData.username ;
            else {
                pathChannel = (isOpen) ? "/channel/"+contextData.slug 
                                       : "/group/"+contextData.slug;
            }
        }else {
            setTimeout( function () { history.pushState('', document.title, window.location.pathname);}, 1000);

        }
        if(rcObj.debugChat)alert( "RC goto : "+pathChannel );

        setTimeout( function () { 
            document.querySelector('iframe').contentWindow.postMessage({
                externalCommand: 'go',
                path: pathChannel }, '*');
         }, 1000);
        
    },
    settings : function () { 
        rcObj.loadChat("","citoyens", true, true);
        setTimeout( function () { 
            document.querySelector('iframe').contentWindow.postMessage({
                externalCommand: 'go',
                path: "/account/preferences" }, '*');
         }, 1000);

    },

    loadedIframe : function  (name) { 
        rcObj.login();
        //$('.RCcontainerSpinner').addClass('hide');
        $('.RCcontainer').css("height","100%");
        $('#rocketchatModal').modal("show"); 
        rcObj.sizeChat(name);
    },

    sizeChat : function (name) { 
        if( name == "" ){
            $('#rocketchatModal .modal-content, #rocketchatModal .modal ').css("width","100%");
            $(".btnExpand").removeClass('fa-expand').addClass('fa-compress');
        }
        else {
            $('#rocketchatModal .modal-content, #rocketchatModal .modal ').css("width","50%");
            $(".btnExpand").removeClass('fa-compress').addClass('fa-expand');
        }
    }

};
</script>
<?php } ?>