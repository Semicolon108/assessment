<?php

    include_once "vendor/autoload.php";

    use App\Controller\Controller;
    

    $data = [
        "session" => "2021/2022",
        "term" => "first term",
        "school_id" => "1ebdf075-45f1-6eb4-933c-6cc21774b98e",
        "class" => "primary 6",
        "subject" => "Integerated Science"
    ];

    $examData = [
        "assessment_id" => "1ebdf080-da1f-68ba-8339-6cc21774",
        "duration" => "1:30 hour"
    ];

    $questionDetails = [
        "exam_id" => "1ebde4ed-8790-62f0-a377-247703ae1c78",
        "question" => "When can i start?",
        "options" => ["hello","world","tomorrow","now"],
        "answer" => "now"
    ];

    $schoolData = [
        "school_id" => "1ebdf816-0b70-6d32-bcbf-247703ae1c78",
        "assessment_id" => "1ebdf080-da1f-68ba-8339-6cc21774",
        "class" => "primary 6",
        "exam_id" => "1ebdf084-c347-69f4-b41c-6cc21774b98e"
    ];

    $school = [
        "school" => "Middlesex"
    ];

    $schoolDetails = [
        "school_id" => "1ebd1259-97fb-6d22-85ed-247703ae",
        "faculty_id" => "1ebd127d-1ecf-6326-8888-247703ae1c78"
    ];
    $questionAndAnswer = [
        "question_id" => "1ebdf088-ac5d-68c0-a623-6cc21774b98e",
        "student_id" => "1ebcec12-abd9-6c62-a8c0-6cc21774b98e",
        "exam_id" => "1ebde4ed-8790-62f0-a377-247703ae1c78",
        "choice" => "free",
        "actual_value" => md5("free")
    ];

    $controller = new Controller;
    //$controller->createSchool($school);
    //$controller->fetchStudentAnswers($schoolData);
    //$controller->createAssessment($data);
    //$controller->createExam($examData);
    //$controller->createExamQuestions($questionDetails);
    //print_r($controller->fetchQuestion("1ebde4ed-8790-62f0-a377-247703ae1c78"));
    //$controller->submitQuestion($questionAndAnswer);
    //print_r($controller->fetchSchoolAssessment($schoolDetails));
    $controller->reFetchAssessment($schoolDetails);
?>