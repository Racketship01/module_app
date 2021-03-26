<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  
  $id = filter($_SESSION['user_id']);
  $g = $dbcon->query("SELECT * FROM user_account WHERE user_account.user_id='$id'") or die(mysqli_error());
  $row = $g->fetch_assoc();

  if(isset($_POST['update_button']))
  {
    $fname = filter($_POST['fname']);
    $lname = filter($_POST['lname']);
    $mname = filter($_POST['mname']);
    $address = filter($_POST['address']);
    $email = filter($_POST['email']);
    $course = filter($_POST['course']);
    $major = filter($_POST['major']);
    //$contact = filter($_POST['contact']);
    //$parent_email = filter($_POST['parent_email']);

    $allowedExts = array("jpeg", "gif", "png");
    $temp = explode(".", $_FILES["photo"]["name"]);
    $photo =$_FILES['photo'] ["name"];
    $extension = end($temp);


    if($_FILES['photo'] ["name"] == "")
    {
      $arr_where = array("user_id"=>$_SESSION['user_id']);//update where
      $arr_set = array(
        "fname"         =>$fname,
        "mname"         =>$mname,
        "lname"         =>$lname,
        "address"       =>$address,
        "email"         =>$email,
        "course"        =>$course,
        "major"         =>$major);
      $tbl_name = "user_account";

    $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
    header("location: index.php");
    }
    else
    {
    $arr_where = array("user_id"=>$_SESSION['user_id']);//update where
    $arr_set = array(
        "fname"       =>$fname,
        "mname"       =>$mname,
        "lname"       =>$lname,
        "address"     =>$address,
        "email"       =>$email,
        "course"      =>$course,
        "major"       =>$major,
        "user_photo"  =>$photo
    );
    $tbl_name = "user_account";

    $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
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

    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <ol class="breadcrumb">
        <li><i class="fa fa-pencil"></i> Update Profile</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >

    <form method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="row">
      <div class="col-md-2">Student #:</div>
      <div class="col-md-10">
        <input type="text" class="form-control" name="idno" value="<?php echo $row['idno']?>" readonly="readonly">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">First Name:</div>
      <div class="col-md-10">
        <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']?>">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">Middle Name:</div>
      <div class="col-md-10">
        <input type="text" class="form-control" name="mname" value="<?php echo $row['mname']?>">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">Last Name:</div>
      <div class="col-md-10">
        <input type="text" class="form-control" name="lname" value="<?php echo $row['lname']?>">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">Address:</div>
      <div class="col-md-10">
        <input type="text" class="form-control" name="address" value="<?php echo $row['address']?>">
      </div>
    </div>
    <p></p>
        <div class="row">
      <div class="col-md-2">Email:</div>
      <div class="col-md-10">
        <input type="email" class="form-control" name="email" value="<?php echo $row['email']?>">
      </div>
    </div>
    
    <p></p>
        <div class="row">
      <div class="col-md-2">Photo:</div>
      <div class="col-md-10">
        <input type="file" class="form-control" name="photo">
      </div>
    </div>
    <p></p>
     <center>
       <input type="submit" name="update_button" class="btn btn-primary" value="Update">
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