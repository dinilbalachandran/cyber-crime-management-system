<?php
session_start();
if (isset($_SESSION['loginid'])) {
    include 'header.html';
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Citizen Home - Cyber Crime System</title>
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
        <script type="text/javascript">
            function showdistrict(str) {
                var districtSelect = document.getElementById("district");
                var psSelect = document.getElementById("police_station");
                if (str.length == 0) {
                    districtSelect.innerHTML = '<option value="">Select District</option>';
                    psSelect.innerHTML = '<option value"">Select Police Station</option>';
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

            function showstation(str) {
                var psSelect = document.getElementById("police_station");
                if (str.length == 0) {
                    psSelect.innerHTML = '<option value="">Select Police Station</option>';
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {

                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("police_station").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "getstation.php?p=" + str, true);
                xmlhttp.send();
            }
        </script>
    </head>

    <body>
        <div class="navbar">
            <div class="navbar-nav">
                <a href="citizenhome.php">Home</a>
                <a href="citizencomplaintreg.php" class="active">Register Complaint</a>
                <a href="citizencase.php">Check Status</a>
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
        <div class="container">
            <div class="welcome-section">
                <h2>Complaint Registration Form</h2>
                <p>Here you can file your complaints securely.</p>
            </div>
            <form action="#" method="POST" onsubmit="return confirm('By Submitting, you agree to our complaint handling procedure.\nComplaint details will be sent to respected authorities.\nClick \'OK\' to continue.');">
                <div class="form-group">
                    <label for="category">Case Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Cyber Harassment">Cyber Harassment</option>
                        <option value="Data Theft">Data Theft</option>
                        <option value="Fraud">Fraud</option>
                        <option value="Phishing">Phishing</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="view_date">Date of View</label>
                    <input type="date" id="view_date" name="view_date" required>
                </div>
                <div class="form-group">
                    <label for="view_time">Time of View</label>
                    <input type="time" id="view_time" name="view_time" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <?php
                    include 'utilities.php';
                    $con = getconnection();
                    mysqli_select_db($con, "cybercrimesystem");
                    $sql = "select * from tbl_state";
                    $result = mysqli_query($con, $sql);
                    ?>
                    <select id="state" name="state" onchange="showdistrict(this.value)" required>
                        <option value="">Select State</option>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            $sid = $row['state_id'];
                            $sname = decrypt($row['state_name']);
                        ?>
                            <option value="<?php print $sid; ?>"> <?php print $sname; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <select id="district" name="district" onchange="showstation(this.value)" required>
                        <option value="" selected="selected">Select District</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="police_station">Police Station</label>
                    <select id="police_station" name="police_station" required>
                        <option value="">Select Police Station</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="additional_info">Additional Information</label>
                    <textarea id="additional_info" name="additional_info" rows="5" placeholder="Describe the case..." required></textarea>
                </div>
                <button type="submit" class="btn-submit">Submit Complaint</button>
            </form>
        </div>
    </body>

    </html>
<?php
    include 'footer.html';
    if (isset($_POST['category'])) {
        $category = encrypt($_POST['category']);
        $date = encrypt($_POST['view_date']);
        $time = encrypt($_POST['view_time']);
        $station = $_POST['police_station'];
        $addinfo = e1($_POST['additional_info']);
        mysqli_select_db($con, 'cybercrimesystem');
        $chk = mysqli_query($con, "select * from tbl_case where description = '" . $addinfo . "' and login_id = '" . $_SESSION['loginid'] . "' 
                            and date='" . $date . "'");
        if (!$chkresult = mysqli_fetch_array($chk)) {
            $qry = "insert into tbl_case(login_id,station_id,category,date,time,description)
                values('" . $_SESSION['loginid'] . "','" . $station . "','" . $category . "','" . $date . "','" . $time . "','" . $addinfo . "')";
            $result = mysqli_query($con, $qry);

            $case_id = mysqli_insert_id($con);
            $date = date('Y-m-d H:i:s');
            $status = encrypt("Complaint Filed");

            $qry1 = "insert into tbl_casestatus(case_id,station_id,filing_date,current_status)
                    values('" . $case_id . "','" . $station . "','" . $date . "','" . $status . "')";
            $result += mysqli_query($con, $qry1);

            $qry2 = "insert into tbl_statusupdates(case_id,status,timestamp)
                    values('" . $case_id . "','" . $status . "','" . $date . "')";
            $result += mysqli_query($con, $qry2);

            if ($result > 2) {
                echo "<script>alert('Complaint Registered Successfully!')</script>";
                unset($_POST);
            } else {
                echo "<script>alert('Error occur! Unable to Register complaint.')</script>";
            }
        } else {
            echo "<script>alert('Complaint already Exist.')</script>";
        }
    }
} else {
    header("Location:index.php");
    echo "<script>alert('Please Login to Continue.')</script>";
}
?>