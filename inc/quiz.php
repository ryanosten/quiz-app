<?php

$show_score = FALSE;
// Start the session
session_start();

// Include questions from the questions.php file
include 'generate_questions.php';


if (!isset($_SESSION['question_number'])) {
    $show_score = FALSE;
    $_SESSION['question_set'] = generateQuestions();
    $_SESSION['num_questions'] = count($_SESSION['question_set']);
    $_SESSION['question_number'] = 1;
    generateNewQuestion();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['answer'] == $_SESSION['current_question']['correctAnswer']) {
        $_SESSION['toast'] = 'Yaaas, you got it!';
        $_SESSION['total_correct'] ++;

    } else {
        $_SESSION['toast'] = 'wrong answer McFly';
    }

    if($_SESSION['question_number'] !== ($_SESSION['num_questions']+1)){
        generateNewQuestion();
        $_SESSION['question_number']++;
    }
}

function generateNewQuestion() {
    $_SESSION['current_question'] = $_SESSION['question_set'][$_SESSION['question_number']];
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if ($_SESSION['question_number']-1 == $_SESSION['num_questions']) {
        unset($_SESSION['question_number']);
        $show_score = TRUE;
        session_destroy();
    } else {
        $show_score = FALSE;
        if ($_SESSION['question_number'] == 0) {
            $_SESSION['total_correct'] = 0;
            generateNewQuestion();

        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
