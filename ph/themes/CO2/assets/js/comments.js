
function initCommentsTools(listObjects, type, canComment, parentId){ 
  //ajoute la barre de commentaire & vote up down signalement sur tous les medias
  $.each(listObjects, function(key, media){
    if(typeof media._id != "undefined" || typeof media.id != "undefined"){
          console.log("type",media);
        //media.target = "news"; 
        var commentCount = 0;
        idMedia=(typeof media._id != "undefined") ? media._id['$id'] : media.id;
        if ("undefined" != typeof media.commentCount) 
          commentCount = media.commentCount;
        
        idSession = typeof idSession != "undefined" ? idSession : false;

        var sectionHtmlCount = '';
        if(typeof media.voteCount != "undefined"){
          sectionHtmlCount = "<a href='javascript:;' onclick='getReactionList(\""+idMedia+"\",\""+type+"\");' class='content-reactions-"+type+" content-reactions-"+type+"-"+idMedia+"'>";
          totalReaction=0;
          $.each(media.voteCount, function(e, v){
            addClassCount="";
            if(userId != "" && "undefined" != typeof media.vote 
              && "undefined" != typeof media.vote[userId] 
              && "undefined" != typeof media.vote[userId].status && media.vote[userId].status==e)
                addClassCount="currentUserVote";
            sectionHtmlCount +="<div class='emojicon"+type+" "+e+" "+addClassCount+" pull-left' data-count='"+v+"'></div>";
            totalReaction=totalReaction+v;
          });
          sectionHtmlCount+="<span class='pull-left margin-left-5 totalCountReaction' data-count='"+totalReaction+"'>"+totalReaction+"</span>";
          sectionHtmlCount+="</a>"
        }
        /*if(commentCount > 0){
          sectionHtmlCount+="<span class='nbNewsComment pull-right newsAddComment' data-media-id='"+idMedia+"''>" + commentCount + " ";
          sectionHtmlCount+=(commentCount>1) ? trad.comments : trad.comment;
          sectionHtmlCount+="</span>";
        }*/
        /*if(commentCount == 0 && idSession) lblCommentCount = "<i class='fa fa-comment'></i>  "+trad.commenton;
        if(commentCount == 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> "+trad.comment;
        if(commentCount > 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> "+trad.comments;
        if(commentCount == 0 && !idSession) lblCommentCount = "0 <i class='fa fa-comment'></i> ";*/

        
        var actionOn="";
        if(type=="news"){
          labelComments=trad.commenton;
          if(commentCount>0){
            labelComments=commentCount+" "
            labelComments+=(commentCount>1) ? trad.comments : trad.comment;
          }
          actionOn = '<a href="javascript:" class="newsAddComment letter-blue" data-media-id="'+idMedia+'"><i class="fa fa-comment"></i> '+labelComments+'</a>';
        }
        else if (type=="comments"){
          countReplies=(typeof media.replies != "undefined") ? Object.keys(media.replies).length : 0;
          s=(countReplies > 1) ? "s" : "";
          lblReply = "<i class='fa fa-reply fa-rotate-180'></i> "+trad.answer;
          parentId=(notNull(parentId)) ? parentId : idMedia;
          if(countReplies >= 1) lblReply = "<i class='fa fa-reply fa-rotate-180'></i>"+countReplies+" "+trad["answer"+s];
          actionOn= '<a class="" href="javascript:answerComment(\''+idMedia+'\', \''+idMedia+'\',\''+media.contextType+'\')">'+lblReply+'</a>';
        }
        // SHARE ACTION AND COUNT SHARE
        if(type=="news"){
          idMediaShare=media._id['$id']; 
          typeMediaShare = "news";
          if(media.type=="activityStream") {
            idMediaShare = media.object.id;
            typeMediaShare = media.object.type;
          }
          if(typeof media.scope.type != "undefined" && media.scope.type != "private")
            actionOn =  actionOn+
                             "<button class='text-dark btn btn-link no-padding margin-right-5 btn-share bold'"+
                                " style='margin-top:-1px;'" +
                                " data-id='"+idMediaShare+"' data-type='"+typeMediaShare+"'>"+
                                "<i class='fa fa-retweet'></i> "+trad.share+
                             "</button>";

          var countShare = media.sharedBy.length-1;
          if(countShare > 1)
          sectionHtmlCount =  sectionHtmlCount+
                             "<small class='pull-right tooltips' data-original-title='ce message a été partagé "+countShare+" fois'"+
                                " style='margin-top:3px;'>" +
                                "<i class='fa fa-share'></i> "+countShare+
                             "</small>";
        }
        if(sectionHtmlCount!=""){
          sectionHtmlCount="<div class='col-xs-12 no-padding sectionHtmlCount-"+type+"-"+idMedia+"'>"+sectionHtmlCount+"</div>"
          if(type!="comments")
            sectionHtmlCount+="<hr class='col-xs-12 margin-top-5 margin-bottom-5 no-padding'></hr>";
        }

        actionOn = actionOn+voteCheckAction(idMedia, media, type);
        if(type=="comments"){
            if(typeof media.author.id != "undefined" && media.author.id== userId){
                 actionOn += '<a class="tooltips margin-left-10" '+
                         'data-toggle="tooltip" data-placement="top" title="'+trad.update+'" '+
                         'href="javascript:editComment(\''+idMedia+'\')"><i class="fa fa-pencil"></i>'+
                      '</a>'+
                      '<a class="tooltips margin-left-10" data-toggle="tooltip" data-placement="top" title="'+trad.delete+'" '+
                        'href="javascript:confirmDeleteComment(\''+idMedia+'\',$(this))"><i class="fa fa-trash"></i>'+
                      '</a>';        
              }

        }
        voteTools = sectionHtmlCount + actionOn;
        $("#footer-"+type+"-"+idMedia).html(voteTools);
        initReactionTools(idMedia, type);
        if(type=="comments" && typeof media.replies != "undefined" && notNull(canComment)){
          initCommentsTools(media.replies, type, canComment, idMedia);
        }
    }
  });

  initBtnShare();
  initReportAbuse();
  $(".newsAddComment").off().click(function(){
    var id = $(this).data("media-id");
    showCommentsTools(id);
  });
}
function initReportAbuse(){
  $('.reportAbuse').off().on("click",function(){
      id=$(this).data("id");
      if($(".commentVoteUp[data-id='"+id+"']").hasClass("text-green") || $(".commentVoteDown[data-id='"+id+"']").hasClass("text-orange"))
          toastr.info(trad.youcantmakeactionafterabuse);
      reportAbuse($(this));
  });
  
}

