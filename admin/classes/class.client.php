<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');

/////////////////////////////////////////////
//CLIENT RULES
//0-DEACTIVATED
//1-ACTIVATED
//2-MISSINGINFO
//3-CANCELLED
/////////////////////////////////////////////

/////////////////////////////////////////////
//ADD CLIENT
	function add(){
		global $_CON;
		if(isset($_POST['btn_add'])){
			$inpTYPE = mysqli_real_escape_string($_CON, $_POST['inpTYPE']);
			$inpUSERNAME = mysqli_real_escape_string($_CON, $_POST['inpUNAME']);
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
				header("location: clients.php?client=exist");
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
				header("location: clients.php?add=true");
			}
		}
	}

/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM client_table ORDER BY last_name ASC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['client_id']);
				$client_username = mysqli_real_escape_string($_CON, $row['client_username']);
				$first_name = mysqli_real_escape_string($_CON, $row['first_name']);
				$last_name = mysqli_real_escape_string($_CON, $row['last_name']);
				$gender = mysqli_real_escape_string($_CON, $row['gender']);
				$civil_stats = mysqli_real_escape_string($_CON, $row['civil_stats']);
				$address = mysqli_real_escape_string($_CON, $row['address']);
				$birthdate = mysqli_real_escape_string($_CON, $row['birthdate']);
				$birthplace = mysqli_real_escape_string($_CON, $row['birthplace']);
				$member_type = mysqli_real_escape_string($_CON, $row['member_type']);
				$account_status = mysqli_real_escape_string($_CON, $row['account_status']);
				$account_code = mysqli_real_escape_string($_CON, $row['account_code']);
				//MEMBER TYPE TO TEXT
				if($member_type == 1){
					$mem_type = "Regular member";
				}elseif($member_type == 2){
					$mem_type = "Associative member";
				}
				//ACCOUNT STATUS (0 == DEACTIVATED) (1 == ACTIVATED) (2 == CANCELLED) (3 == BANNED)
				if($account_status == 0){$accnt_stats = "DEACTIVATED";}elseif($account_status == 1){$accnt_stats = "ACTIVATED";}elseif($account_status == 2){$accnt_stats =  "CANCELLED";}elseif($account_status == 3){$accnt_stats = "BANNED";}
				// CHECK IF THIS ACCOUNT HAS LOAN
				$sqlChecker = mysqli_query($_CON,"SELECT loan_id FROM loan_table WHERE client_id='$_ID'");
				$CountLoans = mysqli_num_rows($sqlChecker);
				if($CountLoans > 0){
					$dynaminDel_BTN ="
				   <button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#' disabled><i class='fa fa-trash-o'></i></button>
					";
				}else{
					$dynaminDel_BTN ="
				   <button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#delMOD$_ID'><i class='fa fa-trash-o'></i></button>
					";
				}
				echo"
				 <tr>
				  <td>$last_name, $first_name($mem_type)</td>
				  <td>$client_username</td>
				  <td>$account_code</td>
				  <td>$accnt_stats</td>
				  <td>$CountLoans</td>
				  <td class='center'>
				   <button class='btn btn-info btn-xs' data-toggle='modal' data-target='#updateMOD$_ID'><i class='fa fa-edit'></i></button>
				   $dynaminDel_BTN
				   <button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#banMOD$_ID'><i class='fa fa-ban'></i></button>
				  </td>
				 </tr>
				";
			}
		}else{
			echo"
			 <tr>
			  <td colspan='6'>No data yet. </td>
			 </tr>
			";
		}
	}
	
