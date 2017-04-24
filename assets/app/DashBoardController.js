app.controller('DashboardController',
function ($http, $scope, $location, DTOptionsBuilder, DTColumnBuilder, DTColumnDefBuilder) {


	$http.get(SITE_URL + 'admin/Dashboard_service/Dashboard').then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.notification = response.data.notification;
		$scope.car = response.data.car;
		$scope.user = response.data.user;
		$scope.news = response.data.news;
		$scope.count = response.data.count;

		$scope.current_month = new Date();

		$scope.labels = response.data.chart.labels;
		$scope.data = response.data.chart.notification;
		// 
		// console.log($scope.labels);
		// console.log($scope.data);
		//
		// $scope.onClick = function (points, evt) {
		// 	console.log(points, evt);
		// };
});
});
