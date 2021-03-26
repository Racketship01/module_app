<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
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
        <li><i class="fa fa-book"></i> Lessons</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >
    <table id="example2" class="table table-striped table table-responsive" style="font-size:13px;">
      <thead>
      <tr>
        <th>Folder Name</th>
        <th>Date Created</th>
        <th>Uploaded By</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $g = $dbcon->query("SELECT * FROM student_subject WHERE student_id = '".$_SESSION['idno']."'") or die(mysqli_error());
      while($row = $g->fetch_object()){
        
        $t = $dbcon->query("SELECT * FROM main_folder LEFT JOIN user_account on user_account.idno = main_folder.created_by WHERE sub_id = '".$row->sub_id."' AND folder_status = '0'") or die(mysqli_error());
        while($value = $t->fetch_object()){
          //echo $value['folder_title'];
      ?>
      <tr>
        <td>
          <a href="" data-toggle="modal" data-target="#view-document<?php echo $value->folder_id?>"><?php echo $value->folder_title?></a>
        </td>
        <td><?php echo $value->date_created?></td>
        <td><?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?></td>
  
      </tr>
         <div class="modal fade" id="view-document<?php echo $value->folder_id?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Documents</h4>
              </div>
              <div class="modal-body">
                <?php 
                $sql = $dbcon->query("SELECT * FROM documents WHERE folder_id='".$value->folder_id."'") or die(mysqli_error());
                
                if(mysqli_num_rows($sql) == 0):
                  echo '<div class="alert alert-danger">There are no records on the database.</div>';
                else:
                  echo '<p>You may View or Download the following document by just clicking the links below: </p>';
                while ($row = $sql->fetch_assoc()):
                  if(empty($row['doc_notes'])):
                ?>
                <h4>Title: <?php echo $row['docu_title']?><br></h4>
                <li>File: 
                 <a href="mydocu.php?link=<?php echo $row['uploaded_docu']?>"><?php echo $row['uploaded_docu'];?></a> 
                </li> 
                <?php else:?>
                  <h4>Title: <?php echo $row['docu_title']?><br></h4>
                  <?php echo $row['doc_notes'];?><br>

                  File: <a href="../img/<?php echo $row['doc_files']?>"><?php echo $row['doc_files']?></a>
                <?php endif;?>
                <hr>
              
              <?php endwhile;?>
              <?php endif;?>
              </div>

              <div class="modal-footer">
                
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

  </div>

    </div>
      <?php
        }
      }
      ?>
    </table>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>