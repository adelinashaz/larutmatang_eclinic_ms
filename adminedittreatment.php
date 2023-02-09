<?php
    if(!isset($_SESSION)) 
    { 
    session_start(); 
    }

    include("adformheader.php");
    include("dbconnection.php");

    
    if(isset($_GET['editid']))
    {
        $sql="SELECT * FROM treatment WHERE treatmentid='$_GET[editid]' ";
        $qsql = mysqli_query($con,$sql);
        $rsedit = mysqli_fetch_array($qsql);
    }
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Treatment Details</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmtrtmt" onSubmit="return validateform()">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Treatment Type</label>
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="treatmenttype" id="treatmenttype"  value="<?php echo $rsedit['treatmenttype']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Cost</label>
                                        <div class="form-line">
                                            <input class="form-control" type="number" name="treatment_cost" min="1" step=".01" id="treatment_cost" value="<?php echo $rsedit['treatment_cost']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">         
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Note</label>
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="note" id="note" value="<?php echo $rsedit['note']; ?>" />
                                        </div>
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
            $sql ="UPDATE treatment SET treatmenttype='$_POST[treatmenttype]',treatment_cost='$_POST[treatment_cost]',note='$_POST[note]',status='$_POST[select1]' WHERE treatmentid='$_GET[editid]'";
            if($qsql = mysqli_query($con,$sql))
            {
                echo "<script>alert('Treatment record updated successfully');";
                echo "window.location.href='viewtreatment.php';</script>";
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
    if(document.frmtrtmt.treatmenttype.value == "")
    {
        alert("Treatment name should not be empty..");
        document.frmtrtmt.treatmenttype.focus();
        return false;
    }
    else if(!document.frmtrtmt.treatmenttype.value.match(alphaspaceExp))
    {
        alert("Treatment name not valid..");
        document.frmtrtmt.treatmenttype.focus();
        return false;
    }
    else if(document.frmtrtmt.treatment_cost.value == "")
    {
        alert("Treatment cost should not be empty..");
        document.frmtrtmt.mobileno.focus();
        return false;
    }
    else if(document.frmtrtmt.note.value == "")
    {
        alert("Note should not be empty..");
        document.frmtrtmt.note.focus();
        return false;
    }
    // else if(!document.frmtrtmt.select1.value == "" )
    // {
    //     alert("Kindly select the status..");
    //     document.frmtrtmt.select1.focus();
    //     return false;
    // }
    else
    {
        return true;
    }
}
</script>