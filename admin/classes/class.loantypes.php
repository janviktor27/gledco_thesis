<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
include_once('./../connect.php');
 
/////////////////////////////////////////////
//Add loan type
	function add(){
		global $_CON;
		if(isset($_POST['btn_add'])){
			$inpTITLE = mysqli_real_escape_string($_CON, $_POST['inpTITLE']);
			$inpRESTRIC = mysqli_real_escape_string($_CON, $_POST['inpRESTRIC']);
			//CHECK IF EIN EXIST
			$sqlSearch = mysqli_query($_CON, "SELECT title FROM loan_type WHERE title='$inpTITLE' ");
			$count = mysqli_num_rows($sqlSearch);
			if($count > 0){
				ob_end_clean();
				header("location: loantypes.php?add=exist");
			}else{
				$sqlInsert = mysqli_query($_CON, "INSERT INTO loan_type 
				(title,restriction)
				VALUES('$inpTITLE','$inpRESTRIC')");
				ob_end_clean();
				header("location: loantypes.php?add=true");
			}
		}
	}
	
/////////////////////////////////////////////
// OPTION YEARS
	function optYears(){
		for($num1= 0;$num1 <= 15;$num1++){
			if($num1 == 1 || $num1 == 0 || $num1 == 7 || $num1 == 9 || $num1 == 11 || $num1 == 13 || $num1 == 14){
				echo "";
			}else{
				echo "
					<option value='$num1'>$num1 Years</option>
				";
			}
		}
	}

/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_type ORDER BY title DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['type_id']);
				$title = mysqli_real_escape_string($_CON, $row['title']);
				$restriction = mysqli_real_escape_string($_CON, $row['restriction']);
				//Restriction To TEXT
				if($restriction == 1){
					$res = "Regular only";
				}elseif($restriction == 2){
					$res = "Regular and Associative";
				}
				$enc_ID = urlencode(base64_encode($_ID));
				$sqlSelect = mysqli_query($_CON,"SELECT type_id FROM loan_type_settings WHERE type_id='$_ID' ");
				$countType = mysqli_num_rows($sqlSelect);
				if($countType > 0){
					$dynamicDel = "<button class='btn btn-danger btn-xs disabled' ><i class='fa fa-trash-o'></i></button>";
				}else{
					$dynamicDel = "<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#delMOD$_ID'><i class='fa fa-trash-o'></i></button>";
				}
				echo"
				 <tr>
				  <td>$title</td>
				  <td class='center'>$res</td>
				  <td class='center'>
				   <a href='loantype.settings.php?query=$enc_ID' class='btn btn-warning btn-xs'><i class='fa fa-gear'></i></a>
				   <button class='btn btn-info btn-xs' data-toggle='modal' data-target='#updateMOD$_ID'><i class='fa fa-edit'></i></button>
				   $dynamicDel
				  </td>
				 </tr>
				";
			}
		}else{
			echo"
			 <tr>
			  <td colspan='5'>No data yet. </td>
			 </tr>
			";
		}
	}

/////////////////////////////////////////////
//UPDATE MODAL
	function updMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_type ORDER BY title DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['type_id']);
				$title = mysqli_real_escape_string($_CON, $row['title']);
				$restriction = mysqli_real_escape_string($_CON, $row['restriction']);
				//Restriction To TEXT
				if($restriction == 1){$res = "Regular";}elseif($restriction == 2){$res = "Regular and Associative";}
				echo"
				<div class='modal fade' id='updateMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; updAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Update form</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<div class='widget-body'>
										<label>Loan type name</label>
										<input value='$title' type='text' name='inpTITLE' placeholder='Loan type title' class='form-control' required />
										<label>Restriction</label>
										<select class='form-control' name='inpRESTRIC' required>
											<option value='$restriction' default>$res</option>
											<option value='1'>Regular</option>
											<option value='2'>Associative</option>
										</select>
									</div>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$_ID' name='UPD_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>Close</a>
									<button type='submit' class='btn btn-primary' name='btn_upd'>Save changes</button>
								</div>
								<!-- // Modal footer END -->
							</form>
						</div>
					</div>
				</div>";
			}
		}
	}

/////////////////////////////////////////////
//UPDATE METHOD
	function updAction(){
		global $_CON;
		if(isset($_POST['btn_upd'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['UPD_ID']);
			$inpTITLE = mysqli_real_escape_string($_CON, $_POST['inpTITLE']);
			$inpRESTRIC = mysqli_real_escape_string($_CON, $_POST['inpRESTRIC']);

			//CHECK IF EIN ARE THE SAME FROM TEXTBOX AND DATABASE
			$sqlSearch = mysqli_query($_CON, "SELECT title FROM loan_type WHERE type_id='$_ID'");
			$_row = mysqli_fetch_array($sqlSearch);
			$_GETtitle = $_row['title'];
			if($inpTITLE == $_GETtitle){
				//UPDATE QUERY
				$sqlUpdate = mysqli_query($_CON,"UPDATE loan_type SET
				restriction='$inpRESTRIC'
				WHERE type_id='$_ID' ");
				ob_end_clean();
				header("location: loantypes.php?upd=true");
			}else{
				//CHECK IF EIN EXIST
				$sqlSearch = mysqli_query($_CON, "SELECT title FROM loan_type WHERE title='$inpTITLE' ");
				$count = mysqli_num_rows($sqlSearch);
				if($count == 1){
					ob_end_clean();
					header("location: loantypes.php?upd=exist");
				}else{
					$sqlUpdate = mysqli_query($_CON,"UPDATE loan_type SET
					title='$inpTITLE',
					restriction='$inpRESTRIC'
					WHERE type_id='$_ID'");					
					ob_end_clean();
					header("location: loantypes.php?upd=true");
				}
			}
		}
	}
	
/////////////////////////////////////////////
//DELETE MODAL
	function delMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM loan_type ORDER BY title DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['type_id']);
				$title = mysqli_real_escape_string($_CON, $row['title']);
				$restriction = mysqli_real_escape_string($_CON, $row['restriction']);
				//Restriction To TEXT
				if($restriction == 1){$res = "Both";}elseif($restriction == 2){$res = "Regular Only";}elseif($restriction == 3){$res = "Associative Only";}
				echo"
				<div class='modal fade' id='delMOD$_ID'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<form method='post' action='"; delAction(); echo"'>
								<!-- Modal heading -->
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
									<h3 class='modal-title'>
										<strong>Are you sure?</strong>
									</h3>
								</div>
								<!-- // Modal heading END -->
								<!-- Modal body -->
								<div class='modal-body'>
									<h3>$title</h3>
									<h5>$res</h5>
								</div>
								<!-- // Modal body END -->
								<!-- Modal footer -->
								<div class='modal-footer'>
									<input type='hidden' value='$_ID' name='DEL_ID'>
									<a href='#' class='btn btn-default' data-dismiss='modal'>No</a>
									<button type='submit' class='btn btn-primary' name='btn_del'>Delete</button>
								</div>
								<!-- // Modal footer END -->
							</form>
						</div>
					</div>
				</div>";
			}
		}
	}
	
	/////////////////////////////////////////////
//DELETE MODAL
	function delAction(){
		global $_CON;
		if(isset($_POST['btn_del'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['DEL_ID']);
			$sqlDel = mysqli_query($_CON, "DELETE FROM loan_type WHERE type_id='$_ID' ");
			if($sqlDel){
				ob_end_clean();
				header("location: loantypes.php?del=true");
			}else{
				ob_end_clean();
				header("location: loantypes.php?del=false");
			}
		}
	}
?>