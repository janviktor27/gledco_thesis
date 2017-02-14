<?php
include_once'../connect.php';

if(isset($_POST['loan_amount']) && isset($_POST['type_id'])){
	$loan_amount = mysqli_real_escape_string($_CON, $_POST['loan_amount']);
	$type_id = mysqli_real_escape_string($_CON, $_POST['type_id']);
	
	$sqlSelect = mysqli_query($_CON, "SELECT years_to_pay, months_to_pay FROM loan_type_settings WHERE type_id='$type_id' AND loan_amount='$loan_amount' ");
	$count = mysqli_num_rows($sqlSelect);
	if($count > 0){
		echo"<option value='' default>How many years to pay?</option>";
		while($row=mysqli_fetch_array($sqlSelect)){
			$years_to_pay = $row['years_to_pay'];
			$months_to_pay = $row['months_to_pay'];
			echo"<option value='$years_to_pay' > $years_to_pay years ($months_to_pay months)</option>";
		}
	}else{
		echo"<option value=''> No Available data.</option>";
	}
}