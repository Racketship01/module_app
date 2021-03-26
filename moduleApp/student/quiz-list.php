<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
  $kweri = "SELECT * FROM quiz_content WHERE  quiz_status = '1'";
  $list = getdata_inner_join($kweri);
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
        <li><i class="fa fa-book"></i> Quiz List</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >

      <div style="padding:10px;">
     <?php if(!empty($list)):?>
      <table id="example2" class="table table-bordered table-striped" style="font-size:12px;">
        <thead>
        <tr>
          <td>Quiz Name</td>
          
        </tr>
      </thead>
      <tbody>
      <?php foreach ($list as $key => $value):?>
       <tr>
          <td>
              <strong>Quiz Name:</strong><?php echo $value->quiz_title?><br>
              <strong>Quiz Type:</strong><?php if($value->quiz_type == '0'):echo 'Fill in the blanks';elseif($value->quiz_type == '1'): echo 'Multiple Choice';elseif($value->quiz_type == '2'): echo 'True or False';endif;?>
              <br>
              <a href="enter-quiz.php?quiz_id=<?php echo $value->quiz_id?>&quiz_type=<?php echo base64_encode($value->quiz_type);?>">
                  <br>
                  <div class="btn btn-warning form-control">Start</div> </a>
              </td>
        
        </tr>
    <?php endforeach;?>
      </table>
    <?php else:?>
    <div class="alert alert-danger">There are no records on the database.</div>
  <?php endif;?>
</div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>