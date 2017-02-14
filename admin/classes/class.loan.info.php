<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');
////////////////////////////////////////////////////////
// 0-Requested 1-Approved 2-DECLINED 3-Cancelled 4-PAID
////////////////////////////////////////////////////////
date_default_timezone_set('Asia/Manila');
$_NOW = date("Y-m-d H:i:s"); 
/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=1 ORDER BY date_approved DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$total_bal = $months_to_pay * $monthly_amount;
				$date_approved = New DateTime($row['date_approved']);
				// GET LOAN INFO
				$sqlLoan = mysqli_query($_CON,"SELECT title FROM loan_type WHERE type_id='$type_id' ");
				$rowLoan = mysqli_fetch_array($sqlLoan);
				$title = $rowLoan['title'];
				//END GET LOAN
				$client_id = mysqli_real_escape_string($_CON, $row['client_id']);
				// GET CLIENT INFO
				$sqlClient = mysqli_query($_CON,"SELECT first_name, last_name, member_type FROM client_table WHERE client_id='$client_id' ");
				$row_Client = mysqli_fetch_array($sqlClient);
				$first_name = $row_Client['first_name'];
				$last_name = $row_Client['last_name'];
				$member_type = $row_Client['member_type'];
				if($member_type == 1){
					$mem_type = "Regular";
				}else{
					$mem_type = "Associative";
				}
				///////////////
				//END
				$loan_amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$year_to_pay = mysqli_real_escape_string($_CON, $row['year_to_pay']);
				//////////////////////////////////////
				//CHECK IF THIS LOAN HAS PAYMENTS
				$sqlPayment = mysqli_query($_CON, "SELECT * FROM payment_table WHERE loan_id='$_ID' ");
				$paymentCount = mysqli_num_rows($sqlPayment);
				if($paymentCount > 0){
					//MONTHS REMAINING
					$months_to_pay = $months_to_pay - $paymentCount;
					$prod = $monthly_amount * $months_to_pay;
					$paid_amount = $total_bal - $prod;
					$balance = $total_bal - $paid_amount;
				}else{
					$paid_amount = 0;
					$balance = $total_bal;
				}
				$date_format = date_format($date_approved, 'M d, Y h:i:A');
				echo"
				 <tr>
				  <td>$last_name, $first_name($mem_type)</td>
				  <td class='center'>$title</td>
				  <td class='center'>$loan_amount</td>
				  <td class='center'>$balance</td>
				  <td class='center'>$paid_amount</td>
				  <td class='center'>$months_to_pay</td>
				  <td class='center'>$monthly_amount</td>
				  <td class='center'>$date_format</td>
				  <td class='center'>
				   <button class='btn btn-info btn-xs' data-toggle='modal' data-target='#infoMOD$_ID'><i class='fa fa-info'></i></button>
				   <button class='btn btn-success btn-xs' data-toggle='modal' data-target='#monthlyMOD$_ID'><i class='fa fa-dollar'></i></button>
				   <button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#cashMOD$_ID'><i class='fa fa-money'></i></button>
				  </td>
				 </tr>
				";
			}
		}else{
			echo"
			 <tr>
			  <td colspan='9'>No data yet. </td>
			 </tr>
			";
		}
	}

