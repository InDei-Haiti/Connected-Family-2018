$("body").delegate("button#interviewDeleteBtn", 'click', function(interview) {
  var interview_id = $(this).val();
  var name = $("tr#" + interview_id + " > td[data=name]").html();
  swal({
    title: "You're going to remove\n" + name + "\nAre you sure?",
    text: "interview will be deleted permanently!",
    type: "error",
    showCancelButton: true,
    confirmButtonText: "Yes, delete!",
    cancelButtonText: "No, cancel!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      /* Ajax Code! */
      swal("Deleted!", "interview has been deleted permanently!", "success");
    } else {
      swal("Cancelled", "Your data is safe.", "error");
    }
  });
});
