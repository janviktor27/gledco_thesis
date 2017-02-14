<?php include_once'includes/header.in.php';?>
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
							Welcome to <strong class="text-primary">GLED</strong>CO
						</h2>
					</div>
				</div>
				<div class="container-960 innerT">

					<div class="row">
						<div class="col-md-2">
							<div class="widget widget-heading-simple widget-body-white">
								<div class="widget-body">
									<div class="glyphicons glyphicon-xlarge glyphicon-top coins">
										<i></i>
										<h4>Loan Request</h4>
										<p class="margin-none">Request a loan now!
											<br/>
											<br/>
											<a href="loan.request.php?ref=quicklinks">My Requests</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget widget-heading-simple widget-body-gray">
								<div class="widget-body">
									<div class="glyphicons glyphicon-xlarge glyphicon-top ok_2 glyphicon-primary">
										<i></i>
										<h4>My Active loans</h4>
										<p class="margin-none">View your active loans here.
											<br/>
											<br/>
											<a href="loan.approved.php?ref=quicklinks">Active Loans</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget widget-heading-simple widget-body-white">
								<div class="widget-body">
									<div class="glyphicons glyphicon-xlarge glyphicon-top remove_2">
										<i></i>
										<h4>Declined Requests</h4>
										<p class="margin-none">View your declined request.
											<br/>
											<br/>
											<a href="loan.declined.php?ref=quicklinks">Declined Loans</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget widget-heading-simple widget-body-gray">
								<div class="widget-body">
									<div class="glyphicons glyphicon-xlarge glyphicon-top glyphicon-primary unshare">
										<i></i>
										<h4>Cancelled Requests</h4>
										<p class="margin-none">My cancelled Requests.
											<br/>
											<br/>
											<a href="loan.cancelled.php?ref=quicklinks">My Cancellation</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget widget-heading-simple widget-body-white">
								<div class="widget-body">
									<div class="glyphicons glyphicon-xlarge glyphicon-top thumbs_up">
										<i></i>
										<h4>My Paid Loans</h4>
										<p class="margin-none">Successfully paid loans!
											<br/>
											<br/>
											<a href="loan.paid.php?ref=quicklinks">View Paid Loans</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget widget-heading-simple widget-body-gray">
								<div class="widget-body">
									<div class="glyphicons glyphicon-xlarge glyphicon-top user glyphicon-primary">
										<i></i>
										<h4>User Information</h4>
										<p class="margin-none">View personal information.
											<br/>
											<br/>
											<a href="personal.info.php?ref=quicklinks">Personal Info</a>
										</p>
									</div>
								</div>
							</div>
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
	<?php include_once'includes/footer.in.php';?>