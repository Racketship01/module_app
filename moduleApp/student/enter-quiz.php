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
  
    $name = single_get("*","quiz_id","quiz_content",$_GET['quiz_id']);

  if( isset( $_GET['timer'] ) ) {
    $_SESSION['timers'][$_GET['quiz_id']] = $_GET['timer'];
    die();
  }

  function hoursToMinutes( $time ) {
    $time = substr( $time, 0, -3 );
    if( strstr( $time, ':' ) ) {

      $separatedData = explode(':', $time);
      $minutesInHours    = $separatedData[0] * 60;
      $minutesInDecimals = $separatedData[1];
      $totalMinutes = $minutesInHours + $minutesInDecimals;
    }else {
      $totalMinutes = $time * 60;
    }

    return $totalMinutes;
  }

  // set timer
  $timer = ( !isset( $_SESSION['timers'][$_GET['quiz_id']] ) ) ? $name['timer'] : hoursToMinutes( $_SESSION['timers'][$_GET['quiz_id']] );
  $timer_hours = floor( $timer / 60 );
  $timer_minutes = ( $timer % 60 );
  $timer_seconds = isset( $_SESSION['timers'][$_GET['quiz_id']] ) ? substr( $_SESSION['timers'][$_GET['quiz_id']], -2 ) : 0;

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

      <?php 
