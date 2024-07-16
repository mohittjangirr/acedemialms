User
<?php
session_start();
include('includes/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['ocasuid'])) {
    echo "<script type='text/javascript'> document.location ='login.php'; </script>";
    exit();
}

// Fetch data from the database
$userId = $_SESSION['ocasuid'];
$scheduleTests = [];  // Fetch scheduled tests from the database
$upcomingTests = [];  // Fetch upcoming tests from the database
$completedTests = []; // Fetch completed tests from the database

// Example queries to fetch data (you need to replace these with actual queries)
$scheduleQuery = "SELECT * FROM tests WHERE userId=:userId AND status='scheduled'";
$upcomingQuery = "SELECT * FROM tests WHERE userId=:userId AND status='upcoming'";
$completedQuery = "SELECT * FROM tests WHERE userId=:userId AND status='completed'";

$query = $dbh->prepare($scheduleQuery);
$query->bindParam(':userId', $userId, PDO::PARAM_STR);
$query->execute();
$scheduleTests = $query->fetchAll(PDO::FETCH_OBJ);

$query = $dbh->prepare($upcomingQuery);
$query->bindParam(':userId', $userId, PDO::PARAM_STR);
$query->execute();
$upcomingTests = $query->fetchAll(PDO::FETCH_OBJ);

$query = $dbh->prepare($completedQuery);
$query->bindParam(':userId', $userId, PDO::PARAM_STR);
$query->execute();
$completedTests = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../admin/css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f0f2f5;
        }
        .container-fluid {
            display: flex;
            padding: 0;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar .logo img {
            width: 100%;
            max-width: 150px;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            width: 100%;
        }
        .sidebar ul li {
            width: 100%;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #343a40;
            font-size: 1rem;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #7a6ad8;
            color: #fff;
        }
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .content h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #7a6ad8;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="ACEDEMIA Logo">
            </div>
            <ul>
                <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="test-schedule.php"><i class="fas fa-calendar-alt"></i> Schedule Test</a></li>
                <li><a href="upcoming-tests.php"><i class="fas fa-calendar"></i> Upcoming Tests</a></li>
                <li><a href="completed-tests.php"><i class="fas fa-check-circle"></i> Completed Tests</a></li>
                <li><a href="test-history.php"><i class="fas fa-history"></i> Your Test History</a></li>
                <li><a href="test-score.php"><i class="fas fa-clipboard-check"></i> Your Test Score</a></li>
                <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1 class="my-4">Dashboard</h1>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-alt icon"></i>Schedule Test</h5>
                            <p class="card-text">Schedule your tests.</p>
                            <a href="test-schedule.php" class="btn btn-primary">Schedule</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar icon"></i>Upcoming Tests</h5>
                            <p class="card-text">View your upcoming tests.</p>
                            <a href="upcoming-tests.php" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle icon"></i>Completed Tests</h5>
                            <p class="card-text">View your completed tests.</p>
                            <a href="completed-tests.php" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add more sections as needed -->
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