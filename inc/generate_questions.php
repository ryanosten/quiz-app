<?php
// Generate random questions

if ($_GET) {
//generate random answers within + or - 10 of correct answer, and ensure they aren't same as correct answer
    function generateRandomAnswer($correct_answer)
    {
        do {
            $randNum = rand(($correct_answer - 10), ($correct_answer + 10));
        } while ($randNum == $correct_answer);

        return $randNum;
    }

    function generateAdder($question_set)
    {

        //generate a random number to add as an adder and make sure that it doesnt exist in any other questions (so answer is unique)
        do {
            $randNum = rand(0, 100);
        } while (array_column($question_set, "left_adder") == $randNum OR array_column($question_set, "right_adder") == $randNum);

        return $randNum;
    }

    function generateQuestions()
    {

        //array to hold the question set
        $question_set = [];

        for ($i = 0; $i < 10; $i++) {
            //generate the elements of a question
            $left_adder = generateAdder($question_set);
            $right_adder = generateAdder($question_set);
            $correct_answer = $left_adder + $right_adder;
            $first_incorrect_answer = generateRandomAnswer($correct_answer);
            $second_incorrect_answer = generateRandomAnswer($correct_answer);

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

}