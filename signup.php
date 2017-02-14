<?php include_once 'includes/header.php';?>
<?php include_once 'classes/class.signup.php';?>

<body class="login">
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">
		<!-- Content -->
		<div id="content">
			<!-- Top navbar (note: add class "navbar-hidden" to close the navbar by default) -->
			<div class="navbar main hidden-print">
				<div class="container-960">
					<!-- Brand --><a href="index.php" class="appbrand pull-left">
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
				<div class="wrapper signup">
					<div class="center">
						<img style="max-width:120px; padding-bottom:20px;" src="assets/logo/logo.png"/>
					</div>
					<h1 class="glyphicons user_add">Sign up <i></i></h1>
					<!-- Box -->
					<div class="widget widget-heading-simple">
						<?php signupRes(); ?><br />
						<div class="widget-body">
							<!-- Form -->
							<form class="form-horizontal" method="post" action="<?php signup(); ?>">
								<!-- Row -->
									<!-- Column -->
										<div class="innerR">
											<label class="strong">Member type</label>
											<select class="input-block-level form-control" name="inpTYPE"required />
											 <option value="">Select type</option>
											 <option value="1">Regular</option>
											 <option value="2">Associative</option>
											</select>
											<label class="strong">Username</label>
											<input type="text" class="input-block-level form-control" id="inpUSERNAME" name="inpUSERNAME" placeholder="Username (Avoid Spaces!)" onblur="this.value=removeSpaces(this.value);" required />
											<label class="strong">Firstname</label>
											<input type="text" class="input-block-level form-control" name="inpFNAME" placeholder="Firstname" required />
											<label class="strong">Lastname</label>
											<input type="text" class="input-block-level form-control" name="inpLNAME" placeholder="Lastname" required />
											<label class="strong">Address</label>
											<input type="text" class="input-block-level form-control" name="inpADDRESS" placeholder="Address" required />
											<label class="strong">Birthdate</label>
											<input type="date" class="input-block-level form-control" name="inpBIRTHDATE" />
											<label class="strong">Birth place</label>
											<input type="text" class="input-block-level form-control" name="inpBIRTHPLACE" placeholder="Birth place" required />
											<label class="strong">Gender</label>
											<label class="radio">
												<input type="radio" class="radio" name="inpGENDER" value="M" checked/> Male
											</label>
											<label class="radio">
												<input type="radio" class="radio" name="inpGENDER" value="F" /> Female
											</label><br/>
											<label class="strong">Civil Status</label>
											<label class="radio">
												<input type="radio" class="radio" name="inpCIVSTATS" value="Single" checked/> Single
											</label>
											<label class="radio">
												<input type="radio" class="radio" name="inpCIVSTATS" value="Married" /> Married
											</label>
											<label class="radio">
												<input type="radio" class="radio" name="inpCIVSTATS" value="Widower/Widow" /> Widower/Widow
											</label>
											<label class="radio">
												<input type="radio" class="radio" name="inpCIVSTATS" value="Separated" /> Separated
											</label><br/>
											<label class="strong">Password</label>
											<input type="password" class="input-block-level form-control" name="inpPWD" placeholder="Password" required />
											<label class="strong"><h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ATTENTION!</h4>Copy/Note this code and pay membership fee on the office.</label>
											<input type="text" class="input-block-level form-control" name="inpCODE" value="<?php unqID(); ?>" readonly />
										</div>
										<div class="separator bottom"></div>
										<div class="row">
											<div class="col-md-4 pull-right">
												<button name="btn_signup" class="btn btn-block btn-inverse" type="submit">Sign up!</button>
											</div>
										</div>
									<!-- // Column END -->
								<!-- // Row END -->
							</form>
							<!-- // Form END -->
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
	<script language="javascript" type="text/javascript">
		function removeSpaces(string) {
		 return string.split(' ').join('');
		}
	</script>
	<?php include_once 'includes/footer.php';?>