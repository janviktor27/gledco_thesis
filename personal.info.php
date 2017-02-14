<?php
include_once'includes/header.in.php';
include_once'classes/class.personal.info.php';
include_once'classes/class.whois.php';
?>
<body>
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">
		<!-- Content -->
		<div id="content">
			<?php include'includes/main.nav.html';?>
			<!-- Top navbar END -->
			<div id="landing_2">
				<div class="mosaic-line mosaic-line-2">
					<div class="container-960 center">
						<h2 class="margin-none">
							Personal <strong class="text-primary">Information</strong>
						</h2>
					</div>
				</div>
				<div class="container-960 innerT">
					<div class="row">
						<div class="col-md-5">
							<div class="well margin-none inverse">
								<div class="margin-none">
									<?php usrInfo(); ?>
								</div>
							</div>
						</div>
						<div class="col-md-7">
						<h4>Reset your password</h4>
							<form action="<?php updPWD(); ?>" method="post" id="passwordForm" onSubmit="return changePasswordko();" class="row margin-none">
								<div class="row">
									<div class="col-md-12">
										<input type="password" class="form-control" name="inpOldPassword" placeholder="OLD PASSWORD" required>
									</div>
									<div class="separator bottom"></div>
									<div class="col-md-6"> 
										<input type="password" id="pass1" class="form-control" name="inpNewPassword" placeholder="NEW PASSWORD" required>
									</div>
										<div class="col-md-6">
										<input type="password" id="pass2" class="form-control" name="inpNewPasswordRe" placeholder="RE-TYPE NEW PASSWORD" required>
									</div>
								</div>
								<div class="separator bottom"></div>
								<div class="right pull-right">
									<button class="btn btn-primary" name="btn_chngpwd"><i class="fa fa-shield"></i> Change Password</button>
								</div>
							</form>
						</div>
						
					</div>
					<div class="widget widget-heading-simple widget-body-gray">
						<div class="widget-body center">

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- // Content END -->
		<?php //include'includes/copyright.php';?>
		<!-- // Footer END -->
	</div>
	<!-- // Main Container Fluid END -->
	<!-- Global -->
	<script type="text/javascript">function changePasswordko(){var a=document.getElementById("pass1").value,b=document.getElementById("pass2").value,c=!0;return a!=b?(document.getElementById("pass1").style.borderColor="#E34234",document.getElementById("pass2").style.borderColor="#E34234",c=!1):document.getElementById("passwordForm").submit(),c}</script>
	<?php include_once'includes/footer.in.php';?>