if (typeof jQuery === "undefined") {
  throw new Error("jQuery plugins need to be before this file");
}

// Active Menu
$(function() {
  $(".sidebar-wrapper ul.nav li a").each(function(){
    console.log(thisURL);
    console.log($(this).attr("href"));
    if( $(this).attr("href") == thisURL ){
    // if( $(this).attr("href") == window.location.href ){
      $(this).parent().addClass('active');
      // $(this).parent().parent().parent().children("a:first-child").addClass('toggled');
      // $(this).parent().parent().parent().children("ul").css("display", "block");
      // $(this).parent().parent().parent().addClass('act_section current_section');

    }
  })
});
var appNotify = function(alert_message, alert_type) {
  $.notify({ icon: "notifications", message: alert_message },{ type: alert_type });
}



var btn_print = '<button type="button" class="btn btn-raised btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>';
var app = angular.module(
  'mainApp',
  [
    'datatables',
    'datatables.tabletools',
    'datatables.buttons',
    'datatables.select',
    'datatables.columnfilter',
    'ngSanitize',
    'ngAnimate',
    'ngResource',
    'selectize',
    'froala',
    'ur.file',
    'ngUpload',
    'chart.js'

  ]
);
app.filter('bdate', function($filter)
{
  return function(input)
  {
    if(input == null){ return ""; }
    var bYears=544;
    //Please write the formula for getting the buddhist date here
    //Below is a rough conversion of adding 365*bYears days to todays date

    // Convert 'days' to milliseconds
    var millies = 1000 * 60 * 60 * 24 * 365 * bYears;
    var d = new Date(input).getTime()+millies;
    var _date = $filter('date')(new Date(d), 'dd MMMM yyyy');

    return _date.toUpperCase();

  };
});
