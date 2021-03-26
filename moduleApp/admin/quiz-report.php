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

    if($del)
    {
      header("location: section.php");
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
      <h4><i class="fa fa-file"></i> Quiz Results</h4>
      <hr>
 
  <form method="post">
     <select name="sec_id" class="form-control">
      <?php $list = getdata("*","sections");?>
      <?php if(!empty($list)):?>
        <?php 
        foreach ($list as $key => $value):
            $t = single_get("*","course_id","course_list",$value->course_id);
            $y = single_get("*","sec_id","user_account",$value->sec_id);
        ?>
          <option value="<?php echo $value->sec_id?>"
              <?php if(isset($_POST['search_button'])){
                  echo $_POST['sec_id'];
              }
              ?>>Section: <?php echo $value->SectionName?> - Course: <?php echo $t['course_name']?> - Year Level: <?php echo $y['year_lvl'];?> </option>
        <?php endforeach;?>
      <?php else:?>
        <option></option>
      <?php endif;?>
    </select>
    <p></p>
    <button class="btn btn-info" name="search_btn"><i class="fa fa-search"></i> Search</button>
  </form>
  <br>
  <?php 
  if(isset($_POST['search_btn'])){
    $list = report_list();
  ?>
  <div class="table-responsive">
  <?php if(!empty($list)):?>
          <table id="example1" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>ID number</td>
              <td>Full Name</td>
              <td>Address</td>
              <td>Email Address</td>
              <td>Course / Section</td>
              <td>Year Level</td>
              <td>Semester</td>
              <td>Action</td>
            </tr>
            </thead>
          <tbody>
        <?php foreach ($list as $key => $value):?>
           <tr>
              <td>
                <?php echo $value->idno?>
              </td>
              <td><?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?></td>
              <td><?php echo $value->address?></td>
              <td><?php echo $value->email?></td>
              <td>
                Course: 
                <?php
                $g = single_get("*","sec_id","sections",$value->sec_id);
                
                $t = single_get("*","course_id","course_list",$g['course_id']);
                 echo $t['course_name']?>
                 - Section: <?php echo $g['SectionName'];?>
                
              </td>
              <td><?php echo $value->year_lvl?></td>
              <td><?php echo $value->sem?></td>
              
              <td>
                <a href="view-exam.php?user_id=<?php echo $value->user_id?>" target="_blank">View Exam Results</a>
              </td>
             
            </tr>
        <?php endforeach;?>
        </table>
        <?php else:?>
          <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> There are no records on the database.</div>
        <?php endif;?>
  <?php 
  }
  ?>
</div>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>