<?php
  include '../config/db.php';
  include '../config/functions.php';
  include '../config/main_function.php';
  if(!isset($_SESSION['login_registrar']))
  {
    header("location: ../index.php");
  }
  $row = single_get("*","idno","user_account",filter($_SESSION['idno']));
  $list = getdata_where("*","role","user_account","4");
  if(isset($_GET['delete']))
  {
    global $dbcon;
    $delete = filter($_GET['delete']);
    $tbl_name = "user_account";
    $ar = array("idno"=>$delete);

    $del = delete($dbcon,$tbl_name,$ar);

    if($del)
    {
      header("location: index.php");
    }
  }
$g = $dbcon->query("SELECT * FROM user_account WHERE role = '4'") or die(mysqli_error()); // student
$t = $dbcon->query("SELECT * FROM user_account WHERE role = '4'") or die(mysqli_error()); // teacher

$r = $dbcon->query("SELECT * FROM subject") or die(mysqli_error()); // subject
$l = $dbcon->query("SELECT * FROM logs") or die(mysqli_error()); // logs
$result = $dbcon->query("SELECT * FROM exam_result") or die(mysqli_error()); // logs
$folder = $dbcon->query("SELECT * FROM main_folder INNER JOIN subject on subject.sub_id = main_folder.sub_id WHERE folder_status = '0'") or die(mysqli_error());
?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    
          <div class="row">
              <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($g);?></h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="student-list.php" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($folder);?></h3>

              <p>File Categories</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="file-category.php" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($l); ?></h3>

              <p>System Logs</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="logs.php" class="small-box-footer"> View<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($result);?></h3>

              <p>Activities</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="quiz-list.php" class="small-box-footer"> View<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
             </div>
    </section>
        <section class="content-header">
      <h1>
        <i class="fa fa-calendar"></i> Student Graphical Progress
       
      </h1>
    
    </section>
      <section class="content container-fluid">
          <div class="row" style="background:white;margin:0px;padding:10px;">
            <form method="post">
                <strong>Activity:</strong>
                <select class="form-control" name="quiz_id">
                    <?php 
                        $h = $dbcon->query("SELECT * FROM quiz_content") or die(mysqli_error());
                        while($fetch = $h->fetch_assoc()):
                    ?>
                    <option value="<?php echo $fetch['quiz_id']?>"><?php echo $fetch['quiz_title'];?></option>
                    <?php 
                    endwhile;
                    ?>
                </select>
                <p></p>
                <button class="btn btn-info" name="search_btn"><i class="fa fa-search"></i> Search Report</button>
            </form>
            <br>
            <?php 
            if(isset($_POST['search_btn'])):
                $quiz_id = filter($_POST['quiz_id']);
                
                $q = $dbcon->query("SELECT * FROM quiz_content WHERE quiz_id = '$quiz_id'") or die(mysqli_error());
                $row = $q->fetch_assoc();
                
                /*
                
                if($row['quiz_type'] == '1'){
                    //matching type
                    
                    $kweri = "SELECT COUNT(*) as total FROM multiple_choice WHERE quiz_id = '$quiz_id'";
                    $h = $kweri->fetch_assoc();
                    
                    echo $h['total'];
                    
                    $kweri2 = $dbcon->query("SELECT * FROM exam_result WHERE quiz_id = '$quiz_id'") or die(mysqli_error());
                    $j = $kweri2->fetch_assoc();
                    
                    echo '';
                }elseif($row['quiz_type'] == '2'){
                    //true or false
                    
                }
                */
            ?>
              <div id="chart_div"></div>
            <?php 
            endif;
            ?>
          </div>
      </div>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/footer.php';?>
<?php 

if(isset($_POST['search_btn'])){
    $kweri5 = $dbcon->query("SELECT * FROM exam_result 
    INNER JOIN user_account on user_account.user_id = exam_result.exam_user
    WHERE quiz_id = '".$_POST['quiz_id']."'") or die(mysqli_error());
}
?>
<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['City', '2010 Population',],
        <?php 
        if(mysqli_num_rows($kweri5) == 0){
            echo "['No Records','No Recored', No Records]";
        }else{
        ?>
         <?php  
         while ($r = mysqli_fetch_array($kweri5)) { 
                echo "[' ".$r["fname"]." ".$r["lname"]."', ".$r["exam_score"]." ],";
          }
        } 
         ?> 

      ]);

      var options = {
        title: 'Student Graphical Report for Activities',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total Score',
          minValue: 0
        },
        vAxis: {
          title: 'Student Name'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>
</body>
</html>