<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
 switch (true) {
    case isset($_POST['add_button']):
      $idno = filter($_POST['idno']);
      $pass = md5(filter($_POST['idno']));
      $fname = filter($_POST['fname']);
      $mname = filter($_POST['mname']);
      $lname = filter($_POST['lname']);
      $address = filter($_POST['address']);
      $email = filter($_POST['email']);
    
      if(has_null($idno,$fname,$mname,$lname,$address,$email))
      {
        $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Please fill up all the fields.</div>';
      }
      else
      { 
        if(isset($_GET['idno']))
        {
          
          $arr_where = array("idno"=>$_GET['idno']);//update where
          $arr_set = array(
            "idno"        =>  $idno,
            "fname"       =>  $fname,
            "mname"       =>  $mname,
            "lname"       =>  $lname,
            "address"     =>  $address,
            "email"       =>  $email,
           
          );
          $tbl_name = "user_account";

          $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
          header("location: student-list.php");
        }
        else
        {
          if(checkname($fname,$mname,$lname))
          {
            $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Account Name already exist.</div>';
          }
          elseif(check_user($idno))
          {
            $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> ID number already exist.</div>';
          }
          elseif(check_email($email))
          {
            $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Email address already exist.</div>';
          }
          else
          {
          $arr = array(
            "idno"      =>$idno,
            "pass"      =>$pass,
            "fname"     =>$fname,
            "mname"     =>$mname,
            "lname"     =>$lname,
            "address"   =>$address,
            "email"     =>$email,
            "user_photo"=>'nophoto.jpg',
            "role"      =>"4",
          );
          $d = insertdata("user_account",$arr);
          if($d)
          {
            header("location: student-list.php");
            //echo '<script>alert("You have successfully registered to the system. Please wait for your professor activation.");</script>';
          }
          else
          {
            echo 'Error';
          }
          }
        }
      }

    break;
    case isset($_GET['idno']):
     $idno = filter($_GET['idno']);
      $d = $dbcon->query("SELECT * FROM user_account INNER JOIN sections on sections.sec_id = user_account.sec_id WHERE idno = '$idno'") or die(mysqli_error());
      $count = mysqli_num_rows($d);

      if($count == 0)
      {
        $error = 'There are no result on the datbase.';
      }
      else
      {
        while($f = $d->fetch_assoc())
        {
          $fetch_id = $f['idno'];
          $fetch_fname = $f['fname'];
          $fetch_mname = $f['mname'];
          $fetch_lname = $f['lname'];
          $fetch_address = $f['address'];
          $fetch_email = $f['email'];
          $fetch_role = $f['role'];
        
        }
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
      <h4><i class="fa fa-plus"></i> Student Information</h4>
      <hr>
    <?php if(isset($msg)): echo $msg; endif;?>
    <form method="post" autocomplete="off">
<div class="row">
  <div class="col-md-2">ID number:</div>
  <div class="col-md-4">
    <input type="text" class="form-control"  name="idno"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_id; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['idno']; endif;?>" placeholder="ID number">
  </div>
    <div class="col-md-2">First Name:</div>
  <div class="col-md-4">
    <input type="text" class="form-control"  name="fname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_fname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['fname']; endif;?>" placeholder="First Name">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Middle Name:</div>
  <div class="col-md-4">
    <input type="text" class="form-control"  name="mname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_mname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['mname']; endif;?>" placeholder="Middle Name">
  </div>
    <div class="col-md-2">Last Name:</div>
  <div class="col-md-4">
    <input type="text" class="form-control"  name="lname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_lname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['mname']; endif;?>" placeholder="Last Name">
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Address:</div>
  <div class="col-md-4">
    <input type="text" class="form-control"  name="address"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_address; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['address']; endif;?>" placeholder="Address">
  </div>
    <div class="col-md-2">Email Address:</div>
  <div class="col-md-4">
    <input type="email" class="form-control"  name="email"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_email; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['address']; endif;?>" placeholder="Email Address">
  </div>
</div>
<p></p>
<!--
<div class="row">
  <div class="col-md-2">Sem:</div>
  <div class="col-md-4">
     <select name="sem" class="form-control">
        <option value="1st Semester" <?php if(isset($_GET['idno'])){if($fetch_sem == '1st Semester'){echo 'selected';}}?>>1st Semester</option>
        <option value="2nd Semester" <?php if(isset($_GET['idno'])){if($fetch_sem == '2nd Semester'){echo 'selected';}}?>>2nd Semester</option>
        
        <option value="3rd Semester" <?php if(isset($_GET['id_no'])){if($fetch_sem == '3rd Semester'){echo 'selected';}}?>>3rd Semester</option>
        <option value="4th Semester" <?php if(isset($_GET['id_no'])){if($fetch_sem == '4th Semester'){echo 'selected';}}?>>4th Semester</option>
      
     </select>
  </div>
    <div class="col-md-2">Year Lvl:</div>
  <div class="col-md-4">
    <select name="year_lvl" class="form-control">
      <option value="1st Year" <?php if(isset($_GET['idno'])){if($fetch_year_lvl == '1st Year'){echo 'selected';}}?>>1st Year</option>
      <option value="2nd Year" <?php if(isset($_GET['idno'])){if($fetch_year_lvl == '2nd Year'){echo 'selected';}}?>>2nd Year</option>
      <option value="3rd Year" <?php if(isset($_GET['idno'])){if($fetch_year_lvl == '3rd Year'){echo 'selected';}}?>>3rd Year</option> 
      <option value="4th Year" <?php if(isset($_GET['idno'])){if($fetch_year_lvl == '4th Year'){echo 'selected';}}?>>4th Year</option> 
    </select>
  </div>
</div>
<p></p>
<div class="row">
  <div class="col-md-2">Section:</div>
  <div class="col-md-4">
    <select name="sec_id" class="form-control">
      <?php
      $query = "SELECT * FROM sections INNER JOIN course_list on course_list.course_id = sections.course_id";
      $list = getdata_inner_join($query);
      ?>
      <?php if(!empty($list)):?>
        <?php foreach ($list as $key => $value):?>
          <option value="<?php echo $value->sec_id?>"
              <?php if(isset($_GET['idno'])){
                if($sec_id == $value->sec_id){
                  echo 'selected';
                }
              }
              elseif(isset($_POST['save_button'])){
                  echo $_POST['sec_id'];
              }
              ?>><?php echo $value->SectionName?> - <?php echo $value->course_name?></option>
        <?php endforeach;?>
      <?php else:?>
        <option></option>
      <?php endif;?>
    </select>

  </div>
 
    <div class="col-md-2"></div>
  <div class="col-md-4"></div>
</div>
 -->
<br>
   <center>
     <input type="submit" name="add_button" class="btn btn-primary" value="Register">
          <a href="student-list.php" class="btn btn-danger">Return</a>
   </center>
    </form>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>