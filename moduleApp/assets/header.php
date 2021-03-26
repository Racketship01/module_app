  <?php 
    $getPhoto = single_get("*","idno","user_account",$_SESSION['idno']);
  ?>
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo" style="background:#777;">

      <?php if(isset($_SESSION['login_registrar'])):?>
              <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Admin</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Administrator</b></span>
      <?php elseif(isset($_SESSION['login_teacher'])):?>
                      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Professor</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Professor</b></span>
      <?php elseif(isset($_SESSION['login_student'])):?> 
              <span class="logo-mini"><b>Student</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Student</b></span>
      <?php endif;?>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background:#666;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
    <?php 
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(stripos($ua, 'android') !== false){
        ?>
        <!--
        <p></p>
              <a href="index.php" style="padding-left:10%;color:white;font-size:16px; font-family: 'Abril Fatface', cursive;">
        <strong>E-LEARNING SYSTEM IN AOP</strong>

      </a>
    -->
        <?php 
        }else{
        ?>      
  <!--
        <a href="index.php" style="color:white;font-size:22px; font-family: 'Abril Fatface', cursive;">
        <strong>E-LEARNING SYSTEM IN AIRLINE OPERATING PROCEDURES</strong>

      </a>
  -->
        <?php
        }
        ?>
       
      <!-- Navbar Right Menu -->
      <!--
      <div class="navbar-custom-menu">
        
        <ul class="nav navbar-nav">

        <?php if(isset($_SESSION['login_student'])):?>
           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../img/<?php echo $getPhoto['user_photo'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../img/<?php echo $getPhoto['user_photo'];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?>
                  <small>Account Type: Student</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="change.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        <?php else:?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../img/<?php echo $getPhoto['user_photo'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../img/<?php echo $_SESSION['photo'];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?>
                 
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="change.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        <?php endif;?>
        </ul>
      </div>
    -->
    </nav>
  </header>