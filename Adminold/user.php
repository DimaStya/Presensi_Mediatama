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
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script src = "js/user.js"></script>
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
        <li class="active">
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
        <li><i class="fa fa-user"></i> Home</li>
        <li class="active">User</li>
      </ol>
    </section>

    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lihat Data User Marketing</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control col-xs-6" name="nama" id="nama"  placeholder="Nama Lengkap" readonly="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="col-xs-6">
                      <label>Email</label>
                      <input type="email" class="form-control col-xs-6" name="email" id="email"  placeholder="Email" readonly="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="col-xs-6">
                      <label>Password</label>
                      <input type="text" class="form-control col-xs-6" name="pass" id="pass"  placeholder="Email" readonly="">
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data User Marketing</h3>    
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Jabatan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $query_nas = mysqli_query($con, "SELECT * FROM tbl_mnasional");
                  while($data_nas=mysqli_fetch_array($query_nas)){
                    $user_nas = mysqli_query($con, "SELECT * FROM tbl_user WHERE kode = '".$data_nas['kode_nas']."'");
                    while($data_user_nas=mysqli_fetch_array($user_nas)){
                      echo "
                        <tr>
                          <td>".$no."</td>
                          <td>".$data_nas['nama_nasional']."</td>
                          <td>".$data_nas['email']."</td>
                          <td>Manager Nasional</td>
                          <td><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick=\"SetInput('".$data_nas['nama_nasional']."','".$data_nas['email']."','".base64_decode($data_user_nas['pass'])."')\"><i class='fa fa-fw fa-pencil-square-o'></i></button></td>
                      </tr>";
                      $no++;
                    }
                    $query_area = mysqli_query($con, "SELECT * FROM tbl_marea WHERE kode_nas='".$data_nas['kode_nas']."'");
                      while($data_area =mysqli_fetch_array($query_area)){
                        $user_area = mysqli_query($con, "SELECT * FROM tbl_user WHERE kode = '".$data_area['kode_area']."'");
                        while($data_user_area=mysqli_fetch_array($user_area)){
                          echo "
                        <tr>
                          <td>".$no."</td>
                          <td>".$data_area['nama_area']."</td>
                          <td>".$data_area['email']."</td>
                          <td>Manager Area</td>
                          <td><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick=\"SetInput('".$data_area['nama_area']."','".$data_area['email']."','".base64_decode($data_user_area['pass'])."')\"><i class='fa fa-fw fa-pencil-square-o'></i></button></td>
                      </tr>";
                      $no++;
                        }
                        $query_perwakilan = mysqli_query($con, "SELECT * FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'");
                      while($data_perwakilan =mysqli_fetch_array($query_perwakilan)){
                        $user_perwakilan = mysqli_query($con, "SELECT * FROM tbl_user WHERE kode = '".$data_perwakilan['kode_perwakilan']."'");
                        while($data_user_perwakilan=mysqli_fetch_array($user_perwakilan)){
                          echo "
                        <tr>
                          <td>".$no."</td>
                          <td>".$data_perwakilan['nama_kaper']."</td>
                          <td>".$data_perwakilan['email']."</td>
                          <td>Kepala Perwakilan</td>
                          <td><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick=\"SetInput('".$data_perwakilan['nama_kaper']."','".$data_perwakilan['email']."','".base64_decode($data_user_perwakilan['pass'])."')\"><i class='fa fa-fw fa-pencil-square-o'></i></button></td>
                      </tr>";
                      $no++;
                        }
                        $query_sales = mysqli_query($con, "SELECT * FROM tbl_sales WHERE kode_perwakilan='".$data_perwakilan['kode_perwakilan']."'");
                      while($data_sales =mysqli_fetch_array($query_sales)){
                        $user_sales = mysqli_query($con, "SELECT * FROM tbl_user WHERE kode = '".$data_sales['kode_sales']."'");
                        while($data_user_sales=mysqli_fetch_array($user_sales)){
                          echo "
                        <tr>
                          <td>".$no."</td>
                          <td>".$data_sales['nama_sales']."</td>
                          <td>".$data_sales['email']."</td>
                          <td>Sales</td>
                          <td><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick=\"SetInput('".$data_sales['nama_sales']."','".$data_sales['email']."','".base64_decode($data_user_sales['pass'])."')\"><i class='fa fa-fw fa-pencil-square-o'></i></button></td>
                      </tr>";
                      $no++;
                        }
                      }
                      }
                      }
                  }
                  ?>
                </tbody>
                </tfoot>
              </table>
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
<script src="js/jquery.min.js"></script>
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
