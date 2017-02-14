<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 * Proprietary and confidential
 */
//////////////////////////////////////////////////////
// 0-Requested 1-Approved 2-Disapproved 3-Cancelled 4-PAID
//////////////////////////////////////////////////////
include_once('connect.php');
include_once'class.whois.php';
date_default_timezone_set('Asia/Manila');
$_NOW = date("Y-m-d H:i:s"); 

/////////////////////////////////////////////
// VIEW APPROVED LOANS
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
		date_approved
		FROM
		loan_table
		WHERE
		client_id='$usr_ID'
		AND
		loan_status=1
		ORDER
		BY
		date_approved
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
				$date_approved = new DateTime($row['date_approved']);
				$total_bal = $months_to_pay * $monthly_amount;
				
				//TYPE ID TO REAL VALUE
				$sqlType_ID = mysqli_query($_CON,"SELECT title FROM loan_type WHERE type_id='$type_id' ");
				$row_type_id = mysqli_fetch_array($sqlType_ID);
				$title_type = $row_type_id['title'];
				$date_format = date_format($date_approved, 'M d, Y h:i:A');
				//END TYPE ID TO REAL VALUE
				$sqlCheck = mysqli_query($_CON, "SELECT payment_id,payment_amount FROM payment_table WHERE loan_id='$_ID'");
				$countCheck = mysqli_num_rows($sqlCheck);
				if($countCheck > 0){
					$months_to_pay = $months_to_pay - $countCheck;
					$prod = $monthly_amount * $months_to_pay;
					$paid_amount = $total_bal - $prod;
					$balance = $total_bal - $paid_amount;
				}else{
					$paid_amount = 0;
					$balance = $total_bal;
				}
				echo"
				<tr>
					<td>$title_type</td>
					<td>$loan_amount</td>
					<td>$balance</td>
					<td>$paid_amount</td>
					<td>$months_to_pay</td>
					<td>$monthly_amount</td>
					<td>$date_format</td>
					<td class='center'>
						<button data-target='#modLoanInfo$_ID' data-toggle='modal' class='btn btn-info btn-xs'><i class='fa fa-info'></i></button>
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
//MORE INFO MODAL
	function modLoanInfo(){
		global $_CON;
		$usr_ID = usrID();
		$sqlSearch = mysqli_query($_CON,
		"SELECT
		loan_id
		FROM
		loan_table
		WHERE
		client_id='$usr_ID'
		AND
		loan_status=1
		ORDER
		BY
		date_approved
		DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
			$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
			echo "
					<div class='modal fade' id='modLoanInfo$_ID'>
						<div class='modal-dialog'>
							<div class='modal-content'>

								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'><strong>Loan information</strong></h3>
								</div>
								<!-- // Modal heading END -->
								
								<!-- Modal body -->
								<div class='modal-body'>
									<table class='table table-stripped table-bordered'>
										<thead>
										<tr>
											<th>Monthly Payment</th>
											<th>Date Paid</th>
										</tr>
										</thead>
										<tbody>";
										$sqlSearch2 = mysqli_query($_CON,"
										SELECT
										payment_amount,
										date_paid
										FROM
										payment_table
										WHERE
										loan_id='$_ID'
										ORDER 
										BY
										date_paid
										DESC");
										$_count = mysqli_num_rows($sqlSearch2);
										if($_count > 0){
											while($_row=mysqli_fetch_array($sqlSearch2)){
												$payment_amount = $_row['payment_amount'];
												$date_paid = New DateTime($_row['date_paid']);
												$date_format = date_format($date_paid, 'M d, Y h:i:A');
												echo"
												<tr>
												 <td>$payment_amount</td>
												 <td>$date_format</td>
												</tr>
												";
											}
										}else{
										echo"
											<tr>
											 <td colspan='2'>No data yet.</td>
											</tr>
											";
										}
							echo"		</tbody>
									</table>
								</div>
								<div class='modal-footer'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Close</a> 
								</div>
							</div>
						</div>
					</div>			
			";
			}
		}
	}

?>