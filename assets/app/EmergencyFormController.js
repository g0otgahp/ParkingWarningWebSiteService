app.config(['$locationProvider', function($locationProvider){
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
}]);

app.controller('EmergencyFormController', function ($scope, $http, $location, DTOptionsBuilder, DTColumnDefBuilder, Helper ,$window) {
	console.log($location.search().nid);
	var emergency_id = $location.search().nid;
	$http.post(SITE_URL + 'admin/emergency_service/emergency_by_id', {'emergency_phone_id': emergency_id}).then(function (response){
		console.log(response.data.emergency[0]);
		$scope.emergency = response.data.emergency[0];
	},function (error){
	});


$scope.emergency_save = function(data){
	data = $scope.emergency;
	console.log($scope.emergency);
	$http.post(SITE_URL + 'admin/emergency_service/emergency_save', data).then(function (response){
	$window.location.href = SITE_URL + '/admin/emergency/';
	console.log("Success")
	},function (error){
		console.log("Fail");
	});
}

});
