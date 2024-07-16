<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Check if OTP verification is required
    if (isset($_SESSION['otp_required']) && $_SESSION['otp_required'] == true) {
        // Redirect to OTP verification page
        header("Location: otp_verification.php");
        exit(); // Stop execution
    }

    // If OTP verification is not required, or if OTP is already verified, proceed with login
    $sql = "SELECT ID FROM tbladmin WHERE Email=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['ocasaid'] = $result->ID;
        }

        if (!empty($_POST["remember"])) {
            // COOKIES for email
            setcookie("user_email", $_POST["email"], time() + (10 * 365 * 24 * 60 * 60));
            // COOKIES for password
            setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE["user_email"])) {
                setcookie("user_email", "");
            }
            if (isset($_COOKIE["userpassword"])) {
                setcookie("userpassword", "");
            }
        }
        $_SESSION['login'] = $_POST['email'];

        // Send verification email
        $otp = mt_rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
                $mail->Host = 'smtp-relay.brevo.com'; // Your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = '74ff2b002@smtp-brevo.com'; // SMTP username
                $mail->Password = 'TAF5Q9ZMVmqx641g'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587; // Port for TLS

                // Recipients
                $mail->setFrom('74ff2b002@smtp-brevo.com', 'Acedemia');
                $mail->addAddress($email); // Add a recipient

                $mail->isHTML(true);
            $mail->Subject = 'Attention Admin! We Have a Secret Agent in the Admin Lair!';
           $mail->Body = "Hey there, Admin Extraordinaire! <br><br>

It seems like a stealthy visitor has sneaked into the admin panel! Should we call for backup or offer them a cup of virtual coffee? <br><br>

Just wanted to give you a heads-up! Keep rocking your admin cape and keeping Acedemia safe and sound! <br><br>

Oh, and here's the OTP: <b>$otp</b><br><br>

Best regards,<br>
Mohit Jangir<br>
Acedemia Crew";

            $mail->send();
            echo "<script>alert('Verification code sent to your email.');</script>";
            echo "<script>window.location.href='otp_verification.php';</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // If login credentials are invalid, or if OTP verification is required but not done yet
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Acedemia | Sign In</title>
   

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
  <style>
    /* Custom CSS for mobile responsiveness */
    @media (max-width: 576px) {
      .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <a href="index.html" class="">
            </a>
            <h3></h3>
          </div>
          <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('img/bg.jpg'); /* Replace 'background-image.jpg' with your image path */
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup-container {
      background-color: rgba(255, 255, 255, 0.8); /* Adjust opacity as needed */
      padding: 20px;
      border-radius: 20px;
      max-width: 400px;
      width: 100%;
    }

    .signup-container form {
      margin-bottom: 20px;
    }

    .form-floating {
      position: relative;
    }

    .form-floating input {
      width: 100%;
      padding: 10px;
      border: none;
      border-bottom: 1px solid #ced4da;
      outline: none;
      font-size: 16px;
    }

    .form-floating label {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #7a6ad8; /* Button color */
      font-size: 16px;
      pointer-events: none;
      transition: 0.3s ease;
    }

    .form-floating input:focus ~ label,
    .form-floating input:not(:placeholder-shown) ~ label {
      top: 0;
      font-size: 15px;
    }

    .form-check {
      margin-top: 10px;
    }

    .btn-primary {
      background-color: #7a6ad8;
      color: white !important;
      border: none;
      padding: 10px 20px;
      border-radius: 25px; /* Adjust border-radius to create a curved appearance */
      cursor: pointer;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #6554b7;
    }

    .forgot-password {
      text-align: right;
      margin-top: 10px;
    }

    .forgot-password a {
      color: #7a6ad8;
      text-decoration: none;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .logo-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .academia {
      color: #7a6ad8; /* Button color */
      font-size: 24px;
      font-weight: bold;
    }

    .tagline {
      color: #7a6ad8; /* Button color */
      font-size: 10px;
    }
  </style>
</head>
<body>
  <div class="logo-container">
    <span class="academia">ACEDEMIA</span>
    <p class="tagline">FORMERLY CODECHAMP</p>
  </div>

  <div class="signup-container" id="passwordContainer">
    <h2>Welcome Admin!</h2>
    <p>Please enter the predefined password to proceed:</p>
    <form id="passwordForm">
      <div class="form-floating mb-3">
        <input type="password" class="form-control" required="true" id="adminPassword" placeholder="Enter predefined password">
        <label for="adminPassword">Password</label>
      </div>
   
    </form>
  </div>

  <div class="signup-container" id="signinContainer" style="display: none;">
    <form method="post">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" required="true" name="email" placeholder="Enter your email">
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating mb-4">
        <input type="password" class="form-control" name="password" required="true" placeholder="Enter your password">
        <label for="floatingPassword">Password</label>
      </div>
      
      <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="login">Sign In</button>
    </form>
  </div>

  <script>
    
    document.getElementById("adminPassword").addEventListener("input", function() {
      if (this.value.length >= 6) {
        // Automatically submit the form after 6 digits
        checkPassword();
      }
    });

    function checkPassword() {
      var password = document.getElementById("adminPassword").value;
      // Check if the entered password is correct (replace 'your_password' with the actual predefined password)
      if (password === "808014") {
        document.getElementById("passwordContainer").style.display = "none";
        document.getElementById("signinContainer").style.display = "block";
      } else {
        alert("Incorrect password! Please try again.");
      }
    }
  </script>
</body>
</html>

  </script>
</body>
</html>

        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>