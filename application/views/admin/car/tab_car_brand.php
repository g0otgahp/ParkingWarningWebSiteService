<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="info">
        <th widgth="2%">ลำดับ</th>
        <th class="uk-text-nowarp">รูปภาพ</th>
        <th class="uk-text-nowrap">ยี่ห้อ</th>
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="row in car_brand">
        <td>{{$index+1}}</td>
        <td width="100"><img style="width:100px;" src="<?php echo base_url('upload/images/brand')?>/{{row.car_brand_pic}}" class="img-thumbnail"></td>
        <td>{{row.car_brand_name}}</td>
        <td>
          <button ng-click="car_brand_model(row.car_brand_id)" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="รายละเอียด">
            <i class="material-icons">details</i>
            รายการรุ่น
          </button>
          <button ng-click="car_brand_form(row.car_brand_id)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="แก้ไข">แก้ไข</button>
          <button ng-click="car_brand_totrash(row.car_brand_id)" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="ย้ายไปถังขยะ">X</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
