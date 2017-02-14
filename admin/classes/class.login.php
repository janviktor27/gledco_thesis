<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
	function loginUser(){
		if (isset($_POST['inpUSERNAME']) && isset($_POST['inpPASS'])){
			require_once('../connect.php');
			$username = mysqli_real_escape_string($_CON, $_POST['inpUSERNAME']);
			$password = mysqli_real_escape_string($_CON, $_POST['inpPASS']);
			$pass = md5($password);
			$query = "SELECT * FROM admin_table WHERE username='$username' AND password='$pass'";
			$result = mysqli_query($_CON,$query) or die(mysqli_connect_error());
			$count = mysqli_num_rows($result);
			if($count == 1){
				$_SESSION['admin_usr'] = $username;
			}else{
				header("location: login.php?credentials=false");
				ob_end_clean();
			}
		}
		///////////
		//Check if Session is Set Then redirects to index?session=true
		if(isset($_SESSION['admin_usr'])){
		$username = $_SESSION['admin_usr'];
		$password = $_SESSION['password'];
		setcookie("admin_usr", $username, strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("password", $password, strtotime( '+30 days' ), "/", "", "", TRUE);
		header("location: ./index.php?session=loggedin");
		}
	}