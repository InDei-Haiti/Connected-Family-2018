$("body").delegate("button#group_discussionEditBtn", 'click', function(group_discussion) {
  var group_discussion_id = $(this).val();
  var name = $("tr#" + group_discussion_id + " > td[data=name]").html();
  var committee = $("tr#" + group_discussion_id + " > td[data=committee]").html();
  var position = $("tr#" + group_discussion_id + " > td[data=position]").html();
  var year = $("tr#" + group_discussion_id + " > td[data=year]").html();
  $("#group_discussionEditName").text(name);
  $("#group_discussionEditCommittee").val(committee);
  $("#group_discussionEditPosition").val(position);
  $("#group_discussionEditYear").val(year);
  $('#group_discussionEditCommittee').select2();
  $('#group_discussionEditPosition').select2();
  $('span.select2').attr('style', 'width: 100%');
});