function abuseActionSuccess($this, data, action){
  if (data.userAllreadyDidAction) {
    toastr.info(trad.youalreadydeclareabuse+$this.data("type"));
  } else {
    toastr.success(data.msg);
    if (action == "reportAbuse") {
      count = parseInt($this.data("count"));
      $this.data( "count" , count+1 );
      icon = $this.children(".label").children(".fa").attr("class");
      $this.children(".label").html($this.data("count")+" <i class='"+icon+"'></i>");
    } else {
      $('.abuseCommentTable #comment'+$this.data("id")).remove();
      $('.nbCommentsAbused').html((parseInt($('.nbCommentsAbused').html()) || 0) -1);
    }
  }
}

function initReactionTools(idObject, type){
  $("#footer-"+type+"-"+idObject+' .reaction-news').faceMocion({
        emociones:[
         {"emocion":"love","TextoEmocion":trad.ilove, "class" : "amo", "color": "text-red" },
         {"emocion":"bothered","TextoEmocion":trad.bothering,"class" : "molesto", "color": "text-orange"},
         {"emocion":"scared","TextoEmocion":trad.what, "class" : "asusta", "color": "text-purple"},
         {"emocion":"enjoy","TextoEmocion":trad.toofunny, "class" : "divierte","color": "text-orange"},
         {"emocion":"like","TextoEmocion":"+1", "class" : "gusta", "color": "text-red"},
         {"emocion":"sad","TextoEmocion":trad.sad, "class" : "triste", "color": "text-azure"},
         {"emocion":"support","TextoEmocion":trad.isupport, "class" : "support", "color":"letter-blue"},
         {"emocion":"glad","TextoEmocion":trad.cool, "class" : "alegre", "color":"text-orange"},
         {"emocion":"disguted","TextoEmocion":trad.burk, "class" : "disguted", "color":"text-brown"}
         ],
         callback: function(contentDiv, emo) {
         // console.log($(e).parent());
          $refNews=$(".reaction-news."+contentDiv.attr('id-referencia'));
          actionOnMedia(contentDiv, "vote",  false, {status: emo});
        }
  });
    //  })
}
function actionOnMedia(contentDiv,action,method, detail) {
  //var type="news";
  //if(typeof parentTypeComment != "undefined")
    //type = parentTypeComment;
  var typeObj=contentDiv.data("type");
  var idObj=contentDiv.data("id");
  params=new Object,
  params.id=idObj,
  params.collection=typeObj,
  params.action=action;
  if(notNull(detail)){
    params.details=detail;
  }
  
  if(method){
    params.unset=method;
  }
  $.ajax({
    url: baseUrl+'/'+moduleId+"/action/addaction/",
    data: params,
    type: 'post',
    global: false,
    dataType: 'json',
    success: 
      function(data) {
          if(!data.result)
              toastr.error(data.msg);
          else { 
            if (data.userAllreadyDidAction) 
              toastr.info(data.msg);
            else {
              if(action=="reportAbuse"){
                abuseActionSuccess(contentDiv, data, action);
//                toastr.success(trad["thanktosignalabuse"]);

                //to hide menu
                //$(".newsReport[data-id="+params.id+"]").hide();
              }
              else{
                if(count < count+data.inc){
                  if(action=="vote")
                    callbackVote(typeObj, idObj, data.element.vote[userId].status);
                  toastr.success(trad["voteaddedsuccess"]);
                }
                else
                  toastr.success(trad["voteremovedsuccess"]);  
              }                   
            }
          }
        },
        error: 
          function(data) {
            toastr.error("Error calling the serveur : contact your administrator.");
          }
  });
}
function callbackVote(type, id, status){
  htmlContent="";
  //Check if a reaction is already done on object to know if vote count container exists
  if($(".content-reactions-"+type+"-"+id).length<=0){
    htmlContent="<a href='javascript:;' onclick='getReactionList(\""+id+"\",\""+type+"\");' class='content-reactions-"+type+" content-reactions-"+type+"-"+id+"'>"+
        "<span class='pull-left margin-left-5 totalCountReaction' data-count='0'></span>"+
      "</a>";
    targetDom=".sectionHtmlCount-"+type+"-"+id;
  }
  //Check if a reaction or a comment is already done on object to know if count container exists in footer
  if($(".sectionHtmlCount-"+type+"-"+id).length<=0){
    htmlContent="<div class='col-xs-12 no-padding sectionHtmlCount-"+type+"-"+id+"'>"+htmlContent+"</div>";
    if(type!="comments")
      htmlContent+="<hr class='col-xs-12 margin-top-5 margin-bottom-5 no-padding'></hr>";
    targetDom="#footer-"+type+"-"+id;
  }
  if(htmlContent!="")
    $(targetDom).prepend(htmlContent);
  //Check if user reaction voted on this object
  if($(".content-reactions-"+type+"-"+id+" .currentUserVote").length > 0){
    countLastVote=parseInt($(".content-reactions-"+type+"-"+id+" .currentUserVote").data("count"));
    if(countLastVote>1){
      $(".content-reactions-"+type+"-"+id+" .currentUserVote").data("count", (countLastVote-1)).removeClass("currentUserVote");
    }
    else
      $(".content-reactions-"+type+"-"+id+" .currentUserVote").remove();
  }else{
    //Increment total of vote account
    incTotal=parseInt($(".content-reactions-"+type+"-"+id+" .totalCountReaction").data("count"))+1;
    $(".content-reactions-"+type+"-"+id+" .totalCountReaction").data("count", incTotal).text(incTotal);
  }
  //Check if this status vote already existed for this object
  if($(".content-reactions-"+type+"-"+id+" .emojicon"+type+"."+status).length <=0)
    $(".content-reactions-"+type+"-"+id).prepend("<div class='emojicon"+type+" "+status+" currentUserVote pull-left' data-count='1'></div>");
  else
    $(".content-reactions-"+type+"-"+id+" .emojicon"+type+"."+status).addClass("currentUserVote").data("count", parseInt($(".content-reactions-"+type+"-"+id+" .emojicon"+type+"."+status).data("count"))+1);
}

