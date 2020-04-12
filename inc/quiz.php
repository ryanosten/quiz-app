<?php
// Start the session
session_start();
$_SESSION['correct_answers'] = null;


// Include questions from the questions.php file
include 'generate_questions.php';

// Make a variable to hold the total number of questions to ask
$num_questions = count($_SESSION['question_set']);

// Make a variable to determine if the score will be shown or not. Set it to false.

$show_score = FALSE;

// Make a variable to hold a random index. Assign null to it.

$index = null;

// Make a variable to hold the current question. Assign null to it.
$toast = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['answer'] == $_SESSION['current_question']['correctAnswer']) {
        $toast = 'Yaaas, you got it!';
        $_SESSION['correct_answers'] ++;

    } else {
        $toast = 'wrong answer McFly';
    }
}


if (array_key_exists('questions_asked', $_SESSION) === FALSE) {
    $_SESSION['questions_asked'] = [];
    $show_score = FALSE;
}


function generateNewQuestion() {
    do {
        $rand = rand(0, 9);
    } while (in_array($rand, $_SESSION['questions_asked']));
        array_push($_SESSION['questions_asked'], $rand);
        $_SESSION['current_question'] = $_SESSION['question_set'][$rand];
}


if (count($_SESSION['questions_asked']) == $num_questions) {
    $_SESSION['questions_asked'] = [];
    $show_score = TRUE;
} elseif (count($_SESSION['questions_asked']) == 0) {
    $show_score = FALSE;
    $_SESSION['total_correct'] = 0;
    $toast = '';
    generateNewQuestion();
} elseif (count($_SESSION['questions_asked']) !== $num_questions && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo 'ran';
    generateNewQuestion();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

