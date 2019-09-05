<?php

include("class/user.php");
$info = "Select Candidate";
$global_cnum = "";
$name = "";

$ca = "";
$department = "";
$experience = "";
$profile = "";
$complete_source = "";
$set = "";

$next_page = new user;


if(isset($_POST['edit_btn'])){
	
		$info = $_POST['candidate_details'];
		
		if($info == ""){
			$message = "Please select candidate to continue. Candidate starts from 2nd row";
			echo "<script>
				alert('$message'); 
				window.location.href='page 2.php'; 
			</script>";
		}

		$dept = explode(" - ",$info);
		$global_cnum = $dept[0];
		//$marks = $userObj -> get_accounting_marks($cnum);
		//$accounting_marks = $marks['marks'];
		//$marks = $userObj -> get_english_marks($cnum);
		//$english_marks = $marks['marks'];
		//$marks = $userObj -> get_aptitude_marks($cnum);
		//$aptitude_marks = $marks['marks'];
		$candidate = $next_page->get_candidate($global_cnum);
		$global_cnum = $candidate['cnum'];
		$name = $candidate['name'];
		$ca = $candidate['ca'];
		$profile = $candidate['profile'];
		
		$department = $candidate['department'];
		$experience = $candidate['experience'];
		$set = $candidate['q_set'];
		if($candidate['subsource'] == ""){$subsource = "";}else{$subsource = " - ".$candidate['subsource'];}
		if($candidate['consultancy'] == ""){$consultancy = "";}else{$consultancy = " - ".$candidate['consultancy'];}
		if($candidate['other_source'] == ""){$other_src = "";}else{$other_src = " - ".$candidate['other_source'];}
		$complete_source = $candidate['source'].$subsource.$consultancy.$other_src;
		
			
		
		//print_r($candidate);
		$next_page->set_session($global_cnum,$dept[1],$dept[2],$dept[3],$dept[4]);
		//if($source['subsource'] == ""){$subsource = "";}else{$subsource = " - ".$source['subsource'];}
		//if($source['consultancy'] == ""){$consultancy = "";}else{$consultancy = " - ".$source['consultancy'];}
		//if($source['other_source'] == ""){$other_src = "";}else{$other_src = " - ".$source['other_source'];}
		//$complete_source = $source['source'].$subsource.$consultancy.$other_src;
	}

if(isset($_POST['goToWelcomePage'])){
	
	$info = $_POST['department'];
	$dept = explode(" - ",$info);
	//echo $dept[2];
	
	$cnum = $dept[0];
	$name = $dept[1];
	$dept_name = $dept[2];
	$profile = $dept[3];
	$set = $dept[4];
	
	$check_query = "select * from result where cnum = '$cnum'";
	
	if($next_page->check_entry($check_query) == 0){
		
		$next_page -> set_session($cnum,$name,$dept_name,$profile,$set);
		
		if($dept_name == "Accounting"){
			$next_page->url("Welcome Screen/accounting welcome.php");
		}else if($dept_name == "HR"){
			$next_page->url("Welcome Screen/HR welcome.php");
		}else if($dept_name == "Admin"){
			$next_page->url("Welcome Screen/Admin welcome.php");
		}else{
			$message = "Please select candidate to continue";
			echo "<script>
					alert('$message'); 
					window.location.href='page 2.php'; 
				</script>";
		}
	}else{
		$message = "Candidate has already given the test.";
		echo "<script>
			alert('$message'); 
			window.location.href='page 2.php'; 
		</script>";
	}
	
		
}
if(isset($_POST['make_changes'])){
	extract($_POST);
	
	//echo $_POST['make_changes'];
	
	//$cnum = $dept;
	$cnum = $cnum;
	$name = $update_name;
	$dept_name = $update_department;
	$profile = $update_profile;
	$set = $update_set;
	$message = "Are you sure to make changes";
	
	
	$query = "update candidate set name = '$name', department = '$dept_name', profile = '$profile', experience = '$update_experience',
		ca = '$update_ca', source = '$source', subsource = '$subsource', consultancy = '$consultancy', other_source = '$othersource', q_set = '$set' where cnum = '$cnum'";
	$next_page->register($query);
	$next_page->url("page 2.php");
	//$next_page -> set_session($cnum,$name,$dept_name,$profile,$set);
	

	
		
}

