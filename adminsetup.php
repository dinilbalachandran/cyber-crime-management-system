<?php
include 'utilities.php';
$con = getconnection();
$sql = "select * from tbl_login where usertype_id=1";
mysqli_select_db($con, "cybercrimesystem");
$result = mysqli_query($con, $sql);
if (!$no = mysqli_fetch_array($result)) {
?>
    <html>

    <head>
        <title>Admin Setup</title>
    </head>

    <body>
        <form action="#" method="post">
            <table>
                <tr>
                    <h2>ADMIN SETUP</h2>
                </tr>
                <tr>
                    <input type="text" name="uname" placeholder="username" require><br>
                </tr>
                <tr>
                    <input type="password" name="pword" placeholder="password" required><br>
                </tr>
                <tr>
                    <input type="submit" value="Proceed" onclick="return confirm('Are you sure you want to continue?')">
                </tr>
            </table>
        </form>
    </body>

    </html>
<?php
    if (isset($_POST['uname'])) {
        $uname = encrypt($_POST['uname']);
        $pword = sha1($_POST['pword']);
        $chkqry = "select * from tbl_login where username='" . $uname . "'";
        $chk = mysqli_query($con, $chkqry);
        if (!$c = mysqli_fetch_array($chk)) {
            $chk = "insert into tbl_login(username,password,usertype_id) values('" . $uname . "','" . $pword . "',1)";
            $result = mysqli_query($con, $chk);
            if ($result > 0) {
                echo "<script>alert('Admin Setup Completed Successfully!')</script>";
            } else {
                echo "<script>alert('Unable Completed Request.')</script>";
            }
        } 
        else {
            echo "<script>alert('Username already exist. Try another one.')</script>";
        }
    }
} else {
    echo "AN ADMINISTRATOR ALREADY EXIST!";
}
?>