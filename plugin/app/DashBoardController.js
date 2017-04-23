if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}
var PWApp = angular.module('PWApp', []);

PWApp.controller('DashBoardController', function ($scope, $http, $window, $location) {

	// altair_helpers.content_preloader_show('md');
	$http.get(SITE_URL + '/admin/dashboard_service/welcome').then(function (response){
		$scope.message = response.data;
		// altair_helpers.content_preloader_hide();
	},function (error){
	});
});
