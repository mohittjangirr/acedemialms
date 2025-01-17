<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid']==0)) {
  header('location:logout.php');
  } else{
     if(isset($_POST['submit']))
  {
    $uid=$_SESSION['ocasuid'];
    $cid=$_POST['cid'];
    $fname=$_POST['name'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $sql="update tbluser set FullName=:name,MobileNumber=:mobilenumber,Email=:email,ClassID=:cid where ID=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$fname,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':cid',$cid,PDO::PARAM_INT);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

        echo '<script>alert("Profile has been updated")</script>';
     

  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Acedemia | Profile</title>
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
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        
<?php include_once('includes/sidebar.php');?>


        <!-- Content Start -->
        <div class="content">
         <?php include_once('includes/header.php');?>


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">User Profile</h6>
                            <form method="post">
                                 <?php
$uid=$_SESSION['ocasuid'];
$sql="SELECT tblclass.ID,tblclass.Class as classname,tbluser.ID,tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tbluser.ClassID,tbluser.RegDate from tbluser join tblclass on tblclass.ID=tbluser.ClassID where tbluser.ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                    <input type="text" class="form-control"  name="name" value="<?php  echo $row->FullName;?>" required='true'>
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php  echo $row->Email;?>" required='true'>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Class</label>
                                     <input type="text"  class="form-control" value="<?php  echo $row->classname;?>" readonly>
                                 
                                </div>
                               <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>" required='true' maxlength='10' readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Registration Date</label>
                                   <input type="text" class="form-control" id="email2" name="" value="<?php  echo $row->RegDate;?>" readonly="true">
                                </div>
                                
                                <?php $cnt=$cnt+1;}} ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                    
                   
                  
                   
                    
                  
                </div>
            </div>
            <!-- Form End -->


             <?php include_once('includes/footer.php');?>
        </div>
        <!-- Content End -->


       <?php include_once('includes/back-totop.php');?>
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
</html><?php }  ?>