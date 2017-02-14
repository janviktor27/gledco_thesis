<?php 
include_once'includes/header.php';
include_once'classes/class.index.php';
?>
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
			<h3>QUICK LINKS</h3>
			<!-- Stats Widgets -->
			<div class="row border-top margin-none">
			<!-- Stats Widgets -->
				<div class="col-md-2">
					<!-- Stats Widget -->
					<a href="client.request.php?ref=quicklinks" class="widget-stats widget-stats-default widget-stats-5">
						<span class="glyphicons coins">
							<i></i>
						</span>
						<span class="txt">Loan (<?php loanRequest(); ?>)
							<span>Requests</span>
						</span>
						<div class="clearfix"></div>
					</a>
					<!-- // Stats Widget END -->
				</div>
				<div class="col-md-2">
					<!-- Stats Widget -->
					<a href="loan.info.php?ref=quicklinks" class="widget-stats widget-stats-info widget-stats-5">
						<span class="glyphicons ok_2">
							<i></i>
						</span>
						<span class="txt">Active (<?php loanApproved(); ?>)
							<span>Loans</span>
						</span>
						<div class="clearfix"></div>
					</a>
					<!-- // Stats Widget END -->
				</div>
				<div class="col-md-2">
					<!-- Stats Widget -->
					<a href="declined.loans.php?ref=quicklinks" class="widget-stats widget-stats-inverse widget-stats-5">
						<span class="glyphicons remove_2">
							<i></i>
						</span>
						<span class="txt">Declined (<?php loanDeclined(); ?>)
							<span>Requests</span>
						</span>
						<div class="clearfix"></div>
					</a>
					<!-- // Stats Widget END -->
				</div>
				<div class="col-md-2">
					<!-- Stats Widget -->
					<a href="cancelled.loan.php?ref=quicklinks" class="widget-stats widget-stats-primary widget-stats-5">
						<span class="glyphicons unshare">
							<i></i>
						</span>
						<span class="txt">Cancelled (<?php loanCancelled(); ?>)
							<span>Loans</span>
						</span>
						<div class="clearfix"></div>
					</a>
					<!-- // Stats Widget END -->
				</div>
				<div class="col-md-2">
					<!-- Stats Widget -->
					<a href="finished.paid.loan.php?ref=quicklinks" class="widget-stats widget-stats-info widget-stats-5">
						<span class="glyphicons thumbs_up">
							<i></i>
						</span>
						<span class="txt">Paid (<?php loanPaid(); ?>)
							<span>Loans</span>
						</span>
						<div class="clearfix"></div>
					</a>
					<!-- // Stats Widget END -->
				</div>
				<div class="col-md-2">
					<!-- Stats Widget -->
					<a href="" class="widget-stats widget-stats-default widget-stats-5">
						<span class="glyphicons user">
							<i></i>
						</span>
						<span class="txt">View (<?php clientCount(); ?>)
							<span>Clients</span>
						</span>
						<div class="clearfix"></div>
					</a>
					<!-- // Stats Widget END -->
				</div>
			<div class="separator bottom"></div>
			</div>
			<!-- // Stats Widgets END -->
			<p class="separator text-center">
				<i class="fa fa-ellipsis-h fa-3x"></i>
			</p>
		</div>
		<!-- // Content END -->
	</div>
	<!-- // Main Container Fluid END -->
<?php include_once'includes/footer.php';?>