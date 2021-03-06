<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="info">
        <th>ลำดับ</th>
        <th class="uk-text-nowrap">ชื่อเบอร์โทรศัพท์ฉุกเฉิน</th>
        <th class="uk-text-nowrap">หมายเลขโทรศัพท์</th>
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="row in emergency">
        <td>{{$index+1}}</td>
        <td>{{row.emergency_phone_name}}</td>
        <td>{{row.emergency_phone_number}}</td>
        <td>
          <button ng-click="emergency_form(row.emergency_phone_id)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="แก้ไข">Edit</button>
          <button ng-click="emergency_totrash(row.emergency_phone_id)" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="ย้ายไปถังขยะ">X</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
