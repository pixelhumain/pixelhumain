<?php
/* @var $this SiteController */
/* @var $error array */
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<style>
#error{
font-family: "Homestead";
}
#error h1 {
  position:relative;
  top:50px;
  left:100px;
  color: #E6334C;
  font-family: "Homestead";
}
#error h2 {
  position:relative;
  top:70px;
  left:100px;
  color: #324553;
  
}
</style>

<div class="container" id="accueil">
    <br/>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div >
      
    	<div id="error" class="center">
            
            <h1>ERREUR PAGE</h1>
            <h1>PAGE INCONNUE</h1>
            <h1>DU PIXEL HUMAIN</h1>
            <h2>QUI CHERCHE FINIT PAR TROUVER</h2>

            <?php echo CHtml::encode($message); ?>
        </div>
        <div class="clear"></div>
        <br/><br/>
    </div>
</div>

<script>
initT['animError'] = function(){
(function ani(){
		//TweenMax.to("#logoERror",  3, {left:"440px", ease:Bounce.easeOut});
	  TweenMax.staggerFromTo("#logoERror", 7, {scaleX:0, scaleY:0}, {scaleX:1, scaleY:1},1);
	  TweenMax.staggerFromTo("#error h1", 7, {scaleX:0, scaleY:0}, {scaleX:1.5, scaleY:1.5},1);
	  //TweenMax.staggerFromTo("#error h1", 2, {alpha:1}, {alpha:0.7, delay:0.7},1);
	  TweenMax.staggerFromTo("#error h2", 7, {scaleX:0, scaleY:0}, {scaleX:1.2, scaleY:1.2},1);
	})();
};
</script>