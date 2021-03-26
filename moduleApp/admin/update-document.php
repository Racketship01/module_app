<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }

  switch (true) {
  case isset($_POST['save_btn']):
  $folder_title = filter($_POST['folder_title']);
  
    if(isset($_GET['folder_id'])){
      $update = $dbcon->query("UPDATE main_folder SET folder_title = '$folder_title' WHERE folder_id = '".$_GET['folder_id']."'") or die(mysqli_error());
      header("location: file-category.php");
    }else{
       $insert = array("program_name"=>$program_name);
       insertdata("program",$insert);
       header("location: file-category.php");
    }
  
    # code...
    break;

}
if(isset($_GET['folder_id'])){
$row = single_get("*","folder_id","main_folder",$_GET['folder_id']);
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid" style="background: white;">
         <h4><i class="fa fa-plus"></i> Update Folder</h4><hr>
          <div class="row" style="margin:1%;">
            <?php if(isset($msg)): ?>
              <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $msg;?>
              <br />
            </div>
            <?php endif;?>
            <form method="post">
              <table class="table table-bordered">
                <tr>
                  <td>Folder Name:</td>
                  <td><input type="text" name="folder_title" style="width:90%; height:34px;"
                  placeholder="Program" value="<?php if(isset($_POST['save_btn'])): echo $_POST['folder_title']; elseif(isset($_GET['folder_id'])): echo $row['folder_title']; endif;?>" required="required"></td>
                </tr>
                 <tr>
                  <td></td>
                  <td>
                    <button class="btn btn-primary btn-large" name="save_btn"><i class="fa fa-save"></i> Update Data</button>
                    <a href="file-category.php" class="btn btn-danger btn-large"><i class="fa fa-arrow-left"></i> Return</a>
                  </td>
                </tr>
              </table>
            </form>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>