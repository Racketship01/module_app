<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  $list = getdata("*","sections");
  if(isset($_GET['delete']))
  {
    global $dbcon;
    $delete = filter($_GET['delete']);
    $tbl_name = "sections";
    $ar = array("sec_id"=>$delete);

    $del = delete($dbcon,$tbl_name,$ar);
    
    //announcement
    $tbl_name2 = "announcements";
    $ar2 = array("sec_id"=>$delete);

    $del = delete($dbcon,$tbl_name2,$ar2);
    //course syllabus
    $tbl_name3 = "course_syllabus";
    $ar3 = array("sec_id"=>$delete);

    $del = delete($dbcon,$tbl_name3,$ar3);
    
    //quiz content
    
    $tbl_name4 = "quiz_content";
    $ar4 = array("sec_id"=>$delete);

    $del = delete($dbcon,$tbl_name4,$ar4);
    
    //subject
    $tbl_name5 = "subject";
    $ar5 = array("sec_id"=>$delete);

    $del = delete($dbcon,$tbl_name5,$ar5);
    
    //account
    $tbl_name6 = "user_account";
    $ar6 = array("sec_id"=>$delete);

    $del = delete($dbcon,$tbl_name6,$ar6);
    
    header("location: section.php");
    
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
      <h4><i class="fa fa-file"></i> Section List - <a href="add-section.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add Section</a> </h4>
      <hr>
    <div class="table-responsive">
     <?php if(!empty($list)):?> 
    <table id="example1" class="table table-striped table-bordered" style="font-size:12px;">
        <thead>
        <tr>
          <td>ID</td>
          <td>Section Name</td>
          <td>Course Name</td>
          
          <td>Option</td>
          
        </tr>
       </thead>
    <tbody>
    <?php foreach ($list as $key => $value):?>
       <tr>
          <td><?php echo $value->sec_id?></td>
          <td><?php echo $value->SectionName?></td>
          <td>
            <?php 
            $y = single_get("*","course_id","course_list",$value->course_id);
            echo $y['course_name'];
            ?>
          </td>
          
          <td>
            <a href="add-section.php?sec_id=<?php echo $value->sec_id?>"><i class="fa fa-pencil"></i></a>
            <a href="#" <?php echo 'onclick=" confirm(\'Do you want to delete this section?\') 
      ?window.location = \'section.php?delete='.$value->sec_id.'\' : \'\';"'; ?>><span class="glyphicon glyphicon-remove"></span></a>
          </td>
        
        </tr>
    <?php endforeach;?>
    </table>
    <?php else:?>
      <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> There are no records on the database.</div>
    <?php endif;?>
    </div>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>