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
        <title>State/District Management - Cyber Crime System</title>
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

            .tabs {
                display: flex;
                justify-content: space-around;
                margin-bottom: 20px;
            }

            .tabs button {
                background-color: #ddd;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                font-size: 16px;
                transition: background 0.3s ease;
                color: #343a40;
                border-radius: 8px;
            }

            .tabs button.active {
                background-color: #00416A;
                color: white;
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

            #edit {
                display: inline-block;
                padding: 5px 10px;
                background-color: #00416A;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background 0.3s ease;
            }

            #delete {
                background-color: brown;
                display: inline-block;
                padding: 5px 10px;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background 0.3s ease;
            }

            #delete:hover {
                background-color: red;
            }

            #edit:hover {
                background-color: #0083B0;
            }

            .section td button:hover {
                background-color: #0083B0;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                color: #343a40;
            }

            .form-group input[type="text"],
            .form-group select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #00416A;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background 0.3s ease;
            }

            .btn:hover {
                background-color: #0083B0;
            }
        </style>
    </head>

    <body>
        <div class="navbar">
            <div class="navbar-nav">
                <a href="adminhome.php">Home</a>
                <a href="adminstationmanagement.php">Police Station Management</a>
                <a href="stationcase.php?usertype=1">Case Management</a>
                <a href="allusers.php?usertype=1">User Management</a>
                <a href="#" class="active">State/District Management</a>

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
            <!-- Tabs for selecting between State and District -->
            <div class="tabs">
                <button class="tab-btn active" onclick="showSection('state-section')">State Management</button>
                <button class="tab-btn" onclick="showSection('district-section')">District Management</button>
            </div>

            <!-- States Section -->
            <div id="state-section" class="section active">
                <h3>Manage States</h3>
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="state-name">Add New State</label>
                        <input type="text" id="state-name" name="state-name" placeholder="Enter state name">
                    </div>
                    <button type="submit" class="btn">Add State</button>
                </form>
                <?php
                if (isset($_POST['state-name']) && $_POST['state-name'] != "") {
                    $state_name = encrypt(strtoupper($_POST['state-name']));
                    $res = mysqli_query($con, "select * from tbl_state where state_name = '" . $state_name . "'");
                    if (!$chk = mysqli_fetch_array($res)) {
                        $result = mysqli_query($con, "insert into tbl_state(state_name) values('" . $state_name . "')");
                        if ($result > 0) {
                            echo "<script>alert('State added Successfully!.')</script>";
                        } else {
                            echo "<script>alert('Unable to add State.')</script>";
                        }
                    } else {
                        echo "<script>alert('State already Exist.')</script>";
                    }
                }
                ?>
                <h3>View States</h3>
                <?php
                $t = mysqli_query($con, "select * from tbl_state");
                $resultst = mysqli_query($con, "select * from tbl_state");
                if ($p = mysqli_fetch_array($t)) {
                ?>
                    <table>
                        <tr>
                            <th>Serial No</th>
                            <th>State Name</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        $slno = 1; ?>
                        <form action="#" method="post">
                            <?php
                            while ($state = mysqli_fetch_array($resultst)) {
                                $statename = decrypt($state['state_name']);
                                $stateid = $state['state_id']; ?>
                                <tr>
                                    <td><?php echo $slno; ?></td>
                                    <td><?php echo $statename; ?></td>
                                    <td>
                                        <?php //button id='edit' name='stateEdit' value="<?php print $stateid; ">Edit</button ?>
                                        <button id='delete' name='stateDelete' value="<?php print $stateid; ?>" onclick="return confirm('Are you sure you want to continue?')">Delete</button>
                                    </td>
                                </tr>
                            <?php
                                $slno++;
                            }
                            ?>
                        </form>
                    </table>
                <?php } else {
                    echo "<label>No Data found!</label>";
                }
                if (isset($_POST['stateDelete'])) {
                    $stateid = $_POST['stateDelete'];
                    $sr = mysqli_query($con, "delete from tbl_state where state_id ='" . $stateid . "'");
                    $sr += mysqli_query($con, "delete from tbl_district where state_id = '" . $stateid . "'");
                    $st = mysqli_query($con, "select * from tbl_policestation where state_id = '" . $stateid . "'");
                    while ($stationrow = mysqli_fetch_array($st)) {
                        $rstation_id = $stationrow['station_id'];
                        $rcase = mysqli_query($con, "select * from tbl_case where station_id='$rstation_id'");
                        while ($caserow = mysqli_fetch_array($rcase)) {
                            $case_id = $caserow['case_id'];
                            mysqli_query($con, "delete from tbl_case where case_id='$case_id'");
                            mysqli_query($con, "delete from tbl_status where case_id='$case_id'");
                            mysqli_query($con, "delete from tbl_statusupdates where case_id='$case_id'");
                        }
                    }
                    if ($sr > 1) {
                        echo "<script>alert('State successfully removed from Database.');</script>";
                        $sr = 0;
                    } else if ($sr = 1) {
                        echo "<script>alert('Unable to remove State from Database.')</script>";
                    }
                }
                ?>
            </div>

            <!-- Districts Section -->
            <div id="district-section" class="section">
                <h3>Manage Districts</h3>
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="state-id">Select State</label>
                        <select id="state-id" name="state-id" required>
                            <option value="">Select State</option>
                            <?php
                            $result = mysqli_query($con, "select * from tbl_state");
                            while ($state = mysqli_fetch_array($result)) {
                                $sname = decrypt($state['state_name']);
                                echo "<option value='{$state['state_id']}'>$sname</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district-name">Add New District</label>
                        <input type="text" id="district-name" name="district-name" placeholder="Enter district name">
                    </div>
                    <button type="submit" class="btn">Add District</button>
                </form>
                <?php
                if (isset($_POST['state-id'])) {
                    $sid = $_POST['state-id'];
                    $dname = encrypt(strtoupper($_POST['district-name']));
                    $res = mysqli_query($con, "select * from tbl_district where district_name = '" . $dname . "'");
                    if (!$chk = mysqli_fetch_array($res)) {
                        $result = mysqli_query($con, "insert into tbl_district(state_id,district_name) values('" . $sid . "','" . $dname . "')");
                        if ($result > 0) {
                            echo "<script>alert('District added Successfully!.')</script>";
                        } else {
                            echo "<script>alert('Unable to add District.')</script>";
                        }
                    } else {
                        echo "<script>alert('District already Exist.')</script>";
                    }
                }
                ?>
                <h3>View Districts</h3>
                <?php
                ?>
                <?php
                $d = mysqli_query($con, "select * from tbl_district order by state_id asc");
                $resultdis = mysqli_query($con, "select * from tbl_district order by state_id asc");
                if ($ds = mysqli_fetch_array($d)) {
                ?>
                    <table>
                        <tr>
                            <th>Serial No.</th>
                            <th>District Name</th>
                            <th>State Name</th>
                            <th>Actions</th>
                        </tr>
                        <form action="#" method="post">
                            <?php
                            $slno = 1;
                            while ($district = mysqli_fetch_array($resultdis)) {
                                $sql = mysqli_query($con, "select state_name from tbl_state where state_id='" . $district['state_id'] . "'");
                                $state = mysqli_fetch_array($sql);
                                $sname = decrypt($state['state_name']);
                                $dname = decrypt($district['district_name']); ?>
                                <tr>
                                    <td><?php echo $slno; ?></td>
                                    <td><?php echo $dname; ?></td>
                                    <td><?php echo $sname; ?></td>
                                    <td>
                                        <?php //button id='edit' name='districtEdit' value="<?php print $district['district_id']; ">Edit</button>?>
                                        <button id='delete' name='districtDelete' value="<?php print $district['district_id']; ?>" onclick="return confirm('Are you sure you want to continue?')">Delete</button>
                                    </td>
                                </tr>
                            <?php
                                $slno++;
                            }
                            ?>
                        </form>
                    </table>
                <?php } else {
                    echo "<label>No Data Found!</label>";
                }
                ?>
            </div>
        </div>
        <?php
        if (isset($_POST['districtDelete'])) {
            $did = $_POST['districtDelete'];
            $sr = mysqli_query($con, "delete from tbl_district where district_id ='" . $did . "'");
            $st = mysqli_query($con, "select * from tbl_policestation where district_id = '" . $did . "'");
            while ($districtrow = mysqli_fetch_array($st)) {
                $rstation_id = $districtrow['station_id'];
                $rcase = mysqli_query($con, "select * from tbl_case where station_id='$rstation_id'");
                while ($caserow = mysqli_fetch_array($rcase)) {
                    $case_id = $caserow['case_id'];
                    mysqli_query($con, "delete from tbl_case where case_id='$case_id'");
                    mysqli_query($con, "delete from tbl_status where case_id='$case_id'");
                    mysqli_query($con, "delete from tbl_statusupdates where case_id='$case_id'");
                }
            }
            if ($sr > 0) {
                echo "<script>alert('District successfully removed from Database.');</script>";
                $sr = -1;
            } else if ($sr == -1) {
                echo "<script>alert('Unable to remove State from Database.')</script>";
            }
        }
        ?>
        <script>
            // Function to switch between State and District sections
            function showSection(sectionId) {
                // Hide all sections
                document.querySelectorAll('.section').forEach(function(section) {
                    section.classList.remove('active');
                });

                // Show the selected section
                document.getElementById(sectionId).classList.add('active');

                // Reset the active class on all buttons
                document.querySelectorAll('.tab-btn').forEach(function(btn) {
                    btn.classList.remove('active');
                });

                // Set the active class on the clicked button
                event.target.classList.add('active');
            }
        </script>
    </body>

    </html>
<?php
    include 'footer.html';
} else {
    header("Location:index.php");
    echo "<script>alert('Please Login to Continue.')</script>";
}
?>