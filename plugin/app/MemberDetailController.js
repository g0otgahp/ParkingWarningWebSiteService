if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}
var PWApp = angular.module('PWApp', []);
PWApp.config(['$locationProvider', function($locationProvider){
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
}]);

PWApp.controller('MemberDetailController', function ($scope, $http, $location) {
	// var id = $location.search('mid', null);
	// console.log($location.search().mid);
	var member_id = $location.search().mid;
	$http.post(SITE_URL + '/admin/member_service/member_by_id', {'member_id': member_id}).then(function (response){
		console.log();
		$scope.memberdetail = response.data['memberdetail'];
		$scope.message = response.data['message'];
	},function (error){
	});
});
