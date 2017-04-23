if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}
var PWApp = angular.module('PWApp', []);

PWApp.controller('MemberController', function ($scope, $http, $window) {
	$scope.member_detail = function(id) {
		$window.location.href = SITE_URL + '/admin/member/memberdetail/?mid='+id;
	}
	$http.get(SITE_URL + '/admin/member_service/member').then(function (response){
		$scope.member = response.data;
	},function (error){
	});
});
