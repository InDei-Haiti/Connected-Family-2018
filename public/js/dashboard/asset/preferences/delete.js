$("body").delegate("button#preferenceDeleteBtn", 'click', function(preference) {
  var preference_id = $(this).val();
  var name = $("tr#" + preference_id + " > td[data=name]").html();
  swal({
    title: "You're going to remove\n" + name + "\nAre you sure?",
    text: "preference will be deleted permanently!",
    type: "error",
    showCancelButton: true,
    confirmButtonText: "Yes, delete!",
    cancelButtonText: "No, cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      /* Ajax Code! */
      swal("Deleted!", "preference has been deleted permanently!", "success");
    } else {
      swal("Cancelled", "Your data is safe.", "error");
    }
  });
});
