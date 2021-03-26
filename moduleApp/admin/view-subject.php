<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  $g = getdata("*","subject");
  if(isset($_GET['delete']))
  {
    global $dbcon;
    $delete = filter($_GET['delete']);
    $tbl_name = "subject";
    $ar = array("sub_code"=>$delete);

    $del = delete($dbcon,$tbl_name,$ar);

      header("location: view-subject.php");

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
      <h4><i class="fa fa-file"></i> Subject List - <a href="add-subject.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Subject</a> </h4>
      <hr>
    <div class="table table-responsive">
     <?php if(!empty($g)):?>
    <table id="example1" class="table table-striped table-bordered" style="font-size:12px;">
      <thead>
      <tr>
        <td>Subject Description</td>
        <td>Schedule</td>
        <td>Course / Section</td>
        <td>Semester</td>
        <td>School Year</td>
        
        <td></td>
      </tr>
    </thead>
    <tbody>
   <?php foreach ($g as $key => $value):?>
    <tr>
        <td>
          <strong><?php echo $value->sub_code?></strong>
          <br>
          <?php echo $value->sub_desc?>
        </td>
        
        <td>
          Time:<?php echo $value->sub_time?><br>
          Day:  <?php echo $value->sub_day?>
        </td>
        <td>
            <?php $g = $dbcon->query("SELECT * FROM sections INNER JOIN course_list on course_list.course_id = sections.course_id WHERE sections.sec_id = '".$value->sec_id."'") or die(mysqli_error());
            $fetch = $g->fetch_assoc();
            ?>
            Course: <?php echo $fetch['course_name']?><br> Section: <?php echo $fetch['SectionName']?>
        </td>
        <td>
          Semester: <?php echo $value->sub_sem?><br>
        </td>
        <td>
          School Year: <?php echo $value->sub_year?><br>
         
        </td>
       
        <td>
          <a href="add-subject.php?sub_code=<?php echo $value->sub_code?>"><span class="glyphicon glyphicon-edit"></span></a>
      <a href="#" <?php echo 'onclick=" confirm(\'Do you want to delete this subject?\') 
      ?window.location = \'view-subject.php?delete='.$value->sub_code.'\' : \'\';"'; ?>><span class="glyphicon glyphicon-remove"></span></a>
        </td>
      </tr>
   <?php endforeach; ?>
   </table>
   </div>
   <?php else:?>
    <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> There are no records on the database.</div>
   <?php endif;?> 

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>