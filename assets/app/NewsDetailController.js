app.config(['$locationProvider', function($locationProvider){
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
}]);

app.controller('NewsDetailController', function ($scope, $http, $location, DTOptionsBuilder, DTColumnDefBuilder, Helper ,$window) {
	// console.log($location.search().nid);
	var news_id = $location.search().nid;
	$http.post(SITE_URL + 'admin/news_service/news_by_id', {'news_id': news_id}).then(function (response){
		// console.log(response.data.news[0]);
		$scope.news = response.data.news[0];
	},function (error){
	});

$scope.news_send = function(nid){
	$window.location.href = SITE_URL + 'admin/news/news_send/?nid='+nid;
}

});
