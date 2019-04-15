<?php
session_start();
if(!empty($_SESSION['akses'])){
  if ($_SESSION['akses']=='10'){
      header("location: Admin");
  }else if ($_SESSION['akses']=='1'){
      header("location: Nasional");
  }else if ($_SESSION['akses']=='2'){
      header("location: Area");
  }else if ($_SESSION['akses']=='3'){
      header("location: Perwakilan");
  }else if ($_SESSION['akses']=='4'){
      header("location: Sales");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Presensi Marketing</title>
  <link rel="shortcut icon" href="img/icon.jpg">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="responsive-full-background-image.css">
  <style type="text/css">
      .form{
         background:rgba(0, 0, 0, 0.39);
         box-shadow: 0px 0px 20px 6px;
         border-radius:5px;
         width:300px;
         margin:15px auto;
         padding:20px;
        }
      .input{
        background: rgba(23, 20, 20, 0.52);
        font-size:12pt;
        font-family:arial;
        color:#ffffff;
        width:100%;
        height:40px;
        padding:5px 5px 5px 10px;
        margin:3px;
        border-radius:3px;
        border:none;
        }
      .input:hover, #input:focus{
        background:rgba(97, 52, 13, 0.55);
        outline-style:none;
        }
      #submit[type="submit"]{
         background:rgba(31, 15, 2, 0.78);
         color:#ffffff;
         cursor:pointer;
         
        }
      #submit[type="submit"]:hover, #input[type="submit"]:focus{
         background:rgba(31, 15, 2, 0.78);
        }

</style>
</head>
<body">
<div class="login-box">
  <div class="login-logo">
    <font color="#ffffff" size="6pt"> WELCOME <b>MARKETING </b></br>CV. MEDIATAMASOLO </font>
  </div>
  <div class="form">
    <font color="#ffffff"><h4><p class="login-box-msg">Sign in to start your presence</p></h4></font>

    <form action="login.php" method="post">
      <div class="form-group has-feedback">
        <font color="#ffffff"> <input class="input" type="text" class="form-control" placeholder="Username" name ="username" id="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span></font>
      </div>
      <div id='pass' class="form-group has-feedback">
        <font color="#ffffff"><input class="input" type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span></font>
      </div>
      <div class="form-group has-feedback">
        <font color="#ffffff"><i id="icon" class="fa fa-eye-slash"> Lihat Password</i></font>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <input type="submit" id="submit" value="Sign In" class="form-control">
        </div>
      </div>
    </form>
  </div>
</div>
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

  var input = document.getElementById('password'),
    icon = document.getElementById('icon');
   icon.onclick = function () {

     if(icon.className == 'fa fa-eye-slash') {
        input.setAttribute('type', 'text');
        icon.className = 'fa fa-eye';
        document.getElementById("icon").innerHTML = " Sembunyikan Password";

     } else {
        input.setAttribute('type', 'password');
        icon.className = 'fa fa-eye-slash';
        document.getElementById("icon").innerHTML = " Lihat Password";
    }

   }
 });
</script>

</body>
</html>
