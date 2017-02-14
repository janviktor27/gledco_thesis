<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('connect.php');
$usr = $_SESSION['client_usr'];

//Who's Online
	function whois(){
		global $_CON;
		global $usr;
		$sqlSearch = mysqli_query($_CON,"SELECT member_type FROM client_table WHERE client_username='$usr' ");
		$row = mysqli_fetch_array($sqlSearch);
		$member_type = $row['member_type'];
		return $member_type;
	}
	
	function usrID(){
		global $_CON;
		global $usr;
		$sqlSearch = mysqli_query($_CON,"SELECT client_id FROM client_table WHERE client_username='$usr' ");
		$row = mysqli_fetch_array($sqlSearch);
		$client_id = $row['client_id'];
		return $client_id;
	}
?>