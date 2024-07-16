<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aptitude Test</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div id="question-container">
        <!-- Question content will be loaded here -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="question" id="question1">
                <h2>Question 1</h2>
                <p>What is 2 + 2?</p>
                <input type="text" name="answer1">
            </div>
            <div class="question" id="question2" style="display: none;">
                <h2>Question 2</h2>
                <p>What is the capital of France?</p>
                <input type="text" name="answer2">
            </div>
            <!-- Add more questions here -->
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
    <div id="camera-container" class="mt-3">
        <video id="video" width="640" height="480" autoplay></video>
        <button id="captureBtn" class="btn btn-primary mt-2">Capture</button>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // JavaScript for loading questions and capturing images
    $(document).ready(function(){
        var currentQuestion = 1;
        $('.question').hide();
        $('#question1').show();

        $('#nextBtn').click(function(){
            if(currentQuestion < 20) {
                $('.question').hide();
                currentQuestion++;
                $('#question' + currentQuestion).show();
            }
        });

        $('#prevBtn').click(function(){
            if(currentQuestion > 1) {
                $('.question').hide();
                currentQuestion--;
                $('#question' + currentQuestion).show();
            }
        });
    });
</script>

<?php
// PHP code for handling backend operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process answers
    $answers = array();
    for ($i = 1; $i <= 20; $i++) {
        $answer_key = 'answer' . $i;
        if (isset($_POST[$answer_key])) {
            $answers[$i] = $_POST[$answer_key];
        }
    }

    // Process the answers array as needed (e.g., store in database, calculate scores, etc.)
}
?>
</body>
</html>
