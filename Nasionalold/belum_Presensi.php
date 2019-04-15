<?php
session_start();
include('../koneksi.php');
if(!empty($_SESSION['username'])){
  if($_SESSION['akses'] != '1'){
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <style type="text/css">
      .scrol{
        overflow-y: auto;
        overflow-x: scroll;
      }
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
              <span class="hidden-xs"><?php echo $_SESSION['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../dist/img/user.jpeg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nama']." - ".$_SESSION['jabatan']."</br>".$_SESSION['username'];?>
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
          <p><?php echo $_SESSION['nama'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $_SESSION['jabatan'];?></a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview">
          <a href="presensi.php"><i class="fa fa-book"></i><span>Kehadiran</span></a>
        </li> 
        <li class="treeview">
          <a href="data_presensi.php"><i class="fa fa-book"></i><span>Data Kehadiran</span></a>
        </li>
        <li class="active">
          <a href="belum_presensi.php"><i class="fa fa-book"></i><span>Tanpa Kehadiran</span></a>
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
        <li class="active">Tanpa Kehadiran</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Data Presensi </h3>
        </div>
        <div class="box-body">
          <div class="box-body no-padding">
            <div class="scrol">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>tanggal</th>
                  <th>Nama</th>
                  <th>Manager Nasional</th>
                  <th>Manager Area</th>
                  <th>Perwakilan</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                date_default_timezone_set("Asia/Jakarta");
        
                  $hour = date("H-i");
                  if($hour<8-15){
                      $tanggal= date('d-m-Y', strtotime('-1 days', strtotime( date('d-m-Y') )));
                  }else if($hour>8-15){
                      $tanggal= date('d-m-Y');
                  }
                $no =1;
                $nasional = mysqli_query($con, "SELECT status, kode_nas, nama_nasional FROM tbl_mnasional WHERE kode_nas='".$_SESSION['kode']."'");
                while($data_nasional=mysqli_fetch_array($nasional)){
                  if($data_nasional['status']=='Aktif'){
                    $pre_nasional= mysqli_query($con, "SELECT tbl_mnasional.status FROM tbl_presensimnasional, tbl_mnasional WHERE tbl_presensimnasional.kode_nas='".$data_nasional['kode_nas']."' AND tbl_presensimnasional.tanggal='".$tanggal."'");
                    $num_nasional = mysqli_num_rows($pre_nasional);
                    if($num_nasional==0){
                      $data_pre_nasional = mysqli_fetch_array($pre_nasional);
                      echo "
                      <tr>
                        <td>".$no."</td>
                        <td>".$data_nasional['nama_nasional']."</td>
                        <td>".$data_nasional['nama_nasional']."</td>
                        <td>------</td>
                        <td>-----</td>
                        <td>".$tanggal."</td>
                      </tr>";
                      $no++;
                    }
                  }
                  
                  $area =mysqli_query($con, "SELECT status, kode_area, nama_area FROM tbl_marea WHERE kode_nas='".$data_nasional['kode_nas']."'");
                  while($data_area=mysqli_fetch_array($area)){
                    if($data_area['status']=='Aktif'){
                      $pre_area = mysqli_query($con, "SELECT tbl_marea.status FROM tbl_presensimarea, tbl_marea WHERE tbl_marea.status='Aktif' AND tbl_presensimarea.kode_area='".$data_area['kode_area']."' AND tbl_presensimarea.tanggal='".$tanggal."'");
                      $num_area=mysqli_num_rows($pre_area);
                      if($num_area==0){
                        $data_pre_area = mysqli_fetch_array($pre_area);
                        echo "
                        <tr>
                          <td>".$no."</td>
                          <td>".$data_area['nama_area']."</td>
                          <td>".$data_nasional['nama_nasional']."</td>
                          <td>".$data_area['nama_area']."</td>
                          <td>-----</td>
                          <td>".$tanggal."</td>
                        </tr>";
                        $no++;
                      }
                    }
                    
                    $kaper = mysqli_query($con, "SELECT status, kode_perwakilan, nama_kaper, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'" );
                    while($data_kaper=mysqli_fetch_array($kaper)){
                      if($data_kaper['status']=='Aktif'){
                        $pre_kaper = mysqli_query($con, "SELECT tbl_presensiperwakilan.kode_perwakilan, tbl_perwakilan.status FROM tbl_presensiperwakilan, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan=tbl_presensiperwakilan.kode_perwakilan AND tbl_presensiperwakilan.kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tbl_presensiperwakilan.tanggal='".$tanggal."'");
                        $num_kaper = mysqli_num_rows($pre_kaper);
                        if($num_kaper==0){
                          $data_pre_kaper = mysqli_fetch_array($pre_kaper);
                          echo "
                          <tr>
                            <td>".$no."</td>
                            <td>".$data_kaper['nama_kaper']."</td>
                            <td>".$data_nasional['nama_nasional']."</td>
                            <td>".$data_area['nama_area']."</td>
                            <td>".$data_kaper['alamat_perwakilan']."</td>
                            <td>".$tanggal."</td>
                          </tr>";
                          $no++;
                        }
                      }
                      
                      $sales = mysqli_query($con, "SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."'" );
                      while($data_sales=mysqli_fetch_array($sales)){
                        $pre_sales = mysqli_query($con, "SELECT keterangan, tanggal FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$tanggal."'");
                        $num_sales=mysqli_num_rows($pre_sales);
                        if($num_sales==0){
                          $data_pre_sales = mysqli_fetch_array($pre_sales);
                          echo "
                          <tr>
                            <td>".$no."</td>
                            <td>".$data_sales['nama_sales']."</td>
                            <td>".$data_nasional['nama_nasional']."</td>
                            <td>".$data_area['nama_area']."</td>
                            <td>".$data_kaper['alamat_perwakilan']."</td>
                            <td>".$tanggal."</td>
                          </tr>";
                          $no++;
                        }
                        
                      }
                    }
                  }
                }
                ?>
              </tbody>
            </table>
            </div>
            </div>
        </div>
        <div class="box-footer">
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
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
