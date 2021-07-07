<?php

    include_once "vendor/autoload.php";

    use App\Controller\Controller;

    $data = [
        "session" => "2021/2022",
        "term" => "first term",
        "school_id" => "1ebd125a-eb75-69f2-9d5b-247703ae1c78",
        "class" => "primary 6",
        "subject" => "maths"
    ];

    $examData = [
        "assessment_id" => "1ebde4ca-76c3-640e-ad3e-247703ae",
        "duration" => "1:30 hour"
    ];

    $questionDetails = [
        "exam_id" => "1ebde4ed-8790-62f0-a377-247703ae1c78",
        "question" => "question....",
        "options" => ["hello","world","loop","free"],
        "answer" => "free"
    ];


    $controller = new Controller;

    //$controller->createAssessment($data);
    //$controller->createExam($examData);
    //$controller->createExamQuestions($questionDetails);
    //$controller->fetchQuestion("1ebde4ed-8790-62f0-a377-247703ae1c78");
    $controller->submitQuestion();
?>