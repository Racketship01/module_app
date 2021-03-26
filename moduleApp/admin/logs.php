<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
  $list = getdata_where("*","role","user_account","4");
  if(isset($_GET['delete']))
  {
    global $dbcon;
    $delete = filter($_GET['delete']);
    $tbl_name = "user_account";
    $ar = array("idno"=>$delete);

    $del = delete($dbcon,$tbl_name,$ar);

    if($del)
    {
      header("location: index.php");
    }
  }
$g = $dbcon->query("SELECT * FROM user_account WHERE role = '4'") or die(mysqli_error()); // student
$t = $dbcon->query("SELECT * FROM user_account WHERE role = '4'") or die(mysqli_error()); // teacher

$r = $dbcon->query("SELECT * FROM subject") or die(mysqli_error()); // subject
$l = $dbcon->query("SELECT * FROM logs") or die(mysqli_error()); // logs
$result = $dbcon->query("SELECT * FROM exam_result") or die(mysqli_error()); // logs
$folder = $dbcon->query("SELECT * FROM main_folder INNER JOIN subject on subject.sub_id = main_folder.sub_id WHERE folder_status = '0'") or die(mysqli_error());
?>
<?php include'../assets/header_top.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include'../assets/header.php';?>
  <aside class="main-sidebar">
    <?php include'../assets/sidebar.php';?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dashboard"></i> Dashboard
       
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Welcome!</li>
        <li class="active"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></li>
      </ol>
    </section>

    <!-- Main content -->

 
    <section class="content container-fluid">
    
<?php $logs = getdata("*","logs");?>
        <?php if(!empty($logs)):?>
          <table class="table table-bordered" id="example2" style="font-size:12px;background:white;">
            <thead>
              <tr>
                <td>Log Description</td>
                
              </tr>
            </thead>
          <tbody>
          
        <?php foreach ($logs as $key => $value):?>
          <tr>
            <td><?php echo $value->log_desc?>
              <br><?php echo $value->log_date?>
            </td>
          </tr>
        <?php endforeach;?>
        </table>
        <?php else:?>
          <div class="alert alert-danger">No records on the database.</div>
        <?php endif;?>
    

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>