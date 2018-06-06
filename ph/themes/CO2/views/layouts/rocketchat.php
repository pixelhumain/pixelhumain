
<style type="text/css">
    #rocketchatModal.modal {   
        margin:0; 
        padding:0; 
        overflow: hidden;
        width: 100%; 
        height: 100%;
        background-color:rgb(0,0,0,0.5); 
        border-left:3px solid #333;
        z-index: 10000;
    }
    #rocketchatModal .modal-content {
        position: fixed;
        top: 10%;
        right: 5%;
        left: 5%;
        bottom: 10%;
        border-radius: 0;
        box-shadow: none;
        height: auto;
        padding-top:10px !important;
        width: auto !important;
        -webkit-box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.5) !important;
        -moz-box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.5) !important;
        box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.5) !important;
    }
    .rocketchatTitle{
        color:#333;
        font-size: 20px;
    }
    .RCcontainerSpinner{
        height:40px;
    }
    .RCcontainer{
        border-top: 1px solid #c9c8c8;
    }


#rc.iframe-rocketchat .RCcontainerSpinner h5.letter-red{
    color: #4285f4 !important;
}

#rocket-chat .side-nav .rooms-list{
    background-color: #044b76 !important;
}

#rocket-chat .side-nav.primary-background-color{
    background-color: #044b76 !important;
}

#rocket-chat .loading-animation{
    background-color: #044b76 !important;
}

</style>

<div class="rocketchat-modal modal fade" id="rocketchatModal" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-content shadow2">
        <div class="col-sm-12 RCcontainerSpinner">
                <a href="javascript:rcObj.sizeChat('')">
                    <i class="hide fa btnExpand fa-expand fa-2x"  style="float:left;color:#C5203B;margin-right:20px;"></i>
                </a>
                
                <h5 class="letter-red pull-left">
                    <i class='fa fa-comments'></i> Messagerie instantanée
                </h5><!-- <span class='rocketchatTitle'></span> -->
                <button class="btn btn-default btn-sm text-dark pull-right close-modal margin-left-10" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                
                <a href="https://chat.communecter.org" target="_blank" class="btn btn-default btn-sm  pull-right ">
                    <i class=" fa fa-external-link" ></i>
                </a>

               <a href="javascript:rcObj.newChannel()" class=" pull-right text-red btn btn-default btn-sm "  > 
                    <i class=" fa fa-plus"  ></i>
                </a>
        </div>
        <div class="col-sm-12 RCcontainer" style="background-color:white"></div>
    </div>
</div>

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


jQuery(document).ready(function() { 
    //preload in background the rocket iframe
    <?php if(@Yii::app()->session["userId"] && Yii::app()->params['rocketchatEnabled'] ){?>
    if( userId ){
        //preload the iframe 
        getAjax('.RCcontainer', baseUrl+'/'+moduleId+'/rocketchat',null,"html");
        //get all users Lsit of channels
        getAjax(null, baseUrl+'/'+moduleId+'/rocketchat/list',function(data) {  
            mylog.log("rcObj.list : ",data);
            rcObj.list = data;  
        },"json");
    }
    <?php } ?>
});

