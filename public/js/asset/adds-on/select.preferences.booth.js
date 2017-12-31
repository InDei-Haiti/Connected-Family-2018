$(document).ready(function(){

  $("#pref1-select").change(function(){updateFormPreferenceSectionPreventRepeated()});
  $("#pref2-select").change(function(){updateFormPreferenceSectionPreventRepeated()});

  function updateFormPreferenceSectionPreventRepeated(){
    $('#pref1-select option').prop('disabled', false);
    $('#pref2-select option').prop('disabled', false);
    $('#pref1-select option:nth-child(1)').prop('disabled', true);
    $('#pref2-select option:nth-child(1)').prop('disabled', true);
    $('#pref2-select option[value="' + $('#pref1-select').val() + '"]').prop('disabled', true);
    $('#pref1-select option[value="' + $('#pref2-select').val() + '"]').prop('disabled', true);
  }

});
