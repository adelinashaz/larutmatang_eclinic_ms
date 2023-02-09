<?php
    if(!isset($_SESSION)) 
    { 
    session_start(); 
    }

    include("adformheader.php");
    include("dbconnection.php");

    
    if(isset($_GET['editid']))
    {
        $sql="SELECT * FROM department WHERE departmentid='$_GET[editid]' ";
        $qsql = mysqli_query($con,$sql);
        $rsedit = mysqli_fetch_array($qsql);
    }
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Doctor's Profile</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmdept" onSubmit="return validateform()">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Department's Name</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="departmentname" id="departmentname"  value="<?php echo $rsedit['departmentname']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="status">Status</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="select1" id="select1" >
                                                <option value="" selected hidden="">Select</option>
                                                <?php
                                                    $arr = array("Active","Inactive");
                                                    foreach($arr as $val)
                                                    {
                                                        if($val == $rsedit['status'])
                                                        {
                                                            echo "<option value='$val' selected>$val</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='$val'>$val</option>";            
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Description</label>
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="description" id="description"  value="<?php echo $rsedit['description']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">                                
                            <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Submit" />
                        </div>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<?php

    include("adfooter.php");

    if(isset($_POST['submit']))
    {
        if(isset($_GET['editid']))
        {
            $sql ="UPDATE department SET departmentname='$_POST[departmentname]',description='$_POST[description]',status='$_POST[select1]' WHERE departmentid='$_GET[editid]'";
            if($qsql = mysqli_query($con,$sql))
            {
                echo "<script>alert('Department record updated successfully');";
                echo "window.location.href='viewdepartment.php';</script>";
            }
            else
            {
                echo mysqli_error($con);
            }
        }
        else
        {
            echo mysqli_error($con);
        }
    }

?>

<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
    if(document.frmdept.departmentname.value == "")
    {
        alert("Department name should not be empty..");
        document.frmdept.departmentname.focus();
        return false;
    }
    else if(!document.frmdept.departmentname.value.match(alphaspaceExp))
    {
        alert("Department name not valid..");
        document.frmdept.departmentname.focus();
        return false;
    }
    else if(document.frmdept.select.value == "" )
    {
        alert("Kindly select the status..");
        document.frmdept.select.focus();
        return false;
    }
    
    else
    {
        return true;
    }
}
</script>