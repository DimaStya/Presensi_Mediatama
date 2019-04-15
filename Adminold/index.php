<?php
session_start();
include('hapus_data.php');
if(!empty($_SESSION['username'])){
  if($_SESSION['akses'] != '10'){
    header("location: ../blank");
  }
}else{
  header("location: ../blank");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Presensi Marketing</title>
  <link rel="shortcut icon" href="../img/icon.jpg">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style type="text/css">
      a.sundaboy:link {color:#FF0000;}
      a.sundaboy:visited {color:#0000FF;}
      a.sundaboy:hover {color:#DF7401;}
      a.white:link {color:#ffffff;}
      a.white:visited {color:#0000FF;}
      a.white:hover {color:#DF7401;}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <span class="logo-mini"><b>M</b>DT</span>
      <span class="logo-lg"><b>Presensi </b>MDT</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/user.jpeg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['username'];?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../dist/img/user.jpeg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['username'];?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="ubah_pass.php" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
                <div class="pull-right">
                  <a href="../log_out.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user.jpeg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Administrasi</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="active">
          <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview">
          <a href="presensi.php"><i class="fa fa-book"></i><span>Kehadiran</span></a>
        </li>
        <li class="treeview">
          <a href="tanpa_presensi.php"><i class="fa fa-book"></i><span>Tanpa Kehadiran</span></a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Kelola Data Marketing</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="addmnasional.php"><i class="fa fa-circle-o"></i> Manager Nasional</a></li>
            <li><a href="addmarea.php"><i class="fa fa-circle-o"></i> Manager Area</a></li>
            <li><a href="addkaper.php"><i class="fa fa-circle-o"></i> Kepala Perwakilan</a></li>
            <li><a href="addsales.php"><i class="fa fa-circle-o"></i> Sales</a></li>
            <li><a href="addguest.php"><i class="fa fa-circle-o"></i> Guest</a></li>
          </ul>
        </li> 
        <li class="treeview">
          <a href="user.php"><i class="fa fa-user"></i><span>Data User</span></a>
        </li>     
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
              <h3 class="box-title">Data Marketing</h3>
            </div>
        <div class="box-body">
        <div class="col-md-3">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user.jpeg" alt="User Avatar">
              </div>
              <h3 class="widget-user-username">Manager Nasional</h3>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php
                $sqltot = mysqli_query($con, "SELECT count(kode_nas) FROM tbl_mnasional ");
                $datatot = mysqli_fetch_array($sqltot);
                $sql = mysqli_query($con, "SELECT count(kode_nas) FROM tbl_mnasional WHERE status='Aktif' ");
                $dataak = mysqli_fetch_array($sql);
                $sqlout = mysqli_query($con, "SELECT count(kode_nas) FROM tbl_mnasional WHERE status='Tidak Aktif' ");
                $dataout = mysqli_fetch_array($sqlout);
                ?>
                <li><a href="#">Jumlah <span class="pull-right badge bg-blue"><?php echo $datatot['count(kode_nas)'];?></span></a></li>
                <li><a href="#">Aktif <span class="pull-right badge bg-aqua"><?php echo $dataak['count(kode_nas)'];?></span></a></li>
                <li><a href="#">Kosong <span class="pull-right badge bg-red"><?php echo $dataout['count(kode_nas)'];?></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user.jpeg" alt="User Avatar">
              </div>
              <h3 class="widget-user-username">Manager Area</h3>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php
                $areatot = mysqli_query($con, "SELECT count(kode_area) FROM tbl_marea ");
                $dataareatot = mysqli_fetch_array($areatot);
                $area = mysqli_query($con, "SELECT count(kode_area) FROM tbl_marea WHERE status='Aktif' ");
                $dataareaak = mysqli_fetch_array($area);
                $areaout = mysqli_query($con, "SELECT count(kode_area) FROM tbl_marea WHERE status='Tidak Aktif' ");
                $dataareaout = mysqli_fetch_array($areaout);
                ?>
                <li><a href="#">Jumlah <span class="pull-right badge bg-blue"><?php echo $dataareatot['count(kode_area)'];?></span></a></li>
                <li><a href="#">Aktif <span class="pull-right badge bg-aqua"><?php echo $dataareaak['count(kode_area)'];?></span></a></li>
                <li><a href="#">Kosong <span class="pull-right badge bg-red"><?php echo $dataareaout['count(kode_area)'];?></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user.jpeg" alt="User Avatar">
              </div>
              <h3 class="widget-user-username">Kepala Perwakilan</h3>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php  
                date_default_timezone_set("Asia/Jakarta");
                $hour = date("H-i");
                if($hour<8-15){
                    $tanggal= date('d-m-Y', strtotime('-1 days', strtotime( date('d-m-Y') )));
                }else if($hour>8-15){
                  $tanggal= date('d-m-Y');
                }
                $pertot = mysqli_query($con, "SELECT count(kode_perwakilan) FROM tbl_perwakilan ");
                $datapertot = mysqli_fetch_array($pertot);
                $per = mysqli_query($con, "SELECT count(kode_perwakilan) FROM tbl_perwakilan WHERE status='Aktif' ");
                $dataperak = mysqli_fetch_array($per);
                $perout = mysqli_query($con, "SELECT count(kode_perwakilan) FROM tbl_perwakilan WHERE status='Tidak Aktif' ");
                $dataperout = mysqli_fetch_array($perout);
                $perpre = mysqli_query($con, "SELECT count(kode_perwakilan) FROM tbl_perwakilan WHERE kode_perwakilan IN (SELECT kode_perwakilan FROM tbl_presensiperwakilan WHERE tanggal='".$tanggal."')");
                $dataperpre = mysqli_fetch_array($perpre);
                ?>
                <li><a href="#">Jumlah <span class="pull-right badge bg-blue"><?php echo $datapertot['count(kode_perwakilan)'];?></span></a></li>
                <li><a href="#">Aktif <span class="pull-right badge bg-aqua"><?php echo $dataperak['count(kode_perwakilan)'];?></span></a></li>
                <li><a href="#">Kosong <span class="pull-right badge bg-red"><?php echo $dataperout['count(kode_perwakilan)'];?></span></a></li>                
                <li><a href="#">Yang telah presensi <span class="pull-right badge bg-green"><?php echo $dataperpre['count(kode_perwakilan)'];?></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user.jpeg" alt="User Avatar">
              </div>
              <h2 class="widget-user-username">SALES, ADMIN, SPV</h2>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php
                $saltot = mysqli_query($con, "SELECT count(kode_sales) FROM tbl_sales ");
                $datasaltot = mysqli_fetch_array($saltot);
                $salpre = mysqli_query($con, "SELECT count(kode_sales) FROM tbl_sales WHERE kode_sales IN (SELECT kode_sales FROM tbl_presensisales WHERE tanggal='".$tanggal."')");
                $datasalpre = mysqli_fetch_array($salpre);
                ?>
                <li><a href="#">Jumlah <span class="pull-right badge bg-blue"><?php echo $datasaltot['count(kode_sales)'];?></span></a></li>
                <li><a href="#">Yang telah presensi <span class="pull-right badge bg-green"><?php echo $datasalpre['count(kode_sales)'];?></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Marketing NON MANAGER</span>
              <span class="info-box-number"><?php $jumlah = $datasaltot['count(kode_sales)']+$dataperak['count(kode_perwakilan)'];
              echo $jumlah;?></span>
              <?php 
              $jumlah_pre = $datasalpre['count(kode_sales)'] + $dataperpre['count(kode_perwakilan)'];
              if($jumlah_pre > 0){
                   $persen = $jumlah_pre/$jumlah*100;
                }else{
                  $persen='0';
                } 
              
              ?>
              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $persen;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format($persen, 2);?>% telah melakukan presensi dengan Jumlah <?php echo $jumlah_pre;?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Presensi Marketing <a href="http://Mediatamasolo.com">Mediatamasolo</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../plugins/knob/jquery.knob.js"></script>
<script src="../https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>
</body>
</html>
