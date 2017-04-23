app.controller('CarController',
function($http, $scope, DTOptionsBuilder, DTColumnDefBuilder) {

  $http.get(SITE_URL + '/admin/car_service/home').then( function (response) {
    // appNotify(ข้อความ, ประเภทการแจ้ง);
    // ส่งจาก CI Service
    appNotify(response.data.alert.message, response.data.alert.type);
    // select list
    $scope.dt_province = response.data.provinces;
    $scope.dt_make = response.data.makes;
    $scope.dt_color = response.data.colors;
    // datatables
    $scope.dt_car = response.data.cars;
    $scope.dtOptions = DTOptionsBuilder
    .fromSource()
    .withPaginationType('full_numbers')
    .withButtons([
      {
        extend:    'print',
        text:     btn_print,
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7]
        },
        titleAttr: 'Print'
      },
      {
        extend:    'excelHtml5',
        text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7]
        },
        titleAttr: ''
      },
    ])
    .withLanguage(language_th);

  }, function(error) {
    console.log(error);
  });

  $scope.selectCarModels = function(data) {
    console.log($scope.makes_id);
    data = {
      makes_id : $scope.makes_id
    }
    $http.post(SITE_URL + '/admin/car_service/find_models', data).then( function (response) {
      console.log(response.data.models);

      $scope.dt_model = response.data.models;
    }, function(error) {
      console.log(error);
    });
  }

});
