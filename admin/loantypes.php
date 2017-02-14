<?php include_once'includes/header.php';?>
<?php include_once'classes/class.loantypes.php';?>
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
			<h3>Manage Loan Types</h3>
			<div class="row border-top margin-none">
				<!-- Stats Widgets -->
				<div class="col-md-5">
					<!-- Widget -->
					<div class="widget widget-heading-simple widget-body-gray" >
						<form method="post" action="<?php add(); ?>">
							<div class="widget-body">
								<label>Loan type name</label>
								<input type="text" name="inpTITLE" placeholder="Loan type title" class="form-control" required />

								<label>Restriction</label>
								<select class="form-control" name="inpRESTRIC" required>
									<option value="" default>Select Restriction</option>
									<option value="1">Regular</option>
									<option value="2">Regular and Associative</option>
								</select>
								<br>
								<div class="pull-right">
									<button type="submit" name="btn_add" class="btn btn-success">Add</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-7">
				<!-- Table -->
				<table class="table table-stripped table-bordered">
					<thead>
						<tr>
							<th>Loan Title</th>
							<th>Restriction</th>
							<th></th>
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
			<!-- // Stats Widgets END -->
			<p class="separator text-center">
				<i class="fa fa-ellipsis-h fa-3x"></i>
			</p>
		</div>
		<!-- // Content END -->
	</div>
	<!-- // Main Container Fluid END -->
<?php updMod(); 
delMod(); 
?>
<?php include_once'includes/footer.php';?>