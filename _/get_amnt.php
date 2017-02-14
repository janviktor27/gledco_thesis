<?php
include_once'../connect.php';
/////////////////////////////////////
//INITIALIZE HERE
if(isset($_POST['type_id'])){
	$type_id = mysqli_real_escape_string($_CON, $_POST['type_id']);
	$_ID = $type_id;
}
if(!empty($type_id)){
	$sqlSelect = mysqli_query($_CON, "SELECT loan_amount FROM loan_type_settings WHERE type_id='$type_id' GROUP BY loan_amount ");
	$count = mysqli_num_rows($sqlSelect);
	if($count > 0){
		echo"<option value='' default>Select Loan Amount</option>";
		while($row=mysqli_fetch_assoc($sqlSelect)){
			$loan_amount = $row['loan_amount'];
			echo"<option value='$loan_amount'>$loan_amount</option>";
		}
	}else{
		echo"<option value=''>No Available data.</option>";
	}
}

