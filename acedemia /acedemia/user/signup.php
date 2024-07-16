<?php
session_start();
error_reporting(E_ALL); // Enable all error reporting
ini_set('display_errors', 1); // Display errors

include('includes/dbconnection.php');

// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $email = $_POST['email'];
    $cid = $_POST['cid'];
    $password = md5($_POST['password']);

    try {
        // Check if email or mobile number already exists
        $ret = "SELECT Email, MobileNumber FROM tbluser WHERE Email = :email OR MobileNumber = :mobno";
        $query = $dbh->prepare($ret);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() == 0) {
            // Insert new user data into the database
            $sql = "INSERT INTO tbluser (FullName, MobileNumber, Email, ClassID, Password) VALUES (:fname, :mobno, :email, :cid, :password)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
            $query->bindParam(':cid', $cid, PDO::PARAM_INT);
            $query->bindParam(':password', $password, PDO::PARAM_STR);

            if ($query->execute()) {
                // Generate OTP
                $otp = rand(100000, 999999);

                // Send OTP via email
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
                    $mail->Subject = '  Your Acedemia VIP Pass: Abhyasaḥ OTP Inside ';
                    $mail->Body = $mail->Body    = "Hey there, champ!<br><br>
Welcome aboard the Academia express, where knowledge is the currency, and we're printing it like there's no tomorrow!  Today's your lucky day because you're about to embark on the Abhyasaḥ test series - our latest launch that's hotter than a jalapeño in a sauna! <br><br>
Thanks a ton for trusting us to supercharge your study game. Now, grab that One-Time Password (OTP) with both hands and get ready to unlock the doors to academic greatness! <br><br>
<b>OTP: $otp</b><br><br>
Sail through that registration process like a seasoned captain, and if you hit any rough waters, don't hesitate to signal our support team at contact.acedemia@gmail.com. We're here to make your journey smooth as silk. <br><br>
We're pumped to have you join the Abhyasaḥ crew, and together, we're gonna ace those tests like rockstars! Let's do this!<br><br>
Cheers,<br>


                    Mohit Jangir <br>
                    Acedemia Crew";
                    
                    
                    

                    if ($mail->send()) {
                        // Store OTP in session for later verification
                        $_SESSION['email'] = $email;
                        $_SESSION['otp'] = $otp;

                        echo '<script>alert("You have successfully registered with us. OTP has been sent to your email address.");</script>';
                        echo '<script>window.location.href="otpver.php";</script>';
                        exit; // Ensure that no further code is executed after redirection
                    } else {
                        echo '<script>alert("Failed to send OTP. Please try again.");</script>';
                    }
                } catch (Exception $e) {
                    echo '<script>alert("Mailer Error: ' . $mail->ErrorInfo . '");</script>';
                }
            } else {
                echo '<script>alert("Failed to register user. Please try again.");</script>';
            }
        } else {
            echo '<script>alert("Email-id or Mobile Number already exists. Please try again.");</script>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Database Error: ' . $e->getMessage() . '");</script>';
    } catch (Exception $e) {
        echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
    }
}
?>











<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Acedemia | Signup</title>
   

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/../admin/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../admin/lib/tempusdominus/../admin/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .container-fluid {
            height: 100%;
            background-image: url('https://drive.google.com/uc?id=1BnlusuRlyQtgR53HWAkEe_A4E2dLjEUN');
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .outer-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeInContainer 2s ease-in-out;
        }
        @keyframes fadeInContainer {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .signup-container {
            background-color: rgba(255, 255, 255, 1);
            border-radius: 20px;
            padding: 20px;
            max-width: 1000px; /* Increased max-width */
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo-text {
            font-size: 2rem;
            font-weight: 600;
            color: #7a6ad8;
            text-align: center;
            margin-bottom: 10px;
        }
        .tagline-text {
            font-size: 0.8rem; /* Decreased font size */
            font-weight: 400;
            color: #7a6ad8;
            text-align: center;
            animation: fadeInTagline 2s ease-in-out; /* Applied animation only to tagline */
            margin-top: -5px; /* Adjusted margin */
            margin-bottom: 20px;
        }
        @keyframes fadeInTagline {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .signup-container form {
            text-align: left;
        }
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background-color: transparent;
        }
        .form-group label {
            position: absolute;
            top: -10px;
            left: 10px;
            background-color: white;
            padding: 0 5px;
            font-size: 14px;
            color: #777;
        }
        .signup-container button[type="submit"] {
            background-color: #7a6ad8;
            color: white;
            border: none;
            border-radius: 20px; /* More rounded corners */
            padding: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .signup-container button[type="submit"]:hover {
            background-color: #6556b5;
        }
        .signup-container a {
            color: #7a6ad8; /* Same color as the sign-up button */
            text-decoration: none;
            font-size: 14px;
        }
        .signup-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="outer-container">
            <div class="signup-container">
                <div class="logo-text">ACEDEMIA</div>
                <div class="tagline-text">FORMERLY CODECHAMP</div>
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="fname" required>
                        <label>Name</label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobno" required maxlength="10" pattern="[0-9]+">
                        <label>Mobile Number</label>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" required>
                        <label>Email address</label>
                    </div>
                    <div class="form-group">
                        <select name="cid" required>
                            <option value="">Select University</option>
                            <?php
                            $sql = "SELECT * from tblclass";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                                    echo '<option value="' . $row->ID . '">' . htmlentities($row->Class) . '</option>';
                                    $cnt = $cnt + 1;
                                }
                            }
                            ?>
                        </select>
                        <label>University</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="signin.php">

                    </div>
                    <button type="submit" name="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/lib/chart/chart.min.js"></script>
    <script src="../admin/lib/easing/easing.min.js"></script>
    <script src="../admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../admin/js/main.js"></script>
</body>

</html>