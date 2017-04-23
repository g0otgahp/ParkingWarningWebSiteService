<div class="row">
  <div class="col-md-12 table-responsive">
    <h3>ผลการค้นหา</h3>
    <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>วันที่แจ้ง</th>
          <th>ผู้แจ้งเตือน</th>
          <!-- <th>สถานะ</th> -->
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="row in car_not">
          <td>{{$index+1}}</td>
          <td>{{row.notification_date}}</td>
          <td>{{row.user_fullname}}</td>
          <!-- <td>{{row.notification_status}}</td> -->
    </tr>
  </tbody>
</table>
</div>

</div>
