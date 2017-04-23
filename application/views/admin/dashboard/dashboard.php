<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="orange">
        <i class="material-icons">notifications</i>
      </div>
      <div class="card-content">
        <p class="category">การแจ้งเตือน</p>
        <h3 class="title" style="font-weight:bold;">{{count.notification}} <small>รายการ</small></h3>
      </div>
      <!-- <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-danger">warning</i> <a href="#pablo">Get More Space...</a>
        </div>
      </div> -->
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="green">
        <i class="material-icons">directions_car</i>
      </div>
      <div class="card-content">
        <p class="category">จำนวนรถยนต์ที่ลงทะเบียน</p>
        <h3 class="title" style="font-weight:bold;">{{count.car}} <small>คัน</small></h3>
      </div>
      <!-- <div class="card-footer">
        <div class="stats">
          <i class="material-icons">date_range</i> Last 24 Hours
        </div>
      </div> -->
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="red">
        <i class="material-icons">info_outline</i>
      </div>
      <div class="card-content">
        <p class="category">ข่าวสาร</p>
        <h3 class="title" style="font-weight:bold;">{{count.news}} <small>ฉบับ</small></h3>
      </div>
      <!-- <div class="card-footer">
        <div class="stats">
          <i class="material-icons">local_offer</i> Tracked from Github
        </div>
      </div> -->
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="blue">
        <i class="material-icons">people</i>
      </div>
      <div class="card-content">
        <p class="category">ผู้ใช้งานแอป</p>
        <h3 class="title" style="font-weight:bold;">{{count.user}} <small>คน</small></h3>
      </div>
      <!-- <div class="card-footer">
        <div class="stats">
          <i class="material-icons">update</i> Just Updated
        </div>
      </div> -->
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header" data-background-color="green">
        <img src="<?php echo base_url('upload\images');?>\{{news[0].news_pic}} " class="img-thumbnail" height="150px">
      </div>
      <div class="card-content">
        <h4 class="title">ข่าวสารล่าสุด</h4>
        <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span> {{news[0].news_name}}</p>
        <hr>
        <p ng-bind-html="news[0].news_detail"></p>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> เมื่อ {{news[0].news_date_add | amDateFormat:"DD MMMM YYYY"}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="purple">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">ล่าสุด:</span>
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="active">
                <a href="#notification" data-toggle="tab">
                  <i class="material-icons">notifications</i>
                  แจ้งเตือน
                <div class="ripple-container"></div></a>
              </li>
              <li class="">
                <a href="#user" data-toggle="tab">
                  <i class="material-icons">person</i>
                  สมาชิก
                <div class="ripple-container"></div></a>
              </li>
              <li class="">
                <a href="#car" data-toggle="tab">
                  <i class="material-icons">directions_car</i>
                  ลงทะเบียนรถ
                <div class="ripple-container"></div></a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="card-content">
        <div class="tab-content">
          <div class="tab-pane active" id="notification">
            <span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span>
            <table class="table">
              <tbody>
                <tr ng-repeat="row in notification">
                  <td>{{row.notification_date}}</td>
                  <td>
                    <a href="#" ng-click="member_detail(row.user_id,row.car_id)">
                      {{row.car_license_plate}}
                    </a>
                  </td>
                  <td>{{row.province_name}}</td>
                  <td>{{row.car_brand_name}}</td>
                  <td>{{row.car_color_name}}
                </tr>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" id="user">
            <span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span>
            <table class="table">
              <tbody>
                <tr ng-repeat="row in user">
                  <td>{{row.user_fullname}}</td>
                  <td>{{row.user_phone}}</td>
                  <td>{{row.user_email}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="car">
            <span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span>
            <table class="table">
              <tbody>
                <tr ng-repeat="row in car">
                  <td>{{row.car_license_plate}}</td>
                  <td>{{row.province_name}}</td>
                  <td>{{row.car_brand_name}}</td>
                  <td>{{row.car_color_name}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
