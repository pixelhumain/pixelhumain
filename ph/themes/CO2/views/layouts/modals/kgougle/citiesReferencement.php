
<div class="portfolio-modal modal fade" id="portfolioModalCities" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-university fa-2x"></i><br>Sélectionner une commune</h2>
                        <hr>
                        <?php foreach(array("GN", "Sud", "Nord", "Iles") as $province){ ?>
                            <?php foreach($cities[$province] as $city){ ?>
                            	<div class="col-md-3">
                            		<button class="btn btn-scope" data-dismiss="modal"
                            				data-name="<?php echo $city["name"]; ?>"
                                            data-city="<?php echo $city["name"]; ?>"
                                            data-country="<?php echo $city["country"]; ?>"
                                            data-insee="<?php echo $city["insee"]; ?>"
                                            data-cp="<?php echo $city["postalCodes"][0]["postalCode"]; ?>"
                            				data-lat="<?php echo $city["geo"]["latitude"]; ?>"
                            				data-lng="<?php echo $city["geo"]["longitude"]; ?>"
                                            data-locid="<?php echo $city["_id"]; ?>"
                                            data-id="<?php echo $city["_id"]; ?>"
                                            data-level1="<?php echo $city["level1"]; ?>"
                                            data-level1Name="<?php echo $city["level1Name"]; ?>"
                                            data-level3="<?php echo $city["level3"]; ?>"
                                            data-level3Name="<?php echo $city["level3Name"]; ?>"
                                            data-level4="<?php echo $city["level4"]; ?>"
                                            data-level4Name="<?php echo $city["level4Name"]; ?>"
                                            
                                            >
                            			<i class="fa fa-bullseye"></i> <?php echo $city["name"]; ?>
                            		</button> 
                            	</div>
                            <?php } ?>
                        <?php } ?>
                        <div class="col-md-12 text-center"><hr>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>