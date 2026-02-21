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
        <title>Admin Management - Cyber Crime System</title>
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

            .form-group input,
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
        <script type="text/javascript">
            function showdistrict(str) {
                var districtSelect = document.getElementById("district");
                if (str.length == 0) {
                    districtSelect.innerHTML = '<option value="">Select District</option>';
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {

                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("district").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "getdistrict.php?s=" + str, true);
                xmlhttp.send();
            }
        </script>
    </head>

    <body>
        <div class="navbar">
            <div class="navbar-nav">
                <a href="adminhome.php">Home</a>
                <a href="#" class="active">Police Station Management</a>
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
            <!-- Tabs for selecting between State and District -->
            <div class="tabs">
                <button class="tab-btn active" onclick="showSection('state-section')">Edit Police Station</button>
                <button class="tab-btn" onclick="showSection('add-section')">Add Police Station</button>
            </div>

            <!-- States Section -->
            <div id="state-section" class="section active">
                <h3>View States</h3>
                <?php
                $t = mysqli_query($con, "select * from tbl_policestation");
                $resultst = mysqli_query($con, "select * from tbl_policestation");
                if ($p = mysqli_fetch_array($t)) {
                ?>
                    <table>
                        <tr>
                            <th>Serial No</th>
                            <th>Station</th>
                            <th>District</th>
                            <th>State</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        $slno = 1; ?>
                        <form action="#" method="post">
                            <?php
                            while ($station = mysqli_fetch_array($resultst)) {
                                $psname = decrypt($station['station_name']);
                                $psid = $station['station_id'];
                                $districtid = $station['district_id'];
                                $d_sql = mysqli_fetch_array(mysqli_query($con, "select * from tbl_district where district_id='" . $districtid . "'"));
                                $dname = decrypt($d_sql['district_name']);
                                $stateid = $d_sql['state_id'];
                                $s_sql = mysqli_fetch_array(mysqli_query($con, "select * from tbl_state where state_id='" . $stateid . "'"));
                                $sname = decrypt($s_sql['state_name']);
                            ?>
                                <tr>
                                    <td><?php echo $slno; ?></td>
                                    <td><?php echo $psname; ?></td>
                                    <td><?php echo $dname; ?></td>
                                    <td><?php echo $sname; ?></td>
                                    <td>
                                        <button id='delete' name='stationDelete' value="<?php print $psid; ?>" onclick="return confirm('Are you sure you want to continue?')">Delete</button>
                                    </td>
                                </tr>
                            <?php
                                $slno++;
                            }
                            ?>
                        </form>

                    </table>
                <?php
                } else {
                    echo "<label>No Data found!</label>";
                }
                if (isset($_POST['stationDelete'])) {
                    $stationid = $_POST['stationDelete'];
                    $sr = mysqli_query($con, "select * from tbl_policestation where station_id ='" . $stationid . "'");
                    $log = mysqli_fetch_array($sr);
                    $logid = $log['login_id'];
                    $sr = mysqli_query($con, "delete from tbl_login where login_id ='" . $logid . "'");
                    $sr += mysqli_query($con, "delete from tbl_policestation where station_id ='" . $stationid . "'");
                    if ($sr > 1) {
                        echo "<script>alert('Police Station removed from Database.')</script>";
                    } else {
                        echo "<script>alert('Unable to remove State from Database.')</script>";
                    }
                }
                ?>
            </div>
            <!-- Station Section -->
            <div id="add-section" class="section">
                <h3>Add New Police Station</h3>
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="state">Select State</label>
                        <select id="state" name="state" onchange="showdistrict(this.value)" required>
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
                        <label for="district-id">Select District</label>
                        <select id="district" name="district" required>
                            <option value="" selected="selected">Select District</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="station-name">Add New Station</label>
                        <input type="text" id="station-name" name="station-name" placeholder="Enter police station name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter a username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter a password" required>
                    </div>
                    <button type="submit" name="addstation" class="btn">Add Station</button>
                </form>
                <?php
                if (isset($_POST['addstation'])) {
                    $did = $_POST['district'];
                    $sid = $_POST['state'];
                    $username = encrypt($_POST['username']);
                    $password = sha1($_POST['password']);
                    $psname = encrypt(strtoupper($_POST['station-name']));
                    $chk = mysqli_query($con, "select * from tbl_login where username='" . $username . "'");
                    $res = mysqli_query($con, "select * from tbl_policestation where station_name = '" . $psname . "'");
                    if (!$r = mysqli_fetch_array($chk)) {
                        if (!$ch = mysqli_fetch_array($res)) {
                            $loginqry = "insert into tbl_login(username,password,usertype_id) values('" . $username . "','" . $password . "',2)";
                            $result = mysqli_query($con, $loginqry);
                            $login_id = mysqli_insert_id($con);
                            $result += mysqli_query($con, "insert into tbl_policestation(login_id,district_id,state_id,station_name) 
                                   values('" . $login_id . "','" . $did . "','" . $sid . "','" . $psname . "')");
                            if ($result > 1) {
                                echo "<script>alert('Station added Successfully!.')</script>";
                            } else {
                                echo "<script>alert('Unable to add Station.')</script>";
                            }
                        } else {
                            echo "<script>alert('Station already Exist.')</script>";
                        }
                    } else {
                        echo "<script>alert('Username already Exist. Try another one.')</script>";
                    }
                }
                ?>
            </div>
        </div>

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