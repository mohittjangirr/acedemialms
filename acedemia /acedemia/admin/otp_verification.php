<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['verify'])) {
    $otp = $_POST['otp'];

    // Fetch OTP from the session
    $storedOTP = $_SESSION['otp'];

    // Verify the entered OTP
    if ($otp == $storedOTP) {
        // OTP is correct, redirect to dashboard
        echo "<script>alert('OTP Verified Successfully! Welcome to Acedemia.');</script>";
        echo "<script>window.location.href='dashboard.php';</script>";
        exit;
    } else {
        // Invalid OTP
        echo "<script>alert('Invalid OTP! Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }
        .container-outer {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .outer-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo img {
            width: 150px; /* Adjust the width as needed */
            height: auto;
            margin-bottom: 10px;
        }
        .tagline-text {
            font-size: 0.8rem;
            font-weight: 400;
            color: #7a6ad8;
            margin-bottom: 30px;
        }
        .verification-container {
            text-align: center;
        }
        .verification-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input {
            width: 250px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background-color: transparent;
        }
        .form-group button[type="submit"] {
            background-color: #7a6ad8;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button[type="submit"]:hover {
            background-color: #6556b5;
        }
    </style>
</head>
<body>
    <div class="container-outer">
        <div class="outer-container">
            <div class="logo">
                <img src="logo.png" alt="Acedemia Logo">
            </div>
            <div class="tagline-text"></div>
            <div class="verification-container">
                <div class="verification-form">
                    <form method="post">
                        <div class="form-group">
                            <p>Tickle Your Phone: OTP-a-Licious! <strong><?php echo isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?></strong></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="otp" placeholder="Enter OTP" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="verify">Verify OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
