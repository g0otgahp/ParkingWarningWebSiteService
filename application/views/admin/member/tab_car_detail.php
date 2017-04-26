<h4 class="title">เกี่ยวกับรถยนต์</h4>
<div class="row">
	<div class="col-md-6">
		ยี่ห้อ : <b class="text-warning">{{car_select.car_brand_name}} - {{car_select.car_model_name}}</b>
	</div>
	<div class="col-md-3">
		ปีผลิต : <b class="text-warning">{{car_select.car_brand_year}}</b>
	</div>
	<div class="col-md-3">
		สี : <b class="text-warning">{{car_select.car_color_name}}</b>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		วันที่ลงทะเบียน : <b class="text-warning">{{car_select.car_register_date | amDateFormat:"DD MMMM YYYY"}}</b>
	</div>
	<div class="col-md-3">
		ทะเบียนรถ : <b class="text-warning">{{car_select.car_license_plate}}</b>
	</div>
	<div class="col-md-3">
		จังหวัด : <b class="text-warning">{{car_select.province_name}}</b>
	</div>

</div>
<hr>
<h4 class="title">ภาพ</h4>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<img src="<?php echo base_url('/upload/images/cars')?>/{{car_select.car_pic_front}}" alt="" class="img-responsive">

		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<img src="<?php echo base_url('/upload/images/cars')?>/{{car_select.car_pic_back}}" alt="" class="img-responsive">

		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<img src="<?php echo base_url('/upload/images/cars')?>/{{car_select.car_pic_left}}" alt="" class="img-responsive">

		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<img src="<?php echo base_url('/upload/images/cars')?>/{{car_select.car_pic_right}}" alt="" class="img-responsive">

		</div>
	</div>
</div>
