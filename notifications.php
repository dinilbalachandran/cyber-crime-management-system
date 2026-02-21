<?php
session_start();
if (isset($_SESSION['loginid'])) {
    include 'header.html';
    include 'utilities.php';
    $con = getconnection();
    $login_id = $_SESSION['loginid'];
    mysqli_select_db($con, "cybercrimesystem");
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Citizen - Cyber Crime System</title>
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

            .container h3 {
                color: #00416A;
                font-size: 22px;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table,
            th,
            td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #f8f9fa;
                color: #343a40;
            }

            td button {
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
        <div class="navbar">
            <div class="navbar-nav">
                <a href="citizenhome.php">Home</a>
                <a href="citizencomplaintreg.php">Register Complaint</a>
                <a href="citizencase.php">Check Status</a>
                <a href="#" class="active">Notifications</a>
                <a href="editprofile.php?usertype=3">Edit Profile</a>
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
            <h3>Notifications</h3>
            <?php
            $qry = mysqli_query($con, "Select * from tbl_case where login_id = '$login_id'");
            $viewed = array();
            $unviewed = array();
            $view = 0;
            $unview = 0;
            while ($row = mysqli_fetch_array($qry)) {
                $case_id = $row['case_id'];
                $status = mysqli_query($con, "select * from tbl_statusupdates where case_id='$case_id'");
                while ($row1 = mysqli_fetch_array($status)) {
                    $seen = $row1['view'];
                    if ($seen == 1) {
                        $unviewed[$unview]['case_id'] = $row1['case_id'];
                        $unviewed[$unview]['status'] = decrypt($row1['status']);
                        $unviewed[$unview]['timestamp'] = $row1['timestamp'];
                        $unview++;
                    } else if ($seen = 0) {
                        $viewed[$view]['case_id'] = $row1['case_id'];
                        echo $viewed[$view]['status'] = decrypt($row1['status']);
                        $viewed[$view]['timestamp'] = $row1['timestamp'];
                        $view++;
                    }
                }
            }
            usort($viewed, function ($a, $b) {
                return strtotime($b['timestamp']) - strtotime($a['timestamp']);
            });
            usort($unviewed, function ($a, $b) {
                return strtotime($b['timestamp']) - strtotime($a['timestamp']);
            });
            $slno = 1;
            if ($unviewed != null || $viewed != null) {
                echo "<table border=1>"; ?>
                <tr>
                    <th>Sl No.</th>
                    <th>Case ID</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
                <?php
                if ($unviewed != null) {
                    for ($i = 0; $i < $unview; $i++) {
                ?>
                        <tr>
                            <th><?php echo $slno; ?></th>
                            <th><?php echo $unviewed[$i]['case_id']; ?></th>
                            <th><?php echo $unviewed[$i]['status']; ?></th>
                            <th><?php echo $unviewed[$i]['timestamp']; ?></th>
                        </tr>

                    <?php
                        $slno++;
                    }
                }
                if ($viewed != null) {
                    for ($i = 0; $i < $view; $i++) {
                    ?>
                        <tr>
                            <td><?php echo $slno; ?></td>
                            <td><?php echo $viewed[$i]['case_id']; ?></td>
                            <td><?php echo $viewed[$i]['status']; ?></td>
                            <td><?php echo $viewed[$i]['timestamp']; ?></td>
                        </tr>
            <?php
                        $slno++;
                    }
                }
                echo "</table>";
            }
            ?>
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