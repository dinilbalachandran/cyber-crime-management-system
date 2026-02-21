<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="mainlogin">
        <div class="headercontainer">
            <img class="logo" src="img/Picsart.png">
            <div class="header">
                <h1>Cyber Crime System</h1>
                <p>Your portal for reporting and tracking cyber crimes.</p>
            </div>
        </div>
        <div class="logincontent">
            <h1>Hello,</h1>
            <h2>Welcome Back</h2>
        </div>
        <div class="logincontainer">
            <h3>Login</h3>
            <div class="loginformline">
                <form action="#" method="post">
                    <label id="lu">Username</label><br>
                    <input type="text" name="username" placeholder="Enter your username" required /><br>
                    <label id="l">Password</label><br>
                    <input type="password" name="password" placeholder="Enter your password" required /><br>
                    <button>LOGIN</button><br>
                    <p>Don't have an account? <a id="a" href="register.php">SIGN UP</a></p>
                </form>
            </div>
        </div>
        <div class="loginfooter">
            <h2>About Cyber Defense System</h2>
            <p>Cyber Defense System is designed to help individuals report cyber crimes quickly and efficiently.<br>Reports
                are directed to the nearest police stations, ensuring prompt action. Users can track the status of their cases
                in<br>real-time, providing transparency and peace of mind. Our goal is to provide a secure and streamlined process for
                handling<br>cyber crime incidents, connecting citizens
                directly with law enforcement agencies dedicated to combating online threats.</p>
            <footer>
                <p id="copyright">&copy; 2024 Cyber Crime System. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>

</html>
<?php
/*
    ---------------------------------------
    |usertype_id | Meaning                |
    ---------------------------------------
    |     1      | Admin                  |
    |     2      | Police Station         |
    |     3      | Citizen                | 
    |     4      | Deleted Citizen Account|
    ---------------------------------------     
    */
if (isset($_POST['username'])) {
    include 'utilities.php';
    $username = encrypt($_POST['username']);
    $password = sha1($_POST['password']);
    $con = getconnection();
    mysqli_select_db($con, "cybercrimesystem");
    $qry = "select * from tbl_login where username='" . $username . "' and password='" . $password . "'";
    $result = mysqli_query($con, $qry);
    if ($details = mysqli_fetch_array($result)) {
        $usertype = $details['usertype_id'];
        session_start();
        $_SESSION['username'] = decrypt($details['username']);
        $_SESSION['loginid'] = $details['login_id'];
        $_SESSION['login_id'] = $details['login_id'];
        switch ($usertype) {
            case 1:
                header("Location:adminhome.php");
                break;
            case 2:
                $result = mysqli_query($con, "select station_id from tbl_policestation where login_id='" . $_SESSION['login_id'] . "'");
                $row = mysqli_fetch_array($result);
                $_SESSION['station_id'] = $row['station_id'];
                header("Location:stationhome.php");
                break;
            case 3:
                header("Location:citizenhome.php");
                break;
            default:
                echo "<script>alert('Account does not exist');</script>";
                break;
        }
    } else {
        echo "<script>alert('Incorrect Username or Password');</script>";
    }
}
?>