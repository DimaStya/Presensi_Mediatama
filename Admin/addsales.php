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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script src = "js/sales.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    var htmlobjek;
    $(document).ready(function(){
      $("#kode_nas").change(function(){
        var kode_nas = $("#kode_nas").val();
        $.ajax({
          url: "ambil/ambilarea.php",
          data: "kode_nas="+kode_nas,
          cache: false,
          success: function(msg){
            $("#kode_area").html(msg);
          }
        });
      });
    });
    $(document).ready(function(){
      $("#kode_area").change(function(){
        var kode_area = $("#kode_area").val();
        $.ajax({
          url: "ambil/ambilperwakilan.php",
          data: "kode_area="+kode_area,
          cache: false,
          success: function(msg){
            $("#kode_perwakilan").html(msg);
          }
        });
      });
    });

  </script>
  <style type="text/css">
  .pesan_berhasil{
    display: none;
    border: 1px solid blue;
    width: 200px;
    top: 1px;
    left: 50px;
    padding: 1px 1px;
    background-color: lightskyblue;
    text-align: center;
  }
  .pesan_gagal{
    display: none;
    border: 1px solid red;
    width: 200px;
    top: 1px;
    left: 50px;
    padding: 1px 1px;
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
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-edit"></i>
              <span>Kelola Data Marketing</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="addmnasional.php"><i class="fa fa-circle-o"></i> Manager Nasional</a></li>
              <li><a href="addmarea.php"><i class="fa fa-circle-o"></i> Manager Area</a></li>
              <li><a href="addkaper.php"><i class="fa fa-circle-o"></i> Kepala Perwakilan</a></li>
              <li class="active"><a href="addsales.php"><i class="fa fa-circle-o"></i> Sales</a></li>
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
          <li><i class="fa fa-edit"></i> Home</li>
          <li class="active">Sales</li>
        </ol>
      </section>

      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Kelola Data Sales</h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="box box-primary">
                
                <form role="form" action="Proses/proses_sales.php?aksi=simpan" method="POST">
                  <div class="box-body">
                    <div class="form-group"> 
                      <div class="col-xs-6">
                        <label>Nama Lengkap</label>
                        <input type="hidden" name="kode_sales" id="kode_sales">
                        <input type="text" class="form-control col-xs-6" name="nama" id="nama"  placeholder="Nama Lengkap" required="">
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      
                      <div class="col-xs-6">
                        <label>Email</label>
                        <input type="email" class="form-control col-xs-6" name="email" id="email"  placeholder="Email" required="">
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-xs-6">
                        <label>Jabatan</label>
                        <select id="jabatan" name="jabatan" class="form-control col-xs-6" required="">
                          <option value="">--Pilih Jabatan--</option>
                          <option value="SALES">Sales</option>
                          <option value="ADMIN">Admin</option>
                          <option value="GL">GL</option>
                          <option value="GUDANG">GUDANG</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-6">                   
                      <label>Pilih Nama Manajer Nasional</label>
                      <select class="form-control" id ='kode_nas' name='kode_nas' required="">
                        <option value= "">--Pilih Nama Manajer Nasional--</option>
                        <?php
                        $sql = mysqli_query($con, "SELECT kode_nas, nama_nasional FROM tbl_mnasional");
                        while($data=mysqli_fetch_array($sql)){
                          echo "<option value= '".$data['kode_nas']."'>".$data['nama_nasional']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-6">                   
                      <label>Pilih Manager Area</label>
                      <select class="form-control" id ='kode_area' name='kode_area' required="">
                        <option value= "">--Pilih Manager Area--</option>
                      </select>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-6">                   
                      <label>Pilih Daerah Perwakilan</label>
                      <select class="form-control" id ='kode_perwakilan' name='kode_perwakilan' required="">
                        <option value= "">--Pilih Daerah Perwakilan--</option>
                      </select>
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Data Sales</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','')">+</button>
            <?php
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
              if($_SESSION['notif'] == "berhasil"){
               echo '<div  style="float:right" class="pesan_berhasil"><i class="icon fa fa-check">'.$_SESSION['pesan'].'</i></div>';
             }else if($_SESSION['notif'] == "gagal"){
               echo '<div  style="float:right" class="pesan_gagal"><i class="icon fa fa-ban">'.$_SESSION['pesan'].'</i></div>';
             }
             
           }
           $_SESSION['pesan'] = '';
           $_SESSION['notif'] = '';
           ?>
         </div>
         <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Manager Nasional</th>
              <th>Manager Area</th>
              <th>Email</th>
              <th>Alamat Perwakilan</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($con, "SELECT tbl_sales.jabatan, tbl_mnasional.kode_nas, tbl_sales.kode_sales, tbl_marea.kode_area,tbl_mnasional.nama_nasional,tbl_marea.nama_area, tbl_sales.email,tbl_perwakilan.alamat_perwakilan, tbl_sales.nama_sales FROM tbl_marea,tbl_mnasional, tbl_perwakilan, tbl_sales WHERE tbl_perwakilan.kode_area=tbl_marea.kode_area AND tbl_marea.kode_nas=tbl_mnasional.kode_nas AND tbl_perwakilan.kode_perwakilan=tbl_sales.kode_perwakilan");
            while($data=mysqli_fetch_array($query)){
              echo "
              <tr>
              <td>".$no."</td>
              <td>".$data['nama_sales']."</td>
              <td>".$data['nama_nasional']."</td>
              <td>".$data['nama_area']."</td>
              <td>".$data['email']."</td>
              <td>".$data['alamat_perwakilan']."</td>
              <td>".$data['jabatan']."</td>
              <td><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick=\"SetInput('".$data['kode_sales']."','".$data['nama_sales']."','".$data['email']."','".$data['kode_nas']."','".$data['jabatan']."')\"><i class='fa fa-fw fa-pencil-square-o'></i></button>|<button onclick='Klik".$no."()'  type='button' class='btn-danger'><i class='fa fa-fw fa-sign-out'></i></button></td>
              </tr>";
              $no++;
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
<script type="text/javascript">
  <?php
  $no =1;
  $query = mysqli_query($con, "SELECT * FROM tbl_sales");
  while($data=mysqli_fetch_array($query)){
    echo "
    function Klik".$no."(){
      var r = confirm('Yakin Mau Hapus?');
      if(r == true){
        window.location = 'Proses/proses_sales.php?aksi=resign&&kode_sales=".$data['kode_sales']."';
      }
      
    }
    ";
    $no++;
  }
  ?>
</script>
</body>
</html>
