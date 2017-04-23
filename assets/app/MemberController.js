app.controller('MemberController', function ($scope, $http, $window, DTOptionsBuilder, DTColumnDefBuilder) {
	$scope.data_list = [];
	$scope.date = {};
	$scope.date.ds = moment(new Date()).format();
	$scope.date.de = moment(new Date()).format();

	$scope.dtOptions = DTOptionsBuilder
	.newOptions()
	.withPaginationType('full_numbers')
	.withButtons([
	  {
	    extend:    'print',
	    text:     btn_print,
	    exportOptions: {
	      columns: [0, 1, 2, 3]
	    },
	    titleAttr: 'Print'
	  },
	  {
	    extend:    'excelHtml5',
	    text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
	    exportOptions: {
	      columns: [0, 1, 2, 3]
	    },
	    titleAttr: ''
	  },
	])
	.withLanguage(language_th);

	$scope.find = function() {
		var date = {
                ds: moment($scope.date.ds).format(),
                de: moment($scope.date.de).format()
            }
	$http.post(SITE_URL + 'admin/member_service/member', date).then(function (response){
		appNotify(response.data.alert.message, response.data.alert.type);
		$scope.dt_member = response.data.member;
	},function (error){
	});
}

	$scope.member_detail = function(id,cid) {
		console.log(id);
    console.log(cid);
		$window.location.href = SITE_URL + 'admin/member/memberdetail/?mid='+id+'&cid='+cid;
	}

});
