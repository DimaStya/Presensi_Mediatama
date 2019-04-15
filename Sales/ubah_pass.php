<?php
session_start();
include('../koneksi.php');
if(!empty($_SESSION['username'])){
  if($_SESSION['akses'] != '4'){
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
        <li class="active">
          <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview">
          <a href="presensi.php"><i class="fa fa-book"></i><span>Kehadiran</span></a>
        </li> 
        <li class="treeview">
          <a href="data_presensi.php"><i class="fa fa-book"></i><span>Daftar Kehadiran</span></a>
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
        <li class="active">Akun</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Akun</h3>
            </div>
        <div class="box-body">
          <div class="col-xs-12">
            <form  id="ubah" action="" method="POST">
              <?php
                $sql=mysqli_query($con, "SELECT * FROM tbl_user WHERE username='".$_SESSION['username']."'");
                $data = mysqli_fetch_array($sql);
              ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="hidden" name="kode" id="kode" value="<?php echo $data['kode'];?>">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"  value="<?php echo $data['username']; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="password_lama">Password Lama</label>
                  <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama" >
                </div>
                <div class="form-group">
                  <label for="password_baru">Password Baru</label>
                  <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password Baru" >
                </div>
                <div class="form-group">
                  <label for="password_konfirm">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="password_konfirm" name="password_konfirm" placeholder="Konfirmasi Password">
                </div>
              </div>
              <div class="box-footer">
                <button type="butoon" class="btn btn-primary" name="submit" id="submit" >Submit</button>
              </div>
            </form>
            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            $Password_lama = strtolower($_POST['password_lama']);
            $Password_baru = strtolower($_POST['password_baru']);
            $konfirmasi_password = strtolower($_POST['password_konfirm']);
            $email = strtolower($_POST['email']);
            $kode = $_POST['kode'];
            $submit = $_POST['submit'];
            if(isset($submit)){
              if (isset($Password_baru) && isset($Password_lama)) {
                $sql = mysqli_query($con,"SELECT pass FROM tbl_user WHERE username ='".$_SESSION['username']."'");
                $data= mysqli_fetch_array($sql);
                if (base64_encode($Password_lama) == $data['pass']){
                  if($Password_baru == $konfirmasi_password){
                    $up = mysqli_query($con,"UPDATE tbl_user SET pass='".base64_encode(strtolower($Password_baru))."',username='$email' WHERE kode='".$kode."'");
                    $updata = mysqli_query($con,"UPDATE tbl_sales SET email='$email' WHERE kode_sales='".$kode."'");
                    if($up && $updata){
                      echo '<script type="text/javascript"> alert("Password Baru Berhasil Dirubah :)")</script>';
                    }
                  }else{
                    echo '<script type="text/javascript"> alert("Konfirmasi Password Tidak sesuai!!!")</script>';
                  }

                }else{
                  echo '<script type="text/javascript"> alert("Password lama tidak benar!!!")</script>';
                }
              }else{
                $upem = mysqli_query($con,"UPDATE tbl_user SET username='$email' WHERE kode='".$kode."'");
                $updataem = mysqli_query($con,"UPDATE tbl_sales SET email='$email' WHERE kode_sales='".$kode."'");
                if($upem && $updataem){
                  $_SESSION['username'] = $email;
                  echo '<script type="text/javascript"> alert("Email Baru Berhasil Dirubah :)"); window.location ="ubah_pass.php"; 
                  </script>';
                }
            }
            }


          ?>
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
