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
  $query = "SELECT * FROM documents WHERE docu_code = '".filter($_GET['docu_code'])."'";
$getDocs = getdata_inner_join($query);
if(isset($_GET['delete'])){
  $ar = array("docu_id"=>$_GET['delete']);
  $tbl_name = "documents";
  $del = delete($dbcon,$tbl_name,$ar);
  header("location: edit-document.php?docu_code=".$_GET['docu_code']."");
}
if(isset($_POST['save_notes'])){
  $editor1 = $_POST['editor1'];
  $update = $dbcon->query("UPDATE documents SET doc_notes = '$editor1' WHERE docu_code='".$_GET['docu_code']."'") or die(mysqli_error());
  header("location: file-category.php");
  //echo '<script>alert("You have successfully updated the content of notes.");</script>';
}
if(isset($_POST['upload_file'])){
$total = count($_FILES['photo']['name']);
$code = $_GET['docu_code'];
// Loop through each file
for($i=0; $i < $total; $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES['photo']['tmp_name'][$i];
  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "../img/" . $_FILES['photo']['name'][$i];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

      $insert_array = array("docu_code"=>$code,"uploaded_docu"=>$newFilePath);
      insertdata("documents",$insert_array);
      header("location: file-category.php");

    }
  }
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
      <div class="row">
        <div class="col-md-10"><h4><i class="fa fa-pencil"></i> Update Document</h4></div>
      <div class="col-md-2" style="margin-top: 8px;">
          <a href="" class="btn btn-info" data-toggle="modal" data-target="#upload-files"><i class="fa fa-upload"></i> Upload Files</a>
          </div>
      </div>
               <hr>
               <p>You may update documents here.</p>
               <?php if(!empty($getDocs)):?>
                <table class="table table-hovered table-striped">
               <?php 
                foreach ($getDocs as $key => $value):
                  if($value->doc_notes == ""):
               ?>
                <tr>
                  <td>File: <a href="<?php echo $value->uploaded_docu?>">
                    <?php echo substr($value->uploaded_docu,9)?></a></td>
                  <td>Date Uploaded: <?php echo $value->date_created?></td>
                  <td>
                    <a href="#" class="btn btn-danger" <?php echo 'onclick=" confirm(\'Are you sure you want to delete?\') 
      ?window.location = \'edit-document.php?delete='.$value->docu_id.'&docu_code='.$_GET['docu_code'].'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
                  </td>
                </tr>

                <?php else:?>
  <form method="post">
    <textarea id="editor1" name="editor1" rows="10" cols="80" required="required">
      <?php echo $value->doc_notes?>
    </textarea><br>
    <button class="btn btn-info" name="save_notes"><i class="fa fa-save"></i> Save Notes</button>
  </form>
                <?php endif;?>
                <?php endforeach;?>
                </table>
                <?php else:?>

                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
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
                      <input type="file" name="photo[]" multiple class="form-control">
                    </td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                
                <button type="submit" name="upload_file" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
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