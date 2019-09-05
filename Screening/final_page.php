
<?php

include("class/user.php");
$userObj = new user;

if(isset($_POST['end_screening'])){
$userObj->clear_session();
$userObj->url("final_page.php");

}
	


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receptionist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
<script>
	window.location.hash="no-back-button";
	window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
	window.onhashchange=function(){window.location.hash="no-back-button";}
</script>   

</head>


<body>

<br>
<div id="container" align="center" >
    <img src="img/cis.jpg" alt=""  width = "160" height = "75" />
</div>



<div class="container" >
	<div class="row">
	<div class = "col-sm-3" style = "visibility:hidden">
		<br>
		<div class="panel panel-primary" >
			
		</div>
	</div>
	
	<div class = "col-sm-6">
		<div align = "right">
			<a type="submit" name = "logout" href = "logout.php" style="width: 100px; height: 45px;"><font face = "Times New Roman" size="4" color = "01a0c7"><b>Logout</b></font></a>
		</div>
		<div class="panel panel-primary" >
			<div class = "panel-heading" align = "center" style="background-color:#081450;"><font face = "Times New Roman"><h3><b>Exam Over</b></h3></font>
			</div>
			<div class = "panel-body">
						<p><font face = "times new roman" size = "4"><b>Your screening test is now complete! Thank you so much for attempting the test. </b></font></p>
						<br>
						<p><font face = "times new roman" size = "4"><b>Please inform the HR Manager now and wait in the designated waiting area. 
						You will be briefed further about your candidature shortly.</b></font></p>
						<br><br>
			
			<form action="#" method = "post">	
				<div align = "center">
				<button type="submit" class="btn btn-default" name = "end_screening" style="width: 200px; height: 45px;"><font face = "Times New Roman" size="4"><b>End Screening</b></font></button>
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
<script src = "js/recruitment.js" type = "text/javascript"></script>
</body>
</html>