/////////////////////////////////////////////
//MONTHLY MODAL
	function payMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=1 ORDER BY date_approved DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$total_bal = $months_to_pay * $monthly_amount;
				// GET LOAN INFO
				$sqlLoan = mysqli_query($_CON,"SELECT title FROM loan_type WHERE type_id='$type_id' ");
				$rowLoan = mysqli_fetch_array($sqlLoan);
				$title = $rowLoan['title'];
				//END GET LOAN
				$client_id = mysqli_real_escape_string($_CON, $row['client_id']);
				// GET CLIENT INFO
				$sqlClient = mysqli_query($_CON,"SELECT first_name, last_name, member_type FROM client_table WHERE client_id='$client_id' ");
				$row_Client = mysqli_fetch_array($sqlClient);
				$first_name = $row_Client['first_name'];
				$last_name = $row_Client['last_name'];
				$member_type = $row_Client['member_type'];
				if($member_type == 1){
					$mem_type = "Regular Member";
				}else{
					$mem_type = "Associative Member";
				}
				///////////////
				//END
				$loan_amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$date_approved = New DateTime($row['date_approved']);
				//////////////////////////////////////
				//CHECK IF THIS LOAN HAS PAYMENTS
				$sqlPayment = mysqli_query($_CON, "SELECT * FROM payment_table WHERE loan_id='$_ID' ");
				$paymentCount = mysqli_num_rows($sqlPayment);
				if($paymentCount > 0){
					//MONTHS REMAINING
					$months_to_pay = $months_to_pay - $paymentCount;
					$prod = $monthly_amount * $months_to_pay;
					$paid_amount = $total_bal - $prod;
					$balance = $total_bal - $paid_amount;
				}else{
					$paid_amount = 0;
					$balance = $total_bal;
				}
				$date_format = date_format($date_approved, 'M d, Y H:i:A');

				echo"
				<div class='modal fade' id='monthlyMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; paidAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>$last_name, $first_name is paying $monthly_amount</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$title</h3>
									<h4>Loan amount: $loan_amount</h4>
									<h4>Loan balance: $balance</h4>
									<h4>Paid amount: $paid_amount</h4>
									<h4>Months remaining: $months_to_pay</h4>
									<h4>Monthly payment: $monthly_amount</h4>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$balance' name='BALANCE'>
									<input type='hidden' value='$client_id' name='client_id'>
									<input type='hidden' value='$monthly_amount' name='inpMonthly_amount'>
									<input type='hidden' value='$_ID' name='PAID_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Cancel</a>
									<button type='submit' class='btn btn-primary' name='btn_paid'>Confirm</button>
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
//PAID ACTION
	function paidAction(){
		global $_CON;
		global $_NOW;
		if(isset($_POST['btn_paid'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['PAID_ID']);
			$balance = mysqli_real_escape_string($_CON, $_POST['BALANCE']);
			$inpMonthly_amount = mysqli_real_escape_string($_CON, $_POST['inpMonthly_amount']);
			$client_id = mysqli_real_escape_string($_CON, $_POST['client_id']);
			$difference = $balance - $inpMonthly_amount;
			if($difference == 0){
				//INSERT QUERY
				$sqlInsert = mysqli_query($_CON, "
				INSERT INTO
				payment_table
				(client_id,
				loan_id,
				payment_amount,
				date_paid)
				VALUES
				('$client_id',
				'$_ID',
				'$inpMonthly_amount',
				'$_NOW')");
				//UPDATE LOAN STATS
				$sqlUpdate = mysqli_query($_CON, "
				UPDATE
				loan_table
				SET
				loan_status=4
				WHERE
				loan_id='$_ID' ");
				ob_end_clean();
				header("location: loan.info.php?paid=last");
				exit();
			}else{
				//INSERT QUERY
				$sqlInsert = mysqli_query($_CON, "
				INSERT INTO
				payment_table
				(client_id,
				loan_id,
				payment_amount,
				date_paid)
				VALUES
				('$client_id',
				'$_ID',
				'$inpMonthly_amount',
				'$_NOW')");
				ob_end_clean();
				header("location: loan.info.php?paid=true");
				exit();
			}
		}
	}
	
/////////////////////////////////////////////
//CASH MODAL
	function cashMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=1 ORDER BY date_approved DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$total_bal = $months_to_pay * $monthly_amount;
				// GET LOAN INFO
				$sqlLoan = mysqli_query($_CON,"SELECT title FROM loan_type WHERE type_id='$type_id' ");
				$rowLoan = mysqli_fetch_array($sqlLoan);
				$title = $rowLoan['title'];
				//END GET LOAN
				$client_id = mysqli_real_escape_string($_CON, $row['client_id']);
				// GET CLIENT INFO
				$sqlClient = mysqli_query($_CON,"SELECT first_name, last_name, member_type FROM client_table WHERE client_id='$client_id' ");
				$row_Client = mysqli_fetch_array($sqlClient);
				$first_name = $row_Client['first_name'];
				$last_name = $row_Client['last_name'];
				$member_type = $row_Client['member_type'];
				if($member_type == 1){
					$mem_type = "Regular Member";
				}else{
					$mem_type = "Associative Member";
				}
				///////////////
				//END
				$loan_amount = mysqli_real_escape_string($_CON, $row['loan_amount']);
				$date_approved = New DateTime($row['date_approved']);
				//////////////////////////////////////
				//CHECK IF THIS LOAN HAS PAYMENTS
				$sqlPayment = mysqli_query($_CON, "SELECT * FROM payment_table WHERE loan_id='$_ID' ");
				$paymentCount = mysqli_num_rows($sqlPayment);
				if($paymentCount > 0){
					//MONTHS REMAINING
					$months_to_pay = $months_to_pay - $paymentCount;
					$prod = $monthly_amount * $months_to_pay;
					$paid_amount = $total_bal - $prod;
					$balance = $total_bal - $paid_amount;
				}else{
					$paid_amount = 0;
					$balance = $total_bal;
				}
				$date_format = date_format($date_approved, 'M d, Y H:i:A');

				echo"
				<div class='modal fade' id='cashMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; cashAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>$last_name, $first_name is paying $balance</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$title</h3>
									<h4>Loan amount: $loan_amount</h4>
									<h4>Loan balance: $balance</h4>
									<h4>Paid Amount: $paid_amount</h4>
									<h4>Months remaining: $months_to_pay</h4>
									<h4>Cash Amount: $balance</h4>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$client_id' name='client_id'>
									<input type='hidden' value='$balance' name='inpCash_Amount'>
									<input type='hidden' value='$_ID' name='PAID_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Cancel</a>
									<button type='submit' class='btn btn-primary' name='btn_cash'>Confirm</button>
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
//CASH ACTION
	function cashAction(){
		global $_CON;
		global $_NOW;
		if(isset($_POST['btn_cash'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['PAID_ID']);
			$inpCash_Amount = mysqli_real_escape_string($_CON, $_POST['inpCash_Amount']);
			$client_id = mysqli_real_escape_string($_CON, $_POST['client_id']);
			//INSERT QUERY
			$sqlInsert = mysqli_query($_CON, "
			INSERT INTO
			payment_table
			(client_id,
			loan_id,
			payment_amount,
			date_paid)
			VALUES
			('$client_id',
			'$_ID',
			'$inpCash_Amount',
			'$_NOW')");
			//UPDATE LOAN STATS
			$sqlUpdate = mysqli_query($_CON, "
			UPDATE
			loan_table
			SET
			loan_status=4
			WHERE
			loan_id='$_ID' ");
			ob_end_clean();
			header("location: loan.info.php?paid=cash");
			exit();
		}
	}
	
/////////////////////////////////////////////
// MORE INFO MODAL
	function infoMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT loan_id FROM loan_table WHERE loan_status=1 ORDER BY date_approved DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				echo"
				<div class='modal fade' id='infoMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Loan information</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<table class='table table-stripped table-bordered'>
										<thead>
											<tr>
												<th>Payment Amount</th>
												<th>Date paid</th>
											</tr>
										</thead>
										<tbody>";
								// FETCH LOAN PAYMENTS ON PAYMENTS_TABLE
								$sqlGET = mysqli_query($_CON,"SELECT * FROM payment_table WHERE loan_id='$_ID' ORDER BY date_paid DESC");
								$countGET = mysqli_num_rows($sqlGET);
								if($countGET > 0){
									while($rowGET=mysqli_fetch_array($sqlGET)){
										$payment_amount = $rowGET['payment_amount'];
										$date_paid = New DateTime($rowGET['date_paid']);
										$date_format = date_format($date_paid, "M d, Y h:i:A");
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
						echo"			</tbody>
									</table>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<a href='#' class='btn btn-primary' data-dismiss='modal'>Close</a>
								</div>
								<!-- // Modal footer END -->
						</div>
					</div>
				</div>";
			}
		}
	}
