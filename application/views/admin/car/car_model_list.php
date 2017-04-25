<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="orange">
        <h3 class="title">
          <img src="<?php echo base_url('upload/images/brand')?>/{{car_model[0].car_brand_pic}}" class="img-thumbnail" style=" width: 70px;">
           ยี่ห้อ
          {{car_model[0].car_brand_name}}
           <span><a class="btn btn-raised btn-xs btn-success btn-round" ng-click="car_model_form(0,car_model[0].car_brand_id)">
          <i class="material-icons">&#xE147;</i>
          เพิ่มรุ่นใหม่
        </a></span>
      </h3>
      <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="active">
              <a href="#news" data-toggle="tab">
                <i class="material-icons">&#xE80B;</i>
                ทั้งหมด {{count}} รุ่น
                <div class="ripple-container"></div></a>
              </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="news">
            <?php $this->load->view('admin/car/tab_car_model'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
