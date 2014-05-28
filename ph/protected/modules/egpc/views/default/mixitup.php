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

<section class="mt80 stepContainer">

<div class="controls">
  <label>Filter:</label>
 
  <button class="filter" data-filter="all">All</button>
   <?php
    $alltags = array(); 
    $blocks = "";
    $tagBlock = "";
    foreach ($groups as $key => $value) 
    {
      $name = $value["name"];
      $email =  (isset($value["email"])) ? $value["email"] : "";
      

      $tags = "";
      if(isset($value["tags"]))
      {
        foreach ($value["tags"] as $t) 
        {
          if(!in_array($t, $alltags)){
            array_push($alltags, $t);
            $tagBlock .= '<button class="filter" data-filter=".'.$t.'">'.$t.'</button>';
          }
          $tags .= $t.' ';
        }
      }
      $blocks .= ' <div class="mix '.$tags.'" data-myorder="'.$name.' '.$email.'" style="display:inline-blocks">'.$name.'<br/>'.$email.'<br/>'.$tasg.'</div>';
    }
    ?>
  <?php echo $tagBlock?>
  <label>Sort:</label>
  
  <button class="sort" data-sort="myorder:asc">Asc</button>
  <button class="sort" data-sort="myorder:desc">Desc</button>
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