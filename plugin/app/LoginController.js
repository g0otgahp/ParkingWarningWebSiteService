
if (typeof jQuery === "undefined") {
	throw new Error("jQuery plugins need to be before this file");
}

var PWApp = angular.module('PWApp', []);

PWApp.controller('LoginController', function ($scope, $http, $location, $window) {
	// Onload
	$scope.LoginFail = true;
	$scope.LoginFormStatus = true;

	$scope.CheckLogin = function(data){
		// Submit Form
		$scope.LoginFormStatus = false;
		altair_helpers.content_preloader_show('md');
		data = $scope.admin;
		// console.log(data);
		$http.post(SITE_URL + '/admin/admin_service/CheckLogin',data).then(function (response){
		// console.log(response.data.LoginStatus);
		var _status = response.data.LoginStatus;
		if (_status) {
			$window.location.href = SITE_URL + '/admin/dashboard/';
		} else {
			$scope.LoginFail = _status;
			$scope.LoginFormStatus = true;
			altair_helpers.content_preloader_hide();
			// console.log($scope.LoginFail);
		}
  },function (error){

	});
}
});
