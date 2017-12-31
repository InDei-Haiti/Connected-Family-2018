$("body").delegate("button#deleteInterview", 'click', function(event) {
  var interview = $(this).val();
  var date = $("tr#" + interview + " > td[data=date]").html();
  swal({
    title: "You're going to remove\n" + date + "\nAre you sure?",
    text: "Interview will be deleted permanently!",
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
          interview: interview,
        },
      })
      .done(function(data) {
        if(data['state'] == 'success'){
          swal("Deleted", "Interview has been deleted successfully!", "success");
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