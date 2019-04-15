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
      .pesan{
          border: 1px solid red;
          width: 200px;
          top: 1px;
          left: 50px;
          padding: 1px 1px;
          background-color: #ffb3b3;
          text-align: center;
          float: right;
          position: relative;
          left: -50%; /* or right 50% */
          text-align: center;
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
        <li class="treeview">
          <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="active">
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
          <li class="treeview">
          <a href="user.php"><i class="fa fa-user"></i><span>Data User</span></a>
        </li> 
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
        <li class="active">Kehadiran</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <?php  
            date_default_timezone_set("Asia/Jakarta");
            $hour = date("H-i");
            if($hour<8-15){
                $tanggal= date('d-m-Y', strtotime('-1 days', strtotime( date('d-m-Y') )));
            }else if($hour>8-15){
              $tanggal= date('d-m-Y');
            }
          ?>
          <form method="POST" action="download.php">
          <select id="tanggal_download" name="tanggal_download">
            <option value="<?php echo date('d-m-Y', strtotime('-1 days', strtotime( date('d-m-Y') ))); ?>">1 Hari lalu</option>
            <option value="<?php echo date('d-m-Y', strtotime('-2 days', strtotime( date('d-m-Y') ))); ?>">2 Hari lalu</option>
            <option value="<?php echo date('d-m-Y', strtotime('-3 days', strtotime( date('d-m-Y') ))); ?>">3 Hari lalu</option>
            <option value="<?php echo date('d-m-Y', strtotime('-4 days', strtotime( date('d-m-Y') ))); ?>">4 Hari lalu</option>
            <option value="<?php echo date('d-m-Y', strtotime('-5 days', strtotime( date('d-m-Y') ))); ?>">5 Hari lalu</option>
            <option value="<?php echo date('d-m-Y', strtotime('-6 days', strtotime( date('d-m-Y') ))); ?>">6 Hari lalu</option>
            <option value="<?php echo date('d-m-Y', strtotime('-7 days', strtotime( date('d-m-Y') ))); ?>">7 Hari lalu</option>
          </select>
          <h3 class="box-title">Download Data Presensi </h3>
                <button type="submit" class="btn btn-primary">Klik Disini</button>
              </form>
          <?php

          
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                echo '<div  class="pesan">'.$_SESSION['pesan'].'</div>';
            }
             
            $_SESSION['pesan'] = '';
            ?>
          
        </div>
        <div class="box-body">
          <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Manager Nasional</th>
                  <th>Manager Area</th>
                  <th>Perwakilan</th>
                  <th>Keterangan</th>
                  <th>tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no =1;
                $nasional = mysqli_query($con, "SELECT kode_nas, nama_nasional FROM tbl_mnasional");
                while($data_nasional=mysqli_fetch_array($nasional)){
                  $pre_nasional= mysqli_query($con, "SELECT keterangan, tanggal FROM tbl_presensimnasional WHERE kode_nas='".$data_nasional['kode_nas']."' AND tanggal='".$tanggal."'");
                  $num_nasional = mysqli_num_rows($pre_nasional);
                  if($num_nasional==1){
                    $data_pre_nasional = mysqli_fetch_array($pre_nasional);
                    echo "
                    <tr>
                      <td>".$no."</td>
                      <td>".$data_nasional['nama_nasional']."</td>
                      <td>".$data_nasional['nama_nasional']."</td>
                      <td>------</td>
                      <td>-----</td>
                      <td>".$data_pre_nasional['keterangan']."</td>
                      <td>".$data_pre_nasional['tanggal']."</td>
                    </tr>";
                    $no++;
                  }
                  $area =mysqli_query($con, "SELECT kode_area, nama_area FROM tbl_marea WHERE kode_nas='".$data_nasional['kode_nas']."'");
                  while($data_area=mysqli_fetch_array($area)){
                    $pre_area = mysqli_query($con, "SELECT keterangan, tanggal FROM tbl_presensimarea WHERE kode_area='".$data_area['kode_area']."' AND tanggal='".$tanggal."'");
                    $num_area=mysqli_num_rows($pre_area);
                    if($num_area==1){
                      $data_pre_area = mysqli_fetch_array($pre_area);
                      echo "
                      <tr>
                        <td>".$no."</td>
                        <td>".$data_area['nama_area']."</td>
                        <td>".$data_nasional['nama_nasional']."</td>
                        <td>".$data_area['nama_area']."</td>
                        <td>-----</td>
                        <td>".$data_pre_area['keterangan']."</td>
                        <td>".$data_pre_area['tanggal']."</td>
                      </tr>";
                      $no++;
                    }
                    $kaper = mysqli_query($con, "SELECT kode_perwakilan, nama_kaper, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'" );
                    while($data_kaper=mysqli_fetch_array($kaper)){
                      $pre_kaper = mysqli_query($con, "SELECT keterangan, tanggal FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tanggal='".$tanggal."'");
                      $num_kaper = mysqli_num_rows($pre_kaper);
                      if($num_kaper==1){
                        $data_pre_kaper = mysqli_fetch_array($pre_kaper);
                        echo "
                        <tr>
                          <td>".$no."</td>
                          <td>".$data_kaper['nama_kaper']."</td>
                          <td>".$data_nasional['nama_nasional']."</td>
                          <td>".$data_area['nama_area']."</td>
                          <td>".$data_kaper['alamat_perwakilan']."</td>
                          <td>".$data_pre_kaper['keterangan']."</td>
                          <td>".$data_pre_kaper['tanggal']."</td>
                        </tr>";
                        $no++;
                      }
                      $sales = mysqli_query($con, "SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."'" );
                      while($data_sales=mysqli_fetch_array($sales)){
                        $pre_sales = mysqli_query($con, "SELECT keterangan, tanggal FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$tanggal."'");
                        $num_sales=mysqli_num_rows($pre_sales);
                        if($num_sales==1){
                          $data_pre_sales = mysqli_fetch_array($pre_sales);
                          echo "
                          <tr>
                            <td>".$no."</td>
                            <td>".$data_sales['nama_sales']."</td>
                            <td>".$data_nasional['nama_nasional']."</td>
                            <td>".$data_area['nama_area']."</td>
                            <td>".$data_kaper['alamat_perwakilan']."</td>
                            <td>".$data_pre_sales['keterangan']."</td>
                            <td>".$data_pre_sales['tanggal']."</td>
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
<script>
//            angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
  $(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
//            angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
  setTimeout(function(){$(".pesan").fadeOut('slow');}, 3000);
</script>
<script type="text/javascript">
  function Klik(){
        var r = confirm('Yakin Mau Hapus Semua Presensi?');
        if(r == true){
          window.location = 'hapus_presensi.php';
        }
        
      }
</script>
</body>
</html>
