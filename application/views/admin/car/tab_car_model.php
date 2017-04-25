<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="info">
        <th widght="3%">ลำดับ</th>
        <th class="uk-text-nowrap">รุ่น</th>
        <th class="uk-text-nowrap">ปีผลิต</th>
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="row in car_model">
        <td>{{$index+1}}</td>
        <td>{{row.car_brand_name}} - {{row.car_model_name}}</td>
        <td>{{row.car_brand_year}}</td>
        <td>
          <button ng-click="car_model_form(row.car_model_id,0)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="แก้ไข">แก้ไข</button>
          <button ng-click="car_model_delete(row.car_model_id,row.car_brand_id)" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="ลบ">X</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
