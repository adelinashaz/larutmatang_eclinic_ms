<?php

include("dbconnection.php");
include("adheader.php");

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


if(isset($_SESSION['adminid']))
{
	$sql = $con->query("SELECT * FROM admin WHERE adminid='$_SESSION[adminid]' ");
	// $qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($sql,MYSQLI_ASSOC);
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center"> Admin Profile</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmadminprofile" onSubmit="return validateform()">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label> Name: <?php echo $rsedit['adminname']; ?></label>  
                                             
                                      <!--   <input type="text" class="form-control" name="adminname" id="adminname"
                                            value="<?php //echo $rsedit['adminname']; ?>" /> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Role: <?php echo $rsedit['loginid']; ?></label>
                                        
                                        <!-- <input type="text" class="form-control" name="loginid" id="loginid"
                                            value="<?php //echo $rsedit['loginid']; ?>" /> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Status: <?php echo $rsedit['status']; ?></label>
                                        
                                    <!-- <input type="text" class="form-control" name="loginid" id="loginid"
                                        value="<?php //echo $rsedit['loginid']; ?>" /> -->
                                    </div>
                                </div>
                            </div>

                        <!-- <div class="col-sm-12">
                            <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                                value="Submit" />

                        </div> -->
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>
<?php

/*if(isset($_POST['submit']))
{
    if(isset($_SESSION['adminid']))
    {
        $sql ="UPDATE admin SET adminname='$_POST[adminname]',loginid='$_POST[loginid]',status='$_POST[status]' WHERE adminid='$_SESSION[adminid]'";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<div class='alert alert-success'>
            Admin record updated successfully
            </div>";
            
        }
        else
        {
            echo mysqli_error($con);
        }   
    }
    else
    {
        $sql ="INSERT INTO admin(adminname,loginid,status) values('$_POST[adminname]','$_POST[loginid]','$_POST[status]')";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<div class='alert alert-success'>
            Administrator record inserted successfully
            </div>";

        }
        else
        {
            echo mysqli_error($con);
        }
    }
} */
			include("adfooter.php");
			?> 
<!-- <script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmadminprofile.adminname.value == "") {
        alert("Admin name should not be empty..");
        document.frmadminprofile.adminname.focus();
        return false;
    } else if (!document.frmadminprofile.adminname.value.match(alphaspaceExp)) {
        alert("Admin name not valid..");
        document.frmadminprofile.adminname.focus();
        return false;
    } else if (document.frmadminprofile.loginid.value == "") {
        alert("Login ID should not be empty..");
        document.frmadminprofile.loginid.focus();
        return false;
    } else if (!document.frmadminprofile.loginid.value.match(alphanumericExp)) {
        alert("Login ID not valid..");
        document.frmadminprofile.loginid.focus();
        return false;
    } else if (document.frmadminprofile.select.value == "") {
        alert("Kindly select the status..");
        document.frmadminprofile.select.focus();
        return false;
    } else {
        return true;
    }
}
</script> -->