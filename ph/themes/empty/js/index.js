$(".menu-opener").click(function(){
  $(".menu-opener, .menu-opener-inner, .menu").toggleClass("active");
  $(".stepContainer").toggleClass("topSpacer");
  $(".title").slideToggle();
  if(!$(".menu-opener").hasClass('active'))
  	hideShow(".home");
});
