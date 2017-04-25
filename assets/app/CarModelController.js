
app.controller('CarModelController', function ($window,$location,$scope, $http, $window) {
	var bid = $location.search().bid;
	$http.post(SITE_URL + 'admin/car_service/find_car_model_list',{'car_brand_id': bid}).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.car_model = response.data.car_model;
		$scope.count = response.data.count;
	},function (error){
	});

	$scope.car_model_delete = function(mid,bid){
		var data = {
			car_bid: bid,
			car_mid: mid
		}
		$http.post(SITE_URL + 'admin/car_service/car_model_delete', data).then(function (response){
			appNotify(response.data.alert.message, response.data.alert.type);
			$scope.car_model = response.data.car_model;
			$scope.count = response.data.count;
		},function (error){
			console.log("Fail");
		});
	}


$scope.car_model_form = function(mid,bid){
	$window.location.href = SITE_URL + 'admin/car/car_model_form/?mid='+mid+'&bid='+bid;
}

});
