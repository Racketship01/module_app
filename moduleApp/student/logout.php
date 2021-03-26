<?php
	// Unset all of the session variables.
    include '../config/db.php';
    include '../config/functions.php';
    include '../config/main_function.php';
	 $s = single_get("*","idno","user_account",$_SESSION['idno']);
	$f = array("log_desc"=>"".$s['fname']." ".$s['mname']." ".$s['lname']." has logout to the system");
    insertdata("logs",$f);
	session_start();
	session_destroy();
	header('location:../index.php');
?>