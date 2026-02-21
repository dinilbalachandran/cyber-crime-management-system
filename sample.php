<?php
session_start();
include 'header.html';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Registration</title>
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

        select, input, textarea {
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

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            font-size: 14px;
        }

        .footer a {
            color: #61dafb;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-nav">
            <a href="#" class="active">Home</a>
            <a href="register-complaint.html">Register Complaint</a>
            <a href="check-status.html">Check Status</a>
            <a href="notifications.html">Notifications</a>
            <a href="contacts.html">Contacts</a>
            <a href="edit-profile.html">Edit Profile</a>

            <div class="user-menu">
                <div class="user-icon">
                    <img src="img/usericon.png" alt="User Icon">
                </div>
                <div class="dropdown-content">
                    <a href="#">Edit Profile</a>
                    <a href="#">Delete Account</a>
                    <a href="logout.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome-section">
            <h2>Complaint Registration</h2>
            <p>Here you can register your complaints securely.</p>
        </div>

        <!-- Complaint Registration Form -->
        <form action="#" method="POST">
            <!-- Case Category -->
            <div class="form-group">
                <label for="category">Case Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="1">Cyber Harassment</option>
                    <option value="2">Data Theft</option>
                    <option value="3">Fraud</option>
                    <option value="4">Phishing</option>
                </select>
            </div>

            <!-- Date of View -->
            <div class="form-group">
                <label for="view_date">Date of View</label>
                <input type="date" id="view_date" name="view_date" required>
            </div>

            <!-- Time of View -->
            <div class="form-group">
                <label for="view_time">Time of View</label>
                <input type="time" id="view_time" name="view_time" required>
            </div>

            <!-- State -->
            <div class="form-group">
                <label for="state">State</label>
                <select id="state" name="state" required>
                    <option value="">Select State</option>
                    <option value="1">Kerala</option>
                    <option value="2">Karnataka</option>
                    <option value="3">Tamil Nadu</option>
                </select>
            </div>

            <!-- District -->
            <div class="form-group">
                <label for="district">District</label>
                <select id="district" name="district" required>
                    <option value="">Select State First</option>
                    <option value="1">Kottayam</option>
                    <option value="2">Ernakulam</option>
                    <option value="3">Trivandrum</option>
                </select>
            </div>

            <!-- Police Station -->
            <div class="form-group">
                <label for="police_station">Police Station</label>
                <select id="police_station" name="police_station" required>
                    <option value="">Select District First</option>
                    <option value="1">Kottayam Town Police Station</option>
                    <option value="2">Pala Police Station</option>
                    <option value="3">Ernakulam South Police Station</option>
                </select>
            </div>

            <!-- Additional Information -->
            <div class="form-group">
                <label for="additional_info">Additional Information</label>
                <textarea id="additional_info" name="additional_info" rows="5" placeholder="Describe the case..." required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">Submit Complaint</button>
        </form>
    </div>
</body>

</html>

<?php
include 'footer.html';
?>
