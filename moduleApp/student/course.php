<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
   $query = "SELECT * FROM course_syllabus WHERE sec_id = '".$row['sec_id']."' AND sec_status = '0'";
  $events = getdata_inner_join($query);

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
        <li><i class="fa fa-file"></i> Course Syllabus</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >

    <?php if(!empty($events)):?>
      <?php foreach ($events as $key => $value):?>

              <div class="timeline-item" style="background: #f9f6f6;padding:2%; border-radius:3px;">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $value->sy_date?></span>

                <h3 class="timeline-header"><?php echo $value->sy_title;?></h3>

                <div class="timeline-body">
                <div class="table-responsive">
<?php echo $value->sy_desc;?>
                </div>
                  
                  <br>
                  <?php 
          if($value->sec_status == '0'){
            echo '<div style="background:yellow; color:black; padding:5px; border-radius:4px;">On Going</div>';
          }elseif($value->sec_status == '1'){
            echo '<div style="background:green; color:white; padding:5px; border-radius:4px;">Future</div>';
          }else{
            echo '<div style="background:red; color:white; padding:5px; border-radius:4px;">Done</div>';
          }
          ?>
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