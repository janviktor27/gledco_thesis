<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');
/////////////////////////////////////////////
//COUNT LOAN REQUESTS
	function loanRequest(){
		global $_CON;
		$sqlCount = mysqli_query($_CON, "
		SELECT
		loan_id
		FROM
		loan_table
		WHERE
		loan_status=0");
		$count = mysqli_num_rows($sqlCount);
		echo $count;
	}

/////////////////////////////////////////////
//COUNT APPROVED
	function loanApproved(){
		global $_CON;
		$sqlCount = mysqli_query($_CON, "
		SELECT
		loan_id
		FROM
		loan_table
		WHERE
		loan_status=1");
		$count = mysqli_num_rows($sqlCount);
		echo $count;
	}
	
/////////////////////////////////////////////
//COUNT DECLINED
	function loanDeclined(){
		global $_CON;
		$sqlCount = mysqli_query($_CON, "
		SELECT
		loan_id
		FROM
		loan_table
		WHERE
		loan_status=2");
		$count = mysqli_num_rows($sqlCount);
		echo $count;
	}

/////////////////////////////////////////////
//COUNT CANCELLED
	function loanCancelled(){
		global $_CON;
		$sqlCount = mysqli_query($_CON, "
		SELECT
		loan_id
		FROM
		loan_table
		WHERE
		loan_status=3");
		$count = mysqli_num_rows($sqlCount);
		echo $count;
	}

/////////////////////////////////////////////
//COUNT PAID
	function loanPaid(){
		global $_CON;
		$sqlCount = mysqli_query($_CON, "
		SELECT
		loan_id
		FROM
		loan_table
		WHERE
		loan_status=4");
		$count = mysqli_num_rows($sqlCount);
		echo $count;
	}

/////////////////////////////////////////////
//COUNT CLIENTS
	function clientCount(){
		global $_CON;
		$sqlCount = mysqli_query($_CON, "
		SELECT
		client_id
		FROM
		client_table");
		$count = mysqli_num_rows($sqlCount);
		echo $count;
	}
