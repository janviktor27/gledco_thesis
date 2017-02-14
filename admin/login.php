<?php
session_start();
include'classes/class.login.php';
include'classes/class.VerifyLoggedIn.php';
isOnline();
ob_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full menuh-top sidebar sidebar-full sidebar-dropdown sidebar-width-mini sidebar-hat"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full menuh-top sidebar sidebar-full sidebar-dropdown sidebar-width-mini sidebar-hat"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full menuh-top sidebar sidebar-full sidebar-dropdown sidebar-width-mini sidebar-hat"> <![endif]-->
<!--[if gt IE 8]> <html class="animations ie gt-ie8 fluid top-full menuh-top sidebar sidebar-full sidebar-dropdown sidebar-width-mini sidebar-hat"> <![endif]-->
<!--[if !IE]><!-->
<html class="animations fluid top-full menuh-top sidebar sidebar-full sidebar-dropdown sidebar-width-mini sidebar-hat"><!-- <![endif]-->
<head>
	<title>GLEDCO - LOGIN</title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />


<!-- <link rel="stylesheet/less" href="../assets/less/pages/module.admin.page.login.less" /> -->
<link rel="stylesheet" href="../assets/css/pages/module.admin.page.login.min.css" />
</head>
<body class="document-body login">
	
	<!-- Wrapper -->
<div id="login">

	<div class="container">
	
		<div class="wrapper">
			<div class="center">
				<img style="max-width:120px; padding-bottom:20px;" src="../assets/logo/logo.png"/>
			</div>
			<h1 class="glyphicons lock">GLEDCO <i></i></h1>
		
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">
				
				<div class="widget-body">
				
					<!-- Form -->
					<form method="post" action="<?php loginUser(); ?>" class="row">
						<label>Username</label>
						<input type="text" class="input-block-level form-control" name="inpUSERNAME" placeholder="Username" required/> 
						<label >Password</label>
						<input type="password" class="input-block-level form-control margin-none" name="inpPASS" placeholder="Your Password" required/>
						<div class="separator bottom"></div> 
						
						<div class="col-md-4 pull-right padding-none">
							<button class="btn btn-block btn-inverse" type="submit">Sign in</button>
						</div>
					</form>
					<!-- // Form END -->
				</div>
				<!--div class="widget-footer">
					<p class="glyphicons restart"><i></i>Please enter your username and password ...</p>
				</div-->
			</div>
			<!-- // Box END -->
			
		</div>
		
	</div>
	
</div>

	
<script src="../assets/components/library/bootstrap/js/bootstrap.min.js"></script>

<script src="../assets/components/library/jquery/jquery.min.js"></script>
<script src="../assets/components/library/jquery/jquery-migrate.min.js"></script>
<script src="../assets/components/plugins/less-js/less.min.js"></script>	
</body>
</html>