if (typeof jQuery === "undefined") {
  throw new Error("jQuery plugins need to be before this file");
}
// window.onload = function() {
//   if (!window.location.hash) {
//     window.location = window.location + '#loaded';
//     window.location.reload();
//   }
// }
$(function () {
    //Widgets count
    $('.count-to').countTo();

    //Sales count to
    $('.sales-count-to').countTo({
        formatter: function (value, options) {
            return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
        }
    });

    // initRealTimeChart();
    // initDonutChart();
    // initSparkline();
});


var SelectizeOptions = function(list, id, text) {
  var new_list = [];
  for (var i = 0; i < list.length; i++) {
    new_list.push({value: list[i][id], text: list[i][text]
    });
  }
  return new_list;

}
$(function() {
  $("div.slimScrollDiv ul.list li a").each(function() {
    if ($(this).attr("href") == thisURL) {
      $(this).parent().addClass('active');
    }
  })
});
var appNotify = function(alert_message, alert_type) {
  $.notify({
    message: alert_message
  }, {type: alert_type});
}
var btn_print = '<button type="button" class="btn btn-raised btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>';
var app = angular.module('mainApp', [
  'datatables',
  'datatables.tabletools',
  'datatables.buttons',
  'datatables.select',
  'datatables.columnfilter',
  'ngSanitize',
  'ngAnimate',
  'ngResource',
  'selectize',
  'froala',
  'ur.file',
  'ngUpload',
  'angularMoment',
  'moment-picker',
  'angular-barcode',
  'angularModalService'
]);
SITE_URL + 'admin/helper/img_upload'
app.run(function($rootScope, $location, $window) {
  var iURL = $location.path();
  // console.log(iURL);

  $rootScope.$watch(function() {
    return $location.path();
  }, function(a) {
    if (iURL != a) {
      $window.location.reload();
    }
    // console.log('url has changed: ' + a);
    // show loading div, etc...
  });
});
app.run(function($rootScope) {
  $rootScope.typeOf = function(value) {
    return typeof value;
  };
}).directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value);
      });
    }
  };
});
app.config([
  '$locationProvider',
  function($locationProvider) {
    $locationProvider.html5Mode({enabled: true, requireBase: false});
  }
]);
app.config([
  'momentPickerProvider',
  function(momentPickerProvider) {
    momentPickerProvider.options({
      /* Picker properties */
      locale: 'th',
      format: 'DD MMMM YYYY',
      minView: 'month',
      maxView: 'month',
      startView: 'year',
      autoclose: true,
      today: false,
      keyboard: false,

      /* Extra: Views properties */
      leftArrow: '&larr;',
      // rightArrow: '&rarr;',
      // yearsFormat: 'YYYY',
      // monthsFormat: 'MMMM',
      // daysFormat: 'D',
    });
  }
]);
app.filter('bdate', function($filter)
{
  return function(input)
  {
    if(input == null){ return ""; }
    var bYears=544;
    //Please write the formula for getting the buddhist date here
    //Below is a rough conversion of adding 365*bYears days to todays date

    // Convert 'days' to milliseconds
    var millies = 1000 * 60 * 60 * 24 * 365 * bYears;
    var d = new Date(input).getTime()+millies;
    var _date = $filter('date')(new Date(d), 'dd MMMM yyyy');

    return _date.toUpperCase();

  };
});
app.factory('Helper', function($http, httpPostFactory) {

  var _clear_input_file = function() {
    angular.forEach(angular.element("input[type='file']"), function(inputElem) {
      angular.element(inputElem).val(null);
    });
  };
  var _login = function(user) {
    return $http.post(SITE_URL + '/admin/helper/login', user);
  };

  return {Login: _login, ClearInputFile: _clear_input_file};

});

app.factory('Dashboard', function($http) {

  var _count = function() {
    return $http.get(SITE_URL + 'admin/dashboard/dashboard_count');
  };
  var _chart = function() {
    return $http.get(SITE_URL + 'admin/dashboard/dashboard_chart');
  };
  return {Count: _count, Chart: _chart};

});
app.factory('Customer', function($http) {
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/customer/customer_list', data);
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/customer/customer_save', data);
  };
  var _find = function(data) {
    return $http.post(SITE_URL + '/admin/customer/customer_find', data);
  };
  return {List: _list, Save: _save, Find: _find};

});
app.factory('Province', function($http) {
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/province/province_list', data);
  };

  return {List: _list};

});
app.factory('District', function($http) {
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/district/district_list', data);
  };
  var _find = function(data) {
    return $http.post(SITE_URL + '/admin/district/district_find', data);
  };
  return {List: _list, Find: _find};

});
app.factory('Amphur', function($http) {
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/amphur/amphur_list', data);
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/amphur/amphur_find', data);
  };
  return {List: _list, Find: _find};

});
app.factory('Zipcode', function($http) {
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/customer/customer_list', data);
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/customer/customer_save', data);
  };

  return {List: _list, Save: _save};

});
app.factory('Report', function($http) {

  var _sale_order = function(data) {
    console.log(data);
    return $http.post(SITE_URL + 'admin/report/sale_order', data);
  };
  var _stock_in = function(data) {
    console.log(data);
    return $http.post(SITE_URL + 'admin/report/stock_in', data);
  };
  var _stock_out = function(data) {
    console.log(data);
    return $http.post(SITE_URL + 'admin/report/stock_out', data);
  };
  var _sale_products = function(data) {
    console.log(data);
    return $http.post(SITE_URL + 'admin/report/sale_products', data);
  };
  var _sale_customers = function(data) {
    console.log(data);
    return $http.post(SITE_URL + 'admin/report/sale_customers', data);
  };

  return {SaleOrder: _sale_order, StockIn: _stock_in, StockOut: _stock_out, SaleProducts: _sale_products, SaleCustomers: _sale_customers};
});

