<?php

function retrieve_questions() {
    $json_string = file_get_contents("./questions/triviaquiz.json");

    $json_data = json_decode($json_string, true);

    return $json_data;
}

function get_current_question($answers = '') {
    $number_of_answers = strlen($answers);
    $questions = retrieve_questions();

    return $questions['questions'][$number_of_answers];
}

function get_current_question_number($answers = '') {
    return strlen($answers) + 1;
}

function get_options_for_question_number($number = 0) {
    $questions = retrieve_questions();

    return $questions['questions'][$number - 1]['options'];
}

function compute_score($answers = '') {
    $questions = retrieve_questions();
    $correct_answers = $questions['answers'];

    $score = 0;

    for ($i = 0; $i < count($correct_answers); $i++) {
        if (isset($answers[$i]) && $correct_answers[$i] === $answers[$i]) {
            $score++;
        }
    }

    return $score;
}

function get_answers() {
    $questions = retrieve_questions();

    return $questions['answers'];
}

function get_question_count() {
    $questions = retrieve_questions();

    return count($questions['questions']);
}