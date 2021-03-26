<?php


	class DbConnect{
		private $con;

		function __construct(){

		}

		function connect(){

			include_once dirname((_FILE_)).'/Constants.php';

			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,);

		}

		if(mysqli_connect_errno()){
			echo 'Failes to connect with database'.mysql_connect_err();
		}
		return $this->con;
	}

	}