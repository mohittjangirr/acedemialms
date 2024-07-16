<?php
session_start();

if(isset($_SESSION['otp']) && isset($_SESSION['admin_id'])) {
    if(isset($_POST['verify'])) {
        $enteredOTP = $_POST['otp'];
        $expectedOTP = $_SESSION['otp'];
        
        if($enteredOTP == $expectedOTP) {
            // OTP matched, proceed with login
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php"); // Redirect to dashboard after successful verification
            exit;
        } else {
            $_SESSION['message'] = "Invalid OTP. Please try again.";
            header("Location: admin_verification.php"); // Redirect back to verification page if OTP is incorrect
            exit;
        }
    }
} else {
    header("Location: login.php"); // Redirect to login page if no OTP session is set
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-form h2 {
            margin: 0 0 20px;
            text-align: center;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .login-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Admin Verification</h2>
        <form action="" method="post">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <input type="submit" name="verify" value="Verify">
        </form>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="error">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']); // Clear the message after displaying it
        }
        ?>
    </div>
</body>
</html>
