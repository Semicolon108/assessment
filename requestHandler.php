<?php
    include_once "./vendor/autoload.php";

    use App\Controllers\AttendanceController;
    use App\Controllers\Teachers;
    use App\Controllers\Assingment;

    
    if(isset($_POST['login'])){

        $teacher = new Teachers;
        $data = [
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ];
        $login = $teacher->login($data);

        if($login){
            echo "success";
        }
    }
    if(isset($_POST['mark'])){
        $data = [
            "student_id" => $_POST['student_id'],
            "attendance" => $_POST['attendance']
        ];
        $attendance = new AttendanceController;
        $attendance->createAttendance($data);
    }

    if(isset($_POST['fetch'])){
        $assignment = new Assingment;
        echo json_encode($assignment->fetchSingleAssingment($_POST['assId']));
    }

    if(isset($_POST['draft-assignment'])){
        $assignment = new Assingment;
        $assignment->createAssignment($_POST);
    }
?>