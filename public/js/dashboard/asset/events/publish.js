$("body").delegate("button#eventPublishBtn", 'click', function(event) {
  var event_id = $(this).val();
  var name = $("tr#" + event_id + " > td[data=name]").html();
  var year = $("tr#" + event_id + " > td[data=year]").html();
  swal({
    title: "You're going to publish\n" + name + "(" + year + ")" + "\nAre you sure?",
    text: "Event will be publish permanently!",
    type: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, publish!",
    cancelButtonText: "No, cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        url: 'requests/publish',
        type: 'PATCH',
        dataType: 'JSON',
        data: {
          _token: $("input[name=_token]").val(),
          id: event_id,
        },
      })
      .done(function(data) {
        if(data['state'] == 'success'){
          swal("Published", "Event has been published successfully!", "success");
          setTimeout(function (){
            location.reload();
          }, 1000);
        }
        else if(data['state'] == 'danger')
          swal("[DANGER_ERROR]", "Call IT Head!", "error");
        else swal("[STATELESS_ERROR]", "Call IT Head!", "error");
      })
      .fail(function(e) {
        swal("[FAIL_ERROR]", "Call IT Head!", "error");
      })
      .always(function() {});
    } else {
      swal("Cancelled", "Your event is not published yet.", "error");
    }
  });
});