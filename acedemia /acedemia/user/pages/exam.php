<?php
// Assuming $conn is your PDO database connection
$examId = $_GET['id'];
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
$selExamTimeLimit = $selExam['ex_time_limit'];
$exDisplayLimit = $selExam['ex_questlimit_display'];

// Fetch questions for the exam
$selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ");
$questions = $selQuest->fetchAll(PDO::FETCH_ASSOC);
$totalQuestions = count($questions);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="app-main__outer">
        <div class="app-main__inner">
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
            </div>

            <div class="col-md-12 p-0 mb-4">
                <form method="post" id="submitAnswerFrm">
                    <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
                    <input type="hidden" name="examAction" id="examAction">

                    <div class="question-container">
                        <?php foreach ($questions as $index => $question) : ?>
                            <div class="question" id="question-<?php echo $index + 1; ?>" style="<?php echo ($index > 0) ? 'display:none;' : ''; ?>">
                                <p><b><?php echo $index + 1; ?> .) <?php echo $question['exam_question']; ?></b></p>
                                <div class="col-md-4 float-left">
                                    <div class="form-group pl-4 ">
                                        <input name="answer[<?php echo $question['eqt_id']; ?>][correct]" value="<?php echo $question['exam_ch1']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck<?php echo $index + 1; ?>" required>
                                        <label class="form-check-label" for="invalidCheck<?php echo $index + 1; ?>">
                                            <?php echo $question['exam_ch1']; ?>
                                        </label>
                                    </div>
                                    <div class="form-group pl-4">
                                        <input name="answer[<?php echo $question['eqt_id']; ?>][correct]" value="<?php echo $question['exam_ch2']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck<?php echo $index + 2; ?>" required>
                                        <label class="form-check-label" for="invalidCheck<?php echo $index + 2; ?>">
                                            <?php echo $question['exam_ch2']; ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8 float-left">
                                    <div class="form-group pl-4">
                                        <input name="answer[<?php echo $question['eqt_id']; ?>][correct]" value="<?php echo $question['exam_ch3']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck<?php echo $index + 3; ?>" required>
                                        <label class="form-check-label" for="invalidCheck<?php echo $index + 3; ?>">
                                            <?php echo $question['exam_ch3']; ?>
                                        </label>
                                    </div>
                                    <div class="form-group pl-4">
                                        <input name="answer[<?php echo $question['eqt_id']; ?>][correct]" value="<?php echo $question['exam_ch4']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck<?php echo $index + 4; ?>" required>
                                        <label class="form-check-label" for="invalidCheck<?php echo $index + 4; ?>">
                                            <?php echo $question['exam_ch4']; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    

                    <div class="buttons" style="margin-top: 20px;">
                        <button type="button" class="btn btn-primary" id="prevBtn">Previous</button>
                        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var currentQuestion = 1;
        var totalQuestions = <?php echo $totalQuestions; ?>;
        var timer = <?php echo $selExamTimeLimit; ?>;
        var interval;

        $(document).ready(function() {
            startTimer();

            // Event listener for next button
            $('#nextBtn').click(function() {
                if (currentQuestion < totalQuestions) {
                    $('.question').hide();
                    $('#question-' + currentQuestion).hide();
                    $('#question-' + (++currentQuestion)).show();
                }
            });

            // Event listener for previous button
            $('#prevBtn').click(function() {
                if (currentQuestion > 1) {
                    $('.question').hide();
                    $('#question-' + currentQuestion).hide();
                    $('#question-' + (--currentQuestion)).show();
                }
            });
        });
    </script>

</body>

</html>
