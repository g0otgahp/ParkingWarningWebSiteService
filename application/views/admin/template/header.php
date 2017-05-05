<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" ng-app="mainApp"> <!--<![endif]-->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Parking Warning : Admin </title>
  <link rel="stylesheet" href="<?php echo base_url('assets\font-awesome\css\font-awesome.min.css')?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets\fonts_th_sarabun\thsarabunnew.css')?>" media="all">
  <!-- Material Design fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="<?php echo base_url('assets\bootstrap\dist\css\bootstrap.min.css')?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets\datatables\skin\bootstrap\css\dataTables.bootstrap.min.css')?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets\material-dashboard\assets\css\material-dashboard.css')?>" media="all">

  <link rel="stylesheet" href="<?php echo base_url('assets\ui-select-master\dist\select.min.css')?>" media="all">

  <link rel="stylesheet" href="<?php echo base_url('assets\bootstrap-material-datetimepicker\css\bootstrap-material-datetimepicker.css')?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets\custom\css\load-page.css')?>" media="all">
  <link rel="stylesheet" href="<?php echo base_url('assets\custom\css\parking_theme.css')?>" media="all">
  <!-- Include Editor style. -->
  <link rel="stylesheet" href="<?php echo base_url('assets\froala\css\froala_editor.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets\froala\css\froala_editor.pkgd.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets\froala\css\froala_style.min.css')?>">

  <!-- Include Editor plugins CSS style. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/char_counter.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/code_view.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/colors.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/emoticons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/file.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/fullscreen.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/image.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/image_manager.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/line_breaker.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/table.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/video.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/froala/css/plugins/')?>/draggable.min.css">

  <link rel="stylesheet" href="<?php echo base_url('plugin/angular-moment-picker/dist/angular-moment-picker.min.css')?>">


  <script type="text/javascript">
  var SITE_URL = "<?php echo site_url(); ?>";
  var BASE_URL = "<?php echo base_url(); ?>";
  </script>

</head>

<body id="id<?php echo $Result['NgController'] ?>" ng-controller="<?php echo $Result['NgController'] ?>" >
  <div class="wrapper">
    <div class="loader"></div>
