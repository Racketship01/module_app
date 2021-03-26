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

 $query = "SELECT * FROM documents WHERE folder_id = '".$_GET['folder_id']."' AND archive_folder = '0' GROUP BY docu_code";
$documents = getdata_inner_join($query);
if(isset($_POST['delete_docs']) != '')
{
    if(!empty($_POST['checkboxstatus'])) {
        $checked_values = $_REQUEST['checkboxstatus'];
        foreach($checked_values as $val) {
          $ar = array("docu_code"=>$val);
          $updateDocs = $dbcon->query("UPDATE documents SET archive_folder = '1' WHERE docu_code = '$val'") or die(mysqli_error());
          //$tbl_name = "documents";
          //$del = delete($dbcon,$tbl_name,$ar);
        }
    header("location: view-folder.php?folder_id=".$_GET['folder_id']."");
    }
}
if(isset($_POST['share_file'])){
  $insert_file = array("docu_code"=>$_POST['docu_code'],"uploader"=>$_SESSION['idno'], "docu_course"=>$_POST['course']);
  insertdata("shared_files",$insert_file);
  $logs = array("log_desc"=>"".$user['fname']." shared files.");
            insertdata("system_logs",$logs);
  header("location: view-folder.php?folder_id=".$_GET['folder_id']."");
}
if(isset($_POST['save_doc'])){
  $doc_notes = $_POST['editor1'];
  $docu_title = filter($_POST['docu_title']);
  $docu_code = mt_rand();
  $allowedExts = array("doc", "docx", "pdf", "xlsx");
  $temp = explode(".", $_FILES["photo"]["name"]);
  $photo =$_FILES['photo'] ["name"];
  $extension = end($temp);

  $notes = array("doc_notes"=>$doc_notes,"docu_title"=>$docu_title,"docu_code"=>$docu_code,"folder_id"=>$_GET['folder_id'],"user_id"=>$_SESSION['idno'],"doc_files"=>$photo,"doc_type"=>"1");
  insertdata("documents",$notes);
  move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);

  header("location: view-folder.php?folder_id=".$_GET['folder_id']."");
}
if(isset($_GET['upload_file'])){
$allowedExts = array("docx", "pdf", "doc");
$temp = explode(".", $_FILES["photo"]["name"]);
$photo =$_FILES['photo'] ["name"];
$extension = end($temp);
$docu_title = filter($_GET['docu_title']);
$code = mt_rand();

      $insert_array = array(
          "docu_code"           =>$code,
          "docu_title"          =>$docu_title,
          "uploaded_docu"       =>$photo,
          "folder_id"           =>$_GET['folder_id']
      );
      insertdata("documents",$insert_array);
      move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
      header("location: view-folder.php?folder_id=".$_GET['folder_id'].""); 
  }
$folder = single_get("*","folder_id","main_folder",$_GET['folder_id']);
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
    
    <!-- Main content  data-toggle="modal" data-target="#upload-files" -->
    <section class="content container-fluid" style="background: white;">
         <div class="col-md-9"><h4><i class="glyphicon glyphicon-file"></i> Folder Name: <?php echo $folder['folder_title']?></h4></div>
                <div class="col-md-3" style="margin-top: 8px;"><a href="upload-docu.php?folder_id=<?php echo $_GET['folder_id']?>" class="btn btn-info"><i class="fa fa-upload"></i> Upload Files</a>
<!--
                 <a href="" class="btn btn-danger" data-toggle="modal" data-target="#create-docs"><i class="fa fa-upload"></i> Create Doc</a>
-->
                </div>
              
<br>

