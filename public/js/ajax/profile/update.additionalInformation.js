$(document).ready(function() {
  // Update Additional Information
  $("button[id^=ai]").click(function(event) {
    event.preventDefault();
    var field = $(this).attr('target');
    $("#ai-" + field + "-input").attr('disabled', 'disabled')
      .parent()
      .removeClass('has-success')
      .removeClass('has-warning')
      .removeClass('has-danger');
    $("#ai-" + field + "-text").hide();
    $("#ai-" + field + "-btn").attr('disabled', 'disabled');
    $.ajax({
      type: 'PATCH',
      data: {
        type: 'ai',
        field: field,
        value: $("#ai-" + field + "-input").val(),
        _token: $("input[name=_token]").val(),
      },
    })
    .done(function(data) {
      if(data['state']){
        $("#ai-" + field + "-input").removeAttr('disabled')
          .parent().addClass('has-' + data['state'])
          .delay(delayConst).queue(function(){
            $(this).removeClass('has-' + data['state']).dequeue();
          });
        $("#ai-" + field + "-text").removeClass('text-success')
          .removeClass('text-warning')
          .removeClass('text-danger')
          .addClass('text-' + data['state'])
          .html(data['msg'])
          .show(timeConst)
          .delay(delayConst)
          .hide(timeConst);
        $("#ai-" + field + "-btn").delay(delayConst).queue(function(){
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