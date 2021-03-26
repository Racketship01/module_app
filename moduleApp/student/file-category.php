<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  
 $g = subject_list();
 $row = single_get("*","idno","user_account",filter($_SESSION['idno']));


$folderSQL = "SELECT * FROM main_folder INNER JOIN subject on subject.sub_id = main_folder.sub_id WHERE folder_status = '0'";
$folder = getdata_inner_join($folderSQL);


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
          <div class="col-md-10"><h4><i class="glyphicon glyphicon-folder"></i> Folder List</h4></div>
    <div class="col-md-2" style="margin-top: 8px;"> 
      
    </div>
    <br>
<form method="post">
               <?php if(!empty($folder)):?>
                <table class="table table-bordered" id="example2">
                  <tr>
                    <td>Folder Name</td>
                  
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