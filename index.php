<?php
include (__DIR__ . "/inc/quiz.php");
include (__DIR__ . "/vendor/autoload.php");

//create an array with the 3 answers for the current question
$answers = [
        $_SESSION['current_question']['firstIncorrectAnswer'],
        $_SESSION['current_question']['secondIncorrectAnswer'],
        $_SESSION['current_question']['correctAnswer'],
];

//randomize the order of the answer array
shuffle($answers);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<body>
    <div class="container">
        <div id="quiz-box">
            <?php
            //these blocks check if toast is set, and whether to show the red toast or green toast depending on accuracy of the answer
                if (isset($_SESSION['toast']) AND ($_SESSION['question_correct'] == FALSE)){
            ?>
                <span class="toast animated fadeOutUp red-toast delay-1s"><?= $_SESSION['toast'] ?></span>
            <?php
                }
            ?>
            <?php
                if (isset($_SESSION['toast']) AND ($_SESSION['question_correct'] == TRUE)){
            ?>
                <span class="toast animated fadeOutUp green-toast delay-1s"><?= $_SESSION['toast'] ?></span>
            <?php
                }
            ?>
            <?php
            //if show_score is false, show the normal question HTML
                if ($show_score == FALSE) {
            ?>
                <p class="breadcrumbs">Question <?= $_SESSION['question_number'] ?> of <?= $_SESSION['num_questions'] ?>?</p>
                <p class="quiz">What is <?= $_SESSION['current_question']['leftAdder'] ?>
                    + <?= $_SESSION['current_question']['rightAdder'] ?>?</p>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value="0"/>
                    <input type="submit" class="btn" name="answer" value="<?= $answers[0] ?>"/>
                    <input type="submit" class="btn" name="answer" value="<?= $answers[1] ?>"/>
                    <input type="submit" class="btn" name="answer" value="<?= $answers[2] ?>"/>
                </form>
            <?php
                // if show_score is not set to FALSE, then show the score (end of quiz)
                } else {
                    echo '<h1> You got ' . $_SESSION['total_correct'] . ' of ' . $_SESSION['num_questions'] . ' correct</h1>';
                    echo '<button class="btn" onclick="window.location.href=\'index.php\'">Play Again</button>';
                }
            ?>
        </div>
    </div>
</body>
</html>
