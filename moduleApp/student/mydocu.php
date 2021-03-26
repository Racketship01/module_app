<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
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
        <li><i class="fa fa-book"></i> Lessons</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >
     <iframe src="http://docs.google.com/gview?url=http://www.elearning.study-call.com/img/<?php echo $_GET['link']?>&embedded=true" width="100%" height="550"></iframe>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>