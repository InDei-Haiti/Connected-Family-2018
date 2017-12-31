$("body").delegate("button#memberDeleteBtn", 'click', function(event) {
  var member_id = $(this).val();
  var name = $("tr#" + member_id + " > td[data=name]").html();
  swal({
    title: "You're going to remove\n" + name + "\nAre you sure?",
    text: "Member will be deleted permanently!",
    type: "error",
    showCancelButton: true,
    confirmButtonText: "Yes, delete!",
    cancelButtonText: "No, cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      /* Ajax Code! */
      swal("Deleted!", "Member has been deleted permanently!", "success");
    } else {
      swal("Cancelled", "Your data is safe.", "error");
    }
  });
});