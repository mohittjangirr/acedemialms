<?php
session_start();
error_reporting(E_ALL); // Enable error reporting

include('includes/dbconnection.php');

// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);

    try {
        $sql ="SELECT Email FROM tbluser WHERE Email=:email AND MobileNumber=:mobile";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if($query->rowCount() > 0) {
            // Update password
            $con = "UPDATE tbluser SET Password=:newpassword WHERE Email=:email AND MobileNumber=:mobile";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();

            // Send OTP via email
            $otp = rand(100000, 999999);
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
                $mail->Subject = 'Oops! Did Your Password Take a Vacation?';
                $mail->Body = "Hey there, forgetful genius! <br><br>

                So, it seems your password decided to go on a little adventure without you! Don't worry, though - we've got it covered. Here's the magic incantation to get you back into your Academia account:<br><br>
                
                <b>$otp</b><br><br>
                
                It's like your password went on a beach holiday and forgot to send you a postcard! <br><br>
                
                Now, let's get you back on track. Log in, and let the learning continue!<br><br>
                
                If you need any help or just want to share your password's travel stories, we're here for you. <br><br>
                
                Cheers to password escapades and learning adventures!<br><br>
                
                Mohit Jangir<br>
                Acedemia Crew ";

                if ($mail->send()) {
                    // Store OTP in session for later verification
                    $_SESSION['email'] = $email;
                    $_SESSION['otp'] = $otp;

                    echo '<script>alert("Your password has been successfully changed. OTP has been sent to your email address.");</script>';
                    echo '<script>window.location.href="otpver.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("Failed to send OTP. Please try again.");</script>';
                }
            } catch (Exception $e) {
                echo '<script>alert("Mailer Error: ' . $mail->ErrorInfo . '");</script>';
            }
        } else {
            echo '<script>alert("Email id or Mobile no is invalid.");</script>'; 
        }
    } catch (PDOException $e) {
        echo '<script>alert("Database Error: ' . $e->getMessage() . '");</script>';
    }
}
?>

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
    
    <title>Forget Password | Acedemia</title>
   

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
    <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
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

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .outer-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }
        .inner-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #7a6ad8;
            color: white;
            border-radius: 25px;
        }
        .btn-custom:hover {
            background-color: #695bc3;
        }
        .link-custom {
            color: #7a6ad8;
        }
        .link-custom:hover {
            color: #695bc3;
            text-decoration: none;
        }
        .logo-text {
            font-size: 2rem;
            font-weight: 600;
            color: #7a6ad8;
        }
        .tagline-text {
            font-size: 0.875rem;
            font-weight: 400;
            color: #7a6ad8;
            margin-top: -10px;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="outer-container">
                    <div class="logo-text">ACEDEMIA</div>
                    <div class="tagline-text">FORMERLY CODECHAMP</div>
                    <div class="inner-container">
                        <form method="post" name="chngpwd" onSubmit="return valid();">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" required>
                                <label for="email">Email Address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="mobile" name="mobile" required maxlength="10" pattern="[0-9]+">
                                <label for="mobile">Mobile Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="newpassword" name="newpassword" required>
                                <label for="newpassword">New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                                <label for="confirmpassword">Confirm Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <label>
                                        <a href="signin.php" class="link-custom">Sign In</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-custom py-3 w-100 mb-4" name="submit">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


    </div>

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