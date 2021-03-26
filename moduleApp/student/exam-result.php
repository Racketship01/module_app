<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
   $query = "SELECT * FROM exam_result INNER JOIN user_account on user_account.user_id = exam_result.exam_user
  INNER JOIN quiz_content on quiz_content.quiz_id = exam_result.quiz_id WHERE user_account.user_id = '".filter($_SESSION['user_id'])."'";
  $kweri = getdata_inner_join($query);

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
        <li><i class="fa fa-file"></i> Quiz Result</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >
<div class="table table-responsive">
  <?php if(!empty($kweri)):?>
      <table class="table table-striped">
        <tr>
          <td>Quiz Name</td>
          <td>Quiz Type</td>
          <td>Quiz Result</td>
          <td>Date Taken</td>
        </tr>
      <?php foreach ($kweri as $key => $value):?>
      <?php 
      if($value->quiz_type == '0')
      {
           $quiz_id = $value->quiz_id;
           $g = $dbcon->query("SELECT COUNT(*) as total FROM fill_blank WHERE quiz_id = '$quiz_id'") or die(mysqli_error());
           $f= $g->fetch_assoc();
      }
      elseif($value->quiz_type == '1')
      {
          $quiz_id = $value->quiz_id;
           $j = $dbcon->query("SELECT COUNT(*) as total FROM multiple_choice WHERE quiz_id = '$quiz_id'") or die(mysqli_error());
           $q= $j->fetch_assoc();
      }elseif($value->quiz_type == '2')
      {
          $quiz_id = $value->quiz_id;
           $r = $dbcon->query("SELECT COUNT(*) as total FROM true_false WHERE quiz_id = '$quiz_id'") or die(mysqli_error());
           $t= $r->fetch_assoc();
      }
   
      ?>
       <tr>
          <td><?php echo $value->quiz_title?></td>
          <td>
            <?php if($value->quiz_type == '0'):echo 'Fill in the blanks';elseif($value->quiz_type == '1'): echo 'Multiple Choice';elseif($value->quiz_type == '2'): echo 'True or False';endif;?>
          </td>
          <td>
            <?php 
            echo $value->exam_score?> /  <?php 
            if($value->quiz_type == '0'): 
              echo $f['total'];
              $p = $f['total'];
            elseif($value->quiz_type == '1'): 
              echo $q['total'];
              $p = $q['total'];
            elseif($value->quiz_type == '2'): 
              echo $t['total'];
              $p = $t['total'];
            endif;
            ?>
            -
            <?php 
            $percentage = ($value->exam_score / $p) * 100;

            if($percentage >= 50){
              echo '<span style=color:green;">Passed</span>';
            } elseif($percentage < 50){
              echo '<span style=color:red;">Failed</span>';
            }
            ?>
              
            </td>
          <td><?php echo $value->exam_date?></td>
        </tr>
    <?php endforeach;?>
      </table>
    <?php else:?>
    <div class="alert alert-danger">There are no records on the database.</div>
  <?php endif;?>
</div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>