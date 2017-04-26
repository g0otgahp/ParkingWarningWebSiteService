<div class="col-md-12">

  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">person</i> สมาชิก</h3>
      <!-- <p class="category">Here is a subtitle for this table</p> -->
    </div>
    <div class="card-content ">
      <div class="row">
        <form ng-submit="find()">
          <div align="center" class="col-md-3 form-control-label">
            <label>ค้นหาจากวันทีลงทะเบียน</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" ng-model="date.ds" moment-picker="date.ds">
          </div>
          <div class="col-md-1 form-control-label">
            <label >ถึงวันที่</label>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" ng-model="date.de" moment-picker="date.de">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-info"><i class="material-icons">done</i> ค้นหา</button>
          </div>
        </form>
      </div>
      <div class="row" >
        <div class="col-md-12 table-responsive">
      <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
        <h3>ผลการค้นหา</h3>
        <p>ผลการค้นหา ทั้งหมด <span style="color:blue; font-weight:bold;">{{dt_member.length}}</span> รายการ</p>
        <thead>
          <tr class="info">
            <th width="10%">ลำดับ</th>
            <th>ชื่อ - สกุล</th>
            <th>เบอร์โทรศัพท์</th>
            <th>E-Mail</th>
            <th>ตัวเลือก</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="row in dt_member">
            <td>{{$index+1}}</td>
            <td>{{row.user_fullname}}</td>
            <td>{{row.user_phone}}</td>
            <td>{{row.user_email}}</td>
            <td align="center">
              <button ng-click="member_detail(row.user_id,0)" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="รายละเอียด">
                <i class="material-icons">details</i>
                รายละเอียด
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </table>
  </div>
</div>
</div>
</div>
</div>
