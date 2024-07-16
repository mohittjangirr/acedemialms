<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #7a6ad8 !important;
            color: white !important;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
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
        }
        .navbar-custom .dropdown-menu .dropdown-item {
            color: white !important;
        }
        .navbar-custom .dropdown-menu .dropdown-item:hover {
            background-color: #5e4aa1 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0 navbar-custom">
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        
        <div class="navbar-nav align-items-center ms-auto">
            <?php
            $aid=$_SESSION['ocasaid'];
            $sql="SELECT * from tbladmin where ID=:aid";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':aid',$aid,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
                foreach($results as $row)
                {
            ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex"><?php echo $row->AdminName; ?></span>
                    <?php $cnt=$cnt+1;}} ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end m-0">
                    <a href="profile.php" class="dropdown-item">My Profile</a>
                    <a href="setting.php" class="dropdown-item">Settings</a>
                    <a href="logout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
