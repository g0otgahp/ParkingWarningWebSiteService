
if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}

app.controller('DashboardController', function ($scope, $http, $window) {

	$http.get(SITE_URL + 'admin/Dashboard_service/Dashboard').then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.notification = response.data.notification;
		$scope.car = response.data.car;
		$scope.user = response.data.user;
		$scope.news = response.data.news;
		$scope.count = response.data.count;
	},function (error){
	});
});
