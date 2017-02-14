<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
//////////////////////////////////////////////////////
// 0-Requested 1-Approved 2-Disapproved 3-Cancelled 4-PAID
//////////////////////////////////////////////////////
include_once('connect.php');
include_once'class.whois.php';
date_default_timezone_set('Asia/Manila');
$_NOW = date("Y-m-d H:i:s"); 

/////////////////////////////////////////////
//USER ADD LOAN !
	function add(){
		global $_CON;
		global $_NOW;
		if(isset($_POST['btn_add'])){
			$usr_ID = usrID();
			$inpLoanType = mysqli_real_escape_string($_CON, $_POST['inpLoanType']);
			$inpLoanAmount = mysqli_real_escape_string($_CON, $_POST['inpLoanAmount']);
			$inpYears = mysqli_real_escape_string($_CON, $_POST['inpYears']);
			//CHECK IF SAME LOAN TYPE EXIST FOR THE SAME USER !
			$sqlSearch = mysqli_query($_CON, "SELECT client_id, type_id FROM loan_table WHERE client_id='$usr_ID' AND type_id='$inpLoanType' AND loan_status=0 ");
			$count = mysqli_num_rows($sqlSearch);
			if($count > 0){
				ob_end_clean();
				header("location: loan.request.php?add=exist");
			}else{
				$sqlGet = mysqli_query($_CON, "SELECT monthly_amount, net_worth, months_to_pay FROM loan_type_settings WHERE type_id='$inpLoanType' AND years_to_pay='$inpYears' AND loan_amount='$inpLoanAmount' ");
				$countGet = mysqli_num_rows($sqlGet);
				if($countGet == 1){
					$row = mysqli_fetch_array($sqlGet);
					$monthly_amount = $row['monthly_amount'];
					$net_worth = $row['net_worth'];
					$months_to_pay = $row['months_to_pay'];
					$sqlInsert = mysqli_query($_CON, "
					INSERT
					INTO
					loan_table 
					(type_id,
					client_id,
					loan_amount,
					loan_status,
					year_to_pay,
					months_to_pay,
					monthly_amount,
					net_worth,
					date_requested)
					VALUES(
					'$inpLoanType',
					'$usr_ID',
					'$inpLoanAmount',
					'0',
					'$inpYears',
					'$months_to_pay',
					'$monthly_amount',
					'$net_worth',
					'$_NOW')");
					ob_end_clean();
					header("location: loan.request.php?add=true");
				}else{
					ob_end_clean();
					header("location: loan.request.php?errno=403");
				}
			}
		}
	}

/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$usr_ID = usrID();
		$sqlSearch = mysqli_query($_CON,
		"SELECT
		loan_id,
		type_id,
		loan_amount,
		year_to_pay,
		months_to_pay,
		monthly_amount,
		net_worth,
		date_requested
		FROM
		loan_table
		WHERE
		client_id='$usr_ID'
		AND
		loan_status=0
		ORDER
		BY
		date_requested
		DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$loan_amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$year_to_pay = mysqli_real_escape_string($_CON, $row['year_to_pay']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$net_worth = mysqli_real_escape_string($_CON, $row['net_worth']);
				$date_requested = new DateTime($row['date_requested']);
				$tot_bal = $monthly_amount * $months_to_pay;
				
				//TYPE ID TO REAL VALUE
				$sqlType_ID = mysqli_query($_CON,"SELECT title FROM loan_type WHERE type_id='$type_id' ");
				$row_type_id = mysqli_fetch_array($sqlType_ID);
				$title_type = $row_type_id['title'];
				$date_format = date_format($date_requested, 'M d, Y h:i:A');
				//END TYPE ID TO REAL VALUE
				echo"
				<tr>
					<td>$title_type</td>
					<td>$loan_amount</td>
					<td>$tot_bal</td>
					<td>$year_to_pay Years ($months_to_pay months)</td>
					<td>$net_worth</td>
					<td>$monthly_amount</td>
					<td>$date_format</td>
					<td class='center'>
						<button data-target='#delMod$_ID' data-toggle='modal' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></button>
					</td>
				</tr>
				";
			}
		}else{
			echo"
			 <tr>
			  <td colspan='8'>No data yet. </td>
			 </tr>
			";
		}
	}
	
