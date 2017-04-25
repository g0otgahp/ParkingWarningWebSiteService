app.config(['$locationProvider', function($locationProvider){
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
}]);

app.controller('CarModelFormController', function ($scope, $http, $location, DTOptionsBuilder, DTColumnDefBuilder, Helper ,$window) {

	var data = {
    bid: $location.search().bid,
    mid: $location.search().mid
  }

	$http.post(SITE_URL + 'admin/car_service/car_model_by_id', data).then(function (response){
		$scope.car_model = response.data.car_model[0];
	},function (error){
	});


$scope.car_model_save = function(data){
	data = $scope.car_model;
	id = $scope.car_model.car_brand_id
	$http.post(SITE_URL + 'admin/car_service/car_model_save', data).then(function (response){
	$window.location.href = SITE_URL + 'admin/car/car_model/?bid='+id;
	},function (error){
		console.log("Fail");
	});
}

});
