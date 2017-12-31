$(document).ready(function() {
  // Update Privacies
  $("button[id=p-btn]").click(function(event) {
    event.preventDefault();
    $("input[id^=p-check]").attr('disabled', 'disabled');
    $("#p-text").hide();
    $("#p-btn").attr('disabled', 'disabled');
    $.ajax({
      type: 'PATCH',
      data: {
        type: 'p',
        field: 'privacy',
        mobile: $("#p-check-mobile").is(':checked')?1:0,
        email: $("#p-check-email").is(':checked')?1:0,
        education: $("#p-check-education").is(':checked')?1:0,
        birthday: $("#p-check-birthday").is(':checked')?1:0,
        facebook: $("#p-check-facebook").is(':checked')?1:0,
        linkedin: $("#p-check-linkedin").is(':checked')?1:0,
        _token: $("input[name=_token]").val(),
      },
    })
    .done(function(data) {
      $("input[id^=p-check]").removeAttr('disabled');
      if(data['state'] == 'success'){
        $("#p-text").html(data['msg']).addClass('text-success').show(timeConst)
          .delay(delayConst).hide(timeConst).queue(function(){
            $(this).removeClass('has-success').dequeue();
          });
        $("#p-btn").delay(delayConst).queue(function(){
          $(this).removeAttr('disabled').dequeue();
        });
      } else if(data['state'] == 'error'){
        alert(data['msg'] + __ERROR_MSG__);
      }
    })
    .fail(function(e) {
      myAlert('danger', __ERROR_MSG__);
    })
    .always(function() {});
  });
});