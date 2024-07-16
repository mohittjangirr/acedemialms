<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        /* Custom CSS for Navbar */
        .navbar-custom {
            background-color: #7a6ad8 !important;
            color: white !important;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 10px 20px;
        }
        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand,
        .navbar-custom .dropdown-item {
            color: white !important;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .dropdown-item:hover {
            color: #e6e6e6 !important;
        }
        .navbar-custom .dropdown-menu {
            background-color: #7a6ad8 !important;
            border: none;
        }
        .navbar-custom .dropdown-menu .dropdown-item {
            color: white !important;
        }
        .navbar-custom .dropdown-menu .dropdown-item:hover {
            background-color: #5e4aa1 !important;
        }

        /* Custom CSS for Sidebar */
        .sidebar {
            background-color: #7a6ad8 !important;
            padding: 20px;
        }
        .sidebar .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        .sidebar .nav-link,
        .sidebar .dropdown-item {
            color: white !important;
        }
        .sidebar .nav-link:hover,
        .sidebar .dropdown-item:hover {
            color: #e6e6e6 !important;
        }
        .sidebar .dropdown-menu {
            background-color: #7a6ad8 !important;
            border: none;
        }
        .sidebar .dropdown-menu .dropdown-item {
            color: white !important;
        }
        .sidebar .dropdown-menu .dropdown-item:hover {
            background-color: #5e4aa1 !important;
        }

        /* Custom CSS for Spinner */
        #spinner {
            display: none; /* Hide spinner initially */
        }
        #spinner.show {
            display: flex;
        }

        /* Custom CSS for Profile Image */
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .profile-status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #28a745; /* green color */
            border: 2px solid white;
            position: absolute;
            bottom: 0;
            right: 0;
        }
    </style>
</head>
<body>

<!-- Spinner Start -->
<div id="spinner" class="bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center" style="width: 100vw; height: 100vh;">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar navbar-light">
        <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
            ACADEMIA
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="profile-image" src="img/user.jpg" alt="User Profile">
                <div class="profile-status"></div>
            </div>
            <div class="ms-3">
                <?php
                $aid=$_SESSION['ocasaid'];
                $sql="SELECT * from tbladmin where ID=:aid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>
                        <h6 class="mb-0"><?php echo $row->AdminName; ?></h6>
                        <span><?php $cnt = $cnt + 1; } } ?>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>University</a>
                <div class="dropdown-menu">
                    <a href="add-class.php" class="dropdown-item">Add University</a>
                    <a href="manage-class.php" class="dropdown-item">Manage University</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Course</a>
                <div class="dropdown-menu">
                    <a href="add-subject.php" class="dropdown-item">Add Course</a>
                    <a href="manage-subject.php" class="dropdown-item">Manage Course</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Subject</a>
                <div class="dropdown-menu">
                    <a href="add-course.php" class="dropdown-item">Add Subject</a>
                    <a href="manage-course.php" class="dropdown-item">Manage Subject</a>
                </div>
            </div>
            <a href="reg-users.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Reg Users</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Reports</a>
                <div class="dropdown-menu">
                    <a href="classwise-bwdates-reports.php" class="dropdown-item">b/w dates Report</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
