
app.controller('CarBrandController', function ($scope, $http, $window) {


	$http.get(SITE_URL + 'admin/car_service/find_car_brand').then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.car_brand = response.data.car;
		$scope.count = response.data.count;
		$scope.car_brand_trash = response.data.car_brand_trash;
		$scope.trash = response.data.trash;
	},function (error){
	});

	$scope.car_brand_totrash = function(id){
		console.log(id);
		$http.post(SITE_URL + 'admin/car_service/car_brand_totrash',{'car_brand_id': id}).then(function (response){
			appNotify(response.data.alert.message, response.data.alert.type);
			$scope.car_brand = response.data.car;
			$scope.count = response.data.count;
			$scope.car_brand_trash = response.data.car_brand_trash;
			$scope.trash = response.data.trash;
		},function (error){
			console.log("Failed");
	});
}

$scope.car_brand_restore = function(id){
	console.log(id);
	$http.post(SITE_URL + 'admin/car_service/car_brand_restore',{'car_brand_id': id}).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.car_brand = response.data.car;
		$scope.count = response.data.count;
		$scope.car_brand_trash = response.data.car_brand_trash;
		$scope.trash = response.data.trash;
	},function (error){
		console.log("Failed");
});
}

$scope.car_brand_form = function(id){
	console.log(id);
	$window.location.href = SITE_URL + 'admin/car/car_brand_form/?cid='+id;
}

$scope.car_brand_detail = function(id){
	console.log(id);
	$window.location.href = SITE_URL + 'admin/car/car_brand_detail/?cid='+id;
}

});
