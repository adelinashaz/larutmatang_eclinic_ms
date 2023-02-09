<?php

session_start();

include("adheader.php");
include("dbconnection.php");

?>
<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center"> Admin's Password</h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
			<div class="card">
				<form method="post" action="" name="frmadminchange" onSubmit="return validateform1()">
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12">   
								<div class="form-group">
									<div class="form-line">
										<input class="form-control" type="password" name="oldpassword" id="oldpassword" placeholder="Old Password" />
									</div>
								</div>
							</div>	
						</div>
						<div class="row clearfix"> 
							<div class="col-sm-12">                           
								<div class="form-group">
									<div class="form-line">
										<input class="form-control" type="password" name="newpassword" id="newpassword" placeholder="New Password" />
									</div>
								</div>    
							</div>                      
						</div>  
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<div class="form-line">
										<input class="form-control" type="password" name="password" id="password" placeholder="Confirm Password" />
									</div>
								</div>
							</div>                          
						</div>                     
						<div class="col-sm-12">
							<input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Submit" />

						</div>
					</div>

				</form>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<?php
include("adfooter.php");
//kalau page lain still loading, try komenkan dekat php section. if page appear, maknanya ada problem dengan php code
if(isset($_POST['submit']))
{
	// validation for old password inserted is same with existing password.
	$sqlpassword = "SELECT * FROM admin WHERE adminid='$_SESSION[adminid]'";
	$qpassword = mysqli_query($con,$sqlpassword);
	$resultpassword = mysqli_fetch_array($qpassword);
	if($resultpassword['password'] != $_POST['oldpassword'])
	{
		echo "<script>alert('Old password wrong!');";
		echo "window.location.href='adminchangepassword.php';</script>";

	// } else if($resultpassword['password'] == $_POST['oldpassword']) {
	// 	echo "<script>alert('New password cannot be same with old password');";
	// 	echo "window.location.href='adminchangepassword.php';</script>";

	} else {
		$sql = "UPDATE admin SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND adminid='$_SESSION[adminid]'";
		if(mysqli_query($con,$sql))
		{
			echo "<script>alert('Password updated successfully');";
			echo "window.location.href='adminchangepassword.php';</script>";
		}
		else
		{
			echo "<div class='alert alert-warning'>
			Admin password update failed
			</div>";		
		}
	}
}
?>

<script type="application/javascript">
	function validateform1()
	{
		if(document.frmadminchange.oldpassword.value == "")
		{
			alert("Old password should not be empty..");
			document.frmadminchange.oldpassword.focus();
			return false;
		}
		else if(document.frmadminchange.newpassword.value == "")
		{
			alert("New Password should not be empty..");
			document.frmadminchange.newpassword.focus();
			return false;
		}
		else if(document.frmadminchange.newpassword.value.length < 8)
		{
			alert("New Password length should be more than 8 characters...");
			document.frmadminchange.newpassword.focus();
			return false;
		}
		else if(document.frmadminchange.newpassword.value != document.frmadminchange.password.value )
		{
			alert("New Password and confirm password should be equal..");
			document.frmadminchange.password.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
</script>
