function preventPreferencesRepeat(){
  $('#stPreference option').prop('disabled', false);
  $('#ndPreference option').prop('disabled', false);
  $('#stPreference option:nth-child(1)').prop('disabled', true);
  $('#ndPreference option:nth-child(1)').prop('disabled', true);
  $('#ndPreference option[value="' + $('#stPreference').val() + '"]').prop('disabled', true);
  $('#stPreference option[value="' + $('#ndPreference').val() + '"]').prop('disabled', true);
}
$('#stPreference').change(function(){ preventPreferencesRepeat(); });
$('#stPreference').trigger('change');
$('#ndPreference').change(function(){ preventPreferencesRepeat(); });
$('#ndPreference').trigger('change');
$("button#registration2Reset").click(function(event) {
  event.preventDefault();
  $('#stPreference option').removeAttr('disabled', "").removeAttr('selected');
  $('#stPreference option:nth-child(1)').attr('disabled', "").attr('selected', "");
  $('#ndPreference option').removeAttr('disabled', "").removeAttr('selected');
  $('#ndPreference option:nth-child(1)').attr('disabled', "").attr('selected', "");
});