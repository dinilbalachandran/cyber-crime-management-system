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

            .features {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .card {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin: 20px 0;
                flex: 1;
                margin-right: 20px;
                min-width: 250px;
                transition: transform 0.3s ease;
            }

            .card:last-child {
                margin-right: 0;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .card h3 {
                color: #00416A;
                font-size: 22px;
            }

            .card p {
                color: #777;
                font-size: 16px;
            }

            .card a {
                display: block;
                margin-top: 20px;
                padding: 10px 15px;
                background: #00416A;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                text-align: center;
                font-weight: bold;
                transition: background 0.3s ease;
            }

            .card a:hover {
                background: #0083B0;
            }
        </style>
    </head>

    <body>
        <div class="navbar">
            <div class="navbar-nav">
                <a href="#" class="active">Home</a>
                <a href="citizencomplaintreg.php">Register Complaint</a>
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
                <h2>Welcome, <?php echo ucfirst($_SESSION['username']); ?></h2>
                <p>Here you can manage your complaints, view notifications, and update your personal information securely.</p>
            </div>

            <div class="features">
                <div class="card">
                    <h3>Register a Complaint</h3>
                    <p>Submit a new complaint about any cyber crime incident that you have encountered.</p>
                    <a href="citizencomplaintreg.php">Register Now</a>
                </div>

                <div class="card">
                    <h3>Check Complaint Status</h3>
                    <p>Track the status of your submitted complaints and receive updates from the police.</p>
                    <a href="citizencase.php">Check Status</a>
                </div>

                <div class="card">
                    <h3>View Notifications</h3>
                    <p>Stay informed with the latest notifications and alerts from your local police station or admin.</p>
                    <a href="notifications.php">View Notifications</a>
                </div>

                <!--div class="card">
                    <h3>Important Contacts</h3>
                    <p>Access emergency contacts and helpline numbers for quick assistance in case of an urgent situation.</p>
                    <a href="contacts.html">View Contacts</a>
                </div-->
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