$("body").delegate("button#eventEditBtn", 'click', function(event) {
  var event_id = $(this).val();
  var year = $("tr#" + event_id + " > td[data=year]").html();
  var name = $("tr#" + event_id + " > td[data=name]").html();
  var started_at = $("tr#" + event_id + " > td[data=started_at]").html();
  var ended_at = $("tr#" + event_id + " > td[data=ended_at]").html();
  var preferences_type = $("tr#" + event_id + " > td[data=preferences_type]").html();
  var description = $("tr#" + event_id + " > td[data=description]").html();
  $("#eventId").val(event_id);
  $("#eventYear").val(year);
  $("#eventName").val(name);
  $("#eventStartDate").val(started_at);
  $("#eventEndDate").val(ended_at);
  $('#eventDescription').html(description);
  $('#eventPreferencesType').val(preferences_type);
});
$('#eventStartDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
$('#eventEndDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
$("button#eventSubmit").click(function(event) {
  event.preventDefault();
  $("small#errorMsg").html();
  $("small#errorMsg").hide();
  $(this).attr('disabled', 'disabled');
  $('div.form-group.has-error').removeClass('has-error');
  $.ajax({
    url: 'requests/edit',
    type: 'PATCH',
    dataType: 'JSON',
    data: {
      _token: $("input[name=_token]").val(),
      id: $("input#eventId").val(),
      year: $("input#eventYear").val(),
      name: $("input#eventName").val(),
      started_at: $("input#eventStartDate").val(),
      ended_at: $("input#eventEndDate").val(),
      description: $("textarea#eventDescription").val(),
      preferences_type: $("input#eventPreferencesType").val(),
    },
  })
  .done(function(data) {
    $("button#eventSubmit").removeAttr('disabled');
    if(data['state'] == 'success'){
      var id = $("input#eventId").val();
      $("tr#" + id + " > td[data=year]").html($("input#eventYear").val());
      $("tr#" + id + " > td[data=name]").html($("input#eventName").val());
      $("tr#" + id + " > td[data=started_at]").html($("input#eventStartDate").val());
      $("tr#" + id + " > td[data=ended_at]").html($("input#eventEndDate").val());
      $("tr#" + id + " > td[data=description]").html($("textarea#eventDescription").val());
      $("tr#" + id + " > td[data=preferences_type]").html($("input#eventPreferencesType").val());
      $.notify({
        title: "Add Complete : ",
        message: "Event has been added successfully!",
        icon: 'fa fa-check'
      },{
        type: "success"
      });
    } else if(data['state'] == 'danger'){
      $.notify({
        title: " ERROR:",
        message: " Error messages are shown below.",
        icon: 'fa fa-exclamation-triangle'
      },{
        type: "danger"
      });
      $.each(data['fields'], function(index, el) {
        $('small[data=' + index + ']').html(el).show('fast').parent('div').addClass('has-error');
      });
    } else  $.notify({
        title: " [BAD_ERROR]",
        message: "Screenshot this error notification and send it to IT Head!",
        icon: 'fa fa-exclamation-triangle'
      },{
        type: "danger"
      });
  })
  .fail(function(e) {
    $.notify({
      title: " [FAIL_ERROR]",
      message: "Screenshot this error notification and send it to IT Head!",
      icon: 'fa fa-exclamation-triangle'
    },{
      type: "danger"
    });
  })
  .always(function() {});
});
