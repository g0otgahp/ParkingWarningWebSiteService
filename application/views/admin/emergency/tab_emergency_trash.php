<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="danger">
        <th>ลำดับ</th>
        <th class="uk-text-nowrap">ชื่อเบอร์โทรศัพท์ฉุกเฉิน</th>
        <th class="uk-text-nowrap">หมายเลขโทรศัพท์</th>
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="row in emergency_trash">
        <td>{{$index+1}}</td>
        <td>{{row.emergency_phone_name}}</td>
        <td>{{row.emergency_phone_number}}</td>
        <td>
          <button ng-click="emergency_restore(row.emergency_phone_id)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="กู้คืน">กู้คืน</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
