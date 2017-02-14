<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');
//////////////////////////////////////////////////////
// 0-Requested 1-Approved 2-Disapproved 3-Cancelled
//////////////////////////////////////////////////////
date_default_timezone_set('Asia/Manila');
$_NOW = date("Y-m-d H:i:s"); 
/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=0 ORDER BY date_requested DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$year_to_pay = mysqli_real_escape_string($_CON, $row['year_to_pay']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$net_worth = mysqli_real_escape_string($_CON, $row['net_worth']);
				$tot_bal = $months_to_pay * $monthly_amount;
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
				$date_requested = New DateTime($row['date_requested']);
				$date_format = date_format($date_requested, 'M d, Y H:i:A');
				echo"
				 <tr>
				  <td>$last_name, $first_name($mem_type)</td>
				  <td>$title</td>
				  <td>$loan_amount</td>
				  <td>$tot_bal</td>
				  <td>$year_to_pay Years($months_to_pay months)</td>
				  <td>$net_worth</td>
				  <td>$monthly_amount</td>
				  <td>$date_format</td>
				  <td class='center'>
				   <button class='btn btn-info btn-xs' data-toggle='modal' data-target='#aprvMOD$_ID'><i class='fa fa-check'></i></button>
				   <button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#dsaprvMOD$_ID'><i class='fa fa-times'></i></button>
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
//APPROVE MODAL
	function aprvMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=0 ORDER BY date_requested DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
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
				$date_requested = New DateTime($row['date_requested']);
				$date_requested = date_format($date_requested, "M d, Y h:i:A");
				echo"
				<div class='modal fade' id='aprvMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; aprvAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Are you sure you want to approve ?</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$last_name, $first_name ($mem_type)</h3>
									<h4>$title</h4>
									<h4>Loan Amount: $loan_amount</h4>
									<h4>Date Requested: $date_requested</h4>
									<br>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$_ID' name='APRV_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Close</a>
									<button type='submit' class='btn btn-primary' name='btn_aprv'>Approve</button>
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
//APPROVE ACTION
	function aprvAction(){
		global $_CON;
		global $_NOW;
		if(isset($_POST['btn_aprv'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['APRV_ID']);
			//UPDATE QUERY
			$sqlUpdate = mysqli_query($_CON,"UPDATE loan_table SET
			loan_status=1,
			date_approved='$_NOW'
			WHERE loan_id='$_ID' ");
			ob_end_clean();
			header("location: client.request.php?approved=true");
		}
	}
	
/////////////////////////////////////////////
// DISAPPROVE MODAL
	function dsaprvMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=0 ORDER BY date_requested DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
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
				$date_requested = mysqli_real_escape_string($_CON, $row['date_requested']);

				echo"
				<div class='modal fade' id='dsaprvMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; dsaprvAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>This will disapprove the loan request.</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$last_name, $first_name ($mem_type)</h3>
									<h4>$title</h4>
									<h4>Loan Amount: $loan_amount</h4>
									<h4>Date Requested: $date_requested</h4>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$_ID' name='DSAPRV_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Close</a>
									<button type='submit' class='btn btn-primary' name='btn_dsaprv'>Disapprove</button>
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
//APPROVE ACTION
	function dsaprvAction(){
		global $_CON;
		if(isset($_POST['btn_dsaprv'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['DSAPRV_ID']);
			//UPDATE QUERY
			$sqlUpdate = mysqli_query($_CON,"UPDATE loan_table SET
			loan_status=2
			WHERE loan_id='$_ID' ");
			ob_end_clean();
			header("location: client.request.php?disapproved=true");
		}
	}
