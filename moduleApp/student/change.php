<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  
  if(isset($_POST['change_pass']))
  {
    $user_pass = md5($_POST['user_pass']);
    $new_pass = md5($_POST['new_pass']);
    $confirm_pass = md5($_POST['confirm_pass']);


    $check_user = single_get("*","idno","user_account",filter($_SESSION['idno']));
    
    if(has_null($user_pass,$new_pass,$confirm_pass))
    {
      $msg = 'Please fill up the fields';
    }
    elseif($new_pass != $confirm_pass)
    {
      $msg = 'Password do not match';
    }
    elseif($check_user['pass'] != $user_pass)
    {
      $msg = 'Old password is invalid';
    }
    else
    {
      $arr_where = array("idno"=>filter($_SESSION['idno']));//update where
      $arr_set = array("pass"=>$new_pass);
      $tbl_name = "user_account";

      $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
      $msg1 = '<div class="alert alert-success"><span class="glyphicon glyphicon-remove"></span>You have successfully change your password. Please click here to the main page <a href="index.php">Click here</a></div>';
    }
  }
?>
<?php include'../assets/header_top.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include'../assets/header.php';?>
  <aside class="main-sidebar">
    <?php include'../assets/sidebar.php';?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background:white;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <ol class="breadcrumb">
        <li><i class="fa fa-wrench"></i> Change Password</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >
 <?php if(isset($msg1)): echo $msg1; endif;?>
    <?php if(isset($msg)): echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> '.$msg.'</div>'; endif;?>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="row">
      <div class="col-md-2">Old Password:</div>
      <div class="col-md-10">
        <input type="password" name="user_pass" class="form-control" placeholder="Old Password">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">New Password:</div>
      <div class="col-md-10">
        <input type="password" name="new_pass" class="form-control" placeholder="New Password">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">Confirm Password:</div>
      <div class="col-md-10">
        <input type="password" name="confirm_pass" class="form-control" placeholder="Confirm Password">
      </div>
    </div>

    <p></p>
     <center>
       <input type="submit" class="btn btn-primary" name="change_pass" value="Change Password">
        <a href="index.php" class="btn btn-danger">Return</a>
     </center>
    </form>
         
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>