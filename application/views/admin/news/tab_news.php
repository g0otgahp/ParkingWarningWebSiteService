<div class="card-content table-responsive">
  <table datatable="ng" dt-options="dtOptions" dt-instance="dtInstance"  class="table table-striped table-hover ">
    <thead>
      <tr class="info">
        <th>ลำดับ</th>
        <th class="uk-text-nowarp">รูปภาพ</th>
        <th class="uk-text-nowrap">วันที่</th>
        <th class="uk-text-nowrap">ชื่อข่าวสาร</th>
        <!-- <th class="uk-text-nowrap">รายละเอียด</th> -->
        <th>ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="n in news">
        <td>{{$index+1}}</td>
        <td width="100"><img src="<?php echo base_url('upload/images')?>/{{n.news_pic}}" class="img-thumbnail"></td>
        <td>{{n.news_date_add | amDateFormat: "DD MMMM YY HH:MMน."}}</td>
        <td>{{n.news_name}}</td>
        <!-- <td>{{n.news_detail}}</td> -->
        <td>
          <button ng-click="news_detail(n.news_id)" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="รายละเอียด">
            <i class="material-icons">details</i>
            รายละเอียด
          </button>
          <button ng-click="news_form(n.news_id)" type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="แก้ไข">แก้ไข</button>
          <button ng-click="news_totrash(n.news_id)" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="ย้ายไปถังขยะ">X</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
