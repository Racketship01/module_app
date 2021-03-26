<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
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
        <li><i class="fa fa-dashboard"></i> Welcome!</li>
        <li class="active"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></li>
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >

    <div class="row" >

    <div class="col-lg-4 col-xs-4">
      <center>
        <h1><a href="exam-result.php"><i class="fa fa-briefcase"></i> </a>
        </h1><strong>My Result</strong>
      </center>
    </div>
    <div class="col-lg-4 col-xs-4">
      <center>
        <h1><a href="quiz-list.php"><i class="fa fa-align-justify"></i> </a>
        </h1><strong>Activities</strong>
      </center>
    </div>
   
    <div class="col-lg-4 col-xs-4">
       <center>
        <h1><a href="file-category.php"><i class="fa fa-folder"></i> </a></h1>
        <strong>My Files</strong>
      </center>
    </div>
     <div class="col-lg-4 col-xs-4">
       <center>
        <h1><a href="change.php"><i class="fa fa-wrench"></i> </a></h1>
        <strong>Change Password</strong>
      </center>
    </div>

    <!--
    <div class="col-lg-4 col-xs-4">
       <center>
        <h1><a href=""><i class="fa fa-archive"></i> </a></h1>
        <strong>Trivias</strong>
      </center>
    </div>
   
    <div class="col-lg-4 col-xs-4">
       <center>
        <h1><a href="exam-result.php"><i class="fa fa-archive"></i> </a></h1>
        <strong>Results</strong>
      </center>
    </div>
      <div class="col-lg-4 col-xs-4">
       <center>
        <h1><a href="edit-profile.php"><i class="fa fa-pencil"></i> </a></h1>
        <strong>Edit Profile</strong>
      </center>
    </div>
     -->
  </div>
         
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>