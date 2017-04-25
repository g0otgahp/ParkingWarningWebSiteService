<div class="col-md-12">

  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">content_paste</i> รายงานจำนวนรถตามสมาชิก</h3>
      <!-- <p class="category">Here is a subtitle for this table</p> -->
    </div>
    <div class="card-content ">
      <div class="row" >
        <form ng-submit="find_report_news_history()">
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
      <div class="row" >
        <div class="col-md-12 table-responsive">
      <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
        <p>ผลการค้นหา จำนวนการส่งข่าวทั้งหมด <span style="color:blue; font-weight:bold;">{{dt_report_user.length}}</span> รายการ</p>
        <thead>
          <tr class="info">
            <th width="10%">ลำดับ</th>
            <th>หัวข้อข่าว</th>
            <th>ยี่ห้อ</th>
            <th>รุ่น</th>
            <th>ปี</th>
            <th>สี</th>
            <th>จังหวัด</th>
            <th>จำนวนรถ (คัน)</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="row in dt_report_history">
            <td>{{$index+1}}</td>
            <td>{{row.news_name}}</td>

            <td ng-if="row.car_brand_id != 0">{{row.car_brand_name}}</td>
            <td ng-if="row.car_brand_id == 0">ทุกยี่ห้อ</td>

            <td ng-if="row.car_model_id != 0">{{row.car_model_name}}</td>
            <td ng-if="row.car_model_id == 0">ทุกรุ่น</td>

            <td ng-if="row.car_brand_id != 0">{{row.car_brand_year}}</td>
            <td ng-if="row.car_brand_id == 0">ทุกปีผลิต</td>

            <td ng-if="row.car_color_id != 0">{{row.car_color_name}}</td>
            <td ng-if="row.car_color_id == 0">ทุกสี</td>

            <td ng-if="row.province_id != 0">{{row.province_name}}</td>
            <td ng-if="row.province_id == 0">ทุกจังหวัด</td>

            <td>{{row.car_num}}</td>
          </tr>
        </tbody>
      </table>
    </table>
  </div>
</div>
</div>
</div>
</div>
