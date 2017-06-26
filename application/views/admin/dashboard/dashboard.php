<div class="row">
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header" data-background-color="orange">
				<i class="material-icons">notifications</i>
			</div>
			<div class="card-content">
				<p class="category">แจ้งเตือน (วันนี้)</p>
				<h3 class="title" style="font-weight:bold;">{{count.notification_today}}</h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">notifications</i>รวมทั้งหมด {{count.notification}}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header" data-background-color="green">
				<i class="material-icons">directions_car</i>
			</div>
			<div class="card-content">
				<p class="category">รถยนต์ (วันนี้)</p>
				<h3 class="title" style="font-weight:bold;">{{count.car_today}}</h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">directions_car</i>รวมทั้งหมด {{count.car}}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header" data-background-color="red">
				<i class="material-icons">info_outline</i>
			</div>
			<div class="card-content">
				<p class="category">ข่าวสาร (วันนี้)</p>
				<h3 class="title" style="font-weight:bold;">{{count.news_today}}</h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">info_outline</i>รวมทั้งหมด {{count.news}}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header" data-background-color="blue">
				<i class="material-icons">people</i>
			</div>
			<div class="card-content">
				<p class="category">สมาชิก (วันนี้)</p>
				<h3 class="title" style="font-weight:bold;">{{count.user_today}}</h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">people</i>รวมทั้งหมด {{count.user}}
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ข้าวล่าสุด -->
<!-- <div class="row">
<div class="col-md-6">
	<div class="card">
		<div class="card-header" data-background-color="green">
			<img src="<?php echo base_url('upload\images');?>\{{news[0].news_pic}} " class="img-thumbnail" height="150px">
		</div>
		<div class="card-content">
			<h4 class="title">ข่าวสารล่าสุด</h4>
			<p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span> {{news[0].news_name}}</p>
			<hr>
			<p ng-bind-html="news[0].news_detail"></p>
		</div>
		<div class="card-footer">
			<div class="stats">
				<i class="material-icons">access_time</i> เมื่อ {{news[0].news_date_add | amDateFormat:"DD MMMM YYYY"}}
			</div>
		</div>
	</div>
</div>
</div> -->

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="row clearfix">
				<div class="col-xs-12">
					<div class="card-content">
						<div class="header">
							<h4>สถิติการแจ้งเตือนในแต่ละวัน ประจำเดือน {{current_month | amDateFormat:'MMMM YYYY'}}</h4>
						</div>
						<div class="body">
							<!--
<canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick">
              </canvas>
-->
							<canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick">
				</canvas>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- <div class="row">
<div class="col-md-12">
	<div class="card card-nav-tabs">
		<div class="card-header" data-background-color="purple">
			<div class="nav-tabs-navigation">
				<div class="nav-tabs-wrapper">
					<span class="nav-tabs-title">ล่าสุด:</span>
					<ul class="nav nav-tabs" data-tabs="tabs">
						<li class="active">
							<a href="#notification" data-toggle="tab">
                  <i class="material-icons">notifications</i>
                  แจ้งเตือน
                <div class="ripple-container"></div></a>
						
						</li>
						<li class="">
							<a href="#user" data-toggle="tab">
                  <i class="material-icons">person</i>
                  สมาชิก
                <div class="ripple-container"></div></a>
						
						</li>
						<li class="">
							<a href="#car" data-toggle="tab">
                  <i class="material-icons">directions_car</i>
                  ลงทะเบียนรถ
                <div class="ripple-container"></div></a>
						
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="card-content">
			<div class="tab-content">
				<div class="tab-pane active" id="notification">
					<span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span>
					<table class="table">
						<tbody>
							<tr ng-repeat="row in notification">
								<td>{{row.notification_date}}</td>
								<td>
									<a href="#" ng-click="member_detail(row.user_id,row.car_id)">
                      {{row.car_license_plate}}
                    </a>
								
								</td>
								<td>{{row.province_name}}</td>
								<td>{{row.car_brand_name}}</td>
								<td>{{row.car_color_name}}
							</tr>
						</tbody>
					</table>
				</div>

				<div class="tab-pane" id="user">
					<span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span>
					<table class="table">
						<tbody>
							<tr ng-repeat="row in user">
								<td>{{row.user_fullname}}</td>
								<td>{{row.user_phone}}</td>
								<td>{{row.user_email}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="car">
					<span class="text-success"><i class="fa fa-long-arrow-up"></i> NEW  </span>
					<table class="table">
						<tbody>
							<tr ng-repeat="row in car">
								<td>{{row.car_license_plate}}</td>
								<td>{{row.province_name}}</td>
								<td>{{row.car_brand_name}}</td>
								<td>{{row.car_color_name}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div> -->