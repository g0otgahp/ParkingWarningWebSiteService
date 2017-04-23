app.config(['$locationProvider', function($locationProvider){
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
}]);

app.controller('MemberDetailController', function ($scope, $http, $location) {
	console.log($location.search().mid);
	console.log($location.search().cid);
	var member_id = $location.search().mid;
	var car_id = $location.search().cid;
	$http.post(SITE_URL + 'admin/member_service/member_by_id', {'member_id': member_id,'car_id': car_id}).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);

		$scope.member = response.data.member;
		$scope.member_car = response.data.member_car;
		$scope.alert = response.data.alert;
		$scope.car_select = response.data.car_select;
		$scope.car_not = response.data.car_not;

		console.log(response.data.member);
		console.log(response.data.member_car);
		console.log(response.data.alert);
		console.log(response.data.car_select);
		console.log(response.data.car_not);
	},function (error){
	});

	$scope.member_detail = function(id,cid) {
		console.log(id);
		console.log(cid);
	$http.post(SITE_URL + 'admin/member_service/member_by_id', {'member_id': id,'car_id': cid}).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.member = response.data.member;
		$scope.member_car = response.data.member_car;
		$scope.alert = response.data.alert;
		$scope.car_select = response.data.car_select;
		$scope.car_not = response.data.car_not;

		console.log(response.data.member);
		console.log(response.data.member_car);
		console.log(response.data.alert);
		console.log(response.data.car_select);
		console.log(response.data.car_not);
	},function (error){
	});
}
});
