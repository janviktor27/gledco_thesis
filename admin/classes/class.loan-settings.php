<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');
 
/////////////////////////////////////////////
//Add loan type
	function add(){
		global $_CON;
		if(isset($_POST['btn_add'])){
			$type_id = type_id();
			if($type_id == 11 || $type_id == 13){
				// SPECIAL RULES
				$inpMONS = mysqli_real_escape_string($_CON, $_POST['inpMONS']);
				if($inpMONS == 12){$inpYEARS = 1;}else{$inpYEARS = 0;}
				$inpLOANAMNT = mysqli_real_escape_string($_CON, $_POST['inpLOANAMNT']);
				$inpMONAMNT = mysqli_real_escape_string($_CON, $_POST['inpMONAMNT']);
				$inpNET = mysqli_real_escape_string($_CON, $_POST['inpNET']);
				//CHECK IF SAME LOAN AMOUNT EXIST
				$sqlSearch = mysqli_query($_CON, "SELECT type_id, years_to_pay, amount FROM loan_type_settings WHERE type_id='$type_id' AND monthly_amount='$inpMONAMNT' ");
				$count = mysqli_num_rows($sqlSearch);
				$enc_ID = urlencode(base64_encode($type_id));
				if($count > 0){
					ob_end_clean();
					header("location: loantype.settings.php?query=$enc_ID&add=exist");
				}else{
					$sqlInsert = mysqli_query($_CON, "INSERT INTO loan_type_settings 
					(type_id,
					 years_to_pay,
					 months_to_pay,
					 loan_amount,
					 monthly_amount,
					 net_worth)
					VALUES
					('$type_id',
					'$inpYEARS',
					'$inpMONS',
					'$inpLOANAMNT',
					'$inpMONAMNT',
					'$inpNET')");
					ob_end_clean();
					header("location: loantype.settings.php?query=$enc_ID&add=true");
				}
				//////////////////////////////////////////////////////////////////////////////
				//END OF SPECIAL RULES
			}else{
			$inpYEARS = mysqli_real_escape_string($_CON, $_POST['inpYEARS']);
			$inpMONS = $inpYEARS * 12;
			$inpLOANAMNT = mysqli_real_escape_string($_CON, $_POST['inpLOANAMNT']);
			$inpMONAMNT = mysqli_real_escape_string($_CON, $_POST['inpMONAMNT']);
			$inpNET = mysqli_real_escape_string($_CON, $_POST['inpNET']);
			//CHECK IF EIN EXIST
			$sqlSearch = mysqli_query($_CON, "SELECT type_id, years_to_pay, amount FROM loan_type_settings WHERE type_id='$type_id' AND years_to_pay='$inpYEARS' AND monthly_amount='$inpMONAMNT' ");
			$count = mysqli_num_rows($sqlSearch);
			$enc_ID = urlencode(base64_encode($type_id));
			if($count > 0){
				ob_end_clean();
				header("location: loantype.settings.php?query=$enc_ID&add=exist");
			}else{
				$sqlInsert = mysqli_query($_CON, "INSERT INTO loan_type_settings 
				(type_id, 
				 years_to_pay,
				 months_to_pay,
				 loan_amount,
				 monthly_amount,
				 net_worth)
				VALUES
				('$type_id',
				'$inpYEARS',
				'$inpMONS',
				'$inpLOANAMNT',
				'$inpMONAMNT',
				'$inpNET')");
				ob_end_clean();
				header("location: loantype.settings.php?query=$enc_ID&add=true");
			}
			}
		}
	}
	
	function dynamicForm(){
		$type_id = type_id();
		if($type_id == 11 || $type_id == 13){
			echo"
						<form method='post' action='"; add(); echo"'>
							<div class='widget-body'>
								<label>Months to pay</label>
								<select class='form-control' name='inpMONS' required>
									<option value='' default>Months to pay</option>
									<option value='6'>6 months</option>
									<option value='8'>8 months</option>
									<option value='12'>12 months</option>
									<option value='15'>15 months</option>
									<option value='18'>18 months</option>
								</select>
								<label>Loan Amount</label>
								<input type='number' name='inpLOANAMNT' placeholder='Loan Amount' class='form-control' required />
								<label>Net </label>
								<input type='number' name='inpNET' placeholder='Net' class='form-control' required />
								<label>Monthly Amount </label>
								<input type='number' name='inpMONAMNT' placeholder='Monthly Amount' class='form-control' required />

								<br>
								<div class='pull-right'>
									<button type='submit' name='btn_add' class='btn btn-success'>Add</button>
								</div>
							</div>
						</form>
			";
		}else{
			echo"
						<form method='post' action='"; add(); echo"'>
							<div class='widget-body'>
								<label>Years to pay</label>
								<select class='form-control' name='inpYEARS' required>
									<option value='' default>Years to pay</option>
									";optYears(); echo"
								</select>
								<label>Loan Amount</label>
								<input type='number' name='inpLOANAMNT' placeholder='Loan Amount' class='form-control' required />
								<label>Net </label>
								<input type='number' name='inpNET' placeholder='Net' class='form-control' required />
								<label>Monthly Amount </label>
								<input type='number' name='inpMONAMNT' placeholder='Monthly Amount' class='form-control' required />

								<br>
								<div class='pull-right'>
									<button type='submit' name='btn_add' class='btn btn-success'>Add</button>
								</div>
							</div>
						</form>
			";
		}
	}
	

/////////////////////////////////////////////
// DYNAMIC TITLE 
	function loantitle(){
		global $_CON;
		$type_id = type_id();
		$sqlSearch = mysqli_query($_CON, "SELECT title FROM loan_type WHERE type_id='$type_id' ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0 ){
			$row = mysqli_fetch_array($sqlSearch);
			$title = $row['title'];
			return $title;
		}else{
			ob_end_clean();
			header("location: loantypes.php?errno=403");
		}
	}
/////////////////////////////////////////////
// DECODE URL GET TYPE_ID
	function type_id(){
		if(isset($_GET['query'])){
			$dec_type_id = urldecode(base64_decode($_GET['query']));
			return $dec_type_id;
		}
	}
/////////////////////////////////////////////
// OPTION YEARS
	function optYears(){
		for($num1= 0;$num1 <= 15;$num1++){
			if($num1 == 1 || $num1 == 0 || $num1 == 7 || $num1 == 9 || $num1 == 11 || $num1 == 13 || $num1 == 14){
				echo "";
			}else{
				echo "
					<option value='$num1'>$num1 Years</option>
				";
			}
		}
	}

/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$type_id = type_id();
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_type_settings WHERE type_id='$type_id' ORDER BY loan_amount DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_setting_id']);
				$years_to_pay = mysqli_real_escape_string($_CON, $row['years_to_pay']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$net_worth = mysqli_real_escape_string($_CON, $row['net_worth']);
				$enc_ID = urlencode(base64_encode($_ID));
				echo"
				 <tr>
				  <td class='center'>$years_to_pay</td>
				  <td class='center'>$months_to_pay</td>
				  <td class='center'>$amount</td>
				  <td class='center'>$net_worth</td>
				  <td class='center'>$monthly_amount</td>
				  <td class='center'>
				   <button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#delMOD$_ID'><i class='fa fa-trash-o'></i></button>
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
//DELETE MODAL
	function delMod(){
		global $_CON;
		$type_id = type_id();
		$loan_title = loantitle();
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_type_settings WHERE type_id='$type_id' ORDER BY loan_amount DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_setting_id']);
				$years_to_pay = mysqli_real_escape_string($_CON, $row['years_to_pay']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$net_worth = mysqli_real_escape_string($_CON, $row['net_worth']);
				$enc_ID = urlencode(base64_encode($_ID));
				echo"
				<div class='modal fade' id='delMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; delAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Are you sure you want to delete this option?</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$loan_title</h3>
									<h5>Years: $years_to_pay</h5>
									<h5>Months: $months_to_pay</h5>
									<h5>Loan Amount: $amount</h5>
									<h5>Monthly Amount: $monthly_amount</h5>
									<h5>NET: $net_worth</h5>
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
	
	/////////////////////////////////////////////
//DELETE MODAL
	function delAction(){
		global $_CON;
		if(isset($_POST['btn_del'])){
			$type_id = type_id();
			$enc_ID = urlencode(base64_encode($type_id));
			$_ID = mysqli_real_escape_string($_CON, $_POST['DEL_ID']);
			$sqlDel = mysqli_query($_CON, "DELETE FROM loan_type_settings WHERE loan_setting_id='$_ID' ");
			if($sqlDel){
				ob_end_clean();
				header("location: loantype.settings.php?query=$enc_ID&del=true");
			}else{
				ob_end_clean();
				header("location: loantype.settings.php?query=$enc_ID&del=false");
			}
		}
	}
?>