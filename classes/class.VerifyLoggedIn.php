<?php 
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('connect.php');
//$usr = $_SESSION['client_usr'];

///////////////////////////////////////////////////////////////////////////////////
//Authentication
///////////////////////////////////////////////////////////////////////////////////
	function onlineChecker(){
		if (!isset($_SESSION['client_usr'])){
			header("location: ./login.php?session=false");
			ob_end_clean();
			exit;
		}		
	}	
	
	function checkMoreInfo(){
		global $_CON;
		if(isset($_SESSION['client_usr'])){
		$usr_name = $_SESSION['client_usr'];
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		client_id
		more_info
		FROM
		client_table
		WHERE
		more_info='1'
		AND
		client_username='$usr_name'");
		$count = mysqli_num_rows($sqlSearch);
			if($count == 0){
				header("location: ./personal.more.info.php?session=loggedin");
				ob_end_clean();
				exit;
			}
		}
	}
	
	function checkComplete(){
		global $_CON;
		if(isset($_SESSION['client_usr'])){
		$usr_name = $_SESSION['client_usr'];
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		client_id
		more_info
		FROM
		client_table
		WHERE
		more_info='1'
		AND
		client_username='$usr_name'");
		$count = mysqli_num_rows($sqlSearch);
			if($count == 1){
				header("location: ./index.php?errno=403");
				ob_end_clean();
				exit;
			}
		}
	}
