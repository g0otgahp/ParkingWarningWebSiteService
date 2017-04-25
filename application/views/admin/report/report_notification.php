<div class="col-md-12">

  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">content_paste</i> รายงานการแจ้งเตือน</h3>
      <!-- <p class="category">Here is a subtitle for this table</p> -->
    </div>
    <div class="card-content ">
      <div class="row">
        <form ng-submit="find_report_noti()">
          <div align="center" class="col-md-3 form-control-label">
            <label>ตั้งแต่วันที่</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" ng-model="date.ds" moment-picker="date.ds">
          </div>
          <div align="center" class="col-md-1 form-control-label">
            <label >ถึงวันที่</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" ng-model="date.de" moment-picker="date.de">
          </div>
          <div align="center" class="col-md-2">
            <button type="submit" class="btn btn-info"><i class="material-icons">done</i> ค้นหา</button>
          </div>
        </form>
      </div>
      <div class="row" >
        <div class="col-md-12 table-responsive">
      <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
        <p>ผลการค้นหา จำนวนการแจ้งเตือนทั้งหมด <span style="color:blue; font-weight:bold;">{{dt_report_noti.length}}</span> รายการ</p>
        <thead>
          <tr class="info">
            <th width="10%">ลำดับ</th>
            <th>วันที</th>
            <th>จำนวนแจ้งเตือน</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="row in dt_report_noti">
            <td>{{$index+1}}</td>
            <td>{{row.notification_date_only | amDateFormat:"DD MMMM YYYY"}}</td>
            <td>{{row.num}}</td>
          </tr>
        </tbody>
      </table>
    </table>
  </div>
</div>
</div>
</div>
</div>