$quiz_id = filter($_GET['quiz_id']);
  $kweri = $dbcon->query("SELECT * FROM exam_result WHERE exam_user = '".$_SESSION['user_id']."' AND quiz_id='$quiz_id'") or die(mysqli_error());
  $count = mysqli_num_rows($kweri);
  $row = $kweri->fetch_assoc();
  if($count == 1)
  {
    echo '<div class="alert alert-danger">You have already taken this quiz. Please select other quiz.</div>';

  ?>
  <div class="alert alert-info"><h3>Your score is <?php echo $row['exam_score']?></h3></div>
  <?php
  if(base64_decode($_GET['quiz_type'])== '2'){ 
     $quiz_id = filter($_GET['quiz_id']);
    $query = "SELECT * FROM true_false INNER JOIN quiz_content on quiz_content.quiz_id = true_false.quiz_id
    WHERE true_false.quiz_id = '$quiz_id'";
    $kweri = $dbcon->query($query) or die(mysqli_error());
    $k = $kweri->fetch_assoc();
    if($k['view'] == '1'){
      echo '';
  }
  else{
    $h = getdata_inner_join($query);
  ?>
  <?php if(!empty($h)){?>
          
          <?php 
          foreach ($h as $key => $yt){
              $h = $key + 1;
          ?>
          <h4><?php echo $h;?>. <?php echo $yt->m_question?></h4>
          <div class="row">
            <div class="col-md-5">
             <div style="line-height:25px;font-size:16px;">
              <strong>Correct Answer: <?php echo $yt->correct_answer?></strong>  
            </div>

            </div>
            <div class="col-md-7">
               <?php if($yt->photo != ""){?>
          <img src="../img/<?php echo $yt->photo?>" width="300" class="thumbnail">
        <?php }?>
        <?php if($yt->question_link != ""){?>
          <?php echo $yt->question_link?>
        <?php }?>
            </div>
          </div>
          
          <hr>
          <?php }?>

          </table>
          <?php }
        }?>
  <?php
  }
  elseif(base64_decode($_GET['quiz_type'])== '1')
  {
    $quiz_id = filter($_GET['quiz_id']);
    $query = "SELECT * FROM multiple_choice INNER JOIN quiz_content on quiz_content.quiz_id = multiple_choice.quiz_id
    WHERE multiple_choice.quiz_id = '$quiz_id'";
    $kweri = $dbcon->query($query) or die(mysqli_error());
    $k = $kweri->fetch_assoc();
    $g = mysqli_num_rows($kweri);
    if($k['view'] == '1'){
      echo '';
  }
  else{
    $h = getdata_inner_join($query);
  ?>
   <?php if(!empty($h)){?>
          
          <?php 

          foreach ($h as $key => $yt){
            $h = $key + 1;            
          ?>
          <h4><?php echo $h;?>. <?php echo $yt->m_question?></h4>
          <div class="row">
            <div class="col-md-5">
             <div style="line-height:25px;font-size:16px;">
              <strong>Correct Answer: <?php echo $yt->correct_answer?> </strong>
              
            </div>

            </div>
            <div class="col-md-7">
               <?php if($yt->photo != ""){?>
          <img src="../img/<?php echo $yt->photo?>" width="300" class="thumbnail">
        <?php }?>
        <?php if($yt->question_link != ""){?>
          <?php echo $yt->question_link?>
        <?php }?>
            </div>
          </div>
          
          <hr>
          <?php }

          ?>

          </table>

          <?php } 


        }?>
  <?php 
  }
  elseif(base64_decode($_GET['quiz_type']) == '0')
  {
     $quiz_id = filter($_GET['quiz_id']);
     $query = "SELECT * FROM fill_blank INNER JOIN quiz_content on quiz_content.quiz_id = fill_blank.quiz_id
    WHERE fill_blank.quiz_id = '$quiz_id'";
    $kweri = $dbcon->query($query) or die(mysqli_error());
    $re = $kweri->fetch_assoc();
    if($re['view'] == '1'){
      echo '';
    }
    else{
     $g = getdata_inner_join($query);
  ?>
   <?php if(!empty($g)):?>
          <?php 
          foreach ($g as $key => $result):
            $h = $key + 1;
          ?>
          <h4><?php echo $h;?>.  <?php echo $result->question_title?></h4>
          <?php if($result->photo != ""):?>
          <img src="../img/<?php echo $result->photo?>" width="250" class="thumbnail">
        <?php endif;?>
        <?php if($result->question_link != ""):?>
          <?php echo $result->question_link?>
        <?php endif;?>
          <p>Correct Answer: <?php echo $result->question_answer?> 
          <hr>
          
          <?php endforeach;?>
          </table>
          <?php else:?>
          <?php endif;?>
  <?php
}
  }
  ?>
<?php
  }
  else
  {
?>

      <h3>Quiz Name: <?php echo $name['quiz_title']?></h3><hr>
      <div class="row">
        <div class="col-md-12">

              <?php if( !$count ): ?>
              <h2 id="countdown" class="big"></h2>
              <?php
          endif; ?>
         
          
          <?php if($name['quiz_type'] == '0'){?><!-- Fill in the blanks form-->
      <?php $f = getdata_where("*","quiz_id","fill_blank",filter($_GET['quiz_id']));?>

      <form method="POST" action="process-quiz.php">

      <?php
      $h = $dbcon->query("SELECT COUNT(*) as total FROM fill_blank WHERE quiz_id  = '".filter($_GET['quiz_id'])."'") or die(mysqli_error());
      $r = $h->fetch_assoc();
      $g = $dbcon->query("SELECT * FROM fill_blank WHERE quiz_id = '".filter($_GET['quiz_id'])."' ORDER BY RAND() LIMIT ".$r['total']."") or die(mysqli_error());
      $count = 1;
      while($value = $g->fetch_array())
      {
      ?>
      <input type="hidden" name="quiz_id" value="<?php echo $_GET['quiz_id']?>">
      <?php echo $count++; ?>. <?php echo $value['question_title']?><br>
      <div class="row">
        <div class="col-md-6"><?php if($value['photo'] == ""): echo ""; else:?><img src="../img/<?php echo $value['photo']?>" width="50%"><?php endif;?></div>
        <div class="col-md-6"><?php echo $value['question_link']?></div>
      </div>
      <br>
        Your Answer: <input type="text" name="answers[<?php echo $value['question_id'] ?>]">
        <hr>
      <?php }?>
      <input type="submit" name="process_exam" class="btn btn-success" value="Submit Your Answer">
      </form>

      <?php 
      }
      elseif($name['quiz_type'] == '1')
      {
      ?><!-- Multiple Choice form--> 
      <form method="POST" action="process-multiple.php">
      <?php
      $h = $dbcon->query("SELECT COUNT(*) as total FROM multiple_choice WHERE quiz_id  = '".filter($_GET['quiz_id'])."' ") or die(mysqli_error());
      $r = $h->fetch_assoc();
      $kweri = $dbcon->query("SELECT * FROM multiple_choice WHERE quiz_id  = '".filter($_GET['quiz_id'])."' ORDER BY RAND() LIMIT ".$r['total']."") or die(mysqli_error());
      $count = 1;
      while($row = $kweri->fetch_array())
      {
      ?>
      <input type="hidden" name="quiz_id" value="<?php echo $_GET['quiz_id']?>">
      <input type="hidden" name="id[<?php echo $row['m_id'] ?>]" value="<?php echo $row['m_id'] ?>">
      <input type="hidden" name="qwerty[<?php echo $row['m_id'] ?>]" value="<?php echo sha1($row['correct_answer']) ?>">
      <?php echo $count++; ?>. <?php echo $row['m_question']?><br>
      <?php if(!empty($row['ans_desc_a'])):?><input type="radio" name="answers[<?php echo $row['m_id'] ?>]" value="A"/><?php echo $row['answer_a']?>. <?php echo $row['ans_desc_a']?><br><?php else:?><?php endif;?>
      <?php if(!empty($row['ans_desc_b'])):?><input type="radio" name="answers[<?php echo $row['m_id'] ?>]" value="B"/><?php echo $row['answer_b']?>. <?php echo $row['ans_desc_b']?><br><?php else:?><?php endif;?>
      <?php if(!empty($row['ans_desc_c'])):?><input type="radio" name="answers[<?php echo $row['m_id'] ?>]" value="C"/><?php echo $row['answer_c']?>. <?php echo $row['ans_desc_c']?><br><?php else:?><?php endif;?>
      <?php if(!empty($row['ans_desc_d'])):?><input type="radio" name="answers[<?php echo $row['m_id'] ?>]" value="D"/><?php echo $row['answer_d']?>. <?php echo $row['ans_desc_d']?><br><?php else:?><?php endif;?>
      <?php if(!empty($row['ans_desc_e'])):?><input type="radio" name="answers[<?php echo $row['m_id'] ?>]" value="E"/><?php echo $row['answer_e']?>. <?php echo $row['ans_desc_e']?><br><?php else:?><?php endif;?>
      
      <hr><?php
      }
      ?>
      <input type="submit" name="check_multiple" value="Submit" class="btn btn-success"/>
    </form>
      <?php 
    }elseif($name['quiz_type'] == '2'){
    ?>
    <form method="POST" action="process-true.php">
      <?php
      $h = $dbcon->query("SELECT COUNT(*) as total FROM true_false WHERE quiz_id  = '".filter($_GET['quiz_id'])."' ") or die(mysqli_error());
      $r = $h->fetch_assoc();
      $kweri = $dbcon->query("SELECT * FROM true_false WHERE quiz_id  = '".filter($_GET['quiz_id'])."' ORDER BY RAND() LIMIT ".$r['total']."") or die(mysqli_error());
      $count = 1;
      while($row = $kweri->fetch_array())
      {
      ?>
      <input type="hidden" name="quiz_id" value="<?php echo $_GET['quiz_id']?>">
      <input type="hidden" name="id[<?php echo $row['t_id'] ?>]" value="<?php echo $row['t_id'] ?>">
      <input type="hidden" name="qwerty[<?php echo $row['t_id'] ?>]" value="<?php echo sha1($row['correct_answer']) ?>">
      <?php echo $count++; ?>. <?php echo $row['m_question']?><br>
      
      <input type="radio" name="answers[<?php echo $row['t_id'] ?>]" value="TRUE"/>TRUE<br>
     <input type="radio" name="answers[<?php echo $row['t_id'] ?>]" value="FALSE"/>FALSE
      <hr><?php
      }
      ?>
      <input type="submit" name="check_true" value="Submit" class="btn btn-success"/>
    </form>
    <?php 
    }
  }
    ?>
        </div>
        <div class="col-md-3">
          
