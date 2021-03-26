    <?php $rowPhoto = single_get("*","idno","user_account",filter($_SESSION['idno'])); ?>
   
    <section class="sidebar" >

      <div class="user-panel">
        <div class="pull-left image">
         <img src="../img/<?php echo $rowPhoto['user_photo'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
         <br>
        <center><p style="font-size:12px;font-family:Arial;"><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?><br>
         <?php if(isset($_SESSION['login_registrar'])):?>
         Account Type: Administrator
         <?php elseif(isset($_SESSION['login_teacher'])):?>
         Account Type: Professor
         <?php elseif(isset($_SESSION['login_student'])):?> 
         Account Type: Student
         <?php endif;?>
         </p>
          
        </div>
      </div>


      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree" >
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="index.php" style="background:#666;"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <?php if(isset($_SESSION['login_student'])):?>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        <?php endif;?>
        <?php if(isset($_SESSION['login_registrar'])):?>
        <li><a href="edit-profile.php"><i class="fa fa-user"></i> <span> My Profile</span></a></li>
        <!--
        <li><a href="view-subject.php"><i class="fa fa-book"></i> <span> Subject List</span></a></li>
        <li><a href="section.php"><i class="fa fa-plus"></i> <span> Section</span></a></li>
      -->
        <li class="treeview">
          <a href="#"><i class="fa fa-folder"></i> <span>File Manager</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="file-category.php">File Categories</a></li>
            
            <li><a href="create-quiz.php">Create Activity</a></li>
            
            <li><a href="quiz-list.php">Activities</a></li>
          
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Account List</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="student-list.php">Student</a></li>
            <!--
            <li><a href="teacher-list.php">Professor</a></li>
          -->
          </ul>
        </li>
      <!--
      <li><a href="quiz-report.php"><i class="fa fa-calendar"></i> <span> Reports</span></a></li>
      -->
      <li><a href="change.php"><i class="fa fa-wrench"></i> <span> Change Password</span></a></li>
      <li><a href="logout.php"><i class="fa fa-edit"></i> <span> Logout</span></a></li>
      <?php endif;?>
      <?php if(isset($_SESSION['login_teacher'])):?>
        <li><a href="edit-profile.php"><i class="fa fa-user"></i> <span> My Profile</span></a></li>
         <li><a href="course-syllabus.php"><i class="fa fa-file"></i> <span> Course Syllabus</span></a></li>
        <li><a href="student-list.php"><i class="fa fa-users"></i> <span> Student List</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Quiz Management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="create-quiz.php">Create Quiz</a></li>
            <li><a href="quiz-list.php">Quiz List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-plus"></i> <span>Lessons</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="create-lesson.php">List of Lessons</a></li>
            <li><a href="archive-folder.php">Archive Lessons</a></li>
          </ul>
        </li>
        <li><a href="announcements.php"><i class="fa fa-calendar-o"></i> <span> Announcements</span></a></li>
        <li><a href="quiz-report.php"><i class="fa fa-calendar"></i> <span> Reports</span></a></li>
      <?php endif;?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>