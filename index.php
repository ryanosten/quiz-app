<?php
require_once 'inc/quiz.php';
?>

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
            <p class="breadcrumbs">Question <?=count($_SESSION['questions_asked'])?> of <?= $num_questions?>?</p>
            <p class="quiz">What is <?=$_SESSION['current_question']['leftAdder']?> + <?=$_SESSION['current_question']['rightAdder']?>?</p>
            <form action="inc/quiz.php" method="post">
                <input type="hidden" name="id" value="0" />
                <input type="submit" class="btn" name="answer" value="<?=$_SESSION['current_question']['firstIncorrectAnswer']?>" />
                <input type="submit" class="btn" name="answer" value="<?=$_SESSION['current_question']['secondIncorrectAnswer']?>" />
                <input type="submit" class="btn" name="answer" value="<?=$_SESSION['current_question']['correctAnswer']?>"/>
            </form>
        </div>
    </div>
</body>
</html>