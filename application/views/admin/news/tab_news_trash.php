<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="danger">
        <th>ลำดับ</th>
        <th class="uk-text-nowarp">รูปภาพ</th>
        <th class="uk-text-nowrap">วันที่</th>
        <th class="uk-text-nowrap">ชื่อข่าวสาร</th>
        <!-- <th class="uk-text-nowrap">รายละเอียด</th> -->
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="n in news_trash">
        <td>{{$index+1}}</td>
        <td width="100"><img src="<?php echo base_url('upload/images/news')?>/{{n.news_pic}}" class="img-thumbnail"></td>
        <td>{{n.news_date_add | amDateFormat: "DD MMMM YY HH:MMน."}}</td>
        <td>{{n.news_name}}</td>
        <!-- <td>{{n.news_detail}}</td> -->
        <td>
          <button ng-click="news_restore(n.news_id)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="กู้คืน">กู้คืน</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
