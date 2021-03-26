<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  switch (true) {
    case isset($_POST['add_button']):
      $idno = filter($_POST['idno']);
      $pass = md5(filter($_POST['idno']));
      $fname = filter($_POST['fname']);
      $mname = filter($_POST['mname']);
      $lname = filter($_POST['lname']);
      $address = filter($_POST['address']);
      $email = filter($_POST['email']);
      $role = filter($_POST['role']);

      if(has_null($idno,$fname,$mname,$lname,$address,$email))
      {
        $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Please fill up all the fields.</div>';
      }
      else
      { 
        if(isset($_GET['idno']))
        {
          
          $arr_where = array("idno"=>$_GET['idno']);//update where
          $arr_set = array("idno"=>$idno,"fname"=>$fname,"mname"=>$mname,"lname"=>$lname,
            "address"=>$address,"email"=>$email,"role"=>$role);
          $tbl_name = "user_account";

          $update = update($dbcon,$tbl_name,$arr_set,$arr_where);
          header("location: index.php");
          
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
          $arr = array("idno"=>$idno,"pass"=>$pass,"fname"=>$fname,"mname"=>$mname,"lname"=>$lname,
            "address"=>$address,"email"=>$email,"role"=>$role);
          $d = insertdata("user_account",$arr);
          $h = mysqli_insert_id($dbcon);
          $t = array("userID"=>$h);
          insertdata("user_misc",$t);

           $f = array("log_desc"=>"Registrar has added account to the system: Name:".$fname."
            ".$mname." ".$lname."");
          insertdata("logs",$f);

          if($d)
          {
            header("location: index.php");
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
      $d = $dbcon->query("SELECT * FROM user_account WHERE idno = '$idno'") or die(mysqli_error());
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
        mysqli_close($dbcon);
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dashboard"></i> Dashboard
       
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Welcome!</li>
        <li class="active"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <h4><span class="glyphicon glyphicon-plus"></span> Add Information</h4>
    <?php if(isset($msg)): echo $msg; endif;?>
    <form method="post" autocomplete="off">
    <table>
      <tr>
        <td class="spacing">ID number:</td>
        <td class="spacing">
          <input type="text" id="txtfield"  name="idno"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_id; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['idno']; endif;?>" placeholder="ID number">
        </td>
      </tr>
      <tr>
        <td class="spacing">First Name:</td>
        <td class="spacing">
          <input type="text" id="txtfield"  name="fname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_fname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['fname']; endif;?>" placeholder="First Name">
        </td>
      </tr>
      <tr>
        <td class="spacing">Middle Name:</td>
        <td class="spacing">
          <input type="text" id="txtfield"  name="mname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_mname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['mname']; endif;?>" placeholder="Middle Name">
        </td>
      </tr>
      <tr>
        <td class="spacing">Last Name:</td>
        <td class="spacing">
          <input type="text" id="txtfield"  name="lname"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_lname; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['mname']; endif;?>" placeholder="Last Name">
        </td>
      </tr>
      <tr>
        <td class="spacing">Address:</td>
        <td class="spacing">
          <input type="text" id="txtfield"  name="address"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_address; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['address']; endif;?>" placeholder="Address">
        </td>
      </tr>
      <tr>
        <td class="spacing">Email Address:</td>
        <td class="spacing">
          <input type="email" id="txtfield"  name="email"
          value="<?php if(isset($_GET['idno'])): if($count != 0): echo $fetch_email; else: echo $error; endif; endif;?><?php if(isset($_POST['add_button'])): echo $_POST['address']; endif;?>" placeholder="Email Address">
        </td>
      </tr>
      <tr>
        <td class="spacing">Account Role:</td>
        <td class="spacing">
          <select name="role" id="txtfield">
            <option value="4" <?php if(isset($_GET['idno'])){if($fetch_role == '4'){echo 'selected';}}?>>Student</option>
            <option value="3" <?php if(isset($_GET['idno'])){if($fetch_role == '3'){echo 'selected';}}?>>Teacher</option>
            <option value="2" <?php if(isset($_GET['idno'])){if($fetch_role == '2'){echo 'selected';}}?>>Registrar</option>
            
          </select>
        </td>
      </tr>
      <tr>
        <td class="spacing"></td>
        <td class="spacing">
          <input type="submit" name="add_button" class="btn btn-primary" value="Register">
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