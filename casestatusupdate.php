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
        <title>Police Station Management - Cyber Crime System</title>
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

            .case-info {
                margin-bottom: 40px;
            }

            .case-info h1 {
                font-size: 24px;
                margin-bottom: 5px;
            }

            .case-info p {
                font-size: 14px;
            }

            body {
                font-family: Arial, sans-serif;
            }

            .form-container h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            .form-container label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }

            .form-container input,
            .form-container select {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .form-container button {
                width: 100%;
                padding: 10px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .form-container button:hover {
                background-color: #218838;
            }

            .message {
                text-align: center;
                font-size: 18px;
                color: green;
            }
        </style>
    </head>

    <body>
        <div class="navbar">
            <div class="navbar-nav">
                <a href="stationhome.php">Home</a>
                <a href="stationcase.php?usertype=2">Complaints</a>
                <a href="allusers.php?usertype=2">User Details</a>
                <a href="#" class="active">Complaint Status Update</a>
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
        <div class="container">
            <?php

            // Fetch case details for the form
            if(isset($_REQUEST['case_id'])){
            $case_id = $_REQUEST['case_id'];
            $case = null;
            if ($case_id) {
                $sql_case = "SELECT * FROM tbl_casestatus WHERE case_id = $case_id";
                $result_case = mysqli_query($con, $sql_case);
                if (mysqli_num_rows($result_case) > 0) {
                    $case = mysqli_fetch_array($result_case);
                    $sid = $case['station_id'];

                    $p = mysqli_query($con, "select * from tbl_policestation where station_id='" . $sid . "'");
                    $r = mysqli_fetch_array($p);
                    $station_name = decrypt($r['station_name']);
                } else {
                    echo "No case found";
                    exit;
                }
            }
            ?>

            <div class="form-container">
                <h1>Update Case Status</h1>
                <div class="case-info">
                    <h2>Case ID: #<?php echo $case_id; ?></h2>
                    <b>
                        <p>Police Station: <?php echo $station_name; ?></p>
                        <p>Filing Date: <?php echo decrypt($case['filing_date']); ?></p>
                    </b>
                </div>
                <?php if ($case) {
                ?>
                    <form action="#" method="POST">
                        <input type="hidden" name="case_id" value="<?php echo $case['case_id']; ?>">

                        <label for="police_station">Police Station</label>
                        <input type="text" id="police_station" name="police_station" value="<?php echo $station_name; ?>" readonly>

                        <label for="status">Current Status</label>
                        <input type="text" id="status" name="current_status" value="<?php echo decrypt($case['current_status']); ?>" readonly>

                        <label for="new_status">Update Status</label>
                        <select id="new_status" name="status">
                            <option value="Complaint Received">Complaint Received</option>
                            <option value="Verification in Progress">Verification in Progress</option>
                            <option value="Investigation Ongoing">Investigation Ongoing</option>
                            <option value="Case Forwarded to Court">Case Forwarded to Court</option>
                            <option value="Closed">Closed</option>
                        </select>

                        <button type="submit" name="update">Update Status</button>
                    </form>
                <?php
                    // Handle form submission to update the case status
                    if (isset($_POST['update'])) {
                        $new_status = encrypt($_POST['status']);
                        $timestamp = date('Y-m-d H:i:s');  // Current timestamp
                        $chk = mysqli_query($con, "select * from tbl_statusupdates where case_id = '" . $case_id . "' and status='" . $new_status . "'");
                        if (mysqli_num_rows($chk) <= 0) {
                            // Update the case status in tbl_casestatus
                            $sql_update_status = "UPDATE tbl_casestatus SET current_status='$new_status' WHERE case_id=$case_id";
                            $result = mysqli_query($con, $sql_update_status);

                            // Insert the new status update into tbl_statusupdates
                            $sql_insert_update = "INSERT INTO tbl_statusupdates (case_id, status, timestamp, view) VALUES ($case_id, '$new_status', '$timestamp',1)";
                            $result += mysqli_query($con, $sql_insert_update);
                            if ($result > 1) {
                                $url = 'casestatus.php?case_id=' . urlencode($case_id);
                                echo '<script>window.location.href="casestatus.php?case_id=' . urlencode($case_id) . '";</script>';
                                //header('Location:casestatus.php?case_id='.urlencode($case_id));
                                echo $result;
                            } else {
                                echo "<script>alert('Unable to update Status!')';</script>";
                            }
                        } else {
                            echo "<script>alert('Status already updated.');</script>";
                        }
                    }
                }
                ?>
            </div>

        </div>
    </body>

    </html>
<?php
    include 'footer.html';
            }
            else{
               echo "<script>window.location.href='stationcase.php?usertype=2';</script>";
            }
} else {
    header("Location:index.php");
    echo "<script>alert('Please Login to Continue.')</script>";
}
?>