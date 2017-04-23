app.controller('CarController',
function($http, $scope, DTOptionsBuilder, DTColumnDefBuilder, $window) {

  $http.get(SITE_URL + 'admin/car_service/home').then( function (response) {
    $scope.dt_province = response.data.provinces;
    $scope.dt_brand_year = response.data.makes;
    $scope.dt_brand = response.data.brand;
    $scope.dt_color = response.data.color;
    $scope.dt_car = response.data.cars;
    $scope.data_list = [];
    $scope.date = {};
    $scope.date.ds = moment(new Date()).format()
    $scope.date.de = moment(new Date()).format()
  }, function(error) {
    console.log(error);
  }
);

$scope.dtOptions = DTOptionsBuilder
.newOptions()
.withPaginationType('full_numbers')
.withButtons([
  {
    extend:    'print',
    text:     btn_print,
    exportOptions: {
      columns: [0,1, 2, 3, 4, 5, 6, 7]
    },
    titleAttr: 'Print'
  },
  {
    extend:    'excelHtml5',
    text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
    exportOptions: {
      columns: [0,1, 2, 3, 4, 5, 6, 7]
    },
    titleAttr: ''
  },
])
.withLanguage(language_th);

$scope.selectCarModels = function(data) {
  data = {
    car_brand_id : $scope.car_brand_id
  }
  $http.post(SITE_URL + 'admin/car_service/find_models', data).then( function (response) {
    $scope.dt_model = response.data.models;
  }, function(error) {
    console.log(error);
  });
};

$scope.member_detail = function(id,cid) {
  $window.location.href = SITE_URL + 'admin/member/memberdetail/?mid='+id+'&cid='+cid;
};

$scope.findcar = function() {
  var data = {
    car_brand_id : $scope.car_brand_id,
    car_model_id : $scope.car_model_id,
    car_color : $scope.car_color_id,
    car_province : $scope.province_id,
    ds: moment($scope.date.ds).format(),
    de: moment($scope.date.de).format()
  }
  $http.post(SITE_URL + 'admin/car_service/find_car', data).then( function (response) {
    appNotify(response.data.alert.message, response.data.alert.type);
    $scope.dt_car = response.data.car;
  }, function(error) {
    console.log(error);
  }
);
}

});
