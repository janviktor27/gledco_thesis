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
$_NOW = date("Y-m-d H:i:s"); 
/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_table WHERE loan_status=2 ORDER BY date_requested DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['loan_id']);
				$type_id = mysqli_real_escape_string($_CON, $row['type_id']);
				$year_to_pay = mysqli_real_escape_string($_CON, $row['year_to_pay']);
				$months_to_pay = mysqli_real_escape_string($_CON, $row['months_to_pay']);
				$monthly_amount = mysqli_real_escape_string($_CON, $row['monthly_amount']);
				$net_worth = mysqli_real_escape_string($_CON, $row['net_worth']);
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
				  <td>$year_to_pay Years($months_to_pay months)</td>
				  <td>$net_worth</td>
				  <td>$monthly_amount</td>
				  <td>$date_format</td>
				 </tr>
				";
			}
		}else{
			echo"
			 <tr>
			  <td colspan='5'>No data yet. </td>
			 </tr>
			";
		}
	}