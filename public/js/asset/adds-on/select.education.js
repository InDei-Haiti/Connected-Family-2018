$(document).ready(function(){
  var showHideTime = 200;
  var colleges = $.parseJSON($('#colleges').text());
  var years = $.parseJSON($('#years').text());
  $("#ei-other-uni-row").hide(showHideTime);
  $("#ei-other-college-row").hide(showHideTime);
  $("#ei-other-department-row").hide(showHideTime);
  $("#ei-department-row").hide(showHideTime);
  $("#ei-uni-select").change(function(){updateFormEductionSection()});
  $("#ei-college-select").change(function(){updateFormEductionSection()});
  $("#ei-department-select").change(function(){updateFormEductionSection()});
  function updateFormEductionSection(){
    var uni = $("#ei-uni-select").val();
    var college = $("#ei-college-select").val();
    var department = $("#ei-department-select").val();
    var year = $("#ei-year-select").val();
    var chosenCollege = {'name': ''}, engOffset = 0, prepOffset = 0;
    for(var i = 0; i < colleges.length; i++)
      if(colleges[i]['name'] == college)
        chosenCollege = colleges[i];
    $("#ei-year-select").html('');
    $("#ei-year-select").append($("<option></option>").attr("value", "None").text("Select your year"));
    $("#ei-year-select option[value='None']").attr('disabled', '');
    if(chosenCollege['name'] == "Faculty of Engineering")
      engOffset = 1;
    if(department == "Preparatory")
      engOffset = 5;
    if( (department == "Preparatory" || department == "Other" || department == null)
      && chosenCollege['name'] == "Faculty of Engineering")
      prepOffset = 1;
    for(var i = 1 - prepOffset; i <= chosenCollege['years'] - engOffset; i++)
      $("#ei-year-select").append('<option value="' + years[i] + '">' + years[i] + '</option>');
    $("#ei-year-select option[value='" + year + "']").attr('selected', '');
    if(department != "Preparatory")
      $("#ei-year-select").append('<option value="' + years[years.length - 1] + '">' + years[years.length - 1] + '</option>');
    if(uni == "Other") $("#ei-other-uni-row").show(showHideTime);
    else  $("#ei-other-uni-row").hide(showHideTime);
    if(college == "Other") $("#ei-other-college-row").show(showHideTime);
    else  $("#ei-other-college-row").hide(showHideTime);
    if(department == "Other" && college == "Faculty of Engineering") $("#ei-other-department-row").show(showHideTime);
    else  $("#ei-other-department-row").hide(showHideTime);
    if(college == "Faculty of Engineering") $("#ei-department-row").show(showHideTime);
    else  $("#ei-department-row").hide(showHideTime); 
  }
});