var rcObj = {

    lastOpenChat : null,
    debugChat : false,
    loginToken : '<?php echo @Yii::app()->session["loginToken"]; ?>',
    rocketUserId : '<?php echo @Yii::app()->session["rocketUserId"]; ?>',
    list : null, //contains the list of all accessible RC channels

    newChannel : function()
    {
        dyFObj.openForm('chat'); 
        $('#rocketchatModal').modal('hide'); 
    },
    login : function () 
    { 
        if(rcObj.debugChat)alert("rcObj.login");
        document.querySelector('iframe').contentWindow.postMessage({
            externalCommand: 'login-with-token',
            token: '<?php echo @Yii::app()->session["loginToken"]; ?>' }, '*');
    },
    //anme : slug
    //type : citoyens, organization, project, event
    //isOpen : boolean isOpenEdition ??
    //hasRC : boolean if an RC has allready been opened 
    //when loading from anywhere we don't use tmpContextData juste the name 
    //tmpCtxtData : notice we use tmpContextData so when there is no contextData we can fill it with a given context
    loadChat : function (name,type,isOpen,hasRC,tmpContextData,url){ 
        //alert("loadchat");
        /*if(baseUrl.indeOf("127.0.0") == 0){
            alert("rocket chat create only works on server")
            return;
        }*/

        if(isOpen != "external")
            rcObj.loadedIframe (name) ;

        if(typeof tmpContextData != "undefined")
            rcObj.data = tmpContextData;
        else if( !tmpContextData && contextData )
            rcObj.data = contextData;

        //if iframe deosn't exist
        //element has an RC channel 
        //not a citizen
        //todo:check if the slug is save to DB otherwise if name changes than the channel becomes orhan
        if( rcObj.data && typeof rcObj.data.slug == "undefined" )
            rcObj.data.slug = slugify(rcObj.data.name); 
        
        //defauilts to true because correspond in the use case of opening a glabal chat 
        //list comes from /rocketchat/list
        var checkGroupMember = ( rcObj.data ) ? $.inArray( rcObj.data.slug , rcObj.list ) : true ; 
        
        if(rcObj.debugChat)alert( "name:"+name+", type:"+type+", isOpen : "+isOpen+", hasRC : "+hasRC+",checkGroupMember:"+checkGroupMember );

        //when still not loaded
        //or the element hasRC but member hasn't joined yet 
        //or the channel doesn't exist and needs to be created 
        // direct conversations
        if( $('.RCcontainer').html() == "" || 
            ( hasRC && type != "citoyens" && rcObj.lastOpenChat != name && checkGroupMember < 0 ) ||
            (!hasRC && type != "citoyens" && rcObj.lastOpenChat != name) )
        {  
            if(rcObj.debugChat)alert( "create Chat" );

            rcObj.lastOpenChat = name;
            var paramsExt = null;
            var extra = "/roomType/group";
            if(isOpen == "external"){
                extra = "/roomType/external";
                paramsExt = { title : name, url : encodeURIComponent(url)};
            }
            else if(isOpen) 
                extra = "/roomType/channel"; 

            createChatUrl = (name!="") ? baseUrl+'/'+moduleId+'/rocketchat/chat/name/'+rcObj.data.slug+'/type/'+rcObj.data.type+'/id/'+rcObj.data.id+extra
                                   : baseUrl+'/'+moduleId+'/rocketchat';
            
            if(rcObj.debugChat)alert( createChatUrl );

            if(isOpen == "external"){
                if(rcObj.debugChat)alert("external");
                ajaxPost(null,createChatUrl,paramsExt,function(data){ 
                        $('.btnChatColor').addClass("text-red");
                        if(rcObj.debugChat)alert("success external");
                        urlCtrl.loadByHash(location.hash);
                    },"json");
            }
            else 
                getAjax(null, createChatUrl, function(data){ 
                        $('.btnChatColor').addClass("text-red");
                        rcObj.goto(name,isOpen);
                    } ,"json");

            
            
        } else {
            //todo : pb sur les nouvelles creations en passant par ici
            if(rcObj.debugChat)alert( rcObj.lastOpenChat+" | "+name );
            rcObj.goto(name,isOpen);
        }

        rcObj.lastOpenChat = name;
    },

    goto : function (name,isOpen) { 
        pathChannel = "/";
        if( name != "" ){
            if( rcObj.data.type == "citoyens" ) 
                pathChannel = "/direct/"+rcObj.data.username ;
            else {
                pathChannel = (isOpen) ? "/channel/"+rcObj.data.slug 
                                       : "/group/"+rcObj.data.slug;
            }
        }else 
            setTimeout( function () { history.pushState('', document.title, window.location.pathname);}, 1000);
        

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