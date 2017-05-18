
function initCommentsTools(thisMedias){ 
  //ajoute la barre de commentaire & vote up down signalement sur tous les medias
  $.each(thisMedias, function(key, media){
    if(typeof media._id != "undefined"){
        media.target = "news"; 
        
        var commentCount = 0;
        idMedia=media._id['$id']; //console.log("idMedia",idMedia);
        idMediaShare=media._id['$id']; 
        authorTypeMedia="citoyens";
        console.log(media);
        if(typeof media.author.id != "undefined")
          authorIdMedia=media.author.id;
        else
          authorIdMedia=media.author;
        if(typeof media.targetIsAuthor != "undefined"){
          authorIdMedia=media.target.id;
          authorTypeMedia=media.target.type;
        }
        //console.log("idMedia",idMedia);
        var typeMediaShare = "news";
        if(media.type=="activityStream") {
          idMediaShare = media.object.id;
          typeMediaShare = media.object.type;
        }

        if ("undefined" != typeof media.commentCount) 
          commentCount = media.commentCount;
        
        idSession = typeof idSession != "undefined" ? idSession : false;

        var lblCommentCount = '';
        if(commentCount == 0 && idSession) lblCommentCount = "<i class='fa fa-comment'></i>  Commenter";
        if(commentCount == 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> commentaire";
        if(commentCount > 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> commentaires";
        if(commentCount == 0 && !idSession) lblCommentCount = "0 <i class='fa fa-comment'></i> ";

        lblCommentCount = '<a href="javascript:" class="newsAddComment letter-blue" data-media-id="'+idMedia+'">' + lblCommentCount + '</a>';

        if(typeof media.scope.type != "undefined" && media.scope.type != "private")
        lblCommentCount =  lblCommentCount+
                           "<button class='text-dark btn btn-link no-padding margin-right-10 btn-share bold'"+
                              " style='margin-top:-3px;'" +
                              " data-id='"+idMediaShare+"' data-type='"+typeMediaShare+"' data-author-id='"+authorIdMedia+"' data-author-type='"+authorTypeMedia+"'>"+
                              "<i class='fa fa-share'></i> Partager"+
                           "</button>";


        var voteTools = voteCheckAction(media._id['$id'], media);

        voteTools = lblCommentCount + voteTools;

        $("#footer-media-"+media._id['$id']).html(voteTools);

    }
  });

  initBtnShare();

  $(".newsAddComment").click(function(){
    var id = $(this).data("media-id");
    showCommentsTools(id);
  });
}


//lance le chargement des commentaires pour une publication
function showCommentsTools(id){
    if(!$("#commentContent"+id).hasClass("hidden")){
      $(".commentContent").html("");
      $(".commentContent").removeClass("hidden");   
      
      $('#commentContent'+id).html('<div class="text-dark margin-bottom-10"><i class="fa fa-spin fa-refresh"></i> Chargement des commentaires ...</div>');
      getAjax('#commentContent'+id ,baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+id,function(){ 
        
      },"html");
    }else{
      $("#commentContent"+id).removeClass("hidden");    
      mylog.log("scroll TO : ", $('#newsFeed'+id).position().top);
      
    }
}

function voteCheckAction(idVote, newsObj) {
  var voteUpCount = reportAbuseCount = voteDownCount = 0;
  textUp="text-dark";
  textDown="text-dark";
  textReportAbuse="text-dark";

  if ("undefined" != typeof newsObj.voteUp && "undefined" != typeof newsObj.voteUpCount && newsObj.voteUpCount > 0){ 
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
  }

  if ("undefined" != typeof newsObj.reportAbuse && "undefined" != typeof newsObj.reportAbuseCount && newsObj.reportAbuseCount > 0) {
    reportAbuseCount = newsObj.reportAbuseCount;
    if ("undefined" != typeof newsObj.reportAbuse[idSession]){
      textReportAbuse= "text-red";
      $(".newsReportAbuse[data-id="+idVote+"]").off();
    }
  }
  voteHtml = "<a href='javascript:;' class='newsVoteUp' onclick='newsVoteUp(this, \""+idVote+"\")' data-count='"+voteUpCount+"' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label "+textUp+"'>"+voteUpCount+" <i class='fa fa-thumbs-up'></i></span></a> "+
      "<a href='javascript:;' class='newsVoteDown' onclick='newsVoteDown(this, \""+idVote+"\")' data-count='"+voteDownCount+"' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label "+textDown+"'>"+voteDownCount+" <i class='fa fa-thumbs-down'></i></span></a>"+
      "<a href='javascript:;' class='newsReportAbuse' onclick='newsReportAbuse(this, \""+idVote+"\")' data-count='"+reportAbuseCount+"' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label "+textReportAbuse+"'>"+reportAbuseCount+" <i class='fa fa-flag'></i></span></a>";
  return voteHtml;
}