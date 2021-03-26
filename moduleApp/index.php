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


  if(isset($_POST['login_button']))
  {
    $user_name = filter($_POST['idno']);
    $user_pass = md5(filter($_POST['pass']));
    $user_status = "1";
    if(has_null($user_name,$user_pass))
    {
      
      echo '<script>
              alert("Please enter your username or password.");
                </script>';
    }
    else
    {
      $stmt = $dbcon->prepare("SELECT user_id,idno,pass,role,fname,mname,lname,role,user_photo, user_status FROM user_account WHERE idno = ? AND pass = ? AND user_status = ? ") or die(mysqli_error());

      $stmt->bind_param('sss',$user_name,$user_pass,$user_status);
      $stmt->execute();
      $stmt->bind_result($user_id,$idno,$pass,$role,$fname,$mname,$lname,$role,$photo,$user_status);
      $stmt->store_result();
      $count = $stmt->num_rows;

      if($count == 0)
      {
        echo '<script>alert("Wrong username/ password or your account is not yet activated.");</script>';         
      }
      else
      {
        while($stmt->fetch())
        {

          if($role == '1')
          {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['idno'] = $idno;
            $_SESSION['fname'] = $fname;
            $_SESSION['mname'] = $mname;
            $_SESSION['lname'] = $lname;
            $_SESSION['photo'] = $photo;
            $_SESSION['user_role'] = '1';
            $_SESSION['role'] = $role;
            $_SESSION['login_admin'] = 'login_admin';
          $f = array("log_desc"=>"".$fname." ".$mname." ".$lname." has login to the system");
          insertdata("logs",$f);
          header("location: admin/");
          }
          elseif($role == '2')
          {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['idno'] = $idno;
            $_SESSION['fname'] = $fname;
            $_SESSION['mname'] = $mname;
            $_SESSION['lname'] = $lname;
            $_SESSION['photo'] = $photo;
            $_SESSION['user_role'] = '2';
            $_SESSION['role'] = $role;
            $_SESSION['login_registrar'] = 'login_registrar';
          $f = array("log_desc"=>"".$fname." ".$mname." ".$lname." has login to the system");
          insertdata("logs",$f);
          header("location: admin/");
          }
          elseif($role == '3')
          {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['idno'] = $idno;
            $_SESSION['fname'] = $fname;
            $_SESSION['mname'] = $mname;
            $_SESSION['lname'] = $lname;
            $_SESSION['photo'] = $photo;
            $_SESSION['user_role'] = '3';
            $_SESSION['role'] = $role;
            $_SESSION['login_teacher'] = 'login_teacher';
          $f = array("log_desc"=>"".$fname." ".$mname." ".$lname." has login to the system");
          insertdata("logs",$f);
          header("location: teacher/");
          }
          elseif($role == '4')
          {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['idno'] = $idno;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['fname'] = $fname;
            $_SESSION['mname'] = $mname;
            $_SESSION['lname'] = $lname;
            $_SESSION['photo'] = $photo;
            $_SESSION['user_role'] = '4';
            $_SESSION['role'] = $role;
            $_SESSION['login_student'] = 'login_student';
          $f = array("log_desc"=>"".$fname." ".$mname." ".$lname." has login to the system");
          insertdata("logs",$f);
          header("location: student/");
          
          }
          
        }
        $stmt->close();
      }     
    }   
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
<body class="hold-transition login-page" style="background:#f2f2f2;">
<div class="login-box">
  <div class="login-logo" style="margin-top:10px;">
    <a href="index.php">
      <img src="img/48374085_789120621428625_4633108606630232064_n.png" width="40%">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="idno" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <a href="create-student.php"><i class="fa fa-plus"></i> Signup Student</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login_button" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
   
         <div class="modal fade" id="create-account">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Account</h4>
              </div>
              <div class="modal-body">
                <a href="create-student.php" class="btn btn-danger">Student</a> <a href="create-prof.php" class="btn btn-info">Professor</a>
              </div>

              <div class="modal-footer">
                
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

  </div>
  
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