/////////////////////////////////////////////
// DELETE MODAL
	function delMod(){
		global $_CON;
		$usr_ID = usrID();
		$sqlSearch = mysqli_query($_CON,
		"SELECT
		loan_id,
		type_id,
		loan_amount,
		year_to_pay,
		months_to_pay,
		monthly_amount,
		net_worth,
		date_requested
		FROM
		loan_table
		WHERE
		client_id='$usr_ID'
		AND
		loan_status=0
		ORDER
		BY
		date_requested
		DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$loan_amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$year_to_pay = mysqli_real_escape_string($_CON, $row['year_to_pay']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$net_worth = mysqli_real_escape_string($_CON, $row['net_worth']);
				$date_requested = new DateTime($row['date_requested']);
				
				//TYPE ID TO REAL VALUE
				$sqlType_ID = mysqli_query($_CON,"SELECT title FROM loan_type WHERE type_id='$type_id' ");
				$row_type_id = mysqli_fetch_array($sqlType_ID);
				$title_type = $row_type_id['title'];
				$date_format = date_format($date_requested, 'M d, Y H:i:A');
				//END TYPE ID TO REAL VALUE
				echo"
					<div class='modal fade' id='delMod$_ID'>
						<div class='modal-dialog'>
							<div class='modal-content'>

								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'><strong>Are you sure you want to cancel this request? </strong></h3>
								</div>
								<!-- // Modal heading END -->
								<form method='POST' action'"; cancelAction(); echo"'>
								<!-- Modal body -->
								<div class='modal-body'>
								<h3>Loan type: $title_type</h3>
								<h4>Loan amount: $loan_amount</h4>
								<h4>Years to pay (in months): $year_to_pay years ($months_to_pay months)</h4>
								<h4>Net: $net_worth</h4>
								<h4>Monthly amount: $monthly_amount</h4>
								<h4>Date Requested: $date_format</h4>
								</div>
								
								<div class='modal-footer'>
									<input type='hidden' name='CANCL_ID' value='$_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>No</a>
									<button class='btn btn-danger' name='btn_del' type='submit' >Yes</button>
								</div>
								</form>
							</div>
						</div>
					</div>			
				";
			}
		}
	}
/////////////////////////////////////////////
// CANCEL LOAN
	function cancelAction(){
		global $_CON;
		if(isset($_POST['CANCL_ID'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['CANCL_ID']);
			$sqlUpdate = mysqli_query($_CON, "UPDATE loan_table SET loan_status=3 WHERE loan_id='$_ID'");
			ob_end_clean();
			header("location: loan.request.php?cancel=true");
		}
	}

/////////////////////////////////////////////
//MORE INFO MODAL
	function modMoreInfo(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT 
		type_id,
		title,
		restriction
		FROM 
		loan_type");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['type_id']);
				$title = mysqli_real_escape_string($_CON, $row['title']);
				$restriction = mysqli_real_escape_string($_CON, $row['restriction']);
				//Restriction To TEXT
				if($restriction == 1){$res = "Regular only";}elseif($restriction == 2){$res = "Regular and Associative";}
				/*<------------------------------------------------------------------>*/
				$sqlSearch2 = mysqli_query($_CON, "
				SELECT
				type_id,
				years_to_pay,
				months_to_pay,
				loan_amount,
				monthly_amount,
				net_worth
				FROM 
				loan_type_settings
				WHERE
				type_id='$_ID'
				ORDER BY 
				loan_amount
				DESC");
				$_count = mysqli_num_rows($sqlSearch2);
				if($_count > 0){
					$current_title = "";
					while($_row=mysqli_fetch_array($sqlSearch2)){
					$years_to_pay = $_row['years_to_pay'];
					$months_to_pay = $_row['months_to_pay'];
					$loan_amount = $_row['loan_amount'];
					$monthly_amount = $_row['monthly_amount'];
					$net_worth = $_row['net_worth'];
					if($years_to_pay == 0){$payment_period = "$months_to_pay months";}
					else{$payment_period = "$years_to_pay years";}
					if($title == $current_title){$title = "";}
					$table_row = "
						<tr>
							<td class='center'>$title</td>
							<td class='center'>$payment_period</td>
							<td class='center'>$loan_amount</td>
							<td class='center'>$net_worth</td>
							<td class='center'>$monthly_amount</td>
							<td class='center'>$res</td>
						</tr>";
					echo($table_row);
					$current_title = $title;
					}
				}
			}
		/*<-------------------------------------------->*/
		/////////////////////////////////////////////////			
		//IF HAS NO DATA YET!
		}else{
			echo "
			<td colspan='6'>No data yet.</td>
			";
		}
	}
/////////////////////////////////////////////
//SELECT OPTION
	function optLoan(){
		$usr_lvl = whois();
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT type_id, title, restriction FROM loan_type ORDER BY title DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['type_id']);
				$title = mysqli_real_escape_string($_CON, $row['title']);
				$restriction = mysqli_real_escape_string($_CON, $row['restriction']);
				if($usr_lvl == 1){
					echo "
					<option value='$_ID'>$title</option>
					";
				}elseif($usr_lvl == 2){
					if($restriction == 2){
						echo "
						<option value='$_ID'>$title</option>
						";
					}
				}
			}
		}else{
			echo"
			<option value=''>No data available.</option>
			";
		}
	}
?>