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

 $query = "SELECT * FROM documents WHERE folder_id = '".$_GET['folder_id']."' AND user_id = '".$_SESSION['idno']."' AND archive_folder = '0' GROUP BY docu_code";
$documents = getdata_inner_join($query);

if(isset($_POST['upload_file'])){
$allowedExts = array("docx", "pdf", "doc");
$temp = explode(".", $_FILES["photo"]["name"]);
$photo =$_FILES['photo'] ["name"];
$extension = end($temp);
$docu_title = filter($_POST['docu_title']);
$code = mt_rand();

      $insert_array = array(
          "docu_code"           =>$code,
          "docu_title"          =>$docu_title,
          "uploaded_docu"       =>$photo,
          "folder_id"           =>$_GET['folder_id'],
          "user_id"             =>$_SESSION['idno']
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

              
<br>
<br><br>


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
                  <tr>
                      <td></td>
                      <td>
                          <button type="submit" name="upload_file" class="btn btn-primary">Save changes</button>
                      </td>
                  </tr>
                </table>
</form>

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
    </div>
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