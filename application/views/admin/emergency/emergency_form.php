
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="">
        <h3 class="title">แบบฟอร์มเบอร์โทรศัพท์ฉุกเฉิน</h3>
        <form name="Form1" ng-submit="emergency_save()">
          <button type="submit" class="btn btn-success">บันทึก</button>
          <a href="<?php echo site_url('/admin/emergency/'); ?>" class="btn btn-danger">ยกเลิก</a>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <input type="hidden" class="form-control" ng-model="emergency.emergency_phone_id"/>
                <label for="s1">ชื่อเบอร์โทรศัพท์ฉุกเฉิน</label>
                <input type="text" class="form-control input-lg" ng-model="emergency.emergency_phone_name">
              </div>
              <div class="form-group">
                <label for="s1">เบอร์โทรศัพท์ฉุกเฉิน</label>
                <input type="text" class="form-control input-lg" ng-model="emergency.emergency_phone_number">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