function getReactionList(idMedia, type){
    showModalReactions();
    getAjax('#reactionsContent' ,baseUrl+'/'+moduleId+"/action/list/type/"+type+"/id/"+idMedia+"/actionType/vote",function(){},"html");
}
//lance le chargement des commentaires pour une publication
function showCommentsTools(id){ console.log("showCommentsTools", id);
    if(!$("#commentContent"+id).hasClass("hidden")){
      $(".commentContent").html("");
      $(".commentContent").removeClass("hidden");   
      $(".footer-comments").html("");
      $('#commentContent'+id).html('<div class="text-dark margin-bottom-10"><i class="fa fa-spin fa-refresh"></i> '+trad.chargingcomments+' ...</div>');
      getAjax('#commentContent'+id ,baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+id,function(){ 
        
      },"html");
    }else{
      $("#commentContent"+id).removeClass("hidden");    
      
    }
}

function voteCheckAction(idVote, newsObj, mediaTarget) {
  var voteUpCount = reportAbuseCount = voteDownCount = 0;
  textUp="text-dark";
  textDown="text-dark";
  textReportAbuse="text-dark";
  mediaTarget = (notNull(mediaTarget)) ? mediaTarget : newsObj.target.type;
  
  if ("undefined" != typeof newsObj.reportAbuse && "undefined" != typeof newsObj.reportAbuseCount && newsObj.reportAbuseCount > 0) {
    reportAbuseCount = newsObj.reportAbuseCount;
    if ("undefined" != typeof newsObj.reportAbuse[idSession]){
      textReportAbuse= "text-red";
      $(".newsReportAbuse[data-id="+idVote+"]").off();
    }
  }
  valueVote="";
  if(userId != "" && "undefined" != typeof newsObj.vote && "undefined" != typeof newsObj.vote[userId])
    valueVote="data-value='"+newsObj.vote[userId].status+"'";
 
  voteHtml= "<span class='reaction-news' data-count='"+voteUpCount+"' data-id='"+idVote+"' data-type='"+mediaTarget+"' "+valueVote+"></span>";
  if(mediaTarget!="news" || reportAbuseCount > 0){
    classPull=(mediaTarget=="news") ? "pull-right":"";
    voteHtml+="<a href='javascript:;' class='reportAbuse "+classPull+" margin-left-10' data-count='"+reportAbuseCount+"' data-id='"+idVote+"' data-type='"+mediaTarget+"'>"+
      "<span class='label "+textReportAbuse+" no-padding'>"+reportAbuseCount+" <i class='fa fa-flag'></i></span>"+
    "</a>";
  }
    //onclick='newsReportAbuse(this, \""+idVote+"\")'
  return voteHtml;
}



