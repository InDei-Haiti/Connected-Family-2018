function dataTable(tableId){
  $("#" + tableId).DataTable();
  $("#" + tableId).parent().parent().next().children().each(function(index, el) {
    if(index == 0) $(el).attr('class', 'col-md-4');
    if(index == 1) $(el).attr('class', 'col-md-8');
  });
  $("#" + tableId).parent().parent().prev().css('margin-top', '15px');
  $("#" + tableId).parent().parent().prev().children().each(function(index, el) {
    if(index == 0) $(el).attr('class', 'col-sm-5');
    if(index == 1) $(el).attr('class', 'col-sm-7');
  });
  $("div#" + tableId + "_filter > label > input")
    .attr('placeholder', "Search")
    .attr('style', 'width: 170px !important');
  $("select[name=" + tableId + "_length]").css('width', '120px');;
  $("select[name=" + tableId + "_length]")
    .prepend('<option value="5">5</option>')
    .append('<option value="200">200</option>')
    .append('<option value="500">500</option>')
    .append('<option value="999999999">All</option>');
  $("select[name=" + tableId + "_length]").val('5');
  $("select[name=" + tableId + "_length]").trigger('change');
  $("select[name=" + tableId + "_length]").children('option').each(function(index, el) {
    $(el).append(' Entries');   
  });
}