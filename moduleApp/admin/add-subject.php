<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
$row = single_get("*","idno","user_account",filter($_SESSION['idno']));
  switch (true) {
    case isset($_POST['save_button']):
      
      $sub_code = filter($_POST['sub_code']);
      $sub_desc = strip_tags($_POST['sub_desc']);
      $sub_day = filter($_POST['sub_day']);
      $sub_sem = filter($_POST['sub_sem']);
      $sub_strand = filter($_POST['sub_strand']);
      $sub_yrlvl = filter($_POST['sub_yrlvl']);
      $sec_id = filter($_POST['sec_id']);
      $check_code = single_get("sub_code","sub_code","subject",$sub_code);
      if(has_null($sub_code,$sub_desc,$sub_day,$sub_sem))
      {
        $msg = '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Please fill up the fields.</div>';
      }
      else
      {
        if(isset($_GET['sub_code']))
        {
          $sub_time = filter($_POST['sub_time']);
          $sub_year = filter($_POST['sub_year']);
          $arr_where = array("sub_code"=>$_GET['sub_code']);
          $arr_set = array(
            "sub_code"      =>$sub_code,
            "sub_desc"      =>$sub_desc,
            "sub_day"       =>$sub_day,
            "sub_sem"       =>$sub_sem,
            
            "sub_year"      =>$sub_year,
            "sub_strand"    =>$sub_strand,
            "sub_yrlvl"     =>$sub_yrlvl
          );
          $tbl_name = "subject";

          $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
          header("location: view-subject.php");
        }
        else
        {
          
          $sub_time = filter($_POST['sub_time1']).' - '.filter($_POST['sub_time2']);
          $sub_year = filter($_POST['sub_year1']).' -  '.filter($_POST['sub_year2']);
          $arr = array(
            "sub_code"    =>$sub_code,
            "sub_desc"    =>$sub_desc,
            "sub_day"     =>$sub_day,
            "sub_sem"     =>$sub_sem,
            "sub_time"    =>$sub_time,
            "sub_year"    =>$sub_year,
            "sub_strand"  =>$sub_strand,
            "sub_yrlvl"   =>$sub_yrlvl,
            "sec_id"      =>$sec_id
          );
          $f = insertdata("subject",$arr);
          $f = array("log_desc"=>"Registrar Added Subject, Subject Code:".$sub_code.", Subject Description: ".$sub_desc."");
          insertdata("logs",$f);
          if($f)
          {
             header("location:view-subject.php");
          }
        }
        
      }
      
    break;
    case isset($_GET['sub_code']):
      //$code = single_get("*","sub_code","subject",filter($_GET['sub_code']));
      $kweri = $dbcon->query("SELECT * FROM subject 
        INNER JOIN sections on sections.sec_id = subject.sec_id WHERE sub_code = '".$_GET['sub_code']."'") or die(mysqli_error());
      $count = mysqli_num_rows($kweri);
      if($count == 0)
      {
        $error = 'error';
      }
      else
      {
        while($row = $kweri->fetch_assoc())
        {
          $code = $row['sub_code'];
          $desc = $row['sub_desc'];
          $time = $row['sub_time'];
          $day = $row['sub_day'];
          $sem = $row['sub_sem'];
          $year = $row['sub_year'];
          //$strand = $row['sub_strand'];
          $yrlvl = $row['sub_yrlvl'];
          $SectionName = $row['SectionName'];
        }
        //mysqli_close($dbcon);
      }

    break;
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
  <div class="content-wrapper" style="background:white;">

    <section class="content container-fluid">
      <h4><i class="fa fa-plus"></i> Subject Information <?php echo $_SESSION['idno']?></h4>
      <hr>
      <?php if(isset($msg)): echo $msg; endif;?>
    <form method="post" autocomplete="off">
    <div class="row">
      <div class="col-md-2">Subject Code:</div>
      <div class="col-md-4">
        <input type="text" name="sub_code" class="form-control" 
          value="<?php if(isset($_GET['sub_code'])): if($count != 0): echo $code; else: echo $error; endif; endif;?><?php if(isset($_POST['save_button'])): echo $_POST['sub_code']; endif;?>" placeholder="Subject Code">
      </div>
      <div class="col-md-2">Section / Course:</div>
      <div class="col-md-4">
        <?php if(isset($_GET['sub_code'])):?>
            <input type="text" readonly name="sec_id" value="<?php echo $SectionName?>" class="form-control">
          <?php else:?>
            
            <select name="sec_id" class="form-control">
              <?php 
              $list = getdata("*","sections");
              
              ?>
              <?php 
              foreach ($list as $key => $value):
                  $t = single_get("*","course_id","course_list",$value->course_id);
              ?>
              <option value="<?php echo $value->sec_id?>">Section: <?php echo $value->SectionName?> - Course: <?php echo $t['course_name']?></option>
            <?php endforeach;?>
            </select>
          
          <?php endif;?>
      </div>
    </div>
    <p></p>
    <div class="row">
      <?php if(!isset($_GET['sub_code'])):?>
      <div class="col-md-2">From:</div>
      <div class="col-md-4">
        <input type="time" name="sub_time1" class="form-control">
      </div>
      <div class="col-md-2">Until:</div>
      <div class="col-md-4">
        <input type="time" name="sub_time2" class="form-control" value="<?php if(isset($_GET['sub_code'])): echo $code['sub_time']; elseif(isset($_POST['save_button'])): echo $_POST['sub_code']; endif;?>">
      </div>
      <?php else:?>
      
      <?php endif;?>
    </div>
    <p></p>
    <div class="row">
      <div class="col-md-2">Day:</div>
      <div class="col-md-4">
        <select name="sub_day" class="form-control">
            <option value="MWF" <?php if(isset($_GET['sub_code'])){if($day == 'MWF'){echo 'selected';}}?>>MWF</option>
            <option value="TTH" <?php if(isset($_GET['sub_code'])){if($day == 'TTH'){echo 'selected';}}?>>TTH</option>
            <option value="TTHS" <?php if(isset($_GET['sub_code'])){if($day == 'TTHS'){echo 'selected';}}?>>TTHS</option>
            
          </select>
      </div>
      <div class="col-md-2">Sem:</div>
      <div class="col-md-4">
        <select name="sub_sem" class="form-control">
            <option value="1st Semester" <?php if(isset($_GET['sub_code'])){if($sem == '1st Semester'){echo 'selected';}}?>>1st Semester</option>
            <option value="2nd Semester" <?php if(isset($_GET['sub_code'])){if($sem == '2nd Semester'){echo 'selected';}}?>>2nd Semester</option>
            <!--
            <option value="3rd Semester" <?php if(isset($_GET['sub_code'])){if($sem == '3rd Semester'){echo 'selected';}}?>>3rd Semester</option>
            <option value="4th Semester" <?php if(isset($_GET['sub_code'])){if($sem == '4th Semester'){echo 'selected';}}?>>4th Semester</option>
          -->
          </select>
      </div>
    </div>
    <p></p>
    <div class="row">
      <div class="col-md-2">Year Lvl:</div>
      <div class="col-md-4">
        <select name="year_lvl" class="form-control">
            <option value="1st Year" <?php if(isset($_GET['sub_code'])){if($yrlvl == '1st Year'){echo 'selected';}}?>>1st Year</option>
            <option value="2nd Year" <?php if(isset($_GET['sub_code'])){if($yrlvl == '2nd Year'){echo 'selected';}}?>>2nd Year</option>
            <option value="3rd Year" <?php if(isset($_GET['sub_code'])){if($yrlvl == '3rd Year'){echo 'selected';}}?>>3rd Year</option> 
              <option value="4th Year" <?php if(isset($_GET['sub_code'])){if($yrlvl == '4th Year'){echo 'selected';}}?>>4th Year</option> 
          </select>
      </div>
      <div class="col-md-2">
        School Year:
      </div>
      <div class="col-md-4">
        <?php if(!isset($_GET['sub_code'])):?>
          From: <input type="year" name="sub_year1" style="width:128px;height:34px;" value="<?php if(isset($_POST['save_button'])): echo $_POST['sub_year1']; endif;?>"> 
            Until:<input type="year" name="sub_year2" style="width:128px;height:34px;"
            value="<?php if(isset($_POST['save_button'])): echo $_POST['sub_year2']; endif;?>">
        <?php else:?>
        <input type="year" name="sub_year" class="form-control" value="<?php if(isset($_GET['sub_code'])): if($count != 0): echo $year; else: echo $error; endif; endif;?><?php if(isset($_POST['save_button'])): echo $_POST['sub_year']; endif;?>" >
      <?php endif;?>
      </div>
    </div>
    <p></p>
    <div class="row">
      <div class="col-md-2">
          Subject Description:
      </div>
      <div class="col-md-4">
        <textarea name="sub_desc" class="form-control" cols="100%" rows="5" placeholder="Subject Description"><?php if(isset($_GET['sub_code'])): if($count != 0): echo $desc; else: echo $error; endif; endif;?><?php if(isset($_POST['save_button'])): echo $_POST['sub_desc']; endif;?></textarea>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4"></div>
    </div>
    <br>
    <center>
      <input type="submit" name="save_button" value="Add Subject" class="btn btn-primary">
            <a href="view-subject.php" class="btn btn-danger">Return</a>
    </center>     
    </form>
     

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>