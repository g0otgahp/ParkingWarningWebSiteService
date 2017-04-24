
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="">
        <h3 class="title">แบบฟอร์มข่าวสาร</h3>
        <form name="Form1" ng-submit="news_save()">
          <button type="submit" class="btn btn-success">บันทึก</button>
          <a href="<?php echo site_url('admin/news/'); ?>" class="btn btn-danger">ยกเลิก</a>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <input type="hidden" class="form-control" ng-model="news.news_id"/>
                <input type="hidden" class="form-control" ng-model="news.news_pic"/>
                <label for="s1">หัวข้อ</label>
                <input type="text" class="form-control input-lg" ng-model="news.news_name">
              </div>
              <textarea style="margin-top: 30px;" froala ng-model="news.news_detail"></textarea>
            </div>
            <div class="col-md-3">
              <h4>ตั้งค่ารูปหน้าปก</h4>
            <input type="file" name="file" id="file" img-Upload bind="news.news_pic">
            <p><img height="200px" class="img" ng-src="<?php echo base_url('upload/images'); ?>/{{news.news_pic}}" alt=""></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
