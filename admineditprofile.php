<?php

    include("adheader.php");
    include("dbconnection.php");

    if(isset($_GET['editid']))
    {
        $sql="SELECT * FROM admin WHERE adminid='$_GET[editid]' ";
        $qsql = mysqli_query($con,$sql);
        $rsedit = mysqli_fetch_array($qsql);
    }
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Admin's Profile</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmdoctprfl" onSubmit="return validateform()" style="padding: 10px">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Admin's Name</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="adminname" id="adminname"
                                        value="<?php echo $rsedit['adminname']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Login ID</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="loginid" id="loginid"
                                        value="<?php echo $rsedit['loginid']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <input class="btn btn-raised" type="submit" name="submit" id="submit" value="Submit" />
                    </div>
                </form>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php
    include("adfooter.php");

    if(isset($_POST['submit']))
    {
        // if(isset($_SESSION['adminid']))
        // {
            $sql ="UPDATE admin SET adminname='$_POST[adminname]', loginid='$_POST[loginid]' WHERE adminid='$_GET[editid]'";

            if($qsql = mysqli_query($con,$sql))
            {
                echo "<script>alert('Admin profile updated successfully');";
                echo "window.location.href='viewadmin.php';</script>";
            }
            else
            {
                echo mysqli_error($con);
            }   
        // }
        // else
        // {
        //     $sql ="INSERT INTO admin(adminname, loginid) values('$_POST[adminname]', '$_POST[loginid]')";

        //     if($qsql = mysqli_query($con,$sql))
        //     {
        //         echo "<script>alert('Admin record inserted successfully');";
        //         echo "window.location.href='viewadmin.php';</script>";
        //     }
        //     else
        //     {
        //         echo mysqli_error($con);
        //     }
        // }
    }
?>

<script type="application/javascript">
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
</script>