</div>
<script src="../js/jquery.min.js"></script>
  <?php
    if( isset( $_GET['quiz_type'] ) ): ?>
        <script src="../js/jquery.countdown.min.js"></script>
        <script>
            $(function(){
                if( <?php echo $timer_hours; ?> <= 0 && <?php echo $timer_minutes; ?> <= 0 && <?php echo $timer_seconds; ?> <= 0 ) {
                    $('#countdown').closest('body').find('form input[type="submit"]').click();
                }
                $("#countdown").countdowntimer({
                    hours: <?php echo $timer_hours; ?>,
                    minutes: <?php echo $timer_minutes; ?>,
                    seconds: <?php echo $timer_seconds; ?>,
                    size:'lg',
                    regexpMatchFormat:'([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})',
                        regexpReplaceWith:'$2 : $3 : $4',
                    timeUp: function() {
                        $(this).closest('body').find('form input[type="submit"]').click();
                    }
                });

                setInterval(function() {
                    var timeRemaining = $('#countdown').html();
                    $.ajax({
                        type: 'GET',
                        url: '<?php $_SERVER['PHP_SELF']; ?>',
                        data: {'timer':timeRemaining}
                    }, 'json');
                }, 1000);
            });
        </script>
    <?php
    endif; ?>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php //include'../assets/footer.php';?>
</body>
</html>