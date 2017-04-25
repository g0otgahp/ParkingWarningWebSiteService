
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="">
        <h3 class="title">แบบฟอร์มยี่ห้อรถ</h3>
        <form name="Form1" ng-submit="car_brand_save()">
          <button type="submit" class="btn btn-success">บันทึก</button>
          <a href="<?php echo site_url('admin/car/car_brand'); ?>" class="btn btn-danger">ยกเลิก</a>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <input type="hidden" class="form-control" ng-model="car_brand.car_brand_id"/>
                <input type="hidden" class="form-control" ng-model="car_brand.car_brand_pic"/>
                <label for="s1">ชื่อยี่ห้อ</label>
                <input type="text" class="form-control input-lg" ng-model="car_brand.car_brand_name">
              </div>
            </div>
            <div class="col-md-3">
              <h4>โลโก้</h4>
            <input type="file" name="file" id="file" img-Upload-Brand bind="car_brand.car_brand_pic">
            <p><img style="width:100px;" class="img" ng-src="<?php echo base_url('upload/images/brand'); ?>/{{car_brand.car_brand_pic}}" alt=""></p>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
</div>
