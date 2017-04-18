
function initWebInterface(){
    $("#main-btn-start-search, .menu-btn-start-search").click(function(){
        var search = $("#main-search-bar").val();
        currentCategory = "";
        startWebSearch(search, currentCategory);
    });

    $("#second-search-bar").keyup(function(e){
        $("#main-search-bar").val($("#second-search-bar").val());
        $("#input-search-map").val($("#second-search-bar").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            currentCategory = "";
            startWebSearch(search, currentCategory);
         }
    });
    $("#main-search-bar").keyup(function(e){
        $("#second-search-bar").val($("#main-search-bar").val());
        $("#input-search-map").val($("#main-search-bar").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            currentCategory = "";
            startWebSearch(search, currentCategory);
         }
    });
    $("#input-search-map").keyup(function(e){
        $("#second-search-bar").val($("#input-search-map").val());
        $("#main-search-bar").val($("#input-search-map").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            currentCategory = "";
            startWebSearch(search, currentCategory);
         }
    });

    $("#menu-map-btn-start-search, #main-search-bar-addon").click(function(){
        var search = $("#input-search-map").val();    
        currentCategory = "";
        startWebSearch(search, currentCategory);
    });

   $("#modalFavorites .btn-favory").click(function(){
        var id = $(this).data("idfav");
        deleteFavorites(id);
   });

   $(".menu-btn-back-category").click(function(){
        KScrollTo("#section-fav");
   });

   $('#main-search-bar, #second-search-bar, #input-search-map').filter_input({regex:'[^@#\"\`/\(|\)/\\\\]'}); //[a-zA-Z0-9_] 

   if($("#mainNav .btn-show-map").css("display") == "none"){
        $("#main-search-bar").focus(function(e){
            KScrollTo("#main-search-bar");
        });
   }
}

function startWebSearch(search, category){


    var searchSpace = search.replace(/\s+/g, '');

    if((!notEmpty(search) && !notEmpty(category)) || 
        (searchSpace=="" && !notEmpty(category))) {
        toastr.info("Champ de recherche vide !");
        return;
    }else if(searchSpace.length == 1 && !notEmpty(category)){
        toastr.info("Votre recherche est trop courte : merci d'utiliser 2 lettres au minimum");
        return;
    }

    $("#second-search-bar").val(search);
    $("#mainCategories").hide();
    $("#sectionSearchResults").removeClass("hidden");
    $("#searchResults").html("<div class='col-md-12 margin-top-25'>"+
                                "<i class='fa fa-spin fa-refresh'></i> recherche en cours. Merci de patienter quelques instants..."+
                             "</div>");

    KScrollTo("#sectionSearchResults");
    
    search = search.replace("<?", '');

    var params = {
        search:search,
        category:category
    };

    $.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/app/websearch/",
        data: params,
        //dataType: "json",
        success:
            function(html) { 
                $("#searchResults").html(html); 
                // setTimeout(function(){ 
                //     showMapLegende("crosshairs", "Site web géolocalisés ...");
                // }, 1000);
                
            },
        error:function(xhr, status, error){
            $("#searchResults").html("erreur");
        },
        statusCode:{
                404: function(){
                    $("#searchResults").html("not found");
            }
        }
    });
}

function buildListCategories(){
    //console.log(mainCategories);
    var html = "";
    var n = 0;
    $.each(mainCategories, function(name, params){
        var classe="";
        if(params.color == "green") classe="search-eco";
        n++;
        html    += '<section class="portfolio '+classe+' p'+n+'">'+

                        '<div class="container">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 text-center">'+
                                    '<h3 class="letter-'+params.color+'">'+
                                        'Recherche '+name+
                                    '</h3>'+
                                    '<hr class="angle-down">'+
                                '</div>'+
                            '</div>'+
                            '<div class="text-'+params.color+'">';

        $.each(params.items, function(keyC, val){
            //console.log(keyC, val);
            html +=             '<div class="col-sm-3 col-xs-4 portfolio-item">'+
                                    '<button class="portfolio-link category-search-link" data-category="'+val.name+'">'+
                                        '<div class="caption">'+
                                            '<div class="caption-content">'+
                                            '</div>'+
                                        '</div>'+
                                        '<i class="fa fa-'+val.faIcon+' fa-2x"></i>'+
                                        '<h4>'+val.name+'</h4>'+
                                    '</button>'+
                                '</div>'
        });

        html +=             '</div>' + 
                        '</div>' + 
                    '</section>';

    });

    $("#mainCategories").html(html);

    $(".category-search-link").click(function(){
        var cat = $(this).data("category");
        currentCategory = cat;
        console.log("currentCategory", currentCategory);
        startWebSearch("", cat);
    });
}



