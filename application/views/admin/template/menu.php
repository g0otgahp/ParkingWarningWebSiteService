<div class="sidebar" data-color="blue" data-image="">
<!-- <div class="sidebar" data-color="orange" data-image="../assets/img/sidebar-1.jpg"> -->
  <!--
  Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

  Tip 2: you can also add an image using data-image tag
-->

<div class="logo">
  <a href="" class="simple-text">
    PARKING WARNING
  </a>
</div>

<div class="sidebar-wrapper">
  <div style="font-weight:bold;" class="text-center form-control">
    เมนูหลัก
  </div>
  <ul class="nav">
    <li>
      <a href="<?php echo site_url('admin/dashboard');?>">
        <i class="material-icons">dashboard</i>
        <p>ภาพรวม</p>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/news');?>">
        <i class="material-icons">library_books</i>
        <p>ข่าวสาร</p>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/notification');?>">
        <i class="material-icons text-gray">notifications</i>
        <p>แจ้งเตือน</p>
      </a>
    </li>

    <li>
      <a href="<?php echo site_url('admin/member');?>">
        <i class="material-icons">person</i>
        <p>ผู้ใช้งาน</p>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/car');?>">
        <i class="material-icons">directions_car</i>
        <p>รถยนต์</p>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/car/car_brand');?>">
        <i class="material-icons">book</i>
        <p>การจัดการยี่ห้อรถ</p>
      </a>
    </li>
    <li class="active-pro">
      <a href="<?php echo site_url('admin/emergency');?>">
        <i class="material-icons">unarchive</i>
        <p>สมุดโทรศัพท์</p>
      </a>
    </li>
  </ul>
  <div style="font-weight:bold;" class="text-center form-control">
    รายงาน
  </div>
  <ul class="nav">
    <li>
      <a href="<?php echo site_url('admin/report/report_notification');?>">
        <i class="material-icons">content_paste</i>
        <p style="font-size:12px;">รายงานการแจ้งเตือน</p>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/report/report_car_by_user');?>">
        <i class="material-icons">content_paste</i>
        <p style="font-size:12px;">รายงานจำนวนรถตามสมาชิก</p>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('admin/report/report_car_by_brand');?>">
        <i class="material-icons">content_paste</i>
        <p style="font-size:12px;">รายงานจำนวนรถตามยี่ห้อ</p>
      </a>
    </li>
  </ul>
</div>
</div>
<div class="main-panel">
<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header" style="float:right">
      <button type="button" class="navbar-toggle left" data-toggle="">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo SITE_URL('admin/homepage/logout');?>">Logout</a>
    </div>
  </div>
  </nav>

<div class="content">
  <div class="container-fluid">
    <?php  $this->load->view($View); ?>

  </div>
</div>
</div>
