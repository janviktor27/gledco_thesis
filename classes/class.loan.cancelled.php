<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 * Proprietary and confidential
 */
//////////////////////////////////////////////////////
// 0-Requested 1-Approved 2-DECLINED 3-Cancelled 4-PAID
//////////////////////////////////////////////////////
include_once('connect.php');
include_once'class.whois.php';
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
		date_requested
		FROM
		loan_table
		WHERE
		client_id='$usr_ID'
		AND
		loan_status=3
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
				$sqlCheck = mysqli_query($_CON, "SELECT payment_id,payment_amount FROM payment_table WHERE loan_id='$_ID'");
				$countCheck = mysqli_num_rows($sqlCheck);
				if($countCheck > 0){
					$bal = "ON PROGRESS";
					$months_to_pay = $months_to_pay - $countCheck;
				}else{
					$bal = $loan_amount;
				}
				echo"
				<tr>
					<td>$title_type</td>
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
			  <td colspan='7'>No data yet. </td>
			 </tr>
			";
		}
	}
	