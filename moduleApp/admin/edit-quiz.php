<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  $k = single_get("*","quiz_id","quiz_content",$_GET['edit']);
  if(isset($_POST['edit_button']))
  {
    $quiz_title = filter($_POST['quiz_title']);
    $timer = filter($_POST['timer']);
    $view = filter($_POST['view']);
    $quiz_id = filter($_GET['edit']);
    if(has_null($quiz_title,$timer))
    {
      $msg = '<div class="alert alert-danger">Please fill up the fields.</div>';
    }
    else
    {
      $arr_where = array("quiz_id"=>$quiz_id);//update where
      $arr_set = array("quiz_title"=>$quiz_title,"timer"=>$timer,"view"=>$view);
      $tbl_name = "quiz_content";
      $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
      header("location: quiz-list.php");
    }
  }
  if(isset($_GET['result_id'])){
    global $dbcon;
    $result_id = filter($_GET['result_id']);
    $quiz_id = filter($_GET['quiz_id']);
    $del = $dbcon->query("DELETE FROM exam_result WHERE result_id= '$result_id'") or die(mysqli_error());

    if($del){
      header("location: edit-quiz.php?edit=$quiz_id");
    }
    
  }
  $r = single_get("*","quiz_id","quiz_content",filter($_GET['edit']));
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
   <h3 class="box-title"><i class="fa fa-pencil"></i> Update Quiz</h3>
              <hr>
              <div class="row">
                <div class="col-md-12">
<?php if(isset($msg)): echo $msg; endif;?>
     <form method="post">

     <table class="table table-striped">
      <tr>
        <td>Quiz Title:</td>
        <td><input type="text" name="quiz_title" class="form-control" value="<?php echo $k['quiz_title']?>"></td>
      </tr>
      <tr>
        <td>Timer:</td>
        <td><input type="text" name="timer" class="form-control"  value="<?php echo $k['timer']?>"></td>
      </tr>
      <tr>
          <td>Allow to view:</td>
          <td>
            <select name="view" class="form-control">
              <option value="0" <?php if(isset($_GET['edit'])){if($r['view'] == '0'){echo 'selected';}}?>>Yes</option>
              <option value="1" <?php if(isset($_GET['edit'])){if($r['view'] == '1'){echo 'selected';}}?>>No</option>
            </select>
          </td> 
        </tr>
      <tr>
        <td></td>
        <td>
            <input type="submit" name="edit_button" class="btn btn-success" value="Edit">
            <a href="quiz-list.php" class="btn btn-danger">Return</a>
        </td>
      </tr>
     </table>
     </form>
     <hr>
     <h3>Student List who took Exam</h3><hr>
     <?php
     $quiz_id = filter($_GET['edit']);
     $query = "SELECT quiz_content.quiz_id as ID, fname,lname,result_id,exam_score FROM exam_result INNER JOIN quiz_content on quiz_content.quiz_id = exam_result.quiz_id
     INNER JOIN user_account on user_account.user_id = exam_result.exam_user WHERE quiz_content.quiz_id = '$quiz_id'";
     $rp = getdata_inner_join($query);
     ?>
     <?php 
     if(!empty($rp)){
     ?>
     <table class="table table-striped">
      <tr>
        <td>User</td>
        <td>Score</td>
        <td>Option</td>
      </tr>
     <?php foreach ($rp as $key => $value) {?>
         <tr>
        <td><?php echo $value->fname?> <?php echo $value->lname?></td>
        <td><?php echo $value->exam_score?></td>
        <td>
          <a href="#" <?php echo 'onclick=" confirm(\'Do you want this student to retake the quiz?\') 
      ?window.location = \'edit-quiz.php?result_id='.$value->result_id.'&quiz_id='.$value->ID.'\' : \'\';"'; ?> class="btn btn-danger">Retake Exam</a>
        </td>
      </tr>
     <?php }
   
     echo '</table>';
     }else{?>
     <div class="alert alert-danger">There are no records on the database.</div>
     <?php
     }
     ?>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>