<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/vis.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vis.min.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/crowd.jpg") repeat;}
  #mygraph {
    width: 100%;
    height: 350px;
    border: 1px solid lightgray;
  }
  .vis.timeline .item {
    border-color: #F991A3;
    font-size: 15pt;
    box-shadow: 5px 5px 20px rgba(128,128,128, 0.5);
  }
  #tags{padding: 10px;}
  .tags a, a.btn{
    display: block;
    float:left;
    background-color: yellow;
    padding:5px;
    border-radius: 3px;
    margin: 2px;
    text-decoration: none;
    color:#000;
    border:1px solid #000;
    font-weight:bold;
  }
  .tags a:hover{
    background-color: transparent;
    border-color:yellow; 
    color: yellow;
  }
  .tags a.off{
    background-color: grey;
  }
  a > i.fa{ 
    color: yellow;
    padding-right: 10px;
  }
  #notifications{
    padding: 10px;
  }
  .tar{text-align: right}
  .yellow{color: yellow}
  .cadre{border:1px solid yellow;margin-bottom:10px;width:60%;padding:10px;min-height:110px;}
  label {display:inline-block;width:120px;color:yellow;text-align: right;padding:3px;}
</style>
<section class="mt80 stepContainer">

  <div class="step home ">
    <div class="fr">
      <input type="text" id="search" placeholder="chercher"/> 
      <a href="javascript:alert('TODO : connect to API')"><i class="fa fa-search"></i></a>
      <?php $this->renderPartial( "tools" ); ?>
    </div>
    <div class="stepTitle">Reseau EGPC </div>
    
   
    
    <div style="clear:both;"></div>
  </div>
</section>