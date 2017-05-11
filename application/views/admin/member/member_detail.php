<div class="row">
	<span ng-if="!car_select.car_id" >

	<div class="col-md-8" align="center">
		<div class="card card-nav-tabs">
				<h4 class="title">ยังไม่ได้ลงทะเบียนรถยนต์</h4>
		</div>
	</div>
	</span>

	<span ng-if="car_select.car_id" >
	<div class="col-md-8">
		<div class="card card-nav-tabs">
			<div class="card-header" data-background-color="orange">
				<h4 class="title">{{car_select.car_brand_name}} {{car_select.car_model_name}}</h4>
				<p class="category">ยี่ห้อ {{car_select.car_brand_name}} - {{car_select.car_model_name}} ปี {{car_select.car_brand_year}}</p>
				<hr>
				<div class="nav-tabs-navigation">
					<div class="nav-tabs-wrapper">
						<span class="nav-tabs-title">Tasks:</span>
						<ul class="nav nav-tabs" data-tabs="tabs">
							<li class="active">
								<a href="#car_detail" data-toggle="tab">
									<i class="material-icons">directions_car</i>
									เกี่ยวกับรถยนต์
									<div class="ripple-container"></div></a>
								</li>
								<li class="">
									<a href="#car_nortify" data-toggle="tab">
										<i class="glyphicon glyphicon-alert"></i>
										ประวัติการแจ้งเตือน
										<div class="ripple-container"></div></a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="card-content">
						<div class="tab-content">
							<div class="tab-pane active" id="car_detail">
								<?php $this->load->view('admin/member/tab_car_detail'); ?>
							</div>
							<div class="tab-pane" id="car_nortify">
								<?php $this->load->view('admin/member/tab_car_notify'); ?>
							</div>
						</div>
					</div>

				</div>

			</div>
		</span>

			<div class="col-md-4">
				<div class="card card-profile">
					<div class="card-avatar">
						<!-- <a href="#"> -->
							<img class="img" src="<?php echo base_url('/upload/images/users'); ?>/{{member[0].user_photo}}" />
						<!-- </a> -->
					</div>

					<div class="content">
						<h6 class="category text-gray">ชื่อผู้ใช้งาน: {{member[0].user_username}}</h6>
						<h4 class="card-title">{{member[0].user_fullname}}</h4>
					</div>
					<div class="card-footer text-left">
						<div class="stats">
							<i class="material-icons">local_offer</i> Phone : {{member[0].user_phone}}
						</div>
					</div>
					<div class="card-footer text-left">
						<div class="stats">
							<i class="material-icons">local_offer</i> e-Mail : {{member[0].user_email}}
						</div>
					</div>
					<div class="card-footer text-left">
						<div class="stats">
							<i class="material-icons">local_offer</i> ลงทะเบียนเมื่อ : {{member[0].user_register_date | amDateFormat:"DD MMMM YYYY"}}
						</div>
					</div>
				</div>

				<span ng-if="member_car" >
				<div class="card">

					<div class="card-content table-responsive">
						<h4 class="card-title">รายการรถยนต์</h4>

						<table class="table table-hover">
							<thead class="text-warning">
								<tr>
									<th>ลำดับ</th>
									<th>ยี่ห้อ</th>
									<th>เลขทะเบียน</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="row in member_car" style="cursor: pointer;" ng-click="member_detail(member[0].user_id,row.car_id)">
									<td>{{$index+1}}</td>
									<td>{{row.car_brand_name}}</td>
									<td>{{row.car_license_plate}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</span>
			</div>
		</div>
