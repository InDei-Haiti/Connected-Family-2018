var timeConst = 200;
var delayConst = 5000;
var __ERROR_MSG__ = '<b>There is an ERROR</b>. Reload the page and try again if the same message is appeared, Please contact us at <a href="mailto:it@connected-family.org">it@connected-family.org</a> and describe your issue.';

$("#myAlert > .close").click(function () { $(this).parent().slideUp(timeConst); });