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
        <?php if ($usertype == 2) { ?>
            <title>Police Station Management - Cyber Crime System</title>
        <?php } else { ?>
            <title>Admin Management - Cyber Crime System</title>
        <?php } ?>
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

            .section table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .section table,
            .section th,
            .section td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            .section th {
                background-color: #f8f9fa;
                color: #343a40;
            }

            .section td button {
                color: aliceblue;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                border-radius: 5px;
                transition: background 0.1s ease;
            }

            #view {
                background: #00416A;
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
        <?php if ($usertype == 2) { ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="stationhome.php">Home</a>
                    <a href="stationcase.php?usertype=2">Complaints</a>
                    <a href="#" class="active">User Details</a>
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
            </div> <?php } else { ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="adminhome.php">Home</a>
                    <a href="adminstationmanagement.php">Police Station Management</a>
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
        <?php } ?>

        <div class="container">
            <!-- User Section -->
            <div id="case-section" class="section active">
                <h3>View Users</h3>
                <?php
                $usr = mysqli_query($con, "select * from tbl_register");
                $t = mysqli_query($con, "select * from tbl_register");
                if ($p = mysqli_fetch_array($t)) {
                ?>
                    <table>
                        <tr>
                            <th>Serial No</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        $slno = 1; ?>
                        <?php
                        while ($row = mysqli_fetch_array($usr)) {
                            $uid = $row['login_id'];
                        ?>

                            <tr>
                                <td><?php echo $slno; ?></td>
                                <td><?php echo $row['register_id']; ?></td>
                                <td><?php echo ucfirst(decrypt($row['name'])); ?></td>
                                <td>
                                    <?php if ($usertype == 2) { ?>
                                        <form action="userview.php?usertype=2" method="post">
                                            <button id='view' name='uid' value="<?php print $uid; ?>">View</button>
                                        </form>
                                    <?php } else { ?>
                                        <form action="userview.php?usertype=1" method="post">
                                            <button id='view' name='uid' value="<?php print $uid; ?>">View</button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php
                            $slno++;
                        }
                        ?>
                    </table>
                <?php
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