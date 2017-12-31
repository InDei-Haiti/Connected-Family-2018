$("button#registration2Btn").click(function(event) {
  event.preventDefault();
  $("small#errorMsg").html('').hide();
  $(this).attr('disabled', 'disabled');
  $('div.form-group.has-danger').removeClass('has-danger');
  $.ajax({
    type: 'POST',
    dataType: 'JSON',
    data: {
      _token: $("input[name=_token]").val(),
      stPreference: $('#stPreference').val(),
      ndPreference: $('#ndPreference').val(),
    },
  })
  .done(function(data) {
    // console.log("data", data);
    $("button#registration2Btn").removeAttr('disabled');
    if(data['state'] == 'success') location.reload();
    else if(data['state'] == 'danger')
      $.each(data['fields'], function(index, el) {
        $('small[data=' + index + ']').html(el).show('fast').parent('div').addClass('has-danger');
      });
    else alert("[STATLS_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!");
  })
  .fail(function(e) {
    // console.log(e);
    alert("[AJAX_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!");
  })
  .always(function() {});
});
