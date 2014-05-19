$(".menu-opener").click(function(){
  $(".menu-opener, .menu-opener-inner, .menu").toggleClass("active");
  $(".stepContainer").toggleClass("mt100");
  $(".title").slideToggle();
});
