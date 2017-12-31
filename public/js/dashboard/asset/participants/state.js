$(document).ready(function(){
  $('body').delegate('button[name="state-button"]','click',function(){
    var data = {
      id: $(this).attr('id'),
      for: $(this).attr('for'),
      state: $(this).attr('state'),
      prefId: $(this).attr('prefId') || '',
      _token : $('input[name="_token"]').val()
    }
    $.ajax({
      url: 'requests/state',
      type: 'PATCH',
      data: data,
      success: function(data){
        // console.log(data);
        if(data['state'] == 'success'){
          var stateTd = $('td[id="td_' + data['button_for'] + '_state_' + data['button_id'] + '"]');
          if(data['button_state'] == 0) {
            stateTd.html('Accepted for ' + data['prefName']).attr('class', 'bg-success');
          } else {
            stateTd.html('Rejected').attr('class', 'bg-danger');
          }
        } else {
          alert(data['msg'])
        }
      },
      error: function(data){
        // console.log(data);
      }
    });

  });

});

