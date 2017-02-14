<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
	function logout(){
		if(isset($_GET['out'])){
			if(isset($_COOKIE["client_usr"])) {
				setcookie("client_usr", '', strtotime( '-5 days' ), '/');
			}
			session_destroy();
			header("location: login.php?session=false");
			ob_end_clean();
		}
	}