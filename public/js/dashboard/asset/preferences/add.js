$(document).ready(function() {
  // Add Preference
  $("button#preferenceSubmit").click(function(event) {
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
        event: $("select#preferenceEventId").val(),
        name: $("input#preferenceName").val(),
        description: $("textarea#preferenceDescription").val(),
        type: $("input#preferencePreferenceType").val(),
        steps: $("input#preferencePreferenceSteps").val(),
        min_academic_year: $("select#preferenceMinYear").val(),
        colleges: $("select#preferenceColleges").val(),
        departments: $("select#preferenceDepartments").val(),
      },
    })
    .done(function(data) {
      $("button#preferenceSubmit").removeAttr('disabled');
      if(data['state'] == 'success'){
        $('#addPreferenceForm')[0].reset();
        $('#preferenceEventId').trigger('change');
        $('#preferenceMinYear').trigger('change');
        $.notify({
          title: "Add Complete : ",
          message: "Preference has been added successfully!",
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