<?php

session_start();

include("adformheader.php");
include("dbconnection.php");

if(isset($_GET['delid']))
{
	$sql ="DELETE FROM admin WHERE adminid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Admin record deleted successfully');</script>";
	}
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center"> View Admin </h2>
  </div>
</div>

<div class="card">
  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

      <thead>
        <tr>
          <td width="12%" height="40">Admin Name</td>
          <td width="11%">Login ID</td>
          <td width="12%">Status</td>
          <td width="10%">Action</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql ="SELECT * FROM admin";
        $qsql = mysqli_query($con,$sql);
        while($rs = mysqli_fetch_array($qsql))
        {
          echo "<tr>
          <td>$rs[adminname]</td>
          <td>$rs[loginid]</td>
          <td>$rs[status]</td>
          <td>
          <a href='admineditprofile.php?editid=$rs[adminid]' class='btn btn-raised g-bg-cyan'>Edit</a>
          <a href='viewadmin.php?delid=$rs[adminid]' class='btn btn-raised g-bg-blush2'>Delete</a>
          </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </section>
</div>
<!-- <script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete this Admin? ")) {
    document.location = delUrl;
  }
}
</script> -->
<?php
include("adformfooter.php");
?>