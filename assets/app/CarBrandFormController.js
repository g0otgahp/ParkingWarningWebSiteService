app.config(['$locationProvider', function($locationProvider){
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
}]);

app.controller('CarBrandFormController', function ($scope, $http, $location, DTOptionsBuilder, DTColumnDefBuilder, Helper ,$window) {
	var cid = $location.search().cid;
	$http.post(SITE_URL + 'admin/car_service/car_brand_by_id', {'car_brand_id': cid}).then(function (response){
		$scope.car_brand = response.data.car_brand[0];
		console.log($scope.car_brand);
	},function (error){
	});


$scope.car_brand_save = function(data){
	data = $scope.car_brand;
	$http.post(SITE_URL + 'admin/car_service/car_brand_save', data).then(function (response){
	$window.location.href = SITE_URL + 'admin/car/car_brand';
	},function (error){
		console.log("Fail");
	});
}

});
