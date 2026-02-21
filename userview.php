<?php
session_start();
if (isset($_SESSION['loginid'])) {
    include 'header.html';
    include 'utilities.php';
    $con = getconnection();
    mysqli_select_db($con, "cybercrimesystem");
    $usertype = $_REQUEST['usertype'];
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($usertype == 2) {
            echo "<title>Police Station Management - Cyber Crime System</title>";
        } else {
            echo "<title>Admin Management - Cyber Crime System</title>";
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

            .section {
                display: none;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .section.active {
                display: block;
            }

            .section h3 {
                color: #00416A;
                font-size: 22px;
                margin-bottom: 20px;
            }

            .section a {
                text-decoration: none;
                color: #343a40;
                transition: background 0.3s ease;
            }

            .section a:hover {
                color: darkorange;
            }

            .view {
                margin-left: 1000px;
                margin-top: -48px;
            }

            .view #view {
                background: #00416A;
                display: inline-block;
                padding: 5px 10px;
                background-color: #00416A;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background 0.3s ease;
            }

            #view:hover {
                background: #0083B0;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                color: #343a40;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
            }
        </style>
    </head>

    <body>
        <?php if ($usertype == 2) {
        ?> <div class="navbar">
                <div class="navbar-nav">
                    <a href="stationhome.php">Home</a>
                    <a href="stationcase.php?usertype=2">Complaints</a>
                    <a href="allusers.php" class="active">User Details</a>
                    <a href="casestatus.php">Complaint Status</a>

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
        <?php } else { ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="adminhome.php">Home</a>
                    <a href="#">Police Station Management</a>
                    <a href="stationcase.php?usertype=1">Case Management</a>
                    <a href="allusers.php?usertype=1" class="active">User Management</a>
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
        <?php
        } ?>
        <?php
        if (isset($_REQUEST['uid'])) {
            $logid = $_REQUEST['uid'];
            $result = mysqli_query($con, "select * from tbl_register where login_id = '" . $logid . "'");
            $row = mysqli_fetch_array($result);
            $regid = $row['register_id'];
            $dob = decrypt($row['dob']);
            $email = decrypt($row['email']);
            $mobile = decrypt($row['mobile']);
            $address = decrypt($row['address']);
            $name = ucfirst(decrypt($row['name']));
            $admchk = mysqli_query($con, "select * from tbl_login where login_id='" . $_SESSION['loginid'] . "'");
            $adresult = mysqli_fetch_array($admchk);
        ?>
            <div class="container">
                <div id="case-section" class="section active">
                    <form action="#" method="post">
                        <h3>Register ID : <?php echo $regid; ?></h3>
                        <?php if ($adresult['usertype_id'] == 1){}/*?>
                            <div class="view">
                                <button id='view' name='rmuser' value="<?php print $logid; ?>" onclick="return confirm('Are you sure, Do you want delete your account permanently?')">Remove User</button>
                            </div>
                        <?php } */?>
                        <p><b>Name :</b> <?php echo $name; ?></p>
                        <P><b>Date Of Birth :</b> <?php echo $dob; ?></P>
                        <P><b>Address :</b> <?php echo $address; ?></P>
                        <P><b>Email-Id :</b> <?php echo $email; ?></P>
                        <P><b>Mobile Number :</b> <?php echo "+91 " . $mobile; ?></P>
                    </form>
                <?php
                if (isset($_POST['rmuser'])) {
                    $login_id = $_POST['rmuser'];
                    $result = mysqli_query($con, "update tbl_login set usertype_id=4 where login_id='" . $login_id . "'");
                    if ($result > 0) {
                        echo "<script>alert('Account Successfully Deleted.');<script>";
                    } else {
                        echo "<script>alert('Unable to Delete Account.');<script>";
                    }
                }
            } else {
                echo "<label>No Data found!</label>";
            }
                ?>
                </div>
            </div>
    </body>

    </html>
<?php
    include 'footer.html';
} else {
    header("Location:index.php");
    echo "<script>alert('Please Login to Continue.')</script>";
}
?>