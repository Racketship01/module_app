<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  $quiz_id = filter($_GET['quiz_id']);
  $query = "SELECT * FROM quiz_content WHERE quiz_id='$quiz_id'";
  $row = single_inner($query);
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
      <h3 class="box-title"><i class="fa fa-pencil"></i> Update Question</h3>
              <hr>
              <div class="row">
                <div class="col-md-12">
<?php 
    if(isset($_GET['m_id']) && isset($_GET['quiz_type']) == 'multiple')
    {
      $r = single_get("*","m_id","multiple_choice",filter($_GET['m_id']));
      if(isset($_POST['multiple_button']))
      {
          $m_question = filter($_POST['m_question']);
          $correct_answer = strtoupper(filter($_POST['correct_answer']));
          $answer_a = strtoupper(filter($_POST['answer_a']));
          $answer_b = strtoupper(filter($_POST['answer_b']));
          $answer_c = strtoupper(filter($_POST['answer_c']));
          $answer_d = strtoupper(filter($_POST['answer_d']));
          $answer_e = strtoupper(filter($_POST['answer_e']));
          $ans_desc_a = filter($_POST['ans_desc_a']);
          $ans_desc_b = filter($_POST['ans_desc_b']);
          $ans_desc_c = filter($_POST['ans_desc_c']);
          $ans_desc_d = filter($_POST['ans_desc_d']);
          $ans_desc_e = filter($_POST['ans_desc_e']);
          $quiz_id = filter($_GET['quiz_id']);
          $question_link = filter($_POST['question_link']);
          $allowedExts = array("jpeg", "gif", "png");
          $temp = explode(".", $_FILES["photo"]["name"]);
          $photo =$_FILES['photo'] ["name"];
          $extension = end($temp);

          if(has_null($m_question,$correct_answer))
          {
            echo '<div class="alert alert-danger">Please fill up all the fields.</div>';
          }
          else
          {
            if($photo == "")
            {
              $arr_where = array("m_id"=>filter($_GET['m_id']));//update where
              $arr_set = array("m_question"=>$m_question,"correct_answer"=>$correct_answer,"answer_a"=>$answer_a,"answer_b"=>$answer_b,
                "answer_c"=>$answer_c, "answer_d"=>$answer_d,"answer_e"=>$answer_e,"ans_desc_a"=>$ans_desc_a,"ans_desc_b"=>$ans_desc_b,
                "ans_desc_c"=>$ans_desc_c,"ans_desc_d"=>$ans_desc_d,"ans_desc_e"=>$ans_desc_e,"question_link"=>$question_link);
              $tbl_name = "multiple_choice";

              $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
             header("location: add-question.php?quiz_id=".$_GET['quiz_id']."");
            }
            else
            {
              $arr_where = array("question_id"=>filter($_GET['question_id']));//update where
              $arr_set = array("m_question"=>$m_question,"correct_answer"=>$correct_answer,"answer_a"=>$answer_a,"answer_b"=>$answer_b,
                "answer_c"=>$answer_c, "answer_d"=>$answer_d,"answer_e"=>$answer_e,"ans_desc_a"=>$ans_desc_a,"ans_desc_b"=>$ans_desc_b,
                "ans_desc_c"=>$ans_desc_c,"ans_desc_d"=>$ans_desc_d,"ans_desc_e"=>$ans_desc_e,"question_link"=>$question_link,"photo"=>$photo);
              $tbl_name = "multiple_choice";
              move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
              $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
              header("location: add-question.php?quiz_id=".$_GET['quiz_id']."");
            }
          }
      }
    ?>
    <form method="post" enctype="multipart/form-data">
        <table class="table table-striped">
          <tr>
            <td>Question</td>
            <td><input type="text" name="m_question" class="form-control" value="<?php echo $r['m_question']?>"></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="text" name="answer_a" style="width:10%;" value="<?php echo $r['answer_a']?>">
              <input type="text" name="ans_desc_a" value="<?php echo $r['ans_desc_a']?>"></td>
          </tr>
            <tr>
            <td></td>
            <td>
              <input type="text" name="answer_b"  style="width:10%;" value="<?php echo $r['answer_b']?>">
              <input type="text" name="ans_desc_b" value="<?php echo $r['ans_desc_b']?>"></td>
          </tr>
            <tr>
            <td></td>
            <td>
              <input type="text" name="answer_c" style="width:10%;" value="<?php echo $r['answer_c']?>">
              <input type="text" name="ans_desc_c" value="<?php echo $r['ans_desc_c']?>"></td>
          </tr>
            <tr>
            <td></td>
            <td>
              <input type="text" name="answer_d" style="width:10%;" value="<?php echo $r['answer_d']?>">
              <input type="text" name="ans_desc_d" value="<?php echo $r['ans_desc_d']?>"></td>
          </tr>
          </tr>
            
           <tr>
            <td></td>
            <td>
              <input type="text" name="answer_e" style="width:10%;" value="<?php echo $r['answer_e']?>">
              <input type="text" name="ans_desc_e" value="<?php echo $r['ans_desc_e']?>"></td>
          </tr>
           </tr>
             <tr>
            <td>Image:</td>
            <td><input type="file" name="photo"></td>
          </tr>
           <tr>
            <td>Link:</td>
            <td><input type="text" name="question_link" class="form-control" value="<?php echo $r['question_link']?>"></td>
          </tr>

            <tr>
            <td>Correct Answer:</td>
            <td>
              
              <input type="text" name="correct_answer" class="form-control" value="<?php echo $r['correct_answer']?>"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="multiple_button" class="btn btn-success" value="Update question"></td>
          </tr>
        </table>
      </form>
    <?php
    }
    if(isset($_GET['t_id']) && isset($_GET['quiz_type']) == 'true_false')
    {
      $r = single_get("*","t_id","true_false",filter($_GET['t_id']));
      if(isset($_POST['true_button']))
      {
          $m_question = filter($_POST['m_question']);
          $correct_answer = strtoupper(filter($_POST['correct_answer']));
          $quiz_id = filter($_GET['quiz_id']);
          $question_link = filter($_POST['question_link']);
          $allowedExts = array("jpeg", "gif", "png");
          $temp = explode(".", $_FILES["photo"]["name"]);
          $photo =$_FILES['photo'] ["name"];
          $extension = end($temp);

          if(has_null($m_question,$correct_answer))
          {
            echo '<div class="alert alert-danger">Please fill up all the fields.</div>';
          }
          else
          {
            if($photo == "")
            {
              $arr_where = array("t_id"=>filter($_GET['t_id']));//update where
              $arr_set = array("m_question"=>$m_question,"correct_answer"=>$correct_answer, "question_link"=>$question_link);
              $tbl_name = "true_false";

              $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
              header("location: add-question.php?quiz_id=".$_GET['quiz_id']."");
              //echo '<div class="alert alert-success">Data was successfully saved.</div>';
              //header("location: index.php");
            }
            else
            {
              $arr_where = array("question_id"=>filter($_GET['question_id']));//update where
              $arr_set = array("m_question"=>$m_question,"correct_answer"=>$correct_answer,"question_link"=>$question_link,"photo"=>$photo);
              $tbl_name = "true_false";
              move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
              $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
              //echo '<div class="alert alert-success">Data was successfully saved.</div>';
              header("location: add-question.php?quiz_id=".$_GET['quiz_id']."");
            }
          }
      }
    ?>
    <form method="post" enctype="multipart/form-data">
        <table class="table table-striped">
          <tr>
            <td>Question</td>
            <td><input type="text" name="m_question" class="form-control" value="<?php echo $r['m_question']?>"></td>
          </tr>
          
           </tr>
             <tr>
            <td>Image:</td>
            <td><input type="file" name="photo"></td>
          </tr>
           <tr>
            <td>Link:</td>
            <td><input type="text" name="question_link" class="form-control" value="<?php echo $r['question_link']?>"></td>
          </tr>

            <tr>
            <td>Correct Answer:</td>
            <td>
              <select name="correct_answer" class="form-control">
                <option value="TRUE" <?php 
                if($r['correct_answer'] == "TRUE"){
                  echo 'selected';
                }
              
              elseif(isset($_POST['true_button'])){
                  echo $_POST['correct_answer'];
                }
                ?>>True</option>
                <option value="FALSE" <?php 
                if($r['correct_answer'] == "FALSE"){
                  echo 'selected';
                }
              
              elseif(isset($_POST['true_button'])){
                  echo $_POST['correct_answer'];
                }
                ?>>False</option>
              </select>
          </td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="true_button" class="btn btn-success" value="Update question"></td>
          </tr>
        </table>
      </form>
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