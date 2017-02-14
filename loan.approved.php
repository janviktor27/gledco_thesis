<?php include_once'includes/header.in.php';
include_once'classes/class.loan.approved.php';
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
							Active 
						<strong class="text-primary">Loans</strong>
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
										<th>Balance amount</th>
										<th>Paid amount</th>
										<th>Months remaining</th>
										<th>Monthly amount</th>
										<th>Date approved</th>
										<th></th>
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
	<!-- Modal -->
	<div class="modal fade" id="modal-simple">
		
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">More Info</h3>
				</div>
				<!-- // Modal heading END -->
				
				<!-- Modal body -->
				<div class="modal-body">
				</div>
				<!-- // Modal body END -->
				
				<!-- Modal footer -->
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a> 
				</div>
				<!-- // Modal footer END -->

			</div>
		</div>
		
	</div>
	<!-- // Modal END -->
	<?php modLoanInfo(); ?>
	<!-- Global -->
	<?php include_once'includes/footer.in.php';?>