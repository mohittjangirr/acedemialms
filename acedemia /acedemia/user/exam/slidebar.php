<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $emailormobnum = $_POST['emailormobnum'];
    $password = md5($_POST['password']);
    $sql = "SELECT Email, MobileNumber, Password, ID, ClassID FROM tbluser WHERE (Email=:emailormobnum OR MobileNumber=:emailormobnum) AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailormobnum', $emailormobnum, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['ocasuid'] = $result->ID;
            $_SESSION['ocasucid'] = $result->ClassID;
        }
        $_SESSION['login'] = $_POST['emailormobnum'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACEDEMIA | Sign In</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding-top: 100px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 30px;
        }
        .logo {
            font-size: 1.75rem;
            font-weight: 600;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="logo">ACEDEMIA</div>
                <form method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="emailormobnum" name="emailormobnum" required>
                        <label for="emailormobnum">Email or Mobile Number</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="forgot-password.php" class="link-custom">Forgot Password</a>
                    </div>
                    <button type="submit" class="btn btn-custom py-3 w-100 mb-4" name="login">Sign In</button>
                </form>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <a href="signup.php" class="link-custom">Create an account!</a>
                </div>
            </div>
        </div>
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
