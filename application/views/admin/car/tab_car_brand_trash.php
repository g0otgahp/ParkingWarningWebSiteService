<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="danger">
        <th widght="3%">ลำดับ</th>
        <th class="uk-text-nowarp">รูปภาพ</th>
        <th class="uk-text-nowrap">ยี่ห้อ</th>
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="row in car_brand_trash">
        <td>{{$index+1}}</td>
        <td width="100"><img src="<?php echo base_url('upload/images/brand')?>/{{row.car_brand_pic}}" class="img-thumbnail"></td>
        <td>{{row.car_brand_name}}</td>
        <td>
          <button ng-click="car_brand_restore(row.car_brand_id)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="กู้คืน">กู้คืน</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
