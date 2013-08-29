<style>
h2 {
    font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
ol.slats li {
    margin: 0 0 10px 0;
    padding: 0 0 10px 0;
    border-bottom: 1px solid #eee;
    }
ol.slats li:last-child {
    margin: 0;
    padding: 0;
    border-bottom: none;
    }
ol.slats li h3 {
    font-size: 18px;
    font-weight: bold;
    line-height: 1.1;
    }
ol.slats li h3 a img {
    float: left;
    margin: 0 10px 0 0;
    padding: 4px;
    border: 1px solid #eee;
    }
ol.slats li h3 a:hover img {
    background: #eee;
    }
ol.slats li p {
    margin: 0 0 0 76px;
    font-size: 14px;
    line-height: 1.4;
    }
ol.slats li p span.meta {
    display: block;
    font-size: 12px;
    color: #999;
    }        
        
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>MON COMPTE</h2>
    <p>Gérer vos données personnelles, connectez vos association et entreprise<br/>
    déclarer un evennement </p>
    <ol class="slats">
    
        <li class="group">
            <h3><a href="#participer"   target="_blank" role="button" data-toggle="modal">Mes données personnelles</a></h3>
        </li>
        
        <li class="group">
            <h3><a href="#association"   target="_blank" role="button" data-toggle="modal">Ma vie associative</a></h3>
        </li>
        
        <li class="group">
            <h3><a href="#entreprise"   target="_blank" role="button" data-toggle="modal">Entreprise</a></h3>
        </li>
        
    </ol>    
</div></div>
<script type="text/javascript"        >
initT['animInit'] = function(){
(function ani(){
      TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
};
</script>