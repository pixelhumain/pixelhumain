// Elemento Bootstrap Skin - demo scripts
//
//    Take the necessary code for your site, 
//    you can also copy/paste but make sure 
//    to replicate class and/or id names


!function ($) {

  $(function() {
//////////////////////////////////////
//  BOOTSTRAP SCRIPTS 
//  (see below for theme scripts)
//////////////////////////////////////

    var $window = $(window)

    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })

    // side bar
    $('.bs-docs-sidenav').affix({
      offset: {
        top: function () { return $window.width() <= 980 ? 330 : 260 }
      }
    })

    // make code pretty
    window.prettyPrint && prettyPrint()

    // add-ons
    $('.add-on :checkbox').on('click', function () {
      var $this = $(this)
        , method = $this.attr('checked') ? 'addClass' : 'removeClass'
      $(this).parents('.add-on')[method]('active')
    })

    // add tipsies to grid for scaffolding
    if ($('#gridSystem').length) {
      $('#gridSystem').tooltip({
          selector: '.show-grid > div'
        , title: function () { return $(this).width() + 'px' }
      })
    }

    // tooltip demo
    $('.tooltip-demo').tooltip({
      selector: "a[rel=tooltip]"
    })

    $('.tooltip-test').tooltip()
    $('.popover-test').popover()

    // popover demo
    $("a[rel=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
      })

    // button state demo
    $('#fat-btn')
      .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      })

    // carousel demo
    $('#myCarousel').carousel()
    

//////////////////////////////////////
//  ELEMENTO SCRIPTS
//////////////////////////////////////
    

    /* Style switcher */
    var linkSwitcher = $("#elemento-theme")
      , cookieName = 'elemento-bootstrap';

    if ( $.cookie(cookieName) ) {
       linkSwitcher.attr("href", $.cookie(cookieName));
    }

    $("#css-switcher li a").click(function() { 
        var rel = $(this).attr('rel');
        linkSwitcher.attr("href", rel);
        $.cookie(cookieName, rel, {expires: 7, path: '/'});
        return false;
    });
    /* End Style switcher */
    
    
    /////////////////////////////
    // ELEMENTO CUSTOM CAROUSEL
    /////////////////////////////
    
    $('#testimonialCarousel').carousel()
    $('#galeryCarousel').carousel()
    $('#textCarousel').carousel()
    
    $('#dp-input1').datepicker();
    $('#dp-input2').datepicker();

    
    /////////////////////////////
    // ELEMENTO TWEETER PLUGIN
    /////////////////////////////
/*
    $("#tweet1").tweet({
          username: "envato",
          count: 2,
          template: '{text}<br/><a href="http://twitter.com/{name}">@{name}</a> {time}'
        });
    
    $("#tweet2").tweet({
          username: "envato",
          avatar_size: 32,
          count: 2,
          template: '<a href="http://twitter.com/{name}">{avatar}</a> {text} &mdash; {time}'
        });        
*/
    /////////////////////////////
    // FLICKR FEED
    /////////////////////////////
    
    // Add class 'flickr-gallery' and attribute data-flickr-id="999999@N99" to the list container
    $('.flickr-gallery').each(function(){
      $(this).jflickrfeed({
        limit: 12,
        qstrings: {
            id: $(this).data('flickr-id')
        },
        itemTemplate: '<li class="span1"><a href="{{image_b}}"><img alt="{{title}}" src="{{image_s}}" /></a></li>'
      });
    });

    /////////////////////////////
    // GMAP v3
    /////////////////////////////

    if(typeof google !== 'undefined')
    $('.gmap').each(function(){
      var d = $(this).data('markers').split(';'),
          m = [];
      for(a in d) { m.push({'address' : d[a]}) }
      $(this).gMap({
        zoom: $(this).data('zoom'),
        markers: m
      });

    })

    /////////////////////////////
    // COLORPICKER
    /////////////////////////////

    $('#cp1').colorpicker({
      format: 'hex'
    });
    $('#cp2').colorpicker();
    $('#cp3').colorpicker();

    var btnStyle = $('#cp4').length && $('#cp4')[0].style;
    $('#cp4').colorpicker().on('changeColor', function(ev){
        btnStyle.backgroundColor = ev.color.toHex();
    });

  })

}(window.jQuery);


/*! jQuery Cookie Plugin v1.3 | https://github.com/carhartl/jquery-cookie */
(function(f,b,g){var a=/\+/g;function e(h){return h}function c(h){return decodeURIComponent(h.replace(a," "))}var d=f.cookie=function(p,o,u){if(o!==g){u=f.extend({},d.defaults,u);if(o===null){u.expires=-1}if(typeof u.expires==="number"){var q=u.expires,s=u.expires=new Date();s.setDate(s.getDate()+q)}o=d.json?JSON.stringify(o):String(o);return(b.cookie=[encodeURIComponent(p),"=",d.raw?o:encodeURIComponent(o),u.expires?"; expires="+u.expires.toUTCString():"",u.path?"; path="+u.path:"",u.domain?"; domain="+u.domain:"",u.secure?"; secure":""].join(""))}var h=d.raw?e:c;var r=b.cookie.split("; ");for(var n=0,k=r.length;n<k;n++){var m=r[n].split("=");if(h(m.shift())===p){var j=h(m.join("="));return d.json?JSON.parse(j):j}}return null};d.defaults={};f.removeCookie=function(i,h){if(f.cookie(i)!==null){f.cookie(i,null,h);return true}return false}})(jQuery,document);
