<?php
session_start();
include 'utilities.php';
$con = getconnection();
$usertype = $_REQUEST['usertype'];
mysqli_select_db($con, "cybercrimesystem");
$login_id = $_SESSION['loginid'];
if ($usertype == 3) {
    $result = mysqli_query($con, "update tbl_login set usertype_id=4 where login_id='" . $login_id . "'");
} else if($usertype == 1) {
    $result = mysqli_query($con, "delete from tbl_login where login_id='" . $login_id . "'");
}
if ($result > 0) {
    echo "<script>alert('Account Successfully Deleted.');<script>";
    session_destroy();
    header("Location:index.php");
} else {
    echo "<script>alert('Unable to Delete Account.');<script>";
    header("Location:index.php");
}