app.factory('Sale', function($http) {
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/sale/sale_save', data);
  };
  var _update = function(data) {
    return $http.post(SITE_URL + 'admin/sale/sale_update', data);
  };
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/sale/sale_list');
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/sale/sale_find', data);
  };
  return {Save: _save, Update: _update, List: _list, Find: _find};
});

app.factory('Quotation', function($http) {
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/quotation/quotation_save', data);
  };
  var _update = function(data) {
    return $http.post(SITE_URL + 'admin/quotation/quotation_update', data);
  };
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/quotation/quotation_list');
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/quotation/quotation_find', data);
  };
  return {Save: _save, Update: _update, List: _list, Find: _find};
});

app.factory('Stock', function($http) {
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/stock/stock_save', data);
  };

  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/stock/stock_list');
  };

  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/stock/stock_find', data);
  };

  var _limit_list = function(data) {
    return $http.get(SITE_URL + 'admin/stock/stock_limit_list', data);
  };
  var _limit_save = function(data) {
    return $http.post(SITE_URL + 'admin/stock/stock_limit_save', data);
  };
  return {
    Save: _save,
    List: _list,
    Find: _find,
    Limit: {
      List: _limit_list,
      Save: _limit_save
    }
  };
});
app.factory('ProductCate', function($http) {
  var prodCateList = function() {
    return $http.get(SITE_URL + 'admin/product_cate/product_cate_list');
  };

  return {ProdCateList: prodCateList};

});
app.factory('Product', function($http) {
  var _list = function(data) {
    return $http.get(SITE_URL + 'admin/product/product_list', data);
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/product/product_save', data);
  };

  return {List: _list, Save: _save};

});
app.factory('User', function($http) {
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/user/user_find', data);
  };

  return {Find: _find};

});
app.factory('Employee', function($http) {
  var _list = function() {
    return $http.get(SITE_URL + 'admin/employee/employee_list');
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/employee/employee_save', data);
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/employee/employee_find', data);
  };

  return {List: _list, Save: _save, Find: _find};

});
app.factory('EmployeeLevel', function($http) {
  var _list = function() {
    return $http.get(SITE_URL + 'admin/employee_level/employee_level_list');
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/employee_level/employee_level_save', data);
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/employee_level/employee_level_find', data);
  };
  return {List: _list, Save: _save, Find: _find};

});
app.factory('Store', function($http) {
  var _list = function() {
    return $http.get(SITE_URL + 'admin/store/store_list');
  };
  var _store_list_without_main = function() {
    return $http.get(SITE_URL + 'admin/store/store_list_without_main');
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/store/store_save', data);
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/store/store_find', data);
  };
  return {List: _list, Save: _save, ListWithOutMain: _store_list_without_main, Find:_find};

});
app.factory('Invoice', function($http) {
  var _list = function() {
    return $http.get(SITE_URL + 'admin/store/store_list');
  };
  var _find = function() {
    return $http.get(SITE_URL + 'admin/store/store_list_without_main');
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/invoice/invoice_save', data);
  };

  return {List: _list, Save: _save, Find: _find};

});
app.factory('Delivery', function($http) {
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/delivery/delivery_save', data);
  };

  return {Save: _save};

});
app.factory('Debtor', function($http) {
  var _list = function() {
    return $http.get(SITE_URL + 'admin/debtor/debtor_list');
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/debtor/debtor_find', data);
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/debtor/debtor_save', data);
  };

  return {List: _list, Save: _save, Find: _find};
});
app.factory('Bill', function($http) {
  var _list = function() {
    return $http.get(SITE_URL + 'admin/billing/billing_list');
  };
  var _find = function(data) {
    return $http.post(SITE_URL + 'admin/billing/billing_find', data);
  };
  var _save = function(data) {
    return $http.post(SITE_URL + 'admin/billing/billing_save', data);
  };

  return {List: _list, Save: _save, Find: _find};
});
app.directive('imgUpload', function(httpPostFactory) {
  return {
    restrict: 'EA',
    scope: {
      store_logo: "=bind"
    },
    link: function(scope, element, attr) {

      element.bind('change', function() {
        var formData = new FormData();
        formData.append('file', element[0].files[0]);
        httpPostFactory(SITE_URL + 'admin/helper/img_upload', formData, function(callback) {
          // recieve image name to use in a ng-src
          scope.store_logo = callback.data.link;
        });
      });

    },
    // template:   '<img ng-model="{{store_logo}}">'
  }
});
app.factory('httpPostFactory', function($http) {
  return function(file, data, callback) {
    $http({
      url: file,
      method: "POST",
      data: data,
      headers: {
        'Content-Type': undefined
      }
    }).then(function(response) {
      callback(response);
    });
  };
});
