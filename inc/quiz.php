<?php

$show_score = FALSE;
// Start the session
session_start();

// Include questions from the questions.php file
include 'generate_questions.php';

if (isset($_SESSION['toast'])) {
    var_dump($_SESSION['toast']);
}

// Make a variable to determine if the score will be shown or not. Set it to false.

$show_score = FALSE;

// Make a variable to hold a random index. Assign null to it.

$index = null;

// Make a variable to hold the current question. Assign null to it.
//$_SESSION['toast'] = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['answer'] == $_SESSION['current_question']['correctAnswer']) {
        $_SESSION['toast'] = 'Yaaas, you got it!';
        $_SESSION['total_correct'] ++;

    } else {
        $_SESSION['toast'] = 'wrong answer McFly';
    }
}


if (array_key_exists('questions_asked', $_SESSION) === FALSE) {
    $_SESSION['questions_asked'] = [];
    $show_score = FALSE;
    $_SESSION['question_set'] = generateQuestions();
    $_SESSION['num_questions'] = count($_SESSION['question_set']);

}


function generateNewQuestion() {
    do {
        $rand = rand(0, 9);
    } while (in_array($rand, $_SESSION['questions_asked']));
        array_push($_SESSION['questions_asked'], $rand);
        $_SESSION['current_question'] = $_SESSION['question_set'][$rand];
}


if (count($_SESSION['questions_asked']) == $_SESSION['num_questions']) {
    $_SESSION['questions_asked'] = [];
    $show_score = TRUE;
} else {
    $show_score = FALSE;
    if (count($_SESSION['questions_asked']) == 0) {
        $_SESSION['total_correct'] = 0;
        $toast = '';
    }
    generateNewQuestion();
}

//    if (count($_SESSION['questions_asked']) == 0) {
//    $show_score = FALSE;
//    $_SESSION['total_correct'] = 0;
//    $toast = '';
//    generateNewQuestion();
//} elseif (count($_SESSION['questions_asked']) !== $num_questions && $_SERVER['REQUEST_METHOD'] === 'POST') {
//    generateNewQuestion();
//}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

session_destroy();

