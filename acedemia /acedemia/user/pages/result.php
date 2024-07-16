<?php 
    // Assuming $user_role contains the role of the user (admin or user)
    if ($user_role == 'admin') {
        // Only admins can see the result, so retrieve the exam details
        $examId = $_GET['id'];
        $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
?>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div id="refreshData">
                
            <div class="col-md-12">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <?php echo $selExam['ex_title']; ?>
                                <div class="page-title-subheading">
                                    <?php echo $selExam['ex_description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row col-md-12">
                    <h1 class="text-primary">RESULT'S</h1>
                </div>

                <!-- Your result display code goes here -->

            </div>
        </div>
    </div>
</div>

<?php 
    } else {
        // For users, show a message in a dialog box
        echo "<script>alert('Thank you for your time. You will receive your result via email upon submitting the test.'); setTimeout(function(){ window.location.href = 'https://codechamp.live'; }, 3000);</script>";
    }
?>
