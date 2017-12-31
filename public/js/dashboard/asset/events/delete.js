$("body").delegate("button#eventDeleteBtn", 'click', function(event) {
  var event_id = $(this).val();
  var name = $("tr#" + event_id + " > td[data=name]").html();
  var year = $("tr#" + event_id + " > td[data=year]").html();
  swal({
    title: "You're going to remove\n" + name + "(" + year + ")" + "\nAre you sure?",
    text: "Event will be deleted permanently!",
    type: "error",
    showCancelButton: true,
    confirmButtonText: "Yes, delete!",
    cancelButtonText: "No, cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        url: 'requests/delete',
        type: 'delete',
        dataType: 'JSON',
        data: {
          _token: $("input[name=_token]").val(),
          id: event_id,
        },
      })
      .done(function(data) {
        if(data['state'] == 'success'){
          swal("Deleted", "Event has been deleted successfully!", "success");
          setTimeout(function (){
            location.reload();
          }, 1000);
        }
        else if(data['state'] == 'danger')
          swal("ERROR", data['fields']['id'], "error");
        else swal("[STATELESS_ERROR]", "Call IT Head!", "error");
      })
      .fail(function(e) {
        swal("[FAIL_ERROR]", "Call IT Head!", "error");
      })
      .always(function() {});
    } else {
      swal("Cancelled", "Your data is safe.", "error");
    }
  });
});