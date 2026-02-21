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
        <?php
        if (isset($_REQUEST['case_id'])) {
            $case_id = $_REQUEST['case_id'];
        ?>
            <title>Police Station - Cyber Crime System</title>
        <?php
        } else if (isset($_REQUEST['status'])) {
            $case_id = $_REQUEST['status']; ?>
            <title>User - Cyber Crime System</title>
        <?php
        } else {
            echo "<title>Admin - Cyber Crime System</title>";
        }
        ?>
    </head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        .progress-section {
            padding: 40px;
            background-color: white;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 20px;
        }

        .progress-bar::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #ddd;
        }

        .step {
            position: relative;
            text-align: center;
            width: 20%;
        }

        .step .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: inline-block;
            line-height: 40px;
            font-size: 18px;
            color: white;
        }

        .step.completed .circle {
            background-color: #28a745;
        }

        .step.current .circle {
            background-color: #ffc107;
        }

        .step p {
            margin-top: 10px;
            font-size: 14px;
        }

        .timeline {
            margin-top: 40px;
        }

        .timeline .event {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .timeline .icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #28a745;
            text-align: center;
            line-height: 30px;
            color: white;
            margin-right: 10px;
        }

        .timeline .details {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .timeline .details p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .timeline .details .timestamp {
            font-size: 12px;
            color: #888;
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

        .message {
            text-align: center;
            font-size: 18px;
            color: green;
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

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 0px;
        }
    </style>
    <?php
    if (isset($_REQUEST['case_id'])) {
        $case_id = $_REQUEST['case_id'];
    ?>


        <body>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="stationhome.php">Home</a>
                    <a href="stationcase.php?usertype=2">Complaints</a>
                    <a href="allusers.php?usertype=2">User Details</a>
                    <a href="casestatusupdate.php" class="active">Complaint Status</a>

                    <div class="user-menu">
                        <div class="user-icon">
                            <img src="img/usericon.png" alt="User Icon">
                        </div>
                        <div class="dropdown-content">
                            <a href="editprofile.php?usertype=2">Edit Profile</a>
                            <a href="#">Delete Account</a>
                            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    } else if (isset($_REQUEST['status'])) {
        $case_id = $_REQUEST['status'];
        ?>
            <div class="navbar">
                <div class="navbar-nav">
                    <a href="citizenhome.php">Home</a>
                    <a href="citizencomplaintreg.php">Register Complaint</a>
                    <a href="#" class="active">Check Status</a>
                    <a href="notifications.php">Notifications</a>
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
        <?php
    }
    else if(isset($_REQUEST['c_id'])){
        $case_id = $_REQUEST['c_id']; ?>
        <div class="navbar">
                <div class="navbar-nav">
                    <a href="adminhome.php">Home</a>
                    <a href="adminstationmanagement.php">Police Station Management</a>
                    <a href="stationcase.php?usertype=1" class="active">Case Management</a>
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
    <?php }
    // Fetch case details
    $sql_case = "SELECT * FROM tbl_casestatus WHERE case_id = $case_id";
    $result_case = mysqli_query($con, $sql_case);

    // Check if case found
    if (mysqli_num_rows($result_case) > 0) {
        $case = mysqli_fetch_array($result_case);
        $case_id = $case['case_id'];
        $sid = $case['station_id'];
        $p = mysqli_query($con, "select * from tbl_policestation where station_id='" . $sid . "'");
        $r = mysqli_fetch_array($p);
        $station_name = decrypt($r['station_name']);
        $filing_date = $case['filing_date'];
        $status = decrypt($case['current_status']);
    } else {
        echo "No case found";
        exit;
    }

    // Fetch status updates
    $sql_updates = "SELECT * FROM tbl_statusupdates WHERE case_id = $case_id ORDER BY timestamp ASC";
    $result_updates = mysqli_query($con, $sql_updates);
        ?>

        <div class="container">
            <h1>Case Status</h1>
            <div class="case-info">
                <h2>Case ID: #<?php echo $case_id; ?></h2>
                <b>
                    <p>Police Station: <?php echo $station_name; ?></p>
                    <p>Filing Date: <?php echo $filing_date; ?></p>
                </b>
            </div>
            <section class="progress-section">

                <div class="progress-bar">
                    <!-- Dynamic Progress Bar -->
                    <?php
                    $statuses = ['Complaint Received', 'Verification in Progress', 'Investigation Ongoing', 'Case Forwarded to Court', 'Closed'];
                    $current_stage = array_search($status, $statuses);  // Find current stage index

                    foreach ($statuses as $index => $stage) {
                        $class = '';
                        if ($index < $current_stage) {
                            $class = 'completed';
                        } elseif ($index == $current_stage) {
                            $class = 'current';
                        }
                    ?>
                        <div class="step <?php echo $class; ?>">
                            <div class="circle"><?php echo $index + 1; ?></div>
                            <p><?php echo $stage; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="timeline">
                    <!-- Dynamic Timeline -->
                    <?php
                    while ($update = mysqli_fetch_array($result_updates)) {
                    ?>
                        <div class="event">
                            <div class="icon">✔</div>
                            <div class="details">
                                <p><?php echo decrypt($update['status']); ?></p>
                                <p class="timestamp"><?php echo $update['timestamp']; ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
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