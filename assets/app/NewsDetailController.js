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
		$scope.user = response.data.user;
	},function (error){
	});

$scope.news_send = function(nid){
	$window.location.href = SITE_URL + 'admin/news/news_send/?nid='+nid;
}

$scope.member_detail = function(id,cid) {
	console.log(id);
	console.log(cid);
	$window.location.href = SITE_URL + 'admin/member/memberdetail/?mid='+id+'&cid='+cid;
}

});
