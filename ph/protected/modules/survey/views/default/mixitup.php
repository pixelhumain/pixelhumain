<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/protected/modules/egpc/css/mixitup/reset.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/protected/modules/egpc/css/mixitup/style.css');
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/crowd.jpg") repeat;}
</style>
<div class="title"><?php echo $title ?></div>
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
      $blocks .= ' <div class="mix '.$tags.' '.$cp.'" data-myorder="'.$name.' '.$email.'" style="display:inline-blocks">'.
                    $link.
                    $email.'<br/>'.
                    $tags.
                    '</div>';
    }
    ?>
  <?php echo $tagBlock?>
  <label>Sort:</label>
  
  <button class="sort" data-sort="myorder:asc">Asc</button>
  <button class="sort" data-sort="myorder:desc">Desc</button>
  
  <?php if(!isset($_GET["cp"]) && $value["type"]=="survey")
      {?>
  <label>Commune:</label>
  <?php echo $cpBlock; }?>

</div>
<div id="Container" class="container">
  
  <?php echo $blocks?>

  <div class="gap"></div>
  <div class="gap"></div>
</div>
</section>

  <script src='http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js?v=2.1.5'></script>
<script type="text/javascript">
  
  $(function(){
  $('#Container').mixItUp();
});
</script>