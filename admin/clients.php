<?php include_once'includes/header.php';?>
<?php include_once'classes/class.client.php';?>
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
			<h3>All Clients 
				<button class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#modAdd"><i class="fa fa-user"></i> Add Client</button>
				<button class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#modActiv"><i class="fa fa-check"></i> Activate Client</button>
			</h3>
			<div class="row border-top margin-none">
				<!-- Stats Widgets -->
				<div class="col-md-12">
					<!-- Widget -->
					<div class="widget widget-heading-simple widget-body-gray" >
						<!-- Table -->
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Client Name(Member type)</th>
									<th>Client username</th>
									<th>Account Code</th>
									<th>Account Status</th>
									<th>Total Loans</th>
									<th class="center">Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php theview(); ?>
							</tbody>
							<!-- // Table body END -->
						</table>
						<!-- // Table END -->
					</div>
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
	
<div class="modal fade" id="modAdd">
	<div class="modal-dialog">
		<form method="post" action="<?php add(); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">
						<strong>
							<i class="fa fa-user"></i> Add client
						</strong>
					</h3>
				</div>
				<div class="modal-body">
					<label>Member type</label>
					<select class="form-control" name="inpTYPE" required>
						<option value="" default>Select member type</option>
						<option value="1">Regular</option>
						<option value="2">Associative</option>
					</select>
					<label>Username </label>
					<input type="text" name="inpUNAME" placeholder="Username" class="form-control" required />
					<label>First name </label>
					<input type="text" name="inpFNAME" placeholder="First name" class="form-control" required />
					<label>Last name </label>
					<input type="text" name="inpLNAME" placeholder="Last name" class="form-control" required />
					<label>Address</label>
					<input type="text" name="inpADDRESS" placeholder="Address" class="form-control" required />
					<label>Birth date</label>
					<input type="date" name="inpBIRTHDATE" class="form-control" required />
					<label>Birth place</label>
					<input type="text" name="inpBIRTHPLACE" placeholder="Birth place" class="form-control" required />
					<label class="strong">Gender</label>
					<label class="radio">
						<input type="radio" class="radio" name="inpGENDER" value="M" checked/> Male
								
					</label>
					<label class="radio">
						<input type="radio" class="radio" name="inpGENDER" value="F" /> Female
								
					</label>
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
								
					</label>
					<label class="strong">Password</label>
					<input type="password" class="input-block-level form-control" name="inpPWD" placeholder="Password" required />
					<br />
					<label class="strong">
						<h4>
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ATTENTION!
						</h4>Copy/Note this code and pay membership fee on the office.
					</label>
					<input type="text" class="input-block-level form-control" name="inpCODE" value="<?php unqID(); ?>" readonly />
				</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-primary" name="btn_add">Add client</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<div class="modal fade" id="modActiv">
	<div class="modal-dialog">
		<form method="post" action="<?php activs_client(); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">
						<strong>
							<i class="fa fa-check"></i> Activate client
						</strong>
					</h3>
				</div>
				<div class="modal-body">
					<label>Account Code </label>
					<input type="text" name="inpAccountCode" placeholder="Account Code" class="form-control" required />
				</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-info" name="btn_activ">Activate client</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php 
	updMod(); 
	banMod();
	delMod(); 
	?>
<?php include_once'includes/footer.php';?>