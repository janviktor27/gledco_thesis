<?php
include_once'includes/header.special.php';
include_once'classes/class.personal.info.php';
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
							Complete <strong class="text-primary">Information</strong>
						</h2>
					</div>
				</div>
				<div class="container-960 innerT">
					<h3>Please complete this form to fully activate your account.</h3>
					<h5 class="text-primary">*Be precise when filling up this form, you cannot edit after saving this.</h5>
					<h5 class="text-info">WRITE N/A IF YOU NO ANSWER.</h5>
					<div class="separator bottom"></div>
					<div class="widget widget-heading-simple widget-body-gray">
						<div class="widget-body">
						<div class="separator bottom"></div>
							<form method="post" class="row margin-none" action="<?php add();?>">
								<div class="row">
									<div class="form-group col-md-3"> 
										<label>OFFICE</label>
										<input type="text" class="form-control" name="inpOFFICE" placeholder="OFFICE">
									</div>
									<div class="form-group col-md-3"> 
										<label>DESIGNATION</label>
										<input type="text" class="form-control" name="inpDESIGNATION" placeholder="DESIGNATION">
									</div>
									<div class="form-group col-md-3"> 
										<label>MONTHLY SALARY</label>
										<input type="number" class="form-control" name="inpMONTHLYSALARY" placeholder="MONTHLY SALARY">
									</div>
									<div class="form-group col-md-3"> 
										<label>YEARS IN SERVICE</label>
										<input type="number" class="form-control" name="inpYEARSINSERVICE" placeholder="YEARS IN SERVICE">
									</div>
									<div class="form-group col-md-6"> 
										<label>IF MARRIED, WRITE MAIDEN NAME</label>
										<input type="text" class="form-control" name="inpIFMARRIED" placeholder="IF MARRIED, WRITE MAIDEN NAME">
									</div>
									<div class="form-group col-md-6"> 
										<label>NAME OF SPOUSE</label>
										<input type="text" class="form-control" name="inpNAMESPOUSE" placeholder="NAME OF SPOUSE">
									</div>
									<div class="form-group col-md-9"> 
										<label>TAX PAYER'S IDENTIFICATION NUMBER</label>
										<input type="text" class="form-control" name="inpTAXPAYERIDNUMBER" placeholder="TAX PAYERS IDENTIFICATION NUMBER">
									</div>
									<div class="form-group col-md-3"> 
										<label>CITIZENSHIP</label>
										<input type="text" class="form-control" name="inpCITIZENSHIP" placeholder="CITIZENSHIP">
									</div>
									<div class="form-group col-md-5"> 
										<label>DATE OF BIRTH</label>
										<input type="date" class="form-control" name="inpDATEOFBIRTH" placeholder="DATE OF BIRTH">
									</div>
									<div class="form-group col-md-7"> 
										<label>PLACE OF BIRTH</label>
										<input type="text" class="form-control" name="inpPLACEOFBIRTH" placeholder="PLACE OF BIRTH">
									</div>
									<div class="form-group col-md-4"> 
										<label>HEIGHT(IN METERS)</label>
										<input type="text" class="form-control" name="inpHEIGHT" placeholder="HEIGHT(IN METERS)">
									</div>
									<div class="form-group col-md-4"> 
										<label>WEIGHT(IN KILOS)</label>
										<input type="text" class="form-control" name="inpWEIGHT" placeholder="WEIGHT(IN KILOS)">
									</div>
									<div class="form-group col-md-4"> 
										<label>BLOOD TYPE</label>
										<input type="text" class="form-control" name="inpBLOODTYPE" placeholder="BLOOD TYPE">
									</div>
									<div class="form-group col-md-6"> 
										<label>ADDRESS</label>
										<input type="text" class="form-control" name="inpADDRESS" placeholder="ADDRESS">
									</div>
									<div class="form-group col-md-3"> 
										<label>CELL NO.</label>
										<input type="text" class="form-control" name="inpCELLNO" placeholder="CELL NO.">
									</div>
									<div class="form-group col-md-3"> 
										<label>TELEPHONE NO.</label>
										<input type="text" class="form-control" name="inpTELNO" placeholder="TELEPHONE NO. ">
									</div>
									<div class="form-group col-md-3"> 
										<label>FATHER'S NAME</label>
										<input type="text" class="form-control" name="inpFATHERSNAME" placeholder="FATHER'S NAME">
									</div>
									<div class="form-group col-md-3"> 
										<label>FATHERS PLACE OF BIRTH</label>
										<input type="text" class="form-control" name="inpFATPLACEOFBIRTH" placeholder="FATHER'S PLACE OF BIRTH">
									</div>
									<div class="form-group col-md-3"> 
										<label>MOTHER'S NAME</label>
										<input type="text" class="form-control" name="inpMOTHERSNAME" placeholder="MOTHER'S NAME">
									</div>
									<div class="form-group col-md-3"> 
										<label>MOTHER PLACE OF BIRTH</label>
										<input type="text" class="form-control" name="inpMOTPLACEOFBIRTH" placeholder="MOTHER'S PLACE OF BIRTH">
									</div>
								</div>
								<div class="row">
									<!--CHILDREN-->
									<div class="col-xs-12">
										<label>CHILDREN</label>
									</div>
									<div class="multi-field-wrapper">
										<div class="multi-fields">
											<div class="multi-field">
												<div class="col-xs-5">
													<input class="form-control" type="text" name="inpCHILDNAME[]" placeholder="CHILD NAME">
												</div>
												<div class="col-xs-5">
													<input class="form-control" type="number" name="inpCHILDAGE[]" placeholder="CHILD AGE">
												</div>
													<button type="button" class="remove-field btn btn-primary pull-right"><i class="glyphicon glyphicon-minus"></i></button>
											</div>
										</div>
										<button type="button" class="add-field btn btn-info "><i class="glyphicon glyphicon-plus"></i></button>
									</div>
									<!--CHILDREN END-->
								</div>
								<div class="row">
									<!--BENEFICIARIES-->
									<div class="col-xs-12">
										<label>BENEFICIARIES</label>
									</div>
									<div class="multi-field-wrapper-1">
										<div class="multi-fields-1">
											<div class="multi-field-1">
												<div class="col-md-4">
													<input class="form-control" type="text" name="inpBENENAME[]" placeholder="BENEFICIARY NAME">
												</div>
												<div class="col-md-3">
													<input class="form-control" type="text" name="inpBENEREL[]" placeholder="RELATIONSHIP">
												</div>
												<div class="col-md-3">
													<input class="form-control" type="text" name="inpBENEAGE[]" placeholder="BENEFICIARY AGE">
												</div>
												<button type="button" class="remove-field btn btn-primary pull-right"><i class="glyphicon glyphicon-minus"></i></button>
											</div>
										</div>
										<button type="button" class="add-field btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
									</div>
									<!--BENEFICIARIES END-->
								<div class="separator"></div>
								</div>
								<div class="row">
									<!--EDUCATION-->
									<div class="col-xs-12">
									<h4>EDUCATION</h4>
									</div>
									<div class="multi-field-wrapper-2">
										<div class="multi-fields-2">
											<div class="multi-field-2">
												<div class="form-group col-md-10">
													<select class="form-control" name="inpEDUCTYPE[]">
														<option value="" default>SELECT EDUCATION LEVEL</option>
														<option value="0">ELEMENTARY</option>
														<option value="1">SECONDARY</option>
														<option value="2">VOCATIONAL</option>
														<option value="3">COLLEGE</option>
														<option value="4">POST GRADUATE</option>
													</select>
												</div>
												<div class="form-group col-md-10"> 
													<input type="text" class="form-control" name="inpSCHOOLNAME[]" placeholder="NAME OF SCHOOL/COLLEGE/UNIVERSITY">
												</div>
												<div class="form-group col-md-10"> 
													<input type="text" class="form-control" name="inpDEGEARNED[]" placeholder="DEGREE EARNED(WRITE NON IF NOT GRADUATED)">
												</div>
												<div class="form-group col-md-10"> 
													<input type="text" class="form-control" name="inpNOUNITSCOURSE[]" placeholder="NO. OF UNIT(S) COMPLETED/COURSE TITLE">
												</div>
												<div class="form-group col-md-10"> 
													<input type="text" class="form-control" name="inpINSIVEATTND[]" placeholder="INCLUSIVE DATES OF ATTENDANCE">
												</div>
												<div class="form-group col-md-10"> 
													<input type="text" class="form-control" name="inpHONORSRECIEVED[]" placeholder="HONORS RECIEVED">
												</div>
												<button type="button" class="remove-field btn btn-primary pull-right"><i class="glyphicon glyphicon-minus"></i></button>
											</div>
										</div>
										<button type="button" class="add-field btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
									</div>									
									<!--EDUCATION END-->
								<div class="separator"></div>
								</div>
								<div class="row">
									<div class="form-group col-md-12"> 
										<label>EMPLOYEE ID NUMBER</label>
										<input type="text" class="form-control" name="inpEMPLOYEENUMBER" placeholder="EMPLOYEE ID NUMBER" required>
									</div>
								</div>
								<div class="separator bottom"></div>
								<div class="right pull-right">
									<button class="btn btn-info" type="submit" name="btn_save"><i class="fa fa-file"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
					<div class="separator bottom"></div>
				</div>
			</div>
		</div>
		<!-- // Content END -->
		<?php //include'includes/copyright.php';?>
		<!-- // Footer END -->
	</div>
	<!-- // Main Container Fluid END -->
	<!-- Global -->
	<script>
	$(".multi-field-wrapper").each(function() {
    var a = $(".multi-fields", this);
    $(".add-field", $(this)).click(function(b) {
        $(".multi-field:first-child", a).clone(!0).appendTo(a).find("input").val("").focus()
    }), $(".multi-field .remove-field", a).click(function() {
        $(".multi-field", a).length > 1 && $(this).parent(".multi-field").remove()
    })
	});
 $(".multi-field-wrapper-1").each(function() {
    var a = $(".multi-fields-1", this);
    $(".add-field", $(this)).click(function(b) {
        $(".multi-field-1:first-child", a).clone(!0).appendTo(a).find("input").val("").focus()
    }), $(".multi-field-1 .remove-field", a).click(function() {
        $(".multi-field-1", a).length > 1 && $(this).parent(".multi-field-1").remove()
    })
});

$(".multi-field-wrapper-2").each(function() {
    var a = $(".multi-fields-2", this);
    $(".add-field", $(this)).click(function(b) {
        $(".multi-field-2:first-child", a).clone(!0).appendTo(a).find("input").val("").focus()
    }), $(".multi-field-2 .remove-field", a).click(function() {
        $(".multi-field-2", a).length > 1 && $(this).parent(".multi-field-2").remove()
    })
});
</script>
	<?php include_once'includes/footer.in.php';?>