/////////////////////////////////////////////
//UPDATE MODAL
	function updMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM client_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['client_id']);
				$client_username = mysqli_real_escape_string($_CON, $row['client_username']);
				$first_name = mysqli_real_escape_string($_CON, $row['first_name']);
				$last_name = mysqli_real_escape_string($_CON, $row['last_name']);
				$gender = mysqli_real_escape_string($_CON, $row['gender']);
				$civil_stats = mysqli_real_escape_string($_CON, $row['civil_stats']);
				$address = mysqli_real_escape_string($_CON, $row['address']);
				$birthdate = mysqli_real_escape_string($_CON, $row['birthdate']);
				$birthplace = mysqli_real_escape_string($_CON, $row['birthplace']);
				$member_type = mysqli_real_escape_string($_CON, $row['member_type']);
				$account_status = mysqli_real_escape_string($_CON, $row['account_status']);
				$account_code = mysqli_real_escape_string($_CON, $row['account_code']);
				//MEMBER TYPE TO TEXT
				if($member_type == 1){
					$mem_type = "Regular";
				}elseif($member_type == 2){
					$mem_type = "Associative";
				}
				///////////////////////////////////
				// DYNAMIC GENDER
				if($gender == "M"){
					$dynamicGen = "
						<label class='radio'>
							<input type='radio' class='radio' name='inpGENDER' value='M' checked/> Male
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpGENDER' value='F' /> Female
						</label>
					";
				}else{
					$dynamicGen = "
						<label class='radio'>
							<input type='radio' class='radio' name='inpGENDER' value='M' /> Male
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpGENDER' value='F' checked/> Female
						</label>
					";
				}
				///////////////////////////////////////
				// DYNAMIC CIVIL STATUS
				if($civil_stats == "Single"){
					$dynamicCIVSTATS = "
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Single' checked/> Single
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Married' /> Married
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Widower/Widow' /> Widower/Widow
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Separated' /> Separated
						</label>
					";
				}elseif($civil_stats == "Married"){
					$dynamicCIVSTATS = "
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Single' /> Single
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Married' checked/> Married
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Widower/Widow' /> Widower/Widow
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Separated' /> Separated
						</label>
					";
				}elseif($civil_stats == "Widower/Widow"){
					$dynamicCIVSTATS = "
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Single' /> Single
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Married' /> Married
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Widower/Widow' checked/> Widower/Widow
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Separated' /> Separated
						</label>
					";
				}elseif($civil_stats == "Separated"){
					$dynamicCIVSTATS = "
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Single' /> Single
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Married' /> Married
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Widower/Widow'/> Widower/Widow
						</label>
						<label class='radio'>
							<input type='radio' class='radio' name='inpCIVSTATS' value='Separated' checked/> Separated
						</label>
					";
				}
				////////////////////////////
				// DISPLAY DATA
				echo"
				<div class='modal fade' id='updateMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; updAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Update form</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<label>Member type</label>
									<select class='form-control' name='inpTYPE' required>
										<option value='$member_type' default>$mem_type</option>
										<option value='1'>Regular</option>
										<option value='2'>Associative</option>
									</select>
									<label>Username </label>
									<input type='text' value='$client_username' name='inpUNAME' placeholder='Username' class='form-control' READONLY />
									<label>First name </label>
									<input type='text' value='$first_name' name='inpFNAME' placeholder='First name' class='form-control' required />
									<label>Last name </label>
									<input type='text' value='$last_name' name='inpLNAME' placeholder='Last name' class='form-control' required />
									<label>Address</label>
									<input type='text' value='$address' name='inpADDRESS' placeholder='Address' class='form-control' required />
									<label>Birth date</label>
									<input type='date' value='$birthdate' name='inpBIRTHDATE' class='form-control' required />
									<label>Birth place</label>
									<input type='text' value='$birthplace' name='inpBIRTHPLACE' placeholder='Birth place' class='form-control' required />
									<label class='strong'>Gender</label>
									$dynamicGen
									<label class='strong'>Civil Status</label>
									$dynamicCIVSTATS
									</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$_ID' name='UPD_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Close</a>
									<button type='submit' class='btn btn-primary' name='btn_upd'>Save changes</button>
								</div>
								<!-- // Modal footer END -->
							</form>
						</div>
					</div>
				</div>";
			}
		}
	}

