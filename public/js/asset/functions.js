function screenSetup(){
  var height = $(window).height();
  var width = $(window).width();
  var nav = 70.4;
  var footer = $('#connected-footer').height();
  var space = nav + footer;
  var slider_min_height = 550;
  if($('.slider-img').length){
    if(height > slider_min_height + space){
      $('.slider-img').height(height - space);
      $('body').height(height);
    } else if(width >= 768){
      $('.slider-img').height(slider_min_height);
      $('body').height(slider_min_height + space);
    } else {
      $('.slider-img').height(slider_min_height);
      $('body').height(slider_min_height + nav);
    }
  }
  if($('body').height() < $(window).height())
    $('#connected-footer').addClass('fixed-bottom');
  else if($('body').height() + $('#connected-footer').height() > $(window).height())
    $('#connected-footer').removeClass('fixed-bottom');
  $('body').height(
    $('#connected-nav').height()
    + $('#connected-footer').height()
    + $('#connected-container').height()
  );
}

function setupCarousel(){
  $('.carousel').carousel('cycle');
  $('.carousel').on('slid.bs.carousel', function () {
    $('.carousel').carousel('cycle');
  });
}

function scrollSpySetup(){
  $("body").delegate('#hash-btn' , 'click', function(event) {
    $(this).each(function (){
      var hash = $(this).attr('href');
      if(hash[0] === '#'){
        event.preventDefault();
        if($(hash).length){
          $('html, body').animate({
            scrollTop: $(hash).offset().top - 94
          }, 500);
        }
      }
    });
  });
  $(window).scroll(function() {
    $('#hash-btn-div').children().each(function(index, el) {
      var hash = $(el).attr('href');
      var div = $(hash).offset().top;
      var doc = $(document).scrollTop() + 95;
      if(doc >= div){
        $("#hash-btn.active").removeClass('active');
        $(el).addClass('active');
      }
      if($(window).scrollTop() + $(window).height() > $(document).height() - 100){
        $("#hash-btn.active").removeClass('active');
        $(el).last().addClass('active');
      }
    });
  });
}

function removeFacebookHash() {
  if (window.location.hash && window.location.hash === "#_=_" && history.replaceState)
      window.history.replaceState("", document.title, window.location.pathname);
}

function myAlert(type, msg){
  $("span[class=alert-msg]").html(msg).parent()
                            .css('display', 'none')
                            .removeClass('d-none')
                            .removeClass('alert-danger')
                            .removeClass('alert-success')
                            .addClass('alert-' + type)
                            .slideDown(500);
  $('.shade').addClass('shade-' + type).show();
  $('#alert-close').click(function(event) {
    $("span[class=alert-msg]").parent().hide(500);
    $('.shade').removeClass('shade-' + type).hide();
  });
}
