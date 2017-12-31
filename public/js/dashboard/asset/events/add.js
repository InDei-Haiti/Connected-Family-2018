$(document).ready(function() {
  // Add Event
  $("button#eventSubmit").click(function(event) {
    event.preventDefault();
    $("small#errorMsg").html('').hide();
    $(this).attr('disabled', 'disabled');
    $('div.form-group.has-error').removeClass('has-error');
    $.ajax({
      url: 'requests/add',
      type: 'PUT',
      dataType: 'JSON',
      data: {
        _token: $("input[name=_token]").val(),
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
        $('#addEventForm')[0].reset();
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
});