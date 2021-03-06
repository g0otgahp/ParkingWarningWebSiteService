app.controller('NewsSendController', function ($scope, $http, $location, DTOptionsBuilder, DTColumnDefBuilder, Helper ,$window) {
	// console.log($location.search().nid);
	$http.get(SITE_URL + 'admin/car_service/home').then( function (response) {
    $scope.dt_province = response.data.provinces;
    $scope.dt_brand_year = response.data.makes;
    $scope.dt_brand = response.data.brand;
    $scope.dt_color = response.data.color;
		$scope.dt_car = 0;
    $scope.data_list = [];
    $scope.date = {};
    // $scope.date.ds = moment(new Date()).format()
    // $scope.date.de = moment(new Date()).format()
		$scope.news_id = $location.search().nid;
  }, function(error) {
    console.log(error);
  }
);

$scope.selectCarModels = function(data) {
  data = {
    car_brand_year_id : $scope.car_brand_year_id,
    car_brand_id : $scope.car_brand_id
  }
  $http.post(SITE_URL + 'admin/car_service/find_models', data).then( function (response) {
    $scope.dt_model = response.data.models;
  }, function(error) {
    console.log(error);
  });
};

$scope.selectCarYears = function(data) {
  data = {
    car_brand_id : $scope.car_brand_id
  }
  $http.post(SITE_URL + 'admin/car_service/find_year', data).then( function (response) {
    $scope.dt_year = response.data.year;
  }, function(error) {
    console.log(error);
  });
};

$scope.findcar = function() {

			if ($scope.date.ds === undefined) {
				var ds = 0;
			} else {
				var ds = moment($scope.date.ds).format();
			}

			if ($scope.date.de === undefined) {
				var de = 0;
			} else {
				var de = moment($scope.date.de).format();
			}

  var data = {
		news_id : $scope.news_id,
		car_brand_id : $scope.car_brand_id,
    car_model_name : $scope.car_model_id,
    car_brand_year_id : $scope.car_brand_year_id,
    car_color : $scope.car_color_id,
    car_province : $scope.province_id,
		ds: ds,
		de: de,
		num: $scope.car_num
  }

  $http.post(SITE_URL + 'admin/car_service/find_news_car', data).then( function (response) {
    appNotify(response.data.alert.message, response.data.alert.type);
    $scope.dt_car = response.data.car;
		$scope.history = response.data.history;
  }, function(error) {
    console.log(error);
  }
);
}

$scope.news_accept = function(num) {
  var data = {
		news_id : $scope.news_id,
    car_brand_id : $scope.car_brand_id,
    car_model_id : $scope.car_model_id,
    car_color : $scope.car_color_id,
    car_province : $scope.province_id,
    ds: moment($scope.date.ds).format(),
    de: moment($scope.date.de).format(),
		num: num,
  }
	console.log(data);
  $http.post(SITE_URL + 'admin/car_service/news_accpet', data).then( function (response) {
		var id = response.data.history;
		$window.location.href = SITE_URL + 'admin/report/report_news_history';
  }
, function(error) {
    console.log(error);
  }
);
}

$scope.news_send_cancel = function(){
	$window.location.href = SITE_URL + 'admin/news';
}

});
