<?php
/* Copyright (C) :DANICA JOYCE DALUDADO: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by DANICA JOYCE DALUDADO, OCTOBER 2016
 */
//////////////////////////////////////////////////////
include_once('connect.php');
include_once'class.whois.php';
date_default_timezone_set('Asia/Manila');
$_NOW = date("Y-m-d h:i:s"); 

/////////////////////////////////////////////
//USER ADD LOAN !
	function add(){
		global $_CON;
		global $_NOW;
		if(isset($_POST['btn_save'])){
			//////////////////////////////
			//CURRENT USER ID
			$usr_ID = usrID();
			//////////////////////////////////////////////////////////////////////////////////////////////
			//CHECK IF SAME LOAN TYPE EXIST FOR THE SAME USER !
			$sqlSearch = mysqli_query($_CON, "SELECT
			client_id
			FROM
			user_more_info
			WHERE
			client_id='$usr_ID'");
			$count = mysqli_num_rows($sqlSearch);
			if($count > 0){
				ob_end_clean();
				header("location: personal.more.info.php?add=exist");
			}else{
			///////////////////////////////////////////////////////////////////////////
			//GET USER INPUT 
			$inpOFFICE = mysqli_real_escape_string($_CON, $_POST['inpOFFICE']);
			$inpDESIGNATION = mysqli_real_escape_string($_CON, $_POST['inpDESIGNATION']);
			$inpMONTHLYSALARY = mysqli_real_escape_string($_CON, $_POST['inpMONTHLYSALARY']);
			$inpYEARSINSERVICE = mysqli_real_escape_string($_CON, $_POST['inpYEARSINSERVICE']);
			$inpIFMARRIED = mysqli_real_escape_string($_CON, $_POST['inpIFMARRIED']);
			$inpNAMESPOUSE = mysqli_real_escape_string($_CON, $_POST['inpNAMESPOUSE']);
			$inpTAXPAYERIDNUMBER = mysqli_real_escape_string($_CON, $_POST['inpTAXPAYERIDNUMBER']);
			$inpCITIZENSHIP = mysqli_real_escape_string($_CON, $_POST['inpCITIZENSHIP']);
			$inpDATEOFBIRTH = mysqli_real_escape_string($_CON, $_POST['inpDATEOFBIRTH']);
			$inpPLACEOFBIRTH = mysqli_real_escape_string($_CON, $_POST['inpPLACEOFBIRTH']);
			$inpHEIGHT = mysqli_real_escape_string($_CON, $_POST['inpHEIGHT']);
			$inpWEIGHT = mysqli_real_escape_string($_CON, $_POST['inpWEIGHT']);
			$inpBLOODTYPE = mysqli_real_escape_string($_CON, $_POST['inpBLOODTYPE']);
			$inpADDRESS = mysqli_real_escape_string($_CON, $_POST['inpADDRESS']);
			$inpCELLNO = mysqli_real_escape_string($_CON, $_POST['inpCELLNO']);
			$inpTELNO = mysqli_real_escape_string($_CON, $_POST['inpTELNO']);
			$inpFATHERSNAME = mysqli_real_escape_string($_CON, $_POST['inpFATHERSNAME']);
			$inpFATPLACEOFBIRTH = mysqli_real_escape_string($_CON, $_POST['inpFATPLACEOFBIRTH']);
			$inpMOTHERSNAME = mysqli_real_escape_string($_CON, $_POST['inpMOTHERSNAME']);
			$inpMOTPLACEOFBIRTH = mysqli_real_escape_string($_CON, $_POST['inpMOTPLACEOFBIRTH']);
			$inpEMPLOYEENUMBER = mysqli_real_escape_string($_CON, $_POST['inpEMPLOYEENUMBER']);
			//------------------------------------------------------------------------------------------//

			///////////////////////////////////////////////////
			//GET CLIENT CHILDREN
			$countChild = count($_POST['inpCHILDNAME']);
			for($i=0; $i < $countChild; $i++){
				$inpCHILDNAME = $_POST['inpCHILDNAME'][$i]; 
				$inpCHILDAGE = $_POST['inpCHILDAGE'][$i];
				//INSER CHILD
				$sqlInsertChild = mysqli_query($_CON,"
				INSERT
				INTO
				children_table
				(client_id,
				CHILD_NAME,
				CHILD_AGE)
				VALUES
				('$usr_ID',
				'$inpCHILDNAME',
				'$inpCHILDAGE')");
			}
			//GET CHILDREN END
			/////////////////////////////////////////////////

			///////////////////////////////////////////////////
			//GET CLIENT BENEFICIARIES
			$countBEN = count($_POST['inpBENENAME']);
			for($jv=0; $jv < $countBEN; $jv++){
				$inpBENENAME = $_POST['inpBENENAME'][$jv];
				$inpBENEREL = $_POST['inpBENEREL'][$jv];
				$inpBENEAGE = $_POST['inpBENEAGE'][$jv]; 
				//INSERT BENEFICIARIES
				$sqlInsertBen = mysqli_query($_CON,"
				INSERT
				INTO
				beneficiary_table
				(client_id,
				BEN_NAME,
				BEN_RELATIONSHIP,
				BEN_AGE)
				VALUES
				('$usr_ID',
				'$inpBENENAME',
				'$inpBENEREL',
				'$inpBENEAGE')");
			}
			//GET BENEFICIARIES END
			///////////////////////////////////////////////////
			//INSERT THIS TO USER_MORE_INFO
			$sqlInsert = mysqli_query($_CON, "
			INSERT
			INTO
			user_more_info
			(client_id,
			OFFICE,
			DESIGNATION,
			MONTHLY_SALARY,
			YEARS_IN_SERVICE,
			IF_MARRIED_MAIDEN_NAME,
			NAME_OF_SPOUSE,
			TAX_PAYER_ID_NUMBER,
			CITIZENSHIP,
			HEIGHT,
			WEIGHT,
			BLOOD_TYPE,
			CELL_NO,
			TEL_NO,
			NAME_OF_FATHER,
			FATHER_BIRTHPLACE,
			NAME_OF_MOTHER,
			MOTHER_BIRTHPLACE,
			EMPLOYEE_ID_NUMBER,
			DATE_SIGNED_UP)
			VALUES
			('$usr_ID',
			'$inpOFFICE',
			'$inpDESIGNATION',
			'$inpMONTHLYSALARY',
			'$inpYEARSINSERVICE',
			'$inpIFMARRIED',
			'$inpNAMESPOUSE',
			'$inpTAXPAYERIDNUMBER',
			'$inpCITIZENSHIP',
			'$inpHEIGHT',
			'$inpWEIGHT',
			'$inpBLOODTYPE',
			'$inpCELLNO',
			'$inpTELNO',
			'$inpFATHERSNAME',
			'$inpFATPLACEOFBIRTH',
			'$inpMOTHERSNAME',
			'$inpMOTPLACEOFBIRTH',
			'$inpEMPLOYEENUMBER',
			'$_NOW')");
			//END INSERTION
			//////////////////////////////////////////////////
			//////////////////////////////////////////////////
			//INSERT EDUCATION
			$countBIEN = count($_POST['inpEDUCTYPE']);
			for($bien=0; $bien < $countBIEN; $bien++){
				$inpEDUCTYPE = $_POST['inpEDUCTYPE'][$bien];
				$inpSCHOOLNAME = $_POST['inpSCHOOLNAME'][$bien];
				$inpDEGEARNED = $_POST['inpDEGEARNED'][$bien];
				$inpNOUNITSCOURSE = $_POST['inpNOUNITSCOURSE'][$bien];
				$inpINSIVEATTND = $_POST['inpINSIVEATTND'][$bien];
				$inpHONORSRECIEVED = $_POST['inpHONORSRECIEVED'][$bien];
				//INSERT EDUCATION
				$sqlInsertEduc = mysqli_query($_CON,"
				INSERT
				INTO
				education_table
				(client_id,
				EDUC_TYPE,
				NAME_OF_SCHOOL,
				DEGREE_EARNED,
				UNITS_COMPLETED_COURSE,
				INCLUSIVE_DATE_ATTENDANCE,
				HONORS_RECIEVED)
				VALUES
				('$usr_ID',
				'$inpEDUCTYPE',
				'$inpSCHOOLNAME',
				'$inpDEGEARNED',
				'$inpNOUNITSCOURSE',
				'$inpINSIVEATTND',
				'$inpHONORSRECIEVED')");
			}
			//END INSERT EDUCATION
			//////////////////////////////////////////////////
			//UPDATE CLIENT TABLE more_info field
			$sqlUpdate = mysqli_query($_CON,"
			UPDATE
			client_table
			SET
			more_info=1
			WHERE
			client_id='$usr_ID'");
			//////////////////////////////////////////////////
			header("location: index.php?moreinfo=success");
			ob_end_clean();
			exit;
			}
		}
	}
//////////////////////////////////////////////////////////////////
// PERSONAL INFO
	function usrInfo(){
		global $_CON;
		//////////////////////////////
		//CURRENT USER ID
		$usr_ID = usrID();
		$sqlSearch = mysqli_query($_CON,"
		SELECT *
		FROM
		client_table
		WHERE
		client_id='$usr_ID'");
		while($row=mysqli_fetch_array($sqlSearch)){
			$client_username = $row['client_username'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$gender = $row['gender'];
			$civil_stats = $row['civil_stats'];
			$address = $row['address'];
			$birthdate = New DateTime($row['birthdate']);
			$birthFormat = date_format($birthdate, "M d, Y");
			$birthplace = $row['birthplace'];
			$member_type = $row['member_type'];
			$account_code = $row['account_code'];
			//ACCOUNT TYPE
			if($member_type == 1){$mem = "Regular";}else{$mem = "Associative";}
			//GENDER 
			if($gender == "M"){$gen = "Male";}else{$gen = "Female";}
			$sqlMoreInfo = mysqli_query($_CON,"
			SELECT *
			FROM
			user_more_info
			WHERE
			client_id='$usr_ID'");
			$_row = mysqli_fetch_array($sqlMoreInfo);
			$OFFICE = $_row['OFFICE'];
			$DESIGNATION = $_row['DESIGNATION'];
			$MONTHLY_SALARY = $_row['MONTHLY_SALARY'];
			$YEARS_IN_SERVICE = $_row['YEARS_IN_SERVICE'];
			$IF_MARRIED_MAIDEN_NAME = $_row['IF_MARRIED_MAIDEN_NAME'];
			$NAME_OF_SPOUSE = $_row['NAME_OF_SPOUSE'];
			$TAX_PAYER_ID_NUMBER = $_row['TAX_PAYER_ID_NUMBER'];
			$CITIZENSHIP = $_row['CITIZENSHIP'];
			$HEIGHT = $_row['HEIGHT'];
			$WEIGHT = $_row['WEIGHT'];
			$BLOOD_TYPE = $_row['BLOOD_TYPE'];
			$CELL_NO = $_row['CELL_NO'];
			$TEL_NO = $_row['TEL_NO'];
			$NAME_OF_FATHER = $_row['NAME_OF_FATHER'];
			$FATHER_BIRTHPLACE = $_row['FATHER_BIRTHPLACE'];
			$NAME_OF_MOTHER = $_row['NAME_OF_MOTHER'];
			$MOTHER_BIRTHPLACE = $_row['MOTHER_BIRTHPLACE'];
			$EMPLOYEE_ID_NUMBER = $_row['EMPLOYEE_ID_NUMBER'];
			$DATE_SIGNED_UP = $_row['DATE_SIGNED_UP'];
			$sqlChild = mysqli_query($_CON,"
			SELECT 
			CHILD_NAME,
			CHILD_AGE
			FROM
			children_table
			WHERE
			client_id='$usr_ID'");
			$sqlBen = mysqli_query($_CON,"
			SELECT 
			BEN_NAME,
			BEN_RELATIONSHIP,
			BEN_AGE
			FROM
			beneficiary_table
			WHERE
			client_id='$usr_ID'");
			$sqlEduc = mysqli_query($_CON,"
			SELECT 
			EDUC_TYPE,
			NAME_OF_SCHOOL,
			DEGREE_EARNED,
			UNITS_COMPLETED_COURSE,
			INCLUSIVE_DATE_ATTENDANCE,
			HONORS_RECIEVED
			FROM
			education_table
			WHERE
			client_id='$usr_ID'");
			echo"
				<h2>$last_name, $first_name</h2>
				<h4>$mem</h4>
				<abbr title='User login name'>username: </abbr>$client_username<br> 
				<abbr title='User gender'>gender:</abbr> $gen<br /> 
				<abbr title='Civil Status'>civil status:</abbr> $civil_stats<br /> 
				<abbr title='User address'>address:</abbr> $address<br /> 
				<abbr title='Birthdate'>birthdate:</abbr> $birthFormat<br /> 
				<abbr title='Birth place'>birth place:</abbr> $birthplace<br /> 
				<abbr title='Account code'>account code:</abbr> $account_code<br /> 
				<abbr title='Employee Identification Number'>EMPLOYEE ID NUMBER:</abbr> $EMPLOYEE_ID_NUMBER<br /> 
				<div class='separator line'></div>
				<strong>MORE USER INFORMATION</strong><br/>
				OFFICE: $OFFICE<br /> 
				DESIGNATION: $DESIGNATION<br /> 
				MONTHLY SALARY: $MONTHLY_SALARY<br /> 
				YEARS IN SERVICE: $YEARS_IN_SERVICE<br /> 
				IF MARRIED MAIDEN NAME: $IF_MARRIED_MAIDEN_NAME<br /> 
				NAME OF SPOUSE: $NAME_OF_SPOUSE<br /> 
				TAX PAYER'S IDENTIFICATION NUMBER: $TAX_PAYER_ID_NUMBER<br /> 
				CITIZENSHIP: $CITIZENSHIP<br /> 
				HEIGHT: $HEIGHT(meters)<br /> 
				WEIGHT: $WEIGHT(kilos)<br /> 
				BLOOD TYPE: $BLOOD_TYPE<br /> 
				CELLPHONE NUMBER: $CELL_NO<br /> 
				TELPHONE NUMBER: $TEL_NO<br /> 
				NAME OF FATHER: $NAME_OF_FATHER<br /> 
				FATHER BIRTHPLACE: $FATHER_BIRTHPLACE<br /> 
				NAME OF MOTHER: $NAME_OF_MOTHER<br /> 
				MOTHER BIRTHPLACE: $MOTHER_BIRTHPLACE<br /> 

				<div class='separator line'></div>
				<strong>CHILDREN</strong><br/>";
				while($child_row=mysqli_fetch_array($sqlChild)){
					$CHILD_NAME = $child_row['CHILD_NAME'];
					$CHILD_AGE = $child_row['CHILD_AGE'];
					echo"
					Name: $CHILD_NAME Age: $CHILD_AGE<br /> 
					";
				}
				echo"
				<div class='separator line'></div>
				<strong>BENEFICIARIES</strong><br/>";
				while($ben_row=mysqli_fetch_array($sqlBen)){
					$BEN_NAME = $ben_row['BEN_NAME'];
					$BEN_RELATIONSHIP = $ben_row['BEN_RELATIONSHIP'];
					$BEN_AGE = $ben_row['BEN_AGE'];
					echo"
					Name: $BEN_NAME Relationship: $BEN_RELATIONSHIP Age: $BEN_AGE<br /> 
					";
				}
				echo"
				<div class='separator line'></div>
				<strong>EDUCATION</strong><br/>";
				while($educa_row=mysqli_fetch_array($sqlEduc)){
					$EDUC_TYPE = $educa_row['EDUC_TYPE'];
					$NAME_OF_SCHOOL = $educa_row['NAME_OF_SCHOOL'];
					$DEGREE_EARNED = $educa_row['DEGREE_EARNED'];
					$UNITS_COMPLETED_COURSE = $educa_row['UNITS_COMPLETED_COURSE'];
					$INCLUSIVE_DATE_ATTENDANCE = $educa_row['INCLUSIVE_DATE_ATTENDANCE'];
					$HONORS_RECIEVED = $educa_row['HONORS_RECIEVED'];
					if($EDUC_TYPE == 0){
						$EDT = "ELEMENTARY";
					}elseif($EDUC_TYPE == 1){
						$EDT = "SECONDARY";
					}elseif($EDUC_TYPE == 2){
						$EDT = "VOCATIONAL";
					}elseif($EDUC_TYPE == 3){
						$EDT = "COLLEGE";
					}elseif($EDUC_TYPE == 4){
						$EDT = "POST GRADUATE";
					}
					echo"
					Education type: $EDT<br/>
					Name of School: $NAME_OF_SCHOOL<br /> 
					Degree Earned(write non if Not graduated): $DEGREE_EARNED<br /> 
					Number of Units Completed/Course Title: $UNITS_COMPLETED_COURSE<br /> 
					Inclusive Dates of Attendance: $INCLUSIVE_DATE_ATTENDANCE<br /> 
					Honors Recieved: $HONORS_RECIEVED<br /> 
					";
				}
echo"			<div class='separator line'></div>
			";
		}
	}
	
/////////////////////////////////////////////
//UPDATE METHOD
	function updPWD(){
		global $_CON;
		//////////////////////////////
		//CURRENT USER ID
		$usr_ID = usrID();
		if(isset($_POST['btn_chngpwd'])){
			$inpOldPassword = mysqli_real_escape_string($_CON, $_POST['inpOldPassword']);
			$inpNewPassword = mysqli_real_escape_string($_CON, $_POST['inpNewPassword']);
			$inpNewPasswordRe = mysqli_real_escape_string($_CON, $_POST['inpNewPasswordRe']);
			if($inpNewPassword == $inpNewPasswordRe){
				$sqlSearch = mysqli_query($_CON,"
				SELECT
				password
				FROM
				client_table
				WHERE
				client_id='$usr_ID'");
				$row = mysqli_fetch_array($sqlSearch);
				$oldpassword = $row['password'];
				if($oldpassword == md5($inpOldPassword)){
					$inpNewPassword = md5($inpNewPassword);
					$sqlUpdate = mysqli_query($_CON,"
					UPDATE
					client_table
					SET
					password='$inpNewPassword'
					WHERE client_id='$usr_ID'");					
					header("location: personal.info.php?changepass=true");
					ob_end_clean();
				}else{
					header("location: personal.info.php?changepass=false");
					ob_end_clean();
				}
			}else{
				header("location: personal.info.php?errno=donotmatch");
				ob_end_clean();
			}
		}
	}