<div class="col-md-12">
  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">directions_car</i> เลือกรายการรถที่จะส่ง</h3>
      <button class="btn btn-raised btn-danger" ng-click="news_send_cancel()">X ยกเลิก</button>
    </div>
      <form ng-submit="findcar();">
      <input type="hidden" class="form-control" ng-model="news_id">
      <div class="card-content ">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="s1">ยี่ห้อรถยนต์</label>
              <select required ng-change="selectCarModels();" ng-model="car_brand_id" class="form-control">
                <option value="">เลือกยี่ห้อรถยนต์</option>
                <option value="0">เลือกทั้งหมด</option>
                <option ng-repeat="item in dt_brand" value="{{item.car_brand_id}}">{{item.car_brand_name}}</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="s1">รุ่นรถยนต์</label>
              <select required class="form-control" ng-model="car_model_id">
                <option value="">เลือกรุ่นรถยนต์</option>
                <option value="0">เลือกทั้งหมด</option>
                <option ng-repeat="item in dt_model" value="{{item.car_model_id}}">ปี {{item.car_brand_year}} - {{item.car_model_name}} </option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="s1">สี</label>
              <select required class="form-control" ng-model="car_color_id">
                <option value="">เลือกสี</option>
                <option value="0">เลือกทั้งหมด</option>
                <option ng-repeat="item in dt_color" value="{{item.car_color_id}}">{{item.car_color_name}}</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="s1">จังหวัด</label>
              <select required class="form-control" ng-model="province_id">
                <option value="">เลือกจังหวัด</option>
                <option value="0">เลือกทั้งหมด</option>
                <option ng-repeat="item in dt_province" value="{{item.province_id}}">{{item.province_name}}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="s1">วันที่ลงทะเบียน (เริ่ม)</label>
              <input type="text" class="form-control" ng-model="date.ds" moment-picker="date.ds">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="s1">วันที่ลงทะเบียน (สิ้นสุด)</label>
              <input type="text" class="form-control" ng-model="date.de" moment-picker="date.de">
            </div>
          </div>
          <div class="col-md-3">
              <div class="form-group">
                <label for="s1">จำนวน</label>
                <input required type="text" class="form-control" ng-model="car_num">
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-raised btn-info">ค้นหา</button>
        </div>
        </div>

      </form>
      <div class="row">
        <div class="col-md-12 table-responsive">
          <h3>ผลการค้นหา</h3>
          <p>ผลการค้นหา ทั้งหมด <span style="color:blue; font-weight:bold;">{{dt_car.length}}</span> รายการ</p>
          <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
            <thead>
              <tr class="info">
                <th width="3%">ลำดับ</th>
                <th width="11%">ทะเบียนรถ</th>
                <th width="11%">จังหวัด</th>
                <th width="11%">ยี่ห้อ</th>
                <th width="11%">รุ่น</th>
                <th width="11%">ปี</th>
                <th width="11%">สี</th>
                <th width="11%">เจ้าของรถ</th>
                <th width="11%">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="row in dt_car">
                <td>{{$index+1}}</td>
                <td>{{row.car_license_plate}}</td>
                <td>{{row.province_name}}</td>
                <td>{{row.car_brand_name}}</td>
                <td>{{row.car_model_name}}</td>
                <td>{{row.car_brand_year}}</td>
                <td>{{row.car_color_name}}</td>
                <td align="left">{{row.user_fullname}}</td>
                <td class="td-actions text-right">
                  <button ng-click="member_detail(row.user_id,row.car_id)" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="รายละเอียด">
                    <i class="material-icons">details</i>
                    รายละเอียด
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      </div>
      <span ng-if="dt_car != 0">
      <div class="col-md-12 text-center">
        <button class="btn btn-raised btn-success" ng-click="news_accept()">ยืนยันการส่งข่าว</button>
      </div>
    </span>
    </div>
  </div>
