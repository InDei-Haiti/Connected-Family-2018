$(document).ready(function() {
  // Update Educational Information
  var eiAnalogy = {
    uni: 'ei-uni-',
    other_uni: 'ei-other-uni-',
    college: 'ei-college-',
    other_college: 'ei-other-college-',
    department: 'ei-department-',
    other_department: 'ei-other-department-',
    year: 'ei-year-',
  };
  $("button[id=ei-btn]").click(function(event) {
    event.preventDefault();
    $.each(eiAnalogy, function(k, v) { $('#' + k + 'text').hide(); });
    $("input[id^=ei]").attr('disabled', 'disabled');
    $("select[id^=ei]").attr('disabled', 'disabled');
    $("button[id^=ei]").attr('disabled', 'disabled');
    $.ajax({
      type: 'PATCH',
      data: {
        type: 'ei',
        field: 'education',
        uni: $('select[id=ei-uni-select]').val(),
        other_uni: $('input[id=ei-other-uni-input]').val(),
        college: $('select[id=ei-college-select]').val(),
        other_college: $('input[id=ei-other-college-input]').val(),
        department: $('select[id=ei-department-select]').val(),
        other_department: $('input[id=ei-other-department-input]').val(),
        year: $('select[id=ei-year-select]').val(),
        _token: $("input[name=_token]").val(),
      },
    })
    .done(function(data) {
      if(data['state'] == 'danger'){
        $("input[id^=ei]").removeAttr('disabled');
        $("select[id^=ei]").removeAttr('disabled');
        $.each(data['errors'], function(k, v) {
          $('#' + eiAnalogy[k] + 'text').html(v).addClass('text-danger').show(timeConst).delay(delayConst).hide(timeConst);
          $("#" + eiAnalogy[k] + 'select')
          .parent().addClass('has-danger')
          .delay(delayConst).queue(function(){
            $(this).removeClass('has-danger').dequeue();
          });
          $("#" + eiAnalogy[k] + 'input')
          .parent().addClass('has-danger')
          .delay(delayConst).queue(function(){
            $(this).removeClass('has-danger').dequeue();
          });
        });
        $("#ei-btn").delay(delayConst).queue(function(){
          $(this).removeAttr('disabled').dequeue();
        });        
      } else if(data['state'] == 'success'){
        $("input[id^=ei]").removeAttr('disabled');
        $("select[id^=ei]").removeAttr('disabled');
        $('#ei-year-text').removeClass('text-danger').removeClass('text-success');
        $('#ei-year-text').html(data['msg']).addClass('text-success').show(timeConst).delay(delayConst).hide(timeConst);
        $("#ei-btn").delay(delayConst).queue(function(){
          $(this).removeAttr('disabled').dequeue();
        });
        var uni = $('select[id=ei-uni-select]').val();
        if($('select[id=ei-uni-select]').val() == "Other") uni = $('select[id=ei-other-uni-input]').val();
        var college = $('select[id=ei-college-select]').val();
        if($('select[id=ei-college-select]').val() == "Other") college = $('select[id=ei-other-college-input]').val();
        var department = " - " + $('select[id=ei-department-select]').val();
        if($('select[id=ei-department-select]').val() == "Other") department = " - " + $('select[id=ei-other-department-input]').val();
        if(college != "Faculty of Engineering") department = "";
        var year = $('select[id=ei-year-select]').val();
        $("span[id=ei-holder]").html(year + department + "<br>" + college + " - " + uni);
      } else if(data['state'] == 'error'){
        alert(data['msg'] + __ERROR_MSG__);
      }
    })
    .fail(function(e) {
      console.log(e);
      myAlert('danger', __ERROR_MSG__);
    })
    .always(function() {});
  });
});