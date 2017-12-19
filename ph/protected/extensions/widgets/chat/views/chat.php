

<style type="text/css">
#rocketchatModal.modal {   
    margin:0; 
    padding:0; 
    overflow: hidden;
    width: 100%; 
    height: 100%;
    background-color:rgb(0,0,0,0.5); 
    border-left:3px solid #333;
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
</style>
<div class="rocketchat-modal modal fade" id="rocketchatModal" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-content shadow2">
        <div class="col-sm-12 RCcontainerSpinner">
                <a href="javascript:rcObj.sizeChat('')">
                    <i class="hide fa btnExpand fa-expand fa-2x"  style="float:left;color:#C5203B;margin-right:20px;"></i>
                </a>
                <a href="javascript:rcObj.sizeChat('')">
                    <i class="hide fa fa-external-link fa-2x"  style="float:left;color:#C5203B;margin-right:20px;"></i>
                </a>
                <h5 class="letter-red pull-left">
                    <i class='fa fa-comments'></i> Messagerie instantanée
                </h5><!-- <span class='rocketchatTitle'></span> -->
                <button class="btn btn-default btn-sm text-dark pull-right close-modal" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                
        </div>
        <div class="col-sm-12 RCcontainer" style="background-color:white"></div>
    </div>
</div>



<script type="text/javascript">
var searchObj = {};
jQuery(document).ready(function() { 

    $(".btn-main-menu").mouseenter(function(){ 
        $(".menuSection2").addClass("hidden"); 
        if( $(this).data("type") ) 
            $("."+$(this).data("type")+"Section2").removeClass("hidden");
    }).click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn("***************************************"); 
        mylog.warn("bindLBHLinks",$(this).attr("href")); 
        mylog.warn("***************************************"); 
        var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href"); 
        urlCtrl.loadByHash( h ); 
    }); 

    $(".tagSearchBtn").click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn( ".tagSearchBtn",$(this).data("type"),$(this).data("stype"),$(this).data("tags") ); 

        searchObj.types = $(this).data("type").split(",");
        
        if( $(this).data("stype") )
            searchObj.stype = $(this).data("stype");
        else
            searchObj.tags = $(this).data("tags");
        
        urlCtrl.loadByHash($(this).data("app"));
        urlCtrl.afterLoad = function () {     
            //we have to pass by a variable to set the values         
            searchType = searchObj.types;
        
            if( $(this).data("stype") )
                $('#searchSType').val(searchObj.stype);
            else
                $('#searchTags').val(searchObj.tags);
            startSearch();
            searchObj = {};
        }
    }); 

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

<?php } ?>

</script>