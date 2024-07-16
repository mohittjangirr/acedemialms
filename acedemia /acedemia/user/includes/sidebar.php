<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Design</title>
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css"> <!-- Include FontAwesome for icons -->
    <style>
        /* Spinner Styles */
        #spinner {
            background-color: white;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }
        
        #spinner .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        #spinner .loading-text {
            margin-left: 10px;
            font-size: 1.5rem;
            color: #7a6ad8;
        }

        /* Sidebar Styles */
        #sidebar {
            background-color: #7a6ad8;
            color: white;
            position: fixed;
            top: 0;
            left: -250px; /* Initially hidden */
            height: 100%;
            width: 250px;
            transition: left 0.5s ease;
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
            padding-top: 20px;
        }

        #sidebar.active {
            left: 0;
        }

        /* Navbar and Links */
        #sidebar .navbar-brand h3 {
            color: white;
        }

        #sidebar .nav-item.nav-link {
            color: white;
        }

        #sidebar .nav-item.nav-link.active {
            background-color: #5c4db4;
            border-radius: 5px;
        }

        /* User Information */
        #sidebar .d-flex.align-items-center.ms-4.mb-4 h6 {
            color: white;
        }

        #sidebar .d-flex.align-items-center.ms-4.mb-4 span {
            color: white;
        }

        /* Add a button to toggle the sidebar for demonstration purposes */
        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background-color: #7a6ad8;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="loading-text">nikal gya bhai bs aa raha hu</div>
    </div>
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <div id="sidebar" class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ACEDEMIA</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="../admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <?php
                        $uid=$_SESSION['ocasuid'];
                        $sql="SELECT * from tbluser where ID=:uid";
                        $query = $dbh -> prepare($sql);
                        $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $row)
                            { ?>
                                <h6 class="mb-0"><?php echo $row->FullName;?></h6>
                                <span></span><?php $cnt=$cnt+1;}} ?>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="view-course.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>View Course</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

   
</body>
</html>
