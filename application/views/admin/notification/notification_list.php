<div class="col-md-12">
  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">notifications</i> ตารางการแจ้งเตือน</h3>
      <!-- <p class="category">Here is a subtitle for this table</p> -->
    </div>
    <div class="card-content ">
    <div class="row">
      <div class="col-md-12 table-responsive">
        <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
          <thead>
            <tr class="info">
              <th width="3%">ลำดับ</th>
              <th width="17%">วันที่/เวลา</th>
              <th width="11%">ทะเบียนรถ</th>
              <th width="11%">จังหวัด</th>
              <th width="11%">ยี่ห้อ</th>
              <th width="17%">ผู้แจ้งเตือน</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="row in dt_notification">
              <td>{{$index+1}}</td>
              <td>{{row.notification_date | amDateFormat:"DD MMMM YYYY HH:MMน."}}</td>
              <td>
                <a href="#" ng-click="member_detail(row.user_id,row.car_id)">
                  {{row.car_license_plate}}
                </a>
              </td>
              <td>{{row.province_name}}</td>
              <td>{{row.car_brand_name}}</td>
              <td align="left">
                <a href="#" ng-click="member_detail(row.user_id_send,0)">
                  {{row.user_fullname_send}}
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
