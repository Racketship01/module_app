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
   <h3 class="box-title"><i class="fa fa-plus"></i> Add Question</h3>
              <hr>
              <div class="row">
                <div class="col-md-12">
<?php if(isset($msg)): echo $msg; endif;?>
<?php 
      if($row['quiz_type'] == '0')
      {
        if(isset($_POST['add_button']))
        {
          $question_title = filter($_POST['question_title']);
          
          $question_link = filter($_POST['question_link']);
          $allowedExts = array("jpeg", "gif", "png");
          $temp = explode(".", $_FILES["photo"]["name"]);
          $photo =$_FILES['photo'] ["name"];
          $extension = end($temp);

          if(has_null($question_title))
          {
            echo '<div class="alert alert-danger">Please fill up all the fields.</div>';
          }
          else
          {
           
               $question_answer = filter($_POST['question_answer']);
              $insert_query = array("photo"=>$photo,"question_link"=>$question_link,"question_title"=>$question_title,"question_answer"=>$question_answer, "quiz_id"=>filter($_GET['quiz_id']));
            move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
            $success = insertdata("fill_blank",$insert_query);
            
            

            if($success)
            {
              echo '<div class="alert alert-success">Successfully added.</div>';
            }
          }
        }
      ?>
      <form method="post" enctype="multipart/form-data">
        <table class="table table-striped">
          <tr>
            <td>Question</td>
            <td><input type="text" name="question_title" class="form-control"></td>
          </tr>
          <tr>
            <td>Answer</td>
            <td><input type="text" name="question_answer" class="form-control"></td>
          </tr>
          <tr>
            <td>Image:</td>
            <td><input type="file" name="photo"></td>
          </tr>
           <tr>
            <td>Link:</td>
            <td><input type="text" name="question_link" class="form-control"></td>
          </tr>
           <tr>
            <td>Answer Type:</td>
            <td>
              <select class="form-control" name="answer_type">
                <option value="0" >Not Case Sensitive</option>
                <option value="1">Case Sensitive</option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" name="add_button" class="btn btn-success" value="Add">
              <a href="quiz-list.php" class="btn btn-danger">Back</a>
            </td>
          </tr>
        </table>
      </form>
      <?php
      }
      elseif($row['quiz_type'] == '1')
      {
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


          if($m_question == "")
          {
            echo '<div class="alert alert-danger">Please Enter questions.</div>';
          }
          else
          {
            $insert_query = array("photo"=>$photo,"question_link"=>$question_link,"quiz_id"=>$quiz_id, "m_question"=>$m_question,"correct_answer"=>$correct_answer,"answer_a"=>$answer_a,"answer_b"=>$answer_b,
              "answer_c"=>$answer_c,"answer_d"=>$answer_d,"answer_e"=>$answer_e,"ans_desc_a"=>$ans_desc_a,"ans_desc_b"=>$ans_desc_b,"ans_desc_c"=>$ans_desc_c,
              "ans_desc_d"=>$ans_desc_d,"ans_desc_e"=>$ans_desc_e);
            move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
            $success = insertdata("multiple_choice",$insert_query);

            if($success)
            {
              echo '<div class="alert alert-success">Successfully added.</div>';
            }
          }
      }
      ?>
        <form method="post" enctype="multipart/form-data">
        <table class="table table-striped">
          <tr>
            <td>Question</td>
            <td><input type="text" name="m_question" class="form-control"></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="text" name="answer_a" style="width:10%;" value="A" readonly>
              <input type="text" name="ans_desc_a"></td>
          </tr>
            <tr>
            <td></td>
            <td>
              <input type="text" name="answer_b"  style="width:10%;" value="B" readonly>
              <input type="text" name="ans_desc_b" ></td>
          </tr>
            <tr>
            <td></td>
            <td>
              <input type="text" name="answer_c" style="width:10%;" value="C" readonly>
              <input type="text" name="ans_desc_c"></td>
          </tr>
            <tr>
            <td></td>
            <td>
              <input type="text" name="answer_d" style="width:10%;" value="D" readonly>
              <input type="text" name="ans_desc_d" ></td>
          </tr>
          </tr>
            
           <tr>
            <td></td>
            <td>
              <input type="text" name="answer_e" style="width:10%;" value="E" readonly>
              <input type="text" name="ans_desc_e" ></td>
          </tr>
           </tr>
             <tr>
            <td>Image:</td>
            <td><input type="file" name="photo"></td>
          </tr>
           <tr>
            <td>Link:</td>
            <td><input type="text" name="question_link" class="form-control"></td>
          </tr>
            <tr>
            <td>Correct Answer:</td>
            <td>
              <select name="correct_answer" class="form-control">
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
                <option>E</option>
              </select>  
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" name="multiple_button" class="btn btn-success" value="Add">
              <a href="quiz-list.php" class="btn btn-danger">Back</a>
            </td>
          </tr>
        </table>
      </form>
      <?php
      }elseif($row['quiz_type'] == '2'){
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

          if($m_question == "")
          {
            echo '<div class="alert alert-danger">Please Enter questions.</div>';
          }
          else
          {
            $insert_query = array("photo"=>$photo,"question_link"=>$question_link,"quiz_id"=>$quiz_id, "m_question"=>$m_question,"correct_answer"=>$correct_answer);
            move_uploaded_file($_FILES["photo"]["tmp_name"],"../img/". $_FILES["photo"]["name"]);
            $success = insertdata("true_false",$insert_query);

            if($success)
            {
              echo '<div class="alert alert-success">Successfully added.</div>';
            }
          }
      }
      ?>
      <form method="post" enctype="multipart/form-data">
        <table class="table table-striped">
          <tr>
            <td>Question</td>
            <td><input type="text" name="m_question" class="form-control"></td>
          </tr>
            <td>Image:</td>
            <td><input type="file" name="photo"></td>
          </tr>
           <tr>
            <td>Link:</td>
            <td><input type="text" name="question_link" class="form-control"></td>
          </tr>
            <tr>
            <td>Correct Answer:</td>
            <td>
              <select name="correct_answer" class="form-control">
                <option>True</option>
                <option>False</option>
              </select>  
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" name="true_button" class="btn btn-success" value="Add">
               <a href="quiz-list.php" class="btn btn-danger">Back</a>
            </td>
          </tr>
        </table>
      </form>
      <?php 
      }
      ?>
        </div>
        <div class="col-md-12">
          <h4>Question List:</h4>
          <hr>
          <?php if($row['quiz_type'] == '0'):?>
          <?php 
          $g = getdata_where("*","quiz_id","fill_blank",filter($_GET['quiz_id']));
          if(isset($_GET['del1']))
          {
            /*
            global $dbcon;
            $question_id = filter($_GET['question_id']);
            $quiz_id = filter($_GET['quiz_id']);
            $tbl_name = "fill_blank";
            $ar = array("question_id"=>$question_id);
            $del = delete($dbcon,$tbl_name,$ar);
            if($del)
            {
               echo 'Success <META HTTP-EQUIV="refresh" CONTENT="0; URL=add-question.php?quiz_id='.$quiz_id.'&quiz_module='.$quiz_module.'">';
            }
            */
            $question_id = filter($_GET['question_id']);
            $quiz_id = filter($_GET['quiz_id']);
            $del = $dbcon->query("DELETE FROM fill_blank WHERE question_id = '$question_id'") or die(mysqli_error());
            if($del)
            {
              echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL=add-question.php?quiz_id='.$quiz_id.'">';
            }
          }
          ?>
          <?php if(!empty($g)):?>
         <table id="example2" class="table table-bordered table-striped" style="font-size:12px;">
          <thead>
            <tr>
              <th>#</th>
              <th>Photo</th>
             
              
            </tr>
          </thead>
          <tbody>
          <?php 
          foreach ($g as $key => $result):
              $h = $key + 1;
          ?>
            <tr>
                <td><?php echo $h;?>.</td>
              <td>
                 
                <?php if($result->photo != ""):?>
          <img src="../img/<?php echo $result->photo?>" width="250" class="thumbnail">
        <?php endif;?>
        <p></p>
        <?php echo $result->question_title?><br>
                <?php if($result->question_link != ""):?>
          <?php echo $result->question_link?>
        <?php endif;?>
        <strong>Answer:</strong> <?php echo $result->question_answer?>
        <p></p>
          <a href="edit-question.php?quiz_id=<?php echo $_GET['quiz_id']?>&question_id=<?php echo $result->question_id?>&quiz_type=fill" class="btn btn-info form-control">Edit</a>
          <br><br>
           <a href="add-question.php?del1=true&question_id=<?php echo $result->question_id?>&quiz_id=<?php echo $_GET['quiz_id']?>" class="btn btn-danger form-control">Delete</a>
              </td>
             
            </tr>

          <?php endforeach;?>
          </table>
          <?php else:?>
            <div class="alert alert-danger">There are no records on the database.</div>
          <?php endif;?>

          <?php elseif($row['quiz_type'] == '1'):?>
          <?php 
          $h = getdata_where("*","quiz_id","multiple_choice",filter($_GET['quiz_id']));
          if(isset($_GET['del']))
          {
           $m_id = filter($_GET['m_id']);
            $quiz_id = filter($_GET['quiz_id']);
            $del = $dbcon->query("DELETE FROM multiple_choice WHERE m_id = '$m_id' AND quiz_id='$quiz_id'") or die(mysqli_error());
            if($del)
            {
              //header("location: add-question.php?quiz_id=$quiz_id&m_id=$m_id");
              echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL=add-question.php?quiz_id='.$quiz_id.'&m_id='.$m_id.'">';
            }
          }
          ?>
          <?php if(!empty($h)):?>
          
          <?php 
          foreach ($h as $key => $yt):
              $h = $key + 1;
          ?>
          <h4><?php echo $h;?>. <?php echo $yt->m_question?></h4>
          <div class="row">
            <div class="col-md-12">
             <div style="line-height:25px;font-size:16px;">
              <?php if(!empty($yt->ans_desc_a)):?><?php echo $yt->answer_a?>. <?php echo $yt->ans_desc_a?><br><?php else:?><?php endif;?>
              <?php if(!empty($yt->ans_desc_b)):?><?php echo $yt->answer_b?>. <?php echo $yt->ans_desc_b?><br><?php else:?><?php endif;?>
              <?php if(!empty($yt->ans_desc_c)):?><?php echo $yt->answer_c?>. <?php echo $yt->ans_desc_c?><br><?php else:?><?php endif;?>
              <?php if(!empty($yt->ans_desc_d)):?><?php echo $yt->answer_d?>. <?php echo $yt->ans_desc_d?><br><?php else:?><?php endif;?>
              <?php if(!empty($yt->ans_desc_e)):?><?php echo $yt->answer_e?>. <?php echo $yt->ans_desc_e?><br><?php else:?><?php endif;?>

              <strong>Correct Answer: <?php echo $yt->correct_answer?></strong><br>  <a href="edit-question.php?quiz_id=<?php echo $_GET['quiz_id']?>&m_id=<?php echo $yt->m_id?>&quiz_type=multiple" class="btn btn-primary">Edit</a>
                <a href="add-question.php?m_id=<?php echo $yt->m_id?>&quiz_id=<?php echo $_GET['quiz_id']?>&del=true" class="btn btn-danger">Delete</a>
                <br>
            </div>

            </div>
            <div class="col-md-7">
               <?php if($yt->photo != ""):?>
          <img src="../img/<?php echo $yt->photo?>" width="300" class="thumbnail">
        <?php endif;?>
        <?php if($yt->question_link != ""):?>
          <?php echo $yt->question_link?>
        <?php endif;?>



             
            </div>
          </div>
          
          <hr>
        
          
          <?php endforeach;?>

          </table>
          <?php endif;?>
           <?php elseif($row['quiz_type'] == '2'):?>
          <?php 
          $h = getdata_where("*","quiz_id","true_false",filter($_GET['quiz_id']));
          if(isset($_GET['del']))
          {
           $m_id = filter($_GET['t_id']);
            $quiz_id = filter($_GET['quiz_id']);
            $del = $dbcon->query("DELETE FROM true_false WHERE t_id = '$m_id' AND quiz_id='$quiz_id'") or die(mysqli_error());
            if($del)
            {
              //header("location: add-question.php?quiz_id=$quiz_id&m_id=$m_id");
              echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL=add-question.php?quiz_id='.$quiz_id.'&m_id='.$m_id.'">';
            }
          }
          ?>
          <?php if(!empty($h)):?>
          
          <?php 
          foreach ($h as $key => $yt):
              $h = $key + 1;
          ?>
          <h4><?php echo $h;?>. <?php echo $yt->m_question?></h4>
          <div class="row">
            <div class="col-md-12">
             <div style="line-height:25px;font-size:16px;">
              

              <strong>Correct Answer: <?php echo $yt->correct_answer?></strong>
              <br><a href="edit-question.php?quiz_id=<?php echo $_GET['quiz_id']?>&t_id=<?php echo $yt->t_id?>&quiz_type=true_false" class="btn btn-primary">Edit</a>
                <a href="add-question.php?t_id=<?php echo $yt->t_id?>&quiz_id=<?php echo $_GET['quiz_id']?>&del=true" class="btn btn-danger">Delete</a>
                <br>
            </div>

            </div>
            <div class="col-md-7">
               <?php if($yt->photo != ""):?>
          <img src="../img/<?php echo $yt->photo?>" width="300" class="thumbnail">
        <?php endif;?>
        <?php if($yt->question_link != ""):?>
          <?php echo $yt->question_link?>
        <?php endif;?>



             
            </div>
          </div>
          
          <hr>
        
          
          <?php endforeach;?>

          </table>
          <?php endif;?>
        <?php endif;?>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>