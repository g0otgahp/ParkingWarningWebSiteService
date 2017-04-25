
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="">
        <h3 class="title">{{news.news_name}}</h3>
        <button ng-click="news_send(news.news_id)" type="button" class="btn btn-info btn-md" data-toggle="tooltip" data-placement="top" title="ส่งข่าว">ส่งข่าวสารฉบับนี้</button><br>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="s1">รายละเอียด</label>
              </div>
              <div ng-bind-html="news.news_detail"></div>
            </div>
            <div class="col-md-3">
              <h4>รูปหน้าปก</h4>
            <p><img height="200px" class="img" ng-src="<?php echo base_url('upload/images/news'); ?>/{{news.news_pic}}" alt=""></p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
