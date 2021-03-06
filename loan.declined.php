<?php include_once'includes/header.in.php';
include_once'classes/class.loan.declined.php';
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
							Declined 
						<strong class="text-primary">Requests</strong>
					</h2>
				</div>
			</div>
			<div class="container-960 innerT">
					<!-- Widget -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-body" >
							<table class="table table-bordered table-condensed">
								<thead>
									<tr>
										<th>Loan Type</th>
										<th>Loan amount</th>
										<th>Years to pay(in months)</th>
										<th>Net</th>
										<th>Monthly payment</th>
										<th>Date Requested</th>
									</tr>
								</thead>
								<tbody>
								<?php theview(); ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- // Widget END -->
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