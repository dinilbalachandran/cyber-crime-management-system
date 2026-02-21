<?php
session_start();
if (isset($_SESSION['loginid'])) {
    include 'header.html';
    include 'utilities.php';
    $con = getconnection();
    mysqli_select_db($con, "cybercrimesystem");
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $usertype = $_REQUEST['usertype'];
        if ($usertype == 2) {
            echo "<title>Police Station Management - Cyber Crime System</title>";
        } else if ($usertype == 1) {
            echo "<title>Admin Management - Cyber Crime System</title>";
        } else if ($usertype == 3) {
            echo "<title>User Management - Cyber Crime System</title>";
        }
        ?>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 0;
                color: #343a40;
            }

            .navbar {
                position: center;
                background-color: #343a40;
                padding: 10px;
                color: white;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                text-align: center;
            }

            .navbar h1 {
                margin: 0;
                font-size: 24px;
                font-weight: 400;
            }

            .navbar-nav {
                display: contents;
                text-align: center;
            }

            .navbar-nav a {
                color: white;
                text-decoration: none;
                padding: 10px;
                border-radius: 5px;
                transition: background 0.3s ease;
            }

            .navbar-nav a:hover {
                background-color: #495057;
            }

            .navbar-nav a.active {
                background-color: #495057;
                font-weight: bold;
            }

            .user-menu {
                float: right;
            }

            .user-icon {
                cursor: pointer;
            }

            .user-icon img {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                border: 2px solid white;
                margin-top: -7px;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                background-color: white;
                min-width: 160px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                z-index: 1;
                border-radius: 5px;
                overflow: hidden;
            }

            .dropdown-content a {
                color: #343a40;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                transition: background 0.3s ease;
            }

            .dropdown-content a:hover {
                background-color: #f1f1f1;
            }

            .user-menu:hover .dropdown-content {
                display: block;
            }

            .container {
                max-width: 1200px;
                margin: 30px auto;
                padding: 20px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            }

            .welcome-section {
                text-align: center;
                margin-bottom: 30px;
            }

            .welcome-section h2 {
                font-size: 28px;
                color: #00416A;
            }

            .welcome-section p {
                font-size: 18px;
                color: #555;
            }

            form {
                margin-top: 30px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            select,
            input,
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
            }

            select {
                cursor: pointer;
            }

            textarea {
                resize: vertical;
            }

            .btn-submit {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #00416A;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .btn-submit:hover {
                background-color: #0083B0;
            }
        </style>
    </head>

    <body>
        <?php
        if ($usertype == 3) {
            $login_id = $_SESSION['login_id'];
            $qry =  mysqli_query($con, "select * from tbl_register where login_id='" . $login_id . "'");
            $row = mysqli_fetch_array($qry);
            $name = decrypt($row['name']);
            $dob = decrypt($row['dob']);
            $email = decrypt($row['email']);
            $mobile = decrypt($row['mobile']);
            $address = decrypt($row['address']);
            $qry = mysqli_query($con, "select * from tbl_login where login_id='" . $login_id . "'");
            $row = mysqli_fetch_array($qry);
            $username = decrypt($row['username']);
            $password = "password";

        ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="citizenhome.php">Home</a>
                    <a href="citizencomplaintreg.php">Register Complaint</a>
                    <a href="citizencase.php">Check Status</a>
                    <a href="notifications.php">Notifications</a>
                    <a href="editprofile.php?usertype=3" class="active">Edit Profile</a>
                    <div class="user-menu">
                        <div class="user-icon">
                            <img src="img/usericon.png" alt="User Icon">
                        </div>
                        <div class="dropdown-content">
                            <a href="editprofile.php?usertype=3">Edit Profile</a>
                            <a href="deleteaccount.php?usertype=3" onclick="return confirm('Are you sure, Do you want delete your account permanently?')">Delete Account</a>
                            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="welcome-section">
                    <h2>Edit Your Profile</h2>
                    <p>Here you can edit your personal details.</p>
                </div>
                <form action="#" method="POST" onsubmit="return confirm('Are you sure, Do you want to update your profile?');">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo ucfirst($name); ?>">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="tel" name="mobile" pattern="[0-9]{10}" value="<?php echo $mobile; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="5"><?php echo $address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo $password; ?>">
                    </div>
                    <button type="submit" name="userupdate" class="btn-submit">Update</button>
                </form>
            </div>
        <?php
        } else if ($usertype == 2) { ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="stationhome.php">Home</a>
                    <a href="stationcase.php?usertype=2">Complaints</a>
                    <a href="allusers.php?usertype=2">User Details</a>
                    <a href="casestatusupdate.php">Complaint Status Update</a>

                    <div class="user-menu">
                        <div class="user-icon">
                            <img src="img/usericon.png" alt="User Icon">
                        </div>
                        <div class="dropdown-content">
                            <a href="editprofile.php?usertype=2">Edit Profile</a>
                            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $login_id = $_SESSION['login_id'];
            $qry = mysqli_query($con, "select * from tbl_login where login_id='" . $login_id . "'");
            $row = mysqli_fetch_array($qry);
            $username = decrypt($row['username']);
            $password = "password";
            ?>
            <div class="container">
                <div class="welcome-section">
                    <h2>Edit Your Profile</h2>
                    <p>Here you can edit your personal details.</p>
                </div>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo ucfirst($username); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo $password; ?>">
                    </div>
                    <button type="submit" name="stationupdate" class="btn-submit">Update</button>
                </form>
            </div>
        <?php
        } else if ($usertype == 1) {
            $login_id = $_SESSION['login_id'];
            $qry = mysqli_query($con, "Select * from tbl_login where login_id='" . $login_id . "'");
            $row = mysqli_fetch_array($qry);
            $username = decrypt(ucfirst($row['username']));
            $password = "password";
        ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="#">Home</a>
                    <a href="adminstationmanagement.php">Police Station Management</a>
                    <a href="stationcase.php?usertype=1">Case Management</a>
                    <a href="allusers.php?usertype=1">User Management</a>
                    <a href="state&district.php">State/District Management</a>

                    <div class="user-menu">
                        <div class="user-icon">
                            <img src="img/usericon.png" alt="User Icon">
                        </div>
                        <div class="dropdown-content">
                            <a href="editprofile.php?usertype=1">Edit Profile</a>
                            <a href="deleteaccount.php?usertype=1" onclick="return confirm('Are you sure, Do you want delete your account permanently?')">Delete Account</a>
                            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="welcome-section">
                    <h2>Edit Your Profile</h2>
                    <p>Here you can edit your personal details.</p>
                </div>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo $password; ?>">
                    </div>
                    <button type="submit" name="adminupdate" class="btn-submit">Update</button>
                </form>
            <?php
        }
        if (isset($_POST['adminupdate'])) {
            $username = decrypt($_POST['username']);
            $password = $_POST['password'];
            if ($password != "password") {
                $password = sha1($password);
                $updateqry1 = "update tbl_login set username='$username',password='$password' where login_id='$login_id'";
            } else {
                $updateqry1 = "update tbl_login set username='$username' where login_id='$login_id'";
            }
            $result = mysqli_query($con, $updateqry1);
            if ($result > 0) {
                echo "<script>alert('Profile Updated Successfully!');</script>";
                echo "<script>window.location.href='editprofile.php?usertype=2';</script>";
            } else {
                echo "<script>alert('Unable to Update Profile!');</script>";
            }
        }
        if (isset($_POST['stationupdate'])) {
            $username = encrypt($_POST['username']);
            $password = $_POST['password'];
            if ($password != "password") {
                $password = sha1($password);
                $updateqry1 = "update tbl_login set username='$username',password='$password' where login_id='$login_id'";
            } else {
                $updateqry1 = "update tbl_login set username='$username' where login_id='$login_id'";
            }
            $result = mysqli_query($con, $updateqry1);
            if ($result > 0) {
                echo "<script>alert('Profile Updated Successfully!');</script>";
                echo "<script>window.location.href='editprofile.php?usertype=2';</script>";
            } else {
                echo "<script>alert('Unable to Update Profile!');</script>";
            }
        }
        if (isset($_POST['userupdate'])) {
            $name = encrypt(ucfirst($_POST['name']));
            $email = encrypt($_POST['email']);
            $mobile = encrypt($_POST['mobile']);
            $address = encrypt(ucfirst($_POST['address']));
            $username = encrypt($_POST['username']);
            $password = $_POST['password'];

            if ($password != "password") {
                $password = sha1($password);
                $updateqry1 = "update tbl_login set username='$username',password='$password' where login_id='$login_id'";
            } else {
                $updateqry1 = "update tbl_login set username='$username' where login_id='$login_id'";
            }
            $result = mysqli_query($con, $updateqry1);
            $updateqry2 = "update tbl_register set name='$name',email='$email',mobile='$mobile',address='$address' where login_id='$login_id'";
            $result += mysqli_query($con, $updateqry2);
            if ($result > 1) {
                echo "<script>alert('Profile Updated Successfully!');</script>";
                echo "<script>window.location.href='editprofile.php?usertype=3';</script>";
            } else {
                echo "<script>alert('Unable to Update Profile!');</script>";
            }
        }
            ?>
    </body>

    </html>
<?php
    include 'footer.html';
} else {
    header("Location:index.php");
    echo "<script>alert('Please Login to Continue.')</script>";
}
?>