<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
 $g = subject_list();
 $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
 if(isset($_POST['save_folder'])){
  $folder_title = filter($_POST['folder_title']);
  $sub_id = filter($_POST['sub_id']);
  

  $checkFolder = single_get("*","folder_title","main_folder",$folder_title);
  if($checkFolder['folder_title'] == $folder_title){
    echo '<script>alert("Folder Name: '.$folder_title.' already created")</script>';
  }else{
    $insertQuery = array("folder_title"=>$folder_title,
      "created_by"=>$_SESSION['idno'], "sub_id" => $sub_id);
    insertdata("main_folder",$insertQuery);
    header("location: file-category.php");
  }
}
if(isset($_GET['delete'])){
  $delete = filter($_GET['delete']);
  $del = $dbcon->query("DELETE FROM main_folder WHERE folder_id = '$delete'") or die(mysqli_error());
  header("location: create-lesson.php");
}
$folderSQL = "SELECT * FROM main_folder INNER JOIN subject on subject.sub_id = main_folder.sub_id WHERE folder_status = '0'";
$folder = getdata_inner_join($folderSQL);

if(isset($_POST['archive_docs']) != '')
{
    if(!empty($_POST['checkboxstatus'])) {
        $checked_values = $_REQUEST['checkboxstatus'];
        foreach($checked_values as $val) {
          $ar = array("folder_id"=>$val);
          $updateDocs = $dbcon->query("UPDATE main_folder SET folder_status = '1' WHERE folder_id = '$val'") or die(mysqli_error());
          //$tbl_name = "documents";
          //$del = delete($dbcon,$tbl_name,$ar);
        }
    header("location: file-category.php");
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid" style="background: white;">
          <div class="col-md-10"><h4><i class="glyphicon glyphicon-plus"></i> Folder List</h4></div>
    <div class="col-md-2" style="margin-top: 8px;"> 
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create-folder"><i class="glyphicon glyphicon-plus"></i> Create Folder</a>
    </div>
    <br>
<form method="post">
               <?php if(!empty($folder)):?>
                <table class="table table-bordered" id="example2">
                  <tr>
                    <td>Folder Name</td>
                  
                    <td>Action</td>
                  </tr>
                
               <?php foreach ($folder as $key => $value):?>
                <tr>

                    <td>
                      <a href="view-folder.php?folder_id=<?php echo $value->folder_id?>"><?php echo $value->folder_title?></a>
                      <br>
                      <?php echo $value->date_created?>
                      <br>
                         <?php 
                      $a = single_get("*","idno","user_account",$value->created_by);
                      echo $a['fname']." ".$a['lname']; 
                  
                      ?>
                    </td>
               
                    <td>
                      <a href="update-document.php?folder_id=<?php echo $value->folder_id?>"><i class="fa fa-pencil"></i> Edit</a>
                      <!--
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to delete?\') 
      ?window.location = \'documents.php?delete='.$value->folder_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
    -->
                    </td>
                  </tr>
               <?php endforeach;?>
               </table>
<!--
                 <button class="btn btn-danger" name="archive_docs"><i class="fa fa-remove"></i> Archive Folder</button>
-->
              </form>
               <?php else:?>
                <div class="alert alert-danger">There are no records on database.</div>
               <?php endif;?>
               <br>
               
   <div class="modal fade" id="create-folder">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Folder</h4>
              </div>
              <div class="modal-body">
<form method="post">
  <strong>Folder Name:</strong>
  <input type="text" name="folder_title" required="required" class="form-control" placeholder="Folder name"><br>
  <strong>Subject:</strong><br>
  <select class="form-control" name="sub_id">
    <?php
    $query = "SELECT * FROM subject"; 
    $subject = getdata_inner_join($query);
    ?>
    <?php if(!empty($subject)):?>
    <?php foreach ($subject as $key => $row):?>
      <option value="<?php echo $row->sub_id?>"><?php echo $row->sub_code?> / <?php echo $row->sub_desc?></option>
    <?php endforeach;?>
    
    <?php else:?>
     <option>No Records on database.</option> 
    <?php endif;?>
  </select><br>
 
              </div>

              <div class="modal-footer">
                
                <button type="submit" name="save_folder" class="btn btn-primary">Save</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

  </div>

    </div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>