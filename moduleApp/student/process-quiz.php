<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_student']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
  $id = filter($_SESSION['user_id']);
  $query = "SELECT * FROM user_account WHERE user_account.user_id = '$id'";
  $row = single_inner_join($query);

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
        <li><i class="fa fa-book"></i> Quiz List</li>
        
      </ol>
    </section>  


    <!-- Main content -->
    <section class="content container-fluid" >

<h3 class="box-title"><i class="fa fa-list"></i> Result</h3>
              <hr>
<?php
if( isset( $_POST['process_exam'] ))
{
  unset( $_SESSION['timers'][$_POST['quiz_id']] );
  
  $answers = $_POST['answers'];
  $quiz_id = filter($_POST['quiz_id']);
  $score = 0;
   $h = $dbcon->query("SELECT COUNT(*) as total FROM fill_blank WHERE quiz_id  = '".filter($_POST['quiz_id'])."'") or die(mysqli_error());
   $r = $h->fetch_assoc();

  foreach( $answers as $key => $answer ) 
  {
    $f = $dbcon->query("SELECT * FROM fill_blank WHERE quiz_id = '$quiz_id'") or die(mysqli_error());
    while($row = $f->fetch_assoc())
    {
    // check user answer compared to correct answer using key
    // if(empty($answer))
    // {
    //   $msg = '<div class="alert alert-danger"><h1>Please answer questions</h1></div>';
    // }
    if($row['answer_type'] == '0'){
      if(strtoupper($answer) === strtoupper($row['question_answer'])) 
      {
        $score = $score + 1;
        
      }
    }
    else{
      if($answer === $row['question_answer'])
      {
        $score = $score + 1;
        
      }
    }
    

    }
  }
  $kweri = $dbcon->query("SELECT * FROM exam_result WHERE quiz_id = '$quiz_id' AND exam_user = '".filter($_SESSION['user_id'])."'") or die(mysqli_error());
$count = mysqli_num_rows($kweri);
if($count == 1){
  echo '<div class="alert alert-danger">You have already taken the exam.</div>';
}
else
{
   $date = date("Y-m-d h:i a");
   $g = array("quiz_id"=>$quiz_id, "exam_user"=>filter($_SESSION['user_id']), "exam_score"=>$score, "exam_date"=>$date);
   $insert = insertdata("exam_result",$g);
?>
<?php if(isset($msg)): echo $msg; else:?>
<div class="alert alert-success"><h4>Thank you! <?php echo filter($_SESSION['fname'])?> for taking the quiz. Your score will be saved into our database.</h4></div>
<div class="alert alert-success"><h4>Your score is <?php echo $score;?> out of <?php echo $r['total'];?></h4></div>
<?php endif;?>
<?php
}
}
?>
</div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>