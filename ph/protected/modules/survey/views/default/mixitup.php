<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/protected/modules/egpc/css/mixitup/reset.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/protected/modules/egpc/css/mixitup/style.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/faces3.jpg") repeat;}
</style>
<div class="title"><?php echo $title?>
  <br/>
  <?php if( isset( Yii::app()->session["userId"])){ 
    $user = Yii::app()->mongodb->citoyens->findOne ( array("_id"=>new MongoId ( Yii::app()->session["userId"] ) ) );
    echo "connected as : ".$user["email"];?>
  <?php } else {?>
    <a href="">se Connecter</a>
  <?php } ?>
</div>
<section class="mt80 stepContainer">

<div class="controls">
  <label>Filter:</label>
  <button class="filter" data-filter="all">All</button>
   <?php
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
          $cpBlock .= '<button class="filter" data-filter=".'.$value["cp"].'">'.$value["cp"].'</button>';
          array_push($cps, $value["cp"]);
        }
      }

      $tags = "";
      if(isset($value["tags"]))
      {
        foreach ($value["tags"] as $t) 
        {
          if(!in_array($t, $alltags))
          {
            array_push($alltags, $t);
            $tagBlock .= '<button class="filter" data-filter=".'.$t.'">'.$t.'</button>';
          }
          $tags .= $t.' ';
        }
      }

      $cp = ($value["type"]=="survey") ? $value["cp"] : "" ; 
      $count = Yii::app()->mongodb->surveys->count ( array("type"=>"entry","survey"=>(string)$value["_id"]) );
      $link = ($count) ? '<a href="'.Yii::app()->createUrl("/survey/default/entries/surveyId/".(string)$value["_id"]).'">'.$name.' ('.$count.')</a><br/>' : $name.'<br/>';
      
      //has loged user voted on this entry 
      //vote UPS
      $voteUpActive = (isset( Yii::app()->session["userId"]) && isset($value[Citoyen::ACTION_VOTE_UP]) && in_array(Yii::app()->session["userId"], $value[Citoyen::ACTION_VOTE_UP])) ? "active":"";
      $voteUpCount = (isset($value[Citoyen::ACTION_VOTE_UP."Count"])) ? $value[Citoyen::ACTION_VOTE_UP."Count"] : 0 ;
      $hrefUp = (isset( Yii::app()->session["userId"]) && empty($voteUpActive)) ? "javascript:addaction('".$value["_id"]."','".Citoyen::ACTION_VOTE_UP."')" : "";
      
      //vote ABSTAIN 
      $voteAbstainActive = (isset( Yii::app()->session["userId"]) && isset($value[Citoyen::ACTION_VOTE_ABSTAIN]) && in_array(Yii::app()->session["userId"], $value[Citoyen::ACTION_VOTE_ABSTAIN])) ? "active":"";;
      $voteAbstainCount = (isset($value[Citoyen::ACTION_VOTE_ABSTAIN."Count"])) ? $value[Citoyen::ACTION_VOTE_ABSTAIN."Count"] : 0 ;
      $hrefAbstain = (isset( Yii::app()->session["userId"]) && empty($voteAbstainActive)) ? "javascript:addaction('".(string)$value["_id"]."','".Citoyen::ACTION_VOTE_ABSTAIN."')" : "";
      
      //vote DOWN 
      $voteDownActive = (isset( Yii::app()->session["userId"]) && isset($value[Citoyen::ACTION_VOTE_DOWN]) && in_array(Yii::app()->session["userId"], $value[Citoyen::ACTION_VOTE_DOWN])) ? "active":"";;
      $voteDownCount = (isset($value[Citoyen::ACTION_VOTE_DOWN."Count"])) ? -$value[Citoyen::ACTION_VOTE_DOWN."Count"] : 0 ;
      $hrefDown = (isset( Yii::app()->session["userId"]) && empty($voteDownActive)) ? "javascript:addaction('".(string)$value["_id"]."','".Citoyen::ACTION_VOTE_DOWN."')" : "";
      
      //votes cannot be changed, link become spans
      if( !empty($voteUpActive) || !empty($voteAbstainActive) || !empty($voteDownActive)){
        $linkVoteUp = (isset( Yii::app()->session["userId"]) && !empty($voteUpActive) ) ? "<span class='".$voteUpActive." ".$value["_id"].Citoyen::ACTION_VOTE_UP."' ><i class='fa fa-thumbs-up' ></i></span>" : "";
        $linkVoteAbstain = (isset( Yii::app()->session["userId"]) && !empty($voteAbstainActive)) ? "<span class='".$voteAbstainActive." ".$value["_id"].Citoyen::ACTION_VOTE_ABSTAIN."'><i class='fa fa-circle'></i></span>" : "";
        $linkVoteDown = (isset( Yii::app()->session["userId"]) && !empty($voteDownActive)) ? "<span class='".$voteDownActive." ".$value["_id"].Citoyen::ACTION_VOTE_DOWN."' ><i class='fa fa-thumbs-down '></i></span>" : "";
      }else{
        $linkVoteUp = (isset( Yii::app()->session["userId"])  ) ? "<a class='".$voteUpActive." ".$value["_id"].Citoyen::ACTION_VOTE_UP."' href=\" ".$hrefUp." \" title='".$voteUpCount." Pour'><i class='fa fa-thumbs-up' ></i></a>" : "";
        $linkVoteAbstain = (isset( Yii::app()->session["userId"]) ) ? "<a class='".$voteAbstainActive." ".$value["_id"].Citoyen::ACTION_VOTE_ABSTAIN."' href=\"".$hrefAbstain."\" title=' ".$voteAbstainCount."Abstention'><i class='fa fa-circle'></i></a>" : "";
        $linkVoteDown = (isset( Yii::app()->session["userId"])) ? "<a class='".$voteDownActive." ".$value["_id"].Citoyen::ACTION_VOTE_DOWN."' href=\"".$hrefDown."\" title='".$voteDownCount." Contre'><i class='fa fa-thumbs-down '></i></a>" : "";
      }

      $content = ($value["type"]=="entry") ? "<br/>".$value["message"]:"";
      $voteLinks = ($value["type"]=="entry") ? "<br/><br/><div class='votelinks'>".$linkVoteUp." ".$linkVoteAbstain." ".$linkVoteDown."</div>" : "";
      $ordre = $voteUpCount-$voteDownCount;
      $created = (isset($value["created"])) ? $value["created"] : 0; 
      $blocks .= ' <div class="mix '.$tags.' '.$cp.'" data-vote="'.$ordre.'"  data-time="'.$created.'" style="display:inline-blocks">'.
                    $link.
                    $email.'<br/>'.
                    $tags.
                    $content.
                    $voteLinks.
                    '</div>';
    }
    ?>
  <?php echo $tagBlock?>
  <label>Vote:</label>
  <button class="sort" data-sort="vote:asc">Asc</button>
  <button class="sort" data-sort="vote:desc">Desc</button>
  <label>Temps:</label>
  <button class="sort" data-sort="time:asc">Asc</button>
  <button class="sort" data-sort="time:desc">Desc</button>
  
  <?php if(!isset($_GET["cp"]) && $where["type"]=="survey")
      {?>
  <label>Commune:</label>
  <?php echo $cpBlock; }?>

</div>
<div id="mixcontainer" class="mixcontainer">
  
  <?php echo $blocks?>

  <div class="gap"></div>
  <div class="gap"></div>
</div>
</section>

  <script src='http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js?v=2.1.5'></script>
<script type="text/javascript">
  
  $(function(){
  $('#mixcontainer').mixItUp({
    load: {
      sort: 'vote:desc'
    }
  });
});
  function addaction(id,action){
      if(confirm("Vous êtes sûr, ce vote sera final ?")){
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
</script>