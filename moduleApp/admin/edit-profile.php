<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  $id = filter($_SESSION['idno']);
  $g = $dbcon->query("SELECT * FROM user_account WHERE user_account.idno='$id'") or die(mysqli_error());
  $row = $g->fetch_assoc();

  if(isset($_POST['update_button']))
  {
    $fname = filter($_POST['fname']);
    $lname = filter($_POST['lname']);
    $mname = filter($_POST['mname']);
    $address = filter($_POST['address']);
    $email = filter($_POST['email']);
    $allowedExts = array("jpeg", "gif", "png");
    $temp = explode(".", $_FILES["photo"]["name"]);
    $photo =$_FILES['photo'] ["name"];
    $extension = end($temp);


    if($_FILES['photo'] ["name"] == "")
    {
      $arr_where = array("idno"=>$_SESSION['idno']);//update where
    $arr_set = array("fname"=>$fname,"mname"=>$mname,"lname"=>$lname,
    "address"=>$address,"email"=>$email);
    $tbl_name = "user_account";

    $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
    //$update2 = update($dbcon,$tbl_name2,$arr_set2,$arr_where2);
    header("location: index.php");
    }
    else
    {
    $arr_where = array("idno"=>$_SESSION['idno']);//update where
    $arr_set = array("fname"=>$fname,"mname"=>$mname,"lname"=>$lname,
    "address"=>$address,"email"=>$email, "user_photo"=>$photo);
    $tbl_name = "user_account";

  
    $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
    //$update2 = update($dbcon,$tbl_name2,$arr_set2,$arr_where2);
    move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
    header("location: index.php");
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

    <section class="content container-fluid">
      <h3><i class="fa fa-pencil"></i> Update profile</h3>
      <hr>
      <form method="post" enctype="multipart/form-data" autocomplete="off">
<div class="row">
  <div class="col-md-2">Employee #:</div>
  <div class="col-md-6">
    <input type="text" class="form-control" name="idno" value="<?php echo $row['idno']?>" readonly="readonly">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">First Name:</div>
  <div class="col-md-6">
    <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']?>">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Middle Name:</div>
  <div class="col-md-6">
    <input type="text" class="form-control" name="mname" value="<?php echo $row['mname']?>">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Last Name:</div>
  <div class="col-md-6">
    <input type="text" class="form-control" name="lname" value="<?php echo $row['lname']?>">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Permanent Address:</div>
  <div class="col-md-6">
    <input type="text" class="form-control" name="address" value="<?php echo $row['address']?>">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Email Address:</div>
  <div class="col-md-6">
    <input type="email" class="form-control" name="email" value="<?php echo $row['email']?>">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Photo:</div>
  <div class="col-md-6"><input type="file" class="form-control" name="photo"></div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-6">
    <input type="submit" name="update_button" class="btn btn-primary" value="Update">
          <a href="index.php" class="btn btn-danger">Return</a>
  </div>
</div>
  
    </form>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>