app.controller('ReportController', function($http, $scope, DTOptionsBuilder, DTColumnDefBuilder, $window) {
  $scope.data_list = [];
	$scope.date = {};
	$scope.date.ds = moment(new Date()).format();
	$scope.date.de = moment(new Date()).format();

$scope.dtOptions = DTOptionsBuilder
.newOptions()
.withPaginationType('full_numbers')
.withButtons([
  {
    extend:    'print',
    text:     btn_print,
    exportOptions: {
      columns: [0, 1, 2]
    },
    titleAttr: 'Print'
  },
  {
    extend:    'excelHtml5',
    text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
    exportOptions: {
      columns: [0, 1, 2]
    },
    titleAttr: ''
  },
])
.withLanguage(language_th);

$scope.find_report_noti = function() {
  var data = {
    ds: moment($scope.date.ds).format(),
    de: moment($scope.date.de).format()
  }
  $http.post(SITE_URL + 'admin/report_service/find_report_noti', data).then( function (response) {
    appNotify(response.data.alert.message, response.data.alert.type);
    $scope.dt_report_noti = response.data.car_noti;
  }, function(error) {
    console.log(error);
  });
}

});
