<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/protected/modules/egpc/css/mixitup/reset.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/protected/modules/egpc/css/mixitup/style.css');
$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.sparkline.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;

$commentActive = true;
?>

<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/cloud.jpg") repeat;}
  .connect{ opacity: 0.9;background-color: #000; margin-bottom: 10px;border:1px solid #3399FF;width: 100%;padding: 10px }
  button.filter,button.sort{color:#000;}
  .leftlinks{float: left}
  .rightlinks{float: right}
  a.btn{margin:3px;}
  .mix{border-radius: 8px;}
  /*.infolink{border-top:1px solid #fff}*/
</style>
<section class="mt80 stepContainer">
  <div class="connect btn">
    <div style="color:#3399FF;float:left;font-size: xx-large;font-weight: bold">
      <?php echo $this::moduleTitle." : ".$title;
       if(isset($_GET["cp"])) echo " ".$_GET["cp"]?>
    </div>
    
  <?php if( isset( Yii::app()->session["userId"])){ 
    $user = Yii::app()->mongodb->citoyens->findOne ( array("_id"=>new MongoId ( Yii::app()->session["userId"] ) ) );
    ?>
    <a href="#participer" class="btn" role="button" data-toggle="modal" title="mon compte" ><i class="icon-cog-1"></i><?php echo  $user["email"];?></a>
    <a href="/ph/site/logout" class="btn " role="button" data-toggle="modal" title="deconnexion" ><i class="fa fa-signout"></i>Logout</a>
    
  <?php } else {?>
    <a href="#loginForm" class="btn " role="button" data-toggle="modal" title="connexion" ><i class="fa fa-signin"></i>Se Connecter pour voter</a>
  <?php } ?>
  </div>
<?php if( isset( Yii::app()->session["userId"]) && $where["type"]=="entry"){ ?>
  <div class="connect" style="margin-right: 50px;">
    <a href="#proposerloiForm" class="btn " role="button" data-toggle="modal" title="proposer une loi" ><i class="fa fa-signout"></i>Proposer</a>
    <textarea id="message1" style="width:45%;height:30px;vertical-align: middle" onkeyup="AutoGrowTextArea(this);$('#message').val($('#message1').val());"></textarea>
    <a href="#proposerloiForm" class="btn " role="button" data-toggle="modal" title="proposer une loi" title="envoyer" >Envoyer</a>
  </div>
<?php } ?>
<div class="controls">
  <?php
  if($where["type"]=="entry"){?>
  <a href="#voterloiDescForm" class="btn " role="button" data-toggle="modal" title="proposer une loi" ><i class="fa fa-signout"></i>Voter les propositions</a>
  <?php }
    $alltags = array(); 
    $blocks = "";
    $tagBlock = "";
    $cpBlock = "";
    $cps = array();
    foreach ($list as $key => $value) 
    {
      $name = $value["name"];
      $email =  (isset($value["email"])) ? $value["email"] : "";
      if( !isset($_GET["cp"]) && $value["type"]=="survey" )
      {
        if(!in_array($value["cp"], $cps)){
          $cpBlock .= ' <button class="filter " data-filter=".'.$value["cp"].'">'.$value["cp"].'</button>';
          array_push($cps, $value["cp"]);
        }
      }

      $tags = "";
      if(isset($value["tags"]))
      {
        foreach ($value["tags"] as $t) 
        {
          if(!empty($t) && !in_array($t, $alltags))
          {
            array_push($alltags, $t);
            $tagBlock .= ' <button class="filter " data-filter=".'.$t.'">'.$t.'</button>';
          }
          $tags .= $t.' ';
        }
      }

      $cp = ($value["type"]=="survey") ? $value["cp"] : "" ; 
      $count = Yii::app()->mongodb->surveys->count ( array("type"=>"entry","survey"=>(string)$value["_id"]) );
      $link = $name;
      
      //check if I wrote this law
      $meslois = (isset( Yii::app()->session["userId"]) && Yii::app()->session["userEmail"] && $value['email'] == Yii::app()->session["userEmail"]) ? "myentries" : "";
      
      //checks if the user is a follower of the entry
      $followingEntry = (isset( Yii::app()->session["userId"]) 
                        && isset($value[Action::ACTION_FOLLOW]) 
                        && is_array($value[Action::ACTION_FOLLOW]) 
                        && in_array(Yii::app()->session["userId"], $value[Action::ACTION_FOLLOW])) ? "myentries":"";
      

      if ($value["type"]=="survey" && $count)
        $link = '<a class="btn '.$meslois.'" href="'.Yii::app()->createUrl("/survey/default/entries/surveyId/".(string)$value["_id"]).'">'.$name.' ('.$count.')</a>' ;
      else if ($value["type"]=="entry")
        $link = '<a class="btn '.$meslois.'" onclick="entryDetail(\''.Yii::app()->createUrl("/survey/default/entry/surveyId/".(string)$value["_id"]).'\')" href="javascript:;">'.$name.'</a>' ;
      
      //$infoslink bring visual detail about the entry
      $infoslink = "";
      $infoslink .= (!empty($followingEntry)) ? "<i class='fa fa-rss infolink' ></i>" :"";
      $infoslink .= (!empty($meslois)) ? "<i class='fa fa-user infolink' ></i>" :"";

      //has loged user voted on this entry 
      //vote UPS
      $voteUpActive = ( isset( Yii::app()->session["userId"]) 
                     && isset($value[Action::ACTION_VOTE_UP])
                     && is_array($value[Action::ACTION_VOTE_UP]) 
                     && in_array( Yii::app()->session["userId"] , $value[Action::ACTION_VOTE_UP] )) ? "active":"";
      $voteUpCount = (isset($value[Action::ACTION_VOTE_UP."Count"])) ? $value[Action::ACTION_VOTE_UP."Count"] : 0 ;
      $hrefUp = (isset( Yii::app()->session["userId"]) && empty($voteUpActive)) ? "javascript:addaction('".$value["_id"]."','".Action::ACTION_VOTE_UP."')" : "";
      
      //vote ABSTAIN 
      $voteAbstainActive = (isset( Yii::app()->session["userId"]) 
                        && isset($value[Action::ACTION_VOTE_ABSTAIN])
                        && is_array($value[Action::ACTION_VOTE_ABSTAIN])
                        && in_array(Yii::app()->session["userId"], $value[Action::ACTION_VOTE_ABSTAIN])) ? "active":"";
      $voteAbstainCount = (isset($value[Action::ACTION_VOTE_ABSTAIN."Count"])) ? $value[Action::ACTION_VOTE_ABSTAIN."Count"] : 0 ;
      $hrefAbstain = (isset( Yii::app()->session["userId"]) && empty($voteAbstainActive)) ? "javascript:addaction('".(string)$value["_id"]."','".Action::ACTION_VOTE_ABSTAIN."')" : "";
      
      //vote DOWN 
      $voteDownActive = (isset( Yii::app()->session["userId"]) 
                        && isset($value[Action::ACTION_VOTE_DOWN]) 
                        && is_array($value[Action::ACTION_VOTE_DOWN]) 
                        && in_array(Yii::app()->session["userId"], $value[Action::ACTION_VOTE_DOWN])) ? "active":"";
      $voteDownCount = (isset($value[Action::ACTION_VOTE_DOWN."Count"])) ? -$value[Action::ACTION_VOTE_DOWN."Count"] : 0 ;
      $hrefDown = (isset( Yii::app()->session["userId"]) && empty($voteDownActive)) ? "javascript:addaction('".(string)$value["_id"]."','".Action::ACTION_VOTE_DOWN."')" : "";
      

      //votes cannot be changed, link become spans
      $avoter = "mesvotes";
      if( !empty($voteUpActive) || !empty($voteAbstainActive) || !empty($voteDownActive)){
        $linkVoteUp = (isset( Yii::app()->session["userId"]) && !empty($voteUpActive) ) ? "<span class='".$voteUpActive." ".$value["_id"].Action::ACTION_VOTE_UP."' ><i class='fa fa-thumbs-up' ></i></span>" : "";
        $linkVoteAbstain = (isset( Yii::app()->session["userId"]) && !empty($voteAbstainActive)) ? "<span class='".$voteAbstainActive." ".$value["_id"].Action::ACTION_VOTE_ABSTAIN."'><i class='fa fa-circle'></i></span>" : "";
        $linkVoteDown = (isset( Yii::app()->session["userId"]) && !empty($voteDownActive)) ? "<span class='".$voteDownActive." ".$value["_id"].Action::ACTION_VOTE_DOWN."' ><i class='fa fa-thumbs-down '></i></span>" : "";
      }else{
        $avoter = "avoter";
        $linkVoteUp = (isset( Yii::app()->session["userId"])  ) ? "<a class='btn ".$voteUpActive." ".$value["_id"].Action::ACTION_VOTE_UP."' href=\" ".$hrefUp." \" title='".$voteUpCount." Pour'><i class='fa fa-thumbs-up' ></i></a>" : "";
        $linkVoteAbstain = (isset( Yii::app()->session["userId"]) ) ? "<a class='btn ".$voteAbstainActive." ".$value["_id"].Action::ACTION_VOTE_ABSTAIN."' href=\"".$hrefAbstain."\" title=' ".$voteAbstainCount."Abstention'><i class='fa fa-circle'></i></a>" : "";
        $linkVoteDown = (isset( Yii::app()->session["userId"])) ? "<a class='btn ".$voteDownActive." ".$value["_id"].Action::ACTION_VOTE_DOWN."' href=\"".$hrefDown."\" title='".$voteDownCount." Contre'><i class='fa fa-thumbs-down '></i></a>" : "";
      }
      $hrefComment = "#commentsForm";
      $commentCount = 0;
      $linkComment = (isset( Yii::app()->session["userId"]) && $commentActive) ? "<a class='btn ".$value["_id"].Action::ACTION_COMMENT."' role='button' data-toggle='modal' href=\"".$hrefComment."\" title='".$commentCount." Commentaire'><i class='fa fa-comments '></i></a>" : "";
      $totalVote = $voteUpCount+$voteAbstainCount+$voteDownCount;

      $content = ($value["type"]=="entry") ? "".$value["message"]:"";
      $leftLinks = ($value["type"]=="entry") ? "<div class='leftlinks'>".$linkVoteUp." ".$linkVoteAbstain." ".$linkVoteDown."</div>" : "";
      $graphLink = ' <a href="#graphForm" role="button" data-toggle="modal" class="btn">'.$voteUpCount.','.$voteAbstainCount.','.$voteDownCount.'</a> ';
      $rightLinks = ($value["type"]=="entry") ? "<div class='rightlinks'>".$graphLink.$linkComment.$infoslink."</div>" : "";
      $ordre = $voteUpCount-$voteDownCount;
      $created = (isset($value["created"])) ? $value["created"] : 0; 
      $blocks .= ' <div class="mix '.$avoter.' '.$meslois.' '.$followingEntry.' '.$tags.' '.$cp.'" data-vote="'.$ordre.'"  data-time="'.$created.'" style="display:inline-blocks"">'.
                    $link.'<br/>'.
                    //$email.'<br/>'.
                    //$tags.
                    //$content.
                    '<br/>'.
                    $leftLinks.
                    $rightLinks.
                    '</div>';
    }
    ?>

  <label>Classement:</label>
  <button class="sort " data-sort="vote:asc">Asc</button>
  <button class="sort " data-sort="vote:desc">Desc</button>
  <label>Chronos:</label>
  <button class="sort " data-sort="time:asc">Asc</button>
  <button class="sort " data-sort="time:desc">Desc</button>
  
  <?php if(!isset($_GET["cp"]) && $where["type"]=="survey")
      {?>
  <label>Commune:</label>
  <?php echo $cpBlock; }?>

  <br/>
  <label>Filtre:</label>
  <a class="filter btn" data-filter=".avoter">A voter</a>
  <a class="filter btn" data-filter=".mesvotes">Mes votes</a>
  <a class="filter btn" data-filter=".myentries">Mes lois</a>
  <button class="filter" data-filter="all">Tout</button>
  <?php echo $tagBlock?>

</div>
<div id="mixcontainer" class="mixcontainer">
  <?php echo $blocks?>
</div>
</section>

  <script src='http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js?v=2.1.5'></script>
<script type="text/javascript">
  
  $(function(){
    $('#mixcontainer').mixItUp({load: {sort: 'vote:desc'}});
    $('.inlinebar').sparkline('html', {type: 'pie'} );
});
  function entryDetail(url){
    testitget( null , url , function(data){
      log(data.content);
      $("#flashInfoContent").html(data.content);
      $("#flashInfoLabel").html(data.title);
      $("#flashInfo").modal('show');
    } );
  }
  function addaction(id,action){
      if(confirm("Vous êtes sûr ?")){
        params = { 
             "email" : '<?php echo Yii::app()->session["userEmail"]?>' , 
             "id" : id ,
             "collection":"surveys",
             "action" : action 
             };
        testitpost(null,'/ph/<?php echo $this::$moduleKey?>/api/addaction',params,function(data){
        window.location.reload();
        });
    }
    }
    function dejaVote(){
      alert("Vous ne pouvez pas votez 2 fois, ni changer de vote.");
    }
    function AutoGrowTextArea(textField)
{
  if (textField.clientHeight < textField.scrollHeight)
  {
    textField.style.height = textField.scrollHeight + "px";
    if (textField.clientHeight < textField.scrollHeight)
    {
      textField.style.height = 
        (textField.scrollHeight * 2 - textField.clientHeight) + "px";
    }
  }
}
</script>
<?php
if($where["type"]=="entry"){
  $this->renderPartial('application.modules.'.$this::$moduleKey.'.views.default.modals.proposerloi',array("survey"=>$where["survey"]));
  $this->renderPartial('application.modules.'.$this::$moduleKey.'.views.default.modals.voterloiDesc');
  if($commentActive)
    $this->renderPartial('application.modules.'.$this::$moduleKey.'.views.default.modals.comments');
  $this->renderPartial('application.modules.'.$this::$moduleKey.'.views.default.modals.graph');
}
?>