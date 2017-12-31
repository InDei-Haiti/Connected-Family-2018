$("body").delegate("button#preferenceEditBtn", 'click', function(preference) {
  var preference_id = $(this).val();
  var name = $("tr#" + preference_id + " > td[data=name]").html();
  var committee = $("tr#" + preference_id + " > td[data=committee]").html();
  var position = $("tr#" + preference_id + " > td[data=position]").html();
  var year = $("tr#" + preference_id + " > td[data=year]").html();
  $("#preferenceEditName").text(name);
  $("#preferenceEditCommittee").val(committee);
  $("#preferenceEditPosition").val(position);
  $("#preferenceEditYear").val(year);
  $('#preferenceEditCommittee').select2();
  $('#preferenceEditPosition').select2();
  $('span.select2').attr('style', 'width: 100%');
});
