<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  if(isset($_POST['type_button']))
  {
    $quiz_title = filter($_POST['quiz_title']);
    $quiz_date = filter($_POST['quiz_date']);
    $quiz_type = filter($_POST['quiz_type']);
    $timer = filter($_POST['timer']);

    if(has_null($quiz_title,$quiz_date,$quiz_type))
    {
      $msg = 'Please fill up all the fields.';
    }
    else
    {
      $insert_query = array("view"=>$_POST['view'],"timer"=>$timer, "quiz_title"=>$quiz_title,"quiz_date"=>$quiz_date, "quiz_type"=>$quiz_type);
      $success = insertdata("quiz_content",$insert_query);

      if($success)
      {
        header("location: quiz-list.php");
      }
    }
  }
  if(isset($_GET['quiz_id']))
  {
    global $dbcon;
    $quiz_id = filter($_GET['quiz_id']);
    $tbl_name = "quiz_content";
    $ar = array("quiz_id"=>$quiz_id);
    $del = delete($dbcon,$tbl_name,$ar);

    if($del)
    {
      header("location: quiz-list.php?M_ID=$M_ID");
    }
  }
  elseif(isset($_GET['activate']))
  {
     $arr_where = array("quiz_id"=>filter($_GET['activate']));//update where
     $arr_set = array("quiz_status"=>"1");
     $tbl_name = "quiz_content";

     $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
     //$error = 'Quiz already Activaded.';
     header("location: quiz-list.php");
  }
  elseif(isset($_GET['deactivate']))
  {
     $arr_where = array("quiz_id"=>filter($_GET['deactivate']));//update where
     $arr_set = array("quiz_status"=>"0");
     $tbl_name = "quiz_content";

     $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
      //$error = 'Quiz already Deactivated.';
    header("location: quiz-list.php");
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
   <h3 class="box-title"><i class="fa fa-file"></i> List of Quiz</h3>
              <hr>
              <div class="row">
                <div class="col-md-12">
<table id="example2" class="table table-bordered table-striped" style="font-size:12px;">
        <thead>
                <tr>
                  <th>Quiz List</th>
                 
                </tr>
                </thead>
                <tbody>
<?php 
$sql = $dbcon->query("SELECT * FROM quiz_content WHERE user_id = '".$_SESSION['idno']."'") or die(mysqli_error());
while($value = $sql->fetch_object()):
?>
        <td>
          <strong>Name: <?php echo $value->quiz_title?></strong>
          <br>Time: <?php echo $value->quiz_date?>
          <br>Activity Type: <?php if($value->quiz_type == '0'): echo 'Fill in the blanks'; elseif($value->quiz_type == '1'): echo 'Multiple Choice';else: echo 'True or False';endif;?>
          <br>
          Minutes: <?php echo $value->timer?> Minute/s 
          <hr>

           <?php if($value->quiz_status == '0'):?>
                <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want activate this Quiz?\') 
      ?window.location = \'quiz-list.php?activate='.$value->quiz_id.'\' : \'\';"'; ?> class="btn btn-danger form-control"><span class="glyphicon glyphicon-file"></span> <?php if($value->quiz_status == '0'): echo 'Deactivated'; else: echo 'Activated';endif;?></a>
    <?php else:?>
    <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want deactivate this Quiz?\') 
      ?window.location = \'quiz-list.php?deactivate='.$value->quiz_id.'\' : \'\';"'; ?> class="btn btn-danger form-control"><span class="glyphicon glyphicon-file"></span> <?php if($value->quiz_status == '0'): echo 'Deactivated'; else: echo 'Activated';endif;?></a>
  <?php endif;?>
  <hr>
  <a href="edit-quiz.php?edit=<?php echo $value->quiz_id?>" class="btn btn-info form-control"><span class="glyphicon glyphicon-edit"></span>Edit</a>
    <a href="quiz-list.php?quiz_id=<?php echo $value->quiz_id?>" class="btn btn-danger form-control"><span class="glyphicon glyphicon-remove"></span> Remove</a>
<hr>
 <a href="add-question.php?quiz_id=<?php echo $value->quiz_id?>" class="btn btn-primary form-control"><span class="glyphicon glyphicon-plus"></span> Add</a>
        </td>
        
       
            </tr>
        <?php endwhile;?>
        </table>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>