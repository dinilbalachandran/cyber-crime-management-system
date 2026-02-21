<?php
session_start();
include 'utilities.php';
$con = getconnection();
mysqli_select_db($con,"cybercrimesystem");
$r = mysqli_query($con,"select * from tbl_login where login_id=20");
$t = mysqli_fetch_array($r);
echo decrypt($t['username']);
?>