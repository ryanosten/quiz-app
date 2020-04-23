<?php

$show_score = FALSE;
// Start the session
session_start();

// Include questions from the questions.php file
include 'generate_questions.php';

//check if question_number is set (checks if quiz is in starting state), if in start state, initialize the quiz
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

//this block checks if the quiz is at the end (eg question number is greater than num_questions). If so, show the total score page and reset question_number so that quiz starts again
if ($_SESSION['question_number'] > $_SESSION['num_questions']) {
    unset($_SESSION['question_number']);
    //show total score to user
    $show_score = TRUE;
    session_destroy();
}

//this block check if we are are not at the beginning of the quiz (eg checks if request method is POST) and handles showing questions if not beginning of quiz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['answer'] = filter_input(INPUT_POST, "answer");
    //This checks if question is correct or incorrect and shows the appropriate toast. Also it increments the question to prepare for next question
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

    //generates new question to show on the next page
    if($_SESSION['question_number'] < ($_SESSION['num_questions'])){
        generateNewQuestion();
    }
}

//this is a redirect that makes the resulting page displayed to the user the product of a GET request. This prevents the app from incrementing the questions if the user refreshes the browser in the middle of the quiz.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['question_number']++;
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
