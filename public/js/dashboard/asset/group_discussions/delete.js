$("body").delegate("button#group_discussionDeleteBtn", 'click', function(group_discussion) {
  var group_discussion_id = $(this).val();
  var name = $("tr#" + group_discussion_id + " > td[data=name]").html();
  swal({
    title: "You're going to remove\n" + name + "\nAre you sure?",
    text: "group_discussion will be deleted permanently!",
    type: "error",
    showCancelButton: true,
    confirmButtonText: "Yes, delete!",
    cancelButtonText: "No, cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      /* Ajax Code! */
      swal("Deleted!", "group_discussion has been deleted permanently!", "success");
    } else {
      swal("Cancelled", "Your data is safe.", "error");
    }
  });
});