function bindEventTextArea(idTextArea, idComment, contextType, isAnswer, parentCommentId, commentUp, pathContext){
    var idUx = (parentCommentId == "") ? idComment : parentCommentId;
    
    $(idTextArea).css('height', "34px");
    $("#container-txtarea-"+idUx).css('height', "34px");
    autosize($(idTextArea));

    $(idTextArea).on('keyup ', function(e){
      if(e.which == 13 && !e.shiftKey && $(idTextArea).val() != "" && $(idTextArea).val() != " " && !isUpdatedComment) {
        if(!mentionsInit.isSearching){
          //submit form via ajax, this is not JS but server side scripting so not showing here
          saveComment($(idTextArea).val(), parentCommentId, idTextArea, pathContext);
          $(idTextArea).val("");
          $(idTextArea+", #container-txtarea-"+idUx).css('height', "34px");
          //var heightTxtArea = $(idTextArea).css("height");
          //$("#container-txtarea-"+idUx).css('height', heightTxtArea);
        }else
          mentionsInit.isSearching=false;
      }
    });

    $(idTextArea).bind ("input propertychange", function(e){
      var heightTxtArea = $(idTextArea).css("height");
          $("#container-txtarea-"+idUx).css('height', heightTxtArea);
    });

    if(contextType=="news"){
      mentionsInit.get(idTextArea);
      if(notNull(commentUp)){
        text=commentUp.text;
        $(idTextArea).val(text);
        //$(idTextArea).mentionsInput("update", data.mentions);
        if(typeof commentUp.mentions != "undefined" && commentUp.mentions.length != 0){
         // text=data.text;
          $.each(commentUp.mentions, function(e,v){
            if(typeof v.slug != "undefined")
              text=text.replace("@"+v.slug, v.name);
          });
          $(idTextArea).val(text);
          $(idTextArea).mentionsInput("update", commentUp.mentions);
        }
      } 
    }
  }



  function showMoreComments(id, hiddenCount){ mylog.log("showMoreComments", id, hiddenCount);
    $(".hidden-"+hiddenCount).removeClass("hidden");
    $(".link-show-more-" + (hiddenCount-10)).addClass("hidden");
  }

  function hideComments(id, level){ mylog.log("#comments-list-"+id + " .item-comment", level);
    //$("#comments-list-"+id + " .item-comment").addClass("hidden");
    if(level<=1){
      $("#commentContent"+id).addClass("hidden");
      //mylog.log("scroll TO : ", $('#newsFeed'+id).position().top, $('#newsHistory').position().top);
      $('.my-main-container').animate({
            scrollTop: $('#newsFeed'+id).position().top + $('#newsHistory').position().top
        }, 400);
    }
    else
      $("#comments-list-"+id).addClass("hidden");
  }



  //When a user already did an action on a comment the other buttons are disabled
  function disableOtherAction(commentId, action,method) {
    mylog.log("disableOtherAction", method);
    if(method){ //unset

      mylog.log("disableOtherAction 1", action);
      $(".reportAbuse[data-id='"+commentId+"']").data("voted", false);

      var count = $(action+"[data-id='"+commentId+"']").data("countcomment");
      mylog.log("count 1", count);
      $(action+"[data-id='"+commentId+"']").data("countcomment", count-1);
      $(action+"[data-id='"+commentId+"'] .countC").html(count-1);
    }
    else{ //set
      mylog.log("disableOtherAction 2", method);
     // $(".commentVoteUp[data-id='"+commentId+"']").removeClass("text-green").data("voted",true);
      //$(".commentVoteDown[data-id='"+commentId+"']").removeClass("text-orange").data("voted",true);
      $(".reportAbuse[data-id='"+commentId+"']").data("voted",true);

      //if (action == ".commentVoteUp") $(".commentVoteUp[data-id='"+commentId+"']").addClass("text-green");
      //if (action == ".commentVoteDown") $(".commentVoteDown[data-id='"+commentId+"']").addClass("text-orange");
      if (action == ".reportAbuse") $(".reportAbuse[data-id='"+commentId+"']").addClass("text-red");

      var count = $(action+"[data-id='"+commentId+"']").data("countcomment");
      $(action+"[data-id='"+commentId+"']").data("countcomment", count+1);
      $(action+"[data-id='"+commentId+"'] .countC").html(count+1);
    }
  }

  function saveComment(textComment, parentCommentId, domElement, path){
    textComment = $.trim(textComment);
    if(!notEmpty(parentCommentId)) parentCommentId = "";
    if(textComment == "") {
      toastr.error(trad.yourcommentisempty);
      return;
    }

    var argval = $("#argval").val();
    newComment={
      parentCommentId: parentCommentId,
      text : textComment,
      contextId : context["_id"]["$id"],
      contextType : contextType,
      argval : argval
    };
    if(notNull(path))
      newComment.path=path;
    newComment=mentionsInit.beforeSave(newComment, domElement);
    $.ajax({
      url: baseUrl+'/'+moduleId+"/comment/save/",
      data: newComment,
      type: 'post',
      global: false,
      dataType: 'json',
      success: 
        function(data) {
          if(!data.result){
            toastr.error(data.msg);
          }
          else { 
            toastr.success(data.msg);
            var count = $("#newsFeed"+context["_id"]["$id"]+" .nbNewsComment").html();
            
            if(!notEmpty(count)) count = 0;
            //mylog.log(count, context["_id"]["$id"]);
            comments[data.id.$id]=data.newComment;
            if(data.newComment.contextType=="news"){
              mentionsInit.reset(domElement);
              count = parseInt(count);
              var newCount = count +1;
              var labelCom = (newCount>1) ? trad.comments : trad.comment;
              $("#newsFeed"+context["_id"]["$id"]+" .lblComment").html("<i class='fa fa-comment'></i> <span class='nbNewsComment'>"+newCount+"</span> "+labelCom);
              $("#newsFeed"+context["_id"]["$id"]+" .newsAddComment").data('count', newCount);
            // }else{
            //  $("#newsFeed"+context["_id"]["$id"]+" .lblComment").html("<i class='fa fa-comment'></i> <span class='nbNewsComment'>1</span> commentaire");
            //  $("#newsFeed"+context["_id"]["$id"]+" .newsAddComment").data('count', 1);
            }
            
            // $('.nbComments').html((parseInt($('.nbComments').html()) || 0) + 1);
            // if (data.newComment.contextType=="news"){
            //  $(".newsAddComment[data-id='"+data.newComment.contextId+"']").children().children(".nbNewsComment").text(parseInt($('.nbComments').html()) || 0);
            // }
            //switchComment(commentId, data.newComment, parentCommentId);
            latestComments = data.time;

            var isAnswer = parentCommentId!="";
            mentionsArray=null;
            if(typeof data.newComment.mentions != "undefined"){
              mentionsArray=data.newComment.mentions;
            }
            showOneComment(data.newComment, parentCommentId, isAnswer, data.id.$id, argval, mentionsArray);   
            bindEventActions();    
          }
        },
      error: 
        function(data) {
          toastr.error(trad.somethingwentwrong);
        }
    });
    
  }

  function updateComment(id, newText,dom){
    newComment=new Object;
    newComment.text=newText;
    newComment=mentionsInit.beforeSave(newComment, dom);
   // updateField("Comment",id,"text",newComment.text,false, true);
    $.ajax({
      type: "POST",
      url: baseUrl+"/"+moduleId+"/comment/update", 
      data: { "id" : id ,"params" : newComment },
      success: function(data){
        if(data.result) {
          comments[id].text=newComment.text;
          if(typeof newComment.mentions != "undefined"){
          // updateField("Comment",id,"mentions",newComment.mentions,false, true);
            newComment.text = mentionsInit.addMentionInText(newComment.text,newComment.mentions);
            comments[id].mentions=newComment.mentions;
          }
          $('.text-comment-'+id).html(newComment.text);
          toastr.success(data.msg);        
          }
        else
          toastr.error(data.msg);  
      },
      dataType: "json"
    });
  }
  function showOneComment(newComment, idComment, isAnswer, idNewComment, argval, mentionsArray){
    textComent=mentionAndLinkify(idNewComment,newComment, true);
    var classArgument = "";
    if(argval == "up") classArgument = "bg-green-comment";
    if(argval == "down") classArgument = "bg-red-comment";
    if(argval == "") classArgument = "bg-white-comment";
    imgCommentUser=(userConnected.profilThumbImageUrl!="")? baseUrl+userConnected.profilThumbImageUrl:assetPath+'/images/thumbnail-default.jpg';
    var html = '<div class="col-xs-12 no-padding margin-top-5 item-comment '+classArgument+'" id="item-comment-'+idNewComment+'">'+

            '<img src="'+imgCommentUser+'" class="img-responsive pull-left img-circle" '+
            '  style="margin-right:5px;margin-top:10px;height:32px;width:32px;">'+
          
            '<span class="pull-left content-comment col-xs-12 no-padding">'+            
            ' <span class="text-black col-xs-12 comment-container-white">'+
            '   <span class="text-dark"><strong>'+userConnected.name+'</strong></span><br>'+
            '   <span class="text-comment text-comment-'+idNewComment+'">'  + textComment + "</span>" +
            ' </span><br>'+
              '<small class="bold">' +
                '<div class="col-xs-12 pull-left no-padding" id="footer-comments-'+idNewComment+'" style="padding-left:15px !important;"></div>'+
              '</small>'+
            '</span>'+  
            '<div id="comments-list-'+idNewComment+'" class="hidden pull-left col-xs-11 no-padding answerCommentContainer"></div>' +
              
          '</div>';

    if(!isAnswer){
      $("#comments-list-"+idComment).prepend(html);
      $("#comments-list-"+idComment).find(".noComment").remove();
    }else{
      $('#container-txtarea-'+idComment).after(html);
    }
    initCommentsTools({newComment}, "comments", true, idComment);
  }
  function linkify(inputText) {
      var replacedText, replacePattern1, replacePattern2, replacePattern3;

      //URLs starting with http://, https://, or ftp://
      replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
      replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank" class="text-azure">$1</a>');

      //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
      replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
      replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank" class="text-azure">$2</a>');

      //Change email addresses to mailto:: links.
      //replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
      //replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

      return replacedText;
  }



  function answerComment(idComment, parentCommentId,contextType){ 
    mylog.log("answerComment", parentCommentId, $("#comments-list-"+parentCommentId).hasClass("hidden"));
    
    if($("#argval").length > 0){
      $(".textarea-new-comment").removeClass("bg-green-comment bg-red-comment");
      $(".textarea-new-comment").addClass("bg-white-comment").attr("placeholder", "Votre commentaire");
      $("#argval").val("");
    }
    
    if(!$("#comments-list-"+parentCommentId).hasClass("hidden"))
      $("#comments-list-"+parentCommentId).addClass("hidden");
    else
      $("#comments-list-"+parentCommentId).removeClass("hidden");
    
    //si l'input existe déjà on sort
    if($('#container-txtarea-'+parentCommentId).length > 0) return;

    var html = '<div id="container-txtarea-'+parentCommentId+'" class="content-new-comment">' +

            '<img src="'+profilThumbImageUrlUser+'" class="img-responsive pull-left img-circle" '+
            '  style="margin-right:10px;height:32px;width:32px">'+
          
            '<div class="ctnr-txtarea">';

    html +=   '<textarea rows="1" style="height:1em;" class="form-control textarea-new-comment" ' +
                      'id="textarea-new-comment'+parentCommentId+'" placeholder="'+trad.youranswer+'..."></textarea>' +
            
            '</div>' +
          '</div>';

    $("#comments-list-"+parentCommentId).prepend(html);

    bindEventTextArea('#textarea-new-comment'+parentCommentId, idComment, contextType, true, parentCommentId);
  }
  function reportAbuse(obj) {
    var message = "<div id='reason' class='radio'>"+
      "<h3 class='margin-top-10'>"+trad.whyareyoureportabuse+" ?</h3>" +
      "<hr>" +
      "<label><input type='radio' name='reason' value='Propos malveillants' checked>"+trad.eviltongues+"</label><br>"+
      "<label><input type='radio' name='reason' value='Incitation et glorification des conduites agressives'>"+trad.incitementagressivedriving+"</label><br>"+
      "<label><input type='radio' name='reason' value='Affichage de contenu gore et trash'>"+trad.displaygorytrash+"</label><br>"+
      "<label><input type='radio' name='reason' value='Contenu pornographique'>"+trad.pornographiccontent+"</label><br>"+
        "<label><input type='radio' name='reason' value='Liens fallacieux ou frauduleux'>"+trad.deceitfullinks+"</label><br>"+
        //"<label><input type='radio' name='reason' value='Mention de source erronée'>Mention de source erronée</label><br>"+
        "<label><input type='radio' name='reason' value='Violations des droits auteur'>"+trad.copyrightinfringement+"</label><br><br>"+
        "<input type='text' class='form-control' style='text-align:left;' id='reasonComment' placeholder='"+trad["Leave your comment"]+"...'/><br>"+
        trad.explainmoderationprocess+" <a href='"+baseUrl+"/doc/Conditions%20G%C3%A9n%C3%A9rales%20d\'Utilisation.pdf' target='_blank'>"+trad.generaltermsofuse+"</a><br>" + 
      "<span class='text-red'><i class='fa fa-info-circle'></i> "+trad.allreportisdefinive+"</span><br>" +
     // "<hr>" +
     // "<span class=''><i class='fa fa-arrow-right'></i> Le contenu sera signalé par un <i class='fa fa-flag text-red'></i> s'il fait l'objet d'au moins 2 signalements</span><br>" +
      //"<span class='text-red-light'><i class='fa fa-arrow-right'></i> Le contenu sera masqué s'il fait l'objet d'au moins 5 signalements</span><br>" +
      //"<span class=''><i class='fa fa-arrow-right'></i> Le contenu sera supprimé par les administrateurs s'il enfreint les conditions d'utilisations</span>" +
      "</div>";
    var boxComment = bootbox.dialog({
      message: message,
      title: '<span class="text-red"><i class="fa fa-flag"></i> '+trad.reportanabuse,
      buttons: {
        annuler: {
          label: trad.cancel,
          className: "btn-default",
          callback: function() {}
        },
        danger: {
          label: trad.sendreport,
          className: "btn-danger",
          callback: function() {
            // var reason = $('#reason').val();
        details={ 
          reason : $("#reason input[type='radio']:checked").val(),
          comment : $("#reasonComment").val()
        }
        actionOnMedia(obj, "reportAbuse", false,details);
        //actionAbuse(comment, "reportAbuse", details);
        disableOtherAction(obj.data("id"), '.reportAbuse');
        //copyCommentOnAbuseTab(comment);
        return true;
          }
        },
      }
    });

    boxComment.on("shown.bs.modal", function() {
      $.unblockUI();
    });

    boxComment.on("hide.bs.modal", function() {
      $.unblockUI();
    });
}
function showModalReactions(obj) {
    var message = "<div id='reactionsContent'>"+
        "<i class='fa fa-spin fa-spinner'></i>"+
      "</div>";
    var boxComment = bootbox.dialog({
      message: message,
      title: ' ',
      buttons: {
        annuler: {
          label: trad.close,
          className: "btn-default",
          callback: function() {}
        }
      }
    });

    boxComment.on("shown.bs.modal", function() {
      $.unblockUI();
    });

    boxComment.on("hide.bs.modal", function() {
      $.unblockUI();
    });
}