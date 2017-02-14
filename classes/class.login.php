<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('connect.php');
///////////////////////////////////////////////
//LOGIN FUNCTION	
	function loginUser(){
		if (isset($_POST['inpUSERNAME']) && isset($_POST['inpPASS'])){
			global $_CON;
			$username = mysqli_real_escape_string($_CON, $_POST['inpUSERNAME']);
			$password = mysqli_real_escape_string($_CON, $_POST['inpPASS']);
			$pass = md5($password);
			$query = "SELECT account_status, password FROM client_table WHERE client_username='$username' ";
			$result = mysqli_query($_CON,$query) or die(mysqli_connect_error());
			$count = mysqli_num_rows($result);
			if($count == 1){
				//GET USERNAME INFORMATION
				$row = mysqli_fetch_array($result);
				$account_status = $row['account_status'];
				$pwd = $row['password'];
				//COMPARES DATA FETCHED FROM DB TO USER INPUT
				if($pwd == $pass){
					//CHECK ACCOUNT STATUS ISSET TO 1
					if($account_status == 1){
					$_SESSION['client_usr'] = $username;
					}elseif($account_status == 3){
						header("location: login.php?account=banned");
						ob_end_clean();
					}else{
						header("location: login.php?account=not_verified");
						ob_end_clean();
					}
				}else{
					header("location: login.php?credentials=false");
					ob_end_clean();
				}
			}else{
				header("location: login.php?credentials=false");
				ob_end_clean();
			}
		}
		///////////
		//Check if Session is Set Then redirects to index?session=true
		if(isset($_SESSION['client_usr'])){
		$username = $_SESSION['client_usr'];
		setcookie("client_usr", $username, strtotime( '+30 days' ), "/", "", "", TRUE);
		header("location: ./index.php?session=loggedin");
		}
	}