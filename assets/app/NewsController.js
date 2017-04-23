
if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}


app.controller('NewsController', function ($scope, $http, $window) {


	$http.get(SITE_URL + 'admin/news_service/newslist').then(function (response){
		$scope.news = response.data['news'];
		$scope.count = response.data['count'];
		$scope.news_trash = response.data['news_trash'];
		$scope.trash = response.data['trash'];

	},function (error){
	});

	$scope.news_totrash = function(id){
		console.log(id);
		$http.post(SITE_URL + 'admin/news_service/news_totrash',{'news_id': id}).then(function (response){
			appNotify(response.data.alert.message, response.data.alert.type);
			$scope.news = response.data['news'];
			$scope.count = response.data['count'];
			$scope.news_trash = response.data['news_trash'];
			$scope.trash = response.data['trash'];
		},function (error){
			console.log("Failed");
	});
}

$scope.news_restore = function(id){
	console.log(id);
	$http.post(SITE_URL + 'admin/news_service/news_restore',{'news_id': id}).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.news = response.data['news'];
		$scope.count = response.data['count'];
		$scope.news_trash = response.data['news_trash'];
		$scope.trash = response.data['trash'];
	},function (error){
		console.log("Failed");
});
}

$scope.news_form = function(id){
	console.log(id);
	$window.location.href = SITE_URL + 'admin/news/news_form/?nid='+id;
}

$scope.news_detail = function(id){
	console.log(id);
	$window.location.href = SITE_URL + 'admin/news/news_detail/?nid='+id;
}

});
