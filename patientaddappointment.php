<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include("adheader.php");
include("dbconnection.php");

if(isset($_SESSION['patientid']))
{
    $sql="SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql); 
}

?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Book Appointment</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2><span class="bolded">Appointment Information</span></h2>
                </div>
                <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
                    <input type="hidden" name="select2" value="Offline">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Patient's Name</label>
                                        <input class="form-control" type="text" name="patientname" id="patientname" 
                                        readonly value="<?php echo $rsedit['patientname']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Doctor's Name</label>
                                        <select name="doctorname" id="doctorname" class="form-control show-tick">
                                            <option value="">--- Select Doctor ---</option>
                                            <?php
                                            $sqldoctor= "SELECT doctor.doctorid, doctor.doctorname, doctor.departmentid, department.departmentname FROM doctor INNER JOIN department ON doctor.departmentid=department.departmentid WHERE doctor.status='Active' ";
                                            $qsqldoctor = mysqli_query($con,$sqldoctor);
                                            while($rsdoctor = mysqli_fetch_array($qsqldoctor))
                                            {
                                                    //if($rsdoctor['doctorid'] == $rsedit['doctorid'])
                                                if($rsdoctor['doctorid'] == $rsedit['doctorid'])
                                                {
                                                    echo "<option value='$rsdoctor[doctorid]|$rsdoctor[departmentid]' selected>$rsdoctor[doctorname] - [ $rsdoctor[departmentname] ] </option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='$rsdoctor[doctorid]|$rsdoctor[departmentid]'>$rsdoctor[doctorname] - [ $rsdoctor[departmentname] ] </option>";         
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-11">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Appointment Date</label>
                                        <input class="form-control" type="date" name="appointmentdate" id="appointmentdate" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-14">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Appointment Time</label>
                                        <input class="form-control" type="time" name="time" id="time" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-10">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Reason</label>
                                        <textarea rows="4" class="form-control no-resize" name="appreason" id="appreason"/></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-10">
                                <div class="form-group drop-custum">
                                    <label>Status</label>
                                    <input class="form-control" type="text" name="status" id="status" value="Active" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                            value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 

include ("adfooter.php"); 

if(isset($_POST['submit']))
{

    $resultDocDept = $_POST['doctorname'];
    $resultExplode = explode('|', $resultDocDept);
    $doctorid = $resultExplode[0];
    $departmentid = $resultExplode[1];

    if(isset($_GET['editid']))
    {
        $sql ="UPDATE appointment SET patientid='$rsedit[patientid]', departmentid=$departmentid, appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]', doctorid=$doctorid, status='$_POST[status]' WHERE appointmentid='$_GET[editid]'";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<script>alert('Appointment record updated successfully');";
            echo "window.location.href='patientaccount.php';</script>";
        }
        else
        {
            echo mysqli_error($con);
        }   
    }
    else
    {
        $sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) 
        values('$rsedit[patientid]', $departmentid, '$_POST[appointmentdate]','$_POST[time]', $doctorid, '$_POST[status]','$_POST[appreason]')";

        if($qsql = mysqli_query($con,$sql))
        {
            //include("insertbillingrecord.php"); 
            echo "<script>alert('Appointment record inserted successfully');";
            echo "window.location='patientaccount.php?patientid=$rsedit[patientid]';</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
}
?>

<script type="application/javascript">
    function validateform() {
        if (document.frmappnt.patientname.value == "") {
            alert("Patient name should not be empty..");
            document.frmappnt.patientname.focus();
            return false;
        }else if (document.frmappnt.appointmentdate.value == "") {
            alert("Appointment date should not be empty..");
            document.frmappnt.appointmentdate.focus();
            return false;
        } else if (document.frmappnt.time.value == "") {
            alert("Appointment time should not be empty..");
            document.frmappnt.time.focus();
            return false;
        } else if (document.frmappnt.doctorname.value == "") {
            alert("Doctor name should not be empty..");
            document.frmappnt.doctorname.focus();
            return false;
        } else if (document.frmappnt.status.value == "") {
            alert("Kindly select the status..");
            document.frmappnt.status.focus();
            return false;
        } else {
            return true;
        }
    }
</script>