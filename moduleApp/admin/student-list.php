<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  $list = getdata_where("*","role","user_account","4");
  if(isset($_GET['delete']))
  {
    $delete = filter($_GET['delete']);
    $idno = filter($_GET['idno']);
    $del = $dbcon->query("DELETE FROM user_account WHERE user_id = '$delete'") or die(mysqli_error());
    
    $del = $dbcon->query("DELETE FROM student_subject WHERE student_id = '$idno'") or die(mysqli_error());
    
        $del = $dbcon->query("DELETE FROM exam_result WHERE exam_user = '$delete'") or die(mysqli_error());
    header("location: student-list.php");

  }
  
  if(isset($_GET['activate'])){
      $activate = filter($_GET['activate']);
      $update = $dbcon->query("UPDATE user_account SET user_status = '1' WHERE user_id = '$activate'") or die();
      header("location: student-list.php");
  }
  if(isset($_GET['deactivate'])){
      $deactivate = filter($_GET['deactivate']);
      $update = $dbcon->query("UPDATE user_account SET user_status = '0' WHERE user_id = '$deactivate'") or die();
      header("location: student-list.php");
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
      <h4><i class="fa fa-file"></i> Student List <!-- - <a href="add-student.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Student</a>--> </h4>
      <hr>
      <?php if(!empty($list)):?>
        <div class="row">
        <?php foreach ($list as $key => $value):?>
        <div class="col-lg-3 col-xs-6" style="background:#f2f2f2; border:2px solid white;">
               <br>
              <center><img src="../img/<?php echo $value->user_photo?>" class="img-circle" style="width:100px; height:100px;"></center>
               <ul style="padding:5px; list-style:none; font-size:12px;">
                <li><strong>ID Number:</strong>  <?php echo $value->idno?></li>
                <li><strong>Full Name:</strong> <?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?></li>
                <li><strong>Address:</strong> <?php echo $value->address?></li>
                <li><strong>Email Address:</strong> <?php echo $value->email?></li>
              </ul>
              <center>
               <a href="add-student.php?idno=<?php echo $value->idno?>" class="btn btn-info"><i class="fa fa-pencil"></i> </a>
               <?php if($value->user_status == '0'):?>
               <a href="student-list.php?activate=<?php echo $value->user_id?>" class="btn btn-warning"><i class="fa fa-lock"></i> </a>
               <?php else:?>
                 <a href="student-list.php?deactivate=<?php echo $value->user_id?>" class="btn btn-warning"><i class="fa fa-unlock"></i> </a>
               <?php endif;?>
                <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to delete?\') 
      ?window.location = \'student-list.php?delete='.$value->user_id.'&idno='.$value->idno.'\' : \'\';"'; ?> class="btn btn-danger"><i class="fa fa-remove"></i> </a>
    </center>
      <br>
        </div>
        <?php endforeach;?>
      <?php endif;?>



             </div>
      
      
      
      
      
     
      
        </div>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>