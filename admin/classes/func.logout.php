<?php
	function logout(){
		if(isset($_GET['out'])){
			$_SESSION = array();
			if(isset($_COOKIE["admin_usr"]) && isset($_COOKIE["password"])) {
				setcookie("admin_usr", '', strtotime( '-5 days' ), '/');
				setcookie("password", '', strtotime( '-5 days' ), '/');
			}
			session_destroy();
			if(isset($_SESSION['admin_usr'])){
				header("location: login.php?session=unknown");
			}else{
				header("location: login.php?session=false");
				ob_end_clean();
			}
		}
	}