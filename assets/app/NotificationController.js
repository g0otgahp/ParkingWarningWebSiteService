app.controller('NotificationController',
function($http, $scope, DTOptionsBuilder, DTColumnDefBuilder, $window) {

  $http.get(SITE_URL + 'admin/notification_service/notification_all').then( function (response) {
    appNotify(response.data.alert.message, response.data.alert.type);
    $scope.dt_notification = response.data.car_noti;
    console.log($scope.dt_notification);
  }, function(error) {
    console.log(error);
  }
);

$scope.dtOptions = DTOptionsBuilder
.newOptions()
.withPaginationType('full_numbers')
.withButtons([
  {
    extend:    'print',
    text:     btn_print,
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5]
    },
    titleAttr: 'Print'
  },
  {
    extend:    'excelHtml5',
    text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
    exportOptions: {
      columns: [0, 1, 2, 3, 4, 5]
    },
    titleAttr: ''
  },
])
.withLanguage(language_th);


$scope.member_detail = function(id,cid) {
  $window.location.href = SITE_URL + 'admin/member/memberdetail/?mid='+id+'&cid='+cid;
};

});
