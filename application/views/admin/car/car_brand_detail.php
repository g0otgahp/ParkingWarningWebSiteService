
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="">
        <h3 class="title">{{news.news_name}}</h3>
        <!-- <button ng-click="news_modal()" type="button" class="btn btn-info btn-md" data-toggle="tooltip" data-placement="top" title="ส่งข่าว">ส่งข่าวสารฉบับนี้</button><br> -->
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
            <p><img height="200px" class="img" ng-src="<?php echo base_url('upload/images'); ?>/{{news.news_pic}}" alt=""></p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- The actual modal template, just a bit o bootstrap -->
<!-- <script type="text/ng-template" id="modal">
    <div class="modal fade">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" ng-click="close('Cancel')" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title">เลือกกลุ่มที่จะจัดส่ง</h4>
           <hr>
         </div>
         <div class="modal-body">
           <p></p>
         </div>
         <div class="modal-footer">
           <button type="button" ng-click="close('No')" class="btn btn-defalut" data-dismiss="modal">ยกเลิก</button>
           <button type="button" ng-click="send('Yes')" class="btn btn-success" data-dismiss="modal">ส่ง</button>
         </div>
       </div>
     </div>
   </div>
</script> -->
