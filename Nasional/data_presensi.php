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
          <li class="active">
            <a href="data_presensi.php"><i class="fa fa-book"></i><span>Data Kehadiran</span></a>
          </li>
          <li class="treeview">
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
          <li class="active">Kehadiran</li>
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
                <table  class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Perwakilan</th>
                      <th>Tanggal</th>
                      <th>Kegiatan_1</th>
                      <th>Kegiatan_2</th>
                      <th>Kegiatan_3</th>
                      <th>Kegiatan_4</th>
                      <th>Kegiatan_5</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    date_default_timezone_set("Asia/Jakarta");
        
                $hour = strtotime(date("H:i"));
                if($hour<=strtotime('08:15')){
                    $tanggal= date('d-m-Y', strtotime('-1 days', strtotime( date('d-m-Y') )));
                }else if($hour>strtotime('08:15')){
                  $tanggal= date('d-m-Y');
                }
                    $nasional = mysqli_query($con, "SELECT tbl_presensimnasional.foto_1, tbl_presensimnasional.foto_2, tbl_presensimnasional.foto_3, tbl_presensimnasional.foto_4, tbl_presensimnasional.foto_5,tbl_mnasional.nama_nasional, tbl_presensimnasional.keterangan_1,tbl_presensimnasional.keterangan_2,tbl_presensimnasional.keterangan_3,tbl_presensimnasional.keterangan_4,tbl_presensimnasional.keterangan_5,tbl_presensimnasional.jam_1,tbl_presensimnasional.jam_2,tbl_presensimnasional.jam_3,tbl_presensimnasional.jam_4,tbl_presensimnasional.jam_5, tbl_presensimnasional.tanggal  FROM tbl_mnasional, tbl_presensimnasional WHERE tbl_mnasional.kode_nas=tbl_presensimnasional.kode_nas AND tbl_presensimnasional.kode_nas='".$_SESSION['kode']."' AND tbl_presensimnasional.tanggal='".$tanggal."'"); 
                    while($data_nasional=mysqli_fetch_array($nasional) ){
                      echo "
                    <tr>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$no."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_nasional['nama_nasional']."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>-----</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_nasional['tanggal']."</td>";
                      for($x=1; $x<=5; $x++){
                        if($data_nasional['foto_'.$x]!=''){
                          $gambar = "src='../images/".$data_nasional['foto_'.$x]."'";
                        }else{
                          $gambar="";
                        }
                        echo "
                      <td colspan='2'><img style='width: 300px; height: 200px;' ".$gambar."></img></td>";
                  }
                  echo "</tr>
                        <tr>";
                        for($x=1; $x<=5; $x++){
                          if($data_nasional['keterangan_'.$x]!= ''){
                            echo "
                            <td>".$data_nasional['keterangan_'.$x]."</td><td>Jam : ".$data_nasional['jam_'.$x]."</td>";
                          }else{
                            echo "<td>-----</td><td>--</td>";
                          };}
                       echo " </tr>";
                    $no++;
                  }
                    $area = mysqli_query($con, "SELECT kode_area FROM tbl_marea WHERE kode_nas='".$_SESSION['kode']."'");
                    while ($data_area=mysqli_fetch_array($area)) {
                      $query_area = mysqli_query($con, "SELECT tbl_presensimarea.foto_1,tbl_presensimarea.foto_2,tbl_presensimarea.foto_3,tbl_presensimarea.foto_4,tbl_presensimarea.foto_5,tbl_presensimarea.keterangan_1,tbl_presensimarea.keterangan_2,tbl_presensimarea.keterangan_3,tbl_presensimarea.keterangan_4,tbl_presensimarea.keterangan_5, tbl_marea.nama_area, tbl_presensimarea.jam_1,tbl_presensimarea.jam_2,tbl_presensimarea.jam_3,tbl_presensimarea.jam_4,tbl_presensimarea.jam_5, tbl_presensimarea.tanggal FROM tbl_marea, tbl_presensimarea WHERE tbl_marea.kode_area =tbl_presensimarea.kode_area AND tbl_presensimarea.tanggal='".$tanggal."' AND tbl_marea.kode_area='".$data_area['kode_area']."'");
                      while($data_pre_area=mysqli_fetch_array($query_area) ){
                      echo "
                      <tr>
                        <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$no."</td>
                        <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre_area['nama_area']."</td>
                        <td rowspan='2' style='vertical-align: middle; text-align: center;'>----</td>
                        <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre_area['tanggal']."</td>";
                        for($x=1; $x<=5; $x++){
                          if($data_pre_area['foto_'.$x]!=''){
                            $gambar = "src='../images/".$data_pre_area['foto_'.$x]."'";
                          }else{
                            $gambar="";
                          }
                          echo "
                        <td colspan='2'><img style='width: 300px; height: 200px;' ".$gambar."></img></td>";
                    }
                    echo "</tr>
                          <tr>";
                          for($x=1; $x<=5; $x++){
                            if($data_pre_area['keterangan_'.$x]!= ''){
                              echo "
                              <td>".$data_pre_area['keterangan_'.$x]."</td><td>Jam : ".$data_pre_area['jam_'.$x]."</td>";
                            }else{
                              echo "<td>-----</td><td>--</td>";
                            };}
                         echo " </tr>";
                      $no++;
                    }
                    $sql = mysqli_query($con, "SELECT tbl_perwakilan.kode_perwakilan, tbl_mnasional.posisi FROM tbl_perwakilan, tbl_mnasional, tbl_marea WHERE tbl_perwakilan.kode_area=tbl_marea.kode_area AND tbl_marea.kode_nas=tbl_mnasional.kode_nas AND tbl_perwakilan.kode_area='".$data_area['kode_area']."'");                    
                    while($data = mysqli_fetch_array($sql)){
                      if($data['posisi'] == 'Management'){
                      $query = mysqli_query($con, "SELECT tbl_presensiperwakilan.foto_1, tbl_presensiperwakilan.foto_2, tbl_presensiperwakilan.foto_3, tbl_presensiperwakilan.foto_4, tbl_presensiperwakilan.foto_5,tbl_presensiperwakilan.keterangan_1, tbl_presensiperwakilan.keterangan_2, tbl_presensiperwakilan.keterangan_3, tbl_presensiperwakilan.keterangan_4, tbl_presensiperwakilan.keterangan_5, tbl_presensiperwakilan.jam_1, tbl_presensiperwakilan.jam_2, tbl_presensiperwakilan.jam_3, tbl_presensiperwakilan.jam_4, tbl_presensiperwakilan.jam_5, tbl_perwakilan.kode_perwakilan, tbl_perwakilan.nama_kaper, tbl_perwakilan.alamat_perwakilan, tbl_presensiperwakilan.tanggal FROM tbl_perwakilan, tbl_mnasional, tbl_presensiperwakilan, tbl_marea WHERE tbl_perwakilan.kode_area=tbl_marea.kode_area AND tbl_marea.kode_nas=tbl_mnasional.kode_nas AND tbl_presensiperwakilan.kode_perwakilan=tbl_perwakilan.kode_perwakilan AND tbl_presensiperwakilan.kode_perwakilan='".$data['kode_perwakilan']."' AND tbl_presensiperwakilan.tanggal='".$tanggal."'"  );
                  while($data_pre=mysqli_fetch_array($query) ){
                    echo "
                    <tr>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$no."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre['nama_kaper']."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre['alamat_perwakilan']."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre['tanggal']."</td>";
                      for($x=1; $x<=5; $x++){
                        if($data_pre['foto_'.$x]!=''){
                          $gambar = "src='../images/".$data_pre['foto_'.$x]."'";
                        }else{
                          $gambar="";
                        }
                        echo "
                      <td colspan='2'><img style='width: 300px; height: 200px;' ".$gambar."</img></td>";
                  }
                  echo "</tr>
                        <tr>";
                        for($x=1; $x<=5; $x++){
                          if($data_pre['keterangan_'.$x]!= ''){
                            echo "
                            <td>".$data_pre['keterangan_'.$x]."</td><td>Jam : ".$data_pre['jam_'.$x]."</td>";
                          }else{
                            echo "<td>-----</td><td>--</td>";
                          }
                          }
                        echo "</tr>";
                    $no++;
                  }}
                      $qury_sales = mysqli_query($con, "SELECT tbl_presensisales.foto_1, tbl_presensisales.foto_2, tbl_presensisales.foto_3, tbl_presensisales.foto_4, tbl_presensisales.foto_5, tbl_presensisales.keterangan_1, tbl_presensisales.keterangan_2, tbl_presensisales.keterangan_3, tbl_presensisales.keterangan_4, tbl_presensisales.keterangan_5, tbl_presensisales.jam_1, tbl_presensisales.jam_2, tbl_presensisales.jam_3, tbl_presensisales.jam_4, tbl_presensisales.jam_5, tbl_sales.kode_sales, tbl_sales.nama_sales, tbl_perwakilan.alamat_perwakilan, tbl_presensisales.tanggal FROM tbl_mnasional, tbl_marea, tbl_perwakilan, tbl_sales, tbl_presensisales WHERE  tbl_sales.kode_sales=tbl_presensisales.kode_sales AND tbl_sales.kode_perwakilan=tbl_perwakilan.kode_perwakilan AND tbl_perwakilan.kode_area=tbl_marea.kode_area AND tbl_marea.kode_nas=tbl_mnasional.kode_nas AND tbl_sales.kode_perwakilan='".$data['kode_perwakilan']."' AND tbl_presensisales.tanggal='".$tanggal."'");
                    while($data_pre_sales=mysqli_fetch_array($qury_sales) ){
                    echo "
                    <tr>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$no."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre_sales['nama_sales']."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre_sales['alamat_perwakilan']."</td>
                      <td rowspan='2' style='vertical-align: middle; text-align: center;'>".$data_pre_sales['tanggal']."</td>";
                      for($x=1; $x<=5; $x++){
                        if($data_pre_sales['foto_'.$x]!=''){
                          $gambar = "src='../images/".$data_pre_sales['foto_'.$x]."'";
                        }else{
                          $gambar="";
                        }
                        echo "
                      <td colspan='2'><img style='width: 300px; height: 200px;' ".$gambar."></img></td>";
                  }
                  echo "</tr>
                        <tr>";
                        for($x=1; $x<=5; $x++){
                          if($data_pre_sales['keterangan_'.$x]!= ''){
                            echo "
                            <td>".$data_pre_sales['keterangan_'.$x]."</td><td>Jam : ".$data_pre_sales['jam_'.$x]."</td>";
                          }else{
                            echo "<td>-----</td><td>--</td>";
                          };}
                       echo " </tr>";
                    $no++;
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
