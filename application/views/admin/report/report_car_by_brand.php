<div class="col-md-12">

  <div class="card">
    <div class="card-header" data-background-color="orange">
      <h3 class="title"><i class="material-icons">content_paste</i> รายงานจำนวนรถตามยี่ห้อ</h3>
      <!-- <p class="category">Here is a subtitle for this table</p> -->
    </div>
    <div class="card-content ">
      <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
        <thead>
          <tr class="info">
            <th>ยี่ห้อ</th>
            <th>จำนวน (คัน)</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="row in dt_report_brand" ng-if="row.num != 0" class="animate-if">
            <span ng-if="{{row.num}} != 0">
            <td>{{row.car_brand_name}}</td>
            <td>{{row.num}}</td>
          </span>
          </tr>
        </tbody>
      </table>
    </table>
  </div>
</div>
</div>
</div>
</div>
