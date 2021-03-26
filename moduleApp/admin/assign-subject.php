<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';

  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  
  $list = getdata_where("*","role","user_account","3");
  $g = single_get("*","idno","user_account",filter($_GET['idno']));
  if(isset($_POST['assign_now']))
  { 
    $sub_code = filter($_POST['sub_code']);
    $idno = filter($_GET['idno']);
    $kweri = $dbcon->query("SELECT * FROM assign_subject WHERE assign_code='$sub_code'") or die(mysqli_error());
    $count = mysqli_num_rows($kweri);
    if($count > 0)
    {
        $msg = ' <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You have already assign this subject to the teacher.</div>';
    }
    else
    {
      $sub_code = filter($_POST['sub_code']);
      $idno = filter($_GET['idno']);
      $g = array(
        "assign_code"     =>$sub_code,
        "assign_teacher"  =>$idno,
        "semester"        =>""
      );
      /*
      $f = array(
        "assign_code"     =>$sub_code,
        "assign_teacher"  =>$idno,
        "semester"        =>"Midterm"
      );
      $a = array(
        "assign_code"     =>$sub_code,
        "assign_teacher"  =>$idno,
        "semester"        =>"Finals"
      );
      */
      insertdata("assign_subject",$g);
      //insertdata("assign_subject",$f);
      //insertdata("assign_subject",$a);
      $f = array("log_desc"=>"Registrar assigned subject to this id number: ".$idno."");
      insertdata("logs",$f);
      header("location: assign-subject.php?idno=$idno");
    } 
  }
  if(isset($_GET['delete']))
  {
    $delete = filter($_GET['delete']);
    $idno = filter($_GET['idno']);
    $tbl_name = "assign_subject";
    $ar = array("assignID"=>$delete);

    $del = delete($dbcon,$tbl_name,$ar);

    if($del)
    {
      header("location: assign-subject.php?idno=$idno");
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
  <div class="content-wrapper" style="background:white;">

    <section class="content container-fluid">
      <h4><span class="glyphicon glyphicon-user"></span> Teacher Name: <?php echo $g['fname']?> <?php echo $g['mname']?> <?php echo $g['lname']?></h4>
        
      <div class="col-md-5" style="padding-top: 10px;width:10%;">
        <form method="post">
         
          <input type="submit" name="add_button" class="btn btn-success" value="Assign Subjects" >
         
        </form>


      </div>

    
    <br><br><br>
    <?php if(isset($msg)): echo $msg; endif;?> 
    <div id="wrapper">
    <?php if(isset($_POST['add_button'])):?>
      
      <p>Subject Code:</p>
          <form method="post" autocomplete="off">
            <?php $k = getdata("*","subject");?>
            <select name="sub_code" class="form-control">
            <?php if(!empty($k)):?>
            <?php 
            foreach ($k as $key => $value):
              $f = single_get("*","sec_id","sections",$value->sec_id);
            ?>
              <option value="<?php echo $value->sub_code?>">Subject Code: <?php echo $value->sub_code?> / Course: <?php echo $f['SectionName'];?> / Day and Time: <?php echo $value->sub_time?> and <?php echo $value->sub_day?> / School Year: <?php echo $value->sub_year?></option>
            <?php endforeach;?>
          <?php else:?>
            <option>No data on database.</option>
          <?php endif;?>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" name="assign_now" value="Submit">
            <a href="assign-subject.php?idno=<?php echo $_GET['idno']?>" class="btn btn-danger">Return</a>
          </form>
          <br>
    <?php else:?>
          <?php $kweri = assign_subject();?>
          <?php if(!empty($kweri)):?>
          <div class="table-responsive">
            <table id="example1" class="table table-striped" style="font-size: 12px;">
              <thead>
              <tr>
                <td>Subject Code</td>
                <td>Description</td>
                <td>Section</td>
                <td>Time</td>
                <td>Day</td>
                
                <td>School Year</td>
                <td></td>
              </tr>
            </thead>
          <tbody>
          <?php foreach ($kweri as $key => $value):?>
             <tr>
                <td><?php echo $value->assign_code?></td>
                <td><?php echo $value->sub_desc?></td>
                <td>
                  <?php 
                  $f = single_get("*","sec_id","sections",$value->sec_id);
                  echo $f['SectionName'];
                  ?>
                </td>
                <td><?php echo $value->sub_time?></td>
                <td><?php echo $value->sub_day?></td>
                <td><?php echo $value->sub_year?></td>
                <td>
                   <a href="#" <?php echo 'onclick=" confirm(\'Do you want to delete this assign subject?\') 
      ?window.location = \'assign-subject.php?delete='.$value->assignID.'&idno='.$_GET['idno'].'\' : \'\';"'; ?>><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>
          <?php endforeach;?>
          </table>
          <?php else:?>
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> There are no records on the database.</div>
          <?php endif;?>
          </div>
    <?php endif;?>
  </div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
</body>
</html>