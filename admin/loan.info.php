<?php include_once'includes/header.php';?>
<?php include_once'classes/class.loan.info.php';?>
<body class="document-body ">
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden sidebar-hidden-phone fluid menu-left">
		<!-- Content -->
		<div id="content">
			<!-- Top navbar -->
			<div class="navbar main hidden-print">
				<!-- Menu Toggle Button -->
				<button type="button" class="btn btn-navbar pull-left visible-xs">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- Full Top Style -->
				<?php include_once'includes/top_nav_left.php';?>
				<!-- // Full Top Style END -->
				<!-- Top Menu Right -->
				<?php include_once'includes/top_nav_right.php';?>
				<!-- // Top Menu Right END -->
				<div class="clearfix"></div>
			</div>
			<!-- Top navbar END -->
			<h3>Active Loans</h3>
			<div class="row border-top margin-none">
				<!-- Stats Widgets -->
				<div class="col-md-12">
				<!-- Table -->
				<table class="table table-stripped table-bordered">
					<thead>
						<tr>
							<th class="center">Client Name</th>
							<th class="center">Loan type</th>
							<th class="center">Loan Amount</th>
							<th class="center">Balance Amount</th>
							<th class="center">Paid Amount</th>
							<th class="center">Months Remaining</th>
							<th class="center">Monthly payment</th>
							<th class="center">Date & Time Approved</th>
							<th class="col-xs-2"></th>
						</tr>
					</thead>
					<tbody>
					<?php theview(); ?>
					</tbody>
				</table>
				</div>
				<div class="separator bottom"></div>
			</div>
		</div>
		<!-- // Content END -->
	</div>
	<!-- // Main Container Fluid END -->
<?php
payMod();
cashMod();
infoMod();
?>
<?php include_once'includes/footer.php';?>