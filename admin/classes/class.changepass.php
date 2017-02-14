<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');
$USERNAME = $_SESSION['admin_usr'];
/////////////////////////////////////////////
//ChangePassModal
	function changePass(){
					echo"
					<div class='modal fade' id='changePass'>
						<div class='modal-dialog'>
							<div class='modal-content'>
								<form id='passwordForm' onSubmit='return changePasswordko();' method='post' action='"; updPWD(); echo"'>
									<!-- Modal heading -->
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
										<h3 class='modal-title'>
											<strong>Change Password Form</strong>
										</h3>
									</div>
									<!-- // Modal heading END -->
									<!-- Modal body -->
									<div class='modal-body'>
										<label>Old Password </label>
										<input type='password' name='inpOldPassword' placeholder='Old Password' class='form-control' required />
										<label>New Password </label>
										<input id='pass1' type='password' name='inpNewPassword' placeholder='New Password' class='form-control' required />
										<label>Re-type New Password </label>
										<input id='pass2' type='password' name='inpNewPasswordRe' placeholder='Re-type New Password' class='form-control' required />
									</div>
									<!-- // Modal body END -->
									<!-- Modal footer -->
									<div class='modal-footer'>
										<a href='#' class='btn btn-default' data-dismiss='modal'>Cancel</a>
										<button type='submit' class='btn btn-primary' name='btn_upd'>Confirm</button>
									</div>
									<!-- // Modal footer END -->
								</form>
							</div>
						</div>
					</div>";		
	}
/////////////////////////////////////////////
//UPDATE METHOD
	function updPWD(){
		global $_CON;
		global $USERNAME;
		if(isset($_POST['btn_upd'])){
			$inpOldPassword = mysqli_real_escape_string($_CON, $_POST['inpOldPassword']);
			$inpNewPassword = mysqli_real_escape_string($_CON, $_POST['inpNewPassword']);
			$inpNewPasswordRe = mysqli_real_escape_string($_CON, $_POST['inpNewPasswordRe']);
			if($inpNewPassword == $inpNewPasswordRe){
				$sqlSearch = mysqli_query($_CON,"
				SELECT
				password
				FROM
				admin_table
				WHERE
				username='$USERNAME'");
				$row = mysqli_fetch_array($sqlSearch);
				$oldpassword = $row['password'];
				if($oldpassword == md5($inpOldPassword)){
					$inpNewPassword = md5($inpNewPassword);
					$sqlUpdate = mysqli_query($_CON,"
					UPDATE
					admin_table
					SET
					password='$inpNewPassword'
					WHERE username='$USERNAME' ");					
					ob_end_clean();
					header("location: index.php?changepass=true");
				}else{
					ob_end_clean();
					header("location: index.php?changepass=false");
				}
			}else{
				ob_end_clean();
				header("location: index.php?errno=donotmatch");
			}
		}
	}