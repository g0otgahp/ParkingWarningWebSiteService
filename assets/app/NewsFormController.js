
app.controller('NewsFormController', function ($scope, $http, $location, DTOptionsBuilder, DTColumnDefBuilder, Helper ,$window) {
	var news_id = $location.search().nid;
	console.log(news_id);

	$http.post(SITE_URL + 'admin/news_service/news_by_id', {'news_id': news_id}).then(function (response){
		$scope.news = response.data.news[0];

		console.log($scope.news);
	},function (error){
	});


$scope.news_save = function(data){
	data = $scope.news;
	$http.post(SITE_URL + 'admin/news_service/news_save', data).then(function (response){
	$window.location.href = SITE_URL + 'admin/news/';
	},function (error){
		console.log("Fail");
	});
}

});
