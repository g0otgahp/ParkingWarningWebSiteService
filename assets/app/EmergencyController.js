
if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}


app.controller('EmergencyController', function ($scope, $http, $window) {

	$http.get(SITE_URL + 'admin/emergency_service/emergencylist').then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.emergency = response.data['emergency'];
		$scope.count = response.data['count'];
		$scope.emergency_trash = response.data['emergency_trash'];
		$scope.trash = response.data['trash'];
	},function (error){
	});

	$scope.emergency_totrash = function(id){
		console.log(id);
		$http.post(SITE_URL + 'admin/emergency_service/emergency_totrash',{'emergency_phone_id': id}).then(function (response){
			appNotify(response.data.alert.message, response.data.alert.type);
			$scope.emergency = response.data['emergency'];
			$scope.count = response.data['count'];
			$scope.emergency_trash = response.data['emergency_trash'];
			$scope.trash = response.data['trash'];
		},function (error){
			console.log("Failed");
	});
}

$scope.emergency_restore = function(id){
	console.log(id);
	$http.post(SITE_URL + 'admin/emergency_service/emergency_restore',{'emergency_phone_id': id}).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.emergency = response.data['emergency'];
		$scope.count = response.data['count'];
		$scope.emergency_trash = response.data['emergency_trash'];
		$scope.trash = response.data['trash'];
	},function (error){
		console.log("Failed");
});
}

$scope.emergency_form = function(id){
	console.log(id);
	$window.location.href = SITE_URL + 'admin/emergency/emergency_form/?nid='+id;
}

$scope.emergency_detail = function(id){
	console.log(id);
	$window.location.href = SITE_URL + 'admin/emergency/emergency_detail/?nid='+id;
}

});
