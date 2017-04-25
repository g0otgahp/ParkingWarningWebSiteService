
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="">
        <h3 class="title">เพิ่มรุ่นรถ</h3>
        <form name="Form1" ng-submit="car_model_save()">
          <button type="submit" class="btn btn-success">บันทึก</button>
          <a href="<?php echo site_url('admin/car/car_model/?bid={{car_model.car_brand_id}}'); ?>" class="btn btn-danger">ยกเลิก</a>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="col-md-9">
              <input type="hidden" class="form-control" ng-model="car_model.car_brand_id"/>
              <div class="form-group">
                <input type="hidden" class="form-control" ng-model="car_model.car_model_id"/>
                <label for="s1">ชื่อรุ่น</label>
                <input type="text" class="form-control input-lg" ng-model="car_model.car_model_name">
              </div>
              <div class="form-group">
                <label for="s1">ปีผลิต</label>
                <input type="text" class="form-control input-lg" ng-model="car_model.car_brand_year">
              </div>
            </div>
      </form>
      </div>
    </div>
  </div>
</div>
</div>
