<style>
.portfolio-modal .modal-content img{
    margin-bottom: 0px;
}

#modalFavorites .btn-favory .fa-star-o{
    display: none;
}
#modalFavorites .btn-favory .fa-star{
    display: inline;
}
#modalFavorites .btn-favory:hover{
    text-decoration: none;
}
#modalFavorites .btn-favory:hover .fa-star{
    display: none;
}
#modalFavorites .btn-favory:hover .fa-star-o{
    display: inline;
}
.div-fav{
    height:50px;
    max-height:50px;
}

</style>
<div class="portfolio-modal modal fade" id="modalFavorites" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="">
                <div class="col-lg-12">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="50" class="inline margin-top-25 margin-bottom-5"><br>
                    <h3 class="letter-red no-margin hidden-xs" style="">
                        Vos favoris<br>
                    </h3>
                    <h5 class="text-dark no-margin" style="margin-top:5px!important;">
                        Conservez tous les sites web que vous utilisez souvent,<br>et ne les cherchez plus !
                        <hr>
                    </h5>
                    <br>
                    
                    
                </div>
               
            </div>

            <div class="col-md-12 padding-25" id="listFav">
                <?php  if(empty(@$myWebFavorites)) { ?>
                <b>Vous n'avez aucun site dans vos favoris.</b>
                <hr>
                Pour remplir votre liste de favoris, utiliser le moteur de recherche,<br>et cliquez sur <i class="fa fa-star letter-yellow"></i> pour ajouter un site à votre liste.
                <?php }else { ?>
                    <?php  

                        foreach ($myWebFavorites as $key => $siteurl) { 
                            $side = "left";// ? $side="left" : $side="right";
                    ?>
                        <div class="col-md-6 div-fav margin-bottom-15 text-<?php echo $side; ?>" id="fav<?php echo $siteurl["_id"]; ?>">

                            <a href="#co2.web" class="btn-favory tooltips" data-idFav="<?php echo $siteurl['_id']; ?>" 
                                    data-placement="top" data-toggle="tooltip" title="Supprimer des favoris">
                                <i class="fa fa-star-o"></i><i class="fa fa-star letter-yellow"></i>
                            </a>
                            
                            <a class="siteurl_title letter-blue elipsis" target="_blank" href="<?php echo $siteurl["url"]; ?>">
                                <?php if(@$siteurl["favicon"]){ ?>
                                    <img src='<?php echo $siteurl["favicon"]; ?>' height=17 class="margin-right-5" style="margin-top:-6px;" alt="">
                                <?php } ?> 
                                <?php echo $siteurl["title"]; ?>
                            </a><br>
                            <span class="siteurl_hostname letter-green elipsis"><?php echo $siteurl["url"]; ?></span><br>

                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <hr>
                    <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                </div>

            </div>
        </div>
    </div>
</div>