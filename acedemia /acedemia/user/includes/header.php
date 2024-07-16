<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curved Navbar with Notifications</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #7a6ad8;
            color: white;
            padding: 10px 20px;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: adds a subtle shadow */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }

        .navbar .navbar-brand h2 {
            margin: 0;
        }

        .navbar .nav-link {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .navbar .nav-link img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .dropdown-menu {
            background-color: #f8f9fa;
            border: none;
            border-radius: 0;
            margin-top: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: adds a subtle shadow */
        }

        .dropdown-menu a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #e2e6ea;
        }

        .sidebar-toggler {
            cursor: pointer;
            font-size: 20px;
        }

        #sidebar.active {
            display: block; /* Adjust based on how you want to show/hide the sidebar */
        }

        .notification {
            position: relative;
        }

        .notification .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">
    <a href="dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
        <h2><i class="fa fa-hashtag"></i></h2>
    </a>
    <span class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </span>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown notification">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge">3</span> <!-- Adjust the number as needed -->
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- PHP generated notifications -->
                <a href="#" class="dropdown-item">New notification 1</a>
                <a href="#" class="dropdown-item">New notification 2</a>
                <a href="#" class="dropdown-item">New notification 3</a>
            </div>
        </div>

        <div class="nav-item dropdown">
            <div class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img src="../admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <?php
                    $uid=$_SESSION['ocasuid'];
                    $sql="SELECT * from tbluser where ID=:uid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                        foreach($results as $row)
                        { ?>
                            <span class="d-none d-lg-inline-flex"><?php echo $row->FullName;?></span><?php }
                    } ?>
            </div>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="profile.php" class="dropdown-item">My Profile</a>
                <a href="setting.php" class="dropdown-item">Settings</a>
                <a href="logout.php" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- Include Bootstrap JS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sidebarToggler = document.querySelector('.sidebar-toggler');

        sidebarToggler.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    });
</script>

</body>
</html>
