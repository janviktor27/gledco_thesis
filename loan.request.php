<?php include_once'includes/header.in.php';
include_once'classes/class.loan.request.php';
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
							My 
						<strong class="text-primary">Requests</strong>
					</h2>
				</div>
			</div>
			<div class="container-960 innerT">
				<div class="row">
					<form method="post" action="<?php add(); ?>">
						<div class="col-md-2">
							<h4>Request Loan:</h4>
						</div>
						<div class="col-md-3">
							<div class="form-group input-group">
								<select id="type_list" onChange="getAmount(this.value);" name="inpLoanType" class="form-control" required>
									<option value="" default>Select Loan Type</option>
									<?php optLoan(); ?>
								</select>
								<div class="input-group-btn">
									<button data-target="#modMoreInfo" data-toggle="modal" class="btn btn-info" type="button"><i class="fa fa-question"></i></button>
								</div>								
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<select id="amount-list" onChange="getYears(this.value, document.getElementById('type_list').value);" name="inpLoanAmount" class="form-control" required>
									<option value='' default>Please select loan type.</option>
							</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group input-group">
								<select id="years-list" name="inpYears" class="form-control" required>
									<option value="" default>Please select amount.</option>
								</select>
								<div class="input-group-btn">
									<button class="btn btn-success" name="btn_add" type="submit"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</div>
						</form>
					</div>
					<!-- Widget -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-body" >
							<table class="table table-bordered table-condensed">
								<thead>
									<tr>
										<th>Loan Type</th>
										<th>Loan amount</th>
										<th>Total Balance</th>
										<th>Years to pay (in months)</th>
										<th>Net</th>
										<th>Monthly amount</th>
										<th>Date requested</th>
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
					<div class="modal fade" id="modMoreInfo">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<!-- Modal heading -->
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 class="modal-title"><strong>Loan types and ranges information</strong></h3>
								</div>
								<!-- // Modal heading END -->
								
								<!-- Modal body -->
								<div class="modal-body">
									<table class="table table-stripped table-bordered">
										<thead>
										<tr>
												<th class="center"> Loan Title</th>
												<th class="center" colspan="4">Information</th>
												<th class="center">Restriction</th>
										</tr>
										<tr>
										<td></td>
										<td class="center">Payment Period</td>
										<td class="center">Loan Amount</td>
										<td class="center">Net</td>
										<td class="center">Monthly Payment</td>
										<td></td>
										</tr>
										</thead>
										<tbody>
										<?php modMoreInfo(); ?>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn btn-success" data-dismiss="modal">Close</a> 
								</div>
							</div>
						</div>
					</div>			
	<?php delMod();?>
	<!-- Global -->
	<script type="text/javascript">function getAmount(a){$.ajax({type:"POST",url:"_/get_amnt.php",data:"type_id="+a,success:function(a){$("#amount-list").html(a)}})}function getYears(a,b){$.ajax({type:"POST",url:"_/get_years.php",data:{loan_amount:a,type_id:+b},success:function(a){$("#years-list").html(a)}})}	</script>
	<?php include_once'includes/footer.in.php';?>