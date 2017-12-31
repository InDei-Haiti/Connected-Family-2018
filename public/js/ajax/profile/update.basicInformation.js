$(document).ready(function() {
  // Update Basic Information
  $("button[id^=bi]").click(function(event) {
    event.preventDefault();
    var field = $(this).attr('target');
    $("#bi-" + field + "-input").attr('disabled', 'disabled')
      .parent()
      .removeClass('has-success')
      .removeClass('has-warning')
      .removeClass('has-danger');
    $("#bi-" + field + "-text").hide();
    $("#bi-" + field + "-btn").attr('disabled', 'disabled');
    $.ajax({
      type: 'PATCH',
      data: {
        type: 'bi',
        field: field,
        value: $("#bi-" + field + "-input").val(),
        _token: $("input[name=_token]").val(),
      },
    })
    .done(function(data) {
      if(data['state']){
        $("#bi-" + field + "-input").removeAttr('disabled')
          .parent().addClass('has-' + data['state'])
          .delay(delayConst).queue(function(){
            $(this).removeClass('has-' + data['state']).dequeue();
          });
        $("#bi-" + field + "-text").removeClass('text-success')
          .removeClass('text-warning')
          .removeClass('text-danger')
          .addClass('text-' + data['state'])
          .html(data['msg'])
          .show(timeConst)
          .delay(delayConst)
          .hide(timeConst);
        $("#bi-" + field + "-btn").delay(delayConst).queue(function(){
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