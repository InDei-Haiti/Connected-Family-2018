$(document).ready(function() {
  // Update Profile Picture
  var imgState = 'danger';
  var imgMsg = "Select a picture!";
  $('#pp-picture-input').bind('change', function (){ checkPictureValidation('#pp-picture-input', true) });
  function checkPictureValidation(field, animate) {
    $('#pp-picture-btn').attr('disabled', 'disabled');
    var file = $(field)[0].files[0];
    if(!file){
      imgState = 'danger';
      imgMsg = "You haven't selected a picture!";
      animate = true;
    } else {
      var fileType = file["type"];
      var fileSize = file["size"];
      var maxSizeMB = 1;
      var maxSize = 1024 * 1024 * maxSizeMB; 
      var ValidImageTypes = ["image/jpeg", "image/png"];
      if ($.inArray(fileType, ValidImageTypes) !== -1) {
        if(fileSize < maxSize){
          imgState = 'success';
          imgMsg = "Picture is vaild. You are ready to upload it.";
        } else {
          imgState = 'danger';
          imgMsg = "Exceeds maximum allowed photo size. Max photo size is " + maxSizeMB + "MB";
        }
      } else {
        imgState = 'danger';
        imgMsg = "Invaild format. Allowed formats are png and jpeg(jpg) only.";
      }
    }
    if(animate){
      $("#pp-picture-text").removeClass('text-success')
        .removeClass('text-warning')
        .removeClass('text-danger')
        .addClass('text-' + imgState)
        .html(imgMsg)
        .show(timeConst);
        // .delay(delayConst)
        // .hide(timeConst);
      if(imgState == 'success') $('#pp-picture-btn').removeAttr('disabled');
    }
    return imgState;
  }

});