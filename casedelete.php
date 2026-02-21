<?php
if (isset($_POST['delete'])) {
    echo "<script>alert('dsfsdfsd.')</script>";
    echo $case_id = $_POST['delete'];
    $result = mysqli_query($con, "delete from tbl_case where case_id='" . $case_id . "'");
    $result += mysqli_query($con, "delete from tbl_casestatus where case_id='" . $case_id . "'");
    $result += mysqli_query($con, "delete from tbl_statusupdates where case_id='" . $case_id . "'");
    if ($result > 2) {
        header('Location:citizencase.php');
    } else {
        echo "<script>alert('Unable to delete case');</script>";
    }
}