function incNbClick(url){
    console.log("incrémentation nbClick essai");
    $.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/siteurl/incnbclick/",
        data: { url : url },
        dataType: "json",
        success:
            function(data) {
            console.log("incrémentation nbClick ok", data);
                // $("#searchResults").html(html);
                // $("#sectionSearchResults").removeClass("hidden");
                // KScrollTo("#sectionSearchResults");
            },
        error:function(xhr, status, error){
            console.log("erreur lors de l'incrémentation nbClick");
            //$("#searchResults").html("erreur");
        },
        statusCode:{
                404: function(){
                    console.log("404 erreur lors de l'incrémentation nbClick");
            }
        }
    });
}

function initKeywords(){
    var html = "";
    $.each(mainCategories, function(name, params){
        $.each(params.items, function(keyC, val){
            if(val.name == currentCategory){
                $("#fa-category").addClass("fa-"+val.faIcon);
                if(typeof val.keywords != "undefined"){
                    $.each(val.keywords, function(keyK, keyword){
                        var classe="";
                        if(search==keyword) classe="active";
                        html += '<button class="btn btn-success btn-sm margin-bottom-5 margin-left-10 btn-keyword btn-anc-color-blue '+classe+'" data-keyword="'+keyword+'">'+
                                    keyword+
                                '</button><br class="hidden-xs">';
                    });
                }
            }
        });
    });
    if(html != ""){ $("#sub-menu-left").removeClass("hidden-xs");
    }else{  $("#sub-menu-left").addClass("hidden-xs"); }
    $("#sub-menu-left").html(html);

    $(".btn-keyword").click(function(){
        var key = $(this).data("keyword");
        $("#main-search-bar").val(key);
        $("#second-search-bar").val(key);
        startWebSearch(key, currentCategory);

        $(".btn-keyword").removeClass("active");
        $(this).addClass("active");
    });
}


function addToFavorites(id){ //utilise les cookies

    var myFavorites = $.cookie('webFavorites');
    console.log("myFavorites", myFavorites);

    if(typeof myFavorites == "undefined"){
        myFavorites = new Array(id);
        $("#modalFavorites #listFav").html("");
        showInFavory(myFavorites, id)
    }else{
        if(myFavorites != ""){
            myFavorites = myFavorites.split(",");
        }else{
            myFavorites = new Array(id);
            $("#modalFavorites #listFav").html("");
            showInFavory(myFavorites, id)
        }
        if(myFavorites.indexOf(id)==-1){
            myFavorites.push(id);
            showInFavory(myFavorites, id)
        }
    }

    console.log("myFavorites", myFavorites);

    var path = location.pathname;
    $.cookie('webFavorites', myFavorites,   { expires: 365, path: path });

    

    toastr.success("Ajouté à vos favoris");
}
function deleteFavorites(id){ //utilise les cookies

    var myFavorites = $.cookie('webFavorites');
    console.log("deleteFavorites1", myFavorites);

    if(typeof myFavorites != "undefined"){
        myFavorites = myFavorites.split(",");
        if(myFavorites.indexOf(id)>-1){
            myFavorites.splice(myFavorites.indexOf(id),1);
        }
    }
    console.log("deleteFavorites2", myFavorites, myFavorites.length);

    var path = location.pathname;
    $.cookie('webFavorites', myFavorites,   { expires: 365, path: path });
    
    $("#fav"+id).remove();
    toastr.success("deleteFavorites : "+id);
}

function showInFavory(myFavorites, id){
    var htmlFav = $(".url-"+id+" .addToFavInfo").html();

    htmlFav = '<div class="col-md-6 div-fav margin-bottom-15 text-left" id="fav'+id+'">'+htmlFav+"</div>";

    $("#modalFavorites #listFav").append(htmlFav);
    $("#modalFavorites .tooltip.fade.in").remove();

    $("#modalFavorites .btn-favory").off().click(function(){
        var id = $(this).data("idfav");
        deleteFavorites(id);
    });
}