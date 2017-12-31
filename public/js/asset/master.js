/* Ready */
$(document).ready(function() {
  removeFacebookHash();
  setupCarousel();
  // Stop opened link in nav from interacting
  $('a[href="#"].nav-link').removeAttr('href');
  $('a[href="#"].dropdown-item').removeAttr('href');
  // Setup more responsive content
  screenSetup();
  // Stop Image Interaction
  $('img').on('mousedown', function(event) { return false });
  $('img').on("contextmenu",function(event){ return false });
  //
  $("button.navbar-toggler").click(function(event) {
    setTimeout(function (){ $("button.navbar-toggler").attr('disabled', ''); }, 0);
    setTimeout(function (){ $("button.navbar-toggler").removeAttr('disabled'); }, 400);
  });
  $(".footer-social-link").hover(function() {
      $(this).children('span')
             .children('i.fa-circle')
             .removeClass('fa-circle')
             .addClass('fa-square');
  }, function() {
      $(this).children('span')
             .children('i.fa-square')
             .removeClass('fa-square')
             .addClass('fa-circle');
  });
});

/* Window resizeing */
$(window).resize(function() {
  // Setup more responsive content
  screenSetup();
});

/* Window scrolling */
$(window).scroll(function(){

});

