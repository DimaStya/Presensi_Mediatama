<?php
session_start();
include('../koneksi.php');
if(!empty($_SESSION['username'])){
  if($_SESSION['akses'] != '2'){
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
      .pesan_berhasil{
          border: 1px solid blue;
          width: 200px;
          left: 50px;
          background-color: lightskyblue;
          text-align: center;
      }
      .pesan_gagal{
          border: 1px solid red;
          width: 200px;
          left: 50px;
          background-color: #ffb3b3;
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
        <li class="active">
          <a href="presensi.php"><i class="fa fa-book"></i><span>Kehadiran</span></a>
        </li> 
        <li class="treeview">
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Presensi</h3>
          <?php
                if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                  if($_SESSION['notif'] == "berhasil"){
                     echo '<div  style="float:right" class="pesan_berhasil"><i class="icon fa fa-check"> '.$_SESSION['pesan'].'</i></div>';
                  }else if($_SESSION['notif'] == "gagal"){
                     echo '<div  style="float:right" class="pesan_gagal"><i class="icon fa fa-ban"> '.$_SESSION['pesan'].'</i></div>';
                  }
                   
                  }
                $_SESSION['pesan'] = '';
                $_SESSION['notif'] = '';
              ?>
        </div>
        <?php
        date_default_timezone_set("Asia/Jakarta");
        
        $hour = strtotime(date("H:i"));
        if($hour<=strtotime('08:15')){
            $tanggal= date('d-m-Y', strtotime('-1 days', strtotime( date('d-m-Y') )));
        }else if($hour>strtotime('08:15')){
          $tanggal= date('d-m-Y');
        }
          $query = mysqli_query($con, "SELECT * FROM tbl_presensimarea WHERE tanggal= '".$tanggal."' AND kode_area='".$_SESSION['kode']."'");
          $data = mysqli_fetch_array($query);
          if($data['keterangan_1']==''){
            $angka =1;
          }else if($data['keterangan_2']==''){
            $angka =2;
          }else if($data['keterangan_3']==''){
            $angka =3;
          }else if($data['keterangan_4']==''){
            $angka =4;
          }else if($data['keterangan_5']==''){
            $angka =5;
          }else{
            $angka =6;
          }
        ?>
        <?php 
        if($angka != 6){
        echo '
        <form action="proses_presensi.php" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <div class="col-xs-5">
              <label>Kegiatan Ke '.$angka.'</label>
              <input type="hidden" name="tanggal" id="tanggal" value="'.$tanggal.'">
              <input type="hidden" name="angka" id="angka" value="'.$angka.'">
              <input type="hidden" name="kode_presensi" id="kode_presensi" value="'. $data['kode_presensi'].'">
            <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Anda akan memasukan kegiatan yang ke-'.$angka.', hari ini tanggal '.$tanggal.' :)" style="margin: 0px 32.5px 0px 0px; resize:none; width: 350px; height: 184px;" required="required"></textarea>
            </div>
          </div>
        </div>
        <div class="box-body">
              <div class="form-group">
                <div class="col-xs-3">
                  <label>Foto</label>
                  <img id="uploadPreview" style="width: 250px; height: 150px;" /><br>
                  <input id="uploadImage" type="file" name="uploadImage" onchange="PreviewImage();" required="" />
                </div>
              </div>
            </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>';
    }else{
      echo '<div class="box-body">
              <div class="form-group">
                <div class="col-xs-5">
                  <label>Anda telah menyelesaikan target maksimal presensi hari ini</label>
                </div>
              </div>
            </div>';
    }
      ?>
      <hr>
      <h3>Daftar Presensi Anda pada Tanggal <?php echo $tanggal;?></h3>
      <div class="box-body">
          <div class="box-body no-padding">
              <div class="scrol">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kegiatan</th>
                  <th>Foto</th>
                  <th>Jam</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for($x=1; $x<=5; $x++){
                    if($data['keterangan_'.$x]!=''){
                    echo "<tr>
                      <td>".$x."</td>
                      <td>".$data['keterangan_'.$x]."</td>
                      <td><img style='width: 300px; height: 200px;' src='../images/".$data['foto_'.$x]."'></img></td>
                      <td>".$data['jam_'.$x]."</td>
                      </tr>
                    ";
                    }
                  }                    
                ?>
              </tbody>
            </table>
          </div>
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
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script>
//            angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
  $(document).ready(function(){setTimeout(function(){$(".pesan_gagal").fadeIn('slow');}, 500);});
//            angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
  setTimeout(function(){$(".pesan_gagal").fadeOut('slow');}, 3000);
  //            angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
  $(document).ready(function(){setTimeout(function(){$(".pesan_berhasil").fadeIn('slow');}, 500);});
//            angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
  setTimeout(function(){$(".pesan_berhasil").fadeOut('slow');}, 3000);
</script>
<script type="text/javascript">
    function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function (oFREvent)
     {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
    };
</script>
</body>
</html>
