<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('connect.php');

/////////////////////////////////////////////
//Add employee
	function signup(){
		global $_CON;
		if(isset($_POST['btn_signup'])){
			$inpTYPE = mysqli_real_escape_string($_CON, $_POST['inpTYPE']);
			$inpUSERNAME = mysqli_real_escape_string($_CON, $_POST['inpUSERNAME']);
			$inpFNAME = mysqli_real_escape_string($_CON, $_POST['inpFNAME']);
			$inpLNAME = mysqli_real_escape_string($_CON, $_POST['inpLNAME']);
			$inpADDRESS = mysqli_real_escape_string($_CON, $_POST['inpADDRESS']);
			$inpBIRTHDATE = mysqli_real_escape_string($_CON, $_POST['inpBIRTHDATE']);
			$inpBIRTHPLACE = mysqli_real_escape_string($_CON, $_POST['inpBIRTHPLACE']);
			$inpGENDER = mysqli_real_escape_string($_CON, $_POST['inpGENDER']);
			$inpCIVSTATS = mysqli_real_escape_string($_CON, $_POST['inpCIVSTATS']);
			$inpPWD = mysqli_real_escape_string($_CON, $_POST['inpPWD']);
			$inpCODE = mysqli_real_escape_string($_CON, $_POST['inpCODE']);
			$inpPWD = md5($inpPWD);
			//CHECK IF EIN EXIST
			$sqlSearch = mysqli_query($_CON, "SELECT client_username FROM client_table WHERE client_username='$inpUSERNAME' ");
			$count = mysqli_num_rows($sqlSearch);
			if($count > 0){
				ob_end_clean();
				header("location: signup.php?signup=exist");
			}else{
				$sqlInsert = mysqli_query($_CON, "INSERT INTO client_table
				(client_username,
				first_name,
				last_name,
				gender,
				civil_stats,
				address,
				birthdate,
				birthplace,
				password,
				member_type,
				account_code)
				VALUES(
				'$inpUSERNAME',
				'$inpFNAME',
				'$inpLNAME',
				'$inpGENDER',
				'$inpCIVSTATS',
				'$inpADDRESS',
				'$inpBIRTHDATE',
				'$inpBIRTHPLACE',
				'$inpPWD',
				'$inpTYPE',
				'$inpCODE')");
				ob_end_clean();
				header("location: signup.php?signup=true");
			}
		}
	}


///////////////////////////////////////////
//ADD RESPONSE
	function signupRes(){
		if(isset($_GET['signup'])){
			$_RES = $_GET['signup'];
			if($_RES == 'true'){
				echo"
					<div class='widget-footer'>
						<p class='glyphicons thumbs_up'><i></i>Successfully created your account. Please <a href='login.php'>Login</a></p>
					</div>";
			}
			if($_RES == 'exist'){
				echo"
					<div class='widget-footer'>
						<p class='glyphicons restart'><i></i>Sorry, the username you entered is already taken. </p>
					</div>";
			}
		}
	}

function unqID($length = 6) {
    $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    echo "$randomString";
}