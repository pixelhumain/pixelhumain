
<?php $cities = CO2::getCitiesNewCaledonia(); ?>
<div class="portfolio-modal modal fade" id="modalLocalization" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="col-lg-10 col-lg-offset-1">
            <div class="row">
                <div class="col-lg-12">
                    
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="50" class="inline margin-top-25 margin-bottom-5"><br>
                    <hr>
                    <h3 class="letter-red no-margin hidden-xs" style="">
                        Selectionnez votre commune<br>
                        <small>Être localisé vous permet de capter en direct les informations pertinentes qui se trouvent autour de vous</small>
                    </h3>
                    
                    
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h4 class="title-scope"><i class="fa fa-angle-down"></i> Grand Nouméa</h4>
                    <?php foreach($cities["GN"] as $city){ //var_dump($city); ?>
                        
                        <div class="inline-block margin-bottom-15">
                            <button class="btn btn-scope item-scope-select item-scope-city disabled" 
                                    data-scope-value="<?php echo $city["_id"]; ?>"
                                    data-scope-zone="GN"
                                    data-scope-name="<?php echo $city["name"]; ?>"
                                    >
                                <h5 class="margin-5">
                                    <i class="fa fa-bullseye"></i> 
                                    <?php echo $city["name"]; ?><br>
                                    <small class="kanakName"><i><?php echo @$city["kanakName"]; ?></i></small><br>
                                    <small class="aireKanakName"><i><?php echo @$city["level4Name"]; ?></i></small>
                                </h5>
                            </button>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <h4 class="title-scope"><i class="fa fa-angle-down"></i> Les îles</h4>
                    <?php foreach($cities["Iles"] as $city){  ?>
                        <div class="inline-block margin-bottom-15">
                            <button class="btn btn-scope item-scope-select item-scope-city disabled" 
                                    data-scope-value="<?php echo $city["_id"]; ?>"
                                    data-scope-zone="Iles"
                                    data-scope-name="<?php echo $city["name"]; ?>"
                                    >
                                <h5 class="margin-5">
                                    <i class="fa fa-bullseye"></i> 
                                    <?php echo $city["name"]; ?><br>
                                    <small class="kanakName"><i><?php echo @$city["kanakName"]; ?></i></small><br>
                                    <small class="aireKanakName"><i><?php echo @$city["level4Name"]; ?></i></small>
                                </h5>
                            </button>
                        </div>
                    <?php } ?>
                </div>  
            </div>
            <div class="row ">
                <!-- <h4>Grande Terre<br><i class="fa fa-angle-down"></i></h4> -->
                
                <div class="">
                    <div class="modal-body text-left no-padding">
                        <!-- <h2 class="text-red"><i class="fa fa-bullseye fa-2x"></i><br>
                        <span class="text-dark">Filtrer par</span> commune</h2> -->
                        
                        <?php foreach(array("Sud", "Nord") as $province){ ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 padding-50">
                            <h4 class="text-center title-scope">
                                <i class="fa fa-angle-down"></i> Province <?php echo $province; ?>
                            </h4>
                            <?php foreach($cities[$province] as $city){ ?>
                                <div class="col-md-3 col-sm-6 col-xs-6 text-center margin-bottom-15">
                                    <div class="inline-block">
                                        <button class="btn btn-scope item-scope-select item-scope-city disabled" 
                                                data-scope-value="<?php echo $city["_id"]; ?>"
                                                data-scope-zone="<?php echo $province; ?>" 
                                    			data-scope-name="<?php echo $city["name"]; ?>"
                                                >
                                            <h5 class="margin-5">
                                                <i class="fa fa-bullseye"></i> 
                                                <?php echo $city["name"]; ?><br>
                                                <small class="kanakName"><i><?php echo @$city["kanakName"]; ?></i></small><br>
                                                <small class="aireKanakName"><i><?php echo @$city["level4Name"]; ?></i></small>
                                            </h5>
                                        </button>
                                </div>
                                </div>
                            <?php } ?>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
            <div class="row links-main-menu">
              
            </div>
        </div>
    </div>
</div>


<script>
	
	var cities = <?php echo json_encode( $cities ) ?>;
	jQuery(document).ready(function() {
		$(".item-scope-city").click(function(){
			var zone = $(this).data("scope-zone");
			var myCityId = $(this).data("scope-value");
			var name = cities[zone][myCityId].name;
			var myCity = cities[zone][myCityId];
			//console.log("myCity", myCity);

			var address = {
				address : {
					"codeInsee" 	  : myCity.insee,
					"addressCountry"  : myCity.country,
					"postalCode" 	  : myCity.postalCodes[0].postalCode,
					"addressLocality" : myCity.name,
					"streetAddress"   : "",
					"localityId" 	  : myCityId,

					"level1" 	 : typeof myCity.level1 	!= "undefined" ? myCity.level1 		: "",
					"level1Name" : typeof myCity.level1Name != "undefined" ? myCity.level1Name  : "",
					"level2" 	 : typeof myCity.level2 	!= "undefined" ? myCity.level2 		: "",
					"level2Name" : typeof myCity.level2Name != "undefined" ? myCity.level2Name  : "",
					"level3" 	 : typeof myCity.level3 	!= "undefined" ? myCity.level3 		: "",
					"level3Name" : typeof myCity.level3Name != "undefined" ? myCity.level3Name  : "",
					"level4" 	 : typeof myCity.level4 	!= "undefined" ? myCity.level4 		: "",
					"level4Name" : typeof myCity.level4Name != "undefined" ? myCity.level4Name  : "",
				},
				geo : myCity.geo,
				geoPosition : myCity.geoPosition,
			}
			//console.log("new address : ", address);

			var params = {
				name : "locality",
				value : address,
				pk : contextData.id,
				type : contextData.type
			};
			
			if(userId != ""){
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextData.type,
					data: params,
					dataType: "json",
					success: function(data){
						//console.log("success save address", data);
						if(data.result == true){
                            $("#modalLocalization").modal("hide");

                            contextData.address = address.address;
                            contextData.geo = address.geo;

                            toastr.success("Votre addresse a été modifiée avec succès.")

                            bootbox.confirm({
                                message: "<i class='fa fa-marker-map'></i> Souhaitez-vous être localisé précisément sur la carte ?",
                                buttons: {
                                    confirm: {
                                        label: "Oui",
                                        className: 'btn-success'
                                    },
                                    cancel: {
                                        label: "Non, utilisez la position par défaut",
                                        className: 'btn-danger'
                                    }
                                },
                                callback: function (result) {
                                    if (!result) {
                                       urlCtrl.loadByHash(location.hash);
                                    } else {
                                        updateLocalityEntities();
                                    }
                                }
                            });
						}
					}
				});
			}
		});
	});

</script>