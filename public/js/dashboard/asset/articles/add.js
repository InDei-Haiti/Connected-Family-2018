$(document).ready(function() {
  // Add Article
  $("button#articleSubmit").click(function(event) {
    event.preventDefault();
    $("small#errorMsg").html('').hide();
    $(this).attr('disabled', 'disabled');
    $('div.form-group.has-error').removeClass('has-error');
    var formData = new FormData();
    formData.append('_token', $("input[name=_token]"));
    console.log("formData", formData);
    $.ajax({
      url: 'requests/add',
      type: 'PUT',
      data: {
        _token: $("input[name=_token]").val(),
        title: $("input#title").val(),
        name: $("input#name").val(),
        email: $("input#email").val(),
        content: $("textarea#content").val(),
        lang: $("input[name=lang]").val(),
        image: $('input#image').prop('files')[0]// $("input#image").val()
      },
    })
    .done(function(data) {
      console.log(data);
      $("button#articleSubmit").removeAttr('disabled');
      if(data['state'] == 'success'){
        // $('#addArticleForm')[0].reset();
        $.notify({
          title: "Add Complete : ",
          message: "Article has been added successfully!",
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
