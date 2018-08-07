
function initCommentsTools(listObjects, type, canComment, parentId){ 
  //ajoute la barre de commentaire & vote up down signalement sur tous les medias
  $.each(listObjects, function(key, media){
    if(typeof media._id != "undefined"){
          console.log("type",media);
        //media.target = "news"; 
        var commentCount = 0;
        idMedia=media._id['$id'];
        if ("undefined" != typeof media.commentCount) 
          commentCount = media.commentCount;
        
        idSession = typeof idSession != "undefined" ? idSession : false;

        var sectionHtmlCount = '';
        if(typeof media.voteCount != "undefined"){
          sectionHtmlCount = "<div class='content-reactions-"+type+"'>";
          totalReaction=0;
          $.each(media.voteCount, function(e, v){
            sectionHtmlCount +="<a href='javascript:;' class='emojicon"+type+" "+e+" pull-left'></a>";
            totalReaction=totalReaction+v;
          });
          sectionHtmlCount+="<a href='javascript:;' class='pull-left'>"+totalReaction+"</a>";
          sectionHtmlCount+="</div>"
        }
        if(commentCount > 0){
          sectionHtmlCount+="<span class='nbNewsComment pull-right newsAddComment' data-media-id='"+idMedia+"''>" + commentCount + " ";
          sectionHtmlCount+=(commentCount>1) ? trad.comments : trad.comment;
          sectionHtmlCount+="</span>";
        }
        /*if(commentCount == 0 && idSession) lblCommentCount = "<i class='fa fa-comment'></i>  "+trad.commenton;
        if(commentCount == 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> "+trad.comment;
        if(commentCount > 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> "+trad.comments;
        if(commentCount == 0 && !idSession) lblCommentCount = "0 <i class='fa fa-comment'></i> ";*/

        
        var actionOn="";
        if(type=="news")
          actionOn = '<a href="javascript:" class="newsAddComment letter-blue" data-media-id="'+idMedia+'"><i class="fa fa-comment"></i> '+trad.commenton+'</a>';
        else if (type=="comments"){
          countReplies=Object.keys(media["replies"]).length;
          s=(countReplies > 1) ? "s" : "";
          lblReply = trad.answer;
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
                             "<button class='text-dark btn btn-link no-padding margin-right-10 btn-share bold'"+
                                " style='margin-top:-3px;'" +
                                " data-id='"+idMediaShare+"' data-type='"+typeMediaShare+"'>"+
                                "<i class='fa fa-share'></i> "+trad.share+
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
          sectionHtmlCount="<div class='col-xs-12 no-padding'>"+sectionHtmlCount+"</div><hr class='col-xs-12 margin-top-5 margin-bottom-5 no-padding'></hr>";
        }

        actionOn = actionOn+voteCheckAction(idMedia, media, type);
        if(type=="comments"){
            if(typeof media.author.id != "undefined" && media.author.id== userId){
                 actionOn += '<a style="margin-left:5px; margin-right:5px;"  class="tooltips" '+
                         'data-toggle="tooltip" data-placement="top" title="'+trad.update+'" '+
                         'href="javascript:editComment(\''+idMedia+'\')"><i class="fa fa-pencil"></i>'+
                      '</a>'+
                      '<a class="tooltips" data-toggle="tooltip" data-placement="top" title="'+trad.delete+'" '+
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

  $(".newsAddComment").off().click(function(){
    var id = $(this).data("media-id");
    showCommentsTools(id);
  });
}

function initReactionTools(idObject, type){
  //$.each(news, function(e,v){
         $("#footer-"+type+"-"+idObject+' .reaction-news').faceMocion({
            emociones:[
             {"emocion":"love","TextoEmocion":trad.ilove, "class" : "amo", "color": "text-red" },
             {"emocion":"bothered","TextoEmocion":trad.bothering,"class" : "molesto", "color": "letter-red"},
             {"emocion":"scared","TextoEmocion":trad.scaring, "class" : "asusta", "color": "text-purple"},
             {"emocion":"enjoy","TextoEmocion":trad.enjoying, "class" : "divierte","color": "text-orange"},
             {"emocion":"like","TextoEmocion":trad.ilike, "class" : "gusta", "color": "letter-blue"},
             {"emocion":"sad","TextoEmocion":trad.sad, "class" : "triste", "color": "text-azure"},
             {"emocion":"amazed","TextoEmocion":trad.amazing, "class" : "asombro", "color":"text-brown"},
             {"emocion":"glad","TextoEmocion":trad.glad, "class" : "alegre", "color":"letter-green"}
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
  params=new Object,
  params.id=contentDiv.data("id"),
  params.collection=contentDiv.data("type"),
  params.action=action;
  if(notNull(detail)){
    params.details=detail;
  }
  
  if(method){
    params.unset=method;
  }
  mylog.log(params);
  $.ajax({
    url: baseUrl+'/'+moduleId+"/action/addaction/",
    data: params,
    type: 'post',
    global: false,
    dataType: 'json',
    success: 
      function(data) {
          if(!data.result){
                    toastr.error(data.msg);
                }
                else { 
                    if (data.userAllreadyDidAction) {
                      toastr.info(data.msg);
                    } else {
            //count = parseInt(contentDiv.data("count"));
            if(action=="reportAbuse"){
              toastr.success(trad["thanktosignalabuse"]);

              //to hide menu
              $(".newsReport[data-id="+params.id+"]").hide();
            }
            else{
                        if(count < count+data.inc)
                          toastr.success(trad["voteaddedsuccess"]);
                        else
                toastr.success(trad["voteremovedsuccess"]);  
            }                   
            //news.data( "count" , count+data.inc );
            //icon = news.children(".label").children(".fa").attr("class");
            //news.children(".label").html(news.data("count")+" <i class='"+icon+"'></i>");
          }
                }
            },
        error: 
          function(data) {
            toastr.error("Error calling the serveur : contact your administrator.");
          }
  });
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
  /*if ("undefined" != typeof newsObj.voteUp && "undefined" != typeof newsObj.voteUpCount && newsObj.voteUpCount > 0){ 
    voteUpCount = newsObj.voteUpCount;
    if ("undefined" != typeof newsObj.voteUp[idSession]){
      textUp= "text-green";
      $(".newsVoteDown[data-id="+idVote+"]").off();
    }
  }

  if ("undefined" != typeof newsObj.voteDown && "undefined" != typeof newsObj.voteDownCount && newsObj.voteDownCount > 0) {
    voteDownCount = newsObj.voteDownCount;
    if ("undefined" != typeof newsObj.voteDown[idSession]){
      textDown= "text-orange";
      $(".newsVoteUp[data-id="+idVote+"]").off();
    }
  }*/

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
  voteHtml += /*"<a href='javascript:;' class='newsVoteUp' onclick='newsVoteUp(this, \""+idVote+"\")' data-count='"+voteUpCount+"' data-id='"+idVote+"' data-type='"+mediaTarget+"'><span class='label "+textUp+"'>"+voteUpCount+" <i class='fa fa-thumbs-up'></i></span></a> "+
      "<a href='javascript:;' class='newsVoteDown' onclick='newsVoteDown(this, \""+idVote+"\")' data-count='"+voteDownCount+"' data-id='"+idVote+"' data-type='"+mediaTarget+"'><span class='label "+textDown+"'>"+voteDownCount+" <i class='fa fa-thumbs-down'></i></span></a>"+*/
      "<a href='javascript:;' class='newsReportAbuse' onclick='newsReportAbuse(this, \""+idVote+"\")' data-count='"+reportAbuseCount+"' data-id='"+idVote+"' data-type='"+mediaTarget+"'><span class='label "+textReportAbuse+"'>"+reportAbuseCount+" <i class='fa fa-flag'></i></span></a>";
  return voteHtml;
}



function bindEventTextArea(idTextArea, idComment, contextType, isAnswer, parentCommentId, commentUp){

    var idUx = (parentCommentId == "") ? idComment : parentCommentId;
    
    $(idTextArea).css('height', "34px");
    $("#container-txtarea-"+idUx).css('height', "34px");
    autosize($(idTextArea));

    $(idTextArea).on('keyup ', function(e){
      if(e.which == 13 && !e.shiftKey && $(idTextArea).val() != "" && $(idTextArea).val() != " " && !isUpdatedComment) {
        if(!mentionsInit.isSearching){
          //submit form via ajax, this is not JS but server side scripting so not showing here
          saveComment($(idTextArea).val(), parentCommentId, idTextArea);
          $(idTextArea).val("");
          $(idTextArea).css('height', "34px");
          var heightTxtArea = $(idTextArea).css("height");
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
      $(".commentVoteUp[data-id='"+commentId+"']").removeClass("text-green").data("voted", false);
      $(".commentVoteDown[data-id='"+commentId+"']").removeClass("text-orange").data("voted", false);
      $(".commentReportAbuse[data-id='"+commentId+"']").data("voted", false);

      var count = $(action+"[data-id='"+commentId+"']").data("countcomment");
      mylog.log("count 1", count);
      $(action+"[data-id='"+commentId+"']").data("countcomment", count-1);
      $(action+"[data-id='"+commentId+"'] .countC").html(count-1);
    }
    else{ //set
      mylog.log("disableOtherAction 2", method);
      $(".commentVoteUp[data-id='"+commentId+"']").removeClass("text-green").data("voted",true);
      $(".commentVoteDown[data-id='"+commentId+"']").removeClass("text-orange").data("voted",true);
      $(".commentReportAbuse[data-id='"+commentId+"']").data("voted",true);

      if (action == ".commentVoteUp") $(".commentVoteUp[data-id='"+commentId+"']").addClass("text-green");
      if (action == ".commentVoteDown") $(".commentVoteDown[data-id='"+commentId+"']").addClass("text-orange");
      if (action == ".commentReportAbuse") $(".commentReportAbuse[data-id='"+commentId+"']").addClass("text-red");

      var count = $(action+"[data-id='"+commentId+"']").data("countcomment");
      $(action+"[data-id='"+commentId+"']").data("countcomment", count+1);
      $(action+"[data-id='"+commentId+"'] .countC").html(count+1);
    }
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
          $('#item-comment-'+id+' .text-comment').html(newComment.text);
          toastr.success(data.msg);        
          }
        else
          toastr.error(data.msg);  
      },
      dataType: "json"
    });
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

            '<img src="'+profilThumbImageUrlUser+'" class="img-responsive pull-left" '+
            '  style="margin-right:10px;height:32px; border-radius:3px;">'+
          
            '<div class="ctnr-txtarea">';

    html +=   '<textarea rows="1" style="height:1em;" class="form-control textarea-new-comment" ' +
                      'id="textarea-new-comment'+parentCommentId+'" placeholder="'+trad.youranswer+'..."></textarea>' +
            
            '</div>' +
          '</div>';

    $("#comments-list-"+parentCommentId).prepend(html);

    bindEventTextArea('#textarea-new-comment'+parentCommentId, idComment, contextType, true, parentCommentId);
  }
