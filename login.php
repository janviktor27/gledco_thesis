<?php include_once 'includes/header.php';?>
<body class="login">
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">
		<!-- Content -->
		<div id="content">
			<!-- Top navbar (note: add class "navbar-hidden" to close the navbar by default) -->
			<div class="navbar main hidden-print">
				<div class="container-960">
					<!-- Brand -->
					<a href="index.php" class="appbrand pull-left">
					<img style="max-width:40px; margin-top: -7px;" src="assets/logo/logo.png"/>
					<span class="text-primary">GLED</span> CO</a>
					<?php include_once 'includes/navbar.php';?>
					<div class="clearfix"></div>
					<!-- // Top Menu Right END -->
				</div>
			</div>
			<!-- Top navbar END -->
			<!-- Wrapper -->
			<div id="login">
				<div class="container">
					<div class="wrapper">
					<div class="center">
						<img style="max-width:120px; padding-bottom:20px;" src="assets/logo/logo.png"/>
					</div>
						<h1 class="glyphicons unlock">Sign in <i></i></h1>
						<!-- Box -->
						<div class="widget widget-heading-simple widget-body-gray">
							<div class="widget-body">
								<!-- Form -->
								<form method="post" action="<?php loginUser(); ?>">
									<label>Username</label>
									<input type="text" class="input-block-level form-control" name="inpUSERNAME" placeholder="Username" />
									<label>Password</label>
									<div class="clearfix"></div>
									<input type="password" class="input-block-level form-control" name="inpPASS" placeholder="Password" />
									<div class="separator bottom"></div>
									<div class="row">
										<div class="col-md-4 pull-right">
											<button class="btn btn-block btn-inverse" type="submit">Sign in</button>
										</div>
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
			<!-- // Wrapper END -->
		</div>
		<!-- // Content END -->
	</div>
	<!-- // Main Container Fluid END -->
	<?php include_once 'includes/footer.php';?>