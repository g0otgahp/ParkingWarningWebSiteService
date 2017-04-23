<div class="col-md-12">

  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">content_paste</i> รายงานจำนวนรถตามสมาชิก</h3>
      <!-- <p class="category">Here is a subtitle for this table</p> -->
    </div>
    <div class="card-content ">
      <div class="row" >
        <form ng-submit="find_report_car_by_user()">
          <div align="center" class="col-md-3 form-control-label" >
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
      <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
        <p>ผลการค้นหา จำนวนการแจ้งเตือนทั้งหมด <span style="color:blue; font-weight:bold;">{{dt_report_user.length}}</span> รายการ</p>
        <thead>
          <tr class="info">
            <th width="10%">ลำดับ</th>
            <th>สมาชิก</th>
            <th>จำนวนรถ (คัน)</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="row in dt_report_user">
            <td>{{$index+1}}</td>
            <td>{{row.user_fullname}}</td>
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
