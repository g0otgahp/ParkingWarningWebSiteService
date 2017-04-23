
if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}


app.controller('NewsController', function ($scope, $http) {


	$http.get(SITE_URL + '/admin/news_service/newslist').then(function (response){
		$scope.news = response.data['news'];
	},function (error){

	});
});