/////////////////////////////////////////////
//UPDATE METHOD
	function updAction(){
		global $_CON;
		if(isset($_POST['btn_upd'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['UPD_ID']);
			$inpTYPE = mysqli_real_escape_string($_CON, $_POST['inpTYPE']);
			$inpFNAME = mysqli_real_escape_string($_CON, $_POST['inpFNAME']);
			$inpLNAME = mysqli_real_escape_string($_CON, $_POST['inpLNAME']);
			$inpADDRESS = mysqli_real_escape_string($_CON, $_POST['inpADDRESS']);
			$inpBIRTHDATE = mysqli_real_escape_string($_CON, $_POST['inpBIRTHDATE']);
			$inpBIRTHPLACE = mysqli_real_escape_string($_CON, $_POST['inpBIRTHPLACE']);
			$inpGENDER = mysqli_real_escape_string($_CON, $_POST['inpGENDER']);
			$inpCIVSTATS = mysqli_real_escape_string($_CON, $_POST['inpCIVSTATS']);
			$sqlUpdate = mysqli_query($_CON,"UPDATE client_table SET
			first_name='$inpFNAME',
			last_name='$inpLNAME',
			gender='$inpGENDER',
			civil_stats='$inpCIVSTATS',
			address='$inpADDRESS',
			birthdate='$inpBIRTHDATE',
			birthplace='$inpBIRTHPLACE',
			member_type='$inpTYPE'
			WHERE client_id='$_ID'");					
			ob_end_clean();
			header("location: clients.php?upd=true");
		}
	}

/////////////////////////////////////////////
//DELETE MODAL
	function delMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM client_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['client_id']);
				$client_username = mysqli_real_escape_string($_CON, $row['client_username']);
				$first_name = mysqli_real_escape_string($_CON, $row['first_name']);
				$last_name = mysqli_real_escape_string($_CON, $row['last_name']);
				$gender = mysqli_real_escape_string($_CON, $row['gender']);
				$civil_stats = mysqli_real_escape_string($_CON, $row['civil_stats']);
				$address = mysqli_real_escape_string($_CON, $row['address']);
				$birthdate = mysqli_real_escape_string($_CON, $row['birthdate']);
				$birthplace = mysqli_real_escape_string($_CON, $row['birthplace']);
				$member_type = mysqli_real_escape_string($_CON, $row['member_type']);
				$account_status = mysqli_real_escape_string($_CON, $row['account_status']);
				$account_code = mysqli_real_escape_string($_CON, $row['account_code']);
				//MEMBER TYPE TO TEXT
				if($member_type == 1){
					$mem_type = "Regular";
				}elseif($member_type == 2){
					$mem_type = "Associative";
				}
				// CHECK IF THIS ACCOUNT HAS LOAN
				$sqlChecker = mysqli_query($_CON,"SELECT loan_id FROM loan_table WHERE client_id='$_ID'");
				$CountLoans = mysqli_num_rows($sqlChecker);
				if($CountLoans == 0){
					echo"
					<div class='modal fade' id='delMOD$_ID'>
						<div class='modal-dialog'>
							<div class='modal-content'>
								<form method='post' action='"; delAction(); echo"'>
									<!-- Modal heading -->
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
										<h3 class='modal-title'>
											<strong>Are you sure you want to delete this account?</strong>
										</h3>
									</div>
									<!-- // Modal heading END -->
									<!-- Modal body -->
									<div class='modal-body'>
										<h3>$last_name, $first_name ($mem_type)</h3>
										<h4>Gender: $gender</h4>
										<h4>Civil Status: $civil_stats</h4>
										<h4>Address: $address</h4>
										<h4>Birthdate: $birthdate</h4>
										<h4>Birth place: $birthplace</h4>
									</div>
									<!-- // Modal body END -->
									<!-- Modal footer -->
									<div class='modal-footer'>
										<input type='hidden' value='$_ID' name='DEL_ID'>
										<a href='#' class='btn btn-default' data-dismiss='modal'>No</a>
										<button type='submit' class='btn btn-primary' name='btn_del'>Delete</button>
									</div>
									<!-- // Modal footer END -->
								</form>
							</div>
						</div>
					</div>";
				}
			}
		}
	}
	