<form method="post">
              <?php if(!empty($documents)):?>
                <table class="table table-hovered table-bordered" id="example2">
                  <thead>
                  <tr>
                    <td>Title</td>
                    <td>Date Created</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
              <?php foreach ($documents as $key => $result):?>
                <tr>
                  
                    <td><a href="#" data-toggle="modal" data-target="#choice<?php echo $result->docu_code?>"><?php echo $result->docu_title?></a></td>
                    <td><?php echo $result->date_created?></td>
                    
                    <td>
                    <a href="edit-document.php?docu_code=<?php echo $result->docu_code?>" class="label label-info">Edit</a>
                      
              </button> 
                    </td>
                  </tr>
          <!-- View Document-->
          <!--Share document -->
          <div class="modal fade" id="view-docs<?php echo $result->docu_code?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Document</h4><hr>





               <h4>Title: <?php echo $result->docu_title?><br></h4>
                <?php 
                $sql = $dbcon->query("SELECT * FROM documents WHERE docu_code='".$result->docu_code."'") or die(mysqli_error());
                echo '<strong>You may View or Download the following document by just clicking the links below: </strong>';
                while ($row = $sql->fetch_assoc()):
                  if(empty($row['doc_notes'])):
                ?>
                <li>File: 
                 <a href="mydocu.php?link=<?php echo $row['uploaded_docu']?>"><?php echo $row['uploaded_docu']?></a> 
                </li>
                <?php else:?>
                  <?php echo $row['doc_notes'];?>
                  File: <a href="../img/<?php echo $row['doc_files']?>"><?php echo $row['doc_files']?></a>
                <?php endif;?>
              <?php endwhile;?>
                
              </div>
              <div class="modal-body">
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
          <!-- End-->
          <!--Share document -->
          <div class="modal fade" id="share-file<?php echo $result->docu_code?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Share files</h4><hr>
                <h4>Title: <?php echo $result->docu_title?><br></h4>
                
                
              </div>
              <div class="modal-body">
                <a href="share-course.php?docu_code=<?php echo $result->docu_code?>" class="btn btn-warning">Share to Course</a> <a href="share-user.php?docu_code=<?php echo $result->docu_code?>" class="btn btn-success">Share to Specific User</a>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        
                 <div class="modal fade" id="choice<?php echo $result->docu_code?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Document Option</h4>
              </div>
              <div class="modal-body">
                
                <a href="http://project5.hungrychubs.com/img/<?php echo rawurlencode($result->uploaded_docu);?>" class="btn btn-danger">Download Document</a>
              
                <a href="http://docs.google.com/viewer?url=http://project5.hungrychubs.com/img/<?php echo rawurlencode($result->uploaded_docu);?>" class="btn btn-info">View Document</a>
              </div>

              <div class="modal-footer">
                
              </div>
            </form>
            </div>
            
          </div>
        
        
        
        
              <?php endforeach;?>
              </table>
<!--
  <button class="btn btn-danger" name="delete_docs"><i class="fa fa-remove"></i> Archive Document</button>
-->
</form>
</div>
<br>
            <?php else:?>
              <div class="alert alert-danger">There are no records on the database.</div>
            <?php endif;?>

    <!-- Modal-->
    <!-- Upload Modal-->
  <div class="modal fade" id="upload-files">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Files</h4>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                <table class="table">
                  <tr>
                    <td>Title:</td>
                    <td><input type="text" name="docu_title" class="form-control" placeholder="Document Title"></td>
                  </tr>
                  
                  <tr>
                    <td>File:</td>
                    <td>
                      <input type="file" name="photo" class="form-control">
                    </td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                
                <button type="submit" name="upload_file" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!-- End of upload modal-->
  <!--Create Document -->
  <div class="modal fade" id="create-docs">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Document</h4>
              </div>
              <div class="modal-body">
<form method="post" enctype="multipart/form-data">
  <strong>Title:</strong>
  <input type="text" name="docu_title" required="required" class="form-control" placeholder="Document Title"><br>
  <tr>
    <td>File:</td>
    <td>
                      <input type="file" name="photo" class="form-control">
                    </td>
                  </tr>
  <textarea id="editor1" name="editor1" rows="10" cols="80" required="required">
  </textarea>

              </div>
              <div class="modal-footer">
                
                <button type="submit" name="save_doc" class="btn btn-primary">Save</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!-- End Create Document-->
    <!-- end Modal-->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="../bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>