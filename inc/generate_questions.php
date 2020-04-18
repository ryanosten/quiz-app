<?php
// Generate random questions

    //generates random answers within + or - 10 of correct answer, and ensure they aren't same as correct answer
    function generateFirstRandomAnswer($correct_answer) {
        do {
            $randNum = rand(($correct_answer - 10), ($correct_answer + 10));
        } while ($randNum == $correct_answer);

        return $randNum;
    }

    // generates random answers within + or - 10 of correct answer, and ensure they aren't same as correct answer or the first incorrect answer
    function generateSecondRandomAnswer($correct_answer, $first_incorrect_answer) {
        do {
            $randNum = rand(($correct_answer - 10), ($correct_answer + 10));
        } while ($randNum == $correct_answer OR $randNum == $first_incorrect_answer);

        return $randNum;
    }

    //generates a random number to add as an adder and make sure that it doesnt exist in any other questions (so answer is unique)
    function generateAdder($question_set){

        do {
            $randNum = rand(0, 100);
        } while(array_column($question_set, 'leftAdder') == $randNum ?: '0' OR array_column($question_set, 'rightAdder') == $randNum ?: '0');

        return $randNum;
    }

    //generates the entire question set for the quiz. Number of questions in quiz can be changed by change the number of loops
    function generateQuestions() {

        //array to hold the question set
        $question_set = [];


        for ($i = 0; $i < 10; $i++) {
            //generate the elements of a question
            $left_adder = generateAdder($question_set);
            $right_adder = generateAdder($question_set);
            $correct_answer = $left_adder + $right_adder;
            $first_incorrect_answer = generateFirstRandomAnswer($correct_answer);
            $second_incorrect_answer = generateSecondRandomAnswer($correct_answer, $first_incorrect_answer);
            //construct a single question into array
            $question = [
                "leftAdder" => $left_adder,
                "rightAdder" => $right_adder,
                "correctAnswer" => $correct_answer,
                "firstIncorrectAnswer" => $first_incorrect_answer,
                "secondIncorrectAnswer" => $second_incorrect_answer,
            ];

            //push the single question into the question_set array
            $question_set[] = $question;
        }

        return $question_set;
    }
