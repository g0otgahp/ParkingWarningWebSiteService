
<div class="row">
  <div class="col-md-12">
    <div class="card card-nav-tabs">
      <div class="card-header" data-background-color="orange">
        <h3 class="title"><i class="material-icons">unarchive</i> เบอร์โทรศัพท์ฉุกเฉิน<span><a class="btn btn-raised btn-xs btn-success btn-round" ng-click="emergency_form(n.emergency_id)">
          <i class="material-icons">&#xE147;</i>
          เพิ่มใหม่
        </a></span>
      </h3>
      <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="active">
              <a href="#emergency" data-toggle="tab">
                <i class="material-icons">&#xE80B;</i>
                เผยแพร่ ({{count}})
                <div class="ripple-container"></div></a>
              </li>
              <li class="">
                <a href="#emergency_trash" data-toggle="tab">
                  <i class="material-icons">&#xE872;</i>
                  ถังขยะ ({{trash}})
                  <div class="ripple-container"></div></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="emergency">
            <?php $this->load->view('admin\emergency\tab_emergency'); ?>
          </div>
          <div class="tab-pane" id="emergency_trash">
            <?php $this->load->view('admin\emergency\tab_emergency_trash'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