?>

<!doctype html>


<html>
	<head>
		<title>page2</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style>
		select {
        width: 150px;
      
		height : 25px;
		}
		select:focus {
        max-width: 500px;
        width: auto;
		
		
		}
		table, th, td {
				border:1px solid black;
				border-collapse: collapse;
				padding-left : 10px;
				padding-right: 10px;
				padding-top : 5px;
				padding-bottom : 5px;
				border-spacing: 10px;
  
				}
			table{
			margin : 0 auto;
			width : 100%;
			}
			* {
      font-family: times new roman;
    }
		</style>

	</head>
<body onload = "changeFont('department')">
	<br>
	<div id="container" align="center" >
		<img src="img/cis.jpg" alt=""  width = "160" height = "75" />
	</div>

	
<div class="container" >
	<div class="row">
		
	
	
	<div class = "col-sm-6">
	
		<div align = "right" style = "visibility:hidden">
			<a type="submit" name = "logout" href = "logout.php" style="width: 100px; height: 45px;"><font face = "Times New Roman" size="4" color = "01a0c7"><b>Logout</b></font></a>
		</div>
		
		<div class="panel panel-primary" >
			<div class = "panel-heading" align = "center" style="background-color:#081450;"><font face = "Times New Roman"><h3><b>Select Candidate</b></h3></font>
			</div>
			<div class = "panel-body">
			
			
			
			<form action="#" method="post">
			
				<div align = "center">
					<div>
						<p id = "date"><font face = "times new roman" size = "3"><b><?php
							if(function_exists('date_default_timezone_set')) {
							date_default_timezone_set("Asia/Kolkata");
							}
							//echo date("l j  F Y ")
							echo date("l j  F Y "); ?>
							</b></font>
						</p>
					</div>
					<div>
						<select ID = "department"  name = "candidate_details" onchange = "transferValue(this.id,'hidden_info')">
							<OPTION value = "">Select Candidate</option>
					
							<?php
							
							$candidate_info = new user;
							$candidate_info->show_candidate();
							
							foreach($candidate_info->candidate as $candi)
							{
							?>
						 
						
							<OPTION ><?php echo $candi['cnum']." - ".$candi['name']." - ".$candi['department']." - ".$candi['profile']." - ".$candi['q_set'].
							" - ".$candi['register_time']; ?></option>
						
							<?php   }  ?> 
							
						</select>
							
					
					</div>
				
				
				</div>
				<br>
				<br>
				<br>
				<span style = "float:left">
					<button type="submit" name = "edit_btn" class="btn btn-default" style="width: 100px; height: 45px;""><font face = "Times New Roman" size="4"><b>EDIT</b></font></button>
				</span>
			</form>
			<form action = "#" method = "post">
				<input type = "text" name = "department" id = "hidden_info" size = "70" style="visibility:hidden;display:none;">
				<span style = "float:right">
					<button type="submit" name = "goToWelcomePage" class="btn btn-default" style="width: 100px; height: 45px;""><font face = "Times New Roman" size="4"><b>NEXT</b></font></button>
				</span>
			</form>
			
			
			</div>
		</div>
		
			
	</div>
	<div class = "col-sm-6">
		<div align = "right">
			<a type="submit" name = "logout" href = "logout.php" style="width: 100px; height: 45px;"><font face = "Times New Roman" size="4" color = "01a0c7"><b>Logout</b></font></a>
		</div>
		<div class="panel panel-primary" >
			<div class = "panel-heading" align = "center" style="background-color:#081450;"><font face = "Times New Roman"><h3><b>Details</b></h3></font>
			</div>
			<div class = "panel-body">
				<form action = "#" method = "post">
					<div id = "edit_info" style = "">
						<table>
							<col width="300">
							<col width="350">
							<col width="350">
								<tr>
									<th>Name</th>
									
										<td>
											<p><?php echo $name  ?></p>
											
										</td>
									
									<td>
										<input type = "text" id = "cnum" name = "cnum" style = "visibility:hidden;display:none" value = "<?php echo $global_cnum  ?>"> 
										
										<input type = "text" id = "update_name" size = "16" name = "update_name" value = "<?php echo $name  ?>" required>
									</td>
									
								</tr>
								<tr>
									<th>Source</th>
									<td>					
										<p><?php echo $complete_source; ?></p>
									</td>
									<td>
										<select ID = "source" name = "source" style="width:150px" onchange="populate(this.id,'subsource');
											showSpanForSource('source','subsource','consultancy','textbox');changeFont(this.id)" required>
											<OPTION value = ""></option>
											<OPTION VALUE = "Online">Online</option>
											<OPTION VALUE = "Consultancy">Consultancy</option>
											<OPTION VALUE = "Reference">Reference</option>
											<OPTION VALUE = "Other">Other</option>
										</select>	
										<span id ="selectbox" >
											<select ID = "subsource" name = "subsource" style = "visibility:hidden; display:none; width:150px"  onchange = "populate('subsource','consultancy');
												showSpanForSubsource('subsource','consultancy','textbox');changeFont(this.id)"></select>	
										</span>
										<span>
											<select id = "consultancy" name = "consultancy" style = "visibility:hidden; display:none; width:150px" onchange = "changeFont(this.id)">
												<option value = ""></option>
											</select>
										</span>
										<span id = "textbox" name = "othersrc" style = "visibility:hidden; display:none">
											<input id = "othersource" type = "text" name = "othersource" size="26" oninput="changeFont(this.id)">
										</span>
									</td>
									
								</tr>
								<tr>
									<th>CA</th>
									<td>
											<p><?php echo $ca  ?></p>
											
									</td>
									<td>
										
										<input type = "radio" id="yes_update_ca" name = "update_ca" value = "YES" <?php echo ($ca== 'YES')?"checked":"" ;?>> Yes
										<input type = "radio" id="no_update_ca" name = "update_ca" value = "NO" <?php echo ($ca== 'NO')?"checked":"" ;?>> No
									
									</td>
									
								</tr>
								<tr>
									<th>Department</th>
									<td>
											<p><?php echo $department; ?></p>
											
									</td>
									<td>
										<select  id="update_department" name = "update_department" style="width:150px" onchange = "populate(this.id,'update_profile')" required>
											<option><?php echo $department; ?></option>
											<OPTION value = "Accounting">Accounting</option>
											<OPTION value = "Admin">Admin</option>
											<OPTION value = "HR">HR</option>
											<OPTION value = "Tech">Tech</option>
										</select>
									</td>
									
									
								</tr>
								<tr>
									<th>Relevant Experience</th>
									<td>
											<p><?php echo $experience;  ?></p>
											
									</td>
									<td ><input type = "number" id="update_experience" name = "update_experience" style="width:150px" value = "<?php echo $experience;  ?>" required></td>
									
								</tr>
								<tr>
									<th>Profile</th>
									<td>
											<p><?php echo $profile;?></p>
											
									</td>
									<td><select ID = "update_profile" name = "update_profile" style = "width:150px" required></select></td>
								
								<tr>
								<tr>
									<th>Set</th>
									<td>
											<p><?php echo $set  ?></p>
											
									</td>
									<td>
										<select  id="update_set" name = "update_set" style="width:150px" required>
											<option ><?php echo $set; ?></option>
											<option value = "Basic">Basic</option>
											<option value = "Intermediate">Intermediate</option>
											<option value = "Advanced">Advanced</option>
											<option value = "Professional">Professional</option>
										</select>
										
									</td>
								<tr>
								
						</table>
						<br>
						<div align = "center">
							<button type="submit" name = "make_changes" onclick = "return confirm('are you sure')" class="btn btn-default" style="width: 100px; height: 45px;""><font face = "Times New Roman" size="4"><b>DONE</b></font></button>
						</div>
					</div>
				</form>
				
	</div>
	</div>
	
	
</div>



<script src = "js/candidate.js" type = "text/javascript"></script>
</body>
</html>
