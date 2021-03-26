<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $t = single_get("*","idno","user_account",$_SESSION['idno']);
  $events = getdata_where("*","sec_id","announcements",$t['sec_id']);
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
        <li><i class="fa fa-calendar"></i> Announcements</li>
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >
    <?php if(!empty($events)):?>
      <?php foreach ($events as $key => $value):?>

              <div class="timeline-item" style="background: #f9f6f6;padding:2%; border-radius:3px;">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $value->a_date?></span>

                <h3 class="timeline-header"><?php echo $value->a_title;?></h3>

                <div class="timeline-body">
                  <?php echo $value->a_desc;?>
                </div>
              </div>
              <hr>
      <?php endforeach;?>
    <?php else:?>
      <div class="alert alert-danger">There are no records on database.</div>
    <?php endif;?>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>