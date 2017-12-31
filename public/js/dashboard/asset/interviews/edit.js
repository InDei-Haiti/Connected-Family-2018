$("body").delegate("button#interviewEditBtn", 'click', function(interview) {
  var interview_id = $(this).val();
  var name = $("tr#" + interview_id + " > td[data=name]").html();
  var committee = $("tr#" + interview_id + " > td[data=committee]").html();
  var position = $("tr#" + interview_id + " > td[data=position]").html();
  var year = $("tr#" + interview_id + " > td[data=year]").html();
  $("#interviewEditName").text(name);
  $("#interviewEditCommittee").val(committee);
  $("#interviewEditPosition").val(position);
  $("#interviewEditYear").val(year);
  $('#interviewEditCommittee').select2();
  $('#interviewEditPosition').select2();
  $('span.select2').attr('style', 'width: 100%');
});
