<?php
require_once 'inc/quiz.php';

$answers = [
        $_SESSION['current_question']['firstIncorrectAnswer'],
        $_SESSION['current_question']['secondIncorrectAnswer'],
        $_SESSION['current_question']['correctAnswer'],
];

$shuffledAnswers = shuffle($answers);

//do {
//    $rand = rand(0, 2);
//    if (!in_array($answers[$rand], $orderedAnswers)) {
//        array_push($orderedAnswers, $answers[$rand]);
//    }
//} while (count($orderedAnswers) < 3);
//
//
//?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div id="quiz-box">
            <?php
            if ($show_score == FALSE) {

                ?>

                <?php
                if ($_SESSION['toast'] !== '') {
                    ?>
                    <span><?= $_SESSION['toast'] ?></span>
                    <?php
                }
                ?>
                <p class="breadcrumbs">Question <?= count($_SESSION['questions_asked']) ?> of <?= $num_questions ?>?</p>
                <p class="quiz">What is <?= $_SESSION['current_question']['leftAdder'] ?>
                    + <?= $_SESSION['current_question']['rightAdder'] ?>?</p>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value="0"/>
                    <input type="submit" class="btn" name="answer" value="<?= $shuffledAnswers[0] ?>"/>
                    <input type="submit" class="btn" name="answer" value="<?= $shuffledAnswers[1] ?>"/>
                    <input type="submit" class="btn" name="answer" value="<?= $shuffledAnswers[2] ?>"/>
                </form>
                <?php
            }
            ?>
            <?php
                if ($show_score == TRUE) {
                    echo '<p> You got' . $_SESSION['total_correct'] . 'of' . $num_questions . '</p>';
                }
            ?>
        </div>
    </div>
</body>
</html>
