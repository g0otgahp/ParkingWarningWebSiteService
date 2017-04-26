app.controller('ReportBrandController',
function($http, $scope, DTOptionsBuilder, DTColumnDefBuilder, $window) {

  $http.get(SITE_URL + 'admin/report_service/report_brand').then( function (response) {
    appNotify(response.data.alert.message, response.data.alert.type);
    $scope.dt_report_brand = response.data.car_by_brand;
  }, function(error) {
    console.log(error);
  });

$scope.dtOptions = DTOptionsBuilder
.newOptions()
.withPaginationType('full_numbers')
.withButtons([
  {
    extend:    'print',
    text:     btn_print,
    exportOptions: {
      columns: [0, 2, 3]
    },
    titleAttr: 'Print'
  },
  {
    extend:    'excelHtml5',
    text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
    exportOptions: {
      columns: [0, 2, 3]
    },
    titleAttr: ''
  },
])
.withLanguage(language_th);

});
