<?php include_once'includes/header.php'; ?>
<?php include_once'classes/class.cancelled.loan.php'; ?>
<body class="document-body">
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
			<h3>Cancelled Request</h3>
			<div class="row border-top margin-none">
				<!-- Stats Widgets -->
				<div class="col-md-12">
				<!-- Table -->
				<table class="table table-stripped table-bordered">
					<thead>
						<tr>
							<th>Client Name(account type)</th>
							<th>Loan type</th>
							<th>Amount</th>
							<th>Years to pay (in months)</th>
							<th>Net</th>
							<th>Monthly</th>
							<th>Date Requested</th>
						</tr>
					</thead>
					<tbody>
					<?php theview(); ?>
					</tbody>
					<!-- // Table body END -->
				</table>
				<!-- // Table END -->
				</div>
				<div class="separator bottom"></div>
			</div>
		</div>
		<!-- // Content END -->
	</div>
	<!-- // Main Container Fluid END -->
<?php include_once'includes/footer.php'; ?>