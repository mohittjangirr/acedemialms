<!DOCTYPE html>
<html lang="en">

<head>
<!-- Brevo Conversations {literal} -->
<script>
    (function(d, w, c) {
        w.BrevoConversationsID = '664748d937599525f5487f3a';
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        var s = d.createElement('script');
        s.async = true;
        s.src = 'https://conversations-widget.brevo.com/brevo-conversations.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'BrevoConversations');
</script>
<!-- /Brevo Conversations {/literal} -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acedemia | OTP Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            <div class="tagline-text">Authenticate Academia!</div>
            <div class="verification-container">
                <div class="verification-form">
                    <form method="post">
                        <div class="form-group">
                            <p>Our way of saying 'Hey, it's really you!' without resorting to mind-reading. <strong><?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?></strong></p>
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



</html>


<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['verify'])) {
    // Get the email from the session
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];

    // Fetch OTP from the session
    $storedOTP = $_SESSION['otp'];

    // Verify the entered OTP
    if ($otp == $storedOTP) {
        // OTP is correct, redirect to signup.php
        echo "<script>alert('OTP Verified Successfully! Welcome to Acedemia. Now login with your existing credentials.');</script>";
        echo "<script>window.location.href='signin.php';</script>";
        exit;
    } else {
        // Invalid OTP
        echo "<script>alert('Invalid OTP! Please try again.');</script>";
    }
}
?>

