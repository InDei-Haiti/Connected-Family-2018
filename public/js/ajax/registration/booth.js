$("small").html('').hide('fast');
$("input[name=register]").click(function(event) {
  event.preventDefault();
  $("small").html('').hide('slow');
  $.ajax({
    type: 'POST',
    dataType: 'JSON',
    data: {
      _token: $("input[name=_token]").val(),
      name: $('input[name=name]').val(),
      email: $('input[name=email]').val(),
      mobile: $('input[name=mobile]').val(),
      uni: $('select[name=uni]').val(),
      other_uni: $('input[name=other_uni]').val(),
      college: $('select[name=college]').val(),
      other_college: $('input[name=other_college]').val(),
      department: $('select[name=department]').val(),
      other_department: $('input[name=other_department]').val(),
      year: $('select[name=year]').val(),
      stPreference: $('select[name=stPreference]').val(),
      ndPreference: $('select[name=ndPreference]').val(),
    },
  })
  .done(function(data) {
    // console.log("data", data);
    if(data['state'] == 'success'){
      alert("Registration has been completed!");
      $('input[name=registration2Reset]').trigger('click');
      /*
      $('#reg-form')[0].reset();
      $('select').prop('selectedIndex', 0).trigger('change');
      */
    }
    else if(data['state'] == 'danger')
      $.each(data['fields'], function(index, el) {
        $('small[data=' + index + ']').html(el).show('fast');
      });
    else alert("[STATLS_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!");
  })
  .fail(function(e) {
    // console.log(e);
    alert("[AJAX_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!");
  })
  .always(function() {});
});

$("input[name=registration2Reset]").click(function(event) {
  event.preventDefault();
  $('#reg-form')[0].reset();
  $('select').prop('selectedIndex', 0).trigger('change');
  $("small").html('').hide('fast');
});
