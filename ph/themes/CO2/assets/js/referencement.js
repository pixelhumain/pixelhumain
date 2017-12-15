

function preLoadAddress(hide, localityId, country, insee, city, postalCode, lat, lng, street){

    console.log("preLoadAddress", hide, localityId, country, insee, city, postalCode, lat, lng, street);
    
    if(country != "")   { formInMap.NE_country = country; }
    if(insee != "")     { formInMap.NE_insee = insee; }
    if(city != "")      { formInMap.NE_city = city; }
    if(postalCode != ""){ formInMap.NE_cp = postalCode; }
    if(lat != "")       { formInMap.NE_lat = lat; }
    if(lng != "")       { formInMap.NE_lng = lng; }
    if(street != "")    { formInMap.NE_street = street.trim(); }
    if(localityId != "") { formInMap.NE_localityId = localityId; }


    if(country == "NC"){
        formInMap.NE_level1 = "Nouvelle-Calédonie";
        formInMap.NE_level1Name = "Nouvelle-Calédonie";
    }

    $('[name="newElement_country"]').val(formInMap.NE_country);
    $('[name="newElement_insee"]').val(formInMap.NE_insee);
    $('[name="newElement_city"]').val(formInMap.NE_city);
    $('[name="newElement_cp"]').val(formInMap.NE_cp);
    $('[name="newElement_dep"]').val(formInMap.NE_dep);
    $('[name="newElement_region"]').val(formInMap.NE_region);
    $('[name="newElement_lat"]').val(formInMap.NE_lat);
    $('[name="newElement_lng"]').val(formInMap.NE_lng);
    $('[name="newElement_street"]').val(formInMap.NE_street);

    $("#divStreetAddress").removeClass("hidden");
    $("#divPostalCode").removeClass("hidden");
    $("#divCity").removeClass("hidden");

    $("#newElement_btnValidateAddress").prop('disabled', (formInMap.NE_insee==""?true:false));

    Sig.markerFindPlace.setLatLng([formInMap.NE_lat, formInMap.NE_lng]);
}
