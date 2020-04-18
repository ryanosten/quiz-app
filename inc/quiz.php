<?php

$show_score = FALSE;
// Start the session
session_start();

// Include questions from the questions.php file
include 'generate_questions.php';


if (!isset($_SESSION['question_number'])) {
    $show_score = FALSE;
    $_SESSION['total_correct'] = 0;
    $_SESSION['question_set'] = generateQuestions();
    $_SESSION['num_questions'] = count($_SESSION['question_set']);
    $_SESSION['question_number'] = 1;
    $_SESSION['question_index'] = 0;
    generateNewQuestion();
}

function generateNewQuestion() {
    $_SESSION['current_question'] = $_SESSION['question_set'][$_SESSION['question_index']];
}

if ($_SESSION['question_number'] > $_SESSION['num_questions']) {
    unset($_SESSION['question_number']);
    $show_score = TRUE;
    if ($_SESSION['answer'] == $_SESSION['current_question']['correctAnswer']) {
        $_SESSION['toast'] = 'You got it!';
        $_SESSION['question_correct'] = TRUE;
        $_SESSION['total_correct'] ++;
        $_SESSION['question_index']++;

    } else {
        $_SESSION['toast'] = 'Wrong Answer';
        $_SESSION['question_correct'] = FALSE;
        $_SESSION['question_index']++;
    }
    session_destroy();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['answer'] = $_POST['answer'];
    if ($_SESSION['answer'] == $_SESSION['current_question']['correctAnswer']) {
        $_SESSION['toast'] = 'You Got It!';
        $_SESSION['question_correct'] = TRUE;
        $_SESSION['total_correct'] ++;
        $_SESSION['question_index']++;

    } else {
        $_SESSION['toast'] = 'Wrong Answer';
        $_SESSION['question_correct'] = FALSE;
        $_SESSION['question_index']++;
    }

    if($_SESSION['question_number'] <= ($_SESSION['num_questions'])){
        generateNewQuestion();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['question_number']++;
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
