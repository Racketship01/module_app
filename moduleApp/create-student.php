<?php
  include 'config/db.php';
  include 'config/functions.php';
  include 'config/main_function.php';

  if(isset($_SESSION['login_registrar']) == 'login_registrar')
  {
    header("location: admin/");
  }

  if(isset($_SESSION['login_teacher']) == 'login_teacher')
  {
    header("location: teacher/");
  }

  if(isset($_SESSION['login_student']) == 'login_student')
  {
    header("location: student/");
  }

 switch (true) {
    case isset($_POST['add_button']):
      $idno = filter($_POST['idno']);
      $pass = md5(filter($_POST['idno']));
      $fname = filter($_POST['fname']);
      $mname = filter($_POST['mname']);
      $lname = filter($_POST['lname']);
      $address = filter($_POST['address']);
      $email = filter($_POST['email']);
    
      if(has_null($idno,$fname,$mname,$lname,$address,$email))
      {
        $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Please fill up all the fields.</div>';
      }
      else
      { 
        if(isset($_GET['idno']))
        {
          
          $arr_where = array("idno"=>$_GET['idno']);//update where
          $arr_set = array(
            "idno"        =>  $idno,
            "fname"       =>  $fname,
            "mname"       =>  $mname,
            "lname"       =>  $lname,
            "address"     =>  $address,
            "email"       =>  $email,
            "sec_id"      =>  "1"
          );
          $tbl_name = "user_account";

          $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
          header("location: student-list.php");
        }
        else
        {
          if(checkname($fname,$mname,$lname))
          {
            $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Account Name already exist.</div>';
          }
          elseif(check_user($idno))
          {
            $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> ID number already exist.</div>';
          }
         
          else
          {
          $arr = array(
            "idno"      =>$idno,
            "pass"      =>$pass,
            "fname"     =>$fname,
            "mname"     =>$mname,
            "lname"     =>$lname,
            "address"   =>$address,
            "email"     =>$email,
            "user_photo"=>'nophoto.jpg',
            "role"      =>"4",
            "sec_id"    =>"1"
          );
          $d = insertdata("user_account",$arr);
          if($d)
          {
            //header("location: student-list.php");
            echo '<script>alert("You have successfully registered to the system. Please wait for your professor activation.");window.location.href="index.php";</script>';
          }
          else
          {
            echo 'Error';
          }
          }
        }
      }

    break;
    case isset($_GET['idno']):
     $idno = filter($_GET['idno']);
      $d = $dbcon->query("SELECT * FROM user_account INNER JOIN sections on sections.sec_id = user_account.sec_id WHERE idno = '$idno'") or die(mysqli_error());
      $count = mysqli_num_rows($d);

      if($count == 0)
      {
        $error = 'There are no result on the datbase.';
      }
      else
      {
        while($f = $d->fetch_assoc())
        {
          $fetch_id = $f['idno'];
          $fetch_fname = $f['fname'];
          $fetch_mname = $f['mname'];
          $fetch_lname = $f['lname'];
          $fetch_address = $f['address'];
          $fetch_email = $f['email'];
          $fetch_role = $f['role'];
          $sec_id = $f['sec_id'];
        }
      }
    break;

  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Account Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background:#f39c12;">
<div class="login-box">
  <div class="login-logo" style="margin-top:10px;">
    <a href="index.php">
      <img src="img/48374085_789120621428625_4633108606630232064_n.png" width="40%">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="width:100%;">
    <p class="login-box-msg">Sign in to start your session</p>

     <h4><i class="fa fa-plus"></i> Student Information</h4>
      <hr>
    <?php if(isset($msg)): echo $msg; endif;?>
    <form method="post" autocomplete="off">
<div class="row">
  
  <div class="col-md-12">
    <input type="text" class="form-control"  name="idno"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_id; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['idno']; endif;?>" placeholder="ID number">
  </div>
</div>
<div class="row">
  <p></p>
  <div class="col-md-12">
    <input type="text" class="form-control"  name="fname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_fname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['fname']; endif;?>" placeholder="First Name">
  </div>
</div>
<p></p>
<div class="row">

  <div class="col-md-12">
    <input type="text" class="form-control"  name="mname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_mname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['mname']; endif;?>" placeholder="Middle Name">
  </div>
</div>
<div class="row">
  <p></p>
  <div class="col-md-12">
    <input type="text" class="form-control"  name="lname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_lname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['mname']; endif;?>" placeholder="Last Name">
  </div>
</div>
<p></p>
<div class="row">

  <div class="col-md-12">
    <input type="text" class="form-control"  name="address"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_address; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['address']; endif;?>" placeholder="Address">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-12">
    <input type="email" class="form-control"  name="email"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_email; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['address']; endif;?>" placeholder="Email Address">
  </div>
</div>
<p></p>
<div class="row">

    <div class="col-md-2"></div>
  <div class="col-md-4"></div>
</div>
<br>
   <center>
     <input type="submit" name="add_button" class="btn btn-primary" value="Register">
          <a href="index.php" class="btn btn-danger">Return</a>
   </center>
    </form>

  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
