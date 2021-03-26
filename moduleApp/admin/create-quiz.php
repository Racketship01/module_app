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
  $sem = filter($_POST['sem']);
  $strand = filter($_POST['strand']);
  $year_lvl = filter($_POST['year_lvl']);

    if(has_null($quiz_title,$quiz_date,$quiz_type))
    {
      $msg = 'Please fill up all the fields.';
    }
    else
    {

      $f = single_get("*","sub_code","subject",$_POST['sub_code']);


      $insert_query = array(
        "view"         =>$_POST['view'],
        "timer"        =>$timer, 
        "quiz_title"   =>$quiz_title,
        "quiz_date"    =>$quiz_date, 
        "quiz_type"    =>$quiz_type,
        "user_id"      =>$_SESSION['idno'],
        "sub_code"     => $_POST['sub_code']
      );
      $success = insertdata("quiz_content",$insert_query);

      if($success)
      {
        header("location: quiz-list.php");
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
   <h3 class="box-title"><i class="fa fa-file"></i> Create Activity</h3>
              <hr>
              <div class="row">
                <div class="col-md-12">
 <?php if(isset($msg)):?> <div class="alert alert-danger"><?php echo $msg; ?></div> <?php endif;?>
 <form method="post">
      <table class="table table-striped">
        <tr>
          <td>Quiz/Exam Title:</td>
          <td><input type="text" name="quiz_title" class="form-control"></td>
        </tr>
        
        <tr>
          <td>
            Subject Handle 
          </td>
          <td>
            <select name="sub_code" class="form-control">
              <?php 
              $sql = $dbcon->query("SELECT * FROM documents") or die(mysqli_error());
              while ($row = $sql->fetch_assoc()) {
             
              ?>
              <option value="<?php echo $row['docu_id']?>">
                Title: <?php echo $row['docu_title']?> 
              </option>
              <?php 
              }
              ?>
            </select>
            
          </td>
        </tr>

          </td>
          
        </tr>
       
        <tr>
          <td>Date Created:</td>
          <td><input type="text" name="quiz_date" class="form-control" value="<?php echo date("Y-m-d");?>"></td>
        </tr>
         <tr>
          <td>Timer:</td>
          <td><input type="text" name="timer" class="form-control"></td>
        </tr>
        <tr>
          <td>Quiz/Exam type:</td>
          <td>
            <select name="quiz_type" class="form-control">
                <!--
                <option value="0">Fill in the blanks</option>
                -->
              <option value="1">Multiple Choice</option>
              <option value="2">True or False</option>
            </select>
          </td> 
        </tr>
         <tr>
          <td>Allow to view:</td>
          <td>
            <select name="view" class="form-control">
              <option value="0">Yes</option>
              <option value="1">No</option>
            </select>
          </td> 
        </tr>
        <tr>
          <td></td>
          <td> <input type="submit" name="type_button" class="btn btn-info" value="Save">
          <a href="index.php" class="btn btn-danger">Return</a>
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