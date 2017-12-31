$("body").delegate("button#memberEditBtn", 'click', function(event) {
  var member_id = $(this).val();
  var name = $("tr#" + member_id + " > td[data=name]").html();
  var committee = $("tr#" + member_id + " > td[data=committee]").html();
  var position = $("tr#" + member_id + " > td[data=position]").html();
  var year = $("tr#" + member_id + " > td[data=year]").html();
  $("#memberEditName").text(name);
  $("#memberEditCommittee").val(committee);
  $("#memberEditPosition").val(position);
  $("#memberEditYear").val(year);
  $('#memberEditCommittee').select2();
  $('#memberEditPosition').select2();
  $('span.select2').attr('style', 'width: 100%');
});