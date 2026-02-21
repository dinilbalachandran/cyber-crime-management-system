<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="mainreg">
        <div class="headercontainer">
            <img class="logo" src="img/Picsart.png">
            <div class="header">
                <h1>Cyber Crime System</h1>
                <p>Your portal for reporting and tracking cyber crimes.</p>
            </div>
        </div>
        <div class="regcontent">
            <h1>Why Register?</h1>
            <ul type="square">
                <li>
                    <h3>Report Cyber Crimes Quickly</h3>
                </li>
                <li>
                    <h3>Track Your Case</h3>
                </li>
                <li>
                    <h3>Get Help Fast</h3>
                </li>
            </ul>
        </div>
        <div class="registrationbox">
            <h2>Register Here</h2>
            <form action="#" method="post" onsubmit="return confirm('By Registering, you agree to our Terms and Policy.\nYour details will be visible to respected authorities.\nClick \'OK\' to continue.');">
                <div class="regformline">
                    <label for="full-name">Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="regformline">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="regformline">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter your email address" required>
                </div>
                <div class="regformline">
                    <label for="mobile">Mobile</label>
                    <input type="tel" name="mobile" pattern="[0-9]{10}" placeholder="Enter your 10 digit mobile number" required>
                </div>
                <div class="regformline">
                    <label for="address">Address</label>
                    <textarea name="address" placeholder="Enter your address" required></textarea>
                </div>
                <div class="regformline">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Create a username" required>
                </div>
                <div class="regformline">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Create a strong password" required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="regfooter">
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
if (isset($_POST['name'])) {
    include 'utilities.php';
    $con = getconnection();
    mysqli_select_db($con, "cybercrimesystem");
    $name = encrypt(ucfirst($_POST['name']));
    $dob = encrypt($_POST['dob']);
    $email = encrypt($_POST['email']);
    $mobile = encrypt($_POST['mobile']);
    $address = encrypt(ucfirst($_POST['address']));
    $username = encrypt($_POST['username']);
    $password = sha1($_POST['password']);
    $chkqry = "select * from tbl_login where username='" . $username . "' and usertype_id=3";
    $chk = mysqli_query($con, $chkqry);
    if (!$c = mysqli_fetch_array($chk)) {
        $loginqry = "insert into tbl_login(username,password,usertype_id) values('" . $username . "','" . $password . "',3)";
        $result = mysqli_query($con, $loginqry);
        $login_id = mysqli_insert_id($con);
        $regqry = "insert into tbl_register(login_id,name,dob,email,mobile,address)
               values('" . $login_id . "','" . $name . "','" . $dob . "','" . $email . "','" . $mobile . "','" . $address . "')";
        $result += mysqli_query($con, $regqry);
        if ($result > 1) {
            header("Location:index.php");
            echo "<script>alert('Register Successfully!');</script>";
        } else {
            echo "<script>alert('Unable to Register!');</script>";
        }
    } else {
        echo "<script>alert('Username already exist.\nPlease try another one.');</script>";
    }
}
?>