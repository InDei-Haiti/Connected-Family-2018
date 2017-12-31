$("button#shareIdeaBtn").click(function(event) {
  event.preventDefault();
  $("small#errorMsg").html('').hide()
                     .removeClass('text-danger')
                     .removeClass('text-success');
  $(this).attr('disabled', 'disabled');
  $('div.form-group.has-danger').removeClass('has-danger');
  $.ajax({
    url: 'requests/idea/add',
    type: 'PUT',
    dataType: 'JSON',
    data: {
      _token: $("input[name=_token]").val(),
      idea: $('textarea[name=idea]').val(),
    },
  })
  .done(function(data) {
    // console.log("data", data);
    $("button#shareIdeaBtn").removeAttr('disabled');
    if(data['state'] == 'success'){
      $('.idea-text').attr('rows', '2').val("").trigger('keyup');
      $('small[data=idea]').html(data['msg']).show('fast').addClass('text-success').delay(5000).hide('fast');
      if($("span#ideas").children('div.noideas').length)
        $("span#ideas").html(data['content']);
      else
        $("span#ideas").html(data['content'] + $("span#ideas").html());
    } else if(data['state'] == 'danger')
      $.each(data['fields'], function(index, el) {
        $('small[data=' + index + ']').html(el).show('fast').delay(5000).hide('fast').addClass('text-danger').parent('div').addClass('has-danger');
      });
    else alert("[STATLS_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!");
  })
  .fail(function(e) {
    // console.log(e);
    alert("[AJAX_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!");
  })
  .always(function() {});
});