/////////////////////////////////////////////
//DELETE MODAL
	function delAction(){
		global $_CON;
		if(isset($_POST['btn_del'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['DEL_ID']);
			$sqlDel = mysqli_query($_CON, "DELETE FROM client_table WHERE client_id='$_ID' ");
			if($sqlDel){
				ob_end_clean();
				header("location: clients.php?del=true");
			}else{
				ob_end_clean();
				header("location: clients.php?del=false");
			}
		}
	}

/////////////////////////////////////////////
//BAN MODAL
	function banMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM client_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['client_id']);
				$client_username = mysqli_real_escape_string($_CON, $row['client_username']);
				$first_name = mysqli_real_escape_string($_CON, $row['first_name']);
				$last_name = mysqli_real_escape_string($_CON, $row['last_name']);
				$gender = mysqli_real_escape_string($_CON, $row['gender']);
				$civil_stats = mysqli_real_escape_string($_CON, $row['civil_stats']);
				$address = mysqli_real_escape_string($_CON, $row['address']);
				$birthdate = mysqli_real_escape_string($_CON, $row['birthdate']);
				$birthplace = mysqli_real_escape_string($_CON, $row['birthplace']);
				$member_type = mysqli_real_escape_string($_CON, $row['member_type']);
				$account_status = mysqli_real_escape_string($_CON, $row['account_status']);
				$account_code = mysqli_real_escape_string($_CON, $row['account_code']);
				//MEMBER TYPE TO TEXT
				if($member_type == 1){
					$mem_type = "Regular";
				}elseif($member_type == 2){
					$mem_type = "Associative";
				}
				echo"
				<div class='modal fade' id='banMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; banAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Are you sure you want to ban this account?</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$last_name, $first_name ($mem_type)</h3>
									<h4>Gender: $gender</h4>
									<h4>Civil Status: $civil_stats</h4>
									<h4>Address: $address</h4>
									<h4>Birthdate: $birthdate</h4>
									<h4>Birth place: $birthplace</h4>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$_ID' name='BAN_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>No</a>
									<button type='submit' class='btn btn-primary' name='btn_ban'>Yes</button>
								</div>
								<!-- // Modal footer END -->
							</form>
						</div>
					</div>
				</div>";
			}
		}
	}
/////////////////////////////////////////////
//BAN ACTION
	function banAction(){
		global $_CON;
		if(isset($_POST['btn_ban'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['BAN_ID']);
			$sqlBan = mysqli_query($_CON, "UPDATE client_table SET account_status=3 WHERE client_id='$_ID' ");
			if($sqlBan){
				header("location: clients.php?ban=true");
				ob_end_clean();
				exit;
			}
		}
	}

/////////////////////////////////////////////
// ACTIVATE CLIENT 
	function activs_client(){
		global $_CON;
		if(isset($_POST['btn_activ'])){
			$inpAccountCode = mysqli_real_escape_string($_CON, $_POST['inpAccountCode']);
			$sqlCheck = mysqli_query($_CON, "SELECT client_id FROM client_table WHERE account_code='$inpAccountCode' AND account_status=0 OR account_status=3");
			$count = mysqli_num_rows($sqlCheck);
			if($count > 0){
				$rowID = mysqli_fetch_array($sqlCheck);
				$_ID = $rowID['client_id'];
				$sqlUpdate = mysqli_query($_CON, "UPDATE client_table SET account_status=1 WHERE client_id='$_ID' ");
				ob_end_clean();
				header("location: clients.php?account=activated");
			}else{
				ob_end_clean();
				header("location: clients.php?account=not_exist");
			}
		}
	}

////////////////////////
// UNIQUE ID GENERATOR
function unqID($length = 6) {
    $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    echo "$randomString";
}
